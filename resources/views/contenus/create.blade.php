@extends('layouts.app')

@section('title', 'Créer un Contenu - Admin')

@section('content')
    <div class="flex h-screen bg-gray-50 font-sans overflow-hidden">

        <div class="flex-1 md:ml-0 p-8 overflow-y-auto pt-24 pb-20">

            <div class="max-w-5xl mx-auto">

                <div class="text-center mb-10" data-aos="fade-down">
                    <h1 class="text-3xl md:text-4xl font-[Oswald] font-bold text-gray-900 mb-2">
                        Créer un nouveau <span class="text-benin-green">Contenu</span>
                    </h1>
                    <p class="text-gray-500">Remplissez les informations ci-dessous pour enrichir le catalogue.</p>
                </div>

                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100" data-aos="fade-up">
                    <div class="h-2 bg-gradient-to-r from-benin-green via-benin-yellow to-benin-red"></div>

                    {{-- CORRECTION ROUTE : admin.contenus.store --}}
                    <form id="createForm" action="{{ route('admin.contenus.store') }}" method="POST"
                        enctype="multipart/form-data" class="p-8 space-y-8">
                        @csrf

                        <input type="hidden" name="statut_final" id="statut_final" value="brouillon">

                        <div>
                            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center border-b pb-2">
                                <span
                                    class="bg-gray-100 text-gray-600 w-8 h-8 rounded-full flex items-center justify-center mr-3 text-sm">1</span>
                                Informations Générales
                            </h3>
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Titre du contenu *</label>
                                    <input type="text" name="titre" required value="{{ old('titre') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition placeholder-gray-400"
                                        placeholder="Ex: L'histoire des Amazones du Dahomey">
                                    @error('titre')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Type *</label>
                                        <select name="id_type_contenu" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent bg-white">
                                            <option value="">Sélectionner...</option>
                                            @foreach ($typesContenu as $type)
                                                <option value="{{ $type->id }}"
                                                    {{ old('id_type_contenu') == $type->id ? 'selected' : '' }}>
                                                    {{ $type->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Région *</label>
                                        <select name="id_region" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent bg-white">
                                            <option value="">Sélectionner...</option>
                                            @foreach ($regions as $region)
                                                <option value="{{ $region->id }}"
                                                    {{ old('id_region') == $region->id ? 'selected' : '' }}>
                                                    {{ $region->nom_region }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Langue *</label>
                                        <select name="id_langue" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent bg-white">
                                            <option value="">Sélectionner...</option>
                                            @foreach ($langues as $langue)
                                                <option value="{{ $langue->id }}"
                                                    {{ old('id_langue') == $langue->id ? 'selected' : '' }}>
                                                    {{ $langue->nom_langue }}</option>
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
                                    <p class="text-xs text-gray-500 mb-2">Ce texte court apparaîtra sur les cartes et
                                        incitera à cliquer.</p>
                                    <textarea name="resume" rows="3"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition"
                                        placeholder="Une brève introduction...">{{ old('resume') }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Histoire Complète *</label>
                                    <textarea name="texte" required rows="10"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition"
                                        placeholder="Le contenu détaillé...">{{ old('texte') }}</textarea>
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

                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Image de couverture
                                            (JPG, PNG)</label>
                                        <input type="file" name="image_couverture" accept="image/*"
                                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer border border-gray-300 rounded-lg">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Vidéo (MP4)</label>
                                        <input type="file" name="video_url" accept="video/*"
                                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 cursor-pointer border border-gray-300 rounded-lg">
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
                                                checked>
                                            <div
                                                class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-benin-green">
                                            </div>
                                        </label>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Prix (FCFA)</label>
                                        <input type="number" name="prix" value="200" min="0"
                                            step="50"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-yellow focus:border-transparent">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="pt-6 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">

                            {{-- CORRECTION ROUTE : admin.contenus.index --}}
                            <a href="{{ route('admin.contenus.index') }}"
                                class="text-gray-500 hover:text-gray-800 font-medium transition">Annuler</a>

                            <div class="flex gap-4 w-full sm:w-auto">
                                <button type="button" onclick="submitContent('brouillon')"
                                    class="w-full sm:w-auto px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-bold rounded-lg transition shadow-md">
                                    Enregistrer Brouillon
                                </button>
                                <button type="button" onclick="submitContent('publié')"
                                    class="w-full sm:w-auto px-8 py-3 bg-benin-green hover:bg-green-700 text-white font-bold rounded-lg transition shadow-lg hover:shadow-xl hover:-translate-y-1">
                                    Publier Maintenant
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function submitContent(statut) {
            // 1. Mettre à jour le champ caché
            document.getElementById('statut_final').value = statut;

            // 2. Soumettre le formulaire
            document.getElementById('createForm').submit();
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
