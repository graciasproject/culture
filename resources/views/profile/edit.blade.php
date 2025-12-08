@extends('layouts.app')

@section('title', 'Mon Profil - Culture Bénin')

@section('content')
    <div class="min-h-screen bg-[#0b0b0b] text-gray-100 py-12 font-sans selection:bg-benin-green selection:text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- En-tête -->
            <div class="mb-10" data-aos="fade-down">
                <h1 class="text-4xl font-[Oswald] font-bold text-white mb-2">Mon Profil</h1>
                <p class="text-gray-400">Gérez vos informations personnelles et vos préférences de sécurité.</p>
            </div>

            <div class="space-y-8">

                <!-- 1. INFORMATIONS DE PROFIL -->
                <div class="bg-gray-900 rounded-2xl p-8 border border-gray-800 shadow-xl" data-aos="fade-up">
                    <div class="flex flex-col md:flex-row gap-8">
                        <!-- Avatar (Visuel) -->
                        <div class="flex flex-col items-center space-y-4">
                            <div
                                class="w-24 h-24 rounded-full bg-gradient-to-br from-benin-green to-teal-900 flex items-center justify-center text-3xl font-bold text-white border-4 border-gray-800 shadow-lg">
                                {{ substr($user->prenom, 0, 1) }}
                            </div>
                            <span
                                class="px-3 py-1 bg-gray-800 text-gray-400 text-xs rounded-full uppercase tracking-wider font-bold">
                                {{ $user->id_role === 1 ? 'Administrateur' : 'Lecteur' }}
                            </span>
                        </div>

                        <!-- Formulaire -->
                        <div class="flex-1 w-full">
                            <h2 class="text-xl font-bold text-white mb-1">Vos Informations</h2>
                            <p class="text-sm text-gray-500 mb-6">Mettez à jour vos informations de compte.</p>

                            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                                @csrf
                                @method('patch')

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="nom"
                                            class="block text-sm font-medium text-gray-400 mb-2">Nom</label>
                                        <input type="text" name="nom" id="nom"
                                            value="{{ old('nom', $user->nom) }}" required
                                            class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-benin-green focus:border-transparent transition outline-none">
                                        @error('nom')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="prenom"
                                            class="block text-sm font-medium text-gray-400 mb-2">Prénom</label>
                                        <input type="text" name="prenom" id="prenom"
                                            value="{{ old('prenom', $user->prenom) }}" required
                                            class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-benin-green focus:border-transparent transition outline-none">
                                        @error('prenom')
                                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-400 mb-2">Adresse
                                        Email</label>
                                    <input type="email" name="email" id="email"
                                        value="{{ old('email', $user->email) }}" required
                                        class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-benin-green focus:border-transparent transition outline-none">
                                    @error('email')
                                        <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="px-6 py-2 bg-benin-green hover:bg-green-700 text-white font-bold rounded-lg transition shadow-lg shadow-green-900/20">
                                        Sauvegarder
                                    </button>
                                </div>

                                @if (session('status') === 'profile-updated')
                                    <p class="text-sm text-green-500 mt-2 text-right" x-data="{ show: true }" x-show="show"
                                        x-transition x-init="setTimeout(() => show = false, 2000)">Sauvegardé.</p>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>

                <!-- 2. SÉCURITÉ (Mot de passe) -->
                <div class="bg-gray-900 rounded-2xl p-8 border border-gray-800 shadow-xl" data-aos="fade-up"
                    data-aos-delay="100">
                    <h2 class="text-xl font-bold text-white mb-1">Sécurité</h2>
                    <p class="text-sm text-gray-500 mb-6">Assurez-vous d'utiliser un mot de passe long et aléatoire.</p>

                    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                        @csrf
                        @method('put')

                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-400 mb-2">Mot de passe
                                actuel</label>
                            <input type="password" name="current_password" id="current_password"
                                autocomplete="current-password"
                                class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-benin-yellow focus:border-transparent transition outline-none">
                            @error('current_password')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-400 mb-2">Nouveau mot de
                                    passe</label>
                                <input type="password" name="password" id="password" autocomplete="new-password"
                                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-benin-yellow focus:border-transparent transition outline-none">
                                @error('password')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation"
                                    class="block text-sm font-medium text-gray-400 mb-2">Confirmer le mot de passe</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    autocomplete="new-password"
                                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-benin-yellow focus:border-transparent transition outline-none">
                                @error('password_confirmation')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="px-6 py-2 bg-gray-700 hover:bg-benin-yellow hover:text-black text-white font-bold rounded-lg transition">
                                Mettre à jour
                            </button>
                        </div>

                        @if (session('status') === 'password-updated')
                            <p class="text-sm text-green-500 mt-2 text-right">Mot de passe mis à jour.</p>
                        @endif
                    </form>
                </div>

                <!-- 3. ZONE DANGER -->
                <div class="bg-red-900/10 rounded-2xl p-8 border border-red-900/30" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-xl font-bold text-red-500 mb-1">Supprimer le compte</h2>
                            <p class="text-sm text-gray-500">Une fois votre compte supprimé, toutes ses ressources et
                                données seront définitivement effacées.</p>
                        </div>
                        <button onclick="document.getElementById('deleteModal').classList.remove('hidden')"
                            class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg transition shadow-lg shadow-red-900/20 whitespace-nowrap ml-4">
                            Supprimer mon compte
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <!-- MODAL DE CONFIRMATION (Caché par défaut) -->
        <div id="deleteModal"
            class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm">
            <div
                class="bg-gray-900 border border-gray-800 rounded-2xl p-8 max-w-md w-full shadow-2xl transform transition-all">
                <h2 class="text-xl font-bold text-white mb-4">Êtes-vous sûr ?</h2>
                <p class="text-gray-400 mb-6">
                    Cette action est irréversible. Veuillez entrer votre mot de passe pour confirmer la suppression
                    définitive de votre compte.
                </p>

                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="mb-6">
                        <input type="password" name="password" placeholder="Votre mot de passe" required
                            class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-white focus:ring-2 focus:ring-red-500 outline-none">
                        @error('password', 'userDeletion')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="document.getElementById('deleteModal').classList.add('hidden')"
                            class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition">
                            Annuler
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg transition">
                            Confirmer la suppression
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
