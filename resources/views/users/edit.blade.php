@extends('layouts.app')

@section('title', 'Modifier ' . $user->prenom . ' ' . $user->nom . ' - Culture Bénin')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12" data-aos="fade-down">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Modifier l'<span class="text-benin-green">utilisateur</span>
            </h1>
            <p class="text-xl text-gray-600">
                Mettez à jour les informations de {{ $user->prenom }} {{ $user->nom }}
            </p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden" data-aos="fade-up">
            <div class="benin-gradient px-6 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white">Modification de l'utilisateur</h2>
                    <div class="flex items-center space-x-2">
                        @if($user->photo)
                            <img class="h-8 w-8 rounded-full object-cover border border-white/20" 
                                 src="{{ asset('storage/' . $user->photo) }}" 
                                 alt="{{ $user->prenom }}">
                        @else
                            <div class="h-8 w-8 rounded-full bg-white/20 border border-white/20 flex items-center justify-center">
                                <span class="text-white font-medium text-xs">
                                    {{ strtoupper(substr($user->prenom, 0, 1)) }}{{ strtoupper(substr($user->nom, 0, 1)) }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- Personal Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations personnelles</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Prénom -->
                        <div>
                            <label for="prenom" class="block text-sm font-medium text-gray-700 mb-2">
                                Prénom *
                            </label>
                            <input type="text" 
                                   id="prenom" 
                                   name="prenom" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300"
                                   value="{{ old('prenom', $user->prenom) }}">
                            @error('prenom')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nom -->
                        <div>
                            <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">
                                Nom *
                            </label>
                            <input type="text" 
                                   id="nom" 
                                   name="nom" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300"
                                   value="{{ old('nom', $user->nom) }}">
                            @error('nom')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sexe -->
                        <div>
                            <label for="sexe" class="block text-sm font-medium text-gray-700 mb-2">
                                Sexe *
                            </label>
                            <select id="sexe" 
                                    name="sexe" 
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300">
                                <option value="">Sélectionnez</option>
                                <option value="M" {{ old('sexe', $user->sexe) == 'M' ? 'selected' : '' }}>Masculin</option>
                                <option value="F" {{ old('sexe', $user->sexe) == 'F' ? 'selected' : '' }}>Féminin</option>
                            </select>
                            @error('sexe')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date de naissance -->
                        <div>
                            <label for="date_naissance" class="block text-sm font-medium text-gray-700 mb-2">
                                Date de naissance *
                            </label>
                            <input type="date" 
                                   id="date_naissance" 
                                   name="date_naissance" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300"
                                   value="{{ old('date_naissance', $user->date_naissance->format('Y-m-d')) }}">
                            @error('date_naissance')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Account Information -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations du compte</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Email -->
                        <div class="md:col-span-2">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email *
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300"
                                   value="{{ old('email', $user->email) }}">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Mot de passe -->
                        <div>
                            <label for="mot_de_passe" class="block text-sm font-medium text-gray-700 mb-2">
                                Nouveau mot de passe
                            </label>
                            <input type="password" 
                                   id="mot_de_passe" 
                                   name="mot_de_passe" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300"
                                   placeholder="Laissez vide pour ne pas changer">
                            @error('mot_de_passe')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirmation mot de passe -->
                        <div>
                            <label for="mot_de_passe_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                Confirmer le mot de passe
                            </label>
                            <input type="password" 
                                   id="mot_de_passe_confirmation" 
                                   name="mot_de_passe_confirmation" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300"
                                   placeholder="Répétez le nouveau mot de passe">
                        </div>
                    </div>
                </div>

                <!-- Preferences & Role -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Préférences et rôle</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Langue -->
                        <div>
                            <label for="id_langue" class="block text-sm font-medium text-gray-700 mb-2">
                                Langue préférée *
                            </label>
                            <select id="id_langue" 
                                    name="id_langue" 
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300">
                                <option value="">Sélectionnez une langue</option>
                                @foreach($langues as $langue)
                                <option value="{{ $langue->id }}" {{ old('id_langue', $user->id_langue) == $langue->id ? 'selected' : '' }}>
                                    {{ $langue->nom_langue }}
                                </option>
                                @endforeach
                            </select>
                            @error('id_langue')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Rôle -->
                        <div>
                            <label for="id_role" class="block text-sm font-medium text-gray-700 mb-2">
                                Rôle *
                            </label>
                            <select id="id_role" 
                                    name="id_role" 
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300">
                                <option value="">Sélectionnez un rôle</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('id_role', $user->id_role) == $role->id ? 'selected' : '' }}>
                                    {{ $role->nom }}
                                </option>
                                @endforeach
                            </select>
                            @error('id_role')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Statut -->
                        <div>
                            <label for="statut" class="block text-sm font-medium text-gray-700 mb-2">
                                Statut *
                            </label>
                            <select id="statut" 
                                    name="statut" 
                                    required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300">
                                <option value="">Sélectionnez un statut</option>
                                <option value="actif" {{ old('statut', $user->statut) == 'actif' ? 'selected' : '' }}>Actif</option>
                                <option value="inactif" {{ old('statut', $user->statut) == 'inactif' ? 'selected' : '' }}>Inactif</option>
                                <option value="en_attente" {{ old('statut', $user->statut) == 'en_attente' ? 'selected' : '' }}>En attente</option>
                            </select>
                            @error('statut')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Photo -->
                        <div>
                            <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">
                                Photo de profil
                            </label>
                            
                            <!-- Current Photo -->
                            @if($user->photo)
                            <div class="mb-3">
                                <p class="text-sm text-gray-600 mb-2">Photo actuelle :</p>
                                <img src="{{ asset('storage/' . $user->photo) }}" 
                                     alt="{{ $user->prenom }}"
                                     class="w-20 h-20 rounded-full object-cover border border-gray-300">
                            </div>
                            @endif

                            <input type="file" 
                                   id="photo" 
                                   name="photo" 
                                   accept="image/*"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-benin-green focus:border-transparent transition-all duration-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-benin-green file:text-white hover:file:bg-benin-dark-green">
                            @error('photo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Formats: JPG, PNG, WEBP. Max: 2MB</p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row justify-between space-y-4 sm:space-y-0 sm:space-x-6 pt-6 border-t border-gray-200">
                    <div class="flex space-x-4">
                        <a href="{{ route('users.show', $user) }}" 
                           class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-300 text-center font-medium">
                           Annuler
                        </a>
                        
                        <button type="button"
                                onclick="confirmDelete()"
                                class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-all duration-300 transform hover:scale-105 font-medium shadow-lg">
                            Supprimer
                        </button>
                    </div>
                    
                    <button type="submit" 
                            class="px-6 py-3 bg-benin-green text-white rounded-lg hover:bg-benin-dark-green transition-all duration-300 transform hover:scale-105 font-medium shadow-lg">
                        💾 Enregistrer les modifications
                    </button>
                </div>
            </form>

            <!-- Delete Form -->
            <form id="delete-form" action="{{ route('users.destroy', $user) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>

    </div>
</div>

<script>
function confirmDelete() {
    if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.')) {
        document.getElementById('delete-form').submit();
    }
}

// Image preview
document.getElementById('photo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Remove existing preview if any
            const existingPreview = document.getElementById('photo-preview');
            if (existingPreview) {
                existingPreview.remove();
            }
            
            // Create new preview
            const preview = document.createElement('div');
            preview.id = 'photo-preview';
            preview.className = 'mb-3';
            preview.innerHTML = `
                <p class="text-sm text-gray-600 mb-2">Nouvelle photo :</p>
                <img src="${e.target.result}" 
                     alt="Preview" 
                     class="w-20 h-20 rounded-full object-cover border border-gray-300">
            `;
            
            // Insert before the file input
            document.getElementById('photo').parentNode.insertBefore(preview, document.getElementById('photo'));
        };
        reader.readAsDataURL(file);
    }
});
</script>

<style>
    input:focus, select:focus, textarea:focus {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 135, 81, 0.1);
    }
</style>
@endsection