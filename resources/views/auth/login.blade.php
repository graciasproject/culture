@extends('layouts.auth')

@section('title', 'Connexion - Culture Bénin')

@section('content')
    <div class="w-full space-y-8" data-aos="fade-up">
        <!-- Carte de connexion avec glass effect -->
        <div class="glass dark:glass-dark rounded-2xl shadow-xl p-8 space-y-6 border border-white/20">

            <!-- En-tête -->
            <div class="text-center">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('logo.jpg') }}" alt="Culture Bénin" class="h-12 w-auto rounded-lg">
                </div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Connectez-vous</h2>
                <p class="text-gray-600 dark:text-gray-300 mt-2">Accédez à votre espace Culture Bénin</p>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="text-red-700 dark:text-red-300 text-sm font-medium">Identifiants incorrects</span>
                    </div>
                    <ul class="mt-2 text-red-600 dark:text-red-400 text-sm list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulaire -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-200"
                        placeholder="votre@email.com">
                </div>

                <!-- Mot de passe - CHAMP CORRIGÉ -->
                <div>
                    <label for="mot_de_passe" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Mot de
                        passe</label>
                    <input id="mot_de_passe" type="password" name="mot_de_passe" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-200"
                        placeholder="••••••••">
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="rounded border-gray-300 text-benin-green focus:ring-benin-green">
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Se souvenir de moi</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm text-benin-yellow hover:text-benin-red transition-colors duration-200">
                            Mot de passe oublié ?
                        </a>
                    @endif
                </div>

                <!-- Bouton de connexion -->
                <div>
                    <button type="submit"
                        class="w-full py-3 px-4 bg-benin-green hover:bg-benin-dark-green text-white font-semibold rounded-lg shadow-lg transform hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-benin-green">
                        Se connecter
                    </button>
                </div>

                <!-- Lien vers inscription -->
                <div class="text-center pt-4">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Pas encore de compte ?
                        <a href="{{ route('register') }}"
                            class="font-medium text-benin-yellow hover:text-benin-red transition-colors duration-200 ml-1">
                            S'inscrire
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection
