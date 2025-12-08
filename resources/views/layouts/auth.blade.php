<!DOCTYPE html>
<html lang="fr" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Authentification') - Culture Bénin</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/jpg" href="{{ asset('logo.jpg') }}">
    
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
                    },
                    keyframes: {
                        float: {'0%, 100%': { transform: 'translateY(0)' }, '50%': { transform: 'translateY(-20px)' }},
                        gradient: {'0%, 100%': { 'background-position': '0% 50%' }, '50%': { 'background-position': '100% 50%' }},
                    },
                    backgroundSize: {'gradient': '400% 400%'}
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
            background: rgba(255,255,255,0.1); 
            backdrop-filter: blur(10px); 
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        .glass-dark { 
            background: rgba(0,0,0,0.2); 
            backdrop-filter: blur(10px); 
            border: 1px solid rgba(255,255,255,0.1); 
        }

        /* Animations */
        @keyframes gradient {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        /* Transition douce */
        .smooth-transition { transition: all 0.3s ease; }
    </style>
</head>
<body class="min-h-screen bg-white dark:bg-gray-900 font-sans antialiased">

    <!-- Header Auth Simple -->
    <header class="fixed top-0 w-full z-40 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center items-center h-16">
                <!-- Logo seul -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('logo.jpg') }}" alt="Culture Bénin" class="h-8 w-auto rounded-lg">
                    <span class="text-lg font-bold text-gray-800 dark:text-white">Culture<span class="text-benin-green">Bénin</span></span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Auth -->
    <main class="min-h-screen pt-16 flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md">
            @yield('content')
        </div>
    </main>

    <!-- Footer Simplifié -->
    <footer class="bg-gray-900 text-white py-8 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-400">&copy; 2025 Culture Bénin. Tous droits réservés.</p>
        </div>
    </footer>

    <!-- AOS JS -->
    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script>
        // AOS init pour les animations
        AOS.init({ 
            duration: 800, 
            once: true, 
            offset: 50,
            easing: 'ease-out-cubic'
        });
    </script>

    @stack('scripts')
</body>
</html>