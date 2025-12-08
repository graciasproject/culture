@extends('layouts.app')

@section('title', 'Gestion des Utilisateurs - Culture Bénin')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Section -->
            <div class="text-center mb-12" data-aos="fade-down">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Gestion des <span class="text-benin-green">Utilisateurs</span>
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Administrez les membres de la plateforme Culture Bénin
                </p>
            </div>

            <!-- Stats & Actions Bar -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8" data-aos="fade-up">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <div class="flex items-center space-x-6">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-benin-green">{{ $users->count() }}</div>
                            <div class="text-sm text-gray-500">Utilisateurs</div>
                        </div>
                        <div class="hidden md:block w-px h-8 bg-gray-300"></div>
                        <div class="text-center">
                            @php
                                $activeUsers = $users->where('statut', 'actif')->count();
                            @endphp
                            <div class="text-2xl font-bold text-benin-yellow">{{ $activeUsers }}</div>
                            <div class="text-sm text-gray-500">Actifs</div>
                        </div>
                        <div class="hidden md:block w-px h-8 bg-gray-300"></div>
                        <div class="text-center">
                            @php
                                $moderators = $users->where('role.nom', 'Modérateur')->count();
                            @endphp
                            <div class="text-2xl font-bold text-benin-red">{{ $moderators }}</div>
                            <div class="text-sm text-gray-500">Modérateurs</div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('admin.users.create') }}"
                            class="bg-benin-green text-white px-6 py-3 rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium shadow-lg flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Nouvel Utilisateur
                        </a>
                    </div>
                </div>
            </div>

            <!-- Users Table -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden" data-aos="fade-up">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Utilisateur
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Rôle
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Langue
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Statut
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Contenus
                                </th>
                                <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($users as $user)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <!-- User Info -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if ($user->photo)
                                                    <img class="h-10 w-10 rounded-full object-cover"
                                                        src="{{ asset('storage/' . $user->photo) }}"
                                                        alt="{{ $user->prenom }}">
                                                @else
                                                    <div
                                                        class="h-10 w-10 rounded-full bg-benin-green flex items-center justify-center">
                                                        <span class="text-white font-medium text-sm">
                                                            {{ strtoupper(substr($user->prenom, 0, 1)) }}{{ strtoupper(substr($user->nom, 0, 1)) }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $user->prenom }} {{ $user->nom }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $user->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Role -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $user->role->nom === 'Administrateur'
                                        ? 'bg-red-100 text-red-800'
                                        : ($user->role->nom === 'Modérateur'
                                            ? 'bg-blue-100 text-blue-800'
                                            : 'bg-gray-100 text-gray-800') }}">
                                            {{ $user->role->nom }}
                                        </span>
                                    </td>

                                    <!-- Language -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $user->langue->nom_langue ?? 'Non défini' }}
                                    </td>

                                    <!-- Status -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $user->statut === 'actif'
                                        ? 'bg-green-100 text-green-800'
                                        : ($user->statut === 'inactif'
                                            ? 'bg-red-100 text-red-800'
                                            : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ ucfirst($user->statut) }}
                                        </span>
                                    </td>

                                    <!-- Contents Count -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $user->contenus_count ?? 0 }}
                                    </td>

                                    <!-- Actions -->
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-2">
                                            <a href="{{ route('admin.users.show', $user) }}"
                                                class="text-benin-green hover:text-benin-dark-green transition-colors duration-300 transform hover:scale-110"
                                                title="Voir le profil">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>

                                            <a href="{{ route('admin.users.edit', $user) }}"
                                                class="text-blue-600 hover:text-blue-800 transition-colors duration-300 transform hover:scale-110"
                                                title="Modifier">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div
                                            class="w-24 h-24 mx-auto mb-4 bg-gray-200 rounded-full flex items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Aucun utilisateur trouvé</h3>
                                        <p class="text-gray-600 mb-8 max-w-md mx-auto">
                                            Commencez par créer le premier utilisateur de la plateforme.
                                        </p>
                                        <a href="{{ route('users.create') }}"
                                            class="bg-benin-green text-white px-8 py-4 rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium shadow-lg inline-flex items-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Créer le premier utilisateur
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
