<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\TypeMedia;
use App\Models\Contenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $medias = Media::with(['typeMedia', 'contenu'])->get();
        return view('medias.index', compact('medias'));
    }

    public function create()
    {
        $typesMedia = TypeMedia::all();
        $contenus = Contenu::all();
        return view('medias.create', compact('typesMedia', 'contenus'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_type_media' => 'required|exists:type_medias,id',
            'chemin' => 'required|file',
            'description' => 'nullable|string',
            'id_contenu' => 'required|exists:contenus,id',
        ]);

        if ($request->hasFile('chemin')) {
            $file = $request->file('chemin');
            $path = $file->store('medias', 'public');
            $validatedData['chemin'] = $path;
        }

        Media::create($validatedData);

        return redirect()->route('medias.index')
                        ->with('success', 'Média créé avec succès!');
    }

    public function show(Media $media)
    {
        $media->load(['typeMedia', 'contenu']);
        return view('medias.show', compact('media'));
    }

    public function edit(Media $media)
    {
        $typesMedia = TypeMedia::all();
        $contenus = Contenu::all();
        return view('medias.edit', compact('media', 'typesMedia', 'contenus'));
    }

    public function update(Request $request, Media $media)
    {
        $validatedData = $request->validate([
            'id_type_media' => 'required|exists:type_medias,id',
            'description' => 'nullable|string',
            'id_contenu' => 'required|exists:contenus,id',
        ]);

        if ($request->hasFile('chemin')) {
            Storage::disk('public')->delete($media->chemin);
            $file = $request->file('chemin');
            $path = $file->store('medias', 'public');
            $validatedData['chemin'] = $path;
        }

        $media->update($validatedData);

        return redirect()->route('medias.index')
                        ->with('success', 'Média mis à jour avec succès!');
    }

    public function destroy(Media $media)
    {
        Storage::disk('public')->delete($media->chemin);
        $media->delete();

        return redirect()->route('medias.index')
                        ->with('success', 'Média supprimé avec succès!');
    }
}