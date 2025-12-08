<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\User;
use App\Models\Region;
use App\Models\Langue;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'contenus' => Contenu::where('statut', 'publié')->count(),
            'utilisateurs' => User::count(),
            'en_attente' => Contenu::where('statut', 'en_attente')->count(),
            'regions' => Region::count(),
        ];

        // Activité récente (exemple - à adapter selon tes besoins)
        $recentActivity = collect([
            (object)[
                'description' => 'Nouveau contenu publié',
                'created_at' => now()->subMinutes(15)
            ],
            (object)[
                'description' => 'Utilisateur inscrit',
                'created_at' => now()->subHours(2)
            ],
            // Ajoute d'autres activités selon tes besoins
        ]);

        // Contenus en attente de modération
        $pendingContents = Contenu::with('auteur')
            ->where('statut', 'en_attente')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'recentActivity', 'pendingContents'));
    }
}