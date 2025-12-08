@extends('layouts.app')

@section('title', $langue->nom_langue . ' - Culture Bénin')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollToPlugin.min.js"></script>

    <!-- CONTENEUR GLOBAL -->
    <div class="relative w-full min-h-screen bg-[#050505] text-white overflow-x-hidden font-sans">

        <!-- 1. BACKGROUND IMAGE (Fixe) -->
        @php
            // Image de fond globale : On garde une image de région pour l'ambiance générale
            // On boucle sur les 20 images de régions disponibles
            $bgIndex = $langue->id % 20;
            if ($bgIndex == 0) {
                $bgIndex = 20;
            }
            $heroImage = asset("region{$bgIndex}.jpeg");
        @endphp

        <div class="fixed inset-0 z-0">
            <!-- Image de fond -->
            <div class="absolute inset-0 w-full h-full bg-cover bg-center transition-opacity duration-1000"
                style="background-image: url('{{ $heroImage }}'); opacity: 0.4;">
            </div>
            <!-- Fond noir pour boucher les trous -->
            <div class="absolute inset-0 bg-[#050505] -z-10"></div>
            <!-- Dégradé vertical léger pour l'ambiance -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/40 to-[#050505]"></div>
        </div>

        <!-- 2. CONTENU PRINCIPAL -->
        <div class="relative z-10 flex flex-col justify-center w-full pt-32 pb-20">

            <!-- EN-TÊTE : INFOS LANGUE -->
            <div class="px-8 md:px-16 mb-12" data-aos="fade-right">
                <div class="pl-6 border-l-4 border-benin-yellow">
                    <div class="flex items-center space-x-3 mb-2">
                        <h2 class="text-benin-green font-bold tracking-widest text-sm uppercase">Langue du Bénin</h2>
                        <span
                            class="px-2 py-0.5 rounded bg-white/10 text-[10px] text-gray-300 border border-white/10 font-mono">
                            CODE: {{ strtoupper($langue->code_langue) }}
                        </span>
                    </div>

                    <h1
                        class="text-5xl md:text-7xl font-[Oswald] font-bold text-white leading-tight mb-4 uppercase drop-shadow-lg">
                        {{ $langue->nom_langue }}
                    </h1>

                    <p class="text-gray-300 max-w-3xl text-lg font-light leading-relaxed">
                        {{ $langue->description ?? 'Une langue riche en histoire, vecteur de traditions orales et de savoirs ancestraux.' }}
                    </p>

                    <!-- Stats -->
                    <div class="flex flex-wrap gap-8 mt-6 text-sm font-mono text-gray-400">
                        <div>
                            <span
                                class="text-benin-yellow block text-2xl font-bold">{{ number_format($langue->users_count ?? 0, 0, ',', ' ') }}</span>
                            <span>LOCUTEURS</span>
                        </div>
                        <div>
                            <span class="text-white block text-2xl font-bold">{{ $langue->contenus_count ?? 0 }}</span>
                            <span>RÉCITS</span>
                        </div>
                        <div>
                            <span class="text-benin-red block text-2xl font-bold">{{ $langue->regions->count() }}</span>
                            <span>RÉGIONS</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. SECTION 1 : CONTENUS (RÉCITS) -->
            @if ($langue->contenus->count() > 0)
                <div class="mb-16">
                    <div class="px-8 md:px-16 mb-4 flex items-end justify-between">
                        <h3 class="text-2xl font-[Oswald] text-white">Récits en <span
                                class="text-benin-green">{{ $langue->nom_langue }}</span></h3>
                        <!-- Barre de progression -->
                        <div class="hidden md:block w-32 h-1 bg-gray-700 rounded-full overflow-hidden">
                            <div id="prog-content" class="h-full bg-benin-green w-0 transition-all duration-100"></div>
                        </div>
                    </div>

                    <div class="relative w-full group">
                        <!-- Track Contenus -->
                        <div id="track-content"
                            class="flex gap-5 overflow-x-auto overflow-y-visible py-4 px-8 md:px-16 cursor-grab active:cursor-grabbing scroll-smooth hide-scrollbar items-center w-full">
                            @foreach ($langue->contenus as $contenu)
                                @php
                                    // --- MAPPING CONTENU -> IMAGE ---
                                    // Formule : (ID - 1) % 4 + 1  => Donne toujours 1, 2, 3 ou 4
                                    // ID 1 -> img1.jpg
                                    // ID 2 -> img2.jpg ...
                                    // ID 5 -> img1.jpg
                                    $imgIndex = (($contenu->id - 1) % 4) + 1;
                                    $localImage = asset("img{$imgIndex}.jpg");

                                    // Si admin a uploadé, on prend. Sinon on prend le mapping local.
                                    $bgC = $contenu->image_couverture
                                        ? asset('storage/' . $contenu->image_couverture)
                                        : $localImage;
                                @endphp

                                <a href="{{ route('contenus.show', $contenu) }}"
                                    class="content-card relative flex-shrink-0 w-[200px] h-[320px] rounded-xl overflow-hidden cursor-pointer transition-all duration-300 ease-out border border-white/10 hover:border-benin-yellow hover:scale-105 shadow-2xl bg-gray-900 group/card">

                                    <!-- Image : Opacité 100% (Claire et Nette) -->
                                    <div class="absolute inset-0 w-full h-full bg-gray-800">
                                        <img src="{{ $bgC }}" alt="{{ $contenu->titre }}"
                                            class="w-full h-full object-cover transition-transform duration-700 group-hover/card:scale-110"
                                            loading="lazy"
                                            onerror="this.style.display='none'; this.parentElement.style.backgroundColor='#2d3748';">
                                    </div>

                                    <!-- Dégradé : Uniquement en bas pour le texte -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-transparent to-transparent opacity-90">
                                    </div>

                                    <!-- Contenu Texte -->
                                    <div class="absolute bottom-0 left-0 w-full p-5 z-20">
                                        <span
                                            class="text-[10px] font-bold uppercase text-benin-yellow mb-1 block tracking-wider shadow-black drop-shadow-md">
                                            {{ $contenu->typeContenu->nom ?? 'CULTURE' }}
                                        </span>

                                        <h3
                                            class="font-[Oswald] font-bold text-xl text-white leading-tight mb-3 line-clamp-2 drop-shadow-md">
                                            {{ $contenu->titre }}
                                        </h3>

                                        <div
                                            class="w-8 h-1 bg-benin-yellow rounded-full group-hover/card:w-16 transition-all duration-300 shadow-sm">
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            <div class="flex-shrink-0 w-8"></div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- 4. SECTION 2 : RÉGIONS (TERRITOIRES) -->
            @if ($langue->regions->count() > 0)
                <div>
                    <div class="px-8 md:px-16 mb-4 flex items-end justify-between">
                        <h3 class="text-2xl font-[Oswald] text-white">Territoires associés</h3>
                        <!-- Barre de progression -->
                        <div class="hidden md:block w-32 h-1 bg-gray-700 rounded-full overflow-hidden">
                            <div id="prog-region" class="h-full bg-benin-red w-0 transition-all duration-100"></div>
                        </div>
                    </div>

                    <div class="relative w-full group">
                        <!-- Track Régions -->
                        <div id="track-region"
                            class="flex gap-5 overflow-x-auto overflow-y-visible py-4 px-8 md:px-16 cursor-grab active:cursor-grabbing scroll-smooth hide-scrollbar items-center w-full">
                            @foreach ($langue->regions as $region)
                                @php
                                    // Mapping Régions (region1.jpeg ... region20.jpeg)
                                    $rImgNum = ($region->id % 20) + 1;
                                    $rBg = $region->image
                                        ? asset('storage/' . $region->image)
                                        : asset("region{$rImgNum}.jpeg");
                                @endphp
                                <a href="{{ route('regions.show', $region) }}"
                                    class="region-card relative flex-shrink-0 w-[160px] h-[240px] rounded-xl overflow-hidden cursor-pointer transition-all duration-300 ease-out border border-white/10 hover:border-benin-red hover:scale-105 shadow-2xl bg-gray-900 group/card">

                                    <div class="absolute inset-0 w-full h-full bg-gray-800">
                                        <img src="{{ $rBg }}"
                                            class="w-full h-full object-cover transition-transform duration-700 group-hover/card:scale-110"
                                            loading="lazy">
                                    </div>

                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-80">
                                    </div>

                                    <div class="absolute bottom-0 left-0 w-full p-4 z-20">
                                        <span
                                            class="text-[10px] font-bold uppercase text-benin-yellow mb-1 block tracking-wider drop-shadow-md">{{ $region->localisation ?? 'Bénin' }}</span>
                                        <h3
                                            class="font-[Oswald] font-bold text-lg text-white leading-none mb-1 drop-shadow-md">
                                            {{ Str::limit($region->nom_region, 15) }}</h3>
                                    </div>
                                </a>
                            @endforeach
                            <div class="flex-shrink-0 w-8"></div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Empty State global -->
            @if ($langue->contenus->count() == 0 && $langue->regions->count() == 0)
                <div
                    class="px-16 py-10 text-gray-400 italic border border-white/10 rounded-xl mx-16 bg-white/5 backdrop-blur-sm">
                    Aucune donnée associée pour le moment.
                </div>
            @endif

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const enableDragScroll = (trackId, progressId) => {
                const track = document.getElementById(trackId);
                const progress = document.getElementById(progressId);
                if (!track) return;

                let isDown = false;
                let startX;
                let scrollLeft;

                const updateBar = () => {
                    if (!progress) return;
                    const max = track.scrollWidth - track.clientWidth;
                    if (max > 0) {
                        const pct = (track.scrollLeft / max) * 100;
                        progress.style.width = Math.min(pct, 100) + '%';
                    } else {
                        progress.style.width = '100%';
                    }
                };

                track.addEventListener('scroll', updateBar);
                updateBar();
                window.addEventListener('resize', updateBar);

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
            };

            enableDragScroll('track-content', 'prog-content');
            enableDragScroll('track-region', 'prog-region');

            gsap.from(".content-card, .region-card", {
                y: 50,
                opacity: 1,
                duration: 0.8,
                stagger: 0.05,
                ease: "power2.out",
                delay: 0.2
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

        .content-card,
        .region-card {
            will-change: transform;
        }
    </style>
@endsection
