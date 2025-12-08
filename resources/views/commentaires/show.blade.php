@extends('layouts.app')

@section('title', 'Avis de ' . $commentaire->utilisateur->prenom . ' - Culture Bénin')

@section('content')
    <div class="relative min-h-screen bg-[#050505] text-white font-sans overflow-hidden flex flex-col justify-center">

        @php
            $bgImage = $commentaire->contenu->image_couverture
                ? asset('storage/' . $commentaire->contenu->image_couverture)
                : asset('img1.jpg'); // Fallback sûr
        @endphp
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-cover bg-center opacity-30 blur-xl scale-110"
                style="background-image: url('{{ $bgImage }}');">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#050505] via-[#050505]/90 to-black/60"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto w-full px-6 py-12">

            <a href="{{ route('contenus.show', $commentaire->contenu) }}"
                class="inline-flex items-center text-gray-400 hover:text-benin-yellow transition mb-8 group">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span class="font-[Oswald] uppercase tracking-wider text-sm">Retour au contenu</span>
            </a>

            <div
                class="bg-gray-900/50 backdrop-blur-md border border-white/10 rounded-2xl p-8 md:p-12 shadow-[0_0_50px_rgba(0,0,0,0.5)]">

                <div
                    class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 border-b border-white/5 pb-6">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 rounded-full bg-gradient-to-br from-benin-green to-gray-800 flex items-center justify-center border border-white/20 shadow-lg">
                            <span class="font-[Oswald] text-xl font-bold text-white">
                                {{ substr($commentaire->utilisateur->prenom ?? 'A', 0, 1) }}
                            </span>
                        </div>
                        <div>
                            <h1 class="text-xl md:text-2xl font-bold text-white leading-none">
                                {{ $commentaire->utilisateur->prenom }} {{ $commentaire->utilisateur->nom }}
                            </h1>
                            <span class="text-xs text-gray-500 uppercase tracking-widest mt-1 block">
                                {{ $commentaire->created_at->translatedFormat('d F Y à H:i') }}
                            </span>
                        </div>
                    </div>

                    @if ($commentaire->note)
                        <div class="flex items-center bg-black/30 px-4 py-2 rounded-full border border-white/5">
                            <div class="flex text-benin-yellow text-lg mr-3">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span>{{ $i <= $commentaire->note ? '★' : '☆' }}</span>
                                @endfor
                            </div>
                            <span class="text-white font-bold font-[Oswald] text-lg">{{ $commentaire->note }}/5</span>
                        </div>
                    @endif
                </div>

                <div class="prose prose-invert prose-lg max-w-none text-gray-200 leading-relaxed font-light">
                    <span class="text-4xl text-benin-yellow opacity-50 font-serif absolute -mt-4 -ml-6">“</span>
                    {!! nl2br(e($commentaire->texte)) !!}
                    <span class="text-4xl text-benin-yellow opacity-50 font-serif align-bottom ml-2">”</span>
                </div>

                <div class="mt-10 pt-6 border-t border-white/5 flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        Concerne : <span class="text-benin-green font-bold">{{ $commentaire->contenu->titre }}</span>
                    </div>

                    @if (Auth::check() && (Auth::user()->id_role === 1 || Auth::id() === $commentaire->id_utilisateur))
                        <div class="flex gap-3">
                            <a href="{{ route('commentaires.edit', $commentaire) }}"
                                class="text-xs font-bold uppercase text-gray-400 hover:text-white transition px-3 py-1 rounded border border-white/10 hover:bg-white/5">
                                Modifier
                            </a>
                            <form action="{{ route('commentaires.destroy', $commentaire) }}" method="POST"
                                onsubmit="return confirm('Supprimer cet avis ?');">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="text-xs font-bold uppercase text-red-500 hover:text-red-400 transition px-3 py-1">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>
@endsection
