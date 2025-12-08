<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\User;
use App\Models\Region;
use App\Models\Langue;
use App\Models\TypeContenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatsboardController extends Controller
{
    public function index()
    {
        // Stats principales
        $stats = [
            'total_contenus' => Contenu::count(),
            'total_utilisateurs' => User::count(),
            'total_regions' => Region::count(),
            'total_langues' => Langue::count(),
        ];

        // Données pour les graphiques
        $charts = [
            'types_contenu' => $this->getTypeContenuData(),
            'regions' => $this->getRegionData(),
            'monthly' => $this->getMonthlyData(),
            'statuts' => $this->getStatutData(),
        ];

        return view('statsboard', compact('stats', 'charts'));
    }

    private function getTypeContenuData()
    {
        $data = TypeContenu::withCount('contenus')
            ->having('contenus_count', '>', 0)
            ->get();

        return [
            'labels' => $data->pluck('nom'),
            'data' => $data->pluck('contenus_count')
        ];
    }

    private function getRegionData()
    {
        $data = Region::withCount('contenus')
            ->having('contenus_count', '>', 0)
            ->orderBy('contenus_count', 'desc')
            ->limit(8)
            ->get();

        return [
            'labels' => $data->pluck('nom_region'),
            'data' => $data->pluck('contenus_count')
        ];
    }

    private function getMonthlyData()
    {
        $data = Contenu::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = [];
        $counts = array_fill(1, 12, 0);

        foreach ($data as $item) {
            $counts[$item->month] = $item->count;
        }

        $monthNames = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];

        return [
            'labels' => $monthNames,
            'data' => array_values($counts)
        ];
    }

    private function getStatutData()
    {
        $data = Contenu::select('statut', DB::raw('COUNT(*) as count'))
            ->groupBy('statut')
            ->get();

        return [
            'labels' => $data->pluck('statut')->map(fn($s) => ucfirst($s)),
            'data' => $data->pluck('count')
        ];
    }
}