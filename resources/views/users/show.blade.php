@extends('layouts.app')

@section('title', $user->prenom . ' ' . $user->nom . ' - Culture Bénin')

@section('content')
    <div class="min-h-screen bg-gray-50">

        <div class="relative h-80 w-full bg-gray-900 overflow-hidden group">

            <div class="absolute inset-0">
                <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->prenom }}"
                    class="w-full h-full object-cover opacity-40 group-hover:scale-105 transition-transform duration-1000">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0b0b0b] via-[#0b0b0b]/60 to-transparent"></div>
            </div>

            <div class="absolute bottom-0 left-0 w-full p-6 md:p-10 z-10">
                <div class="flex flex-col md:flex-row items-end justify-between gap-6">

                    <div class="flex items-end gap-6">
                        <div class="relative group-hover:-translate-y-2 transition-transform duration-300">
                            @if ($user->photo)
                                <img class="h-32 w-32 md:h-40 md:w-40 rounded-full object-cover border-4 border-white/10 shadow-2xl"
                                    src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->prenom }}">
                            @else
                                <div
                                    class="h-32 w-32 md:h-40 md:w-40 rounded-full bg-white/10 border-4 border-white/10 flex items-center justify-center backdrop-blur-md shadow-2xl">
                                    <span class="text-white font-bold text-4xl">
                                        {{ strtoupper(substr($user->prenom, 0, 1)) }}{{ strtoupper(substr($user->nom, 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                            <div class="absolute bottom-2 right-2 w-5 h-5 rounded-full border-4 border-[#0b0b0b] {{ $user->statut === 'Actif' ? 'bg-green-500' : 'bg-red-500' }}"
                                title="Statut {{ $user->statut }}"></div>
                        </div>

                        <div class="mb-2 hidden md:block">
                            <h1 class="text-4xl md:text-5xl font-bold text-white mb-2 tracking-tight drop-shadow-lg">
                                {{ $user->prenom }} {{ $user->nom }}
                            </h1>
                            <div class="flex items-center gap-3 text-gray-300 text-sm">
                                <span class="bg-white/10 px-3 py-1 rounded-full border border-white/10 backdrop-blur-sm">
                                    {{ $user->role->nom }}
                                </span>
                                <span class="bg-white/10 px-3 py-1 rounded-full border border-white/10 backdrop-blur-sm">
                                    {{ $user->langue->nom_langue ?? 'N/A' }}
                                </span>
                                <span class="flex items-center ml-2">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    {{ $user->email }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 mb-2 w-full md:w-auto">
                        <a href="{{ route('admin.users.edit', $user) }}"
                            class="flex-1 md:flex-none justify-center px-6 py-3 bg-benin-green hover:bg-green-700 text-white font-bold rounded-xl shadow-lg shadow-green-900/20 transition-all transform hover:-translate-y-1 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            Modifier le profil
                        </a>

                        <a href="{{ route('admin.users.index') }}"
                            class="px-4 py-3 bg-white/10 hover:bg-white/20 text-white font-medium rounded-xl backdrop-blur-md border border-white/10 transition-colors"
                            title="Retour à la liste">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="mt-4 md:hidden">
                    <h1 class="text-3xl font-bold text-white mb-1">{{ $user->prenom }} {{ $user->nom }}</h1>
                    <p class="text-gray-400 text-sm mb-2">{{ $user->email }}</p>
                    <span
                        class="inline-block bg-white/10 px-3 py-1 rounded-full text-xs text-gray-300 border border-white/10">
                        {{ $user->role->nom }}
                    </span>
                </div>
            </div>
        </div>

        <section class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

                <article class="lg:col-span-3 space-y-8">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center hover:shadow-md transition-shadow"
                            data-aos="fade-up">
                            <div
                                class="w-12 h-12 mx-auto mb-4 bg-benin-green/10 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-benin-green" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="text-3xl font-bold text-gray-900 mb-1">{{ $user->contenus->count() }}</div>
                            <div class="text-sm text-gray-500 font-medium">Contenus créés</div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center hover:shadow-md transition-shadow"
                            data-aos="fade-up" data-aos-delay="100">
                            <div
                                class="w-12 h-12 mx-auto mb-4 bg-benin-yellow/10 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-benin-yellow" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>
                            <div class="text-3xl font-bold text-gray-900 mb-1">{{ $user->commentaires->count() }}</div>
                            <div class="text-sm text-gray-500 font-medium">Commentaires</div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center hover:shadow-md transition-shadow"
                            data-aos="fade-up" data-aos-delay="200">
                            <div
                                class="w-12 h-12 mx-auto mb-4 bg-benin-red/10 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-benin-red" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="text-3xl font-bold text-gray-900 mb-1">{{ $user->created_at->diffInDays(now()) }}
                            </div>
                            <div class="text-sm text-gray-500 font-medium">Jours d'activité</div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8" data-aos="fade-up">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-bold text-gray-900">Dernières publications</h2>
                        </div>

                        <div class="space-y-4">
                            @forelse($user->contenus->take(5) as $contenu)
                                <a href="{{ route('admin.contenus.show', $contenu) }}"
                                    class="block p-4 rounded-xl border border-gray-100 hover:border-benin-green hover:bg-green-50/30 transition-all duration-300 group">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1 min-w-0">
                                            <h3
                                                class="font-semibold text-gray-900 group-hover:text-benin-green transition-colors duration-300 truncate text-lg">
                                                {{ $contenu->titre }}
                                            </h3>
                                            <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                                                <span class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                    {{ $contenu->created_at->format('d/m/Y') }}
                                                </span>
                                                <span
                                                    class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded text-xs border border-gray-200">
                                                    {{ $contenu->typeContenu->nom ?? 'Culture' }}
                                                </span>
                                                <span
                                                    class="bg-{{ $contenu->statut === 'publié' ? 'green' : 'yellow' }}-100 text-{{ $contenu->statut === 'publié' ? 'green' : 'yellow' }}-800 px-2 py-0.5 rounded text-xs uppercase font-bold tracking-wide">
                                                    {{ $contenu->statut }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 p-2 rounded-full group-hover:bg-white transition-colors">
                                            <svg class="w-5 h-5 text-gray-400 group-hover:text-benin-green" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="text-center py-12 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                    <p class="text-gray-500 font-medium">Aucun contenu publié</p>
                                </div>
                            @endforelse
                        </div>

                        @if ($user->contenus->count() > 5)
                            <div class="mt-8 text-center border-t border-gray-100 pt-6">
                                <a href="{{ route('admin.contenus.index') }}?auteur={{ $user->id }}"
                                    class="inline-flex items-center px-4 py-2 rounded-lg text-benin-green hover:bg-benin-green/5 transition-colors font-medium">
                                    Voir tout l'historique
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            </div>
                        @endif
                    </div>
                </article>

                <aside class="lg:col-span-1 space-y-6" data-aos="fade-left" data-aos-delay="300">

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-benin-yellow" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            À propos
                        </h3>

                        <div class="space-y-4">
                            <div class="flex justify-between items-center py-2 border-b border-gray-50 last:border-0">
                                <span class="text-gray-500 text-sm">Genre</span>
                                <span class="font-medium text-gray-900 bg-gray-50 px-2 py-1 rounded">
                                    {{ $user->sexe === 'M' ? 'Masculin' : 'Féminin' }}
                                </span>
                            </div>

                            <div class="flex justify-between items-center py-2 border-b border-gray-50 last:border-0">
                                <span class="text-gray-500 text-sm">Naissance</span>
                                <span class="font-medium text-gray-900">
                                    {{ $user->date_naissance ? $user->date_naissance->format('d/m/Y') : 'Non renseigné' }}
                                </span>
                            </div>

                            <div class="flex justify-between items-center py-2 border-b border-gray-50 last:border-0">
                                <span class="text-gray-500 text-sm">Âge</span>
                                <span class="font-medium text-gray-900">
                                    {{ $user->date_naissance ? $user->date_naissance->age . ' ans' : '-' }}
                                </span>
                            </div>

                            <div class="flex justify-between items-center py-2 border-b border-gray-50 last:border-0">
                                <span class="text-gray-500 text-sm">Inscription</span>
                                <span class="font-medium text-gray-900">
                                    {{ $user->created_at->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>
                    </div>

                </aside>
            </div>
        </section>
    </div>
@endsection
