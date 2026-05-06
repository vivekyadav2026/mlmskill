@extends('layouts.user')

@section('content')

<style>
  .app-main { padding: 20px; }
</style>
<div class="tailwind-scope mt-4">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Consolidated Wallet History</h2>
        <p class="text-gray-400">A comprehensive view of all your wallet activities across the platform.</p>
    </div>

    <!-- Overview Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-[#1a222d] rounded-lg p-5 border border-[#334155]">
            <p class="text-sm text-gray-400 mb-1">Income Wallet</p>
            <p class="text-2xl font-bold text-green-400">${{ number_format($user->wallet->income_wallet ?? 0, 2) }}</p>
        </div>
        <div class="bg-[#1a222d] rounded-lg p-5 border border-[#334155]">
            <p class="text-sm text-gray-400 mb-1">Package Wallet</p>
            <p class="text-2xl font-bold text-purple-400">${{ number_format($user->wallet->package_wallet ?? 0, 2) }}</p>
        </div>
        <div class="bg-[#1a222d] rounded-lg p-5 border border-[#334155]">
            <p class="text-sm text-gray-400 mb-1">Utility Tokens</p>
            <p class="text-2xl font-bold text-blue-400">{{ number_format($user->wallet->utility_token_wallet ?? 0, 2) }} UT</p>
        </div>
        <div class="bg-[#1a222d] rounded-lg p-5 border border-[#334155]">
            <p class="text-sm text-gray-400 mb-1">Renewal Tokens</p>
            <p class="text-2xl font-bold text-orange-400">{{ number_format($user->wallet->renewal_token_wallet ?? 0, 2) }} RT</p>
        </div>
    </div>

    <div class="bg-[#1a222d] rounded-lg shadow-lg overflow-hidden border border-[#334155]">
        <div class="p-10 text-center text-gray-500">
            <i class="fa-solid fa-clock-rotate-left text-4xl mb-3"></i>
            <h3 class="text-xl font-bold text-gray-300">Consolidated History Report</h3>
            <p class="mt-2 text-gray-400">Detailed combined ledger functionality is being aggregated and will be available soon.</p>
            <p class="text-sm mt-4">Please visit individual wallets (Income, Utility, Renewal) to view detailed line-item histories.</p>
        </div>
    </div>
</div>
@endsection
