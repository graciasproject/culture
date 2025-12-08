<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Langue;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Liste des utilisateurs.
     */
    public function index()
    {
        $users = User::with(['role', 'langue'])
        ->get();
        return view ('users.index', compact('users'));
    }

    /**
     *Formulaier de création
     */
    public function create()
    {
        $roles = Role::all();
        $langues = Langue::all();

        return view('users.create', compact('roles', 'langues'));
    }

    /**Enregistre un nouveau user
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'sexe' => 'required|in:M,F',
        'id_langue' => 'required|exists:langues,id',
        'date_naissance' => 'required|date',
        'statut' => 'required|string|max:255',
        'photo' => 'nullable|image|max:2048', 
        'id_role' => 'required|exists:roles,id',
        'email' => 'required|string|email|max:255|unique:users,email',
        'mot_de_passe' => 'required|string|min:8|confirmed',
    ]);

    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('photos', 'public');
        $validatedData['photo'] = $photoPath;
    }

    $validatedData['mot_de_passe'] = Hash::make($validatedData['mot_de_passe']);

    User::create($validatedData);

    return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
}

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load(['role', 'langue', 'contenus', 'commentaires']);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    { 
        $roles = Role::all();
        $langues = Langue::all();

        return view('users.edit', compact('user', 'roles', 'langues'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        

        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'sexe' => 'required|in:M,F',
            'id_langue' => 'required|exists:langues,id',
            'date_naissance' => 'required|date',
            'statut' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048', 
            'id_role' => 'required|exists:roles,id',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'mot_de_passe' => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $validatedData['photo'] = $photoPath;
        }

        if (!empty($validatedData['mot_de_passe'])) {
            $validatedData['mot_de_passe'] = Hash::make($validatedData['mot_de_passe']);
        } else {
            unset($validatedData['mot_de_passe']);
        }

        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) {
    if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
