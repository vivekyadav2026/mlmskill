@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-2xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Wallet Adjustments</h2>
        <p class="text-gray-400">Manually add or subtract balances from a user's wallet. All adjustments are logged.</p>
    </div>
    @if(session('success'))
        <div class="bg-green-500/10 border border-green-700 text-green-400 p-4 rounded mb-4">
            <i class="fa-solid fa-circle-check mr-2"></i>{{ session('success') }}
        </div>
    @endif
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6">
        <form method="POST" action="{{ url('admin/wallets/adjustments') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-300 mb-2 text-sm font-medium">Target User</label>
                <select name="user_id" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" required>
                    <option value="">-- Select User --</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->referral_code }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-2 text-sm font-medium">Wallet Type</label>
                <select name="wallet_type" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" required>
                    <option value="income_wallet">Income Wallet</option>
                    <option value="package_wallet">Package Wallet</option>
                    <option value="utility_token_wallet">NEXA 1.0</option>
                    <option value="renewal_token_wallet">NEXA 2.0</option>
                    <option value="nexa_3_wallet">NEXA 3.0</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 mb-2 text-sm font-medium">Amount <span class="text-gray-500">(use negative to subtract)</span></label>
                <input type="number" step="0.01" name="amount" placeholder="e.g. 100 or -50" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-300 mb-2 text-sm font-medium">Reason / Note <span class="text-gray-500">(optional)</span></label>
                <input type="text" name="note" placeholder="e.g. Bonus correction, Refund, etc." class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded">
            </div>
            <button class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded font-bold w-full transition">
                <i class="fa-solid fa-bolt mr-2"></i>Execute Adjustment
            </button>
        </form>
    </div>
    <div class="mt-4 text-center">
        <a href="{{ url('admin/wallets/logs') }}" class="text-indigo-400 hover:text-indigo-300 text-sm">
            <i class="fa-solid fa-list mr-1"></i>View Adjustment Logs →
        </a>
    </div>
</div>
@endsection