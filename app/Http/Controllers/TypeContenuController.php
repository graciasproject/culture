<?php

namespace App\Http\Controllers;

use App\Models\TypeContenu;
use Illuminate\Http\Request;

class TypeContenuController extends Controller
{
    public function index()
    {
        $types = TypeContenu::all();
        // Attention : le dossier vue est 'types-contenu', pas 'types'
        return view('types-contenu.index', compact('types')); 
    }

    public function create()
    {
        // Attention : le dossier vue est 'types-contenu'
        return view('types-contenu.create'); 
    }

    public function store(Request $request)
    {
        $request->validate(['nom_type' => 'required|string|max:255']);
        TypeContenu::create($request->all());
        
        // Redirection vers la route 'types.index' (définie dans web.php)
        return redirect()->route('types.index')->with('success', 'Type créé.');
    }

    public function edit(TypeContenu $type)
    {
        return view('types-contenu.edit', compact('type'));
    }

    public function update(Request $request, TypeContenu $type)
    {
        $type->update($request->all());
        return redirect()->route('types.index');
    }

    public function destroy(TypeContenu $type)
    {
        $type->delete();
        return redirect()->route('types.index');
    }
}