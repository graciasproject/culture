@extends('layouts.app')

@section('title', 'Statistiques Détaillées')

@section('content')
    <div class="flex h-screen bg-gray-100 font-sans overflow-hidden">

        <!-- SIDEBAR (Même que Dashboard Admin pour la cohérence) -->
        <aside
            class="w-64 bg-[#0b0b0b] text-white hidden md:flex flex-col h-full fixed left-0 top-0 pt-20 border-r border-gray-800 z-20">
            <div class="px-6 py-4">
                <h2 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-4">Analyses</h2>
                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center px-4 py-3 text-gray-400 hover:text-white hover:bg-white/5 rounded-lg transition">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                        </svg>
                        Retour Dashboard
                    </a>
                    <a href="{{ route('statsboard') }}"
                        class="flex items-center px-4 py-3 bg-benin-yellow text-gray-900 rounded-lg transition shadow-lg shadow-yellow-500/20 font-bold">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z" />
                        </svg>
                        Statistiques
                    </a>
                </nav>
            </div>
        </aside>

        <!-- CONTENU PRINCIPAL -->
        <div class="flex-1 md:ml-64 p-8 overflow-y-auto pt-24 h-full">

            <div class="flex justify-between items-end mb-8">
                <div>
                    <h1 class="text-3xl font-[Oswald] font-bold text-gray-900">Statistiques Détaillées</h1>
                    <p class="text-gray-500 mt-1">Analyse approfondie des données de la plateforme.</p>
                </div>
                <div class="flex space-x-2">
                    <span class="px-3 py-1 bg-white border rounded text-sm text-gray-600 flex items-center">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span> En direct
                    </span>
                </div>
            </div>

            <!-- KPI RAPIDES -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-benin-green">
                    <div class="text-gray-500 text-xs uppercase font-bold">Total Contenus</div>
                    <div class="text-2xl font-bold text-gray-900">{{ $stats['total_contenus'] ?? 0 }}</div>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-benin-yellow">
                    <div class="text-gray-500 text-xs uppercase font-bold">Utilisateurs</div>
                    <div class="text-2xl font-bold text-gray-900">{{ $stats['total_utilisateurs'] ?? 0 }}</div>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-benin-red">
                    <div class="text-gray-500 text-xs uppercase font-bold">Régions</div>
                    <div class="text-2xl font-bold text-gray-900">{{ $stats['total_regions'] ?? 0 }}</div>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-purple-500">
                    <div class="text-gray-500 text-xs uppercase font-bold">Langues</div>
                    <div class="text-2xl font-bold text-gray-900">{{ $stats['total_langues'] ?? 0 }}</div>
                </div>
            </div>

            <!-- GRAPHIQUES -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

                <!-- 1. Types de Contenu -->
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 border-b pb-2">Répartition par Type</h3>
                    <div class="h-64 flex justify-center">
                        <canvas id="typeContenuChart"></canvas>
                    </div>
                </div>

                <!-- 2. Régions -->
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 border-b pb-2">Couverture Régionale</h3>
                    <div class="h-64">
                        <canvas id="regionChart"></canvas>
                    </div>
                </div>

                <!-- 3. Évolution Mensuelle -->
                <div class="bg-white p-6 rounded-2xl shadow-sm lg:col-span-2">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 border-b pb-2">Croissance du Catalogue (Derniers 6 mois)
                    </h3>
                    <div class="h-72">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>

                <!-- 4. Statuts -->
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <h3 class="text-lg font-bold text-gray-800 mb-6 border-b pb-2">État des Publications</h3>
                    <div class="h-64 flex justify-center">
                        <canvas id="statutChart"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Palette de couleurs Bénin
            const colors = {
                green: '#008751',
                yellow: '#FCD116',
                red: '#E8112D',
                gray: '#4B5563',
                palette: ['#008751', '#FCD116', '#E8112D', '#10B981', '#F59E0B', '#EF4444', '#3B82F6',
                    '#8B5CF6']
            };

            // 1. CHART TYPE CONTENU (Doughnut)
            new Chart(document.getElementById('typeContenuChart'), {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($charts['types_contenu']['labels'] ?? []) !!},
                    datasets: [{
                        data: {!! json_encode($charts['types_contenu']['data'] ?? []) !!},
                        backgroundColor: colors.palette,
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right'
                        }
                    },
                    cutout: '70%'
                }
            });

            // 2. CHART REGIONS (Bar)
            new Chart(document.getElementById('regionChart'), {
                type: 'bar',
                data: {
                    labels: {!! json_encode($charts['regions']['labels'] ?? []) !!},
                    datasets: [{
                        label: 'Contenus',
                        data: {!! json_encode($charts['regions']['data'] ?? []) !!},
                        backgroundColor: colors.green,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // 3. CHART MENSUEL (Line)
            new Chart(document.getElementById('monthlyChart'), {
                type: 'line',
                data: {
                    labels: {!! json_encode($charts['monthly']['labels'] ?? []) !!},
                    datasets: [{
                        label: 'Nouveaux Contenus',
                        data: {!! json_encode($charts['monthly']['data'] ?? []) !!},
                        borderColor: colors.red,
                        backgroundColor: 'rgba(232, 17, 45, 0.1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: colors.red
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                borderDash: [5, 5]
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // 4. CHART STATUTS (Pie)
            new Chart(document.getElementById('statutChart'), {
                type: 'pie',
                data: {
                    labels: {!! json_encode($charts['statuts']['labels'] ?? []) !!},
                    datasets: [{
                        data: {!! json_encode($charts['statuts']['data'] ?? []) !!},
                        backgroundColor: [colors.green, colors.yellow, colors
                        .gray], // Publié, En attente, Brouillon
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        });
    </script>
@endsection
