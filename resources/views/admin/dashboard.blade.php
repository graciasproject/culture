@extends('layouts.app')
@section('title', 'Tableau de Bord Admin - Culture Bénin')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-12" data-aos="fade-down">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                    Tableau de Bord <span class="text-benin-green">Administratif</span>
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Gestion complète de la plateforme Culture Bénin
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                {{-- Carte Contenus --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border-l-4 border-benin-green"
                    data-aos="fade-up">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Contenus</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['contenus'] ?? 0 }}</p>
                        </div>
                        <div class="p-3 bg-benin-green/10 rounded-full">
                            <svg class="w-8 h-8 text-benin-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Carte Utilisateurs --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border-l-4 border-benin-yellow"
                    data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Utilisateurs</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['utilisateurs'] ?? 0 }}
                            </p>
                        </div>
                        <div class="p-3 bg-benin-yellow/10 rounded-full">
                            <svg class="w-8 h-8 text-benin-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Carte Régions --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border-l-4 border-benin-red"
                    data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Régions</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['regions'] ?? 0 }}</p>
                        </div>
                        <div class="p-3 bg-benin-red/10 rounded-full">
                            <svg class="w-8 h-8 text-benin-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Carte Langues --}}
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border-l-4 border-benin-green"
                    data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Langues</p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['langues'] ?? 0 }}</p>
                        </div>
                        <div class="p-3 bg-benin-green/10 rounded-full">
                            <svg class="w-8 h-8 text-benin-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6" data-aos="fade-right">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Gestion des Données</h2>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ count($tables) }} tables</span>
                    </div>

                    <div class="space-y-4">
                        @foreach ($tables as $table)
                            <div
                                class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 hover:shadow-md transition-all duration-300 border border-gray-200 dark:border-gray-600">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4 flex-1">
                                        <div
                                            class="p-3 bg-{{ $table['color'] }}-100 dark:bg-{{ $table['color'] }}-900/30 rounded-xl">
                                            <svg class="w-6 h-6 text-{{ $table['color'] }}-600 dark:text-{{ $table['color'] }}-400"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                {!! $table['icon'] !!}
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="font-bold text-gray-900 dark:text-white text-lg">{{ $table['name'] }}
                                            </h3>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $table['count'] }}
                                                enregistrements</p>
                                        </div>
                                    </div>

                                    <div class="flex items-center space-x-2 ml-4">
                                        {{-- Bouton: Voir (Public) --}}
                                        <a href="{{ $table['routes']['public'] ?? 'javascript:void(0)' }}"
                                            @if (!isset($table['routes']['public'])) onclick="showMissingRouteAlert(event, 'Voir', '{{ $table['name'] }}')" @endif
                                            class="p-2 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 rounded-lg hover:bg-yellow-200 dark:hover:bg-yellow-800/50 transition-all duration-300 transform hover:scale-110 tooltip {{ !isset($table['routes']['public']) ? 'opacity-70' : '' }}"
                                            title="{{ isset($table['routes']['public']) ? 'Voir le rendu public' : 'Vue publique non configurée' }}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        {{-- Bouton: Créer --}}
                                        <a href="{{ $table['routes']['create'] ?? 'javascript:void(0)' }}"
                                            @if (!isset($table['routes']['create'])) onclick="showMissingRouteAlert(event, 'Créer', '{{ $table['name'] }}')" @endif
                                            class="p-2 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-lg hover:bg-blue-200 dark:hover:bg-blue-800/50 transition-all duration-300 transform hover:scale-110 tooltip {{ !isset($table['routes']['create']) ? 'opacity-70' : '' }}"
                                            title="{{ isset($table['routes']['create']) ? 'Créer nouveau' : 'Formulaire de création non configuré' }}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                        </a>

                                        {{-- Bouton: Gérer/Supprimer --}}
                                        <a href="{{ $table['routes']['manage'] ?? 'javascript:void(0)' }}"
                                            @if (!isset($table['routes']['manage'])) onclick="showMissingRouteAlert(event, 'Gérer', '{{ $table['name'] }}')" @endif
                                            class="p-2 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-200 dark:hover:bg-red-800/50 transition-all duration-300 transform hover:scale-110 tooltip {{ !isset($table['routes']['manage']) ? 'opacity-70' : '' }}"
                                            title="{{ isset($table['routes']['manage']) ? 'Gérer la liste / Supprimer' : 'Interface de gestion non configurée' }}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </a>

                                    </div>
                                </div>

                                <div class="mt-3">
                                    <div class="flex justify-between text-xs text-gray-500 dark:text-gray-400 mb-1">
                                        <span>Volume</span>
                                        <span>{{ $table['count'] }} entrées</span>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                                        <div class="bg-{{ $table['color'] }}-500 h-2 rounded-full transition-all duration-500"
                                            style="width: {{ min($table['count'] * 2, 100) }}%"></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6" data-aos="fade-left">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Actions Rapides</h2>
                    <div class="grid grid-cols-1 gap-4">

                        {{-- BOUTON 1: Nouveau Contenu --}}
                        <a href="{{ route('admin.contenus.create') }}" {{-- CORRIGÉ: admin. --}}
                            class="flex items-center space-x-4 p-4 bg-gradient-to-r from-benin-green/10 to-benin-green/5 hover:from-benin-green/20 hover:to-benin-green/10 rounded-xl transition-all duration-300 group border border-benin-green/20 hover:border-benin-green/40">
                            <div
                                class="p-3 bg-benin-green rounded-xl group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-900 dark:text-white">Nouveau Contenu</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Ajouter un contenu culturel</p>
                            </div>
                            <svg class="w-5 h-5 text-benin-green transform group-hover:translate-x-1 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>

                        {{-- BOUTON 2: Statistiques / Refresh --}}
                        <a href="{{ route('admin.statsboard') }}" {{-- CORRIGÉ: admin.stats.refresh --}}
                            class="flex items-center space-x-4 p-4 bg-gradient-to-r from-benin-yellow/10 to-benin-yellow/5 hover:from-benin-yellow/20 hover:to-benin-yellow/10 rounded-xl transition-all duration-300 group border border-benin-yellow/20 hover:border-benin-yellow/40">
                            <div
                                class="p-3 bg-benin-yellow rounded-xl group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-900 dark:text-white">Statistiques Avancées</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Analyses détaillées</p>
                            </div>
                            <svg class="w-5 h-5 text-benin-yellow transform group-hover:translate-x-1 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>

                        {{-- BOUTON 3: Gestion Utilisateurs --}}
                        <a href="{{ route('admin.users.index') }}" {{-- CORRIGÉ: admin. --}}
                            class="flex items-center space-x-4 p-4 bg-gradient-to-r from-benin-red/10 to-benin-red/5 hover:from-benin-red/20 hover:to-benin-red/10 rounded-xl transition-all duration-300 group border border-benin-red/20 hover:border-benin-red/40">
                            <div
                                class="p-3 bg-benin-red rounded-xl group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-900 dark:text-white">Gestion Utilisateurs</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Gérer les comptes</p>
                            </div>
                            <svg class="w-5 h-5 text-benin-red transform group-hover:translate-x-1 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6" data-aos="fade-up">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Activités Récentes</h2>
                    <span class="text-sm text-benin-green font-medium">{{ $recentActivities->count() ?? 0 }}
                        activités</span>
                </div>

                <div class="space-y-4">
                    @if (isset($recentActivities) && $recentActivities->count() > 0)
                        @foreach ($recentActivities as $activity)
                            <div
                                class="flex items-center space-x-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-xl border-l-4 border-benin-green hover:shadow-md transition-all duration-300">
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-benin-green to-benin-dark-green rounded-full flex items-center justify-center shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ $activity->description }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center space-x-2 mt-1">
                                        <span>{{ $activity->created_at->diffForHumans() }}</span>
                                        <span class="text-benin-green">•</span>
                                        <span
                                            class="bg-benin-green/10 text-benin-green text-xs px-2 py-1 rounded-full">Admin</span>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-12">
                            <div
                                class="w-24 h-24 mx-auto mb-4 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400 text-lg">Aucune activité récente</p>
                            <p class="text-gray-400 dark:text-gray-500 text-sm mt-2">Les nouvelles activités apparaîtront
                                ici</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {{-- Styles CSS additionnels --}}
    <style>
        .tooltip {
            position: relative;
        }

        .tooltip:hover::after {
            content: attr(title);
            position: absolute;
            bottom: -30px;
            left: 50%;
            transform: translateX(-50%);
            background: #1f2937;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .tooltip:hover::before {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            border: 5px solid transparent;
            border-bottom-color: #1f2937;
            z-index: 1000;
        }
    </style>

    {{-- Scripts JS --}}
    <script>
        // Fonction pour gérer les routes manquantes (Affichage d'erreur)
        function showMissingRouteAlert(event, actionName, tableName) {
            event.preventDefault(); // Empêche le lien de réagir
            Swal.fire({
                title: 'Action impossible',
                html: `La fonctionnalité <b>${actionName}</b> pour le module <b>${tableName}</b> n'est pas encore configurée.`,
                icon: 'info',
                confirmButtonColor: '#3B82F6',
                confirmButtonText: 'Compris',
                background: '#1F2937',
                color: '#F9FAFB'
            });
        }

        // Animation au survol des cartes
        document.querySelectorAll('.bg-gray-50, .bg-white').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
@endsection
