@extends('layouts.user')

@section('content')

<style>
  .app-main { padding: 20px; }
</style>
<div class="tailwind-scope mt-4">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Package Wallet</h2>
        <p class="text-gray-400">Funds converted from Utility Tokens to be used for Package Upgrades.</p>
    </div>

    <!-- Balance Card -->
    <div class="bg-gradient-to-r from-purple-600 to-purple-900 rounded-lg shadow-lg overflow-hidden border border-purple-500/50 mb-8 max-w-sm">
        <div class="p-6">
            <h3 class="text-purple-100 font-medium text-lg mb-1">Package Balance</h3>
            <div class="text-4xl font-bold text-white">${{ number_format($balance, 2) }}</div>
            <div class="mt-4 flex gap-3">
                <a href="{{ url('user/package/upgrade') }}" class="bg-white text-purple-800 px-4 py-2 rounded font-medium shadow hover:bg-gray-100 transition">Upgrade Package Now</a>
            </div>
        </div>
    </div>

    <!-- History Placeholder -->
    <div class="bg-[#1a222d] rounded-lg shadow-lg overflow-hidden border border-[#334155]">
        <div class="px-6 py-4 border-b border-[#334155] bg-[#161f2d]">
            <h3 class="text-lg font-medium text-gray-200">Recent Package Wallet Activity</h3>
        </div>
        <div class="p-10 text-center text-gray-500">
            <i class="fa-solid fa-box-open text-3xl mb-3"></i>
            <p>No recent activity in your package wallet.</p>
            <p class="text-sm mt-2 text-gray-400">Convert Utility Tokens to add funds here.</p>
        </div>
    </div>
</div>
@endsection
