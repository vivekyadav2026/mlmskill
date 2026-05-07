@extends('layouts.user')

@section('content')
<div class="tailwind-scope mt-4 max-w-6xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Course Shop</h2>
        <p class="text-gray-400">Purchase courses to activate your account and earn commissions.</p>
    </div>

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

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6 mb-8 flex flex-col sm:flex-row justify-between items-center shadow-lg">
        <div>
            <p class="text-gray-400 text-sm font-semibold uppercase tracking-wider">Available Package Wallet Balance</p>
            <p class="text-3xl font-bold text-purple-400">${{ number_format($balance, 2) }}</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ url('user/token/conversion') }}" class="px-4 py-2 bg-[#0f172a] border border-[#334155] text-indigo-400 hover:text-indigo-300 rounded hover:bg-[#1e293b] transition text-sm font-semibold">
                <i class="fa-solid fa-wallet mr-2"></i> Add Funds via Conversion
            </a>
        </div>
    </div>

    @if($courses->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($courses as $course)
                @php
                    $isPurchased = in_array($course->id, $purchasedCourseIds);
                @endphp
                
                <div class="bg-[#1a222d] border {{ $isPurchased ? 'border-green-500/30' : 'border-[#334155]' }} rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition flex flex-col h-full relative">
                    
                    @if($isPurchased)
                        <div class="absolute top-0 right-0 bg-green-600 text-white text-xs font-bold px-3 py-1 rounded-bl-lg shadow">
                            <i class="fa-solid fa-check mr-1"></i> OWNED
                        </div>
                    @endif

                    <div class="p-6 flex-grow">
                        <div class="w-12 h-12 bg-indigo-500/20 text-indigo-400 rounded-lg flex items-center justify-center mb-4">
                            <i class="fa-solid fa-graduation-cap text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">{{ $course->title }}</h3>
                        <p class="text-gray-400 text-sm mb-4 line-clamp-3">{{ $course->description ?? 'Comprehensive training course module.' }}</p>
                        
                        <div class="mt-auto">
                            <div class="text-3xl font-bold text-white">${{ number_format($course->price, 2) }}</div>
                            <div class="text-xs text-gray-500 mt-1 uppercase font-semibold tracking-wider">Lifetime Access</div>
                        </div>
                    </div>
                    
                    <div class="p-6 pt-0 mt-auto">
                        @if($isPurchased)
                            <a href="{{ route('course.my') }}" class="block w-full py-3 bg-[#0f172a] border border-green-500/30 text-green-400 text-center font-bold rounded-lg transition hover:bg-green-900/20">
                                View Course
                            </a>
                        @else
                            @if($balance >= $course->price)
                                <form action="{{ route('package.purchase') }}" method="POST" onsubmit="return confirm('Deduct ${{ number_format($course->price, 2) }} from your Package Wallet to buy this course?');">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg shadow-lg transition flex justify-center items-center gap-2">
                                        <i class="fa-solid fa-cart-shopping"></i> Purchase Course
                                    </button>
                                </form>
                            @else
                                <button disabled class="w-full py-3 bg-gray-800 text-gray-500 font-bold rounded-lg cursor-not-allowed border border-gray-700">
                                    <i class="fa-solid fa-lock mr-2"></i> Insufficient Funds
                                </button>
                                <p class="text-xs text-red-400 mt-2 text-center">You need ${{ number_format($course->price - $balance, 2) }} more in your wallet.</p>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16 bg-[#1a222d] border border-[#334155] rounded-lg">
            <div class="text-6xl text-gray-700 mb-4"><i class="fa-solid fa-box-open"></i></div>
            <h3 class="text-xl font-bold text-gray-300">No Courses Available</h3>
            <p class="text-gray-500 mt-2">The administrator has not added any courses to the shop yet.</p>
        </div>
    @endif
</div>
@endsection