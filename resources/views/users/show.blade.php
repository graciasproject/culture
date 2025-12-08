@extends('layouts.app')

@section('title', $user->prenom . ' ' . $user->nom . ' - Culture Bénin')

@section('content')
<div class="min-h-screen bg-white">
    <!-- Hero Section -->
    <section class="benin-gradient text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-black/40"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-8">
                <!-- Profile Photo -->
                <div class="flex-shrink-0" data-aos="fade-right">
                    @if($user->photo)
                        <img class="h-32 w-32 rounded-full object-cover border-4 border-white/20" 
                             src="{{ asset('storage/' . $user->photo) }}" 
                             alt="{{ $user->prenom }}">
                    @else
                        <div class="h-32 w-32 rounded-full bg-white/20 border-4 border-white/20 flex items-center justify-center">
                            <span class="text-white font-bold text-3xl">
                                {{ strtoupper(substr($user->prenom, 0, 1)) }}{{ strtoupper(substr($user->nom, 0, 1)) }}
                            </span>
                        </div>
                    @endif
                </div>

                <!-- User Info -->
                <div class="text-center md:text-left flex-1" data-aos="fade-left">
                    <h1 class="text-4xl md:text-5xl font-bold mb-2 text-glow">
                        {{ $user->prenom }} {{ $user->nom }}
                    </h1>
                    
                    <div class="flex flex-wrap justify-center md:justify-start items-center gap-4 text-sm mb-4">
                        <!-- Role -->
                        <span class="bg-white/20 backdrop-blur-sm rounded-full px-4 py-2">
                            {{ $user->role->nom }}
                        </span>
                        
                        <!-- Status -->
                        <span class="bg-white/20 backdrop-blur-sm rounded-full px-4 py-2">
                            {{ ucfirst($user->statut) }}
                        </span>
                        
                        <!-- Language -->
                        <span class="bg-white/20 backdrop-blur-sm rounded-full px-4 py-2">
                            {{ $user->langue->nom_langue ?? 'Langue non définie' }}
                        </span>
                    </div>

                    <!-- Contact -->
                    <div class="text-white/90">
                        <p class="flex items-center justify-center md:justify-start space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ $user->email }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="max-w-6xl mx-auto px-4 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <article class="lg:col-span-3 space-y-8">
                <!-- Statistics -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Contenus Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 text-center" data-aos="fade-up">
                        <div class="w-12 h-12 mx-auto mb-4 bg-benin-green/10 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-benin-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-gray-900 mb-1">
                            {{ $user->contenus->count() }}
                        </div>
                        <div class="text-sm text-gray-500">Contenus créés</div>
                    </div>

                    <!-- Commentaires Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 text-center" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-12 h-12 mx-auto mb-4 bg-benin-yellow/10 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-benin-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-gray-900 mb-1">
                            {{ $user->commentaires->count() }}
                        </div>
                        <div class="text-sm text-gray-500">Commentaires</div>
                    </div>

                    <!-- Membre depuis Card -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 text-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-12 h-12 mx-auto mb-4 bg-benin-red/10 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-benin-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="text-2xl font-bold text-gray-900 mb-1">
                            {{ $user->created_at->diffInDays(now()) }}
                        </div>
                        <div class="text-sm text-gray-500">Jours</div>
                    </div>
                </div>

                <!-- Recent Contents -->
                <div class="bg-white rounded-2xl shadow-lg p-8" data-aos="fade-up">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Contenus récents</h2>
                        <span class="bg-benin-green/10 text-benin-green px-3 py-1 rounded-full text-sm font-medium">
                            {{ $user->contenus->count() }} au total
                        </span>
                    </div>
                    
                    <div class="space-y-4">
                        @forelse($user->contenus->take(5) as $contenu)
                        <a href="{{ route('contenus.show', $contenu) }}" 
                           class="block p-4 rounded-lg border border-gray-200 hover:border-benin-green hover:bg-gray-50 transition-all duration-300 group">
                            <div class="flex items-center justify-between">
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-semibold text-gray-900 group-hover:text-benin-green transition-colors duration-300 truncate">
                                        {{ $contenu->titre }}
                                    </h3>
                                    <div class="flex items-center space-x-4 mt-1 text-sm text-gray-500">
                                        <span>{{ $contenu->created_at->format('d/m/Y') }}</span>
                                        <span class="bg-gray-100 px-2 py-1 rounded text-xs">
                                            {{ $contenu->typeContenu->nom ?? 'Culture' }}
                                        </span>
                                        <span class="bg-gray-100 px-2 py-1 rounded text-xs">
                                            {{ $contenu->statut }}
                                        </span>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-benin-green transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </a>
                        @empty
                        <div class="text-center py-8">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="text-gray-500">Aucun contenu créé pour le moment</p>
                        </div>
                        @endforelse
                    </div>

                    @if($user->contenus->count() > 5)
                    <div class="mt-6 text-center">
                        <a href="{{ route('contenus.index') }}?auteur={{ $user->id }}" 
                           class="inline-flex items-center text-benin-green hover:text-benin-dark-green transition-colors duration-300 font-medium">
                           Voir tous les contenus
                           <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                           </svg>
                        </a>
                    </div>
                    @endif
                </div>
            </article>

            <!-- Sidebar -->
            <aside class="lg:col-span-1 space-y-6" data-aos="fade-left" data-aos-delay="300">
                <!-- Actions Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('users.edit', $user) }}" 
                           class="w-full flex items-center justify-center space-x-2 bg-benin-green text-white px-4 py-3 rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium">
                           <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                           </svg>
                           <span>Modifier</span>
                        </a>
                        
                        <a href="{{ route('users.index') }}" 
                           class="w-full flex items-center justify-center space-x-2 border border-gray-300 text-gray-700 px-4 py-3 rounded-lg hover:bg-gray-50 transition-all duration-300 font-medium">
                           <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                           </svg>
                           <span>Retour à la liste</span>
                        </a>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Informations</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Sexe</span>
                            <span class="font-medium text-gray-900">
                                {{ $user->sexe === 'M' ? 'Masculin' : 'Féminin' }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Date de naissance</span>
                            <span class="font-medium text-gray-900">
                                {{ $user->date_naissance->format('d/m/Y') }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Âge</span>
                            <span class="font-medium text-gray-900">
                                {{ $user->date_naissance->age }} ans
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Membre depuis</span>
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