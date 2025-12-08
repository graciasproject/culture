<?php
namespace App\Http\Controllers;

use App\Models\TypeMedia;
use Illuminate\Http\Request;

class TypeMediaController extends Controller
{
    public function index()
    {
        $typesMedia = TypeMedia::withCount('medias')->get();
        return view('types-media.index', compact('typesMedia'));
    }

    public function store(Request $request)
    {
        $request->validate(['nom' => 'required|string|max:255']);
        TypeMedia::create($request->all());
        return redirect()->route('types-media.index')->with('success', 'Type de média créé!');
    }

    public function update(Request $request, TypeMedia $typeMedia)
    {
        $request->validate(['nom' => 'required|string|max:255']);
        $typeMedia->update($request->all());
        return redirect()->route('types-media.index')->with('success', 'Type de média mis à jour!');
    }

    public function destroy(TypeMedia $typeMedia)
    {
        $typeMedia->delete();
        return redirect()->route('types-media.index')->with('success', 'Type de média supprimé!');
    }
}