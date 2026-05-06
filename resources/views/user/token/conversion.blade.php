@extends('layouts.user')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<style>
  .app-main { padding: 20px; }
</style>
<div class="tailwind-scope mt-4 max-w-3xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Token Conversion</h2>
        <p class="text-gray-400">Convert your Utility Tokens into Package Wallet funds to upgrade your account.</p>
    </div>

    <!-- Balance display -->
    <div class="bg-gradient-to-r from-blue-900 to-indigo-900 rounded-lg p-6 border border-blue-500/50 mb-6 flex justify-between items-center shadow-lg">
        <div>
            <p class="text-blue-200 text-sm font-medium mb-1">Available Utility Tokens</p>
            <h3 class="text-3xl font-bold text-white">{{ number_format($balance, 2) }} UT</h3>
        </div>
        <div class="text-right">
            <p class="text-blue-200 text-sm font-medium mb-1">Conversion Rate</p>
            <h3 class="text-xl font-bold text-white">1 UT = $1.00</h3>
        </div>
    </div>

    <!-- Conversion Form -->
    <div class="bg-[#1a222d] rounded-lg shadow-lg overflow-hidden border border-[#334155]">
        <div class="p-8">
            <form onsubmit="event.preventDefault(); alert('Conversion processed! (Demo)');">
                <div class="mb-6 relative">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Amount to Convert (UT)</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-coins text-gray-500"></i>
                        </div>
                        <input type="number" step="0.01" min="1" max="{{ $balance }}" class="w-full bg-[#0b1220] border border-[#334155] rounded-md py-3 pl-10 pr-3 text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="0.00">
                    </div>
                    <p class="mt-2 text-xs text-gray-500 flex justify-between">
                        <span>Minimum conversion: 1 UT</span>
                        <button type="button" class="text-indigo-400 hover:text-indigo-300 font-medium" onclick="document.querySelector('input[type=number]').value = {{ $balance }}">Convert All</button>
                    </p>
                </div>

                <div class="bg-[#0f172a] border border-[#334155] rounded-lg p-5 mb-8 flex items-center justify-between">
                    <div class="text-gray-400">
                        <i class="fa-solid fa-arrow-right-arrow-left text-2xl mr-3"></i>
                        <span class="font-medium">You will receive:</span>
                    </div>
                    <div class="text-2xl font-bold text-purple-400" id="receiveAmount">$0.00</div>
                </div>

                <div class="border-t border-[#334155] pt-6 flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-md shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors w-full sm:w-auto">
                        <i class="fa-solid fa-exchange-alt mr-2"></i> Convert to Package Wallet
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelector('input[type=number]').addEventListener('input', function(e) {
        let val = parseFloat(e.target.value) || 0;
        document.getElementById('receiveAmount').innerText = '$' + val.toFixed(2);
    });
</script>
@endsection
