<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Contenu;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class CommentaireController extends Controller implements HasMiddleware
{
    /**
     * GESTION DES PERMISSIONS (MIDDLEWARE)
     */
    public static function middleware(): array
    {
        return [
            new Middleware(function ($request, $next) {
                $user = Auth::user();

                // 1. Si l'utilisateur n'est pas connecté, on le redirige (Sécurité de base)
                if (!$user) {
                    return redirect()->route('login');
                }

                // 2. Définition des actions réservées STRICTEMENT à l'ADMINISTRATEUR (Rôle 1)
                // Seul l'admin peut voir la liste globale (index) ou supprimer (destroy)
                $adminActions = ['index', 'destroy', 'edit', 'update'];

                // On vérifie si l'action actuelle est dans la liste admin
                // $request->route()->getActionMethod() récupère le nom de la fonction (ex: 'index')
                $currentAction = $request->route()->getActionMethod();

                if (in_array($currentAction, $adminActions)) {
                    // Si ce n'est pas un admin, on bloque
                    if ($user->id_role !== 1) {
                        return redirect()->back()->with('error', 'Action non autorisée.');
                    }
                }

                // 3. Pour 'store' (Poster) et 'show' (Voir), tout le monde passe (si connecté).
                return $next($request);
            }),
        ];
    }

    /**
     * ADMIN : Liste de tous les commentaires (Tableau de bord de modération)
     */
    public function index()
    {
        // On récupère tout, du plus récent au plus ancien, avec les infos utilisateur et contenu
        $commentaires = Commentaire::with(['utilisateur', 'contenu'])
            ->latest()
            ->paginate(20);

        return view('commentaires.index', compact('commentaires'));
    }

    /**
     * PUBLIC/AUTH : Enregistrer un nouveau commentaire
     */
    public function store(Request $request)
    {
        // 1. Validation
        $request->validate([
            'texte' => 'required|string|max:1000',
            'contenu_id' => 'required|exists:contenus,id',
            'note' => 'nullable|integer|min:1|max:5',
        ]);

        // 2. Création
        Commentaire::create([
            'texte' => $request->texte,
            'note' => $request->note, // Peut être null
            'date' => now(),
            'id_utilisateur' => Auth::id(), // L'utilisateur connecté
            'id_contenu' => $request->contenu_id,
        ]);

        // 3. Redirection vers la page du contenu (pour voir son commentaire apparaître)
        // On ajoute le fragment #commentaires pour scroller direct en bas
        return redirect()->route('contenus.show', $request->contenu_id)
            ->with('success', 'Votre avis a été publié !');
    }

    /**
     * PUBLIC/AUTH : Voir le détail d'un commentaire (Vue immersive)
     */
    public function show(Commentaire $commentaire)
    {
        // Charge les relations pour l'affichage
        $commentaire->load(['utilisateur', 'contenu']);
        
        return view('commentaires.show', compact('commentaire'));
    }

    /**
     * ADMIN : Supprimer un commentaire (Modération)
     */
    public function destroy(Commentaire $commentaire)
    {
        $commentaire->delete();

        // Si on supprime depuis la liste admin
        if (request()->routeIs('commentaires.index')) {
            return redirect()->route('commentaires.index')->with('success', 'Commentaire supprimé.');
        }

        // Si on supprime depuis la vue détail
        return redirect()->route('contenus.show', $commentaire->id_contenu)->with('success', 'Commentaire supprimé.');
    }

    /**
     * ADMIN : Éditer un commentaire (Rare, mais utile pour modérer sans supprimer)
     */
    public function edit(Commentaire $commentaire)
    {
        // On pourrait faire une vue edit, ou rediriger vers show pour l'instant
        // Pour simplifier, on renvoie vers show en attendant une vue edit spécifique
        return view('commentaires.show', compact('commentaire'));
    }
}