@extends('layouts.admin')

@section('content')
<style>
  .table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; }
  .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }
</style>

<div class="tailwind-scope mt-4 max-w-[1400px] mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">Token Distribution Reports</h2>
            <p class="text-gray-400 text-sm">Tracking all Utility and Renewal Tokens</p>
        </div>
        <div class="flex gap-4">
            <div class="bg-[#1a222d] border border-indigo-500/30 px-6 py-3 rounded-lg shadow">
                <span class="text-gray-400 text-sm block">Total Utility Tokens</span>
                <span class="text-2xl font-bold text-indigo-400">{{ number_format($totalUtility, 2) }}</span>
            </div>
            <div class="bg-[#1a222d] border border-orange-500/30 px-6 py-3 rounded-lg shadow">
                <span class="text-gray-400 text-sm block">Total Renewal Tokens</span>
                <span class="text-2xl font-bold text-orange-400">{{ number_format($totalRenewal, 2) }}</span>
            </div>
        </div>
    </div>

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden shadow-lg">
        <table class="w-full table-custom">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Recipient User</th>
                    <th>Token Type</th>
                    <th>Amount</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tokens as $token)
                <tr class="hover:bg-[#1e293b] transition">
                    <td class="text-gray-400">{{ $token->created_at->format('M d, Y h:i A') }}</td>
                    <td class="font-medium text-gray-200">{{ $token->user->name ?? 'Unknown' }}</td>
                    <td>
                        @if($token->token_type == 'utility')
                            <span class="bg-indigo-900/50 border border-indigo-500/50 text-indigo-400 px-2 py-1 rounded text-xs font-medium"><i class="fa-solid fa-coins mr-1"></i> Utility</span>
                        @else
                            <span class="bg-orange-900/50 border border-orange-500/50 text-orange-400 px-2 py-1 rounded text-xs font-medium"><i class="fa-solid fa-sync mr-1"></i> Renewal</span>
                        @endif
                    </td>
                    <td class="font-bold {{ $token->status == 'credited' ? 'text-green-400' : 'text-red-400' }}">
                        {{ $token->status == 'credited' ? '+' : '-' }}{{ number_format($token->token_count, 2) }}
                    </td>
                    <td class="text-gray-400 text-sm">{{ $token->source ?? 'System' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center p-12 text-gray-500">
                        <i class="fa-solid fa-coins text-4xl mb-3 block text-gray-600"></i>
                        No token records found yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4 flex justify-end">{{ $tokens->links('pagination::tailwind') }}</div>
</div>
@endsection