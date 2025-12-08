@extends('layouts.app')

@section('title', 'Modifier ' . $langue->nom_langue . ' - Culture Bénin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12" data-aos="fade-down">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Modifier la <span class="text-benin-green">langue</span>
            </h1>
            <p class="text-xl text-gray-600">
                Mettez à jour les informations de {{ $langue->nom_langue }}
            </p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden" data-aos="fade-up">
            <div class="benin-gradient px-6 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white">Modification de la langue</h2>
                    <span class="bg-white/20 backdrop-blur-sm rounded-full px-3 py-1 text-sm text-white">
                        {{ $langue->code_langue }}
                    </span>
                </div>
            </div>

            <form action="{{ route('langues.update', $langue) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Nom de la langue -->
                <div data-aos="fade-up" data-aos-delay="100">
                    <label for="nom_langue" class="block text-sm font-medium text-gray-700 mb-2">
                        Nom de la langue *
                    </label>
                    <input type="text" 
                           id="nom_langue" 
                           name="nom_langue" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300"
                           placeholder="Ex: Fon, Yoruba, Goun..."
                           value="{{ old('nom_langue', $langue->nom_langue) }}">
                    @error('nom_langue')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Code de la langue -->
                <div data-aos="fade-up" data-aos-delay="150">
                    <label for="code_langue" class="block text-sm font-medium text-gray-700 mb-2">
                        Code de la langue *
                    </label>
                    <input type="text" 
                           id="code_langue" 
                           name="code_langue" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300"
                           placeholder="Ex: fon, yo, gu..."
                           value="{{ old('code_langue', $langue->code_langue) }}">
                    @error('code_langue')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div data-aos="fade-up" data-aos-delay="200">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300 resize-vertical"
                              placeholder="Décrivez cette langue, son origine, ses particularités...">{{ old('description', $langue->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row justify-between space-y-4 sm:space-y-0 sm:space-x-6 pt-6 border-t border-gray-200" data-aos="fade-up" data-aos-delay="250">
                    <div class="flex space-x-4">
                        <a href="{{ route('langues.show', $langue) }}" 
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
            <form id="delete-form" action="{{ route('langues.destroy', $langue) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>

    </div>
</div>

<script>
function confirmDelete() {
    if (confirm('Êtes-vous sûr de vouloir supprimer cette langue ? Cette action est irréversible.')) {
        document.getElementById('delete-form').submit();
    }
}
</script>

<style>
    input:focus, textarea:focus {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 135, 81, 0.1);
    }
</style>
@endsection