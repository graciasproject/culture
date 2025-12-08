<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        if (Auth::check()) {
            return redirect()->route('home.auth');
        }
        $featured = Contenu::where('statut', 'publié')->latest()->take(3)->get();
        return view('home-public', compact('featured'));
    }

    public function index()
    {
        $user = Auth::user();

        // 🛡️ SÉCURITÉ : Si c'est un ADMIN, il dégage vers son Dashboard
        if ($user->id_role === 1) {
            return redirect()->route('admin.dashboard');
        }

        // --- Logique Lecteur ---
        $paidContentIds = Payment::where('user_id', $user->id)
            ->where('status', 'approved')
            ->pluck('contenu_id');

        $myLibrary = Contenu::whereIn('id', $paidContentIds)
            ->with(['auteur', 'region'])
            ->get();

        $spotlight = Contenu::where('statut', 'publié')
            ->whereNotIn('id', $paidContentIds)
            ->latest()
            ->first();
            
        if (!$spotlight) {
            $spotlight = Contenu::where('statut', 'publié')->latest()->first();
        }

        $catalog = Contenu::where('statut', 'publié')
            ->latest()
            ->take(50) 
            ->get();

        return view('home-auth', compact('myLibrary', 'spotlight', 'catalog'));
    }
}