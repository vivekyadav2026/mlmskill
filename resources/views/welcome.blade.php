<!DOCTYPE html>
<html lang="hi" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samarth Digital | कौशल विकास और स्व रोजगार को समर्पित</title>
    <meta name="description" content="अब नौकरी नहीं अपना व्यवसाय करें, वो भी घर बैठे। Samarth Digital के साथ जुड़ें - ऑनलाइन व ऑफलाइन ट्रेनिंग, सर्टिफिकेट और बिजनेस सपोर्ट।">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts: Poppins & Noto Sans Devanagari -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'Noto Sans Devanagari', 'sans-serif'],
                        devanagari: ['Noto Sans Devanagari', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#e8f5e9',
                            100: '#c8e6c9',
                            200: '#a5d6a7',
                            300: '#81c784',
                            400: '#66bb6a',
                            500: '#2e7d32', // Main green
                            600: '#1f512c', // Dark green
                            700: '#173f22',
                            800: '#0f2c18',
                            900: '#081a0e',
                        },
                        navy: {
                            50: '#eef2f6',
                            100: '#d9e2ec',
                            500: '#243b55',
                            800: '#142834',
                            900: '#0b192c', // Deep Navy Banner
                        },
                        accent: {
                            100: '#ffedd5',
                            500: '#f48a20', // Vibrant orange
                            600: '#ea580c',
                            700: '#c2410c',
                        },
                        gold: {
                            400: '#facc15',
                            500: '#eab308',
                        }
                    },
                    boxShadow: {
                        'soft': '0 10px 40px -10px rgba(0,0,0,0.08)',
                        'premium': '0 20px 50px -15px rgba(0, 0, 0, 0.15)',
                        'glow-green': '0 0 25px -5px rgba(46, 125, 50, 0.4)',
                        'glow-orange': '0 0 25px -5px rgba(244, 138, 32, 0.4)',
                    },
                    keyframes: {
                        floatSlow: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        pulseGlow: {
                            '0%, 100%': { transform: 'scale(1)', opacity: '1' },
                            '50%': { transform: 'scale(1.05)', opacity: '0.9' },
                        }
                    },
                    animation: {
                        'float': 'floatSlow 4s ease-in-out infinite',
                        'pulse-glow': 'pulseGlow 3s ease-in-out infinite',
                    }
                }
            }
        }
    </script>
    <style>
        .glass-panel {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }
        .glass-dark {
            background: rgba(11, 25, 44, 0.85);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.12);
        }
        .text-gradient-green {
            background: linear-gradient(135deg, #1f512c 0%, #4caf50 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .text-gradient-orange {
            background: linear-gradient(135deg, #ea580c 0%, #f48a20 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .bg-gradient-premium {
            background: linear-gradient(135deg, #0b192c 0%, #1e3a8a 100%);
        }
        .bg-pattern {
            background-color: #f8fafc;
            background-image: radial-gradient(#e2e8f0 1px, transparent 1px);
            background-size: 24px 24px;
        }
        /* Custom Google Translate Styling and Hide defaults */
        iframe.VIpgJd-yAWgpe-hZsed-HLg1ee-JhKxnd {
            display: none !important;
        }
        .VIpgJd-yAWgpe-hZsed-HLg1ee-JhKxnd {
            display: none !important;
        }
        body {
            top: 0px !important;
        }
        #google_translate_element {
            display: none !important;
        }
        .skiptranslate {
            display: none !important;
        }
        .goog-te-banner-frame {
            display: none !important;
        }
        .goog-te-balloon-frame {
            display: none !important;
        }
        .goog-tooltip {
            display: none !important;
        }
        .goog-tooltip:hover {
            display: none !important;
        }
        .goog-text-highlight {
            background-color: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }
    </style>
</head>
<body class="antialiased font-sans bg-pattern text-gray-800 overflow-x-hidden selection:bg-brand-500 selection:text-white">

    @include('components.preloader')

    <!-- Top Announcement Bar -->
    <div class="bg-navy-900 text-white text-xs py-2.5 px-4 sm:px-6 lg:px-8 border-b border-white/10 relative z-50 shadow-sm">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2 font-medium">
            <div class="flex items-center gap-6">
                <a href="https://wa.me/919891176777?text=नमस्ते,%20मुझे%20Samarth%20Digital%20के%20कोर्सेज%20और%20स्व-रोजगार%20के%20बारे%20में%20जानकारी%20चाहिए।" target="_blank" class="flex items-center gap-2 text-gold-400 font-bold hover:text-white transition">
                    <i class="fa-brands fa-whatsapp text-green-400 text-sm animate-pulse"></i> 9891176777
                </a>
                <span class="hidden sm:flex items-center gap-2 text-gray-300">
                    <i class="fa-solid fa-envelope text-brand-400"></i> info@samarthdigital.com
                </span>
            </div>
            <div class="flex items-center gap-4">
                <span class="inline-flex items-center bg-brand-500 text-white font-bold px-2.5 py-0.5 rounded-full text-[11px] uppercase tracking-wide font-devanagari">
                    कौशल से स्वावलंबन
                </span>
                <!-- Custom Language Toggle Button for Topbar -->
                <button class="custom-lang-toggle bg-white/10 hover:bg-white/20 border border-white/20 text-white text-[11px] font-bold px-2.5 py-1 rounded-full flex items-center gap-1.5 transition">
                    <!-- Loaded dynamically via JS -->
                </button>
                <div class="hidden md:flex items-center gap-3 text-gray-400">
                    <a href="#" class="hover:text-white transition"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="hover:text-white transition"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="hover:text-white transition"><i class="fa-brands fa-youtube"></i></a>
                    <a href="https://wa.me/919891176777?text=नमस्ते,%20मुझे%20Samarth%20Digital%20के%20कोर्सेज%20और%20स्व-रोजगार%20के%20बारे%20में%20जानकारी%20चाहिए।" target="_blank" class="hover:text-green-400 transition"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Header -->
    <nav id="navbar" class="sticky top-0 w-full z-50 bg-white/85 backdrop-blur-lg border-b border-gray-100/80 transition-all duration-300 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div id="navbar-container" class="flex justify-between items-center transition-all duration-300 py-4">
                <!-- Brand Logo & Tagline -->
                <a href="/" class="flex items-center gap-3 group flex-shrink-0">
                    <div class="relative">
                        <img src="{{ asset('logo.png') }}" onerror="this.src='https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=150&auto=format&fit=crop'" alt="Samarth Digital Logo" class="w-11 h-11 rounded-xl object-cover shadow-premium shadow-brand-500/10 group-hover:scale-105 transition transform duration-300">
                        <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-emerald-500 border-2 border-white rounded-full shadow-sm animate-pulse"></div>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-extrabold text-xl sm:text-2xl tracking-tight text-navy-900 font-sans leading-none whitespace-nowrap">
                            SAMARTH <span class="text-brand-500">DIGITAL</span>
                        </span>
                        <span class="text-[9px] sm:text-[10px] xl:text-[11px] font-semibold text-accent-500 font-devanagari tracking-wider mt-1 whitespace-nowrap transition-colors duration-300 group-hover:text-accent-600">
                            — कौशल विकास और स्व रोजगार को समर्पित —
                        </span>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden xl:flex items-center space-x-4 2xl:space-x-6 font-semibold text-slate-600 font-devanagari text-[14px] 2xl:text-base flex-shrink-0">
                    <a href="/" class="relative py-2 text-brand-500 transition duration-300 group whitespace-nowrap">
                        होम
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-brand-500 rounded-full"></span>
                    </a>
                    <a href="#about" class="relative py-2 hover:text-brand-500 text-slate-600 transition duration-300 group whitespace-nowrap">
                        हमारे बारे में
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-brand-500 rounded-full transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#features" class="relative py-2 hover:text-brand-500 text-slate-600 transition duration-300 group whitespace-nowrap">
                        हम क्या देते हैं
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-brand-500 rounded-full transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#training" class="relative py-2 hover:text-brand-500 text-slate-600 transition duration-300 group whitespace-nowrap">
                        ट्रेनिंग विकल्प
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-brand-500 rounded-full transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#courses" class="relative py-2 hover:text-brand-500 text-slate-600 transition duration-300 group whitespace-nowrap">
                        प्रमुख कोर्सेज
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-brand-500 rounded-full transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#contact" class="relative py-2 hover:text-brand-500 text-slate-600 transition duration-300 group whitespace-nowrap">
                        संपर्क करें
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-brand-500 rounded-full transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </div>

                <!-- Action Buttons -->
                <div class="hidden lg:flex items-center gap-2 xl:gap-3 flex-shrink-0">
                    <button class="custom-lang-toggle px-4 py-2 text-xs xl:text-sm text-slate-700 hover:text-brand-600 font-semibold flex items-center gap-2 bg-slate-50 hover:bg-brand-50/40 border border-slate-200 hover:border-brand-200 rounded-full transition duration-300 shadow-sm whitespace-nowrap flex-shrink-0">
                        <!-- Loaded dynamically via JS -->
                    </button>
                    <a href="{{ route('login') }}" class="px-4 py-2 text-xs xl:text-sm text-slate-700 font-semibold hover:text-brand-600 hover:bg-slate-100/60 rounded-full transition duration-300 flex items-center gap-2 whitespace-nowrap flex-shrink-0">
                        <i class="fa-solid fa-user-lock text-sm"></i> लॉगिन
                    </a>
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-brand-500 via-brand-600 to-emerald-600 hover:opacity-95 text-white px-5 py-2 xl:px-6 xl:py-2.5 rounded-full font-semibold text-xs xl:text-sm shadow-md shadow-brand-500/10 hover:shadow-lg hover:shadow-brand-500/20 transition transform hover:-translate-y-0.5 flex items-center gap-2 whitespace-nowrap flex-shrink-0">
                        <i class="fa-solid fa-user-plus text-sm"></i> आज ही जुड़ें
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="xl:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-navy-900 p-2 focus:outline-none hover:text-brand-500 transition text-2xl">
                        <i id="mobile-menu-icon" class="fa-solid fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Panel -->
        <div id="mobile-menu" class="hidden xl:hidden bg-white/95 backdrop-blur-xl border-t border-gray-100 shadow-2xl absolute w-full left-0 transition-all duration-300">
            <div class="px-6 py-6 space-y-3 flex flex-col font-devanagari font-semibold text-lg text-gray-800">
                <a href="/" class="mobile-link p-3 hover:bg-brand-50 hover:text-brand-500 rounded-xl transition flex items-center gap-3">
                    <i class="fa-solid fa-home text-brand-500 w-6"></i> होम
                </a>
                <a href="#about" class="mobile-link p-3 hover:bg-brand-50 hover:text-brand-500 rounded-xl transition flex items-center gap-3">
                    <i class="fa-solid fa-circle-info text-brand-500 w-6"></i> हमारे बारे में
                </a>
                <a href="#features" class="mobile-link p-3 hover:bg-brand-50 hover:text-brand-500 rounded-xl transition flex items-center gap-3">
                    <i class="fa-solid fa-star text-brand-500 w-6"></i> हम क्या देते हैं
                </a>
                <a href="#training" class="mobile-link p-3 hover:bg-brand-50 hover:text-brand-500 rounded-xl transition flex items-center gap-3">
                    <i class="fa-solid fa-chalkboard-user text-brand-500 w-6"></i> ट्रेनिंग विकल्प
                </a>
                <a href="#courses" class="mobile-link p-3 hover:bg-brand-50 hover:text-brand-500 rounded-xl transition flex items-center gap-3">
                    <i class="fa-solid fa-graduation-cap text-brand-500 w-6"></i> प्रमुख कोर्सेज
                </a>
                <a href="#contact" class="mobile-link p-3 hover:bg-brand-50 hover:text-brand-500 rounded-xl transition flex items-center gap-3">
                    <i class="fa-solid fa-phone text-brand-500 w-6"></i> संपर्क करें
                </a>
                <div class="border-t border-gray-100 my-4 pt-4 flex flex-col gap-3">
                    <button class="custom-lang-toggle py-3 bg-slate-50 text-slate-800 rounded-full font-semibold hover:bg-slate-100 transition flex items-center justify-center gap-2 border border-slate-200">
                        <!-- Loaded dynamically via JS -->
                    </button>
                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('login') }}" class="text-center py-3 bg-slate-100 text-slate-800 rounded-full font-semibold hover:bg-slate-200/80 transition">लॉगिन करें</a>
                        <a href="{{ route('register') }}" class="text-center py-3 bg-gradient-to-r from-brand-500 to-emerald-600 text-white rounded-full font-semibold hover:opacity-95 transition shadow-lg shadow-brand-500/10">आज ही जुड़ें</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- 1. HERO BANNER SECTION (Matching Flyer Exact Layout) -->
    <section class="relative pt-12 pb-20 lg:pt-16 lg:pb-28 overflow-hidden bg-gradient-to-b from-white via-brand-50/30 to-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-12 gap-12 items-center">
                <!-- Left Content Column (7 Cols) -->
                <div class="lg:col-span-7 text-left space-y-6">
                    <!-- Top Ribbon / Tagline -->
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand-50 border border-brand-200 text-brand-700 font-bold text-sm sm:text-base animate-pulse-glow shadow-sm font-devanagari">
                        <span class="w-2.5 h-2.5 rounded-full bg-accent-500 animate-ping"></span>
                        कौशल विकास और स्व रोजगार को समर्पित
                    </div>

                    <!-- Main Slogan -->
                    <h1 class="font-devanagari text-4xl sm:text-5xl lg:text-6xl font-black text-navy-900 leading-tight">
                        कौशल से रोजगार नहीं,<br>
                        <span class="text-gradient-orange text-5xl sm:text-6xl lg:text-7xl block mt-2 drop-shadow-sm font-extrabold">कौशल से स्वावलंबन!</span>
                    </h1>

                    <!-- Sub Slogan -->
                    <div class="flex items-center gap-4 py-3 text-lg sm:text-2xl font-bold text-brand-600 bg-brand-50/80 px-6 rounded-2xl border-l-4 border-brand-500 w-fit font-devanagari shadow-sm">
                        <span>सीखें</span>
                        <span class="text-accent-500">•</span>
                        <span>सशक्त बनें</span>
                        <span class="text-accent-500">•</span>
                        <span>सफल बनें</span>
                    </div>

                    <p class="text-gray-600 text-base sm:text-lg leading-relaxed max-w-xl font-medium">
                        Samarth Digital के साथ जुड़कर घर बैठे प्रोफेशनल और लाभकारी व्यापारिक कौशल सीखें। अपने करियर को नई दिशा दें और आत्मनिर्भर बनें।
                    </p>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="{{ route('register') }}" class="bg-brand-500 hover:bg-brand-600 text-white font-extrabold text-lg py-4 px-8 rounded-2xl shadow-xl shadow-brand-500/30 transition transform hover:-translate-y-1 flex items-center justify-center gap-3">
                            <i class="fa-solid fa-rocket text-xl"></i> आज ही जुड़ें, भविष्य संवारें
                        </a>
                        <a href="#courses" class="bg-white hover:bg-gray-50 text-navy-900 border-2 border-navy-900 font-extrabold text-lg py-4 px-8 rounded-2xl shadow-md transition flex items-center justify-center gap-2">
                            प्रमुख कोर्स देखें <i class="fa-solid fa-arrow-down text-sm"></i>
                        </a>
                    </div>

                    <!-- Live Stats Banner -->
                    <div class="grid grid-cols-3 gap-4 sm:gap-8 pt-8 border-t border-gray-200">
                        <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 text-center">
                            <div class="text-2xl sm:text-3xl font-black text-brand-500">50+</div>
                            <div class="text-xs sm:text-sm font-semibold text-gray-500 mt-1">ट्रेनिंग कोर्सेज</div>
                        </div>
                        <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 text-center">
                            <div class="text-2xl sm:text-3xl font-black text-accent-600">10k+</div>
                            <div class="text-xs sm:text-sm font-semibold text-gray-500 mt-1">सफल छात्र</div>
                        </div>
                        <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 text-center">
                            <div class="text-2xl sm:text-3xl font-black text-navy-900">100%</div>
                            <div class="text-xs sm:text-sm font-semibold text-gray-500 mt-1">सपोर्ट सिस्टम</div>
                        </div>
                    </div>
                </div>

                <!-- Right Column Banner Graphic (5 Cols) -->
                <div class="lg:col-span-5 relative">
                    <!-- Decorative Background Gradient Blobs -->
                    <div class="absolute -top-10 -left-10 w-72 h-72 bg-brand-500/20 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-10 -right-10 w-72 h-72 bg-accent-500/20 rounded-full blur-3xl"></div>

                    <!-- Main Premium Banner Box -->
                    <div class="relative rounded-3xl overflow-hidden shadow-premium border-4 border-white bg-gradient-premium text-white flex flex-col">
                        <!-- Top Dark Blue Slogan Header -->
                        <div class="p-8 text-center bg-navy-900/90 backdrop-blur border-b border-white/10 relative">
                            <div class="absolute top-0 right-0 transform translate-x-4 -translate-y-4 w-24 h-24 bg-gold-500/20 rounded-full blur-xl"></div>
                            <span class="text-xl sm:text-2xl font-bold tracking-wide text-gray-200 block mb-1">
                                अब नौकरी नहीं
                            </span>
                            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-gold-400 drop-shadow mb-3 font-devanagari">
                                अपना व्यवसाय करें
                            </h2>
                            <div class="inline-block bg-white text-navy-900 font-extrabold px-6 py-2 rounded-full text-base sm:text-lg shadow-lg">
                                वो भी घर बैठे <i class="fa-solid fa-house text-brand-500 ml-1"></i>
                            </div>
                        </div>

                        <!-- Banner Image & Floating Badges -->
                        <div class="relative bg-navy-800 flex items-center justify-center overflow-hidden h-80 sm:h-96">
                            <!-- Background pattern or ambient glow -->
                            <div class="absolute inset-0 bg-gradient-to-t from-navy-900 via-transparent to-transparent z-10"></div>
                            
                            <!-- High Quality Image representing the smiling professional woman on laptop -->
                            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=1000&auto=format&fit=crop" alt="Woman working from home on laptop" class="absolute inset-0 w-full h-full object-cover object-top opacity-90">
                            
                            <!-- Floating Circular Stamp / Badge (Matching flyer circular badge) -->
                            <div class="absolute top-6 left-6 z-20 bg-navy-900/95 text-white p-5 rounded-full border-2 border-dashed border-gold-400 shadow-2xl w-36 h-36 sm:w-40 sm:h-40 flex flex-col items-center justify-center text-center animate-float">
                                <span class="text-xs sm:text-sm font-bold text-gold-400 uppercase tracking-wider mb-1">विशेष अवसर</span>
                                <span class="text-xs sm:text-sm font-black leading-tight">घर बैठे काम करें अच्छी कमाई करें</span>
                                <i class="fa-solid fa-laptop-house text-brand-400 text-lg sm:text-xl mt-1.5 animate-bounce"></i>
                            </div>

                            <!-- Laptop / Brand Watermark overlay at bottom right -->
                            <div class="absolute bottom-4 right-4 z-20 bg-white/95 backdrop-blur text-navy-900 py-2 px-4 rounded-xl shadow-xl border border-white flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-brand-500 text-white flex items-center justify-center font-bold text-xs">S</div>
                                <div class="text-xs font-black leading-tight">SAMARTH<br><span class="text-brand-500">DIGITAL</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. "हम आपको देते हैं -" (WHAT WE PROVIDE) SECTION -->
    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-brand-600 font-extrabold text-sm uppercase tracking-wider bg-brand-50 px-4 py-1.5 rounded-full border border-brand-200">
                    हमारी विशेषताएँ
                </span>
                <h2 class="font-devanagari text-3xl sm:text-4xl lg:text-5xl font-black text-navy-900 mt-4 mb-4">
                    हम आपको देते हैं
                </h2>
                <div class="w-24 h-1.5 bg-accent-500 mx-auto rounded-full mb-4"></div>
                <p class="text-gray-600 text-lg">व्यावहारिक ज्ञान और आधुनिक टूल्स का एक बेहतरीन संगम जो आपको सफल बनाता है।</p>
            </div>

            <!-- Main Layout: 5 Feature Cards on Left/Grid, 1 Gift Box on Right -->
            <div class="grid lg:grid-cols-12 gap-8 items-stretch">
                
                <!-- Features Grid (8 Cols) -->
                <div class="lg:col-span-8 grid sm:grid-cols-2 md:grid-cols-3 gap-6">
                    <!-- Feature 1 -->
                    <div class="bg-gray-50 p-8 rounded-3xl border border-gray-200 hover:border-brand-500 hover:shadow-premium transition-all duration-300 flex flex-col justify-between group bg-gradient-to-b hover:from-brand-50/20 hover:to-white">
                        <div>
                            <div class="w-16 h-16 bg-navy-900 text-white rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-md group-hover:bg-brand-500 group-hover:rotate-6 transition duration-300">
                                <i class="fa-solid fa-book-open-reader"></i>
                            </div>
                            <h3 class="font-devanagari text-xl font-bold text-navy-900 mb-3 leading-snug">व्यावहारिक ऑनलाइन ट्रेनिंग</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">घर बैठे अपने समय के अनुसार लाइव और रिकॉर्डेड सेशंस के माध्यम से बेहतरीन ट्रेनिंग प्राप्त करें।</p>
                        </div>
                        <div class="mt-6 pt-4 border-t border-gray-200 text-brand-500 font-bold text-xs flex items-center gap-1 group-hover:translate-x-1 transition transform">
                            अधिक जानें <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-gray-50 p-8 rounded-3xl border border-gray-200 hover:border-brand-500 hover:shadow-premium transition-all duration-300 flex flex-col justify-between group bg-gradient-to-b hover:from-brand-50/20 hover:to-white">
                        <div>
                            <div class="w-16 h-16 bg-brand-500 text-white rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-md group-hover:bg-accent-500 group-hover:rotate-6 transition duration-300">
                                <i class="fa-solid fa-award"></i>
                            </div>
                            <h3 class="font-devanagari text-xl font-bold text-navy-900 mb-3 leading-snug">सर्टिफिकेट के साथ मान्यता</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">कोर्स पूरा करने के बाद आपको एक प्रतिष्ठित और मान्य सर्टिफिकेट दिया जाएगा जो आपके करियर में सहायक होगा।</p>
                        </div>
                        <div class="mt-6 pt-4 border-t border-gray-200 text-brand-500 font-bold text-xs flex items-center gap-1 group-hover:translate-x-1 transition transform">
                            अधिक जानें <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-gray-50 p-8 rounded-3xl border border-gray-200 hover:border-brand-500 hover:shadow-premium transition-all duration-300 flex flex-col justify-between group bg-gradient-to-b hover:from-brand-50/20 hover:to-white">
                        <div>
                            <div class="w-16 h-16 bg-accent-500 text-white rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-md group-hover:bg-navy-900 group-hover:rotate-6 transition duration-300">
                                <i class="fa-solid fa-headset"></i>
                            </div>
                            <h3 class="font-devanagari text-xl font-bold text-navy-900 mb-3 leading-snug">पूरी तरह से सपोर्ट सिस्टम</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">किसी भी समस्या के समाधान के लिए 24x7 हमारी सपोर्ट टीम और एक्सपर्ट मेंटर्स हमेशा आपके साथ हैं।</p>
                        </div>
                        <div class="mt-6 pt-4 border-t border-gray-200 text-brand-500 font-bold text-xs flex items-center gap-1 group-hover:translate-x-1 transition transform">
                            अधिक जानें <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>

                    <!-- Feature 4 -->
                    <div class="bg-gray-50 p-8 rounded-3xl border border-gray-200 hover:border-brand-500 hover:shadow-premium transition-all duration-300 flex flex-col justify-between group bg-gradient-to-b hover:from-brand-50/20 hover:to-white sm:col-span-1 md:col-span-1 lg:col-span-1">
                        <div>
                            <div class="w-16 h-16 bg-purple-600 text-white rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-md group-hover:bg-purple-700 group-hover:rotate-6 transition duration-300">
                                <i class="fa-solid fa-briefcase"></i>
                            </div>
                            <h3 class="font-devanagari text-xl font-bold text-navy-900 mb-3 leading-snug">बिजनेस शुरू करने में मार्गदर्शन</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">ट्रेनिंग के बाद आपको अपना खुद का व्यवसाय (स्व-रोजगार) स्थापित करने के लिए हर संभव मार्गदर्शन दिया जाएगा।</p>
                        </div>
                        <div class="mt-6 pt-4 border-t border-gray-200 text-purple-600 font-bold text-xs flex items-center gap-1 group-hover:translate-x-1 transition transform">
                            अधिक जानें <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>

                    <!-- Feature 5 -->
                    <div class="bg-gray-50 p-8 rounded-3xl border border-gray-200 hover:border-brand-500 hover:shadow-premium transition-all duration-300 flex flex-col justify-between group bg-gradient-to-b hover:from-brand-50/20 hover:to-white sm:col-span-1 md:col-span-2 lg:col-span-2">
                        <div>
                            <div class="w-16 h-16 bg-teal-600 text-white rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-md group-hover:bg-teal-700 group-hover:rotate-6 transition duration-300">
                                <i class="fa-solid fa-hand-holding-dollar"></i>
                            </div>
                            <h3 class="font-devanagari text-xl font-bold text-navy-900 mb-3 leading-snug">कम निवेश में बेहतर आमदनी</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">हमारे कोर्सेज इस प्रकार डिजाइन किए गए हैं कि आप बहुत कम लागत लगाकर भी शानदार और निरंतर आमदनी कमा सकें।</p>
                        </div>
                        <div class="mt-6 pt-4 border-t border-gray-200 text-teal-600 font-bold text-xs flex items-center gap-1 group-hover:translate-x-1 transition transform">
                            अधिक जानें <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>
                </div>

                <!-- Right Gift Banner Box (4 Cols) -->
                <div class="lg:col-span-4 flex flex-col justify-between bg-gradient-to-br from-navy-900 via-navy-800 to-brand-900 rounded-3xl p-8 text-white shadow-premium border-2 border-white/20 relative overflow-hidden">
                    <!-- Background ambient glow -->
                    <div class="absolute -top-20 -right-20 w-60 h-60 bg-gold-500/20 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-brand-500/30 rounded-full blur-3xl"></div>

                    <div class="relative z-10 space-y-6">
                        <!-- Gift Header Banner -->
                        <div class="flex items-center gap-4 border-b border-white/15 pb-6">
                            <div class="w-16 h-16 bg-white/10 rounded-2xl border border-white/20 flex items-center justify-center text-4xl text-gold-400 shadow-inner animate-bounce" style="animation-duration: 3s;">
                                🎁
                            </div>
                            <div>
                                <h3 class="font-devanagari text-2xl sm:text-3xl font-black text-gold-400 tracking-tight">जुड़ें और पाएं</h3>
                                <p class="text-xs text-gray-300">विशेष सदस्य लाभ</p>
                            </div>
                        </div>

                        <!-- Benefit List -->
                        <ul class="space-y-4 font-devanagari text-base sm:text-lg font-bold">
                            <li class="flex items-center gap-3 bg-white/5 p-3.5 rounded-2xl border border-white/10">
                                <i class="fa-solid fa-circle-check text-brand-400 text-xl"></i>
                                <span>विशेष ट्रेनिंग ऑफर</span>
                            </li>
                            <li class="flex items-center gap-3 bg-white/5 p-3.5 rounded-2xl border border-white/10">
                                <i class="fa-solid fa-circle-check text-brand-400 text-xl"></i>
                                <span>बिजनेस टूल्स एवं सपोर्ट</span>
                            </li>
                            <li class="flex items-center gap-3 bg-white/5 p-3.5 rounded-2xl border border-white/10">
                                <i class="fa-solid fa-circle-check text-brand-400 text-xl"></i>
                                <span>निरंतर मार्गदर्शन</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Action Button at Bottom -->
                    <div class="relative z-10 mt-8 pt-6 border-t border-white/15">
                        <a href="{{ route('register') }}" class="w-full text-center bg-brand-500 hover:bg-brand-600 text-white font-black text-lg sm:text-xl py-4 px-6 rounded-2xl shadow-xl shadow-brand-500/40 transition block transform hover:scale-[1.02]">
                            आज ही जुड़ें, भविष्य संवारें!
                        </a>
                        <p class="text-center text-xs text-gray-300 mt-3">सीमित समय के लिए विशेष रजिस्ट्रेशन खुला है</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 3. "ट्रेनिंग के दो विकल्प" (TWO TRAINING OPTIONS) SECTION -->
    <section id="training" class="py-20 bg-gray-50 border-y border-gray-200 relative overflow-hidden">
        <!-- Decorative subtle background grid -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#e2e8f0_1px,transparent_1px),linear-gradient(to_bottom,#e2e8f0_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_50%,#000_70%,transparent_100%)] opacity-40"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Title Box -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <div class="inline-block bg-navy-900 text-white font-devanagari font-black text-xl sm:text-2xl px-8 py-3 rounded-full shadow-lg border-2 border-brand-500 mb-4 tracking-wide">
                    ट्रेनिंग के दो विकल्प
                </div>
                <p class="text-gray-600 text-lg">आप अपनी सुविधा के अनुसार हमारे ऑनलाइन या ऑफलाइन दोनों में से किसी भी माध्यम का चयन कर सकते हैं।</p>
            </div>

            <!-- Two Options Split Card connected by 'और' -->
            <div class="relative max-w-5xl mx-auto">
                <!-- Center Connector Circle / Line (Desktop only) -->
                <div class="hidden md:block absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-30">
                    <div class="w-20 h-20 bg-navy-900 text-white rounded-full flex items-center justify-center font-devanagari font-black text-2xl border-4 border-white shadow-2xl animate-pulse">
                        और
                    </div>
                </div>
                
                <div class="grid md:grid-cols-2 gap-8 md:gap-12 relative z-20">
                    
                    <!-- Option 1: ONLINE TRAINING (Green Accent) -->
                    <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-premium border-t-8 border-brand-500 flex flex-col justify-between transform hover:-translate-y-1 transition duration-300 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-brand-50 rounded-bl-full opacity-50 pointer-events-none"></div>
                        
                        <div class="space-y-6 relative z-10">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-brand-50 text-brand-500 rounded-2xl flex items-center justify-center text-3xl border border-brand-200 shadow-inner">
                                    <i class="fa-solid fa-laptop"></i>
                                </div>
                                <div>
                                    <span class="text-xs font-bold text-gray-500 tracking-wider uppercase block">विकल्प 1</span>
                                    <h3 class="font-extrabold text-2xl sm:text-3xl text-brand-600 tracking-tight">ONLINE TRAINING</h3>
                                </div>
                            </div>

                            <div class="w-full h-px bg-gray-200"></div>

                            <ul class="space-y-4 font-devanagari text-lg text-gray-700 font-semibold">
                                <li class="flex items-start gap-3.5">
                                    <i class="fa-solid fa-circle-check text-brand-500 text-xl mt-1 flex-shrink-0"></i>
                                    <span>घर बैठे लाइव क्लासेस</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <i class="fa-solid fa-circle-check text-brand-500 text-xl mt-1 flex-shrink-0"></i>
                                    <span>वीडियो लेक्चर</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <i class="fa-solid fa-circle-check text-brand-500 text-xl mt-1 flex-shrink-0"></i>
                                    <span>24x7 रिकॉर्डेड एक्सेस</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <i class="fa-solid fa-circle-check text-brand-500 text-xl mt-1 flex-shrink-0"></i>
                                    <span>कहीं से भी, कभी भी सीखें</span>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-100 relative z-10">
                            <a href="{{ route('register') }}" class="w-full py-4 bg-brand-50 hover:bg-brand-500 text-brand-700 hover:text-white rounded-2xl font-bold text-center block transition duration-300 border border-brand-200">
                                ऑनलाइन ट्रेनिंग चुनें
                            </a>
                        </div>
                    </div>

                    <!-- Option 2: OFFLINE TRAINING (Orange Accent) -->
                    <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-premium border-t-8 border-accent-500 flex flex-col justify-between transform hover:-translate-y-1 transition duration-300 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-accent-100 rounded-bl-full opacity-50 pointer-events-none"></div>
                        
                        <div class="space-y-6 relative z-10">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-accent-100 text-accent-600 rounded-2xl flex items-center justify-center text-3xl border border-accent-200 shadow-inner">
                                    <i class="fa-solid fa-chalkboard-user"></i>
                                </div>
                                <div>
                                    <span class="text-xs font-bold text-gray-500 tracking-wider uppercase block">विकल्प 2</span>
                                    <h3 class="font-extrabold text-2xl sm:text-3xl text-accent-600 tracking-tight">OFFLINE TRAINING</h3>
                                </div>
                            </div>

                            <div class="w-full h-px bg-gray-200"></div>

                            <ul class="space-y-4 font-devanagari text-lg text-gray-700 font-semibold">
                                <li class="flex items-start gap-3.5">
                                    <i class="fa-solid fa-circle-check text-accent-500 text-xl mt-1 flex-shrink-0"></i>
                                    <span>एक्सपर्ट ट्रेनर द्वारा क्लासरूम ट्रेनिंग</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <i class="fa-solid fa-circle-check text-accent-500 text-xl mt-1 flex-shrink-0"></i>
                                    <span>प्रैक्टिकल वर्कशॉप</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <i class="fa-solid fa-circle-check text-accent-500 text-xl mt-1 flex-shrink-0"></i>
                                    <span>व्यक्तिगत मार्गदर्शन</span>
                                </li>
                                <li class="flex items-start gap-3.5">
                                    <i class="fa-solid fa-circle-check text-accent-500 text-xl mt-1 flex-shrink-0"></i>
                                    <span>नजदीकी प्रशिक्षण केंद्र पर</span>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-100 relative z-10">
                            <a href="{{ route('register') }}" class="w-full py-4 bg-accent-100 hover:bg-accent-500 text-accent-700 hover:text-white rounded-2xl font-bold text-center block transition duration-300 border border-accent-200">
                                ऑफलाइन ट्रेनिंग चुनें
                            </a>
                        </div>
                    </div>

                </div>

                <!-- Mobile only 'और' badge -->
                <div class="md:hidden my-6 text-center">
                    <span class="inline-block bg-navy-900 text-white font-devanagari font-bold px-6 py-2 rounded-full border-2 border-white shadow">
                        और
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. "हमारे प्रमुख कोर्स (घर बैठे करें व्यवसाय)" (MAJOR COURSES) SECTION -->
    <section id="courses" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-brand-600 font-bold text-sm uppercase tracking-wider bg-brand-50 px-4 py-1.5 rounded-full border border-brand-200">
                    व्यावसायिक प्रशिक्षण
                </span>
                <h2 class="font-devanagari text-3xl sm:text-4xl lg:text-5xl font-black text-navy-900 mt-4 mb-4">
                    हमारे प्रमुख कोर्स <span class="text-brand-500 block sm:inline">(घर बैठे करें व्यवसाय)</span>
                </h2>
                <div class="w-24 h-1.5 bg-brand-500 mx-auto rounded-full mb-4"></div>
                <p class="text-gray-600 text-lg font-medium">इन कोर्सेज को सीखकर आप अपने घर से ही एक सफल और लाभदायक व्यवसाय शुरू कर सकते हैं।</p>
            </div>

            <!-- Course Cards Grid (3 Columns) -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <!-- Course 1: Cleaning Products -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-premium border border-gray-100 flex flex-col group hover:-translate-y-1.5 transition-all duration-300">
                    <div class="relative h-60 overflow-hidden">
                        <img src="{{ asset('images/landing/cleaning_products.png') }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="Cleaning Products Making Course">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        <div class="absolute top-4 right-4 bg-brand-500 text-white text-xs font-black px-3.5 py-1.5 rounded-full uppercase tracking-wider shadow">
                            Practical Pro
                        </div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <span class="text-gold-400 font-bold text-xs uppercase tracking-wider">Business Course</span>
                            <h4 class="text-white font-extrabold text-xl leading-tight">CLEANING PRODUCTS MAKING COURSE</h4>
                        </div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between space-y-4 bg-gray-50/50">
                        <p class="font-devanagari text-lg font-bold text-brand-600 flex items-center gap-2">
                            <i class="fa-solid fa-flask text-brand-500"></i> क्लीनिंग प्रोडक्ट्स बनाना सीखें
                        </p>
                        <p class="text-gray-600 text-sm leading-relaxed">फिनाइल, लिक्विड सोप, डिश वॉश, टॉयलेट क्लीनर आदि बनाने का संपूर्ण प्रैक्टिकल प्रशिक्षण।</p>
                        <a href="{{ route('register') }}" class="w-full text-center bg-white hover:bg-brand-500 text-navy-900 hover:text-white font-bold py-3 rounded-xl border border-gray-200 transition duration-300 shadow-sm block">
                            कोर्स में नामांकन लें <i class="fa-solid fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Course 2: Gau Products -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-premium border border-gray-100 flex flex-col group hover:-translate-y-1.5 transition-all duration-300">
                    <div class="relative h-60 overflow-hidden">
                        <img src="{{ asset('images/landing/desi_cow.png') }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="Gau Products Making Course">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        <div class="absolute top-4 right-4 bg-brand-500 text-white text-xs font-black px-3.5 py-1.5 rounded-full uppercase tracking-wider shadow">
                            Organic Pro
                        </div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <span class="text-gold-400 font-bold text-xs uppercase tracking-wider">Business Course</span>
                            <h4 class="text-white font-extrabold text-xl leading-tight">GAU PRODUCTS MAKING COURSE</h4>
                        </div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between space-y-4 bg-gray-50/50">
                        <p class="font-devanagari text-lg font-bold text-brand-600 flex items-center gap-2">
                            <i class="fa-solid fa-leaf text-brand-500"></i> गौ उत्पाद बनाकर स्वस्थ और समृद्ध बनें
                        </p>
                        <p class="text-gray-600 text-sm leading-relaxed">पंचगव्य और गौ उत्पादों से हर्बल व ऑर्गेनिक वस्तुएं बनाकर बाजार में अपना BRAND बनाएं।</p>
                        <a href="{{ route('register') }}" class="w-full text-center bg-white hover:bg-brand-500 text-navy-900 hover:text-white font-bold py-3 rounded-xl border border-gray-200 transition duration-300 shadow-sm block">
                            कोर्स में नामांकन लें <i class="fa-solid fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Course 3: Hawan Cup & Dhoopbatti -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-premium border border-gray-100 flex flex-col group hover:-translate-y-1.5 transition-all duration-300">
                    <div class="relative h-60 overflow-hidden">
                        <img src="{{ asset('images/landing/hawan_cup_dhoopbatti.png') }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="Hawan Cup & Dhoopbatti Making Course">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        <div class="absolute top-4 right-4 bg-brand-500 text-white text-xs font-black px-3.5 py-1.5 rounded-full uppercase tracking-wider shadow">
                            High Demand
                        </div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <span class="text-gold-400 font-bold text-xs uppercase tracking-wider">Business Course</span>
                            <h4 class="text-white font-extrabold text-xl leading-tight">HAWAN CUP & DHOOPBATTI MAKING</h4>
                        </div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between space-y-4 bg-gray-50/50">
                        <p class="font-devanagari text-lg font-bold text-brand-600 flex items-center gap-2">
                            <i class="fa-solid fa-fire text-brand-500"></i> हवन कप और धूपबत्ती बनाएं
                        </p>
                        <p class="text-gray-600 text-sm leading-relaxed">धार्मिक और सुगंधित उत्पादों की अत्यधिक मांग का लाभ उठाएं। कम निवेश में घर से शुरुआत करें।</p>
                        <a href="{{ route('register') }}" class="w-full text-center bg-white hover:bg-brand-500 text-navy-900 hover:text-white font-bold py-3 rounded-xl border border-gray-200 transition duration-300 shadow-sm block">
                            कोर्स में नामांकन लें <i class="fa-solid fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Course 4: Computer Course -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-premium border border-gray-100 flex flex-col group hover:-translate-y-1.5 transition-all duration-300">
                    <div class="relative h-60 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="Computer Course">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        <div class="absolute top-4 right-4 bg-navy-900 text-white text-xs font-black px-3.5 py-1.5 rounded-full uppercase tracking-wider shadow">
                            Digital Skill
                        </div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <span class="text-gold-400 font-bold text-xs uppercase tracking-wider">Skill Course</span>
                            <h4 class="text-white font-extrabold text-xl leading-tight">COMPUTER COURSE</h4>
                        </div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between space-y-4 bg-gray-50/50">
                        <p class="font-devanagari text-lg font-bold text-brand-600 flex items-center gap-2">
                            <i class="fa-solid fa-desktop text-brand-500"></i> बेसिक से एडवांस कंप्यूटर सीखें
                        </p>
                        <p class="text-gray-600 text-sm leading-relaxed">ऑफिस ऑटोमेशन, एक्सेल, इंटरनेट और डिजिटल एकाउंटिंग टूल्स में दक्षता हासिल करें।</p>
                        <a href="{{ route('register') }}" class="w-full text-center bg-white hover:bg-brand-500 text-navy-900 hover:text-white font-bold py-3 rounded-xl border border-gray-200 transition duration-300 shadow-sm block">
                            कोर्स में नामांकन लें <i class="fa-solid fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Course 5: Artificial Intelligence -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-premium border border-gray-100 flex flex-col group hover:-translate-y-1.5 transition-all duration-300">
                    <div class="relative h-60 overflow-hidden">
                        <img src="{{ asset('images/landing/computer_skill.png') }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="Artificial Intelligence Course">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        <div class="absolute top-4 right-4 bg-accent-500 text-white text-xs font-black px-3.5 py-1.5 rounded-full uppercase tracking-wider shadow">
                            Future Tech
                        </div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <span class="text-gold-400 font-bold text-xs uppercase tracking-wider">Skill Course</span>
                            <h4 class="text-white font-extrabold text-xl leading-tight">ARTIFICIAL INTELLIGENCE COURSE</h4>
                        </div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between space-y-4 bg-gray-50/50">
                        <p class="font-devanagari text-lg font-bold text-brand-600 flex items-center gap-2">
                            <i class="fa-solid fa-robot text-brand-500"></i> AI की तकनीक सीखें, भविष्य के लिए तैयार रहें
                        </p>
                        <p class="text-gray-600 text-sm leading-relaxed">आर्टिफिशियल इंटेलिजेंस (AI) और प्रॉम्प्ट इंजीनियरिंग सीखकर अपने काम की गति को 10 गुना बढ़ाएं।</p>
                        <a href="{{ route('register') }}" class="w-full text-center bg-white hover:bg-brand-500 text-navy-900 hover:text-white font-bold py-3 rounded-xl border border-gray-200 transition duration-300 shadow-sm block">
                            कोर्स में नामांकन लें <i class="fa-solid fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>

                <!-- Course 6: Other Profitable Courses -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-premium border border-gray-100 flex flex-col group hover:-translate-y-1.5 transition-all duration-300">
                    <div class="relative h-60 overflow-hidden">
                        <img src="{{ asset('images/landing/multi_skill_business.png') }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="Other Profitable Courses">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        <div class="absolute top-4 right-4 bg-brand-500 text-white text-xs font-black px-3.5 py-1.5 rounded-full uppercase tracking-wider shadow">
                            Multi Skill
                        </div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <span class="text-gold-400 font-bold text-xs uppercase tracking-wider">Business Course</span>
                            <h4 class="text-white font-extrabold text-xl leading-tight">अन्य लाभकारी कोर्स</h4>
                        </div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-between space-y-4 bg-gray-50/50">
                        <p class="font-devanagari text-lg font-bold text-brand-600 flex items-center gap-2">
                            <i class="fa-solid fa-gifts text-brand-500"></i> मोमबत्ती, अगरबत्ती, फिनाइल व अन्य
                        </p>
                        <p class="text-gray-600 text-sm leading-relaxed">मोमबत्ती बनाना, अगरबत्ती, हैंडवॉश, सिलाेद, फेस वॉश, शैम्पू, साबुन आदि बनाने का संपूर्ण ज्ञान।</p>
                        <a href="{{ route('register') }}" class="w-full text-center bg-white hover:bg-brand-500 text-navy-900 hover:text-white font-bold py-3 rounded-xl border border-gray-200 transition duration-300 shadow-sm block">
                            कोर्स में नामांकन लें <i class="fa-solid fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>

            </div>

            <!-- Bottom Floating Dream Ribbon -->
            <div class="mt-16 bg-navy-900 text-white p-6 sm:p-8 rounded-3xl shadow-xl flex flex-col sm:flex-row items-center justify-center gap-4 text-center border-2 border-gold-400/40 relative overflow-hidden">
                <div class="absolute top-0 right-0 transform translate-x-10 -translate-y-10 w-40 h-40 bg-brand-500/30 rounded-full blur-2xl pointer-events-none"></div>
                <div class="text-3xl sm:text-4xl text-accent-500 animate-bounce">✈️</div>
                <h3 class="font-devanagari text-xl sm:text-2xl lg:text-3xl font-black text-gold-400 tracking-wide">
                    और भी कई कोर्स जो आपके सपनों को देंगे नई उड़ान!
                </h3>
            </div>

        </div>
    </section>

    <!-- 5. CALL TO ACTION SPLIT BANNER (Bottom Banner from Flyer) -->
    <section class="py-16 bg-gradient-premium text-white relative z-20 overflow-hidden shadow-2xl border-t-4 border-brand-500">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center opacity-10 mix-blend-overlay z-0"></div>
        
        <!-- Ambient background glows -->
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-accent-500/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-12 gap-12 items-center">
                
                <!-- Left Banner Split (7 Cols) -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left border-b lg:border-b-0 lg:border-r border-white/20 pb-10 lg:pb-0 lg:pr-12">
                    <div class="inline-block bg-white text-navy-900 font-extrabold text-sm uppercase px-5 py-2 rounded-full tracking-wider shadow">
                        आज ही शुरुआत करें
                    </div>
                    <h2 class="font-devanagari text-3xl sm:text-4xl lg:text-5xl font-black leading-tight text-white">
                        आज ही <span class="text-gold-400">SAMARTH DIGITAL</span> के साथ जुड़ें
                    </h2>
                    <div class="w-32 h-1 bg-brand-400 mx-auto lg:mx-0 rounded-full"></div>
                    <p class="font-devanagari text-xl sm:text-2xl font-bold text-gray-200">
                        आत्मनिर्भर बनें, दूसरों को भी आत्मनिर्भर बनाएं!
                    </p>
                    <div class="pt-4 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('register') }}" class="bg-brand-500 hover:bg-brand-600 text-white font-extrabold text-lg py-4 px-8 rounded-2xl shadow-xl shadow-brand-500/50 transition transform hover:-translate-y-1 text-center inline-block">
                            रजिस्टर करें और ट्रेनिंग शुरू करें
                        </a>
                        <a href="{{ route('login') }}" class="bg-white/10 hover:bg-white/20 border border-white/30 text-white font-bold py-4 px-8 rounded-2xl backdrop-blur transition text-center inline-block">
                            सदस्य लॉगिन
                        </a>
                    </div>
                </div>

                <!-- Right Banner Split (5 Cols) -->
                <div class="lg:col-span-5 space-y-6 text-center">
                    <div>
                        <h3 class="font-devanagari text-2xl sm:text-3xl font-extrabold text-gray-200 mb-1">
                            आपकी मेहनत, हमारा साथ
                        </h3>
                        <h2 class="font-devanagari text-4xl sm:text-5xl font-black text-gold-400 drop-shadow">
                            सफलता आपके हाथ!
                        </h2>
                    </div>

                    <div class="bg-white/10 backdrop-blur-md p-6 rounded-3xl border border-white/20 shadow-xl max-w-md mx-auto space-y-4 font-devanagari">
                        <p class="text-xs sm:text-sm font-semibold text-gray-300 uppercase tracking-widest">
                            अधिक जानकारी के लिए संपर्क करें
                        </p>
                        <a href="https://wa.me/919891176777?text=नमस्ते,%20मुझे%20Samarth%20Digital%20के%20कोर्सेज%20और%20स्व-रोजगार%20के%20बारे%20में%20जानकारी%20चाहिए।" target="_blank" class="flex items-center justify-center gap-3 bg-green-500 hover:bg-green-600 text-white py-4 px-6 rounded-2xl font-black text-2xl sm:text-3xl shadow-lg transition group">
                            <i class="fa-brands fa-whatsapp text-white text-3.5xl group-hover:scale-110 transition animate-bounce"></i>
                            <span>9891176777</span>
                        </a>
                        <div class="flex items-center justify-center gap-2 text-gold-400 font-bold text-base sm:text-lg pt-2">
                            <i class="fa-solid fa-globe"></i> www.samarth.digital
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 6. FEATURE HIGHLIGHTS FOOTER BAR (4 Bottom Points from Flyer) -->
    <section class="bg-white py-12 border-b border-gray-200 relative z-30 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Highlight 1 -->
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200 shadow-sm flex items-center gap-4 hover:border-brand-500 transition group">
                    <div class="w-14 h-14 bg-brand-100 text-brand-600 rounded-2xl flex items-center justify-center text-2xl font-bold flex-shrink-0 group-hover:bg-brand-500 group-hover:text-white transition">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                    <h4 class="font-devanagari font-bold text-navy-900 text-lg leading-snug">
                        महिलाओं के लिए विशेष अवसर
                    </h4>
                </div>

                <!-- Highlight 2 -->
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200 shadow-sm flex items-center gap-4 hover:border-accent-500 transition group">
                    <div class="w-14 h-14 bg-accent-100 text-accent-600 rounded-2xl flex items-center justify-center text-2xl font-bold flex-shrink-0 group-hover:bg-accent-500 group-hover:text-white transition">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <h4 class="font-devanagari font-bold text-navy-900 text-lg leading-snug">
                        अपने समय का खुद मालिक बनें
                    </h4>
                </div>

                <!-- Highlight 3 -->
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200 shadow-sm flex items-center gap-4 hover:border-brand-500 transition group">
                    <div class="w-14 h-14 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center text-2xl font-bold flex-shrink-0 group-hover:bg-green-600 group-hover:text-white transition">
                        <i class="fa-solid fa-indian-rupee-sign"></i>
                    </div>
                    <h4 class="font-devanagari font-bold text-navy-900 text-lg leading-snug">
                        अतिरिक्त आय से वित्तीय स्वतंत्रता पाएं
                    </h4>
                </div>

                <!-- Highlight 4 -->
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200 shadow-sm flex items-center gap-4 hover:border-navy-900 transition group">
                    <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-2xl font-bold flex-shrink-0 group-hover:bg-navy-900 group-hover:text-white transition">
                        <i class="fa-solid fa-bullseye"></i>
                    </div>
                    <h4 class="font-devanagari font-bold text-navy-900 text-lg leading-snug">
                        छोटा कदम, बड़ा बदलाव आज से शुरू करें!
                    </h4>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. FREQUENTLY ASKED QUESTIONS -->
    <section id="faq" class="py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-brand-600 font-bold text-sm uppercase tracking-wider bg-brand-50 px-4 py-1.5 rounded-full border border-brand-200">
                    अक्सर पूछे जाने वाले प्रश्न
                </span>
                <h2 class="font-devanagari text-3xl sm:text-4xl font-black text-navy-900 mt-4 mb-4">
                    आपके सवालों के जवाब
                </h2>
                <div class="w-20 h-1 bg-brand-500 mx-auto rounded-full"></div>
            </div>

            <div class="space-y-6 font-devanagari">
                <!-- FAQ 1 -->
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    <details class="group p-6 [&_summary::-webkit-details-marker]:hidden" open>
                        <summary class="flex justify-between items-center font-bold text-xl cursor-pointer text-navy-900 select-none">
                            <span>1. ट्रेनिंग कोर्सेज में नामांकन कैसे लें?</span>
                            <span class="transition group-open:rotate-180 bg-gray-100 p-2 rounded-full text-brand-500 flex items-center justify-center">
                                <i class="fa-solid fa-chevron-down text-sm"></i>
                            </span>
                        </summary>
                        <p class="text-gray-600 mt-4 text-base leading-relaxed border-t border-gray-100 pt-4">
                            आप वेबसाइट के 'आज ही जुड़ें' बटन पर क्लिक करके अपना अकाउंट बना सकते हैं। रजिस्ट्रेशन के पश्चात आपको अपने डैशबोर्ड में सभी कोर्सेज और ट्रेनिंग विकल्पों का एक्सेस मिल जाएगा।
                        </p>
                    </details>
                </div>

                <!-- FAQ 2 -->
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    <details class="group p-6 [&_summary::-webkit-details-marker]:hidden">
                        <summary class="flex justify-between items-center font-bold text-xl cursor-pointer text-navy-900 select-none">
                            <span>2. क्या ट्रेनिंग के बाद सर्टिफिकेट मिलेगा?</span>
                            <span class="transition group-open:rotate-180 bg-gray-100 p-2 rounded-full text-brand-500 flex items-center justify-center">
                                <i class="fa-solid fa-chevron-down text-sm"></i>
                            </span>
                        </summary>
                        <p class="text-gray-600 mt-4 text-base leading-relaxed border-t border-gray-100 pt-4">
                            हाँ, प्रत्येक कोर्स को सफलतापूर्वक पूरा करने के बाद आपको Samarth Digital द्वारा एक आधिकारिक और मान्य सर्टिफिकेट जारी किया जाता है जिसे आप अपने पेशेवर नेटवर्क में उपयोग कर सकते हैं।
                        </p>
                    </details>
                </div>

                <!-- FAQ 3 -->
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    <details class="group p-6 [&_summary::-webkit-details-marker]:hidden">
                        <summary class="flex justify-between items-center font-bold text-xl cursor-pointer text-navy-900 select-none">
                            <span>3. क्या घर बैठे व्यवसाय शुरू करने में मदद की जाएगी?</span>
                            <span class="transition group-open:rotate-180 bg-gray-100 p-2 rounded-full text-brand-500 flex items-center justify-center">
                                <i class="fa-solid fa-chevron-down text-sm"></i>
                            </span>
                        </summary>
                        <p class="text-gray-600 mt-4 text-base leading-relaxed border-t border-gray-100 pt-4">
                            बिल्कुल! हमारा मुख्य उद्देश्य केवल कौशल सिखाना नहीं बल्कि आपको स्वावलंबी बनाना है। हम आपको बिजनेस टूल्स, मार्केटिंग सपोर्ट और निरंतर मार्गदर्शन प्रदान करते हैं।
                        </p>
                    </details>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. FOOTER SECTION -->
    <footer id="contact" class="bg-navy-900 text-gray-300 pt-20 pb-12 border-t border-navy-800 relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <!-- Col 1 -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="flex items-center gap-3.5">
                        <img src="{{ asset('logo.png') }}" onerror="this.src='https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=150&auto=format&fit=crop'" alt="Logo" class="w-12 h-12 rounded-xl object-cover bg-white p-1">
                        <span class="font-extrabold text-2xl text-white tracking-tight leading-none">SAMARTH<br><span class="text-brand-400">DIGITAL</span></span>
                    </div>
                    <p class="text-sm text-gray-400 font-devanagari leading-relaxed font-medium">
                        कौशल विकास और स्व रोजगार को समर्पित एक अग्रणी डिजिटल प्लेटफॉर्म जो आपको घर बैठे काम करने और अच्छी कमाई करने के अवसर प्रदान करता है।
                    </p>
                    <div class="flex gap-4 text-lg">
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center hover:bg-brand-500 hover:text-white transition"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center hover:bg-brand-500 hover:text-white transition"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://wa.me/919891176777?text=नमस्ते,%20मुझे%20Samarth%20Digital%20के%20कोर्सेज%20और%20स्व-रोजगार%20के%20बारे%20में%20जानकारी%20चाहिए।" target="_blank" class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center hover:bg-brand-500 hover:text-white transition"><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center hover:bg-brand-500 hover:text-white transition"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>

                <!-- Col 2 -->
                <div class="font-devanagari">
                    <h4 class="text-white font-extrabold text-lg mb-6 border-l-4 border-brand-500 pl-3">त्वरित लिंक</h4>
                    <ul class="space-y-3.5 font-semibold text-gray-400">
                        <li><a href="/" class="hover:text-white transition flex items-center gap-2"><i class="fa-solid fa-angle-right text-brand-500 text-sm"></i> होम</a></li>
                        <li><a href="#about" class="hover:text-white transition flex items-center gap-2"><i class="fa-solid fa-angle-right text-brand-500 text-sm"></i> हमारे बारे में</a></li>
                        <li><a href="#features" class="hover:text-white transition flex items-center gap-2"><i class="fa-solid fa-angle-right text-brand-500 text-sm"></i> हम क्या देते हैं</a></li>
                        <li><a href="#training" class="hover:text-white transition flex items-center gap-2"><i class="fa-solid fa-angle-right text-brand-500 text-sm"></i> ट्रेनिंग विकल्प</a></li>
                        <li><a href="#courses" class="hover:text-white transition flex items-center gap-2"><i class="fa-solid fa-angle-right text-brand-500 text-sm"></i> हमारे प्रमुख कोर्स</a></li>
                    </ul>
                </div>

                <!-- Col 3 -->
                <div class="font-devanagari">
                    <h4 class="text-white font-extrabold text-lg mb-6 border-l-4 border-brand-500 pl-3">ट्रेनिंग कोर्सेज</h4>
                    <ul class="space-y-3.5 font-semibold text-gray-400">
                        <li><a href="#courses" class="hover:text-white transition flex items-center gap-2"><i class="fa-solid fa-angle-right text-accent-500 text-sm"></i> क्लीनिंग प्रोडक्ट्स कोर्स</a></li>
                        <li><a href="#courses" class="hover:text-white transition flex items-center gap-2"><i class="fa-solid fa-angle-right text-accent-500 text-sm"></i> गौ उत्पाद मेकिंग कोर्स</a></li>
                        <li><a href="#courses" class="hover:text-white transition flex items-center gap-2"><i class="fa-solid fa-angle-right text-accent-500 text-sm"></i> हवन कप और धूपबत्ती कोर्स</a></li>
                        <li><a href="#courses" class="hover:text-white transition flex items-center gap-2"><i class="fa-solid fa-angle-right text-accent-500 text-sm"></i> बेसिक व एडवांस कंप्यूटर कोर्स</a></li>
                        <li><a href="#courses" class="hover:text-white transition flex items-center gap-2"><i class="fa-solid fa-angle-right text-accent-500 text-sm"></i> आर्टिफिशियल इंटेलिजेंस (AI) कोर्स</a></li>
                    </ul>
                </div>

                <!-- Col 4 -->
                <div class="font-devanagari">
                    <h4 class="text-white font-extrabold text-lg mb-6 border-l-4 border-brand-500 pl-3">संपर्क जानकारी</h4>
                    <ul class="space-y-4 text-sm font-medium text-gray-300">
                        <li class="flex items-start gap-3.5">
                            <i class="fa-brands fa-whatsapp text-green-400 text-xl mt-1 flex-shrink-0"></i>
                            <div>
                                <strong class="block text-white font-bold">व्हाट्सएप:</strong>
                                <a href="https://wa.me/919891176777?text=नमस्ते,%20मुझे%20Samarth%20Digital%20के%20कोर्सेज%20और%20स्व-रोजगार%20के%20बारे%20में%20जानकारी%20चाहिए।" target="_blank" class="hover:text-white transition">9891176777</a>
                            </div>
                        </li>
                        <li class="flex items-start gap-3.5">
                            <i class="fa-solid fa-envelope text-brand-400 text-lg mt-1 flex-shrink-0"></i>
                            <div>
                                <strong class="block text-white font-bold">ईमेल पता:</strong>
                                <a href="mailto:info@samarthdigital.com" class="hover:text-white transition">info@samarthdigital.com</a>
                            </div>
                        </li>
                        <li class="flex items-start gap-3.5">
                            <i class="fa-solid fa-globe text-accent-400 text-lg mt-1 flex-shrink-0"></i>
                            <div>
                                <strong class="block text-white font-bold">वेबसाइट:</strong>
                                <a href="https://www.samarthdigital.com" target="_blank" class="hover:text-white transition">www.samarthdigital.com</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Bottom Bar -->
            <div class="border-t border-white/10 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs sm:text-sm text-gray-500 font-devanagari font-semibold">
                <p>&copy; 2026 SAMARTH DIGITAL. सर्वाधिकार सुरक्षित।</p>
                <div class="flex items-center gap-4">
                    <a href="#" class="hover:text-gray-300 transition">नियम व शर्तें</a>
                    <span>•</span>
                    <a href="#" class="hover:text-gray-300 transition">गोपनीयता नीति</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Script for sticky header & mobile menu -->
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            const navContainer = document.getElementById('navbar-container');
            if (window.scrollY > 20) {
                nav.classList.add('shadow-lg', 'bg-white/95', 'backdrop-blur-md');
                nav.classList.remove('shadow-sm', 'bg-white/85');
                if (navContainer) {
                    navContainer.classList.remove('py-4');
                    navContainer.classList.add('py-2.5');
                }
            } else {
                nav.classList.remove('shadow-lg', 'bg-white/95', 'backdrop-blur-md');
                nav.classList.add('shadow-sm', 'bg-white/85');
                if (navContainer) {
                    navContainer.classList.remove('py-2.5');
                    navContainer.classList.add('py-4');
                }
            }
        });

        // Mobile menu toggle
        const btn = document.getElementById('mobile-menu-btn');
        const icon = document.getElementById('mobile-menu-icon');
        const menu = document.getElementById('mobile-menu');
        const links = document.querySelectorAll('.mobile-link');
        let menuOpen = false;

        function toggleMenu() {
            menuOpen = !menuOpen;
            if (menuOpen) {
                menu.classList.remove('hidden');
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-xmark');
            } else {
                icon.classList.remove('fa-xmark');
                icon.classList.add('fa-bars');
                menu.classList.add('hidden');
            }
        }

        btn.addEventListener('click', toggleMenu);

        // Close menu when clicking a link
        links.forEach(link => {
            link.addEventListener('click', () => {
                if(menuOpen) toggleMenu();
            });
        });
    </script>

    <!-- Hidden Google Translate Element -->
    <div id="google_translate_element" style="display:none"></div>

    <!-- Floating WhatsApp Widget -->
    <div class="fixed bottom-6 right-6 z-50 flex items-center group">
        <!-- Text Tooltip -->
        <span class="mr-3 bg-navy-900 text-white text-sm font-bold font-devanagari px-4 py-2 rounded-2xl shadow-xl border border-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap">
            WhatsApp पर बात करें
        </span>
        <!-- Floating Button -->
        <a href="https://wa.me/919891176777?text=नमस्ते,%20मुझे%20Samarth%20Digital%20के%20कोर्सेज%20और%20स्व-रोजगार%20के%20बारे%20में%20जानकारी%20चाहिए।" target="_blank" class="w-16 h-16 bg-gradient-to-tr from-green-500 to-green-400 text-white rounded-full flex items-center justify-center text-3xl shadow-glow-green hover:shadow-2xl hover:scale-110 active:scale-95 transition transform duration-300 relative animate-float">
            <!-- Pulsing outer ring -->
            <span class="absolute inset-0 rounded-full bg-green-500 animate-ping opacity-25"></span>
            <i class="fa-brands fa-whatsapp relative z-10"></i>
        </a>
    </div>

    <!-- Google Translate Script -->
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'hi',
                includedLanguages: 'hi,en',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                autoDisplay: false
            }, 'google_translate_element');
        }

        function getTranslateLanguage() {
            var name = "googtrans=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for(var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    var val = c.substring(name.length, c.length);
                    var parts = val.split('/');
                    if (parts.length >= 3) {
                        return parts[2];
                    }
                }
            }
            return "hi";
        }

        function toggleLanguage(lang) {
            var domain = window.location.hostname;
            document.cookie = "googtrans=/hi/" + lang + "; path=/; expires=Fri, 31 Dec 9999 23:59:59 GMT";
            document.cookie = "googtrans=/hi/" + lang + "; path=/; domain=" + domain + "; expires=Fri, 31 Dec 9999 23:59:59 GMT";
            document.cookie = "googtrans=/hi/" + lang + "; path=/; domain=." + domain + "; expires=Fri, 31 Dec 9999 23:59:59 GMT";
            if (domain === 'localhost' || domain === '127.0.0.1') {
                document.cookie = "googtrans=/hi/" + lang + "; path=/; expires=Fri, 31 Dec 9999 23:59:59 GMT";
            }
            window.location.reload();
        }

        document.addEventListener("DOMContentLoaded", function() {
            var currentLang = getTranslateLanguage();
            var toggles = document.querySelectorAll('.custom-lang-toggle');
            toggles.forEach(function(btn, index) {
                if (currentLang === 'en') {
                    if (index === 0) {
                        btn.innerHTML = '<i class="fa-solid fa-language text-xs"></i> हिन्दी';
                    } else if (index === 1) {
                        btn.innerHTML = '<i class="fa-solid fa-language text-lg text-brand-500"></i> हिन्दी';
                    } else {
                        btn.innerHTML = '<i class="fa-solid fa-language text-lg text-brand-500"></i> हिन्दी में पढ़ें';
                    }
                    btn.onclick = function() { toggleLanguage('hi'); };
                } else {
                    if (index === 0) {
                        btn.innerHTML = '<i class="fa-solid fa-language text-xs"></i> English';
                    } else if (index === 1) {
                        btn.innerHTML = '<i class="fa-solid fa-language text-lg text-brand-500"></i> English';
                    } else {
                        btn.innerHTML = '<i class="fa-solid fa-language text-lg text-brand-500"></i> Translate to English';
                    }
                    btn.onclick = function() { toggleLanguage('en'); };
                }
            });
        });
    </script>
    <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>
