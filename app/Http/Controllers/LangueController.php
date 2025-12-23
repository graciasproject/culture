<?php

namespace App\Http\Controllers;

use App\Models\Langue;
use Illuminate\Http\Request;

class LangueController extends Controller
{
    public function index()
    {
        $langues = Langue::withCount(['users', 'contenus'])->get();
        return view('langues.index', compact('langues'));
    }

    public function create()
    {
        return view('langues.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom_langue' => 'required|string|max:255',
            'code_langue' => 'required|string|max:10|unique:langues',
            'description' => 'nullable|string',
        ]);

        Langue::create($validatedData);

        return redirect()->route('admin.langues.index')
                         ->with('success', 'Langue créée avec succès!');
    }

    public function show(Langue $langue)
    {
        // Cette méthode est maintenant accessible via la route publique
        $langue->load(['users', 'contenus', 'regions']);
        return view('langues.show', compact('langue'));
    }

    public function edit(Langue $langue)
    {
        return view('langues.edit', compact('langue'));
    }

    public function update(Request $request, Langue $langue)
    {
        $validatedData = $request->validate([
            'nom_langue' => 'required|string|max:255',
            'code_langue' => 'required|string|max:10|unique:langues,code_langue,' . $langue->id,
            'description' => 'nullable|string',
        ]);

        $langue->update($validatedData);

        return redirect()->route('admin.langues.index')
                         ->with('success', 'Langue mise à jour avec succès!');
    }

    public function destroy(Langue $langue)
    {
        $langue->delete();
        return redirect()->route('admin.langues.index')
                         ->with('success', 'Langue supprimée avec succès!');
    }
}