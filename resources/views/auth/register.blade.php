<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Samarth Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#1e1b4b',
                            900: '#0f172a',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="antialiased font-sans overflow-x-hidden min-h-screen bg-brand-900 relative flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    @include('components.preloader')

    <!-- Background Elements -->
    <div class="fixed inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=2072&auto=format&fit=crop')] bg-cover bg-center opacity-10 mix-blend-overlay"></div>
        <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] rounded-full bg-brand-600/30 blur-[120px]"></div>
        <div class="absolute -bottom-[20%] -right-[10%] w-[50%] h-[50%] rounded-full bg-purple-600/30 blur-[120px]"></div>
    </div>

    <!-- Main Card -->
    <div class="relative z-10 w-full max-w-lg">
        
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-3 transition transform hover:scale-105">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-brand-500 to-purple-600 flex items-center justify-center text-white font-heading font-black text-2xl shadow-xl shadow-brand-500/20 border border-white/10">SD</div>
                <span class="font-heading font-bold text-3xl text-white tracking-tight">Samarth Digital</span>
            </a>
            <p class="mt-4 text-brand-100 text-sm font-light tracking-wide">Join the ultimate professional growth platform</p>
        </div>

        <!-- Glassmorphism Form Container -->
        <div class="bg-white/[0.03] backdrop-blur-2xl border border-white/10 rounded-2xl shadow-2xl p-8 sm:p-10">
            
            <h2 class="font-heading text-2xl font-bold text-white mb-6 text-center">Create Account</h2>

            @if($errors->any())
                <div class="bg-red-500/10 border border-red-500/30 text-red-200 p-4 rounded-xl text-sm mb-6 backdrop-blur-sm">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf
                
                @php
                    $refCode = request()->query('ref');
                @endphp

                <!-- Sponsor ID (Required for platform entry) -->
                <div>
                    <label class="block text-sm font-medium text-brand-100 mb-2">Sponsor ID <span class="text-red-400">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-users text-gray-400"></i>
                        </div>
                        <input type="text" name="sponsor_id" value="{{ old('sponsor_id', $refCode) }}" class="w-full pl-11 pr-4 py-3 rounded-xl border border-white/10 bg-white/5 text-white placeholder-gray-500 focus:bg-white/10 focus:border-brand-400 focus:ring-1 focus:ring-brand-400 outline-none transition" required placeholder="Enter sponsor's ID" {{ $refCode ? 'readonly' : '' }}>
                        @if($refCode)
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                <i class="fa-solid fa-check-circle text-green-400"></i>
                            </div>
                        @endif
                    </div>
                    @if(!$refCode)
                    <p class="mt-2 text-xs text-brand-200/60">A valid sponsor ID is required to join the platform.</p>
                    @endif
                </div>

                <div>
                    <label class="block text-sm font-medium text-brand-100 mb-2">Full Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-user text-gray-400"></i>
                        </div>
                        <input type="text" name="name" class="w-full pl-11 pr-4 py-3 rounded-xl border border-white/10 bg-white/5 text-white placeholder-gray-500 focus:bg-white/10 focus:border-brand-400 focus:ring-1 focus:ring-brand-400 outline-none transition" required value="{{ old('name') }}" placeholder="John Doe">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-brand-100 mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" name="email" class="w-full pl-11 pr-4 py-3 rounded-xl border border-white/10 bg-white/5 text-white placeholder-gray-500 focus:bg-white/10 focus:border-brand-400 focus:ring-1 focus:ring-brand-400 outline-none transition" required value="{{ old('email') }}" placeholder="you@example.com">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-brand-100 mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fa-solid fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" id="password" name="password" class="w-full pl-11 pr-12 py-3 rounded-xl border border-white/10 bg-white/5 text-white placeholder-gray-500 focus:bg-white/10 focus:border-brand-400 focus:ring-1 focus:ring-brand-400 outline-none transition" required placeholder="••••••••">
                            <button type="button" onclick="togglePassword('password', 'eye-icon-pass')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-white transition focus:outline-none">
                                <i id="eye-icon-pass" class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-brand-100 mb-2">Confirm Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fa-solid fa-shield-check text-gray-400"></i>
                            </div>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="w-full pl-11 pr-12 py-3 rounded-xl border border-white/10 bg-white/5 text-white placeholder-gray-500 focus:bg-white/10 focus:border-brand-400 focus:ring-1 focus:ring-brand-400 outline-none transition" required placeholder="••••••••">
                            <button type="button" onclick="togglePassword('password_confirmation', 'eye-icon-conf')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-white transition focus:outline-none">
                                <i id="eye-icon-conf" class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <script>
                    function togglePassword(inputId, iconId) {
                        const input = document.getElementById(inputId);
                        const icon = document.getElementById(iconId);
                        if (input.type === 'password') {
                            input.type = 'text';
                            icon.classList.remove('fa-eye');
                            icon.classList.add('fa-eye-slash');
                        } else {
                            input.type = 'password';
                            icon.classList.remove('fa-eye-slash');
                            icon.classList.add('fa-eye');
                        }
                    }
                </script>

                <div class="flex items-start pt-2">
                    <div class="flex items-center h-5 mt-0.5">
                        <input type="checkbox" required class="w-4 h-4 border border-white/20 rounded bg-white/5 focus:ring-brand-500 text-brand-500">
                    </div>
                    <div class="ml-2 text-sm">
                        <label class="text-gray-300">I agree to the <a href="#" class="text-brand-300 hover:text-white transition">Terms of Service</a> and <a href="#" class="text-brand-300 hover:text-white transition">Privacy Policy</a>.</label>
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-brand-600 to-purple-600 hover:from-brand-500 hover:to-purple-500 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-brand-500/30 transition transform hover:-translate-y-0.5 border border-white/10 mt-6">
                    Create Account
                </button>
            </form>

            <div class="mt-8 text-center border-t border-white/10 pt-6">
                <p class="text-gray-400 text-sm">Already have an account? <a href="{{ route('login') }}" class="text-brand-300 font-semibold hover:text-white transition border-b border-brand-300/30 hover:border-white pb-0.5">Sign In Instead</a></p>
            </div>
            
        </div>
    </div>
</body>
</html>
