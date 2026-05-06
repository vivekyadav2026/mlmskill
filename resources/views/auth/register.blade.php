<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - Samarth Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@500;600;700;800;900&display=swap" rel="stylesheet">
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
<body class="antialiased font-sans bg-gray-50 text-gray-800 flex min-h-screen">

    <!-- Left Panel -->
    <div class="hidden lg:flex lg:w-1/2 bg-brand-900 relative flex-col justify-between p-12 overflow-hidden">
        <!-- Background graphics -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center opacity-20 mix-blend-overlay"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-brand-900 via-brand-900/80 to-transparent"></div>
            <!-- Decorative gradient blobs -->
            <div class="absolute top-0 right-0 -mr-40 -mt-40 w-96 h-96 rounded-full bg-purple-600/30 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -ml-40 -mb-40 w-96 h-96 rounded-full bg-brand-600/30 blur-3xl"></div>
        </div>

        <div class="relative z-10">
            <a href="{{ url('/') }}" class="flex items-center gap-3 inline-flex">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-brand-600 to-purple-600 flex items-center justify-center text-white font-heading font-black text-xl shadow-lg">SD</div>
                <span class="font-heading font-bold text-2xl text-white tracking-tight">Samarth Digital</span>
            </a>
        </div>

        <div class="relative z-10 text-white max-w-lg">
            <h1 class="font-heading text-4xl font-bold mb-6 leading-tight">Start Your Professional Development Journey.</h1>
            <p class="text-gray-300 text-lg leading-relaxed">
                Join our comprehensive learning ecosystem today to acquire industry-relevant skills and earn globally recognized certifications.
            </p>
        </div>
    </div>

    <!-- Right Panel (Form) -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12">
        <div class="w-full max-w-md">
            <!-- Mobile Logo -->
            <div class="lg:hidden flex items-center justify-center gap-3 mb-10">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-brand-600 to-purple-600 flex items-center justify-center text-white font-heading font-black text-xl shadow-lg shadow-brand-500/30">SD</div>
                <span class="font-heading font-bold text-2xl text-brand-900 tracking-tight">Samarth Digital</span>
            </div>

            <div class="text-center mb-10 lg:text-left">
                <h2 class="font-heading text-3xl font-bold text-gray-900 mb-2">Create Account</h2>
                <p class="text-gray-500">Sign up to access premium learning content.</p>
            </div>

            @if($errors->any())
                <div class="bg-red-50 text-red-600 p-4 rounded-lg text-sm mb-6 border border-red-100">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Referral Code (Sponsor ID)</label>
                    <input type="text" name="sponsor_id" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition bg-gray-50 uppercase" required value="{{ request('ref', old('sponsor_id')) }}" placeholder="e.g. SD-XXXXXX">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input type="text" name="name" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition bg-white" required value="{{ old('name') }}" placeholder="John Doe">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" name="email" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition bg-white" required value="{{ old('email') }}" placeholder="you@example.com">
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition bg-white" required placeholder="••••••••">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition bg-white" required placeholder="••••••••">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-brand-600 hover:bg-brand-700 text-white font-bold py-3.5 rounded-lg shadow-md transition transform hover:-translate-y-0.5">
                        Create Account
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center">
                <p class="text-gray-600">Already have an account? <a href="{{ route('login') }}" class="text-brand-600 font-bold hover:text-brand-800 transition">Sign In</a></p>
            </div>
        </div>
    </div>

</body>
</html>
