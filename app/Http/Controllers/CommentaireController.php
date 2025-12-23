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
                // Seul l'admin peut voir la liste globale (index)
                // Pour destroy/edit/update, on vérifie au cas par cas dans la méthode
                $adminOnlyActions = ['index'];

                // On vérifie si l'action actuelle est dans la liste admin strict
                $currentAction = $request->route()->getActionMethod();

                if (in_array($currentAction, $adminOnlyActions)) {
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
    $request->validate([
        'texte' => 'required|string',
        'contenu_id' => 'required|exists:contenus,id',
        'note' => 'nullable|integer|min:1|max:5', // Si vous gérez les notes
    ]);

    Commentaire::create([
        'id_utilisateur' => auth()->id(), // FIX: user_id -> id_utilisateur
        'id_contenu' => $request->contenu_id, // FIX: contenu_id -> id_contenu (si colonne différente, mais ici le modèle a id_contenu)
        'texte' => $request->texte,
        'note' => $request->note,
        'date' => now(), // Ajout de la date explicite si nécessaire
    ]);

    return back()->with('success', 'Votre commentaire a été ajouté.');
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
     * PUBLIC/AUTH (Owner) + ADMIN : Supprimer un commentaire
     */
    public function destroy(Commentaire $commentaire)
    {
        $user = Auth::user();

        // Autorisation : Admin (1) OU Propriétaire du commentaire
        if ($user->id_role !== 1 && $user->id !== $commentaire->id_utilisateur) {
             return redirect()->back()->with('error', 'Vous ne pouvez pas supprimer ce commentaire.');
        }

        $commentaire->delete();

        // Si on supprime depuis la liste admin
        if (request()->routeIs('commentaires.index')) {
            return redirect()->route('commentaires.index')->with('success', 'Commentaire supprimé.');
        }

        // Si on supprime depuis la vue détail ou show contenu
        return redirect()->back()->with('success', 'Commentaire supprimé.');
    }

    /**
     * PUBLIC/AUTH (Owner) : Afficher le formulaire d'édition
     */
    public function edit(Commentaire $commentaire)
    {
        $user = Auth::user();

        // Autorisation : Propriétaire seulement (l'admin supprime, il n'édite pas forcément le texte des gens)
        if ($user->id !== $commentaire->id_utilisateur) {
             return redirect()->back()->with('error', 'Vous ne pouvez pas modifier ce commentaire.');
        }

        return view('commentaires.edit', compact('commentaire'));
    }

    /**
     * PUBLIC/AUTH (Owner) : Mettre à jour le commentaire
     */
    public function update(Request $request, Commentaire $commentaire)
    {
        $user = Auth::user();

        // Autorisation : Propriétaire seulement
        if ($user->id !== $commentaire->id_utilisateur) {
             return redirect()->back()->with('error', 'Action non autorisée.');
        }

        $request->validate([
            'texte' => 'required|string',
            'note' => 'nullable|integer|min:1|max:5',
        ]);

        $commentaire->update([
            'texte' => $request->texte,
            'note' => $request->note,
        ]);

        return redirect()->route('contenus.show', $commentaire->id_contenu)
            ->with('success', 'Commentaire mis à jour.');
    }
}