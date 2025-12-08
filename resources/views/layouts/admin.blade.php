<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Administration') - Culture Bénin</title>

    <!-- Favicon -->
    <link rel="icon" type="image/jpg" href="{{ asset('logo.jpg') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo.jpg') }}">

    <!-- AOS CSS LOCAL -->
    <link rel="stylesheet" href="{{ asset('vendor/aos/aos.css') }}">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind Config Avancée -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'benin': {
                            'green': '#008751',
                            'yellow': '#FCD116',
                            'red': '#E8112D',
                            'dark-green': '#006B42',
                            'dark-yellow': '#E6B800',
                            'dark-red': '#C10A25',
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'gradient': 'gradient 8s ease infinite',
                        'pulse-slow': 'pulse 3s ease-in-out infinite',
                        'bounce-slow': 'bounce 2s infinite',
                        'fade-in-up': 'fadeInUp 0.8s ease-out',
                        'slide-in-left': 'slideInLeft 0.8s ease-out',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-20px)'
                            }
                        },
                        gradient: {
                            '0%, 100%': {
                                'background-position': '0% 50%'
                            },
                            '50%': {
                                'background-position': '100% 50%'
                            }
                        },
                        fadeInUp: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(30px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            }
                        },
                        slideInLeft: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateX(-30px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateX(0)'
                            }
                        }
                    },
                    backgroundSize: {
                        'gradient': '400% 400%'
                    }
                }
            }
        }
    </script>

    <!-- Styles Personnalisés -->
    <style>
        /* Gradient Animé Bénin */
        .benin-gradient {
            background: linear-gradient(-45deg, #008751, #FCD116, #E8112D, #006B42);
            background-size: 400% 400%;
            animation: gradient 8s ease infinite;
        }

        /* Glass Morphism */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .glass-dark {
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #008751;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #006B42;
        }

        /* Text Glow */
        .text-glow {
            text-shadow: 0 0 10px rgba(252, 209, 22, 0.3);
        }

        /* Hover Effects */
        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
        }

        /* Dark Mode Smooth Transition */
        .dark-mode-transition {
            transition: background-color 0.5s ease, color 0.5s ease;
        }

        /* Navigation Link Styles */
        .nav-link {
            @apply text-gray-700 dark:text-white hover:text-benin-green dark:hover:text-benin-yellow transition-all duration-300 font-medium relative group;
        }

        .nav-link::after {
            content: '';
            @apply absolute bottom-0 left-0 w-0 h-0.5 bg-benin-green group-hover:w-full transition-all duration-300;
        }

        /* Styles Admin */
        .admin-badge {
            @apply bg-benin-red text-white text-xs px-2 py-1 rounded-full font-bold ml-2;
        }

        /* Dropdown Styles */
        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }
    </style>
</head>

<body class="min-h-screen bg-white dark:bg-gray-900 dark-mode-transition font-sans antialiased">

    <!-- Navigation Admin -->
    <nav class="fixed w-full top-0 z-50 bg-white dark:bg-gray-900/95 backdrop-blur-md shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo et Titre -->
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('logo.jpg') }}" alt="Culture Bénin" class="h-10 w-auto rounded-lg">
                    <span class="text-xl font-bold text-gray-800 dark:text-white">Culture<span
                            class="text-benin-yellow">Bénin</span>
                        <span class="admin-badge">ADMIN</span>
                    </span>
                </div>

                <!-- Liens de navigation centrés -->
                <div class="flex justify-center items-center space-x-8 absolute left-1/2 transform -translate-x-1/2">
                    <a href="{{ route('home.auth') }}" class="nav-link">Accueil</a>
                    <a href="{{ route('contenus.index') }}" class="nav-link">Contenus</a>
                    <a href="{{ route('regions.index') }}" class="nav-link">Régions</a>
                    <a href="{{ route('langues.index') }}" class="nav-link">Langues</a>

                    <!-- Dropdown Tableaux de Bord Admin -->
                    <div class="dropdown relative">
                        <button class="nav-link flex items-center space-x-1 bg-benin-green/10 px-3 py-1 rounded-lg">
                            <span>Administration</span>
                            <svg class="w-4 h-4 transition-transform duration-300 dropdown-arrow" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div
                            class="dropdown-menu absolute top-full left-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-600 py-2 z-50">
                            <a href="{{ route('admin.dashboard') }}"
                                class="flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-300">
                                <svg class="w-5 h-5 text-benin-green" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <span>Tableau de Bord</span>
                            </a>
                            <a href="{{ route('statsboard') }}"
                                class="flex items-center space-x-3 px-4 py-3 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-300">
                                <svg class="w-5 h-5 text-benin-yellow" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                <span>Statistiques Avancées</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Menu Utilisateur Admin -->
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700 dark:text-gray-300 font-medium">
                        {{ Auth::user()->prenom }} {{ Auth::user()->nom }}
                    </span>

                    <!-- Déconnexion -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="bg-benin-red text-white px-4 py-2 rounded-md hover:bg-benin-dark-red transition-colors duration-300 font-medium">
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{ asset('logo.jpg') }}" alt="Culture Bénin" class="h-10 w-auto rounded-lg">
                        <span class="text-xl font-bold">Culture<span class="text-benin-yellow">Bénin</span>
                            <span class="admin-badge">ADMIN</span>
                        </span>
                    </div>
                    <p class="text-gray-400 mb-4 max-w-md">
                        Interface d'administration - Gestion complète de la plateforme Culture Bénin
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Navigation Admin</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('admin.dashboard') }}"
                                class="text-gray-400 hover:text-benin-yellow transition-colors duration-300">Tableau de
                                Bord</a>
                        </li>
                        <li><a href="{{ route('statsboard') }}"
                                class="text-gray-400 hover:text-benin-yellow transition-colors duration-300">Statistiques</a>
                        </li>
                        <li><a href="{{ route('contenus.index') }}"
                                class="text-gray-400 hover:text-benin-yellow transition-colors duration-300">Gestion
                                Contenus</a>
                        </li>
                        <li><a href="{{ route('regions.index') }}"
                                class="text-gray-400 hover:text-benin-yellow transition-colors duration-300">Gestion
                                Régions</a>
                        </li>
                        <li><a href="{{ route('langues.index') }}"
                                class="text-gray-400 hover:text-benin-yellow transition-colors duration-300">Gestion
                                Langues</a>
                        </li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Support Admin</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>admin@culturebenin.bj</li>
                        <li>+229 46 90 51 92</li>
                        <li>Support technique</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400">&copy; 2025 Culture Bénin - Interface d'administration</p>
                <p class="text-gray-500 text-sm mt-2 md:mt-0">
                    Connecté en tant qu'administrateur
                </p>
            </div>
        </div>
    </footer>

    <!-- AOS JS -->
    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script>
        // AOS init
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100,
            easing: 'ease-out-cubic',
            delay: 100,
            mirror: false
        });

        // Header scroll effect
        window.addEventListener('scroll', function() {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) nav.classList.add('shadow-2xl', 'bg-white/95', 'dark:bg-gray-900/95');
            else nav.classList.remove('shadow-2xl', 'bg-white/95', 'dark:bg-gray-900/95');
        });

        // Dropdown arrow hover
        document.querySelectorAll('.dropdown').forEach(dropdown => {
            const arrow = dropdown.querySelector('.dropdown-arrow');
            dropdown.addEventListener('mouseenter', () => arrow.style.transform = 'rotate(180deg)');
            dropdown.addEventListener('mouseleave', () => arrow.style.transform = 'rotate(0deg)');
        });

        // Gestion des dropdowns au clic
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown')) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.classList.remove('opacity-100', 'visible', 'translate-y-0');
                    menu.classList.add('opacity-0', 'invisible', '-translate-y-2');
                });
            }
        });

        document.querySelectorAll('.dropdown').forEach(dropdown => {
            const toggle = dropdown.querySelector('button');
            const menu = dropdown.querySelector('.dropdown-menu');

            toggle.addEventListener('click', function(e) {
                e.stopPropagation();
                const isOpen = menu.classList.contains('opacity-100');

                // Fermer tous les autres dropdowns
                document.querySelectorAll('.dropdown-menu').forEach(otherMenu => {
                    if (otherMenu !== menu) {
                        otherMenu.classList.remove('opacity-100', 'visible', 'translate-y-0');
                        otherMenu.classList.add('opacity-0', 'invisible', '-translate-y-2');
                    }
                });

                // Basculer le dropdown actuel
                if (isOpen) {
                    menu.classList.remove('opacity-100', 'visible', 'translate-y-0');
                    menu.classList.add('opacity-0', 'invisible', '-translate-y-2');
                } else {
                    menu.classList.remove('opacity-0', 'invisible', '-translate-y-2');
                    menu.classList.add('opacity-100', 'visible', 'translate-y-0');
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
