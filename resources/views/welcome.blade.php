<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Samarth Digital | Global Skill Development Platform</title>
    <meta name="description" content="Join Samarth Digital, a next-generation learning platform designed to help individuals grow through education, digital training, and professional development.">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0fdfa',
                            100: '#e0e7ff',
                            500: '#6366f1', // Indigo
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#1e1b4b', // Deep Dark Blue/Purple
                            900: '#0f172a', // Slate Dark Blue
                        }
                    },
                    boxShadow: {
                        'soft': '0 10px 40px -10px rgba(0,0,0,0.08)',
                    }
                }
            }
        }
    </script>
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 10px 40px -10px rgba(0,0,0,0.08);
        }
        .gradient-text {
            background: linear-gradient(135deg, #4f46e5, #9333ea);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #1e1b4b 0%, #4338ca 100%);
        }
    </style>
</head>
<body class="antialiased font-sans bg-gray-50 text-gray-800 overflow-x-hidden relative">

    @include('components.preloader')
    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-md border-b border-gray-100 transition-all duration-300 shadow-sm" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-brand-600 to-purple-600 flex items-center justify-center text-white font-heading font-black text-xl shadow-lg shadow-brand-500/30">SD</div>
                    <span class="font-heading font-bold text-2xl text-brand-900 tracking-tight">Samarth <span class="text-brand-600">Digital</span></span>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden lg:flex space-x-8 items-center">
                    <a href="#about" class="text-gray-600 hover:text-brand-600 transition font-medium">About</a>
                    <a href="#programs" class="text-gray-600 hover:text-brand-600 transition font-medium">Programs</a>
                    <a href="#benefits" class="text-gray-600 hover:text-brand-600 transition font-medium">Benefits</a>
                    <a href="#features" class="text-gray-600 hover:text-brand-600 transition font-medium">Features</a>
                    <div class="w-px h-6 bg-gray-200"></div>
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-brand-600 font-bold transition">Sign In</a>
                    <!-- <a href="{{ route('register') }}" class="bg-brand-600 text-white hover:bg-brand-700 px-6 py-2.5 rounded-lg font-semibold shadow-lg shadow-brand-500/30 transition transform hover:-translate-y-0.5">Get Started</a> -->
                </div>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-gray-600 hover:text-brand-600 focus:outline-none p-2 transition">
                        <i id="mobile-menu-icon" class="fa-solid fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Panel -->
        <div id="mobile-menu" class="hidden lg:hidden bg-white/95 backdrop-blur-md border-t border-gray-100 shadow-xl absolute w-full left-0 transition-all duration-300 transform -translate-y-2 opacity-0 pointer-events-none">
            <div class="px-4 pt-2 pb-6 space-y-2 flex flex-col">
                <a href="#about" class="mobile-link block px-3 py-3 text-base font-medium text-gray-700 hover:text-brand-600 hover:bg-brand-50 rounded-lg transition">About</a>
                <a href="#programs" class="mobile-link block px-3 py-3 text-base font-medium text-gray-700 hover:text-brand-600 hover:bg-brand-50 rounded-lg transition">Programs</a>
                <a href="#benefits" class="mobile-link block px-3 py-3 text-base font-medium text-gray-700 hover:text-brand-600 hover:bg-brand-50 rounded-lg transition">Benefits</a>
                <a href="#features" class="mobile-link block px-3 py-3 text-base font-medium text-gray-700 hover:text-brand-600 hover:bg-brand-50 rounded-lg transition">Features</a>
                <div class="border-t border-gray-100 my-2 pt-2"></div>
                <a href="{{ route('login') }}" class="block px-3 py-3 text-base font-bold text-brand-600 hover:bg-brand-50 rounded-lg transition">Sign In</a>
            </div>
        </div>
    </nav>

    <!-- 1. HERO SECTION -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-brand-900 text-white">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center opacity-10 mix-blend-overlay"></div>
            <div class="absolute inset-0 bg-gradient-to-r from-brand-900 via-brand-800/95 to-brand-700/90"></div>
            <!-- Decorative gradient blobs -->
            <div class="absolute top-0 right-0 -mr-40 -mt-40 w-96 h-96 rounded-full bg-purple-600/30 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -ml-40 -mb-40 w-96 h-96 rounded-full bg-brand-500/30 blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-left">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/20 mb-6 text-sm font-medium backdrop-blur-sm">
                        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                        Professional Skill Development Platform
                    </div>
                    <h1 class="font-heading text-4xl md:text-5xl lg:text-6xl font-black leading-tight mb-6">
                        Upgrade Your Skills.<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">Unlock New Opportunities.</span>
                    </h1>
                    <p class="text-lg md:text-xl text-gray-300 mb-8 max-w-xl font-light leading-relaxed">
                        Join a next-generation learning platform designed to help individuals grow through education, digital training, and performance-based rewards.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}" class="bg-white text-brand-900 hover:bg-gray-50 font-bold py-3.5 px-8 rounded-lg shadow-xl transition flex items-center justify-center">
                            Get Started
                        </a>
                        <a href="#programs" class="bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold py-3.5 px-8 rounded-lg transition backdrop-blur-sm flex items-center justify-center">
                            Explore Programs
                        </a>
                    </div>
                    
                    <div class="mt-12 grid grid-cols-3 gap-6 pt-8 border-t border-white/10">
                        <div>
                            <div class="text-3xl font-bold">50+</div>
                            <div class="text-sm text-gray-400 mt-1">Training Modules</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold">10k+</div>
                            <div class="text-sm text-gray-400 mt-1">Active Learners</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold">100%</div>
                            <div class="text-sm text-gray-400 mt-1">Digital Access</div>
                        </div>
                    </div>
                </div>

                <div class="relative hidden lg:block">
                    <div class="absolute inset-0 bg-gradient-to-tr from-brand-500 to-purple-500 rounded-2xl transform rotate-3 scale-105 opacity-50 blur-lg"></div>
                    <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?q=80&w=2070&auto=format&fit=crop" alt="Professionals Learning" class="relative rounded-2xl shadow-2xl border border-white/10 object-cover h-[500px] w-full">
                    
                    <!-- Floating Card -->
                    <div class="absolute -bottom-6 -left-6 bg-white text-gray-900 p-4 rounded-xl shadow-2xl border border-gray-100 flex items-center gap-4 animate-bounce" style="animation-duration: 3s;">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600 text-xl">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div>
                            <div class="font-bold">Certificate Issued</div>
                            <div class="text-sm text-gray-500">Digital Marketing Pro</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. ABOUT US SECTION -->
    <section id="about" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-brand-600 font-bold tracking-wider uppercase text-sm mb-2">About Samarth Digital</h2>
                <h3 class="font-heading text-3xl md:text-4xl font-bold text-gray-900 mb-4">Empowering Growth Through Education & Technology</h3>
                <p class="text-gray-600 text-lg">We are building an ecosystem that bridges the gap between traditional education and modern digital opportunities, fostering personal and professional growth.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Card 1 -->
                <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100 hover:shadow-soft transition group">
                    <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-blue-600 text-2xl mb-6 group-hover:bg-blue-600 group-hover:text-white transition">
                        <i class="fa-solid fa-award"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Certified Learning</h4>
                    <p class="text-gray-600">Access industry-standard courses and earn verifiable certificates upon completion.</p>
                </div>
                <!-- Card 2 -->
                <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100 hover:shadow-soft transition group">
                    <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center text-purple-600 text-2xl mb-6 group-hover:bg-purple-600 group-hover:text-white transition">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Community Support</h4>
                    <p class="text-gray-600">Join a network of driven individuals, mentors, and professionals sharing knowledge.</p>
                </div>
                <!-- Card 3 -->
                <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100 hover:shadow-soft transition group">
                    <div class="w-14 h-14 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600 text-2xl mb-6 group-hover:bg-indigo-600 group-hover:text-white transition">
                        <i class="fa-solid fa-laptop-code"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Smart Ecosystem</h4>
                    <p class="text-gray-600">A seamless digital platform for learning, tracking progress, and managing rewards.</p>
                </div>
                <!-- Card 4 -->
                <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100 hover:shadow-soft transition group">
                    <div class="w-14 h-14 bg-teal-100 rounded-xl flex items-center justify-center text-teal-600 text-2xl mb-6 group-hover:bg-teal-600 group-hover:text-white transition">
                        <i class="fa-solid fa-arrow-trend-up"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Long-Term Growth</h4>
                    <p class="text-gray-600">Continuous skill upgrades designed to accelerate your career trajectory.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. COURSE / TRAINING SECTION -->
    <section id="programs" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12">
                <div class="max-w-2xl">
                    <h2 class="text-brand-600 font-bold tracking-wider uppercase text-sm mb-2">Learning Tracks</h2>
                    <h3 class="font-heading text-3xl md:text-4xl font-bold text-gray-900">Digital Training Programs</h3>
                </div>
                <a href="{{ route('register') }}" class="hidden md:inline-flex text-brand-600 font-semibold hover:text-brand-800 transition items-center">
                    View All Programs <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Course 1 -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-soft border border-gray-100 flex flex-col">
                    <div class="relative h-48">
                        <img src="https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?q=80&w=2074&auto=format&fit=crop" class="w-full h-full object-cover" alt="Digital Marketing">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur text-xs font-bold px-3 py-1 rounded-full text-brand-600 shadow-sm">
                            Certification
                        </div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-center text-sm text-gray-500 mb-3 gap-4">
                            <span><i class="fa-regular fa-clock mr-1"></i> 4 Weeks</span>
                            <span><i class="fa-solid fa-signal mr-1"></i> Beginner</span>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-2">Digital Marketing Essentials</h4>
                        <p class="text-gray-600 text-sm flex-1 mb-6">Master SEO, content strategy, and social media management to thrive in the digital economy.</p>
                        <a href="{{ route('register') }}" class="w-full text-center bg-gray-50 hover:bg-brand-50 text-brand-700 font-semibold py-2.5 rounded-lg border border-gray-200 transition">Explore Module</a>
                    </div>
                </div>

                <!-- Course 2 -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-soft border border-gray-100 flex flex-col">
                    <div class="relative h-48">
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2015&auto=format&fit=crop" class="w-full h-full object-cover" alt="Business Analytics">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur text-xs font-bold px-3 py-1 rounded-full text-brand-600 shadow-sm">
                            Certification
                        </div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-center text-sm text-gray-500 mb-3 gap-4">
                            <span><i class="fa-regular fa-clock mr-1"></i> 6 Weeks</span>
                            <span><i class="fa-solid fa-signal mr-1"></i> Intermediate</span>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-2">Business Analytics Pro</h4>
                        <p class="text-gray-600 text-sm flex-1 mb-6">Learn to interpret data, generate business insights, and utilize modern reporting tools effectively.</p>
                        <a href="{{ route('register') }}" class="w-full text-center bg-gray-50 hover:bg-brand-50 text-brand-700 font-semibold py-2.5 rounded-lg border border-gray-200 transition">Explore Module</a>
                    </div>
                </div>

                <!-- Course 3 -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-soft border border-gray-100 flex flex-col">
                    <div class="relative h-48">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover" alt="Leadership">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur text-xs font-bold px-3 py-1 rounded-full text-brand-600 shadow-sm">
                            Certification
                        </div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-center text-sm text-gray-500 mb-3 gap-4">
                            <span><i class="fa-regular fa-clock mr-1"></i> 8 Weeks</span>
                            <span><i class="fa-solid fa-signal mr-1"></i> Advanced</span>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-2">Corporate Leadership</h4>
                        <p class="text-gray-600 text-sm flex-1 mb-6">Develop critical thinking, team management, and strategic planning skills for modern workplaces.</p>
                        <a href="{{ route('register') }}" class="w-full text-center bg-gray-50 hover:bg-brand-50 text-brand-700 font-semibold py-2.5 rounded-lg border border-gray-200 transition">Explore Module</a>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 text-center md:hidden">
                <a href="{{ route('register') }}" class="inline-flex text-brand-600 font-semibold hover:text-brand-800 transition items-center">
                    View All Programs <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- 4. BENEFITS SECTION -->
    <section id="benefits" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1 relative">
                    <div class="absolute inset-0 bg-brand-100 rounded-3xl transform -rotate-3 scale-105"></div>
                    <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=2084&auto=format&fit=crop" class="relative rounded-3xl shadow-xl border border-gray-100 object-cover w-full h-[600px]" alt="Benefits of learning">
                    
                    <div class="absolute bottom-8 -right-8 glass-card p-6 rounded-2xl hidden md:block w-64 animate-float" style="animation-duration: 4s;">
                        <div class="flex items-center gap-4 mb-2">
                            <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600">
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <h5 class="font-bold text-gray-900">Top Rated</h5>
                        </div>
                        <p class="text-sm text-gray-600">Platform recognized for excellence in digital education.</p>
                    </div>
                </div>
                
                <div class="order-1 lg:order-2">
                    <h2 class="text-brand-600 font-bold tracking-wider uppercase text-sm mb-2">Why Join Us</h2>
                    <h3 class="font-heading text-3xl md:text-4xl font-bold text-gray-900 mb-6">Designed for Your Success</h3>
                    <p class="text-gray-600 text-lg mb-8">We provide more than just courses. Samarth Digital is a comprehensive ecosystem that rewards active learning and professional engagement.</p>
                    
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-brand-50 flex items-center justify-center text-brand-600 text-xl border border-brand-100">
                                <i class="fa-solid fa-globe"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 mb-1">Learn from Anywhere</h4>
                                <p class="text-gray-600">Access our premium content 24/7 from any device, anywhere in the world.</p>
                            </div>
                        </div>
                        
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-purple-50 flex items-center justify-center text-purple-600 text-xl border border-purple-100">
                                <i class="fa-solid fa-gift"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 mb-1">Daily Engagement Rewards</h4>
                                <p class="text-gray-600">Earn platform points and benefits simply by staying active and completing your daily tasks.</p>
                            </div>
                        </div>
                        
                        <div class="flex gap-4">
                            <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-green-50 flex items-center justify-center text-green-600 text-xl border border-green-100">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 mb-1">Performance Recognition</h4>
                                <p class="text-gray-600">Outstanding learners are recognized and rewarded through our community affiliate program.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. HOW IT WORKS SECTION -->
    <section class="py-20 bg-brand-900 text-white relative overflow-hidden">
        <!-- Background accents -->
        <div class="absolute top-0 right-0 w-1/2 h-full bg-brand-800 skew-x-12 translate-x-32 opacity-50"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-brand-400 font-bold tracking-wider uppercase text-sm mb-2">Process</h2>
                <h3 class="font-heading text-3xl md:text-4xl font-bold text-white mb-4">Start Your Journey in 4 Steps</h3>
                <p class="text-gray-400">Our streamlined onboarding process ensures you get access to the tools you need immediately.</p>
            </div>

            <div class="grid md:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="text-center relative">
                    <div class="hidden md:block absolute top-8 left-[60%] w-full h-[2px] bg-brand-700"></div>
                    <div class="w-16 h-16 mx-auto bg-brand-800 border-2 border-brand-500 rounded-2xl flex items-center justify-center text-xl font-bold text-white mb-6 relative z-10 shadow-lg shadow-brand-500/20">
                        1
                    </div>
                    <h4 class="text-lg font-bold mb-2">Create Account</h4>
                    <p class="text-sm text-gray-400">Sign up on our secure portal and verify your professional profile.</p>
                </div>
                
                <!-- Step 2 -->
                <div class="text-center relative">
                    <div class="hidden md:block absolute top-8 left-[60%] w-full h-[2px] bg-brand-700"></div>
                    <div class="w-16 h-16 mx-auto bg-brand-800 border-2 border-brand-500 rounded-2xl flex items-center justify-center text-xl font-bold text-white mb-6 relative z-10 shadow-lg shadow-brand-500/20">
                        2
                    </div>
                    <h4 class="text-lg font-bold mb-2">Access Training</h4>
                    <p class="text-sm text-gray-400">Choose your preferred learning track and unlock the digital library.</p>
                </div>

                <!-- Step 3 -->
                <div class="text-center relative">
                    <div class="hidden md:block absolute top-8 left-[60%] w-full h-[2px] bg-brand-700"></div>
                    <div class="w-16 h-16 mx-auto bg-brand-800 border-2 border-brand-500 rounded-2xl flex items-center justify-center text-xl font-bold text-white mb-6 relative z-10 shadow-lg shadow-brand-500/20">
                        3
                    </div>
                    <h4 class="text-lg font-bold mb-2">Learn & Participate</h4>
                    <p class="text-sm text-gray-400">Complete modules, take assessments, and engage with the community.</p>
                </div>

                <!-- Step 4 -->
                <div class="text-center relative">
                    <div class="w-16 h-16 mx-auto bg-brand-600 border-2 border-brand-400 rounded-2xl flex items-center justify-center text-xl font-bold text-white mb-6 relative z-10 shadow-lg shadow-brand-400/50">
                        4
                    </div>
                    <h4 class="text-lg font-bold mb-2">Unlock Benefits</h4>
                    <p class="text-sm text-gray-400">Earn your certification and unlock platform rewards and features.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. FEATURES SECTION -->
    <section id="features" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-brand-600 font-bold tracking-wider uppercase text-sm mb-2">Platform Capabilities</h2>
                <h3 class="font-heading text-3xl md:text-4xl font-bold text-gray-900 mb-4">Enterprise-Grade Features</h3>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex gap-4">
                    <div class="text-brand-500 text-2xl mt-1"><i class="fa-solid fa-shield-halved"></i></div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-1">Secure Dashboard</h4>
                        <p class="text-sm text-gray-600">Encrypted user portal to manage your profile and data safely.</p>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex gap-4">
                    <div class="text-purple-500 text-2xl mt-1"><i class="fa-solid fa-chart-pie"></i></div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-1">Progress Tracking</h4>
                        <p class="text-sm text-gray-600">Visual analytics showing your learning milestones and metrics.</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex gap-4">
                    <div class="text-green-500 text-2xl mt-1"><i class="fa-solid fa-wallet"></i></div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-1">Wallet Management</h4>
                        <p class="text-sm text-gray-600">Track your engagement rewards and utility tokens easily.</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex gap-4">
                    <div class="text-blue-500 text-2xl mt-1"><i class="fa-solid fa-file-invoice"></i></div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-1">Smart Reporting</h4>
                        <p class="text-sm text-gray-600">Generate detailed reports of your achievements and community growth.</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex gap-4">
                    <div class="text-orange-500 text-2xl mt-1"><i class="fa-solid fa-certificate"></i></div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-1">Digital Certificates</h4>
                        <p class="text-sm text-gray-600">Download and share verifiable credentials on LinkedIn.</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex gap-4">
                    <div class="text-teal-500 text-2xl mt-1"><i class="fa-solid fa-headset"></i></div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-1">24/7 Support</h4>
                        <p class="text-sm text-gray-600">Dedicated helpdesk to assist with technical and learning queries.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. CERTIFICATE SECTION -->
    <section class="py-20 bg-white border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-brand-50 rounded-3xl p-8 lg:p-16 border border-brand-100">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <div class="w-16 h-16 bg-white rounded-full shadow-sm flex items-center justify-center text-brand-600 text-2xl mb-6">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <h3 class="font-heading text-3xl md:text-4xl font-bold text-gray-900 mb-4">Achievement-Based Recognition</h3>
                        <p class="text-gray-600 text-lg mb-8">Upon completing your training track, receive an official digital certificate. Showcase your newly acquired skills to employers and your professional network.</p>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center text-gray-700"><i class="fa-solid fa-check text-green-500 mr-3"></i> Industry-recognized format</li>
                            <li class="flex items-center text-gray-700"><i class="fa-solid fa-check text-green-500 mr-3"></i> Unique verification ID</li>
                            <li class="flex items-center text-gray-700"><i class="fa-solid fa-check text-green-500 mr-3"></i> Instantly shareable online</li>
                        </ul>
                        <a href="{{ route('register') }}" class="bg-brand-600 hover:bg-brand-700 text-white font-bold py-3 px-8 rounded-lg shadow-md transition inline-flex items-center">
                            Start Learning <i class="fa-solid fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-tr from-brand-300 to-purple-300 rounded-lg transform rotate-2 scale-105 opacity-30"></div>
                        <div class="bg-white p-2 rounded-lg shadow-xl relative border border-gray-200">
                            <!-- Placeholder for Certificate Image -->
                            <div class="border-4 border-double border-gray-200 p-8 text-center bg-gray-50 h-80 flex flex-col justify-center items-center">
                                <div class="text-brand-800 font-heading font-bold text-2xl mb-2">Samarth Digital</div>
                                <div class="text-sm text-gray-500 uppercase tracking-widest mb-6">Certificate of Completion</div>
                                <div class="w-32 h-1 bg-brand-500 mb-6"></div>
                                <div class="text-gray-400 italic font-serif">This certifies that the user has successfully completed the digital training program.</div>
                                <div class="mt-8 w-16 h-16 rounded-full border-2 border-yellow-400 flex items-center justify-center text-yellow-500 bg-yellow-50"><i class="fa-solid fa-award text-2xl"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. TESTIMONIAL SECTION -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-brand-600 font-bold tracking-wider uppercase text-sm mb-2">Success Stories</h2>
                <h3 class="font-heading text-3xl md:text-4xl font-bold text-gray-900 mb-4">Trusted by Professionals</h3>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Review 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-soft border border-gray-100">
                    <div class="flex text-yellow-400 mb-4 text-sm">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p class="text-gray-600 italic mb-6">"The training modules are incredibly well-structured. I upgraded my digital skills and the platform's reward ecosystem keeps me motivated every day."</p>
                    <div class="flex items-center gap-4 border-t border-gray-100 pt-4">
                        <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center font-bold text-gray-500">AJ</div>
                        <div>
                            <h5 class="font-bold text-gray-900 text-sm">Amit Joshi</h5>
                            <span class="text-xs text-gray-500">Digital Marketer</span>
                        </div>
                    </div>
                </div>

                <!-- Review 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-soft border border-gray-100 relative transform md:-translate-y-4 border-brand-200">
                    <div class="absolute -top-4 right-8 bg-brand-500 text-white text-xs font-bold px-3 py-1 rounded-full">Featured</div>
                    <div class="flex text-yellow-400 mb-4 text-sm">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p class="text-gray-600 italic mb-6">"Samarth Digital provides a corporate-level learning experience. The dashboard is intuitive, and the certification holds real value in the industry."</p>
                    <div class="flex items-center gap-4 border-t border-gray-100 pt-4">
                        <div class="w-10 h-10 rounded-full bg-brand-100 flex items-center justify-center font-bold text-brand-600">SP</div>
                        <div>
                            <h5 class="font-bold text-gray-900 text-sm">Sneha Patel</h5>
                            <span class="text-xs text-gray-500">Business Analyst</span>
                        </div>
                    </div>
                </div>

                <!-- Review 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-soft border border-gray-100">
                    <div class="flex text-yellow-400 mb-4 text-sm">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p class="text-gray-600 italic mb-6">"A highly professional ecosystem. It's not just about learning; it's about building a sustainable digital career and networking with peers."</p>
                    <div class="flex items-center gap-4 border-t border-gray-100 pt-4">
                        <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center font-bold text-gray-500">RK</div>
                        <div>
                            <h5 class="font-bold text-gray-900 text-sm">Rahul Kumar</h5>
                            <span class="text-xs text-gray-500">Entrepreneur</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 9. FAQ SECTION -->
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="font-heading text-3xl md:text-4xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h2>
            </div>

            <div class="space-y-4">
                <!-- FAQ Item -->
                <div class="border border-gray-200 rounded-xl overflow-hidden">
                    <details class="group p-6 [&_summary::-webkit-details-marker]:hidden" open>
                        <summary class="flex justify-between items-center font-bold cursor-pointer text-gray-900">
                            How do I access the training programs?
                            <span class="transition group-open:rotate-180">
                                <i class="fa-solid fa-chevron-down text-brand-500"></i>
                            </span>
                        </summary>
                        <p class="text-gray-600 mt-4 leading-relaxed">
                            Once you create an account and activate your profile, you will instantly gain access to the secure user dashboard where all digital learning tracks and modules are available 24/7.
                        </p>
                    </details>
                </div>
                
                <!-- FAQ Item -->
                <div class="border border-gray-200 rounded-xl overflow-hidden">
                    <details class="group p-6 [&_summary::-webkit-details-marker]:hidden">
                        <summary class="flex justify-between items-center font-bold cursor-pointer text-gray-900">
                            Are the certificates professionally recognized?
                            <span class="transition group-open:rotate-180">
                                <i class="fa-solid fa-chevron-down text-brand-500"></i>
                            </span>
                        </summary>
                        <p class="text-gray-600 mt-4 leading-relaxed">
                            Yes, our certificates demonstrate successful completion of skill-based training modules. They include verification details and can be proudly displayed on professional networks like LinkedIn.
                        </p>
                    </details>
                </div>

                <!-- FAQ Item -->
                <div class="border border-gray-200 rounded-xl overflow-hidden">
                    <details class="group p-6 [&_summary::-webkit-details-marker]:hidden">
                        <summary class="flex justify-between items-center font-bold cursor-pointer text-gray-900">
                            How does the rewards system work?
                            <span class="transition group-open:rotate-180">
                                <i class="fa-solid fa-chevron-down text-brand-500"></i>
                            </span>
                        </summary>
                        <p class="text-gray-600 mt-4 leading-relaxed">
                            We use a gamified learning approach. By engaging with the platform daily, completing modules, and participating in the community ecosystem, you earn platform utility rewards that reflect your performance.
                        </p>
                    </details>
                </div>
            </div>
        </div>
    </section>

    <!-- 10. CONTACT SECTION -->
    <section class="py-20 bg-gray-50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16">
                <div>
                    <h2 class="text-brand-600 font-bold tracking-wider uppercase text-sm mb-2">Get In Touch</h2>
                    <h3 class="font-heading text-3xl md:text-4xl font-bold text-gray-900 mb-6">Contact Our Support Team</h3>
                    <p class="text-gray-600 mb-8">Have questions about our programs, enterprise solutions, or need technical assistance? We are here to help.</p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-lg bg-white border border-gray-200 flex items-center justify-center text-brand-600 text-lg shadow-sm">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Email Us</h4>
                                <p class="text-gray-600">support@samarth.digital</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-lg bg-white border border-gray-200 flex items-center justify-center text-brand-600 text-lg shadow-sm">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Call Us</h4>
                                <p class="text-gray-600">+91 98765 43210</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-lg bg-white border border-gray-200 flex items-center justify-center text-brand-600 text-lg shadow-sm">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">Corporate Office</h4>
                                <p class="text-gray-600">Business Park, Digital Hub,<br>New Delhi, India</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-8 rounded-2xl shadow-soft border border-gray-100">
                    <form class="space-y-6">
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition" placeholder="John">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition" placeholder="Doe">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition" placeholder="john@company.com">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                            <textarea rows="4" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition" placeholder="How can we help you?"></textarea>
                        </div>
                        <button type="button" class="w-full bg-brand-600 hover:bg-brand-700 text-white font-bold py-3.5 rounded-lg shadow-md transition">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- 11. FOOTER -->
    <footer class="bg-brand-900 text-gray-300 pt-16 pb-8 border-t border-brand-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <div class="lg:col-span-1">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-brand-500 to-purple-500 flex items-center justify-center text-white font-heading font-black text-sm">SD</div>
                        <span class="font-heading font-bold text-xl text-white tracking-tight">Samarth Digital</span>
                    </div>
                    <p class="text-sm text-gray-400 mb-6 leading-relaxed">
                        A premium digital education ecosystem empowering individuals with high-income skills and professional networking opportunities.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-brand-800 flex items-center justify-center hover:bg-brand-600 hover:text-white transition"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-brand-800 flex items-center justify-center hover:bg-brand-600 hover:text-white transition"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-brand-800 flex items-center justify-center hover:bg-brand-600 hover:text-white transition"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-brand-800 flex items-center justify-center hover:bg-brand-600 hover:text-white transition"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-white font-bold mb-6">Quick Links</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#about" class="hover:text-brand-400 transition">About Us</a></li>
                        <li><a href="#programs" class="hover:text-brand-400 transition">Training Programs</a></li>
                        <li><a href="#benefits" class="hover:text-brand-400 transition">Platform Benefits</a></li>
                        <li><a href="#features" class="hover:text-brand-400 transition">Features</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-6">Support</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-brand-400 transition">Help Center</a></li>
                        <li><a href="#" class="hover:text-brand-400 transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-brand-400 transition">Terms & Conditions</a></li>
                        <li><a href="#" class="hover:text-brand-400 transition">Contact Us</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-6">Contact Info</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start gap-3"><i class="fa-solid fa-envelope mt-1 text-brand-500"></i> support@samarth.digital</li>
                        <li class="flex items-start gap-3"><i class="fa-solid fa-phone mt-1 text-brand-500"></i> +91 98765 43210</li>
                        <li class="flex items-start gap-3"><i class="fa-solid fa-location-dot mt-1 text-brand-500"></i> Business Park, New Delhi, India</li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-brand-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-gray-500">
                    &copy; 2026 samarth.digital. All rights reserved.
                </p>
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <span>Designed for Professional Excellence</span>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 20) {
                nav.classList.add('shadow-md');
                nav.classList.remove('shadow-sm');
            } else {
                nav.classList.remove('shadow-md');
                nav.classList.add('shadow-sm');
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
                menu.classList.remove('hidden', '-translate-y-2', 'opacity-0', 'pointer-events-none');
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-xmark');
            } else {
                menu.classList.add('-translate-y-2', 'opacity-0', 'pointer-events-none');
                icon.classList.remove('fa-xmark');
                icon.classList.add('fa-bars');
                setTimeout(() => {
                    if(!menuOpen) menu.classList.add('hidden');
                }, 300);
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
</body>
</html>
