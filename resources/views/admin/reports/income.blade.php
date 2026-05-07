@extends('layouts.admin')

@section('content')
<style>
  .table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; }
  .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }
</style>

<div class="tailwind-scope mt-4 max-w-[1400px] mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">Income Reports</h2>
            <p class="text-gray-400 text-sm">Detailed view of all generated commissions</p>
        </div>
        <div class="bg-[#1a222d] border border-[#334155] px-6 py-3 rounded-lg shadow">
            <span class="text-gray-400 text-sm block">Total Platform Payout</span>
            <span class="text-2xl font-bold text-green-400">${{ number_format($totalIncome, 2) }}</span>
        </div>
    </div>

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden shadow-lg">
        <table class="w-full table-custom">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Date</th>
                    <th>Recipient User</th>
                    <th>Source User</th>
                    <th>Commission Type</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @forelse($commissions as $comm)
                <tr class="hover:bg-[#1e293b] transition">
                    <td class="font-mono text-xs text-indigo-400">TX-{{ str_pad($comm->id, 8, '0', STR_PAD_LEFT) }}</td>
                    <td class="text-gray-400">{{ $comm->created_at->format('M d, Y h:i A') }}</td>
                    <td class="font-medium text-gray-200">{{ $comm->user->name ?? 'Unknown' }}</td>
                    <td class="text-gray-400">{{ $comm->fromUser->name ?? 'System' }}</td>
                    <td>
                        @if($comm->type == 'direct')
                            <span class="bg-blue-900/50 text-blue-400 px-2 py-1 rounded text-xs font-medium">Direct Income</span>
                        @elseif($comm->type == 'level')
                            <span class="bg-purple-900/50 text-purple-400 px-2 py-1 rounded text-xs font-medium">Level Income (Lvl {{ $comm->level }})</span>
                        @else
                            <span class="bg-gray-800 text-gray-400 px-2 py-1 rounded text-xs font-medium">{{ ucfirst($comm->type) }}</span>
                        @endif
                    </td>
                    <td class="font-bold text-green-400">+${{ number_format($comm->amount, 2) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center p-12 text-gray-500">
                        <i class="fa-solid fa-money-bill-transfer text-4xl mb-3 block text-gray-600"></i>
                        No income records found yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4 flex justify-end">{{ $commissions->links('pagination::tailwind') }}</div>
</div>
@endsection