@extends('layouts.app')

@section('title', $region->nom_region . ' - Culture Bénin')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollToPlugin.min.js"></script>

    <div class="relative w-full h-screen bg-[#050505] text-white overflow-hidden font-sans">

        @php
            $imgNum = $region->id % 20;
            if ($imgNum == 0) {
                $imgNum = 20;
            }

            $localImage = asset("region{$imgNum}.jpeg");
            $heroImage = $region->image ? asset('storage/' . $region->image) : $localImage;
        @endphp

        <div class="fixed inset-0 z-0">
            <div class="absolute inset-0 w-full h-full bg-cover bg-center transition-opacity duration-1000"
                style="background-image: url('{{ $heroImage }}'); opacity: 0.4;">
            </div>
            <div class="absolute inset-0 bg-[#050505] -z-10"></div>
            <div class="absolute inset-0 bg-black/60"></div>
        </div>

        <div class="relative z-10 flex flex-col justify-center h-full w-full pt-28 pb-2">

            <div class="px-8 md:px-16 mb-4" data-aos="fade-right">
                <div class="pl-6 border-l-4 border-benin-yellow">
                    <div class="flex items-center space-x-3 mb-2">
                        <h2 class="text-benin-green font-bold tracking-widest text-sm uppercase">Région du Bénin</h2>
                        <span class="px-2 py-0.5 rounded bg-white/10 text-[10px] text-gray-300 border border-white/10">
                            {{ $region->localisation ?? 'Localisation inconnue' }}
                        </span>
                    </div>

                    <h1 class="text-4xl md:text-6xl font-[Oswald] font-bold text-white leading-tight mb-2 uppercase">
                        {{ $region->nom_region }}
                    </h1>

                    <p class="text-gray-300 max-w-2xl text-base font-light line-clamp-2">
                        {{ $region->description ?? 'Découvrez les richesses culturelles et historiques de cette région.' }}
                    </p>

                    <div class="flex space-x-6 mt-4 text-xs font-mono text-gray-400">
                        @if ($region->population)
                            <div>
                                <span
                                    class="text-benin-yellow block text-lg font-bold">{{ number_format($region->population, 0, ',', ' ') }}</span>
                                <span>HABITANTS</span>
                            </div>
                        @endif
                        @if ($region->superficie)
                            <div>
                                <span
                                    class="text-benin-green block text-lg font-bold">{{ number_format($region->superficie, 0, ',', ' ') }}</span>
                                <span>KM²</span>
                            </div>
                        @endif
                        <div>
                            <span class="text-white block text-lg font-bold">{{ $contenus->total() }}</span>
                            <span>RÉCITS</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative w-full group">

                <div id="contentTrack"
                    class="flex gap-5 overflow-x-auto overflow-y-visible py-6 px-8 md:px-16 cursor-grab active:cursor-grabbing scroll-smooth hide-scrollbar items-center w-full">

                    @forelse ($contenus as $contenu)
                        @php
                            $localImages = ['img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg'];
                            // Correction : On soustrait 1 pour que ID 1 -> index 0 (img1)
                            $idx = ($contenu->id - 1) % 4;
                            $bgImage = $contenu->image_couverture
                                ? asset('storage/' . $contenu->image_couverture)
                                : asset($localImages[$idx]);
                        @endphp

                        <a href="{{ route('contenus.show', $contenu) }}"
                            class="region-card relative flex-shrink-0 w-[160px] h-[260px] md:w-[200px] md:h-[320px] rounded-xl overflow-hidden cursor-pointer transition-all duration-300 ease-out border border-white/10 hover:border-benin-yellow hover:scale-105 shadow-2xl bg-gray-900 group/card">

                            <div class="absolute inset-0 w-full h-full bg-gray-800">
                                <img src="{{ $bgImage }}" alt="{{ $contenu->titre }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover/card:scale-110"
                                    loading="lazy" onerror="this.style.display='none';">
                            </div>

                            <div class="absolute top-3 right-3 z-10 flex flex-col items-end gap-1">
                                @if ($contenu->is_premium)
                                    <span
                                        class="bg-benin-yellow text-black text-[9px] font-bold px-1.5 py-0.5 rounded">PREMIUM</span>
                                @endif
                                <span
                                    class="bg-black/60 backdrop-blur-md text-white text-[9px] font-bold px-1.5 py-0.5 rounded border border-white/10">
                                    {{ $contenu->typeContenu->nom ?? 'CULTURE' }}
                                </span>
                            </div>

                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-90">
                            </div>

                            <div class="absolute bottom-0 left-0 w-full p-4">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1 block">
                                    {{ $contenu->auteur->prenom ?? 'Auteur' }} {{ $contenu->auteur->nom ?? '' }}
                                </span>
                                <h3
                                    class="font-[Oswald] font-bold text-lg md:text-xl text-white leading-tight mb-2 shadow-black drop-shadow-md line-clamp-2">
                                    {{ $contenu->titre }}
                                </h3>
                                <div
                                    class="w-8 h-1 bg-[#FCD116] rounded-full group-hover/card:w-16 transition-all duration-300">
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="flex flex-col items-center justify-center w-full text-gray-500 py-10 pl-8">
                            <div class="w-16 h-16 rounded-full bg-white/5 flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <p class="text-lg">Aucun contenu disponible pour cette région.</p>
                            @auth
                                <a href="{{ route('admin.contenus.create') }}?region={{ $region->id }}"
                                    class="mt-4 px-6 py-2 bg-benin-green text-white rounded-full hover:bg-white hover:text-benin-green transition-colors text-sm font-bold">
                                    Ajouter un contenu
                                </a>
                            @endauth
                        </div>
                    @endforelse

                    <div class="flex-shrink-0 w-8"></div>
                </div>

            </div>

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
            const track = document.getElementById('contentTrack');
            const progressBar = document.getElementById('scrollProgress');

            const updateProgress = () => {
                const maxScroll = track.scrollWidth - track.clientWidth;
                if (maxScroll <= 0) {
                    progressBar.style.width = '100%';
                    return;
                }
                const percent = (track.scrollLeft / maxScroll) * 100;
                const safePercent = Math.min(Math.max(percent, 0), 100);
                progressBar.style.width = safePercent + '%';
            };

            track.addEventListener('scroll', updateProgress);
            setTimeout(updateProgress, 100);
            window.addEventListener('resize', updateProgress);

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

        /* Suppression des hacks qui causent le flou */
        .region-card {
            will-change: transform;
        }

        /* Force la netteté */
        .region-card img {
            image-rendering: -webkit-optimize-contrast;
        }
    </style>
@endsection
