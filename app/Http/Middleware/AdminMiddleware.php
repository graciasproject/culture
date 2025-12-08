<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Vérifier si l'utilisateur est admin (id_role = 1)
        if (Auth::user()->id_role !== 1) {
            return redirect()->route('home.auth')->with('error', 'Accès réservé aux administrateurs.');
        }

        return $next($request);
    }
}
