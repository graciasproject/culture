<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Langue;
use App\Models\TypeContenu;
use Illuminate\Support\Facades\Auth;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. ADMIN : Vue Tableau de gestion
        if (Auth::check() && Auth::user()->id_role === 1) {
            $regions = Region::withCount('contenus')->paginate(10);
            return view('admin.regions.index', compact('regions')); 
        }

        // 2. PUBLIC : Vue Vitrine Immersion
        $regions = Region::withCount('contenus')->orderBy('nom_region')->get();
        return view('regions.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $langues = Langue::all();
        return view('regions.create', compact('langues'));  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom_region' => 'required|string|max:255',
            'description' => 'nullable|string',
            'population' => 'nullable|integer',
            'superficie' => 'nullable|numeric',
            'localisation' => 'nullable|string',
        ]);

        $region = Region::create($validatedData);

        if ($request->has('langues')) {
            $region->langues()->attach($request->langues);  
        } 
        
        return redirect()->route('admin.regions.index')
                         ->with('success', 'Région créée avec succès!');
    }  

    /**
     * Display the specified resource.
     */
    public function show(Region $region)
    {
        // Cette méthode est maintenant accessible via la route publique
        $region->loadCount(['contenus', 'langues']);
        $region->load(['langues']);

        $contenus = $region->contenus()
            ->with(['auteur', 'langue', 'typeContenu'])
            ->where('statut', 'publié')
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        $typesContenu = TypeContenu::all();

        $stats = [
            'contenus_publies' => $region->contenus()->where('statut', 'publié')->count(),
            'contenus_attente' => $region->contenus()->where('statut', 'en_attente')->count(),
            'contenus_brouillons' => $region->contenus()->where('statut', 'brouillon')->count(),
        ];

        return view('regions.show', compact('region', 'contenus', 'typesContenu', 'stats'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Region $region)
    {
        $langues = Langue::all();
        return view('regions.edit', compact('region', 'langues'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Region $region)
    {
        $validatedData = $request->validate([
            'nom_region' => 'required|string|max:255',
            'description' => 'nullable|string',
            'population' => 'nullable|integer',
            'superficie' => 'nullable|numeric',
            'localisation' => 'nullable|string',
        ]);

        $region->update($validatedData);

        if ($request->has('langues')) {
            $region->langues()->sync($request->langues);
        }

        return redirect()->route('admin.regions.index')
                         ->with('success', 'Région mise à jour avec succès!');  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Region $region)
    {
        $region->delete();

        return redirect()->route('admin.regions.index')
                         ->with('success', 'Région supprimée avec succès!');
    }
}