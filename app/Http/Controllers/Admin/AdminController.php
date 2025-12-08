<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import essentiel pour les stats

// Imports des Modèles
use App\Models\Contenu;
use App\Models\Region;
use App\Models\Langue;
use App\Models\User;
use App\Models\TypeContenu;
use App\Models\TypeMedia;
use App\Models\Commentaire;
use App\Models\Media;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = $this->getStats();
        $tables = $this->getTablesData();
        $recentActivities = $this->getRecentActivities();

        return view('admin.dashboard', compact('stats', 'tables', 'recentActivities'));
    }

    private function getStats()
    {
        return [
            'contenus' => Contenu::count(),
            'regions' => Region::count(),
            'langues' => Langue::count(),
            'utilisateurs' => User::count(),
            'types_contenu' => TypeContenu::count(),
            'types_media' => TypeMedia::count(),
            'commentaires' => Commentaire::count(),
            'medias' => Media::count(),
        ];
    }

    private function getTablesData()
    {
        return [
            [
                'name' => 'Contenus',
                'count' => Contenu::count(),
                'color' => 'green',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>',
                'routes' => [
                    'public' => route('contenus.index'),
                    'create' => route('admin.contenus.create'),
                    'manage' => route('admin.contenus.index')
                ]
            ],
            [
                'name' => 'Régions',
                'count' => Region::count(),
                'color' => 'yellow',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>',
                'routes' => [
                    'public' => route('regions.index'),
                    'create' => route('admin.regions.create'),
                    'manage' => route('admin.regions.index')
                ]
            ],
            [
                'name' => 'Langues',
                'count' => Langue::count(),
                'color' => 'red',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>',
                'routes' => [
                    'public' => route('langues.index'),
                    'create' => route('admin.langues.create'),
                    'manage' => route('admin.langues.index')
                ]
            ],
            [
                'name' => 'Utilisateurs',
                'count' => User::count(),
                'color' => 'blue',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>',
                'routes' => [
                    'public' => null,
                    'create' => route('admin.users.create'),
                    'manage' => route('admin.users.index')
                ]
            ],
            [
                'name' => 'Types Contenu',
                'count' => TypeContenu::count(),
                'color' => 'indigo',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>',
                'routes' => [
                    'public' => null,
                    'create' => route('admin.types-contenu.create'),
                    'manage' => route('admin.types-contenu.index')
                ]
            ],
            [
                'name' => 'Types Média',
                'count' => TypeMedia::count(),
                'color' => 'orange',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/>',
                'routes' => [
                    'public' => null,
                    'create' => route('admin.types-media.create'),
                    'manage' => route('admin.types-media.index')
                ]
            ],
            [
                'name' => 'Médias',
                'count' => Media::count(),
                'color' => 'purple',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
                'routes' => [
                    'public' => null,
                    'create' => route('admin.medias.create'),
                    'manage' => route('admin.medias.index')
                ]
            ],
            [
                'name' => 'Commentaires',
                'count' => Commentaire::count(),
                'color' => 'pink',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>',
                'routes' => [
                    'public' => null,
                    'create' => null,
                    'manage' => route('admin.commentaires.index')
                ]
            ],
        ];
    }

    private function getRecentActivities()
    {
        $recentContents = Contenu::with('auteur')->latest()->take(5)->get()->map(function ($content) {
            return (object) [
                'description' => "Nouveau contenu : \"{$content->titre}\"",
                'created_at' => $content->created_at
            ];
        });

        $recentUsers = User::latest()->take(3)->get()->map(function ($user) {
            return (object) [
                'description' => "Nouvel utilisateur : {$user->prenom} {$user->nom}",
                'created_at' => $user->created_at
            ];
        });

        return $recentContents->merge($recentUsers)->sortByDesc('created_at')->take(5);
    }

    public function stats()
    {
        // 1. KPI PRINCIPAUX
        $stats = [
            'total_contenus' => Contenu::count(),
            'total_utilisateurs' => User::count(),
            'total_regions' => Region::count(),
            'total_langues' => Langue::count(),
        ];

        // 2. GRAPHIQUES

        // A. Par Type de Contenu (CORRIGÉ: id_type_contenu)
        $types = Contenu::select('id_type_contenu', DB::raw('count(*) as total'))
            ->with('typeContenu')
            ->groupBy('id_type_contenu')
            ->get();

        $charts['types_contenu'] = [
            'labels' => $types->pluck('typeContenu.nom')->toArray(),
            'data' => $types->pluck('total')->toArray(),
        ];

        // B. Par Région (CORRIGÉ: id_region)
        $regions = Contenu::select('id_region', DB::raw('count(*) as total'))
            ->with('region')
            ->groupBy('id_region')
            ->get();

        $charts['regions'] = [
            'labels' => $regions->pluck('region.nom_region')->toArray(),
            'data' => $regions->pluck('total')->toArray(),
        ];

        // C. Par Statut
        $statuts = Contenu::select('statut', DB::raw('count(*) as total'))
            ->groupBy('statut')
            ->get();

        $charts['statuts'] = [
            'labels' => $statuts->pluck('statut')->toArray(),
            'data' => $statuts->pluck('total')->toArray(),
        ];

        // D. Évolution Mensuelle
        $monthly = Contenu::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('count(*) as total')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $charts['monthly'] = [
            'labels' => $monthly->pluck('month')->toArray(),
            'data' => $monthly->pluck('total')->toArray(),
        ];

        return view('statsboard', compact('stats', 'charts'));
    }
}