@extends('layouts.app')
@section('title', 'Modifier Type')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12">
        <div class="max-w-2xl mx-auto px-4">

            <div class="mb-8" data-aos="fade-right">
                <a href="{{ route('types-contenu.index') }}"
                    class="text-gray-500 hover:text-blue-600 flex items-center transition-colors mb-2 text-sm font-medium">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour à la liste
                </a>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Modifier le Type <span
                        class="text-gray-400">#{{ $type->id }}</span></h1>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border-t-4 border-blue-500"
                data-aos="fade-up">
                {{-- Attention ici : on passe $type qui vient du contrôleur --}}
                <form action="{{ route('types-contenu.update', $type->id) }}" method="POST" class="p-8">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="nom"
                            class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Libellé du type <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nom" id="nom" value="{{ old('nom', $type->nom) }}" required
                            class="w-full px-4 py-3 rounded-lg bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none dark:text-white transition-all shadow-sm">

                        @error('nom')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end space-x-4 pt-4 border-t dark:border-gray-700">
                        <a href="{{ route('types-contenu.index') }}"
                            class="px-6 py-2.5 rounded-lg text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 transition-colors font-medium">
                            Annuler
                        </a>
                        <button type="submit"
                            class="px-6 py-2.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700 shadow-lg hover:shadow-blue-500/30 transition-all transform hover:-translate-y-0.5 font-bold">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
