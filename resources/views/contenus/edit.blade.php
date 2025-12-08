@extends('layouts.app')

@section('title', 'Modifier : ' . $contenu->titre)

@section('content')
    <div class="flex h-screen bg-gray-50 font-sans overflow-hidden">

        <div class="flex-1 md:ml-0 p-8 overflow-y-auto pt-24 pb-20">

            <div class="max-w-5xl mx-auto">

                <div class="flex flex-col md:flex-row justify-between items-end mb-10" data-aos="fade-down">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-[Oswald] font-bold text-gray-900 mb-2">
                            Modifier le <span class="text-benin-green">Contenu</span>
                        </h1>
                        <p class="text-gray-500">Mise à jour de : <strong>{{ $contenu->titre }}</strong></p>
                    </div>
                    <a href="{{ route('admin.contenus.index') }}"
                        class="text-gray-500 hover:text-benin-green transition flex items-center mt-4 md:mt-0">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Retour à la liste
                    </a>
                </div>

                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100" data-aos="fade-up">
                    <div class="h-2 bg-gradient-to-r from-benin-green via-benin-yellow to-benin-red"></div>

                    <form id="editForm" action="{{ route('admin.contenus.update', $contenu->id) }}" method="POST"
                        enctype="multipart/form-data" class="p-8 space-y-8">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="statut_final" id="statut_final" value="{{ $contenu->statut }}">

                        <div>
                            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center border-b pb-2">
                                <span
                                    class="bg-gray-100 text-gray-600 w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">1</span>
                                Informations Générales
                            </h3>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Titre du contenu *</label>
                                    <input type="text" name="titre" required
                                        value="{{ old('titre', $contenu->titre) }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition placeholder-gray-400">
                                    @error('titre')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Type *</label>
                                        <select name="id_type_contenu" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent bg-white">
                                            @foreach ($typesContenu as $type)
                                                <option value="{{ $type->id }}"
                                                    {{ old('id_type_contenu', $contenu->id_type_contenu) == $type->id ? 'selected' : '' }}>
                                                    {{ $type->nom_type ?? $type->nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Région *</label>
                                        <select name="id_region" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent bg-white">
                                            @foreach ($regions as $region)
                                                <option value="{{ $region->id }}"
                                                    {{ old('id_region', $contenu->id_region) == $region->id ? 'selected' : '' }}>
                                                    {{ $region->nom_region }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Langue *</label>
                                        <select name="id_langue" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent bg-white">
                                            @foreach ($langues as $langue)
                                                <option value="{{ $langue->id }}"
                                                    {{ old('id_langue', $contenu->id_langue) == $langue->id ? 'selected' : '' }}>
                                                    {{ $langue->nom_langue }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center border-b pb-2">
                                <span
                                    class="bg-gray-100 text-gray-600 w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">2</span>
                                Contenu
                            </h3>
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Résumé (Teaser)</label>
                                    <textarea name="resume" rows="3"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition">{{ old('resume', $contenu->resume) }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Histoire Complète *</label>
                                    <textarea name="texte" required rows="10"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition">{{ old('texte', $contenu->texte) }}</textarea>
                                    @error('texte')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="bg-gray-50 p-5 rounded-xl border border-gray-200">
                                <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Fichiers Médias
                                </h3>

                                <div class="space-y-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Image de
                                            couverture</label>

                                        @if ($contenu->image_couverture)
                                            <div
                                                class="mb-2 relative w-32 h-20 rounded-lg overflow-hidden border border-gray-300 shadow-sm group">
                                                <img src="{{ asset('storage/' . $contenu->image_couverture) }}"
                                                    class="w-full h-full object-cover">
                                                <div
                                                    class="absolute inset-0 bg-black/50 hidden group-hover:flex items-center justify-center text-white text-xs">
                                                    Actuelle</div>
                                            </div>
                                        @endif

                                        <input type="file" name="image_couverture" accept="image/*"
                                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer border border-gray-300 rounded-lg">
                                        <p class="text-xs text-gray-500 mt-1">Laisser vide pour conserver l'image actuelle.
                                        </p>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Vidéo (MP4)</label>

                                        @if ($contenu->video_url)
                                            <div
                                                class="mb-2 flex items-center text-sm text-benin-green bg-green-50 p-2 rounded border border-green-100">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Une vidéo est déjà associée.
                                            </div>
                                        @endif

                                        <input type="file" name="video_url" accept="video/*"
                                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 cursor-pointer border border-gray-300 rounded-lg">
                                        <p class="text-xs text-gray-500 mt-1">Laisser vide pour conserver la vidéo actuelle.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-yellow-50 p-5 rounded-xl border border-yellow-200">
                                <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-yellow-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Monétisation
                                </h3>

                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-medium text-gray-800">Contenu Payant ?</span>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" name="is_premium" value="1" class="sr-only peer"
                                                {{ old('is_premium', $contenu->is_premium) ? 'checked' : '' }}>
                                            <div
                                                class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-benin-green">
                                            </div>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Prix (FCFA)</label>
                                        <input type="number" name="prix" value="{{ old('prix', $contenu->prix) }}"
                                            min="0" step="50"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-yellow focus:border-transparent">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="pt-6 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">

                            <button type="button" onclick="confirmDelete()"
                                class="text-red-500 hover:text-red-700 font-medium transition flex items-center">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Supprimer ce contenu
                            </button>

                            <div class="flex gap-4 w-full sm:w-auto">
                                <button type="button" onclick="submitContent('brouillon')"
                                    class="w-full sm:w-auto px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-bold rounded-lg transition shadow-md">
                                    {{ $contenu->statut === 'publié' ? 'Repasser en Brouillon' : 'Sauvegarder Brouillon' }}
                                </button>
                                <button type="button" onclick="submitContent('publié')"
                                    class="w-full sm:w-auto px-8 py-3 bg-benin-green hover:bg-green-700 text-white font-bold rounded-lg transition shadow-lg hover:shadow-xl hover:-translate-y-1">
                                    {{ $contenu->statut === 'publié' ? 'Mettre à jour' : 'Publier' }}
                                </button>
                            </div>
                        </div>

                    </form>

                    <form id="delete-form" action="{{ route('admin.contenus.destroy', $contenu->id) }}" method="POST"
                        class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        // Gestion soumission modification
        function submitContent(statut) {
            document.getElementById('statut_final').value = statut;
            document.getElementById('editForm').submit();
        }

        // Gestion suppression
        function confirmDelete() {
            if (confirm('Êtes-vous sûr de vouloir supprimer définitivement ce contenu ?')) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>

    <style>
        input:focus,
        select:focus,
        textarea:focus {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 135, 81, 0.1);
        }
    </style>
@endsection
