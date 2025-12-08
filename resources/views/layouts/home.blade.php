<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Culture Bénin - Plateforme Culturelle</title>

    <!-- Favicon -->
    <link rel="icon" type="image/jpg" href="{{ asset('logo.jpg') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo.jpg') }}">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'benin': {
                            'green': '#008751',
                            'yellow': '#FCD116',
                            'red': '#E8112D',
                            'dark-green': '#006B42',
                        }
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.8s ease-out',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(30px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            }
                        }
                    }
                }
            }
        }
    </script>

    <style>
        .benin-gradient {
            background: linear-gradient(-45deg, #008751, #FCD116, #E8112D, #006B42);
            background-size: 400% 400%;
            animation: gradient 8s ease infinite;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>

<body class="min-h-screen bg-gray-50">
    <!-- Navigation Publique -->
    <nav class="fixed w-full top-0 z-50 bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo et Titre -->
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('logo.jpg') }}" alt="Culture Bénin" class="h-10 w-auto rounded-lg">
                    <span class="text-xl font-bold text-gray-800">Culture<span
                            class="text-benin-yellow">Bénin</span></span>
                </div>

                <!-- Boutons de connexion/inscription -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}"
                        class="text-gray-700 hover:text-benin-green transition-colors duration-300 font-medium">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-benin-green hover:bg-benin-dark-green text-white px-4 py-2 rounded-lg transition-colors duration-300 font-medium">
                        Inscription
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenu Principal Public -->
    <main class="pt-16">
        <!-- Hero Section -->
        <section class="benin-gradient min-h-screen flex items-center justify-center text-white">
            <div class="max-w-4xl mx-auto px-4 text-center">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 animate-fade-in-up">
                    Bienvenue sur <span class="text-benin-yellow">CultureBénin</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 animate-fade-in-up animation-delay-200">
                    La plateforme numérique dédiée à la promotion de la culture et des langues du Bénin
                </p>
                <div class="flex justify-center space-x-4 animate-fade-in-up animation-delay-400">
                    <a href="{{ route('register') }}"
                        class="bg-white text-benin-green px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        Commencer l'aventure
                    </a>
                    <a href="#about"
                        class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-benin-green transition-colors">
                        En savoir plus
                    </a>
                </div>
            </div>
        </section>

        <!-- Section À Propos -->
        <section id="about" class="py-20 bg-white">
            <div class="max-w-6xl mx-auto px-4">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-4xl font-bold text-gray-800 mb-6">Notre Vision</h2>
                        <p class="text-lg text-gray-600 mb-4">
                            CultureBénin est née de la volonté de préserver et promouvoir le riche patrimoine culturel
                            et linguistique du Bénin. Notre plateforme sert de pont entre les générations, permettant
                            la transmission et la valorisation de notre héritage culturel.
                        </p>
                        <p class="text-lg text-gray-600 mb-4">
                            Créée en 2024, notre initiative vise à digitaliser la culture béninoise pour la rendre
                            accessible à tous, partout dans le monde.
                        </p>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <span class="w-2 h-2 bg-benin-green rounded-full mr-3"></span>
                                <span class="text-gray-700">Promouvoir les langues locales</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-2 h-2 bg-benin-green rounded-full mr-3"></span>
                                <span class="text-gray-700">Valoriser le patrimoine culturel</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-2 h-2 bg-benin-green rounded-full mr-3"></span>
                                <span class="text-gray-700">Faciliter l'accès à la culture béninoise</span>
                            </div>
                        </div>
                    </div>
                    <div class="glass rounded-2xl p-8">
                        <h3 class="text-2xl font-bold text-white mb-4">Chiffres Clés</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-benin-yellow mb-2">50+</div>
                                <div class="text-white">Langues locales</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-benin-yellow mb-2">12</div>
                                <div class="text-white">Départements</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-benin-yellow mb-2">1000+</div>
                                <div class="text-white">Contenus culturels</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-benin-yellow mb-2">24/7</div>
                                <div class="text-white">Accès disponible</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section Fonctionnalités -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-6xl mx-auto px-4">
                <h2 class="text-4xl font-bold text-center text-gray-800 mb-12">Découvrez nos fonctionnalités</h2>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-white p-6 rounded-xl shadow-lg hover-lift transition-all duration-300">
                        <div class="w-12 h-12 bg-benin-green rounded-lg flex items-center justify-center mb-4">
                            <span class="text-white text-xl">🌍</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Explorer les Régions</h3>
                        <p class="text-gray-600">Découvrez la diversité culturelle à travers les 12 départements du
                            Bénin</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-lg hover-lift transition-all duration-300">
                        <div class="w-12 h-12 bg-benin-yellow rounded-lg flex items-center justify-center mb-4">
                            <span class="text-gray-800 text-xl">💬</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Apprendre les Langues</h3>
                        <p class="text-gray-600">Accédez à des ressources pour apprendre les langues locales du Bénin
                        </p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-lg hover-lift transition-all duration-300">
                        <div class="w-12 h-12 bg-benin-red rounded-lg flex items-center justify-center mb-4">
                            <span class="text-white text-xl">📚</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Contenus Culturels</h3>
                        <p class="text-gray-600">Explorez une riche collection de contenus sur la culture béninoise</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer Public -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <div class="flex items-center justify-center space-x-3 mb-4">
                    <img src="{{ asset('logo.jpg') }}" alt="Culture Bénin" class="h-10 w-auto rounded-lg">
                    <span class="text-xl font-bold">Culture<span class="text-benin-yellow">Bénin</span></span>
                </div>
                <p class="text-gray-400 mb-4">
                    Plateforme numérique pour la promotion de la culture et des langues du Bénin
                </p>
                <p class="text-gray-400">&copy; 2025 Culture Bénin. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <style>
        .hover-lift:hover {
            transform: translateY(-5px);
        }

        .animation-delay-200 {
            animation-delay: 200ms;
        }

        .animation-delay-400 {
            animation-delay: 400ms;
        }
    </style>
</body>

</html>
