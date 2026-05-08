@extends('layouts.user')

@section('content')
<div class="tailwind-scope mt-4 max-w-4xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">P2P Wallet Transfer</h2>
        <p class="text-gray-400">Transfer funds from your Income Wallet to another user's Package Wallet.</p>
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
    @if($errors->any())
        <div class="bg-red-900/40 border border-red-500/50 text-red-300 px-4 py-3 rounded-lg mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Balance Info -->
        <div class="bg-[#1a222d] border border-[#334155] rounded-xl p-6 shadow-lg h-min">
            <div class="text-center">
                <div class="w-16 h-16 bg-green-500/20 text-green-400 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                    <i class="fa-solid fa-wallet"></i>
                </div>
                <h3 class="text-gray-400 font-semibold uppercase tracking-wider text-xs mb-1">Available Income</h3>
                <div class="text-3xl font-bold text-white mb-2">${{ number_format($balance, 2) }}</div>
                <p class="text-xs text-gray-500">Only funds from Income Wallet can be transferred.</p>
            </div>
        </div>

        <!-- Transfer Form -->
        <div class="md:col-span-2 bg-[#1a222d] border border-indigo-500/30 rounded-xl p-8 shadow-xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/10 rounded-bl-full"></div>
            
            <form action="{{ route('wallets.transfer.submit') }}" method="POST" onsubmit="return confirm('Are you sure you want to transfer funds? This action cannot be undone.');">
                @csrf
                <div class="mb-6 relative z-10">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Recipient User ID (Referral Code) *</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-user text-gray-500"></i>
                        </div>
                        <input type="text" name="recipient_id" value="{{ old('recipient_id') }}" required placeholder="e.g. SKS12345" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg pl-10 pr-4 py-3 text-white focus:outline-none focus:border-indigo-500 transition shadow-inner">
                    </div>
                    <p class="text-xs text-gray-500 mt-2">The exact Referral Code of the user you wish to send funds to.</p>
                </div>

                <div class="mb-8 relative z-10">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Amount to Transfer ($) *</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-dollar-sign text-gray-500"></i>
                        </div>
                        <input type="number" name="amount" value="{{ old('amount', 300) }}" min="1" step="0.01" required class="w-full bg-[#0b1220] border border-[#334155] rounded-lg pl-10 pr-4 py-3 text-white text-xl font-bold focus:outline-none focus:border-indigo-500 transition shadow-inner">
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Enter 300 to fully fund a new user's package activation.</p>
                </div>

                <div class="mb-8 relative z-10 border-t border-[#334155] pt-6">
                    <label class="block text-sm font-medium text-gray-300 mb-2"><i class="fa-solid fa-lock text-yellow-500 mr-2"></i>Enter your 4-Digit MPIN to confirm *</label>
                    <input type="password" name="mpin" required maxlength="4" pattern="\d{4}" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-3 text-white text-2xl tracking-[1em] text-center focus:outline-none focus:border-indigo-500 transition shadow-inner" placeholder="••••">
                </div>

                <div class="relative z-10">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-lg shadow-lg transition flex items-center justify-center gap-2 text-lg">
                        <i class="fa-solid fa-paper-plane"></i> Send Funds Now
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
