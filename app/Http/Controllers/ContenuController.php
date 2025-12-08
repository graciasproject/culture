<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\TypeContenu;
use App\Models\Region;
use App\Models\Langue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // CORRECTION 2 : Import manquant pour Str
use Illuminate\Routing\Controllers\HasMiddleware; // Pour Laravel 11+
use Illuminate\Routing\Controllers\Middleware;    // Pour Laravel 11+

class ContenuController extends Controller implements HasMiddleware
{
    /**
     * CORRECTION 1 : Utilisation de l'interface HasMiddleware (Standard Laravel 11)
     */
    public static function middleware(): array
    {
        return [
            new Middleware(function ($request, $next) {
                // Si l'utilisateur n'est pas connecté
                if (!Auth::check()) {
                    return redirect()->route('login');
                }
                
                // Si connecté mais pas Admin (id_role !== 1)
                if (Auth::user()->id_role !== 1) {
                    return redirect()->route('home')->with('error', 'Accès réservé aux administrateurs.');
                }

                return $next($request);
            }, only: ['create', 'store', 'edit', 'update', 'destroy']),
        ];
    }

    // --- HELPER POUR LES ASSETS ---
    private function getCoverUrl($contenu, $indexStrict)
    {
        if ($contenu->image_couverture && Storage::disk('public')->exists($contenu->image_couverture)) {
            return asset('storage/' . $contenu->image_couverture);
        }

        $localImages = ['img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg'];
        $safeIndex = $indexStrict % count($localImages);
        return asset($localImages[$safeIndex]);
    }

    private function getVideoUrl($contenu, $indexStrict)
    {
        if ($contenu->video_url && Storage::disk('public')->exists($contenu->video_url)) {
            return asset('storage/' . $contenu->video_url);
        }

        $localVideos = ['vid1.mp4', 'vid2.mp4', 'vid3.mp4', 'vid4.mp4'];
        $safeIndex = $indexStrict % count($localVideos);
        return asset($localVideos[$safeIndex]);
    }

    // --- PAGE D'ACCUEIL (INDEX PUBLIC) ---
    public function index()
    {
        $rawContenus = Contenu::where('statut', 'publié')
            ->with(['region', 'langue', 'auteur'])
            ->latest()
            ->take(10)
            ->get();

        $carouselData = $rawContenus->map(function($contenu, $key) {
            $indexStrict = $key % 4;

            return [
                'id' => $contenu->id,
                'place' => strtoupper($contenu->region?->nom_region ?? 'BENIN'),
                'title' => strtoupper($contenu->titre),
                'title2' => strtoupper($contenu->langue?->nom_langue ?? ''), 
                // CORRECTION 2 : Str::limit fonctionne maintenant grâce à l'import en haut
                'description' => $contenu->resume ?? Str::limit($contenu->texte, 100),
                'image' => $this->getCoverUrl($contenu, $indexStrict),
                'video' => $this->getVideoUrl($contenu, $indexStrict),
                'url' => route('contenus.show', $contenu->id),
                'is_premium' => (bool)$contenu->is_premium,
                'price' => $contenu->prix ?? 0
            ];
        });

        $stats = ['publies' => Contenu::where('statut', 'publié')->count()];
        $typesContenu = TypeContenu::all();
        $regions = Region::all();

        return view('contenus.index', compact('carouselData', 'stats', 'typesContenu', 'regions'));
    }

    // --- ADMIN : VUE TABLEAU (CRUD LISTE) ---
    public function tableIndex()
    {
        $contenus = Contenu::with(['auteur', 'region', 'langue', 'typeContenu'])
            ->latest()
            ->paginate(15);

        return view('admin.contenus.index', compact('contenus'));
    }

    // --- ADMIN : ROUTE SPÉCIALE (Redirection vers tableIndex) ---
    // Ajouté pour correspondre à ton route('admin.contenus.index')
    public function adminIndex()
    {
        return $this->tableIndex();
    }

    // --- PAGE DE LECTURE (SHOW) ---
    public function show(Contenu $contenu)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Connectez-vous pour accéder au contenu.');
        }

        $user = Auth::user();
        $hasPaid = false;
        
        if ($user->id_role === 1) {
            $hasPaid = true; 
        } 

        // Mapping pour l'affichage
        $allIds = Contenu::where('statut', 'publié')->latest()->pluck('id')->toArray();
        $position = array_search($contenu->id, $allIds);
        if ($position === false) $position = 0;
        
        $contenu->image_couverture_display = $this->getCoverUrl($contenu, $position);
        $contenu->video_url_display = $this->getVideoUrl($contenu, $position);

        $contenu->load(['auteur', 'region', 'langue', 'typeContenu']);
        
        $relatedContents = Contenu::where('id_region', $contenu->id_region)
            ->where('id', '!=', $contenu->id)
            ->where('statut', 'publié')
            ->take(3)->get();

        $commentaires = $contenu->commentaires()
            ->with('utilisateur')
            ->latest()
            ->get();

        return view('contenus.show', compact('contenu', 'relatedContents', 'hasPaid', 'commentaires'));
    }

    // --- CRUD ---
    public function create() { 
        $typesContenu = TypeContenu::all(); 
        $regions = Region::all(); 
        $langues = Langue::all(); 
        return view('contenus.create', compact('typesContenu', 'regions', 'langues')); 
    }

    public function store(Request $request) 
{
    // Validation des données
    $validated = $request->validate([
        'titre' => 'required|string|max:255',
        'texte' => 'required|string',
        'resume' => 'nullable|string|max:500',
        'id_type_contenu' => 'required|exists:type_contenus,id', 
        'id_region' => 'required|exists:regions,id', 
        'id_langue' => 'required|exists:langues,id',
        'prix' => 'nullable|integer|min:0',
        // IMPORTANT : Utiliser le pipe `|` pour combiner les mimetypes de fichiers
        'image_couverture' => 'nullable|image|max:10240', // 10MB
        'video_url' => 'nullable|mimes:mp4,mov,ogg,qt,mkv|max:512000', // 512MB
    ]); 

    // --- LOGIQUE DE GESTION DES FICHIERS (UPLOADS) ---
    if ($request->hasFile('image_couverture')) {
        $validated['image_couverture'] = $request->file('image_couverture')->store('contenus/images', 'public');
    } else {
        $validated['image_couverture'] = null; // Assurez-vous que c'est null si non uploadé
    }

    if ($request->hasFile('video_url')) {
        $validated['video_url'] = $request->file('video_url')->store('contenus/videos', 'public');
    } else {
        $validated['video_url'] = null; // Assurez-vous que c'est null si non uploadé
    }
    // --------------------------------------------------

    // Détermination du statut
    $statut = $request->input('statut_final', 'brouillon');

    Contenu::create(array_merge($validated, [
        'id_auteur' => Auth::id(), 
        'statut' => $statut, 
        'date_creation' => now(),
        'is_premium' => $request->has('is_premium'), // Simplification du booléen
        'prix' => $request->input('prix') ?? 0,
    ])); 

    return redirect()->route('admin.contenus.index') // CORRECTION ROUTE ADMIN
        ->with('success', 'Contenu sauvegardé avec succès.'); 
}

    public function edit(Contenu $contenu) { 
        $typesContenu = TypeContenu::all(); 
        $regions = Region::all(); 
        $langues = Langue::all(); 
        return view('contenus.edit', compact('contenu', 'typesContenu', 'regions', 'langues')); 
    }

   // Fichier : ContenuController.php

public function update(Request $request, Contenu $contenu) { 
    // Validation des données
    $validated = $request->validate([
        'titre' => 'required|string|max:255',
        'texte' => 'required|string',
        'resume' => 'nullable|string|max:500',
        'id_type_contenu' => 'required|exists:type_contenus,id', 
        'id_region' => 'required|exists:regions,id', 
        'id_langue' => 'required|exists:langues,id',
        'prix' => 'nullable|integer|min:0',
        // 'image'/'video' sont maintenant `nullable` car la validation est gérée séparément
        'image_couverture' => 'nullable|image|max:10240', 
        'video_url' => 'nullable|mimes:mp4,mov,ogg,qt,mkv|max:512000',

        // Ajout de champs booléens pour la suppression explicite
        'remove_image_couverture' => 'nullable|boolean',
        'remove_video_url' => 'nullable|boolean',
    ]);

    $data = $request->except(['image_couverture', 'video_url', 'remove_image_couverture', 'remove_video_url']);
    
    // --- GESTION DE L'IMAGE DE COUVERTURE ---
    if ($request->hasFile('image_couverture')) {
        // 1. Nouveau fichier uploadé : Supprimer l'ancien et stocker le nouveau
        if ($contenu->image_couverture) {
            Storage::disk('public')->delete($contenu->image_couverture);
        }
        $data['image_couverture'] = $request->file('image_couverture')->store('contenus/images', 'public');

    } elseif ($request->input('remove_image_couverture')) {
        // 2. Suppression explicite demandée : Supprimer l'ancien fichier et mettre le champ à null
        if ($contenu->image_couverture) {
            Storage::disk('public')->delete($contenu->image_couverture);
        }
        $data['image_couverture'] = null;
        
    } else {
        // 3. Rien n'a été touché : Conserver l'ancien chemin
        $data['image_couverture'] = $contenu->image_couverture;
    }


    // --- GESTION DE LA VIDÉO ---
    if ($request->hasFile('video_url')) {
        // 1. Nouveau fichier uploadé : Supprimer l'ancien et stocker le nouveau
        if ($contenu->video_url) {
            Storage::disk('public')->delete($contenu->video_url);
        }
        $data['video_url'] = $request->file('video_url')->store('contenus/videos', 'public');

    } elseif ($request->input('remove_video_url')) {
        // 2. Suppression explicite demandée : Supprimer l'ancien fichier et mettre le champ à null
        if ($contenu->video_url) {
            Storage::disk('public')->delete($contenu->video_url);
        }
        $data['video_url'] = null;

    } else {
        // 3. Rien n'a été touché : Conserver l'ancien chemin
        $data['video_url'] = $contenu->video_url;
    }
    // ----------------------------------------------------
    
    // Autres champs
    $data['is_premium'] = $request->has('is_premium');
    $data['statut'] = $request->input('statut_final', $contenu->statut); // Si un statut final est défini

    $contenu->update($data); 

    return redirect()->route('admin.contenus.index')->with('success', 'Mise à jour effectuée.'); 
}

    public function destroy(Contenu $contenu) { 
        if($contenu->image_couverture) Storage::disk('public')->delete($contenu->image_couverture);
        if($contenu->video_url) Storage::disk('public')->delete($contenu->video_url);
        
        $contenu->delete(); 
        return redirect()->route('contenus.index')->with('success', 'Contenu supprimé.'); 
    }
}