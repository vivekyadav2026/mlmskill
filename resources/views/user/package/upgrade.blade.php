@extends('layouts.user')
@section('content')
<div class="tailwind-scope mt-4 max-w-4xl mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Upgrade Package</h2><p class="text-gray-400">Activate or upgrade your course package using your Package Wallet.</p></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6 mb-6 flex justify-between items-center">
        <div><p class="text-gray-400 text-sm">Package Wallet Balance</p><p class="text-3xl font-bold text-purple-400">$\{{ number_format($balance, 2) }}</p></div>
        <div><a href="{{ url('user/token/conversion') }}" class="text-indigo-400 hover:underline text-sm"><i class="fa-solid fa-exchange mr-1"></i> Add Funds via Conversion</a></div>
    </div>
    <div class="bg-gradient-to-br from-indigo-900 to-[#1a222d] rounded-lg shadow-lg border border-indigo-500/30 overflow-hidden text-center p-8">
        <h3 class="text-3xl font-bold text-white mb-2">SK Global Masterclass</h3>
        <p class="text-gray-300 mb-6 max-w-lg mx-auto">Unlock your earning potential, full network tracking, and comprehensive skill training.</p>
        <div class="text-5xl font-bold text-white mb-8">$300 <span class="text-lg font-normal text-gray-400">/ lifetime</span></div>
        <form onsubmit="event.preventDefault(); alert('Insufficient Package Wallet balance or already active.');"><button class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-full shadow-lg transition">Activate Account Now</button></form>
    </div>
</div>
@endsection