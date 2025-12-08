@extends('layouts.app')

@section('title', 'Accueil - Culture Bénin')

@section('content')
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Oswald:wght@500;700&display=swap");

        /* --- CORRECTION MAJEURE : SUPPRIMER L'ESPACE DU FOOTER --- */
        /* On cible le footer du layout pour retirer sa marge supérieure de 80px (mt-20) */
        footer {
            margin-top: 0 !important;
        }

        /* --- Conteneur Principal --- */
        #carousel-container {
            position: relative;
            width: 100%;
            /* Le div s'agrandit pour prendre toute la hauteur de l'écran moins la navbar */
            /* Le footer se collera donc naturellement juste en dessous sans espace blanc */
            min-height: calc(100vh - 80px);
            background-color: #050505;
            overflow: hidden;
            /* Bordure subtile pour séparer visuellement du footer */
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* --- Les Cartes --- */
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

        /* Overlay Pause */
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

        /* --- État "EXPANDED" (Fond) --- */
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
            /* Gradient ajusté pour meilleure lisibilité */
            background: linear-gradient(90deg, #050505 0%, rgba(5, 5, 5, 0.9) 25%, rgba(5, 5, 5, 0.7) 50%, rgba(5, 5, 5, 0.1) 100%);
            z-index: 3;
            pointer-events: none;
        }

        /* --- Textes --- */
        .details-container {
            position: absolute;
            top: 15%;
            /* Remonté pour laisser de la place au bouton */
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
            margin-bottom: 30px;
            max-width: 550px;
            text-align: justify;

            /* Limite le texte à 3 lignes pour ne pas cacher le bouton */
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Bouton Action */
        .action-btn {
            display: inline-flex;
            align-items: center;
            padding: 12px 30px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 12px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            transition: 0.3s ease;
            text-decoration: none;
            white-space: nowrap;
        }

        .action-btn:hover {
            background: #FCD116;
            color: black;
            border-color: #FCD116;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(252, 209, 22, 0.3);
        }

        /* Navigation */
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

    <div id="carousel-container">
        <div id="demo"></div>

        <div class="details-container" id="details-text">
            <div class="location-badge"></div>
            <div class="main-title"></div>
            <div class="sub-title"></div>
            <div class="description"></div>
            <a href="#" class="action-btn"></a>
        </div>

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <script>
        const rawData = @json($carouselData);

        // Données de secours si DB vide
        const data = rawData.length ? rawData : [{
            id: 0,
            place: 'BENIN',
            title: 'BIENVENUE',
            title2: 'SUR CULTURE BENIN',
            description: 'Aucun contenu disponible pour le moment.',
            image: 'https://via.placeholder.com/800',
            video: null,
            url: '#'
        }];

        const container = document.getElementById("carousel-container");
        const containerDemo = document.getElementById("demo");
        const detailsContainer = document.getElementById("details-text");

        // Génération HTML
        const cardsHTML = data.map((item, index) => `
            <div class="card" id="card${index}" data-index="${index}">
                <div class="card-bg-img" style="background-image:url('${item.image}')"></div>
                ${item.video ? `<video class="card-video" src="${item.video}" loop muted playsinline preload="metadata"></video>` : ''}
                <div class="pause-overlay">
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

        // Configuration
        const range = (n) => Array(n).fill(0).map((i, j) => i + j);
        const getCard = (i) => document.getElementById(`card${i}`);
        const getInfo = (i) => document.getElementById(`info-${i}`);

        let order = range(data.length);
        let isAnimating = false;

        // Dimensions des petites cartes
        const cardWidth = 220;
        const cardHeight = 320;
        const gap = 20;

        function init() {
            const [active, ...rest] = order;
            // Dimensions dynamiques basées sur le conteneur, pas la fenêtre
            const w = container.offsetWidth;
            const h = container.offsetHeight;

            // Positionnement carrousel (un peu à droite du centre)
            const offsetLeft = w * 0.55;
            const offsetTop = h - cardHeight - 40; // Alignement bas

            // 1. CARTE ACTIVE (FOND)
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
            if (vid) vid.play().catch(e => console.log("Autoplay prevent"));

            gsap.set(getInfo(active), {
                opacity: 0
            });
            updateText(active);

            // 2. AUTRES CARTES
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
                    detailsContainer.querySelector(".location-badge").textContent = item.place;
                    detailsContainer.querySelector(".main-title").textContent = item.title;
                    detailsContainer.querySelector(".sub-title").textContent = item.title2;
                    detailsContainer.querySelector(".description").textContent = item.description;

                    const btn = detailsContainer.querySelector(".action-btn");
                    btn.href = item.url;

                    if (item.is_premium) {
                        btn.innerHTML =
                            `<span>Premium ${item.price ? item.price + ' FCFA' : ''}</span> <svg style="width:16px; margin-left:10px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>`;
                        btn.style.borderColor = "#FCD116";
                        btn.style.color = "#FCD116";
                    } else {
                        btn.innerHTML =
                            `<span>Découvrir</span> <svg style="width:16px; margin-left:10px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>`;
                        btn.style.borderColor = "white";
                        btn.style.color = "white";
                    }

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

            // Recalcul dimensions au cas où resize
            const w = container.offsetWidth;
            const h = container.offsetHeight;
            const offsetLeft = w * 0.55;
            const offsetTop = h - cardHeight - 40;

            // 1. ANCIENNE ACTIVE -> REDVIENT PETITE
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

            // 2. NOUVELLE ACTIVE -> S'AGRANDIT
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

            // 3. REORGANISER LES AUTRES
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
        document.addEventListener("click", (e) => {
            const card = e.target.closest(".card");
            if (card && !card.classList.contains("expanded") && !isAnimating) step(1);
        });

        // Gestion du resize fenêtre
        window.addEventListener('resize', () => {
            // Re-init simple pour recalibrer les positions
            // Idéalement on ferait un debounce ici, mais pour l'instant :
            if (!isAnimating) init();
        });

        if (data.length > 0) init();
    </script>
@endsection
