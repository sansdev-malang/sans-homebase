<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>{{ config('app.name', 'Web3 Wallet') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <!-- DotLottie Player Component -->
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', '-apple-system', 'sans-serif'],
                        "display": ["'Pacifico'", "cursive"],
                    },
                    colors: {
                        dark: '#0e1015',
                        muted: '#656e7b',
                    }
                }
            }
        }
    </script>

    <style>
        * {
            -webkit-tap-highlight-color: transparent;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            height: 100dvh;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #F3F5F9;
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            -webkit-font-smoothing: antialiased;
            touch-action: pan-y;
        }

        /* Subtle organic floating animation */
        @keyframes floatGentle {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-6px) rotate(2deg); }
        }
        @keyframes floatReverse {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(6px) rotate(-2deg); }
        }
        .anim-float {
            animation: floatGentle 4s ease-in-out infinite;
        }
        .anim-float-rev {
            animation: floatReverse 4.5s ease-in-out infinite;
        }

        /* Carousel slides styling */
        .slider-viewport {
            width: 100%;
            overflow: hidden;
            position: relative;
            touch-action: pan-y;
        }

        .slider-track {
            display: flex;
            height: 100%;
            transition: transform 0.35s cubic-bezier(0.25, 1, 0.5, 1);
            will-change: transform;
            cursor: grab;
        }

        .slider-track.dragging {
            transition: none !important;
            cursor: grabbing;
        }

        .slide-item {
            width: 100%;
            min-width: 100%;
            max-width: 100%;
            height: 100%;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            user-select: none;
        }

        /* Active dot transition */
        .dot-btn {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .dot-btn.active .dot-inner {
            background-color: #0D0E11;
            transform: scale(1.3);
        }

        /* Sleek scrollbar for text detail */
        .scroll-touch {
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
            overscroll-behavior: contain;
            scrollbar-width: thin;
            scrollbar-color: #E2E8F0 transparent;
        }
        .scroll-touch::-webkit-scrollbar {
            width: 4px;
        }
        .scroll-touch::-webkit-scrollbar-track {
            background: transparent;
        }
        .scroll-touch::-webkit-scrollbar-thumb {
            background-color: #CBD5E1;
            border-radius: 9999px;
        }
        .scroll-touch::-webkit-scrollbar-thumb:hover {
            background-color: #94A3B8;
        }

        /* Kinetic Typography Effect (as in reference image) */
        .kinetic-container {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            overflow: hidden;
            pointer-events: none;
            user-select: none;
        }
        .kinetic-row {
            overflow: hidden;
            width: 100%;
            display: flex;
            white-space: nowrap;
        }
        .kinetic-track {
            display: flex;
            width: max-content;
            will-change: transform;
        }
        .kinetic-text {
            font-family: 'Pacifico', cursive;
            font-weight: 700;
            font-size: 32px;
            letter-spacing: -0.02em;
            /* text-transform: uppercase; */
            line-height: 1;
            padding-right: 1.25rem;
            display: inline-block;
        }
        .kinetic-outline {
            color: transparent;
            -webkit-text-stroke: 1.5px rgba(16, 185, 129, 0.45);
        }
        .kinetic-solid {
            color: #10B981;
            -webkit-text-stroke: 0px;
            text-shadow: 0 4px 18px rgba(16, 185, 129, 0.35);
        }
    </style>
</head>
<body class="h-full flex items-center justify-center bg-[#ECEFF4] md:p-6 select-none">

    <!-- Main Mobile Container -->
    <div class="w-full h-full md:h-[844px] md:max-w-[395px] md:rounded-[40px] bg-white md:shadow-[0_20px_60px_-15px_rgba(0,0,0,0.15),0_0_1px_1px_rgba(0,0,0,0.06)] relative flex flex-col justify-between overflow-hidden">
        
        <!-- Top Sliding Area (Illustration + Title + Subtitle) -->
        <div class="slider-viewport flex-1 relative overflow-hidden" id="slider-viewport">
            
            <!-- Draggable Track (300% Width for 3 Slides) -->
            <div id="slider-track" class="slider-track">
                
                <!-- ==================== SLIDE 1 ==================== -->
                <div class="slide-item">
                    <!-- Illustration Area (Full Bleed) -->
                    <div class="w-full h-[62%] relative flex items-center justify-center overflow-hidden bg-[#FBFBFC]">
                        <!-- Background Blobs -->
                        <div class="absolute inset-0 pointer-events-none">
                            <div class="absolute -top-10 -right-10 w-56 h-56 bg-[#A2E6C6] rounded-full filter blur-3xl opacity-80"></div>
                            <div class="absolute top-10 -left-12 w-52 h-52 bg-[#FFA085] rounded-full filter blur-3xl opacity-75"></div>
                            <div class="absolute -bottom-8 right-8 w-48 h-40 bg-[#E8DEFF] rounded-full filter blur-2xl opacity-65"></div>
                        </div>

                        <!-- Lottie Animation 1 -->
                        <div class="relative z-10 w-[95%] max-w-[320px] h-[92%] flex items-center justify-center pointer-events-none">
                            <dotlottie-player
                                src="https://lottie.host/150b839f-856a-4e61-9597-f7a4753a1886/GWH5T5ygpA.lottie"
                                background="transparent"
                                speed="1"
                                style="width: 100%; height: 100%;"
                                loop
                                autoplay
                            ></dotlottie-player>
                        </div>
                    </div>

                    <!-- Slide Text Details -->
                    <div class="w-full h-[38%] flex flex-col justify-start overflow-y-auto scroll-touch px-7 py-4 bg-white select-text">
                        <h2 class="text-[25px] sm:text-[27px] font-bold text-[#0D0E11] leading-[1.2] tracking-tight shrink-0">
                            Student Discipline Code
                        </h2>
                        <p class="mt-2 text-[14px] text-[#656E7B] leading-relaxed font-normal">
                            merupakan serangkaian peraturan yang mengikat dan bervariasi konsekuensi sesuai dengan beratringannya tindakan yang dilakukan murid. Konsekuensi yang diberlakukan menggunakan sistem star point.
                        </p>
                    </div>
                </div>

                <!-- ==================== SLIDE 2 ==================== -->
                <div class="slide-item">
                    <!-- Illustration Area (Full Bleed) -->
                    <div class="w-full h-[62%] relative flex items-center justify-center overflow-hidden bg-[#FAFAFD]">
                        <div class="absolute inset-0 pointer-events-none">
                            <div class="absolute -top-10 -left-10 w-56 h-56 bg-[#A5E7FF] rounded-full filter blur-3xl opacity-80"></div>
                            <div class="absolute top-10 -right-10 w-56 h-56 bg-[#D794FF] rounded-full filter blur-3xl opacity-75"></div>
                            <div class="absolute -bottom-8 left-10 w-48 h-40 bg-[#86EFAC] rounded-full filter blur-2xl opacity-60"></div>

                            <!-- Abstract Anime.js Elements -->
                            <!-- Abstract Element 1: Glowing Green Ring -->
                            <svg class="anime-shape anime-ring absolute top-12 left-12 w-14 h-14 opacity-70" viewBox="0 0 100 100">
                                <circle cx="50" cy="50" r="40" stroke="#4ADE80" stroke-width="6" stroke-dasharray="10 6" fill="none" />
                            </svg>
                            <!-- Abstract Element 2: Soft Rotating Diamond -->
                            <div class="anime-shape anime-diamond absolute bottom-12 right-12 w-8 h-8 border-2 border-emerald-400 rounded-lg opacity-60"></div>
                            <!-- Abstract Element 3: Floating Green Capsule -->
                            <div class="anime-shape anime-capsule absolute top-1/3 right-6 w-5 h-12 bg-gradient-to-br from-teal-400 to-emerald-500 rounded-full opacity-50 shadow-lg shadow-emerald-200/50"></div>
                            <!-- Abstract Element 4: Grid of dots -->
                            <svg class="anime-shape anime-grid absolute bottom-16 left-6 w-16 h-16 opacity-30" viewBox="0 0 100 100">
                                <pattern id="dotGrid" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                    <circle cx="3" cy="3" r="3" fill="#10B981" />
                                </pattern>
                                <rect width="100" height="100" fill="url(#dotGrid)" />
                            </svg>
                            <!-- Abstract Element 5: Small Floating Bubble -->
                            <div class="anime-shape anime-bubble absolute top-1/2 left-4 w-6 h-6 bg-emerald-300 rounded-full opacity-40 blur-[1px]"></div>
                        </div>

                        <!-- Kinetic Typography Background (Like Reference Image) -->
                        <div class="kinetic-container absolute inset-0 z-0">
                            <!-- Row 1: Outline (Left) -->
                            <div class="kinetic-row kinetic-move-left opacity-30">
                                <div class="kinetic-track">
                                    <span class="kinetic-text kinetic-outline">Homebase Hijau &bull; Homebase Hijau &bull; Homebase Hijau &bull;&nbsp;</span>
                                    <span class="kinetic-text kinetic-outline">Homebase Hijau &bull; Homebase Hijau &bull; Homebase Hijau &bull;&nbsp;</span>
                                </div>
                            </div>
                            <!-- Row 2: Outline (Right) -->
                            <div class="kinetic-row kinetic-move-right opacity-45">
                                <div class="kinetic-track">
                                    <span class="kinetic-text kinetic-outline">Homebase Hijau &bull; Homebase Hijau &bull; Homebase Hijau &bull;&nbsp;</span>
                                    <span class="kinetic-text kinetic-outline">Homebase Hijau &bull; Homebase Hijau &bull; Homebase Hijau &bull;&nbsp;</span>
                                </div>
                            </div>
                            <!-- Row 3: Solid Prominent Text (Left) -->
                            <div class="kinetic-row kinetic-move-left opacity-90">
                                <div class="kinetic-track">
                                    <span class="kinetic-text kinetic-solid">Homebase Hijau &bull; Homebase Hijau &bull; Homebase Hijau &bull;&nbsp;</span>
                                    <span class="kinetic-text kinetic-solid">Homebase Hijau &bull; Homebase Hijau &bull; Homebase Hijau &bull;&nbsp;</span>
                                </div>
                            </div>
                            <!-- Row 4: Outline (Right) -->
                            <div class="kinetic-row kinetic-move-right opacity-50">
                                <div class="kinetic-track">
                                    <span class="kinetic-text kinetic-outline">Homebase Hijau &bull; Homebase Hijau &bull; Homebase Hijau &bull;&nbsp;</span>
                                    <span class="kinetic-text kinetic-outline">Homebase Hijau &bull; Homebase Hijau &bull; Homebase Hijau &bull;&nbsp;</span>
                                </div>
                            </div>
                            <!-- Row 5: Outline (Left) -->
                            <div class="kinetic-row kinetic-move-left opacity-35">
                                <div class="kinetic-track">
                                    <span class="kinetic-text kinetic-outline">Homebase Hijau &bull; Homebase Hijau &bull; Homebase Hijau &bull;&nbsp;</span>
                                    <span class="kinetic-text kinetic-outline">Homebase Hijau &bull; Homebase Hijau &bull; Homebase Hijau &bull;&nbsp;</span>
                                </div>
                            </div>
                            <!-- Row 6: Outline (Right) -->
                            <div class="kinetic-row kinetic-move-right opacity-25">
                                <div class="kinetic-track">
                                    <span class="kinetic-text kinetic-outline">Homebase Hijau &bull; Homebase Hijau &bull; Homebase Hijau &bull;&nbsp;</span>
                                    <span class="kinetic-text kinetic-outline">Homebase Hijau &bull; Homebase Hijau &bull; Homebase Hijau &bull;&nbsp;</span>
                                </div>
                            </div>
                        </div>

                        <!-- Illustration 2 (Mascot in Foreground) -->
                        <div class="relative z-10 w-[88%] max-w-[310px] h-[86%] flex items-center justify-center pointer-events-none">
                            <img src="{{ asset('assets/img/homebase-hijau.png') }}" alt="Kesalehan Personal" class="anime-rhino-img relative z-10 max-w-full max-h-full object-contain filter drop-shadow-[0_12px_24px_rgba(16,185,129,0.2)]">
                        </div>
                    </div>

                    <!-- Slide Text Details (Scrollable) -->
                    <div class="w-full h-[38%] flex flex-col justify-start overflow-y-auto scroll-touch px-7 py-4 bg-white select-text">
                        <h2 class="text-[24px] sm:text-[26px] font-bold text-[#0D0E11] leading-[1.2] tracking-tight shrink-0">
                            Homebase Hijau
                        </h2>
                        <p class="mt-2 text-[14px] text-[#656E7B] leading-relaxed font-normal">
                            Filosofi badak seringkali menjadi inspirasi untuk menggambarkan karakter seseorang. Meskipun badak sering dianggap sebagai hewan yang garang, ada banyak sifat positif darinya yang bisa diterapkan dalam kehidupan. Dengan demikian, filosofi badak dapat menggambarkan karakter seseorang yang teguh, mandiri, berani, namun tetap tenang dan bijaksana. Filosofi ini mengajarkan bahwa kekuatan sejati tidak selalu terlihat dari luar, tetapi dari ketahanan dan kemampuan untuk menghadapi hidup dengan kepala dingin.
                        </p>
                    </div>
                </div>

                <!-- ==================== SLIDE 3 ==================== -->
                <div class="slide-item">
                    <!-- Illustration Area (Full Bleed) -->
                    <div class="w-full h-[62%] relative flex items-center justify-center overflow-hidden bg-[#F8FAF9]">
                        <div class="absolute inset-0 pointer-events-none">
                            <div class="absolute -top-10 -left-10 w-56 h-56 bg-[#6EE7B7] rounded-full filter blur-3xl opacity-80"></div>
                            <div class="absolute top-10 -right-10 w-56 h-56 bg-[#93C5FD] rounded-full filter blur-3xl opacity-75"></div>
                            <div class="absolute -bottom-8 left-10 w-48 h-40 bg-[#BEF264] rounded-full filter blur-2xl opacity-50"></div>
                        </div>

                        <!-- SVG Illustration 3 -->
                        <div class="relative z-10 w-[88%] max-w-[310px] h-[86%] flex items-center justify-center pointer-events-none">
                            <svg viewBox="0 0 320 280" class="w-full h-full" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M50 170 V65" stroke="#111" stroke-width="11" stroke-linecap="round"/>
                                <polygon points="34,70 50,35 66,70" fill="#111"/>

                                <rect x="80" y="100" width="8" height="35" rx="4" fill="#111"/>
                                <rect x="94" y="80" width="8" height="55" rx="4" fill="#111"/>
                                <rect x="108" y="110" width="8" height="25" rx="4" fill="#111"/>
                                <rect x="122" y="65" width="8" height="70" rx="4" fill="#111"/>

                                <g class="anim-float" style="transform-origin: 235px 90px;">
                                    <path d="M268 65 C278 80 278 100 268 115" stroke="#CBD5E1" stroke-width="3" stroke-linecap="round" fill="none"/>
                                    <path d="M278 55 C292 80 292 110 278 125" stroke="#CBD5E1" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                                    
                                    <path d="M225 55 C205 55 190 75 195 105 L185 120 H265 L255 105 C260 75 245 55 225 55 Z" fill="#FDE047" stroke="#111" stroke-width="3" stroke-linejoin="round"/>
                                    <ellipse cx="225" cy="123" rx="10" ry="6" fill="#EAB308" stroke="#111" stroke-width="2.5"/>
                                    <circle cx="225" cy="49" r="6" fill="none" stroke="#111" stroke-width="2.5"/>
                                </g>

                                <path d="M125 230 C140 220 180 220 205 230 L195 250 L145 250 Z" fill="#1E293B" stroke="#111" stroke-width="3"/>
                                <path d="M130 210 L185 225 L190 250" stroke="#111" stroke-width="2.5" fill="none"/>
                                
                                <path d="M195 240 C210 240 225 245 230 255 L190 255 Z" fill="#818CF8" stroke="#111" stroke-width="2.5"/>
                                <line x1="205" y1="248" x2="220" y2="248" stroke="#FFF" stroke-width="2"/>

                                <path d="M100 170 C90 205 100 235 125 240 C145 240 160 210 150 170 Z" fill="#4ADE80" stroke="#111" stroke-width="3"/>
                                
                                <ellipse cx="118" cy="120" rx="12" ry="15" fill="#FED7AA" stroke="#111" stroke-width="2"/>
                                <path d="M105 120 C105 100 125 95 135 105 C132 108 128 110 120 110 C118 115 118 122 112 125 Z" fill="#78350F" stroke="#111" stroke-width="1.5"/>

                                <path d="M110 175 Q135 180 148 165" stroke="#4ADE80" stroke-width="12" stroke-linecap="round" fill="none"/>
                                <path d="M110 175 Q135 180 148 165" stroke="#111" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                                
                                <rect x="145" y="150" width="15" height="26" rx="3" transform="rotate(15 145 150)" fill="#111" stroke="#FFF" stroke-width="1"/>

                                <g class="anim-float-rev" style="transform-origin: 240px 190px;">
                                    <ellipse cx="240" cy="170" rx="24" ry="9" fill="#FBBF24" stroke="#111" stroke-width="2"/>
                                    <ellipse cx="240" cy="168" rx="18" ry="6" fill="#FDE68A"/>

                                    <ellipse cx="245" cy="195" rx="28" ry="10" fill="#F59E0B" stroke="#111" stroke-width="2"/>
                                    <ellipse cx="245" cy="193" rx="22" ry="7" fill="#FDE68A"/>

                                    <ellipse cx="235" cy="220" rx="30" ry="11" fill="#D97706" stroke="#111" stroke-width="2"/>
                                    <ellipse cx="235" cy="217" rx="24" ry="8" fill="#FDE68A"/>
                                </g>
                            </svg>
                        </div>
                    </div>

                    <!-- Slide Text Details -->
                    <div class="w-full h-[38%] flex flex-col justify-start overflow-y-auto scroll-touch px-7 py-4 bg-white select-text">
                        <h2 class="text-[25px] sm:text-[27px] font-bold text-[#0D0E11] leading-[1.2] tracking-tight shrink-0">
                            Kesalehan Sosial
                        </h2>
                        <p class="mt-2 text-[14px] text-[#656E7B] leading-relaxed font-normal">
                            Menumbuhkan empati, kepedulian, dan sikap saling menghargai antar sesama.
                        </p>
                    </div>
                </div>

                <!-- ==================== SLIDE 4 ==================== -->
                <div class="slide-item">
                    <!-- Illustration Area (Full Bleed) -->
                    <div class="w-full h-[62%] relative flex items-center justify-center overflow-hidden bg-[#F4FAF6]">
                        <div class="absolute inset-0 pointer-events-none">
                            <div class="absolute -top-10 -left-10 w-56 h-56 bg-[#86EFAC] rounded-full filter blur-3xl opacity-80"></div>
                            <div class="absolute top-10 -right-10 w-56 h-56 bg-[#6EE7B7] rounded-full filter blur-3xl opacity-75"></div>
                            <div class="absolute -bottom-8 left-10 w-48 h-40 bg-[#BAE6FD] rounded-full filter blur-2xl opacity-60"></div>
                        </div>

                        <!-- SVG Illustration 4 (Nature & Environment) -->
                        <div class="relative z-10 w-[88%] max-w-[310px] h-[86%] flex items-center justify-center pointer-events-none">
                            <svg viewBox="0 0 320 280" class="w-full h-full" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Floating Sun -->
                                <g class="anim-float" style="transform-origin: 240px 60px;">
                                    <circle cx="240" cy="60" r="22" fill="#FDE047" stroke="#111" stroke-width="2.5"/>
                                    <path d="M240 30 V22 M240 90 V98 M210 60 H202 M270 60 H278" stroke="#111" stroke-width="2.5" stroke-linecap="round"/>
                                </g>

                                <!-- Pot / Plant Bowl -->
                                <path d="M120 190 L130 250 H190 L200 190 Z" fill="#FDBA74" stroke="#111" stroke-width="3"/>
                                <rect x="112" y="180" width="96" height="12" rx="3" fill="#FED7AA" stroke="#111" stroke-width="2.5"/>

                                <!-- Plant Stem and Green Leaves -->
                                <path d="M160 180 V110" stroke="#15803D" stroke-width="4" stroke-linecap="round"/>
                                
                                <!-- Leaf 1 Left -->
                                <path d="M160 150 C130 150 110 130 120 110 C145 110 160 135 160 150 Z" fill="#4ADE80" stroke="#111" stroke-width="2.5"/>
                                <!-- Leaf 2 Right -->
                                <path d="M160 135 C190 135 210 115 200 95 C175 95 160 120 160 135 Z" fill="#22C55E" stroke="#111" stroke-width="2.5"/>
                                <!-- Leaf Top -->
                                <path d="M160 110 C145 80 160 65 160 65 C160 65 175 80 160 110 Z" fill="#86EFAC" stroke="#111" stroke-width="2.5"/>

                                <!-- Floating Water Droplets -->
                                <g class="anim-float-rev" style="transform-origin: 90px 140px;">
                                    <path d="M90 130 C90 145 75 155 75 145 C75 135 90 130 90 130 Z" fill="#38BDF8" stroke="#111" stroke-width="2"/>
                                    <path d="M230 150 C230 162 218 170 218 162 C218 154 230 150 230 150 Z" fill="#38BDF8" stroke="#111" stroke-width="2"/>
                                </g>

                                <!-- Soil -->
                                <ellipse cx="160" cy="184" rx="36" ry="5" fill="#78350F"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Slide Text Details -->
                    <div class="w-full h-[38%] flex flex-col justify-start overflow-y-auto scroll-touch px-7 py-4 bg-white select-text">
                        <h2 class="text-[25px] sm:text-[27px] font-bold text-[#0D0E11] leading-[1.2] tracking-tight shrink-0">
                            Kesalehan Kealamiahan
                        </h2>
                        <p class="mt-2 text-[14px] text-[#656E7B] leading-relaxed font-normal">
                            Membentuk kepedulian terhadap lingkungan dan alam sekitar melalui pembelajaran langsung.
                        </p>
                    </div>
                </div>

                <!-- ==================== SLIDE 5 ==================== -->
                <div class="slide-item">
                    <!-- Illustration Area (Full Bleed) -->
                    <div class="w-full h-[62%] relative flex items-center justify-center overflow-hidden bg-[#FFFBF5]">
                        <div class="absolute inset-0 pointer-events-none">
                            <div class="absolute -top-10 -left-10 w-56 h-56 bg-[#FDE047] rounded-full filter blur-3xl opacity-75"></div>
                            <div class="absolute top-10 -right-10 w-56 h-56 bg-[#FDA4AF] rounded-full filter blur-3xl opacity-70"></div>
                            <div class="absolute -bottom-8 left-10 w-48 h-40 bg-[#FED7AA] rounded-full filter blur-2xl opacity-60"></div>
                        </div>

                        <!-- SVG Illustration 5 (Academic & National Pride) -->
                        <div class="relative z-10 w-[88%] max-w-[310px] h-[86%] flex items-center justify-center pointer-events-none">
                            <svg viewBox="0 0 320 280" class="w-full h-full" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Floating Achievement Star (Top Right) -->
                                <g class="anim-float" style="transform-origin: 245px 55px;">
                                    <polygon points="245,35 252,50 268,52 256,64 260,80 245,71 230,80 234,64 222,52 238,50" fill="#FBBF24" stroke="#111" stroke-width="2.5"/>
                                </g>

                                <!-- Floating Ribbon/Badge (Top Left) -->
                                <g class="anim-float-rev" style="transform-origin: 65px 70px;">
                                    <circle cx="65" cy="65" r="18" fill="#EF4444" stroke="#111" stroke-width="2.5"/>
                                    <circle cx="65" cy="65" r="12" fill="#FFFFFF"/>
                                    <path d="M57 80 L52 105 L65 96 L78 105 L73 80 Z" fill="#EF4444" stroke="#111" stroke-width="2"/>
                                </g>

                                <!-- Graduation Cap / Toga Hat -->
                                <g class="anim-float" style="transform-origin: 160px 100px;">
                                    <!-- Cap Rhombus Top -->
                                    <polygon points="160,80 235,105 160,130 85,105" fill="#1E293B" stroke="#111" stroke-width="3"/>
                                    <polygon points="160,88 220,105 160,122 100,105" fill="#0F172A"/>
                                    
                                    <!-- Skull Cap Base -->
                                    <path d="M115 116 V145 C115 160 140 168 160 168 C180 168 205 160 205 145 V116" fill="#1E293B" stroke="#111" stroke-width="3"/>
                                    
                                    <!-- Golden Button & Tassel -->
                                    <circle cx="160" cy="105" r="5" fill="#F59E0B" stroke="#111" stroke-width="1.5"/>
                                    <path d="M160 105 Q195 110 200 135" stroke="#F59E0B" stroke-width="2.5" fill="none"/>
                                    <rect x="196" y="135" width="8" height="18" rx="2" fill="#F59E0B" stroke="#111" stroke-width="1.5"/>
                                </g>

                                <!-- Stack of Academic Books (Base) -->
                                <!-- Book 1 (Red/White - Bottom) -->
                                <rect x="90" y="225" width="140" height="24" rx="5" fill="#EF4444" stroke="#111" stroke-width="3"/>
                                <rect x="100" y="231" width="120" height="12" rx="2" fill="#FFFFFF"/>
                                
                                <!-- Book 2 (Blue - Middle) -->
                                <rect x="100" y="200" width="120" height="25" rx="5" fill="#3B82F6" stroke="#111" stroke-width="3"/>
                                <line x1="110" y1="212" x2="205" y2="212" stroke="#DBEAFE" stroke-width="4" stroke-linecap="round"/>

                                <!-- Book 3 (Gold - Top) -->
                                <rect x="110" y="175" width="100" height="25" rx="5" fill="#F59E0B" stroke="#111" stroke-width="3"/>
                                <line x1="120" y1="187" x2="190" y2="187" stroke="#FEF3C7" stroke-width="4" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Slide Text Details -->
                    <div class="w-full h-[38%] flex flex-col justify-start overflow-y-auto scroll-touch px-7 py-4 bg-white select-text">
                        <h2 class="text-[25px] sm:text-[27px] font-bold text-[#0D0E11] leading-[1.2] tracking-tight shrink-0">
                            Kesalehan Kebangsaan
                        </h2>
                        <p class="mt-2 text-[14px] text-[#656E7B] leading-relaxed font-normal">
                            Mengembangkan potensi intelektual dan rasa ingin tahu siswa dalam bidang akademik.
                        </p>
                    </div>
                </div>    

            </div>
        </div>

        <!-- Persistent Fixed Bottom Section (Dots & Buttons do NOT slide) -->
        <div class="w-full px-7 pt-1 pb-7 bg-white flex flex-col gap-4 shrink-0 z-30">
            <!-- Persistent Clickable Pagination Dots -->
            <div id="persistent-dots" class="flex items-center justify-center gap-1.5 py-1">
                <button onclick="goToSlide(0)" class="dot-btn active p-1.5 focus:outline-none cursor-pointer" aria-label="Go to slide 1">
                    <div class="dot-inner w-2 h-2 rounded-full bg-[#0D0E11] transition-all"></div>
                </button>
                <button onclick="goToSlide(1)" class="dot-btn p-1.5 focus:outline-none cursor-pointer" aria-label="Go to slide 2">
                    <div class="dot-inner w-2 h-2 rounded-full bg-[#D1D5DB] transition-all"></div>
                </button>
                <button onclick="goToSlide(2)" class="dot-btn p-1.5 focus:outline-none cursor-pointer" aria-label="Go to slide 3">
                    <div class="dot-inner w-2 h-2 rounded-full bg-[#D1D5DB] transition-all"></div>
                </button>
                <button onclick="goToSlide(3)" class="dot-btn p-1.5 focus:outline-none cursor-pointer" aria-label="Go to slide 4">
                    <div class="dot-inner w-2 h-2 rounded-full bg-[#D1D5DB] transition-all"></div>
                </button>
                <button onclick="goToSlide(4)" class="dot-btn p-1.5 focus:outline-none cursor-pointer" aria-label="Go to slide 5">
                    <div class="dot-inner w-2 h-2 rounded-full bg-[#D1D5DB] transition-all"></div>
                </button>
            </div>

            <!-- Persistent Action Buttons (Side-by-side Next & Skip) -->
            <div class="flex items-center gap-3 w-full">
                <button onclick="handleSkip()" id="btn-skip" class="flex-1 py-3.5 px-5 bg-[#F3F4F6] hover:bg-[#E5E7EB] active:scale-[0.985] text-[#4B5563] hover:text-[#111827] text-[15px] font-semibold rounded-full transition-all cursor-pointer text-center">
                    Skip
                </button>
                <button onclick="handleNext()" id="btn-next" class="flex-1 py-3.5 px-5 bg-[#0D0E11] hover:bg-black active:scale-[0.985] text-white text-[15px] font-semibold rounded-full shadow-[0_8px_20px_-4px_rgba(0,0,0,0.25)] transition-all cursor-pointer text-center">
                    Next
                </button>
            </div>
        </div>

    </div>

    <!-- Interactive Bottom Sheet Modal -->
    <div id="action-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-end md:items-center justify-center p-0 md:p-4 opacity-0 pointer-events-none transition-opacity duration-300">
        <div id="modal-card" class="w-full md:max-w-sm bg-white rounded-t-[32px] md:rounded-[32px] p-6 text-center transform translate-y-full md:translate-y-4 transition-transform duration-300">
            <div class="w-12 h-1 bg-gray-200 rounded-full mx-auto mb-4 md:hidden"></div>
            
            <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>

            <h3 id="modal-title" class="text-xl font-bold text-gray-900 mb-2">Create New Wallet</h3>
            <p id="modal-desc" class="text-sm text-gray-500 mb-6">Generating your secure 12-word recovery phrase...</p>

            <div class="flex items-center gap-3 w-full">
                <button onclick="closeModal()" class="flex-1 py-3.5 bg-gray-100 text-gray-700 font-semibold rounded-full hover:bg-gray-200 active:scale-[0.985] transition text-[15px] cursor-pointer">
                    Cancel
                </button>
                <button onclick="closeModal()" class="flex-1 py-3.5 bg-[#0D0E11] text-white font-semibold rounded-full hover:bg-black active:scale-[0.985] shadow-[0_8px_20px_-4px_rgba(0,0,0,0.25)] transition text-[15px] cursor-pointer">
                    Continue
                </button>
            </div>
        </div>
    </div>

    <!-- Anime.js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

    <!-- Touch Drag & Carousel Script -->
    <script>
        let currentSlide = 0;
        function getTotalSlides() {
            return document.querySelectorAll('.slide-item').length;
        }
        const track = document.getElementById('slider-track');
        const viewport = document.getElementById('slider-viewport');

        let isDragging = false;
        let startPosX = 0;
        let startPosY = 0;
        let currentTranslate = 0;
        let prevTranslate = 0;
        let animationID = null;

        function getPositionX(event) {
            return event.type.includes('mouse') ? event.pageX : event.touches[0].clientX;
        }
        function getPositionY(event) {
            return event.type.includes('mouse') ? event.pageY : event.touches[0].clientY;
        }

        function setSliderPosition() {
            track.style.transform = `translateX(${currentTranslate}px)`;
        }

        function animation() {
            setSliderPosition();
            if (isDragging) requestAnimationFrame(animation);
        }

        function updateDots() {
            const persistentDots = document.getElementById('persistent-dots');
            if (persistentDots) {
                const dots = persistentDots.querySelectorAll('.dot-btn');
                dots.forEach((btn, index) => {
                    const dotInner = btn.querySelector('.dot-inner');
                    if (index === currentSlide) {
                        btn.classList.add('active');
                        if (dotInner) {
                            dotInner.style.backgroundColor = '#0D0E11';
                            dotInner.style.transform = 'scale(1.3)';
                        }
                    } else {
                        btn.classList.remove('active');
                        if (dotInner) {
                            dotInner.style.backgroundColor = '#D1D5DB';
                            dotInner.style.transform = 'scale(1)';
                        }
                    }
                });
            }

            const nextBtn = document.getElementById('btn-next');
            const skipBtn = document.getElementById('btn-skip');
            if (nextBtn) {
                if (currentSlide === getTotalSlides() - 1) {
                    nextBtn.textContent = 'Get Started';
                } else {
                    nextBtn.textContent = 'Next';
                }
            }
            if (skipBtn) {
                if (currentSlide === getTotalSlides() - 1) {
                    skipBtn.style.opacity = '0';
                    skipBtn.style.pointerEvents = 'none';
                } else {
                    skipBtn.style.opacity = '1';
                    skipBtn.style.pointerEvents = 'auto';
                }
            }
        }

        function setPositionByIndex() {
            const slideWidth = viewport.offsetWidth;
            currentTranslate = -currentSlide * slideWidth;
            prevTranslate = currentTranslate;
            track.classList.remove('dragging');
            track.style.transform = `translateX(${currentTranslate}px)`;
            updateDots();
        }

        window.goToSlide = function(index) {
            currentSlide = Math.max(0, Math.min(index, getTotalSlides() - 1));
            setPositionByIndex();
        };

        window.nextSlide = function() {
            if (currentSlide < getTotalSlides() - 1) {
                currentSlide++;
            } else {
                currentSlide = 0;
            }
            setPositionByIndex();
        };

        window.prevSlide = function() {
            if (currentSlide > 0) {
                currentSlide--;
            }
            setPositionByIndex();
        };

        // Pointer / Touch Handlers
        let isHorizontalSwipe = null;

        function touchStart(event) {
            isDragging = true;
            isHorizontalSwipe = null;
            startPosX = getPositionX(event);
            startPosY = getPositionY(event);
            track.classList.add('dragging');
            animationID = requestAnimationFrame(animation);
        }

        function touchMove(event) {
            if (!isDragging) return;
            const currentX = getPositionX(event);
            const currentY = getPositionY(event);
            const diffX = currentX - startPosX;
            const diffY = currentY - startPosY;

            if (isHorizontalSwipe === null) {
                if (Math.abs(diffX) > 8 || Math.abs(diffY) > 8) {
                    isHorizontalSwipe = Math.abs(diffX) > Math.abs(diffY);
                }
            }

            if (isHorizontalSwipe) {
                if (event.cancelable) event.preventDefault();
                currentTranslate = prevTranslate + diffX;
            }
        }

        function touchEnd() {
            if (!isDragging) return;
            isDragging = false;
            cancelAnimationFrame(animationID);
            track.classList.remove('dragging');

            const movedBy = currentTranslate - prevTranslate;
            const threshold = viewport.offsetWidth * 0.15; // 15% of width to trigger swipe

            if (movedBy < -threshold && currentSlide < getTotalSlides() - 1) {
                currentSlide += 1;
            } else if (movedBy > threshold && currentSlide > 0) {
                currentSlide -= 1;
            }

            setPositionByIndex();
        }

        // Add event listeners to viewport
        viewport.addEventListener('touchstart', touchStart, { passive: true });
        viewport.addEventListener('touchmove', touchMove, { passive: false });
        viewport.addEventListener('touchend', touchEnd);

        // Mouse events for desktop testing
        viewport.addEventListener('mousedown', touchStart);
        window.addEventListener('mousemove', touchMove);
        window.addEventListener('mouseup', touchEnd);

        // Handle Window Resize
        window.addEventListener('resize', () => {
            setPositionByIndex();
        });

        // Keyboard navigation
        window.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight') nextSlide();
            if (e.key === 'ArrowLeft') prevSlide();
        });

        window.handleSkip = function() {
            window.location.href = "{{ Route::has('login') ? route('login') : '/login' }}";
        };

        window.handleNext = function() {
            if (currentSlide < getTotalSlides() - 1) {
                nextSlide();
            } else {
                handleCreateWallet();
            }
        };

        // Modal Handlers
        const modal = document.getElementById('action-modal');
        const modalCard = document.getElementById('modal-card');
        const modalTitle = document.getElementById('modal-title');
        const modalDesc = document.getElementById('modal-desc');

        window.handleCreateWallet = function() {
            modalTitle.textContent = "Create New Wallet";
            modalDesc.textContent = "Your secret recovery keys will be generated securely on this device.";
            openModal();
        };

        window.handleImportWallet = function() {
            modalTitle.textContent = "Import Existing Wallet";
            modalDesc.textContent = "Enter your 12 or 24-word secret recovery phrase or private key to restore.";
            openModal();
        };

        function openModal() {
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modalCard.classList.remove('translate-y-full', 'md:translate-y-4');
        }

        window.closeModal = function() {
            modal.classList.add('opacity-0', 'pointer-events-none');
            modalCard.classList.add('translate-y-full', 'md:translate-y-4');
        };

        // Initialize position on load
        setPositionByIndex();

        // ==================== Anime.js Animations ====================
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof anime !== 'undefined') {
                // 1. Rotating Ring & Dashoffset pulse
                anime({
                    targets: '.anime-ring',
                    rotate: '1turn',
                    duration: 14000,
                    easing: 'linear',
                    loop: true
                });

                anime({
                    targets: '.anime-ring circle',
                    strokeDashoffset: [anime.setDashoffset, 0],
                    easing: 'easeInOutSine',
                    duration: 3500,
                    direction: 'alternate',
                    loop: true
                });

                // 2. Rotating & Pulsing Diamond
                anime({
                    targets: '.anime-diamond',
                    rotate: [0, 90, 180, 270, 360],
                    translateY: [-6, 6, -6],
                    scale: [0.9, 1.15, 0.9],
                    duration: 7000,
                    easing: 'easeInOutQuad',
                    direction: 'alternate',
                    loop: true
                });

                // 3. Floating Capsule
                anime({
                    targets: '.anime-capsule',
                    translateY: [-10, 10],
                    translateX: [-4, 4],
                    rotate: [-12, 12],
                    duration: 4500,
                    easing: 'easeInOutSine',
                    direction: 'alternate',
                    loop: true
                });

                // 4. Dot Grid Scale & Opacity Breathe
                anime({
                    targets: '.anime-grid',
                    scale: [0.95, 1.1, 0.95],
                    opacity: [0.25, 0.55, 0.25],
                    duration: 5500,
                    easing: 'easeInOutSine',
                    direction: 'alternate',
                    loop: true
                });

                // 5. Floating Bubble
                anime({
                    targets: '.anime-bubble',
                    translateY: [-14, 14],
                    translateX: [-6, 6],
                    scale: [0.75, 1.25, 0.75],
                    duration: 4000,
                    easing: 'easeInOutSine',
                    direction: 'alternate',
                    loop: true
                });

                // 6. Floating Rhino Mascot
                anime({
                    targets: '.anime-rhino-img',
                    translateY: [-6, 6],
                    rotate: [-1.5, 1.5],
                    duration: 3200,
                    easing: 'easeInOutSine',
                    direction: 'alternate',
                    loop: true
                });

                // 7. Kinetic Typography Infinite Marquee Animations
                anime({
                    targets: '.kinetic-move-left .kinetic-track',
                    translateX: ['0%', '-50%'],
                    duration: 16000,
                    easing: 'linear',
                    loop: true
                });

                anime({
                    targets: '.kinetic-move-right .kinetic-track',
                    translateX: ['-50%', '0%'],
                    duration: 18000,
                    easing: 'linear',
                    loop: true
                });
            }
        });
    </script>
</body>
</html>
