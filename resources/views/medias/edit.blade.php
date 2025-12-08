@extends('layouts.app')

@section('title', 'Modifier le Média - Culture Bénin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12" data-aos="fade-down">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Modifier le <span class="text-benin-green">Média</span>
            </h1>
            <p class="text-xl text-gray-600">
                Mettez à jour les informations du média
            </p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden" data-aos="fade-up">
            <div class="benin-gradient px-6 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white">Modification du média</h2>
                    <span class="bg-white/20 backdrop-blur-sm rounded-full px-3 py-1 text-sm text-white">
                        {{ $media->typeMedia->nom }}
                    </span>
                </div>
            </div>

            <form action="{{ route('medias.update', $media) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Current Media Preview -->
                <div data-aos="fade-up" data-aos-delay="100">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Média actuel
                    </label>
                    <div class="bg-gray-50 rounded-lg p-4">
                        @if($media->typeMedia->nom === 'image')
                            <img src="{{ asset('storage/' . $media->chemin) }}" 
                                 alt="{{ $media->description ?? 'Image' }}"
                                 class="max-w-full max-h-48 mx-auto rounded-lg">
                        @elseif($media->typeMedia->nom === 'vidéo')
                            <div class="text-center">
                                <svg class="w-16 h-16 text-benin-green mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-sm text-gray-600">Fichier vidéo</p>
                            </div>
                        @elseif($media->typeMedia->nom === 'audio')
                            <div class="text-center">
                                <svg class="w-16 h-16 text-benin-yellow mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 016 0v6a3 3 0 01-3 3z"/>
                                </svg>
                                <p class="text-sm text-gray-600">Fichier audio</p>
                            </div>
                        @else
                            <div class="text-center">
                                <svg class="w-16 h-16 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-sm text-gray-600">Fichier média</p>
                            </div>
                        @endif
                        <p class="text-xs text-gray-500 text-center mt-2">{{ $media->chemin }}</p>
                    </div>
                </div>

                <!-- Type de média -->
                <div data-aos="fade-up" data-aos-delay="150">
                    <label for="id_type_media" class="block text-sm font-medium text-gray-700 mb-2">
                        Type de média *
                    </label>
                    <select id="id_type_media" 
                            name="id_type_media" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300">
                        <option value="">Sélectionnez un type</option>
                        @foreach($typesMedia as $type)
                        <option value="{{ $type->id }}" {{ old('id_type_media', $media->id_type_media) == $type->id ? 'selected' : '' }}>
                            {{ $type->nom }}
                        </option>
                        @endforeach
                    </select>
                    @error('id_type_media')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contenu associé -->
                <div data-aos="fade-up" data-aos-delay="200">
                    <label for="id_contenu" class="block text-sm font-medium text-gray-700 mb-2">
                        Contenu associé *
                    </label>
                    <select id="id_contenu" 
                            name="id_contenu" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300">
                        <option value="">Sélectionnez un contenu</option>
                        @foreach($contenus as $contenu)
                        <option value="{{ $contenu->id }}" {{ old('id_contenu', $media->id_contenu) == $contenu->id ? 'selected' : '' }}>
                            {{ $contenu->titre }} ({{ $contenu->typeContenu->nom ?? 'Culture' }})
                        </option>
                        @endforeach
                    </select>
                    @error('id_contenu')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nouveau fichier (optionnel) -->
                <div data-aos="fade-up" data-aos-delay="250">
                    <label for="chemin" class="block text-sm font-medium text-gray-700 mb-2">
                        Remplacer le fichier (optionnel)
                    </label>
                    <input type="file" 
                           id="chemin" 
                           name="chemin" 
                           accept="image/*,video/*,audio/*"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-benin-green file:text-white hover:file:bg-benin-dark-green">
                    @error('chemin')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Laissez vide pour conserver le fichier actuel</p>
                </div>

                <!-- Description -->
                <div data-aos="fade-up" data-aos-delay="300">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300 resize-vertical"
                              placeholder="Décrivez brièvement ce média...">{{ old('description', $media->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New File Preview -->
                <div id="preview-container" class="hidden" data-aos="fade-up" data-aos-delay="350">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Aperçu du nouveau fichier
                    </label>
                    <div id="media-preview" class="bg-gray-100 rounded-lg p-4 text-center">
                        <!-- Preview will be inserted here -->
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row justify-between space-y-4 sm:space-y-0 sm:space-x-6 pt-6 border-t border-gray-200" data-aos="fade-up" data-aos-delay="400">
                    <div class="flex space-x-4">
                        <a href="{{ route('medias.show', $media) }}" 
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
            <form id="delete-form" action="{{ route('medias.destroy', $media) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>

    </div>
</div>

<script>
function confirmDelete() {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce média ? Cette action est irréversible.')) {
        document.getElementById('delete-form').submit();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('chemin');
    const previewContainer = document.getElementById('preview-container');
    const mediaPreview = document.getElementById('media-preview');

    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                mediaPreview.innerHTML = '';
                
                if (file.type.startsWith('image/')) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'max-w-full max-h-64 mx-auto rounded-lg';
                    img.alt = 'Aperçu';
                    mediaPreview.appendChild(img);
                } else if (file.type.startsWith('video/')) {
                    const video = document.createElement('video');
                    video.src = e.target.result;
                    video.controls = true;
                    video.className = 'max-w-full max-h-64 mx-auto rounded-lg';
                    mediaPreview.appendChild(video);
                } else if (file.type.startsWith('audio/')) {
                    const audio = document.createElement('audio');
                    audio.src = e.target.result;
                    audio.controls = true;
                    audio.className = 'w-full';
                    mediaPreview.appendChild(audio);
                } else {
                    mediaPreview.innerHTML = `
                        <div class="text-gray-500">
                            <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p>Aperçu non disponible</p>
                        </div>
                    `;
                }
                
                previewContainer.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            previewContainer.classList.add('hidden');
        }
    });
});
</script>

<style>
    input:focus, select:focus, textarea:focus {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 135, 81, 0.1);
    }
</style>
@endsection