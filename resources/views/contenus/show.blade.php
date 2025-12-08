@extends('layouts.app')

@section('title', $contenu->titre)

@section('content')
    @if (session('error'))
        <div class="bg-red-600 text-white text-center p-4 font-bold animate-pulse">
            ERREUR : {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-600 text-white text-center p-4 font-bold">
            {{ session('success') }}
        </div>
    @endif
    <div class="bg-[#050505] min-h-screen text-gray-100 font-sans">

        <div class="w-full bg-black relative border-b border-gray-800" style="height: 70vh;">
            @if ($hasPaid)
                <video poster="{{ $contenu->image_couverture_display }}" controls autoplay
                    class="w-full h-full object-contain" id="mainPlayer">
                    <source src="{{ $contenu->video_url_display }}" type="video/mp4">
                </video>
            @else
                <div class="absolute inset-0 bg-cover bg-center blur-md opacity-40"
                    style="background-image: url('{{ $contenu->image_couverture_display }}');">
                </div>

                <div class="absolute inset-0 flex flex-col items-center justify-center text-center z-10 p-4">
                    <div class="mb-4 p-4 rounded-full bg-white/10 backdrop-blur-md animate-pulse">
                        <svg class="w-10 h-10 text-benin-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold font-[Oswald] uppercase mb-2">Contenu Premium</h1>

                    <form action="{{ route('payment.pay', $contenu->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="mt-4 px-8 py-3 bg-benin-yellow text-black font-bold rounded-full hover:scale-105 transition shadow-[0_0_15px_rgba(252,209,22,0.5)]">
                            Débloquer pour {{ $contenu->prix > 0 ? $contenu->prix : 200 }} FCFA
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                <div class="lg:col-span-2">
                    <div class="border-b border-gray-800 pb-6 mb-8">
                        <div class="flex flex-wrap gap-3 mb-4">
                            <span class="px-3 py-1 bg-green-900/30 text-green-400 rounded text-xs font-bold uppercase">
                                {{ $contenu->region->nom_region ?? 'Bénin' }}
                            </span>
                            <span class="px-3 py-1 bg-yellow-900/30 text-yellow-400 rounded text-xs font-bold uppercase">
                                {{ $contenu->typeContenu->nom ?? 'Culture' }}
                            </span>
                        </div>
                        <h1 class="text-4xl md:text-5xl font-bold font-[Oswald] text-white mb-4 leading-tight">
                            {{ $contenu->titre }}
                        </h1>
                        <div class="flex items-center text-gray-400 text-sm">
                            <span>Publié le {{ $contenu->created_at->format('d/m/Y') }}</span>
                            <span class="mx-2">•</span>
                            <span>Par {{ $contenu->auteur->prenom ?? 'Admin' }}</span>
                        </div>
                    </div>

                    <div class="prose prose-invert prose-lg max-w-none text-gray-300 mb-12">
                        @if ($hasPaid)
                            {!! nl2br(e($contenu->texte)) !!}
                        @else
                            <div class="relative">
                                <div class="filter blur-sm select-none opacity-50">
                                    {!! nl2br(e(\Illuminate\Support\Str::limit($contenu->texte, 400))) !!}
                                </div>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="text-benin-yellow font-bold bg-black/50 px-4 py-2 rounded">
                                        Lecture réservée
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div id="commentaires" class="border-t border-gray-800 pt-10 mt-10">
                        <h3 class="text-2xl font-[Oswald] text-white mb-8 flex items-center gap-3">
                            Discussion
                            <span class="text-sm bg-gray-800 text-gray-400 px-2 py-1 rounded-full font-sans">
                                {{ $commentaires->count() }}
                            </span>
                        </h3>

                        @auth
                            <form action="{{ route('commentaires.store') }}" method="POST"
                                class="mb-10 bg-gray-900/50 p-6 rounded-xl border border-gray-800">
                                @csrf
                                <input type="hidden" name="contenu_id" value="{{ $contenu->id }}">
                                <div class="mb-4">
                                    <label class="block text-gray-400 text-sm mb-2">Votre message</label>
                                    <textarea name="texte" rows="3" required
                                        class="w-full bg-black border border-gray-700 rounded-lg p-3 text-white focus:border-benin-yellow focus:ring-0 transition"
                                        placeholder="Partagez votre avis..."></textarea>
                                </div>
                                <div class="flex justify-between items-center">
                                    <select name="note"
                                        class="bg-black border border-gray-700 text-gray-300 text-sm rounded px-3 py-2 focus:border-benin-yellow">
                                        <option value="">Note (Optionnel)</option>
                                        <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                                        <option value="4">⭐⭐⭐⭐ Très bien</option>
                                        <option value="3">⭐⭐⭐ Bien</option>
                                        <option value="2">⭐⭐ Moyen</option>
                                        <option value="1">⭐ Mauvais</option>
                                    </select>

                                    <button type="submit"
                                        class="bg-benin-green text-white px-6 py-2 rounded-full font-bold hover:bg-white hover:text-benin-green transition">
                                        Publier
                                    </button>
                                </div>
                            </form>
                        @else
                            <div class="mb-10 p-6 bg-gray-900 rounded-xl border border-gray-800 text-center">
                                <p class="text-gray-400 mb-4">Connectez-vous pour participer à la discussion.</p>
                                <a href="{{ route('login') }}" class="text-benin-yellow hover:underline">Se connecter</a>
                            </div>
                        @endauth

                        <div class="space-y-6">
                            @forelse ($commentaires as $comm)
                                <div class="flex gap-4 group border-b border-gray-800/50 pb-6 last:border-0">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 font-bold border border-gray-700">
                                            {{ substr($comm->utilisateur->prenom ?? '?', 0, 1) }}
                                        </div>
                                    </div>

                                    <div class="flex-grow">
                                        <div class="flex items-center justify-between mb-1">
                                            <h4 class="font-bold text-gray-200 text-sm">
                                                {{ $comm->utilisateur->prenom }} {{ $comm->utilisateur->nom }}
                                            </h4>
                                            <span
                                                class="text-xs text-gray-600">{{ $comm->created_at->diffForHumans() }}</span>
                                        </div>

                                        @if ($comm->note)
                                            <div class="flex text-benin-yellow text-xs mb-2">
                                                @for ($i = 0; $i < $comm->note; $i++)
                                                    ★
                                                @endfor
                                            </div>
                                        @endif

                                        <p class="text-gray-400 text-sm leading-relaxed mb-2">
                                            {{ Str::limit($comm->texte, 200) }}
                                        </p>

                                        {{-- Lien vers le détail --}}
                                        <a href="{{ route('commentaires.show', $comm) }}"
                                            class="text-xs font-bold text-benin-yellow opacity-60 hover:opacity-100 transition">
                                            LIRE L'AVIS COMPLET →
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-600 italic text-center py-4">Aucun commentaire pour le moment. Soyez le
                                    premier !</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    @if (Auth::check() && Auth::user()->id_role === 1)
                        <div class="bg-gray-900 rounded-xl p-6 border border-gray-800">
                            <h3 class="text-benin-yellow font-bold text-sm uppercase mb-4">Administration</h3>
                            <div class="space-y-3">
                                <a href="{{ route('admin.contenus.edit', $contenu) }}"
                                    class="block w-full py-2 bg-gray-800 hover:bg-gray-700 text-center rounded text-white transition">Modifier</a>
                                <form action="{{ route('admin.contenus.destroy', $contenu) }}" method="POST"
                                    onsubmit="return confirm('Supprimer ?');">
                                    @csrf @method('DELETE')
                                    <button
                                        class="block w-full py-2 bg-red-900/50 hover:bg-red-900 text-red-300 text-center rounded transition">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    @endif

                    <div>
                        <h3 class="text-white font-[Oswald] text-xl mb-4">À voir aussi</h3>
                        <div class="space-y-4">
                            @foreach ($relatedContents as $related)
                                <a href="{{ route('contenus.show', $related) }}" class="flex gap-4 group">
                                    @php
                                        $localImages = ['img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg'];
                                        $idx = $related->id % 4;
                                        $fallbackImg = asset($localImages[$idx]);

                                        $thumbUrl = $related->image_couverture
                                            ? asset('storage/' . $related->image_couverture)
                                            : $fallbackImg;
                                    @endphp

                                    <div class="w-24 h-16 bg-gray-800 rounded overflow-hidden flex-shrink-0">
                                        <img src="{{ $thumbUrl }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition">
                                    </div>
                                    <div>
                                        <h4
                                            class="text-gray-200 font-bold text-sm group-hover:text-benin-yellow leading-tight">
                                            {{ $related->titre }}
                                        </h4>
                                        <span
                                            class="text-xs text-gray-500">{{ $related->created_at->format('d M') }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
