@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-2xl mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Wallet Adjustments</h2><p class="text-gray-400">Manually add or subtract balances from a user's wallet.</p></div>
    @if(session('success')) <div class="bg-green-500/10 text-green-400 p-4 rounded mb-4">{{ session('success') }}</div> @endif
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6">
        <form method="POST" action="{{ url('admin/wallets/adjustments') }}">
            @csrf
            <div class="mb-4"><label class="block text-gray-300 mb-2">User</label><select name="user_id" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" required><option value="">-- Select User --</option>@foreach($users as $u)<option value="{{ $u->id }}">{{ $u->name }}</option>@endforeach</select></div>
            <div class="mb-4"><label class="block text-gray-300 mb-2">Wallet Type</label><select name="wallet_type" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" required><option value="income_wallet">Income Wallet</option><option value="package_wallet">Package Wallet</option><option value="utility_token_wallet">Utility Tokens</option><option value="renewal_token_wallet">Renewal Tokens</option></select></div>
            <div class="mb-6"><label class="block text-gray-300 mb-2">Amount (use negative to subtract)</label><input type="number" step="0.01" name="amount" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" required></div>
            <button class="bg-orange-600 text-white px-6 py-2 rounded font-bold w-full">Execute Adjustment</button>
        </form>
    </div>
</div>
@endsection