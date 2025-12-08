@extends('layouts.app')

@section('title', 'Gestion des Médias - Culture Bénin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="text-center mb-12" data-aos="fade-down">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Gallerie <span class="text-benin-green">Médias</span>
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Gérez tous les médias associés aux contenus culturels
            </p>
        </div>

        <!-- Stats & Actions Bar -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8" data-aos="fade-up">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <div class="flex items-center space-x-6">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-benin-green">{{ $medias->count() }}</div>
                        <div class="text-sm text-gray-500">Médias</div>
                    </div>
                    <div class="hidden md:block w-px h-8 bg-gray-300"></div>
                    <div class="text-center">
                        @php
                            $imagesCount = $medias->where('typeMedia.nom', 'image')->count();
                        @endphp
                        <div class="text-2xl font-bold text-benin-yellow">{{ $imagesCount }}</div>
                        <div class="text-sm text-gray-500">Images</div>
                    </div>
                    <div class="hidden md:block w-px h-8 bg-gray-300"></div>
                    <div class="text-center">
                        @php
                            $videosCount = $medias->where('typeMedia.nom', 'vidéo')->count();
                        @endphp
                        <div class="text-2xl font-bold text-benin-red">{{ $videosCount }}</div>
                        <div class="text-sm text-gray-500">Vidéos</div>
                    </div>
                </div>
                
                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('medias.create') }}" 
                       class="bg-benin-green text-white px-6 py-3 rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium shadow-lg flex items-center justify-center">
                       <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                       </svg>
                       Nouveau Média
                    </a>
                </div>
            </div>
        </div>

        <!-- Médias Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($medias as $index => $media)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover-lift group" 
                 data-aos="fade-up" 
                 data-aos-delay="{{ ($index % 8) * 100 }}">
                
                <!-- Media Preview -->
                <div class="relative h-48 bg-gray-200 overflow-hidden">
                    @if($media->typeMedia->nom === 'image')
                        <img src="{{ asset('storage/' . $media->chemin) }}" 
                             alt="{{ $media->description ?? 'Image' }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    @elseif($media->typeMedia->nom === 'vidéo')
                        <div class="w-full h-full bg-gradient-to-br from-benin-green to-benin-red flex items-center justify-center">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @elseif($media->typeMedia->nom === 'audio')
                        <div class="w-full h-full bg-gradient-to-br from-benin-yellow to-orange-500 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 016 0v6a3 3 0 01-3 3z"/>
                            </svg>
                        </div>
                    @else
                        <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    @endif

                    <!-- Type Badge -->
                    <div class="absolute top-3 right-3">
                        <span class="bg-black/70 text-white px-2 py-1 rounded-full text-xs font-medium backdrop-blur-sm">
                            {{ $media->typeMedia->nom }}
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-4">
                    <!-- Description -->
                    @if($media->description)
                    <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-benin-green transition-colors duration-300">
                        {{ $media->description }}
                    </h3>
                    @else
                    <h3 class="font-semibold text-gray-500 mb-2 italic">
                        Sans description
                    </h3>
                    @endif

                    <!-- Contenu associé -->
                    <div class="text-sm text-gray-500 mb-3">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            {{ Str::limit($media->contenu->titre, 25) }}
                        </span>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-between pt-3 border-t border-gray-200">
                        <!-- View Link -->
                        <a href="{{ route('medias.show', $media) }}" 
                           class="text-benin-green hover:text-benin-dark-green transition-colors duration-300 font-medium flex items-center text-sm">
                           <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                           </svg>
                           Détails
                        </a>

                        <!-- Edit & Delete -->
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('medias.edit', $media) }}" 
                               class="text-blue-600 hover:text-blue-800 transition-colors duration-300 transform hover:scale-110"
                               title="Modifier">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <!-- Empty State -->
            <div class="col-span-full text-center py-16" data-aos="fade-up">
                <div class="w-24 h-24 mx-auto mb-6 bg-gray-200 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Aucun média trouvé</h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">
                    Commencez par uploader le premier média pour enrichir les contenus culturels.
                </p>
                <a href="{{ route('medias.create') }}" 
                   class="bg-benin-green text-white px-8 py-4 rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium shadow-lg inline-flex items-center">
                   <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                   </svg>
                   Uploader le premier média
                </a>
            </div>
            @endforelse
        </div>

    </div>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .hover-lift {
        transition: all 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection