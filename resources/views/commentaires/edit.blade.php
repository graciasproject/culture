@extends('layouts.app')

@section('title', 'Modifier mon commentaire')

@section('content')
<div class="bg-[#050505] min-h-screen text-gray-100 font-sans py-12">
    <div class="max-w-2xl mx-auto px-4">
        
        <div class="mb-8">
            <a href="{{ route('contenus.show', $commentaire->id_contenu) }}" class="text-gray-400 hover:text-white transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Retour au contenu
            </a>
        </div>

        <div class="bg-gray-900 rounded-xl border border-gray-800 p-8 shadow-2xl">
            <h1 class="text-3xl font-[Oswald] text-white mb-6">Modifier votre avis</h1>

            <form action="{{ route('commentaires.update', $commentaire->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label class="block text-gray-400 text-sm mb-2">Votre note</label>
                    <select name="note" class="w-full bg-black border border-gray-700 text-white rounded p-3 focus:border-benin-yellow focus:ring-0">
                        <option value="">Pas de note</option>
                        <option value="5" {{ $commentaire->note == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ Excellent</option>
                        <option value="4" {{ $commentaire->note == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ Très bien</option>
                        <option value="3" {{ $commentaire->note == 3 ? 'selected' : '' }}>⭐⭐⭐ Bien</option>
                        <option value="2" {{ $commentaire->note == 2 ? 'selected' : '' }}>⭐⭐ Moyen</option>
                        <option value="1" {{ $commentaire->note == 1 ? 'selected' : '' }}>⭐ Mauvais</option>
                    </select>
                </div>

                <div class="mb-8">
                    <label class="block text-gray-400 text-sm mb-2">Votre message</label>
                    <textarea name="texte" rows="6" required
                        class="w-full bg-black border border-gray-700 rounded-lg p-4 text-white focus:border-benin-yellow focus:ring-0 transition leading-relaxed">{{ old('texte', $commentaire->texte) }}</textarea>
                </div>

                <div class="flex justify-end gap-4">
                    <a href="{{ route('contenus.show', $commentaire->id_contenu) }}" 
                       class="px-6 py-3 rounded-full border border-gray-700 text-gray-300 hover:bg-gray-800 transition">
                       Annuler
                    </a>
                    <button type="submit" 
                            class="px-8 py-3 bg-benin-yellow text-black font-bold rounded-full hover:scale-105 transition shadow-[0_0_15px_rgba(252,209,22,0.5)]">
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection