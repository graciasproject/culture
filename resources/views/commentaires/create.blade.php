@extends('layouts.app')

@section('title', 'Ajouter un Commentaire - Culture Bénin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12" data-aos="fade-down">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Ajouter un <span class="text-benin-green">Commentaire</span>
            </h1>
            <p class="text-xl text-gray-600">
                Partagez votre avis sur ce contenu culturel
            </p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden" data-aos="fade-up">
            <div class="benin-gradient px-6 py-4">
                <h2 class="text-xl font-bold text-white">Nouveau commentaire</h2>
            </div>

            <form action="{{ route('commentaires.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <!-- Contenu associé -->
                <div data-aos="fade-up" data-aos-delay="100">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Contenu concerné
                    </label>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900">{{ $contenu->titre }}</h3>
                        <p class="text-sm text-gray-600 mt-1">
                            {{ Str::limit($contenu->texte, 100) }}
                        </p>
                    </div>
                    <input type="hidden" name="id_contenu" value="{{ $contenu->id }}">
                </div>

                <!-- Commentaire -->
                <div data-aos="fade-up" data-aos-delay="150">
                    <label for="texte" class="block text-sm font-medium text-gray-700 mb-2">
                        Votre commentaire *
                    </label>
                    <textarea id="texte" 
                              name="texte" 
                              required
                              rows="6"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300 resize-vertical"
                              placeholder="Partagez vos pensées, vos questions ou vos compléments d'information...">{{ old('texte') }}</textarea>
                    @error('texte')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Note (optionnelle) -->
                <div data-aos="fade-up" data-aos-delay="200">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Note (optionnelle)
                    </label>
                    <div class="flex items-center space-x-1" id="note-container">
                        @for($i = 1; $i <= 5; $i++)
                            <button type="button" 
                                    data-note="{{ $i }}"
                                    class="note-star w-- h-8 text-gray-300 hover:text-benin-yellow transition-colors duration-200">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </button>
                        @endfor
                    </div>
                    <input type="hidden" name="note" id="note" value="{{ old('note', 0) }}">
                    <p class="mt-1 text-sm text-gray-500">Cliquez sur les étoiles pour noter ce contenu</p>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row justify-between space-y-4 sm:space-y-0 sm:space-x-6 pt-6 border-t border-gray-200" data-aos="fade-up" data-aos-delay="250">
                    <a href="{{ route('contenus.show', $contenu) }}" 
                       class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-300 text-center font-medium">
                       Annuler
                    </a>
                    
                    <button type="submit" 
                            class="px-6 py-3 bg-benin-green text-white rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium shadow-lg">
                        💬 Publier le commentaire
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('.note-star');
    const noteInput = document.getElementById('note');
    let currentNote = parseInt(noteInput.value) || 0;

    stars.forEach(star => {
        star.addEventListener('click', function() {
            const note = parseInt(this.getAttribute('data-note'));
            currentNote = note;
            noteInput.value = note;
            
            // Update stars appearance
            stars.forEach((s, index) => {
                const starNote = index + 1;
                if (starNote <= note) {
                    s.classList.remove('text-gray-300');
                    s.classList.add('text-benin-yellow');
                } else {
                    s.classList.remove('text-benin-yellow');
                    s.classList.add('text-gray-300');
                }
            });
        });

        star.addEventListener('mouseenter', function() {
            const hoverNote = parseInt(this.getAttribute('data-note'));
            stars.forEach((s, index) => {
                const starNote = index + 1;
                if (starNote <= hoverNote) {
                    s.classList.add('text-benin-yellow');
                }
            });
        });

        star.addEventListener('mouseleave', function() {
            stars.forEach((s, index) => {
                const starNote = index + 1;
                if (starNote > currentNote) {
                    s.classList.remove('text-benin-yellow');
                    s.classList.add('text-gray-300');
                }
            });
        });
    });
});
</script>

<style>
    textarea:focus {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 135, 81, 0.1);
    }
    
    .note-star {
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .note-star:hover {
        transform: scale(1.2);
    }
</style>
@endsection