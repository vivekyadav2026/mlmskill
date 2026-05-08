@extends('layouts.user')

@section('content')
<div class="tailwind-scope mt-10 max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('package.upgrade') }}" class="text-indigo-400 hover:text-indigo-300 flex items-center gap-2 mb-4 transition">
            <i class="fa-solid fa-arrow-left"></i> Back to Courses
        </a>
        <h1 class="text-3xl font-extrabold text-white">Checkout</h1>
        <p class="text-gray-400">Complete your payment or request activation from a sponsor.</p>
    </div>

    @if(session('error'))
        <div class="bg-red-900/40 border border-red-500/50 text-red-300 px-4 py-3 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        <!-- Order Summary -->
        <div class="bg-[#1a222d] border border-[#334155] rounded-xl p-6 shadow-xl h-fit">
            <h2 class="text-xl font-bold text-gray-200 mb-4 border-b border-[#334155] pb-2">Order Summary</h2>
            <div class="mb-4">
                <h3 class="text-lg font-bold text-white">{{ $module->name }}</h3>
                <p class="text-gray-400 text-sm">{{ $module->description }}</p>
            </div>
            
            <div class="space-y-3 text-sm border-t border-[#334155] pt-4 mb-4">
                <div class="flex justify-between text-gray-300">
                    <span>Base Course Price</span>
                    <span class="line-through">$600.00</span>
                </div>
                <div class="flex justify-between text-green-400">
                    <span>NGO Sponsorship Discount (50%)</span>
                    <span>-$300.00</span>
                </div>
            </div>
            
            <div class="flex justify-between items-center text-lg font-bold text-white border-t border-[#334155] pt-4">
                <span>Total Final Price</span>
                <span>$300.00</span>
            </div>
        </div>

        <!-- Payment Options -->
        <div class="space-y-6">
            
            <!-- Option 1: Pay from Wallet -->
            <div class="bg-[#1a222d] border border-indigo-500/50 rounded-xl p-6 shadow-xl relative overflow-hidden">
                <div class="absolute top-0 right-0 bg-indigo-600 text-xs font-bold px-3 py-1 rounded-bl-lg">Fastest</div>
                <h2 class="text-lg font-bold text-white mb-2"><i class="fa-solid fa-wallet text-indigo-400 mr-2"></i>Pay from Wallet</h2>
                <p class="text-gray-400 text-sm mb-4">Deduct $300 from your Package Wallet balance to instantly purchase this course and activate your account.</p>
                
                <div class="bg-[#0b1220] rounded-lg p-3 mb-4 flex justify-between items-center border border-[#334155]">
                    <span class="text-gray-400 text-sm">Your Wallet Balance:</span>
                    <span class="{{ $balance >= 300 ? 'text-green-400' : 'text-red-400' }} font-bold text-lg">${{ number_format($balance, 2) }}</span>
                </div>

                @if($balance >= 300)
                    <form action="{{ route('package.purchase') }}" method="POST" onsubmit="return confirm('Deduct $300 from your Package Wallet to purchase this course?');">
                        @csrf
                        <input type="hidden" name="module_id" value="{{ $module->id }}">
                        <button type="submit" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg shadow transition flex justify-center items-center gap-2">
                            <i class="fa-solid fa-check-circle"></i> Pay $300 & Activate
                        </button>
                    </form>
                @else
                    <button disabled class="w-full py-3 bg-gray-800 text-gray-500 font-bold rounded-lg cursor-not-allowed border border-gray-700 flex justify-center items-center gap-2">
                        <i class="fa-solid fa-lock"></i> Insufficient Funds
                    </button>
                    <!-- <div class="text-center mt-3">
                        <a href="{{ route('wallets.index') }}" class="text-indigo-400 hover:text-indigo-300 text-sm underline">Add funds to your wallet</a>
                    </div> -->
                @endifc
            </div>

            <!-- Option 2: Ask Sponsor -->
            <div class="bg-[#1a222d] border border-yellow-500/50 rounded-xl p-6 shadow-xl relative overflow-hidden">
                <h2 class="text-lg font-bold text-white mb-2"><i class="fa-solid fa-users text-yellow-400 mr-2"></i>Ask Sponsor to Pay</h2>
                <p class="text-gray-400 text-sm mb-4">Don't have funds? Share your unique Activation ID with your sponsor or an upline. If they have funds, they can activate your account for you.</p>
                
                <div class="bg-yellow-900/20 border border-yellow-500/30 rounded-lg p-4 text-center">
                    <p class="text-yellow-500/80 text-xs font-bold uppercase mb-2">Your Sponsor Activation ID</p>
                    <div class="text-3xl font-mono text-white tracking-widest bg-[#0b1220] py-2 px-4 rounded inline-block border border-yellow-500/30 shadow-inner">
                        {{ $sponsorId }}
                    </div>
                </div>

                <div class="mt-4 text-center text-sm text-gray-500">
                    <p>Sponsor can go to <span class="text-gray-300">Package / Upgrade > Activate Member</span> to enter this ID.</p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
