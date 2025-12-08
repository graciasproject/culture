@extends('layouts.app')

@section('title', 'Modifier ' . $region->nom_region . ' - Culture Bénin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12" data-aos="fade-down">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Modifier la <span class="text-benin-green">région</span>
            </h1>
            <p class="text-xl text-gray-600">
                Mettez à jour les informations de {{ $region->nom_region }}
            </p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden" data-aos="fade-up">
            <div class="benin-gradient px-6 py-4">
                <h2 class="text-xl font-bold text-white">Modification de la région</h2>
            </div>

            <form action="{{ route('regions.update', $region) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Nom de la région -->
                <div data-aos="fade-up" data-aos-delay="100">
                    <label for="nom_region" class="block text-sm font-medium text-gray-700 mb-2">
                        Nom de la région *
                    </label>
                    <input type="text" 
                           id="nom_region" 
                           name="nom_region" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300"
                           placeholder="Ex: Atlantique"
                           value="{{ old('nom_region', $region->nom_region) }}">
                    @error('nom_region')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div data-aos="fade-up" data-aos-delay="150">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300 resize-vertical"
                              placeholder="Décrivez cette région, ses particularités culturelles...">{{ old('description', $region->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Population & Superficie -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6" data-aos="fade-up" data-aos-delay="200">
                    <!-- Population -->
                    <div>
                        <label for="population" class="block text-sm font-medium text-gray-700 mb-2">
                            Population
                        </label>
                        <input type="number" 
                               id="population" 
                               name="population" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300"
                               placeholder="Ex: 1500000"
                               value="{{ old('population', $region->population) }}">
                        @error('population')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Superficie -->
                    <div>
                        <label for="superficie" class="block text-sm font-medium text-gray-700 mb-2">
                            Superficie (km²)
                        </label>
                        <input type="number" 
                               id="superficie" 
                               name="superficie" 
                               step="0.01"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300"
                               placeholder="Ex: 3250"
                               value="{{ old('superficie', $region->superficie) }}">
                        @error('superficie')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Localisation -->
                <div data-aos="fade-up" data-aos-delay="250">
                    <label for="localisation" class="block text-sm font-medium text-gray-700 mb-2">
                        Localisation
                    </label>
                    <input type="text" 
                           id="localisation" 
                           name="localisation" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300"
                           placeholder="Ex: Sud du Bénin"
                           value="{{ old('localisation', $region->localisation) }}">
                    @error('localisation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Langues parlées -->
<div data-aos="fade-up" data-aos-delay="300">
    <label class="block text-sm font-medium text-gray-700 mb-4">
        Langues parlées dans cette région
    </label>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
        @foreach($langues as $langue)
            <div class="flex items-center">
                <input type="checkbox" 
                       name="langues[]" 
                       id="langue_{{ $langue->id }}"
                       value="{{ $langue->id }}"
                       {{ in_array($langue->id, old('langues', $region->langue ? $region->langue->pluck('id')->toArray() : [])) ? 'checked' : '' }}
                       class="h-4 w-4 text-benin-green border-gray-300 rounded focus:ring-benin-green">
                <label for="langue_{{ $langue->id }}" class="ml-2 text-sm text-gray-700">
                    {{ $langue->nom_langue }}
                </label>
            </div>
        @endforeach
    </div>
    @error('langues')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row justify-between space-y-4 sm:space-y-0 sm:space-x-6 pt-6 border-t border-gray-200" data-aos="fade-up" data-aos-delay="350">
                    <div class="flex space-x-4">
                        <a href="{{ route('regions.show', $region) }}" 
                           class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-300 text-center font-medium">
                           Annuler
                        </a>
                        
                        <button type="button"
                                onclick="confirmDelete()"
                                class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all duration-300 transform hover:scale-105 font-medium shadow-lg">
                            Supprimer
                        </button>
                    </div>
                    
                    <button type="submit" 
                            class="px-6 py-3 bg-benin-green text-white rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium shadow-lg">
                        💾 Enregistrer les modifications
                    </button>
                </div>
            </form>

            <!-- Delete Form -->
            <form id="delete-form" action="{{ route('regions.destroy', $region) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>

    </div>
</div>

<script>
function confirmDelete() {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette région ? Cette action est irréversible.')) {
        document.getElementById('delete-form').submit();
    }
}
</script>

<style>
    input:focus, select:focus, textarea:focus {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 135, 81, 0.1);
    }
</style>
@endsection