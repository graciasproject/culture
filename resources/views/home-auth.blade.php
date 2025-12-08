@extends('layouts.app')

@section('title', 'Ma Médiathèque')

@section('content')
    <div class="bg-[#0b0b0b] min-h-screen text-white font-sans selection:bg-benin-green selection:text-white pb-12">

        @if ($spotlight)
            @php
                // CORRECTION MAPPING : ID 1 -> Index 0 (img1)
                $sIdx = ($spotlight->id - 1) % 4;
                $localImages = ['img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg'];
                $cover = $spotlight->image_couverture
                    ? asset('storage/' . $spotlight->image_couverture)
                    : asset($localImages[$sIdx]);
            @endphp

            <div class="relative w-full min-h-[70vh] flex items-end pb-16 group overflow-hidden">

                <div class="absolute inset-0 z-0">
                    <img src="{{ $cover }}" class="w-full h-full object-cover opacity-60">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0b0b0b] via-[#0b0b0b]/80 to-transparent"></div>
                    <div class="absolute inset-0 bg-gradient-to-r from-[#0b0b0b]/90 via-transparent to-transparent"></div>
                </div>

                <div class="relative z-10 px-6 md:px-12 w-full max-w-4xl">
                    <div class="flex items-center space-x-3 mb-4 animate-fade-in-up">
                        <span
                            class="bg-benin-red text-white text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-widest border border-white/10">
                            Nouveauté
                        </span>
                        <span class="text-benin-yellow font-bold tracking-widest text-xs uppercase flex items-center">
                            <span class="w-1.5 h-1.5 bg-benin-yellow rounded-full mr-2"></span>
                            {{ $spotlight->region->nom_region ?? 'Bénin' }}
                        </span>
                    </div>

                    <h1
                        class="text-4xl md:text-5xl lg:text-6xl font-[Oswald] font-bold leading-tight mb-4 text-white drop-shadow-2xl max-w-2xl">
                        {{ $spotlight->titre }}
                    </h1>

                    <p class="text-gray-300 text-sm md:text-base mb-8 line-clamp-2 max-w-xl font-light leading-relaxed">
                        {{ $spotlight->resume ?? Str::limit($spotlight->texte, 180) }}
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('contenus.show', $spotlight->id) }}"
                            class="px-8 py-3 bg-white text-black hover:bg-benin-yellow font-bold text-sm rounded flex items-center transition transform hover:scale-105 shadow-lg shadow-white/10">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" />
                            </svg>
                            Lecture
                        </a>
                        <a href="#catalogue"
                            class="px-8 py-3 bg-white/10 hover:bg-white/20 text-white font-bold text-sm rounded flex items-center backdrop-blur-md border border-white/10 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Explorer
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <div class="px-6 md:px-12 mt-8 space-y-16">

            @if (isset($myLibrary) && $myLibrary->count() > 0)
                <div>
                    <h2 class="text-xl font-[Oswald] font-medium mb-4 text-white flex items-center">
                        <span class="w-1 h-5 bg-benin-green mr-3"></span>
                        Ma Bibliothèque <span
                            class="ml-3 text-[10px] font-sans text-gray-400 bg-gray-800 px-2 py-0.5 rounded-full">{{ $myLibrary->count() }}</span>
                    </h2>

                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                        @foreach ($myLibrary as $item)
                            @php
                                $localImages = ['img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg'];
                                // CORRECTION MAPPING : Basé sur l'ID du contenu, pas la boucle
$idx = ($item->id - 1) % 4;
$thumb = $item->image_couverture
    ? asset('storage/' . $item->image_couverture)
                                    : asset($localImages[$idx]);
                            @endphp
                            <a href="{{ route('contenus.show', $item->id) }}"
                                class="group relative aspect-[2/3] bg-gray-900 rounded-lg overflow-hidden cursor-pointer transition-all duration-300 hover:scale-105 hover:shadow-2xl ring-1 ring-white/10 hover:ring-benin-green">
                                <img src="{{ $thumb }}"
                                    class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition duration-500">
                                <div
                                    class="absolute top-2 right-2 bg-benin-green text-white text-[8px] font-bold px-1.5 py-0.5 rounded uppercase">
                                    Acquis</div>
                                <div
                                    class="absolute bottom-0 left-0 w-full p-3 bg-gradient-to-t from-black via-black/80 to-transparent">
                                    <h3 class="font-bold text-xs text-gray-100 leading-tight line-clamp-2">
                                        {{ $item->titre }}</h3>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <div id="catalogue">
                <h2 class="text-xl font-[Oswald] font-medium mb-4 text-white flex items-center">
                    <span class="w-1 h-5 bg-benin-yellow mr-3"></span>
                    Catalogue Général
                </h2>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-x-4 gap-y-8">
                    @foreach ($catalog as $item)
                        @php
                            // CORRECTION MAPPING : Basé sur l'ID du contenu
$localImages = ['img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg'];
$idx = ($item->id - 1) % 4;
$thumb = $item->image_couverture
    ? asset('storage/' . $item->image_couverture)
                                : asset($localImages[$idx]);
                        @endphp
                        <a href="{{ route('contenus.show', $item->id) }}" class="group block relative w-full">
                            <div
                                class="aspect-video w-full rounded-lg overflow-hidden bg-gray-800 relative mb-2 ring-1 ring-white/10 group-hover:ring-white/30 transition-all duration-300">
                                <img src="{{ $thumb }}"
                                    class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                                <div
                                    class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                    <div
                                        class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white ml-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="absolute top-2 left-2">
                                    <span
                                        class="bg-black/60 backdrop-blur-md text-gray-300 text-[9px] font-bold px-2 py-0.5 rounded border border-white/10 uppercase">
                                        {{ $item->region->nom_region ?? 'Bénin' }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <h3
                                    class="font-bold text-sm text-gray-300 group-hover:text-white transition leading-tight mb-1 line-clamp-1">
                                    {{ $item->titre }}
                                </h3>
                                <p class="text-[10px] text-gray-500 uppercase tracking-wide">
                                    {{ $item->typeContenu->nom ?? 'Culture' }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="border-t border-white/10 pt-12 mt-12">
                <div
                    class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-2xl p-8 flex flex-col md:flex-row items-center justify-between shadow-2xl border border-white/5">
                    <div class="flex items-center space-x-6 mb-6 md:mb-0">
                        <div
                            class="w-20 h-20 rounded-full bg-gradient-to-br from-benin-green to-teal-800 flex items-center justify-center text-2xl font-bold text-white shadow-lg border-4 border-[#0b0b0b]">
                            {{ substr(Auth::user()->prenom, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-2xl font-[Oswald] font-bold text-white mb-1">Mon Espace Personnel</h3>
                            <p class="text-gray-400 text-sm">Gérez vos préférences, votre abonnement et vos informations.
                            </p>
                            <div class="mt-2 flex space-x-4 text-xs text-gray-500">
                                <span>{{ Auth::user()->email }}</span>
                                <span class="text-benin-green">• Compte Actif</span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('profile.edit') }}"
                        class="group px-8 py-3 bg-white/5 hover:bg-white/10 border border-white/10 hover:border-white/30 rounded-full text-white font-bold transition flex items-center">
                        Accéder à mon profil
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
