@extends('layouts.app')

@section('title', 'Gestion des Régions - Admin')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollToPlugin.min.js"></script>

    <div class="relative w-full min-h-screen bg-[#050505] text-white overflow-x-hidden font-sans">

        <div class="fixed inset-0 z-0">
            <video autoplay loop muted playsinline class="absolute top-0 left-0 w-full h-full object-cover opacity-30">
                <source src="{{ asset('bg.mp4') }}" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-black/60"></div>
        </div>

        <div class="relative z-10 flex flex-col justify-center min-h-screen w-full pt-28 pb-10">

            <div class="absolute top-28 right-8 md:right-16 z-50">
                {{-- CORRECTION ICI : admin.regions.create --}}
                <a href="{{ route('admin.regions.create') }}"
                    class="flex items-center px-6 py-3 bg-benin-yellow text-black font-bold rounded-full hover:bg-white transition-all shadow-[0_0_20px_rgba(252,209,22,0.4)] transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Nouvelle Région
                </a>
            </div>

            <div class="px-8 md:px-16 mb-4" data-aos="fade-right">
                <div class="pl-6 border-l-4 border-benin-yellow">
                    <h2 class="text-benin-green font-bold tracking-widest text-sm uppercase mb-2">Espace Administration</h2>
                    <h1 class="text-4xl md:text-6xl font-[Oswald] font-bold text-white leading-tight mb-2">
                        GÉRER LES <br>
                        <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-[#008751] via-[#FCD116] to-[#E8112D]">
                            RÉGIONS
                        </span>
                    </h1>
                    <p class="text-gray-300 max-w-xl text-base font-light">
                        {{ $regions->total() }} Communess enregistrées.
                    </p>
                </div>
            </div>

            <div class="relative w-full group">

                <button id="slideLeft"
                    class="absolute left-4 top-1/2 -translate-y-1/2 z-50 w-12 h-12 bg-black/80 hover:bg-benin-green rounded-full flex items-center justify-center transition-all duration-300 border border-white/20 shadow-2xl cursor-pointer">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <div id="regionsTrack"
                    class="flex gap-5 overflow-x-auto overflow-y-visible py-6 px-8 md:px-16 cursor-grab active:cursor-grabbing scroll-smooth hide-scrollbar items-center w-full">

                    @foreach ($regions as $index => $region)
                        @php
                            $imgNum = ($index % 20) + 1;
                            $localImage = asset("region{$imgNum}.jpeg");
                            $bgImage = $region->image ? asset('storage/' . $region->image) : $localImage;
                        @endphp

                        <div class="relative group/card flex-shrink-0">

                            <a href="{{ route('regions.show', $region) }}"
                                class="region-card block w-[160px] h-[260px] md:w-[200px] md:h-[320px] rounded-xl overflow-hidden transition-all duration-300 ease-out border border-white/10 hover:border-benin-green hover:scale-105 shadow-2xl bg-gray-900">

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

                            <div
                                class="absolute top-2 right-2 flex space-x-2 z-50 opacity-0 group-hover/card:opacity-100 transition-opacity duration-300">

                                {{-- CORRECTION ICI : admin.regions.edit --}}
                                <a href="{{ route('admin.regions.edit', $region->id) }}"
                                    class="p-2 bg-blue-600 text-white rounded-full shadow-lg hover:bg-blue-500 hover:scale-110 transition-transform"
                                    title="Modifier">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>

                                {{-- CORRECTION ICI : admin.regions.destroy --}}
                                <form action="{{ route('admin.regions.destroy', $region->id) }}" method="POST"
                                    onsubmit="return confirm('Supprimer cette région ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-2 bg-red-600 text-white rounded-full shadow-lg hover:bg-red-500 hover:scale-110 transition-transform"
                                        title="Supprimer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>

                        </div>
                    @endforeach

                    <div class="flex-shrink-0 w-8"></div>
                </div>

                <button id="slideRight"
                    class="absolute right-4 top-1/2 -translate-y-1/2 z-50 w-12 h-12 bg-black/80 hover:bg-benin-green rounded-full flex items-center justify-center transition-all duration-300 border border-white/20 shadow-2xl cursor-pointer">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

            </div>

            <div class="flex justify-center mt-2 pb-4">
                <div class="w-64 h-1.5 bg-white/20 rounded-full overflow-hidden">
                    <div id="scrollProgress"
                        class="h-full bg-gradient-to-r from-[#008751] via-[#FCD116] to-[#E8112D] w-0 transition-all duration-100 ease-out">
                    </div>
                </div>
            </div>

            <div class="flex justify-center mt-2 px-8">
                <div class="bg-gray-900/80 backdrop-blur-md p-2 rounded-lg border border-white/10">
                    {{ $regions->links() }}
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
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            transform: translateZ(0);
            -webkit-font-smoothing: antialiased;
        }

        .region-card img {
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            transform: translateZ(0);
        }
    </style>
@endsection
