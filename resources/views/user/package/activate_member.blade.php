@extends('layouts.user')

@section('content')
<div class="tailwind-scope mt-10 max-w-4xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-white">Activate Member</h1>
        <p class="text-gray-400">Use your wallet balance to activate another user's account using their Sponsor Activation ID.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-900/40 border border-green-500/50 text-green-300 px-4 py-3 rounded-lg mb-6 flex items-center gap-2">
            <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-900/40 border border-red-500/50 text-red-300 px-4 py-3 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <div class="md:col-span-2">
            <div class="bg-[#1a222d] border border-[#334155] rounded-xl p-8 shadow-xl">
                <form action="{{ route('package.activate_member.submit') }}" method="POST" onsubmit="return confirm('Are you sure you want to deduct $300 from your package wallet to activate this member?');">
                    @csrf
                    
                    <div class="mb-6">
                        <label class="block text-gray-300 font-bold mb-2">Sponsor Activation ID <span class="text-red-500">*</span></label>
                        <input type="text" name="sponsor_id" placeholder="e.g. USER-00012" class="w-full bg-[#0b1220] text-white border border-[#334155] rounded-lg px-4 py-3 focus:outline-none focus:border-indigo-500 font-mono tracking-wider" required>
                        <p class="text-sm text-gray-500 mt-2"><i class="fa-solid fa-info-circle"></i> Ask the inactive member to share their Activation ID from their checkout page.</p>
                    </div>

                    <div class="mb-8">
                        <label class="block text-gray-300 font-bold mb-2">Select Course Module <span class="text-red-500">*</span></label>
                        <div class="space-y-3">
                            @foreach($modules as $module)
                            <label class="flex items-center gap-3 bg-[#0b1220] border border-[#334155] rounded-lg p-4 cursor-pointer hover:border-indigo-500 transition">
                                <input type="radio" name="module_id" value="{{ $module->id }}" required class="w-5 h-5 text-indigo-600 border-gray-600 bg-gray-700">
                                <div>
                                    <div class="font-bold text-white">{{ $module->name }}</div>
                                    <div class="text-sm text-gray-400">{{ $module->description }}</div>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="border-t border-[#334155] pt-6 flex justify-end">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition flex items-center gap-2 text-lg">
                            <i class="fa-solid fa-bolt"></i> Activate Member for $300
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="md:col-span-1">
            <div class="bg-[#1a222d] border border-indigo-500/30 rounded-xl p-6 shadow-lg mb-6">
                <div class="flex items-center gap-3 mb-4 text-indigo-400">
                    <i class="fa-solid fa-wallet text-2xl"></i>
                    <h3 class="text-lg font-bold text-white">Your Wallet</h3>
                </div>
                
                <p class="text-sm text-gray-400 mb-2">Available Balance</p>
                <div class="text-3xl font-black {{ $balance >= 300 ? 'text-green-400' : 'text-red-400' }}">
                    ${{ number_format($balance, 2) }}
                </div>
                
                @if($balance < 300)
                    <div class="mt-4 bg-red-900/20 border border-red-500/30 text-red-400 p-3 rounded text-sm">
                        <i class="fa-solid fa-triangle-exclamation"></i> You need at least $300 to activate a member.
                    </div>
                @endif
            </div>

            <div class="bg-[#1a222d] border border-[#334155] rounded-xl p-6 shadow-lg">
                <h3 class="font-bold text-white mb-3 border-b border-[#334155] pb-2">How it works</h3>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-1 text-indigo-500 mt-1"></i>
                        <span>Get the Activation ID from the new member.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-2 text-indigo-500 mt-1"></i>
                        <span>Enter the ID and select their preferred course module.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-3 text-indigo-500 mt-1"></i>
                        <span>$300 will be deducted from your Package Wallet.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-4 text-indigo-500 mt-1"></i>
                        <span>The member will be instantly activated and commissions distributed.</span>
                    </li>
                </ul>
            </div>
        </div>
        
    </div>
</div>
@endsection
