@extends('layouts.admin')

@section('content')
<style>
  .table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; }
  .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }
</style>

<div class="tailwind-scope mt-4 max-w-[1400px] mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">Financial Reports</h2>
            <p class="text-gray-400 text-sm">Withdrawal payouts and pending liabilities</p>
        </div>
        <div class="flex gap-4">
            <div class="bg-[#1a222d] border border-green-500/30 px-6 py-3 rounded-lg shadow">
                <span class="text-gray-400 text-sm block">Total Paid Out</span>
                <span class="text-2xl font-bold text-green-400">${{ number_format($totalPaid, 2) }}</span>
            </div>
            <div class="bg-[#1a222d] border border-orange-500/30 px-6 py-3 rounded-lg shadow">
                <span class="text-gray-400 text-sm block">Pending Liability</span>
                <span class="text-2xl font-bold text-orange-400">${{ number_format($totalPending, 2) }}</span>
            </div>
        </div>
    </div>

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden shadow-lg">
        <table class="w-full table-custom">
            <thead>
                <tr>
                    <th>Request Date</th>
                    <th>User</th>
                    <th>Payment Method</th>
                    <th>Amount Requested</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($withdrawals as $withdrawal)
                <tr class="hover:bg-[#1e293b] transition">
                    <td class="text-gray-400">{{ $withdrawal->created_at->format('M d, Y') }}</td>
                    <td class="font-medium text-gray-200">{{ $withdrawal->user->name ?? 'Unknown' }}</td>
                    <td class="text-gray-400 text-sm">{{ strtoupper($withdrawal->payment_method) }}</td>
                    <td class="font-bold text-gray-200">${{ number_format($withdrawal->amount, 2) }}</td>
                    <td>
                        @if($withdrawal->status == 'approved')
                            <span class="bg-green-900/50 border border-green-500/50 text-green-400 px-2 py-1 rounded text-xs font-medium"><i class="fa-solid fa-check"></i> Paid</span>
                        @elseif($withdrawal->status == 'pending')
                            <span class="bg-orange-900/50 border border-orange-500/50 text-orange-400 px-2 py-1 rounded text-xs font-medium"><i class="fa-solid fa-clock"></i> Pending</span>
                        @else
                            <span class="bg-red-900/50 border border-red-500/50 text-red-400 px-2 py-1 rounded text-xs font-medium"><i class="fa-solid fa-times"></i> Rejected</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center p-12 text-gray-500">
                        <i class="fa-solid fa-building-columns text-4xl mb-3 block text-gray-600"></i>
                        No financial records found yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4 flex justify-end">{{ $withdrawals->links('pagination::tailwind') }}</div>
</div>
@endsection