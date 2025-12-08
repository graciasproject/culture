<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Langue;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'mot_de_passe' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Valeurs par défaut
        $roleLecteur = Role::where('nom', 'Lecteur')->firstOrFail();
        $langueFrancais = Langue::where('nom_langue', 'Français')->firstOrFail();

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'mot_de_passe' => Hash::make($request->mot_de_passe),
            'id_role' => $roleLecteur->id,
            'id_langue' => $langueFrancais->id,
        ]);

        // Déclencher l'événement d'inscription (envoi email de vérification)
        event(new Registered($user));

        // ✅ Rediriger vers la page de succès
        return redirect()->route('register.success');
    }

    /**
     * Display registration success page.
     */
    public function success(): View
    {
        return view('auth.register-success');
    }
}
