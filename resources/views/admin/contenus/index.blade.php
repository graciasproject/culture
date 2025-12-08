@extends('layouts.app')

@section('title', 'Gestion des Contenus - Admin')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollToPlugin.min.js"></script>

    <!-- CONTENEUR GLOBAL -->
    <div class="relative w-full h-screen bg-[#050505] text-white overflow-hidden font-sans">

        <!-- 1. BACKGROUND VIDEO (Fixe) -->
        <div class="fixed inset-0 z-0">
            <video autoplay loop muted playsinline class="absolute top-0 left-0 w-full h-full object-cover opacity-30">
                <source src="{{ asset('bg.mp4') }}" type="video/mp4">
            </video>
            <!-- Overlay uniforme -->
            <div class="absolute inset-0 bg-black/60"></div>
        </div>

        <!-- Bouton Ajouter (Fixe en haut à droite) -->
        <div class="absolute top-28 right-8 md:right-16 z-50">
            <a href="{{ route('contenus.create') }}"
                class="flex items-center px-6 py-3 bg-benin-green text-white font-bold rounded-full hover:bg-white hover:text-benin-green transition-all shadow-[0_0_20px_rgba(0,135,81,0.4)] transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Ajouter un contenu
            </a>
        </div>

        <!-- 2. CONTENEUR CAROUSEL -->
        <div id="carousel-container">
            <!-- Les cartes sont injectées ici par JS -->
            <div id="demo"></div>

            <!-- Textes & Actions (Partie Gauche) -->
            <div class="details-container" id="details-text">
                <div class="location-badge"></div>
                <div class="main-title"></div>
                <div class="sub-title"></div>

                <!-- Statut Badge -->
                <div class="status-badge mb-4 inline-block px-3 py-1 rounded text-xs font-bold uppercase tracking-wider">
                </div>

                <div class="description"></div>

                <!-- Zone des boutons d'action Admin -->
                <div class="flex space-x-4 mt-6">
                    <a href="#"
                        class="action-btn edit-btn border-blue-500 text-blue-400 hover:bg-blue-500 hover:text-white">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Modifier
                    </a>

                    <!-- Formulaire de suppression caché qui sera trigger par JS -->
                    <form id="delete-form-template" action="#" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>

                    <button type="button"
                        class="action-btn delete-btn border-red-500 text-red-400 hover:bg-red-600 hover:text-white hover:border-red-600">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Supprimer
                    </button>
                </div>
            </div>

            <!-- Flèches de navigation -->
            <div class="nav-arrows">
                <div class="arrow-btn arrow-left">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                </div>
                <div class="arrow-btn arrow-right">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- PREPARATION DES DONNEES PHP POUR JS -->
    @php
        // On transforme la collection Laravel en tableau JSON compatible avec le script
        $formattedData = $contenus->map(function ($contenu) {
            // Logique Image (Uploadée ou Locale 1-4)
            $localImages = ['img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg'];
            $idx = $contenu->id % 4;
            $image = $contenu->image_couverture
                ? asset('storage/' . $contenu->image_couverture)
                : asset($localImages[$idx]);

            // Logique Vidéo
            $localVideos = ['vid1.mp4', 'vid2.mp4', 'vid3.mp4', 'vid4.mp4'];
            $video = $contenu->video_url ? asset('storage/' . $contenu->video_url) : asset($localVideos[$idx]);

            return [
                'id' => $contenu->id,
                'place' => strtoupper($contenu->region->nom_region ?? 'BENIN'),
                'title' => strtoupper($contenu->titre),
                'title2' => strtoupper($contenu->langue->nom_langue ?? ''),
                'description' => $contenu->resume ?? Str::limit($contenu->texte, 150),
                'image' => $image,
                'video' => $video,
                'statut' => $contenu->statut, // Pour afficher le badge
                'edit_url' => route('contenus.edit', $contenu->id),
                'delete_url' => route('contenus.destroy', $contenu->id),
            ];
        });
    @endphp

    <script>
        // Injection des données Laravel dans JS
        const data = @json($formattedData);

        const container = document.getElementById("carousel-container");
        const containerDemo = document.getElementById("demo");
        const detailsContainer = document.getElementById("details-text");

        // Génération HTML des cartes
        const cardsHTML = data.map((item, index) => `
            <div class="card" id="card${index}" data-index="${index}">
                <div class="card-bg-img" style="background-image:url('${item.image}')"></div>
                ${item.video ? `<video class="card-video" src="${item.video}" loop muted playsinline preload="metadata"></video>` : ''}
                
                <div class="pause-overlay">
                    <!-- Indicateur visuel sur la carte pour l'admin -->
                    <div class="absolute top-2 right-2 px-2 py-1 rounded text-[10px] font-bold uppercase ${item.statut === 'publié' ? 'bg-green-500' : 'bg-gray-500'} text-white">
                        ${item.statut}
                    </div>
                    <div class="pause-icon">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="white"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg>
                    </div>
                </div>
                
                <div class="card-mini-info" id="info-${index}">
                    <div style="font-size:10px; color:#FCD116; font-weight:700;">${item.place}</div>
                    <div style="font-size:18px; font-family:'Oswald'; font-weight:700; color:white; line-height:1;">${item.title}</div>
                </div>
            </div>
        `).join("");

        containerDemo.innerHTML = cardsHTML;

        // --- Logique d'animation (Identique à la vue publique) ---
        const range = (n) => Array(n).fill(0).map((i, j) => i + j);
        const getCard = (i) => document.getElementById(`card${i}`);
        const getInfo = (i) => document.getElementById(`info-${i}`);

        let order = range(data.length);
        let isAnimating = false;

        const cardWidth = 220;
        const cardHeight = 320;
        const gap = 20;

        function init() {
            if (data.length === 0) return; // Sécurité si vide

            const [active, ...rest] = order;
            const w = container.offsetWidth;
            const h = container.offsetHeight;
            const offsetLeft = w * 0.55;
            const offsetTop = h - cardHeight - 40;

            // 1. Carte Active
            const activeCard = getCard(active);
            gsap.set(activeCard, {
                position: "absolute",
                top: 0,
                left: 0,
                width: w,
                height: h,
                zIndex: 0,
                borderRadius: 0,
                opacity: 1
            });
            activeCard.classList.add("expanded");

            const vid = activeCard.querySelector('video');
            if (vid) vid.play().catch(e => {});

            gsap.set(getInfo(active), {
                opacity: 0
            });
            updateText(active);

            // 2. Autres cartes
            rest.forEach((i, index) => {
                gsap.set(getCard(i), {
                    position: "absolute",
                    left: offsetLeft + index * (cardWidth + gap),
                    top: offsetTop,
                    width: cardWidth,
                    height: cardHeight,
                    zIndex: 10,
                    borderRadius: 16,
                    opacity: 1
                });
                gsap.set(getInfo(i), {
                    opacity: 1
                });
                const v = getCard(i).querySelector('video');
                if (v) {
                    v.pause();
                    v.currentTime = 0;
                }
            });
        }

        function updateText(index) {
            const item = data[index];
            gsap.to(detailsContainer, {
                opacity: 0,
                y: 20,
                duration: 0.2,
                onComplete: () => {
                    // Remplissage des infos
                    detailsContainer.querySelector(".location-badge").textContent = item.place;
                    detailsContainer.querySelector(".main-title").textContent = item.title;
                    detailsContainer.querySelector(".sub-title").textContent = item.title2;
                    detailsContainer.querySelector(".description").textContent = item.description;

                    // Badge Statut
                    const badge = detailsContainer.querySelector(".status-badge");
                    badge.textContent = item.statut;
                    badge.className =
                        `status-badge mb-4 inline-block px-3 py-1 rounded text-xs font-bold uppercase tracking-wider ${item.statut === 'publié' ? 'bg-green-500 text-white' : 'bg-gray-600 text-gray-300'}`;

                    // Bouton Modifier
                    const editBtn = detailsContainer.querySelector(".edit-btn");
                    editBtn.href = item.edit_url;

                    // Bouton Supprimer
                    const deleteBtn = detailsContainer.querySelector(".delete-btn");
                    deleteBtn.onclick = () => {
                        if (confirm('Voulez-vous vraiment supprimer ce contenu ?')) {
                            const form = document.getElementById('delete-form-template');
                            form.action = item.delete_url;
                            form.submit();
                        }
                    };

                    gsap.to(detailsContainer, {
                        opacity: 1,
                        y: 0,
                        duration: 0.4
                    });
                }
            });
        }

        function step(direction = 1) {
            if (isAnimating) return;
            isAnimating = true;

            if (direction === 1) order.push(order.shift());
            else order.unshift(order.pop());

            const [active, ...rest] = order;
            const prevActive = (direction === 1) ? rest[rest.length - 1] : rest[0];

            const w = container.offsetWidth;
            const h = container.offsetHeight;
            const offsetLeft = w * 0.55;
            const offsetTop = h - cardHeight - 40;

            // Ancienne active -> devient petite
            const prevCard = getCard(prevActive);
            prevCard.classList.remove("expanded");
            const prevVid = prevCard.querySelector('video');
            if (prevVid) prevVid.pause();

            const targetIndexForPrev = (direction === 1) ? rest.length - 1 : 0;

            gsap.to(prevCard, {
                width: cardWidth,
                height: cardHeight,
                left: offsetLeft + targetIndexForPrev * (cardWidth + gap),
                top: offsetTop,
                zIndex: 10,
                borderRadius: 16,
                duration: 0.8,
                ease: "power3.inOut"
            });
            gsap.to(getInfo(prevActive), {
                opacity: 1,
                delay: 0.5
            });

            // Nouvelle active -> s'agrandit
            const nextCard = getCard(active);
            nextCard.classList.add("expanded");
            gsap.set(nextCard, {
                zIndex: 5
            });

            gsap.to(nextCard, {
                left: 0,
                top: 0,
                width: w,
                height: h,
                borderRadius: 0,
                duration: 0.8,
                ease: "power3.inOut",
                onComplete: () => {
                    gsap.set(nextCard, {
                        zIndex: 0
                    });
                    const vid = nextCard.querySelector('video');
                    if (vid) vid.play();
                    isAnimating = false;
                }
            });
            gsap.to(getInfo(active), {
                opacity: 0,
                duration: 0.3
            });

            updateText(active);

            // Réorganiser les autres
            rest.forEach((i, index) => {
                if (i !== prevActive) {
                    gsap.to(getCard(i), {
                        left: offsetLeft + index * (cardWidth + gap),
                        top: offsetTop,
                        zIndex: 10,
                        duration: 0.6,
                        ease: "power2.out"
                    });
                }
            });
        }

        document.querySelector(".arrow-right").addEventListener("click", () => step(1));
        document.querySelector(".arrow-left").addEventListener("click", () => step(-1));

        // Gestion clavier
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') step(1);
            if (e.key === 'ArrowLeft') step(-1);
        });

        window.addEventListener('resize', () => {
            if (!isAnimating && data.length > 0) init();
        });

        if (data.length > 0) init();
    </script>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Oswald:wght@500;700&display=swap");

        footer {
            margin-top: 0 !important;
        }

        #carousel-container {
            position: relative;
            width: 100%;
            min-height: 100vh;
            /* Plein écran */
            background-color: #050505;
            overflow: hidden;
        }

        /* Styles Cartes */
        .card {
            position: absolute;
            background-size: cover;
            background-position: center;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            transform-origin: center center;
            will-change: transform, width, height, left, top;
            cursor: pointer;
        }

        .card-bg-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            transition: opacity 0.5s ease;
            z-index: 1;
        }

        .card-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            z-index: 0;
            transition: opacity 1s ease;
        }

        .pause-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
            transition: all 0.3s;
            opacity: 1;
        }

        .pause-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card:hover .pause-overlay {
            background: rgba(0, 0, 0, 0.1);
        }

        .card:hover .pause-icon {
            transform: scale(1.1);
            background: rgba(252, 209, 22, 0.6);
        }

        /* Expanded State */
        .card.expanded {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            z-index: 0 !important;
            border-radius: 0 !important;
            box-shadow: none;
            cursor: default;
        }

        .card.expanded .pause-overlay {
            opacity: 0;
            pointer-events: none;
        }

        .card.expanded .card-video {
            opacity: 1;
            z-index: 2;
        }

        .card.expanded .card-bg-img {
            opacity: 0;
            z-index: 1;
        }

        .card.expanded::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, #050505 0%, rgba(5, 5, 5, 0.9) 25%, rgba(5, 5, 5, 0.7) 50%, rgba(5, 5, 5, 0.1) 100%);
            z-index: 3;
            pointer-events: none;
        }

        /* Details */
        .details-container {
            position: absolute;
            top: 20%;
            left: 5%;
            width: 45%;
            z-index: 10;
            padding-right: 20px;
        }

        .location-badge {
            display: inline-block;
            color: #FCD116;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 10px;
            border-left: 3px solid #E8112D;
            padding-left: 10px;
        }

        .main-title {
            font-family: 'Oswald', sans-serif;
            font-size: clamp(2.5rem, 5vw, 4.5rem);
            line-height: 0.9;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 5px;
            color: white;
        }

        .sub-title {
            font-family: 'Oswald', sans-serif;
            font-size: clamp(1.5rem, 3vw, 2.5rem);
            line-height: 1;
            font-weight: 500;
            color: #008751;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .description {
            font-size: 1rem;
            line-height: 1.5;
            color: #d1d5db;
            margin-bottom: 20px;
            max-width: 550px;
            text-align: justify;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Boutons Actions Admin */
        .action-btn {
            display: inline-flex;
            align-items: center;
            padding: 10px 24px;
            border: 1px solid;
            border-radius: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 12px;
            font-weight: 600;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            transition: 0.3s ease;
            text-decoration: none;
            white-space: nowrap;
            cursor: pointer;
        }

        /* Nav Arrows */
        .nav-arrows {
            position: absolute;
            bottom: 30px;
            right: 30px;
            display: flex;
            gap: 15px;
            z-index: 20;
        }

        .arrow-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.2);
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: 0.3s;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
        }

        .arrow-btn:hover {
            background: #E8112D;
            border-color: #E8112D;
            transform: scale(1.1);
        }

        .card-mini-info {
            position: absolute;
            bottom: 15px;
            left: 15px;
            z-index: 5;
            pointer-events: none;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.9);
        }
    </style>
@endsection
