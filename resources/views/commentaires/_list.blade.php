<!-- Resources/views/commentaires/_list.blade.php -->
<div class="space-y-6">
    @foreach($commentaires as $commentaire)
    <div class="bg-white rounded-2xl shadow-lg p-6" data-aos="fade-up">
        <div class="flex space-x-4">
            <!-- Avatar -->
            <div class="flex-shrink-0">
                @if($commentaire->utilisateur->photo)
                    <img class="h-10 w-10 rounded-full object-cover" 
                         src="{{ asset('storage/' . $commentaire->utilisateur->photo) }}" 
                         alt="{{ $commentaire->utilisateur->prenom }}">
                @else
                    <div class="h-10 w-10 rounded-full bg-benin-green flex items-center justify-center">
                        <span class="text-white font-medium text-sm">
                            {{ strtoupper(substr($commentaire->utilisateur->prenom, 0, 1)) }}{{ strtoupper(substr($commentaire->utilisateur->nom, 0, 1)) }}
                        </span>
                    </div>
                @endif
            </div>

            <!-- Content -->
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center space-x-2">
                        <span class="font-medium text-gray-900">
                            {{ $commentaire->utilisateur->prenom }} {{ $commentaire->utilisateur->nom }}
                        </span>
                        <span class="text-sm text-gray-500">{{ $commentaire->created_at->diffForHumans() }}</span>
                    </div>

                    <!-- Actions -->
                    @auth
                        @if(auth()->id() === $commentaire->id_utilisateur || auth()->user()->role->nom === 'Administrateur')
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('commentaires.edit', $commentaire) }}" 
                               class="text-blue-600 hover:text-blue-800 transition-colors duration-300 transform hover:scale-110"
                               title="Modifier">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                        </div>
                        @endif
                    @endauth
                </div>

                <!-- Comment Text -->
                <p class="text-gray-700 leading-relaxed">{{ $commentaire->texte }}</p>

                <!-- Note -->
                @if($commentaire->note)
                <div class="flex items-center space-x-1 mt-3">
                    @for($i = 1; $i <= 5; $i++)
                        <svg class="w-4 h-4 {{ $i <= $commentaire->note ? 'text-benin-yellow' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    @endfor
                    <span class="text-sm text-gray-500 ml-2">{{ $commentaire->note }}/5</span>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endforeach

    <!-- Empty State -->
    @if($commentaires->isEmpty())
    <div class="text-center py-12" data-aos="fade-up">
        <div class="w-16 h-16 mx-auto mb-4 bg-gray-200 rounded-full flex items-center justify-center">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Aucun commentaire</h3>
        <p class="text-gray-600">Soyez le premier à commenter ce contenu !</p>
    </div>
    @endif
</div>