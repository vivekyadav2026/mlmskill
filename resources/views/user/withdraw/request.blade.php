@extends('layouts.user')
@section('content')
<div class="tailwind-scope mt-4 max-w-2xl mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Request Withdrawal</h2></div>
    @if(session('success')) <div class="bg-green-500/10 text-green-400 p-4 rounded mb-4">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="bg-red-500/10 text-red-400 p-4 rounded mb-4">{{ session('error') }}</div> @endif
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-8">
        <div class="mb-6 bg-green-900/20 border border-green-500/30 p-4 rounded-lg flex justify-between"><span class="text-gray-300">Withdrawable Balance:</span><span class="text-green-400 font-bold text-xl">${{ number_format($balance, 2) }}</span></div>
        <form action="{{ route('withdraw.submit') }}" method="POST">
            @csrf
            <div class="mb-4"><label class="block text-gray-300 mb-2">Amount ($)</label><input type="number" name="amount" min="10" max="{{ $balance }}" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" required></div>
            <div class="mb-6"><label class="block text-gray-300 mb-2">Payment Method</label><select class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded"><option>USDT (TRC20)</option><option>Bank Transfer</option></select></div>
            <div class="mb-6 border-t border-[#334155] pt-6"><label class="block text-sm font-medium text-gray-300 mb-2"><i class="fa-solid fa-lock text-yellow-500 mr-2"></i>Enter your 4-Digit MPIN *</label><input type="password" name="mpin" required maxlength="4" pattern="\d{4}" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg p-3 text-white text-2xl tracking-[1em] text-center" placeholder="••••"></div>
            <button type="submit" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 rounded"><i class="fa-solid fa-arrow-up-from-bracket mr-2"></i> Submit Request</button>
        </form>
    </div>
</div>
@endsection