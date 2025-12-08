@extends('layouts.app')
@section('title', 'Modération des Commentaires')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-10" data-aos="fade-down">
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white">
                    Modération des <span class="text-benin-yellow">Commentaires</span>
                </h1>
                <p class="text-gray-500 dark:text-gray-400">Liste des derniers commentaires à examiner.</p>
            </div>

            <div class="space-y-6" data-aos="fade-up">
                @forelse($commentaires as $comment)
                    <div
                        class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-lg border-l-4 border-benin-yellow hover:shadow-xl transition-all duration-300">
                        <div class="flex justify-between items-start mb-4">

                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-benin-yellow/20 flex items-center justify-center text-benin-yellow font-bold text-sm">
                                    {{ substr($comment->utilisateur->prenom ?? 'A', 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 dark:text-white">
                                        {{ $comment->utilisateur->prenom ?? 'Anonyme' }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Posté
                                        {{ $comment->created_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4">
                                <a href="{{ route('contenus.show', $comment->contenu_id) }}" target="_blank"
                                    class="px-3 py-1 text-sm font-semibold rounded-full bg-benin-green/10 text-benin-green hover:bg-benin-green hover:text-white transition flex items-center">
                                    Voir le Contenu
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </a>

                                <form action="{{ route('commentaires.destroy', $comment->id) }}" method="POST"
                                    onsubmit="return confirm('Supprimer ce commentaire abusif ?');">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="p-2 bg-red-100 dark:bg-red-900/30 text-red-600 rounded-full hover:bg-red-200 transition"
                                        title="Supprimer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div
                            class="p-4 bg-gray-50 dark:bg-gray-900/50 rounded-lg text-gray-700 dark:text-gray-300 border-l-4 border-gray-200 dark:border-gray-700 italic">
                            <svg class="w-4 h-4 inline mr-2 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M13.5 10H17V17H13.5V21L9.75 17.25H4V4H13.5V10ZM15 6H6V15.75L10.5 11.25H14.25V6H15Z" />
                            </svg>
                            {{ $comment->texte }}
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16 bg-white dark:bg-gray-800 rounded-2xl shadow-xl">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Aucun commentaire en attente</h3>
                        <p class="text-gray-500 mt-2">La boîte de modération est vide. Bon travail !</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $commentaires->links() }}
            </div>
        </div>
    </div>
@endsection
