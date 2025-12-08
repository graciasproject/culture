@extends('layouts.app')

@section('title', 'Détail du Média - Culture Bénin')

@section('content')
<div class="min-h-screen bg-white">
    <!-- Hero Section -->
    <section class="benin-gradient text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-black/40"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6 text-glow" data-aos="fade-up">
                Média
            </h1>
            
            <!-- Metadata -->
            <div class="flex flex-wrap justify-center items-center gap-6 text-sm mb-8" data-aos="fade-up" data-aos-delay="200">
                <!-- Type -->
                <div class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>{{ $media->typeMedia->nom }}</span>
                </div>
                
                <!-- Date -->
                <div class="flex items-center space-x-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>{{ $media->created_at->translatedFormat('d F Y') }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="max-w-6xl mx-auto px-4 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <article class="lg:col-span-3" data-aos="fade-up">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <!-- Media Display -->
                    <div class="mb-8">
                        @if($media->typeMedia->nom === 'image')
                            <img src="{{ asset('storage/' . $media->chemin) }}" 
                                 alt="{{ $media->description ?? 'Image' }}"
                                 class="w-full max-w-2xl mx-auto rounded-2xl shadow-lg">
                        @elseif($media->typeMedia->nom === 'vidéo')
                            <div class="bg-gray-900 rounded-2xl p-8 text-center">
                                <video controls class="w-full max-w-2xl mx-auto rounded-lg">
                                    <source src="{{ asset('storage/' . $media->chemin) }}" type="video/mp4">
                                    Votre navigateur ne supporte pas la lecture vidéo.
                                </video>
                            </div>
                        @elseif($media->typeMedia->nom === 'audio')
                            <div class="bg-gray-100 rounded-2xl p-8">
                                <div class="max-w-md mx-auto">
                                    <div class="flex items-center justify-center mb-4">
                                        <svg class="w-16 h-16 text-benin-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 016 0v6a3 3 0 01-3 3z"/>
                                        </svg>
                                    </div>
                                    <audio controls class="w-full">
                                        <source src="{{ asset('storage/' . $media->chemin) }}" type="audio/mpeg">
                                        Votre navigateur ne supporte pas la lecture audio.
                                    </audio>
                                </div>
                            </div>
                        @else
                            <div class="bg-gray-100 rounded-2xl p-12 text-center">
                                <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-gray-500">Aperçu non disponible pour ce type de fichier</p>
                            </div>
                        @endif
                    </div>

                    <!-- Description -->
                    @if($media->description)
                    <div class="prose prose-lg max-w-none">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Description</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $media->description }}</p>
                    </div>
                    @endif

                    <!-- Informations techniques -->
                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Informations techniques</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Type de fichier:</span>
                                <span class="font-medium text-gray-900">{{ $media->typeMedia->nom }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Chemin:</span>
                                <span class="font-medium text-gray-900 text-xs truncate max-w-xs">{{ $media->chemin }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Uploadé le:</span>
                                <span class="font-medium text-gray-900">{{ $media->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Modifié le:</span>
                                <span class="font-medium text-gray-900">{{ $media->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Sidebar -->
            <aside class="lg:col-span-1 space-y-6" data-aos="fade-left" data-aos-delay="300">
                <!-- Actions Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('medias.edit', $media) }}" 
                           class="w-full flex items-center justify-center space-x-2 bg-benin-green text-white px-4 py-3 rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium">
                           <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                           </svg>
                           <span>Modifier</span>
                        </a>
                        
                        <a href="{{ route('contenus.show', $media->contenu) }}" 
                           class="w-full flex items-center justify-center space-x-2 border border-benin-green text-benin-green px-4 py-3 rounded-lg hover:bg-benin-green hover:text-white transition-all duration-300 font-medium">
                           <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                           </svg>
                           <span>Voir le contenu</span>
                        </a>

                        <a href="{{ route('medias.index') }}" 
                           class="w-full flex items-center justify-center space-x-2 border border-gray-300 text-gray-700 px-4 py-3 rounded-lg hover:bg-gray-50 transition-all duration-300 font-medium">
                           <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                           </svg>
                           <span>Retour à la liste</span>
                        </a>
                    </div>
                </div>

                <!-- Contenu associé -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Contenu associé</h3>
                    <a href="{{ route('contenus.show', $media->contenu) }}" 
                       class="block p-4 rounded-lg border border-gray-200 hover:border-benin-green hover:bg-gray-50 transition-all duration-300 group">
                        <h4 class="font-semibold text-gray-900 group-hover:text-benin-green transition-colors duration-300 line-clamp-2">
                            {{ $media->contenu->titre }}
                        </h4>
                        <div class="flex items-center space-x-2 mt-2 text-sm text-gray-500">
                            <span class="bg-gray-100 px-2 py-1 rounded">
                                {{ $media->contenu->typeContenu->nom ?? 'Culture' }}
                            </span>
                            <span>{{ $media->contenu->region->nom_region ?? 'Bénin' }}</span>
                        </div>
                    </a>
                </div>

                <!-- Téléchargement -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Téléchargement</h3>
                    <a href="{{ asset('storage/' . $media->chemin) }}" 
                       download
                       class="w-full flex items-center justify-center space-x-2 bg-benin-yellow text-gray-900 px-4 py-3 rounded-lg hover:bg-yellow-500 transition-all duration-300 transform hover:scale-105 font-medium">
                       <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                       </svg>
                       <span>Télécharger</span>
                    </a>
                </div>
            </aside>
        </div>
    </section>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection