@extends('layouts.app')
@section('title', 'Nouvelle Région')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-4">
                    <li><a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700">Admin</a></li>
                    <li><span class="text-gray-300">/</span></li>
                    {{-- CORRECTION ICI : admin.regions.index --}}
                    <li><a href="{{ route('admin.regions.index') }}" class="text-gray-500 hover:text-gray-700">Régions</a>
                    </li>
                    <li><span class="text-gray-300">/</span></li>
                    <li><span class="text-benin-green font-medium">Ajouter</span></li>
                </ol>
            </nav>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border-t-8 border-benin-green"
                data-aos="fade-up">
                <div class="p-8">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Ajouter une Région / Commune</h1>

                    {{-- CORRECTION ICI : admin.regions.store --}}
                    <form action="{{ route('admin.regions.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nom de la
                                    Région</label>
                                <input type="text" name="nom_region" required
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 focus:ring-2 focus:ring-benin-green outline-none dark:text-white transition-all"
                                    placeholder="Ex: Mono">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Localisation
                                    (ex: Sud-Ouest)</label>
                                <input type="text" name="localisation"
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 focus:ring-2 focus:ring-benin-green outline-none dark:text-white transition-all">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description
                                culturelle</label>
                            <textarea name="description" rows="5"
                                class="w-full px-4 py-3 rounded-xl bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 focus:ring-2 focus:ring-benin-green outline-none dark:text-white transition-all"
                                placeholder="Décrivez les atouts culturels de cette région..."></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Image de
                                couverture</label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-xl hover:border-benin-green transition-colors cursor-pointer relative bg-gray-50 dark:bg-gray-700/50">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 dark:text-gray-400 justify-center">
                                        <label for="image-upload"
                                            class="relative cursor-pointer bg-white dark:bg-gray-600 rounded-md font-medium text-benin-green hover:text-benin-dark-green focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-benin-green px-2">
                                            <span>Télécharger un fichier</span>
                                            <input id="image-upload" name="image" type="file" class="sr-only"
                                                accept="image/*" onchange="previewImage(this)">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG jusqu'à 5MB</p>
                                </div>
                                <img id="preview"
                                    class="absolute inset-0 w-full h-full object-cover rounded-xl hidden opacity-50 hover:opacity-100 transition-opacity" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end pt-6 border-t dark:border-gray-700 gap-4">
                            {{-- CORRECTION ICI : admin.regions.index --}}
                            <a href="{{ route('admin.regions.index') }}"
                                class="px-6 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-xl hover:bg-gray-200 transition-colors">
                                Annuler
                            </a>
                            <button type="submit"
                                class="px-8 py-3 bg-gradient-to-r from-benin-green to-benin-dark-green text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all">
                                Créer la Région
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('preview');
                    img.src = e.target.result;
                    img.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
