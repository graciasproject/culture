@extends('layouts.app')

@section('title', 'Exploration des Territoires - Culture Bénin')

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
        <!-- Padding ajusté pour l'équilibre vertical -->
        <div class="relative z-10 flex flex-col justify-center h-full w-full pt-28 pb-2">

            <!-- Titre -->
            <div class="px-8 md:px-16 mb-4" data-aos="fade-right">
                <div class="pl-6 border-l-4 border-benin-yellow">
                    <h2 class="text-benin-green font-bold tracking-widest text-sm uppercase mb-2">Destination Culture</h2>
                    <h1 class="text-4xl md:text-6xl font-[Oswald] font-bold text-white leading-tight mb-2">
                        EXPLOREZ LES <br>
                        <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-[#008751] via-[#FCD116] to-[#E8112D]">
                            77 COMMUNES
                        </span>
                    </h1>
                    <p class="text-gray-300 max-w-xl text-base font-light">
                        Parcourez le Bénin du Nord au Sud.
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
                <!-- MODIFICATION : Padding vertical réduit (py-6) -->
                <div id="regionsTrack"
                    class="flex gap-5 overflow-x-auto overflow-y-visible py-6 px-8 md:px-16 cursor-grab active:cursor-grabbing scroll-smooth hide-scrollbar items-center w-full">

                    @foreach ($regions as $index => $region)
                        @php
                            $imgNum = ($index % 20) + 1;
                            $localImage = asset("region{$imgNum}.jpeg");
                            $bgImage = $region->image ? asset('storage/' . $region->image) : $localImage;
                        @endphp

                        <!-- CARTE -->
                        <!-- MODIFICATION : Dimensions réduites pour éviter le dézoom -->
                        <!-- Mobile: w-[160px] h-[260px] | Desktop: w-[200px] h-[320px] -->
                        <a href="{{ route('regions.show', $region) }}"
                            class="region-card relative flex-shrink-0 w-[160px] h-[260px] md:w-[200px] md:h-[320px] rounded-xl overflow-hidden cursor-pointer transition-all duration-300 ease-out border border-white/10 hover:border-benin-green hover:scale-105 shadow-2xl bg-gray-900 group/card">

                            <div class="absolute inset-0 w-full h-full bg-gray-800">
                                <img src="{{ $bgImage }}" alt="{{ $region->nom_region }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover/card:scale-110 transform-gpu"
                                    loading="lazy" onerror="this.style.display='none';">
                            </div>

                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-90">
                            </div>

                            <div class="absolute bottom-0 left-0 w-full p-4">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-[#FCD116] mb-1 block">
                                    {{ $region->localisation ?? 'Bénin' }}
                                </span>
                                <h3
                                    class="font-[Oswald] font-bold text-xl md:text-2xl text-white leading-none mb-2 shadow-black drop-shadow-md">
                                    {{ Str::limit($region->nom_region, 15) }}
                                </h3>
                                <div
                                    class="w-8 h-1 bg-[#008751] rounded-full group-hover/card:w-16 transition-all duration-300">
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
            <!-- mt-2 conservé, position parfaite sous les cartes réduites -->
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
            const track = document.getElementById('regionsTrack');
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

        .region-card {
            will-change: transform;
            /* Hacks pour la netteté et performance */
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            transform: translateZ(0);
            -webkit-font-smoothing: antialiased;
        }

        /* Pour s'assurer que l'image ne bave pas lors du scale */
        .region-card img {
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            transform: translateZ(0);
        }
    </style>
@endsection
