@extends('layouts.admin')
@section('content')
<style>.table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; } .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Master Wallets Ledger</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead><tr><th>User</th><th>Income Wallet</th><th>Package Wallet</th><th>NEXA 1.0</th><th>NEXA 2.0</th></tr></thead>
            <tbody>
                @forelse($wallets as $w)
                <tr>
                    <td class="font-bold">{{ $w->user->name ?? 'Unknown' }}</td>
                    <td class="text-green-400 font-mono">$\{{ number_format($w->income_wallet, 2) }}</td>
                    <td class="text-purple-400 font-mono">$\{{ number_format($w->package_wallet, 2) }}</td>
                    <td class="text-blue-400 font-mono">{{ number_format($w->utility_token_wallet, 2) }} NEXA 1.0</td>
                    <td class="text-orange-400 font-mono">{{ number_format($w->renewal_token_wallet, 2) }} NEXA 2.0</td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center p-8 text-gray-500">No wallets found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[#334155]">{{ $wallets->links() ?? '' }}</div>
    </div>
</div>
@endsection