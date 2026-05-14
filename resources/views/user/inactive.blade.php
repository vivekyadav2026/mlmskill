@extends('layouts.user')

@section('content')
<div class="tailwind-scope mt-4 max-w-4xl mx-auto">
    
    @if(session('success'))
        <div class="bg-green-900/40 border border-green-500/50 text-green-300 px-4 py-3 rounded-lg mb-4 flex items-center gap-2">
            <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-900/40 border border-red-500/50 text-red-300 px-4 py-3 rounded-lg mb-4">
            {{ session('error') }}
        </div>
    @endif
    @if($errors->any())
        <div class="bg-red-900/40 border border-red-500/50 text-red-300 px-4 py-3 rounded-lg mb-4 text-sm">
            <ul class="list-disc ml-4 space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="flex justify-center items-center min-h-[60vh]">
        <div class="bg-[#1a222d] border border-[#334155] rounded-xl p-8 shadow-lg max-w-lg w-full text-center">
            
            <div class="mb-6">
                <div class="w-20 h-20 bg-indigo-500/20 text-indigo-400 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fa-solid fa-graduation-cap text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-2">Account Inactive</h3>
                <p class="text-gray-400 mb-8 text-md">To unlock your dashboard, referral links, and earnings, you must first purchase a course package to activate your account.</p>
                
                <a href="{{ route('package.upgrade') }}" class="w-full inline-block py-4 px-6 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg transition shadow-lg text-lg flex justify-center items-center gap-2">
                    <i class="fa-solid fa-cart-shopping"></i> View Courses & Activate Now
                </a>
            </div>
            
            <div class="mt-8 pt-6 border-t border-[#334155]">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-gray-400 hover:text-white text-sm transition">
                        <i class="fa-solid fa-arrow-right-from-bracket mr-1"></i> Logout from account
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
