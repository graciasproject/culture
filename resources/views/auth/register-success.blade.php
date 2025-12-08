@extends('layouts.auth')

@section('title', 'Inscription Réussie - Culture Bénin')

@section('content')
    <div class="w-full space-y-8" data-aos="fade-up">
        <!-- Carte de succès -->
        <div class="glass dark:glass-dark rounded-2xl shadow-xl p-8 space-y-6 border border-white/20 text-center">

            <!-- Icône de succès -->
            <div class="flex justify-center mb-4">
                <div class="h-16 w-16 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                    <svg class="h-8 w-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>

            <!-- Message de succès -->
            <div class="space-y-4">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Inscription Réussie !</h2>

                <p class="text-gray-600 dark:text-gray-300">
                    Félicitations ! Votre compte a été créé avec succès.
                </p>

                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                    <div class="flex items-start">
                        <svg class="h-5 w-5 text-blue-500 mt-0.5 mr-2" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="text-left">
                            <p class="text-blue-800 dark:text-blue-300 text-sm font-medium">
                                Vérifiez votre boîte email
                            </p>
                            <p class="text-blue-600 dark:text-blue-400 text-sm mt-1">
                                Un lien de vérification a été envoyé à votre adresse email.
                                Veuillez vérifier votre compte pour accéder à toutes les fonctionnalités.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="space-y-3 pt-4">
                <!-- Bouton connexion -->
                <a href="{{ route('login') }}"
                    class="w-full py-3 px-4 bg-benin-green text-white font-semibold rounded-lg shadow-lg hover:bg-benin-dark-green transform hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-benin-green block text-center">
                    Se connecter
                </a>

                <!-- Lien vers accueil -->
                <a href="{{ route('home') }}"
                    class="inline-block text-sm text-benin-yellow hover:text-benin-red transition-colors duration-200 font-medium">
                    ← Retour à l'accueil
                </a>
            </div>

            <!-- Info supplémentaire -->
            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    Si vous ne recevez pas l'email de vérification,
                    <a href="{{ route('verification.send') }}" class="text-benin-green hover:underline">cliquez ici pour le
                        renvoyer</a>.
                </p>
            </div>
        </div>
    </div>
@endsection
