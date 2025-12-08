@extends('layouts.app')

@section('title', 'Ajouter une Langue - Culture Bénin')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            <nav class="flex mb-8 text-sm" aria-label="Breadcrumb" data-aos="fade-down">
                <ol class="flex items-center space-x-4">
                    <li><a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700">Admin</a></li>
                    <li><span class="text-gray-300">/</span></li>
                    <li><a href="{{ route('admin.langues.index') }}" class="text-gray-500 hover:text-gray-700">Langues</a>
                    </li>
                    <li><span class="text-gray-300">/</span></li>
                    <li><span class="text-benin-green font-medium">Ajouter</span></li>
                </ol>
            </nav>

            <div class="text-center mb-12" data-aos="fade-down">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Ajouter une <span class="text-benin-green">Langue</span>
                </h1>
                <p class="text-xl text-gray-600">
                    Enrichissez notre catalogue linguistique
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden" data-aos="fade-up">
                <div class="benin-gradient px-6 py-4">
                    <h2 class="text-xl font-bold text-white">Nouvelle langue</h2>
                </div>

                {{-- CORRECTION ROUTE : admin.langues.store --}}
                <form action="{{ route('admin.langues.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    <div data-aos="fade-up" data-aos-delay="100">
                        <label for="nom_langue" class="block text-sm font-medium text-gray-700 mb-2">
                            Nom de la langue *
                        </label>
                        <input type="text" id="nom_langue" name="nom_langue" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300"
                            placeholder="Ex: Fon, Yoruba, Goun..." value="{{ old('nom_langue') }}">
                        @error('nom_langue')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div data-aos="fade-up" data-aos-delay="150">
                        <label for="code_langue" class="block text-sm font-medium text-gray-700 mb-2">
                            Code de la langue *
                        </label>
                        <input type="text" id="code_langue" name="code_langue" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300"
                            placeholder="Ex: fon, yo, gu..." value="{{ old('code_langue') }}">
                        @error('code_langue')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Code court (2-3 lettres) pour identifier la langue</p>
                    </div>

                    <div data-aos="fade-up" data-aos-delay="200">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>
                        <textarea id="description" name="description" rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300 resize-vertical"
                            placeholder="Décrivez cette langue, son origine, ses particularités...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col sm:flex-row justify-between space-y-4 sm:space-y-0 sm:space-x-6 pt-6 border-t border-gray-200"
                        data-aos="fade-up" data-aos-delay="250">
                        {{-- CORRECTION ROUTE : admin.langues.index --}}
                        <a href="{{ route('admin.langues.index') }}"
                            class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-300 text-center font-medium">
                            Annuler
                        </a>

                        <button type="submit"
                            class="px-6 py-3 bg-benin-green text-white rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium shadow-lg">
                            💾 Créer la langue
                        </button>
                    </div>
                </form>
            </div>

            <div class="mt-8 bg-blue-50 rounded-2xl p-6" data-aos="fade-up" data-aos-delay="300">
                <div class="flex items-start space-x-4">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-blue-900 mb-2">Conseils pour ajouter une langue</h3>
                        <ul class="text-blue-700 text-sm space-y-1">
                            <li>• Utilisez le nom complet de la langue (ex: "Fon" plutôt que "fɔngbè")</li>
                            <li>• Le code doit être court et unique (2-3 lettres)</li>
                            <li>• La description peut inclure le nombre de locuteurs, les régions principales, etc.</li>
                            <li>• Vérifiez que la langue n'existe pas déjà dans la liste</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        /* Vous pourriez vouloir définir .benin-gradient ici ou dans votre CSS global */
        /* Exemple:
        .benin-gradient {
            background: linear-gradient(90deg, #008751 0%, #FCD116 50%, #E8112D 100%);
        }
        */

        input:focus,
        textarea:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 135, 81, 0.1);
        }
    </style>
@endsection
