@extends('layouts.user')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<style>
  .app-main { padding: 20px; }
</style>
<div class="tailwind-scope mt-4 max-w-3xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Token Conversion</h2>
        <p class="text-gray-400">Convert your NEXA 1.0 into Package Wallet funds to upgrade your account.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif
    @if($errors->any())
        <div class="bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded mb-6">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- NEXA 1.0 -->
        <div class="bg-[#1a222d] rounded-lg shadow-lg border border-[#334155] overflow-hidden">
            <div class="bg-gradient-to-r from-blue-900 to-indigo-900 p-6 text-center">
                <p class="text-blue-200 text-sm font-medium mb-1">NEXA 1.0</p>
                <h3 class="text-3xl font-bold text-white mb-2">{{ number_format($balance, 2) }}</h3>
                <p class="text-xs text-blue-300">Rate: 1 NEXA 1.0 = ${{ number_format($utilityValue, 2) }}</p>
            </div>
            <div class="p-6">
                <form action="{{ route('token.conversion.submit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token_type" value="utility">
                    <div class="mb-4">
                        <label class="block text-sm text-gray-300 mb-2">Amount to Convert (Min: 1)</label>
                        <input type="number" name="amount" min="1" max="{{ $balance }}" id="utilityAmount" class="w-full bg-[#0b1220] border border-[#334155] rounded py-2 px-3 text-gray-100" placeholder="1">
                    </div>
                    <div class="text-sm text-gray-400 mb-6 flex justify-between">
                        <span>You will receive:</span>
                        <span class="font-bold text-green-400" id="utilityReceive">$0.00</span>
                    </div>
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition" {{ $balance < 1 ? 'disabled' : '' }}>
                        {{ $balance < 1 ? 'Insufficient Balance' : 'Convert to Package Wallet' }}
                    </button>
                </form>
            </div>
        </div>

        <!-- NEXA 2.0 -->
        <div class="bg-[#1a222d] rounded-lg shadow-lg border border-[#334155] overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-900 to-teal-900 p-6 text-center">
                <p class="text-emerald-200 text-sm font-medium mb-1">NEXA 2.0</p>
                <h3 class="text-3xl font-bold text-white mb-2">{{ number_format($renewalBalance, 2) }}</h3>
                <p class="text-xs text-emerald-300">Rate: 1 NEXA 2.0 = ${{ number_format($renewalValue, 2) }}</p>
            </div>
            <div class="p-6">
                <div class="mb-4 text-center">
                    <p class="text-sm text-gray-300">Account Age: <strong class="text-white">{{ $daysSinceActivation }} Days</strong></p>
                    <p class="text-xs text-gray-500 mt-1">Requires 300 days since activation to convert.</p>
                </div>
                <form action="{{ route('token.conversion.submit') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token_type" value="renewal">
                    <div class="mb-4">
                        <label class="block text-sm text-gray-300 mb-2">Amount to Convert (Min: 1)</label>
                        <input type="number" name="amount" min="1" max="{{ $renewalBalance }}" id="renewalAmount" class="w-full bg-[#0b1220] border border-[#334155] rounded py-2 px-3 text-gray-100" placeholder="1">
                    </div>
                    <div class="text-sm text-gray-400 mb-6 flex justify-between">
                        <span>You will receive:</span>
                        <span class="font-bold text-green-400" id="renewalReceive">$0.00</span>
                    </div>
                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-4 rounded transition" {{ $daysSinceActivation < 300 || $renewalBalance < 1 ? 'disabled' : '' }}>
                        @if($daysSinceActivation < 300)
                            Locked (Need {{ 300 - $daysSinceActivation }} more days)
                        @elseif($renewalBalance < 1)
                            Insufficient Balance
                        @else
                            Convert to Package Wallet
                        @endif
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const utilRate = {{ $utilityValue }};
    const renRate = {{ $renewalValue }};
    
    document.getElementById('utilityAmount').addEventListener('input', function(e) {
        let val = parseFloat(e.target.value) || 0;
        document.getElementById('utilityReceive').innerText = '$' + (val * utilRate).toFixed(2);
    });
    
    document.getElementById('renewalAmount').addEventListener('input', function(e) {
        let val = parseFloat(e.target.value) || 0;
        document.getElementById('renewalReceive').innerText = '$' + (val * renRate).toFixed(2);
    });
</script>
@endsection
