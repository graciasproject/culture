@extends('layouts.app')

@section('title', 'Langues du Bénin - Culture Bénin')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollToPlugin.min.js"></script>

    <!-- CONTENEUR GLOBAL -->
    <div class="relative w-full h-screen bg-[#050505] text-white overflow-hidden font-sans">

        <!-- 1. BACKGROUND VIDEO (Fixe) -->
        <div class="fixed inset-0 z-0">
            <video autoplay loop muted playsinline class="absolute top-0 left-0 w-full h-full object-cover opacity-30">
                <source src="{{ asset('bg.mp4') }}" type="video/mp4">
            </video>
            <!-- Overlay uniforme -->
            <div class="absolute inset-0 bg-black/60"></div>
        </div>

        <!-- 2. CONTENU PRINCIPAL -->
        <div class="relative z-10 flex flex-col justify-center h-full w-full pt-28 pb-2">

            <!-- Titre -->
            <div class="px-8 md:px-16 mb-4" data-aos="fade-right">
                <div class="pl-6 border-l-4 border-benin-yellow">
                    <h2 class="text-benin-green font-bold tracking-widest text-sm uppercase mb-2">Patrimoine Linguistique
                    </h2>
                    <h1 class="text-4xl md:text-6xl font-[Oswald] font-bold text-white leading-tight mb-2">
                        LES LANGUES <br>
                        <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-[#008751] via-[#FCD116] to-[#E8112D]">
                            DU BÉNIN
                        </span>
                    </h1>
                    <p class="text-gray-300 max-w-xl text-base font-light">
                        {{ $langues->count() }} langues répertoriées. Découvrez la diversité orale qui unit notre peuple.
                    </p>
                </div>
            </div>

            <!-- 3. SLIDER HORIZONTAL -->
            <div class="relative w-full group">

                <!-- Bouton Gauche -->
                <button id="slideLeft"
                    class="absolute left-4 top-1/2 -translate-y-1/2 z-50 w-12 h-12 bg-black/80 hover:bg-benin-green rounded-full flex items-center justify-center transition-all duration-300 border border-white/20 shadow-2xl cursor-pointer">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <!-- TRACK -->
                <div id="languesTrack"
                    class="flex gap-5 overflow-x-auto overflow-y-visible py-6 px-8 md:px-16 cursor-grab active:cursor-grabbing scroll-smooth hide-scrollbar items-center w-full">

                    @foreach ($langues as $index => $langue)
                        @php
                            // MODIFICATION ICI : Utilisation des images locales cycliques (1 à 20)
                            // au lieu du tableau $textures
                            $imgNum = ($index % 20) + 1;
                            $bgImage = asset("region{$imgNum}.jpeg");
                        @endphp

                        <!-- CARTE LANGUE -->
                        <a href="{{ route('langues.show', $langue) }}"
                            class="langue-card relative flex-shrink-0 w-[160px] h-[260px] md:w-[200px] md:h-[320px] rounded-xl overflow-hidden cursor-pointer transition-all duration-300 ease-out border border-white/10 hover:border-benin-green hover:scale-105 shadow-2xl bg-gray-900 group/card">

                            <!-- Image de fond (Texture) -->
                            <div class="absolute inset-0 w-full h-full bg-gray-800">
                                <img src="{{ $bgImage }}" alt="Texture {{ $langue->nom_langue }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover/card:scale-110 opacity-60 group-hover/card:opacity-100"
                                    loading="lazy" onerror="this.style.display='none';">
                            </div>

                            <!-- Gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>

                            <!-- Badge Code (Haut Droite) -->
                            <div class="absolute top-3 right-3">
                                <span
                                    class="bg-white/10 backdrop-blur-md border border-white/20 text-white font-mono text-xs font-bold px-2 py-1 rounded">
                                    {{ strtoupper($langue->code_langue) }}
                                </span>
                            </div>

                            <!-- Contenu Texte (Bas) -->
                            <div class="absolute bottom-0 left-0 w-full p-5">
                                <h3
                                    class="font-[Oswald] font-bold text-2xl md:text-3xl text-white leading-none mb-1 shadow-black drop-shadow-md">
                                    {{ Str::limit($langue->nom_langue, 12) }}
                                </h3>

                                <div
                                    class="w-8 h-1 bg-[#FCD116] rounded-full group-hover/card:w-16 transition-all duration-300 mb-3">
                                </div>

                                <!-- Stats -->
                                <div class="flex items-center space-x-3 text-xs text-gray-300 font-mono">
                                    <div class="flex items-center">
                                        <svg class="w-3 h-3 mr-1 text-benin-green" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                        </svg>
                                        {{ $langue->users_count ?? 0 }}
                                    </div>
                                    <div class="flex items-center">
                                        <svg class="w-3 h-3 mr-1 text-benin-red" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                        {{ $langue->contenus_count ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach

                    <div class="flex-shrink-0 w-8"></div>
                </div>

                <!-- Bouton Droite -->
                <button id="slideRight"
                    class="absolute right-4 top-1/2 -translate-y-1/2 z-50 w-12 h-12 bg-black/80 hover:bg-benin-green rounded-full flex items-center justify-center transition-all duration-300 border border-white/20 shadow-2xl cursor-pointer">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

            </div>

            <!-- BARRE DE PROGRESSION -->
            <div class="flex justify-center mt-2 pb-2">
                <div class="w-64 h-1.5 bg-white/20 rounded-full overflow-hidden">
                    <div id="scrollProgress"
                        class="h-full bg-gradient-to-r from-[#008751] via-[#FCD116] to-[#E8112D] w-0 transition-all duration-100 ease-out">
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const track = document.getElementById('languesTrack');
            const btnLeft = document.getElementById('slideLeft');
            const btnRight = document.getElementById('slideRight');
            const progressBar = document.getElementById('scrollProgress');

            // --- FONCTION DE MISE À JOUR DE LA BARRE ---
            const updateProgress = () => {
                const maxScroll = track.scrollWidth - track.clientWidth;
                if (maxScroll > 0) {
                    const percent = (track.scrollLeft / maxScroll) * 100;
                    const safePercent = Math.min(Math.max(percent, 0), 100);
                    progressBar.style.width = safePercent + '%';
                }
            };

            track.addEventListener('scroll', updateProgress);
            updateProgress();
            window.addEventListener('resize', updateProgress);

            btnRight.addEventListener('click', () => {
                track.scrollBy({
                    left: 300,
                    behavior: 'smooth'
                });
            });

            btnLeft.addEventListener('click', () => {
                track.scrollBy({
                    left: -300,
                    behavior: 'smooth'
                });
            });

            // Drag to Scroll
            let isDown = false;
            let startX;
            let scrollLeft;

            track.addEventListener('mousedown', (e) => {
                isDown = true;
                track.classList.add('cursor-grabbing');
                startX = e.pageX - track.offsetLeft;
                scrollLeft = track.scrollLeft;
            });
            track.addEventListener('mouseleave', () => {
                isDown = false;
                track.classList.remove('cursor-grabbing');
            });
            track.addEventListener('mouseup', () => {
                isDown = false;
                track.classList.remove('cursor-grabbing');
            });
            track.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - track.offsetLeft;
                const walk = (x - startX) * 2;
                track.scrollLeft = scrollLeft - walk;
            });
        });
    </script>

    <style>
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .langue-card {
            will-change: transform;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            transform: translateZ(0);
        }
    </style>
@endsection
