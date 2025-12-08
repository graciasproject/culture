<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Culture Bénin')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/jpg" href="{{ asset('logo.jpg') }}">

    <!-- CSS & Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Oswald:wght@400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/aos/aos.css') }}">

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        oswald: ['Oswald', 'sans-serif']
                    },
                    colors: {
                        benin: {
                            green: '#008751',
                            yellow: '#FCD116',
                            red: '#E8112D',
                            dark: '#0b0b0b'
                        }
                    }
                }
            }
        }
    </script>
    <style>
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #1a1a1a;
        }

        ::-webkit-scrollbar-thumb {
            background: #333;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #008751;
        }

        .dropdown-menu {
            transform-origin: top right;
            transition: all 0.2s ease-out;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-900">

    <!-- NAVIGATION (Masquée pour Admin car Sidebar) -->
    @if (Auth::check() && !request()->is('admin*'))
        <nav
            class="fixed w-full top-0 z-50 bg-white dark:bg-gray-900/95 backdrop-blur-md shadow-md border-b border-gray-100 dark:border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">

                    <!-- Logo -->
                    <div class="flex items-center space-x-3">
                        <img src="{{ asset('logo.jpg') }}" alt="Culture Bénin" class="h-10 w-auto rounded-lg shadow-sm">
                        <span class="text-xl font-bold text-gray-800 dark:text-white hidden sm:block">Culture<span
                                class="text-benin-yellow">Bénin</span></span>
                    </div>

                    <!-- Liens Centraux -->
                    <div class="hidden md:flex space-x-8">
                        <a href="{{ route('home.auth') }}"
                            class="text-gray-600 hover:text-benin-green font-medium transition text-sm uppercase tracking-wide">Accueil</a>
                        <a href="{{ route('contenus.index') }}"
                            class="text-gray-600 hover:text-benin-green font-medium transition text-sm uppercase tracking-wide">Contenus</a>
                        <a href="{{ route('regions.index') }}"
                            class="text-gray-600 hover:text-benin-green font-medium transition text-sm uppercase tracking-wide">Régions</a>
                        <a href="{{ route('langues.index') }}"
                            class="text-gray-600 hover:text-benin-green font-medium transition text-sm uppercase tracking-wide">Langues</a>
                    </div>

                    <!-- PROFIL DROPDOWN -->
                    <div class="relative ml-3">
                        <button onclick="toggleDropdown()" class="flex items-center space-x-3 focus:outline-none group">
                            <span
                                class="hidden md:block text-sm font-medium text-gray-700 dark:text-gray-200 group-hover:text-benin-green transition">
                                {{ Auth::user()->prenom }}
                            </span>
                            <div
                                class="h-10 w-10 rounded-full bg-gradient-to-br from-benin-green to-teal-800 flex items-center justify-center text-white font-bold text-lg shadow-md border-2 border-white dark:border-gray-800 group-hover:border-benin-yellow transition">
                                {{ substr(Auth::user()->prenom, 0, 1) }}
                            </div>
                        </button>

                        <!-- Le Menu Déroulant -->
                        <div id="userDropdown"
                            class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-xl shadow-2xl py-2 z-50 border border-gray-100 dark:border-gray-700 transform scale-95 opacity-0 transition-all duration-200">

                            <!-- Header Mobile -->
                            <div class="px-4 py-3 border-b border-gray-100 dark:border-gray-700 md:hidden">
                                <p class="text-sm text-gray-900 dark:text-white font-bold">{{ Auth::user()->prenom }}
                                    {{ Auth::user()->nom }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Mon Profil
                            </a>

                            @if (Auth::user()->id_role === 1)
                                <a href="{{ route('admin.dashboard') }}"
                                    class="flex items-center px-4 py-2 text-sm text-benin-red font-bold hover:bg-red-50 transition">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Administration
                                </a>
                            @endif

                            <div class="border-t border-gray-100 dark:border-gray-700 my-1"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex w-full items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    @endif

    <!-- MESSAGES FLASH -->
    <div class="fixed top-24 right-5 z-50 space-y-2 max-w-sm w-full pointer-events-none">
        @if (session('success'))
            <div
                class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-lg flex items-center animate-fade-in-up pointer-events-auto">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @if (session('error'))
            <div
                class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-lg flex items-center animate-fade-in-up pointer-events-auto">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p>{{ session('error') }}</p>
            </div>
        @endif
    </div>

    <!-- CONTENU -->
    <main class="{{ request()->is('admin*') ? '' : 'pt-16' }}">
        @yield('content')
    </main>

    <!-- SCRIPTS -->
    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script>
        AOS.init();

        // Gestion du Dropdown Profil
        function toggleDropdown() {
            const menu = document.getElementById('userDropdown');
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                setTimeout(() => {
                    menu.classList.remove('opacity-0', 'scale-95');
                    menu.classList.add('opacity-100', 'scale-100');
                }, 10);
            } else {
                menu.classList.remove('opacity-100', 'scale-100');
                menu.classList.add('opacity-0', 'scale-95');
                setTimeout(() => {
                    menu.classList.add('hidden');
                }, 200);
            }
        }

        // Fermer le dropdown si on clique ailleurs
        window.onclick = function(event) {
            if (!event.target.closest('.relative.ml-3')) {
                const menu = document.getElementById('userDropdown');
                if (!menu.classList.contains('hidden')) {
                    menu.classList.remove('opacity-100', 'scale-100');
                    menu.classList.add('opacity-0', 'scale-95');
                    setTimeout(() => {
                        menu.classList.add('hidden');
                    }, 200);
                }
            }
        }

        // Timer alertes
        setTimeout(() => {
            document.querySelectorAll('.animate-fade-in-up').forEach(el => el.style.display = 'none');
        }, 5000);
    </script>
</body>

</html>
