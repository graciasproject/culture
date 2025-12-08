<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Culture Bénin - L'Âme du Danxomè</title>
    <link rel="icon" type="image/jpg" href="{{ asset('logo.jpg') }}">

    <link rel="stylesheet" href="{{ asset('vendor/aos/aos.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Oswald:wght@500;700&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'benin': {
                            'green': '#008751',
                            'yellow': '#FCD116',
                            'red': '#E8112D',
                            'dark': '#050505'
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif'],
                        'oswald': ['Oswald', 'sans-serif']
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-20px)'
                            },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .text-glow {
            text-shadow: 0 0 20px rgba(252, 209, 22, 0.4);
        }

        .hover-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .hover-card:hover {
            transform: translateY(-8px);
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 antialiased overflow-x-hidden">

    <nav class="fixed w-full z-50 transition-all duration-500" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-3 group cursor-pointer">
                    <img src="{{ asset('logo.jpg') }}"
                        class="h-10 w-10 rounded-lg shadow-lg group-hover:rotate-12 transition transform">
                    <span
                        class="text-xl font-bold text-white tracking-wide group-hover:text-benin-yellow transition">CULTURE<span
                            class="text-benin-yellow group-hover:text-white transition">BÉNIN</span></span>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="{{ route('login') }}"
                        class="text-white/80 hover:text-white font-medium transition text-sm uppercase tracking-wider hidden sm:block">Connexion</a>
                    <a href="{{ route('register') }}"
                        class="bg-benin-yellow text-black px-6 py-2.5 rounded-full font-bold hover:bg-white transition shadow-[0_0_15px_rgba(252,209,22,0.4)] hover:shadow-[0_0_25px_rgba(255,255,255,0.6)] transform hover:-translate-y-0.5 text-sm uppercase tracking-wide">
                        Rejoindre
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <header class="relative h-screen flex items-center justify-center overflow-hidden bg-benin-dark">
        <div class="absolute inset-0 z-0">
            <video autoplay muted loop playsinline class="w-full h-full object-cover opacity-60 scale-105">
                <source src="{{ asset('bg.mp4') }}" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/40 to-benin-dark"></div>
            <div class="absolute inset-0 opacity-[0.03]" style="background-image: url('data:image/svg+xml,...')"></div>
        </div>

        <div class="absolute top-1/4 left-10 w-24 h-24 bg-benin-green/20 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-1/4 right-10 w-32 h-32 bg-benin-red/20 rounded-full blur-3xl animate-float"
            style="animation-delay: 2s;"></div>

        <div class="relative z-10 text-center px-4 max-w-5xl mt-10" data-aos="zoom-out" data-aos-duration="1200">
            <div
                class="inline-block mb-4 px-4 py-1 rounded-full border border-white/20 bg-white/5 backdrop-blur-sm text-benin-yellow text-xs font-bold uppercase tracking-[0.3em] animate-pulse-slow">
                Patrimoine Numérique
            </div>
            <h1
                class="text-6xl md:text-8xl lg:text-9xl font-oswald font-bold text-white mb-8 leading-[0.9] tracking-tight text-glow">
                L'ÂME DU <br>
                <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-benin-green via-benin-yellow to-benin-red">DANXOMÈ</span>
            </h1>
            <p class="text-lg md:text-2xl text-gray-300 mb-12 font-light max-w-2xl mx-auto leading-relaxed">
                Une bibliothèque immersive regroupant l'histoire, les légendes et les savoirs ancestraux du Bénin. <span
                    class="text-white font-medium">Ne laissez pas l'histoire s'éteindre.</span>
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-5">
                <a href="{{ route('register') }}"
                    class="group relative px-8 py-4 bg-benin-green text-white font-bold rounded-full overflow-hidden shadow-2xl transition hover:shadow-green-900/50">
                    <div
                        class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite]">
                    </div>
                    <span class="relative flex items-center">
                        Commencer l'Exploration
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </span>
                </a>
                <a href="#decouvrir"
                    class="px-8 py-4 border border-white/30 text-white font-bold rounded-full hover:bg-white hover:text-black transition backdrop-blur-sm">
                    En savoir plus
                </a>
            </div>
        </div>

        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 animate-bounce text-white/50">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </div>
    </header>

    <section id="decouvrir" class="py-24 bg-benin-dark relative">
        <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-gray-800 to-transparent">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-4">
                <div data-aos="fade-right">
                    <h2 class="text-4xl md:text-5xl font-oswald font-bold text-white mb-2">Trésors Récents</h2>
                    <div class="h-1 w-20 bg-benin-yellow rounded"></div>
                </div>
                <a href="{{ route('register') }}"
                    class="text-gray-400 hover:text-benin-green transition flex items-center text-sm font-medium group">
                    Voir tout le catalogue
                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($featured as $item)
                    @php
                        // LOGIQUE STRICTE : On utilise l'index de la boucle (0, 1, 2)
$localImages = ['img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg'];
$idx = $loop->index % 4; // 0, 1, 2...
$thumb = $item->image_couverture
    ? asset('storage/' . $item->image_couverture)
                            : asset($localImages[$idx]);
                    @endphp

                    <div class="group relative rounded-2xl overflow-hidden cursor-pointer hover-card" data-aos="fade-up"
                        data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="aspect-[4/5] w-full overflow-hidden">
                            <img src="{{ $thumb }}"
                                class="w-full h-full object-cover transition duration-700 group-hover:scale-110 group-hover:brightness-110">
                        </div>

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent opacity-90">
                        </div>

                        <div class="absolute bottom-0 left-0 p-6 w-full">
                            <span
                                class="text-xs font-bold text-benin-green uppercase mb-1 block">{{ $item->region->nom_region ?? 'Bénin' }}</span>
                            <h3 class="inline-flex items-center text-benin-yellow font-bold leading-tight mb-2">
                                {{ $item->titre }}</h3>

                            <a href="{{ route('login') }}"
                                class="inline-flex items-center text-benin-red font-bold text-sm hover:underline">
                                Lire l'histoire <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <footer class="bg-black text-gray-500 py-12 border-t border-gray-900 font-light text-sm">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; 2025 Culture Bénin. Une initiative pour la préservation numérique.</p>
        </div>
    </footer>

    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 50
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 50) {
                nav.classList.add('bg-black/80', 'backdrop-blur-md', 'shadow-xl');
            } else {
                nav.classList.remove('bg-black/80', 'backdrop-blur-md', 'shadow-xl');
            }
        });
    </script>
</body>

</html>
