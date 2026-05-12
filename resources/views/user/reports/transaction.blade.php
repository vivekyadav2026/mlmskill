@extends('layouts.user')

@section('content')
<style>
  .table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; }
  .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; font-size: 0.875rem; }
  .table-custom tr:hover td { background: rgba(255,255,255,0.02); }
  .table-scroll { overflow-x:auto; -webkit-overflow-scrolling:touch; }
  .table-scroll table { min-width:650px; }
</style>

<div class="tailwind-scope mt-4 max-w-[1400px] mx-auto">
    <div class="flex items-center justify-between mb-6 flex-wrap gap-3">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">Withdrawal Transaction Report</h2>
            <p class="text-gray-400 text-sm">Detailed ledger of all your requested payouts.</p>
        </div>
        <button class="px-4 py-2 bg-[#334155] hover:bg-[#475569] text-white rounded transition" onclick="window.print()"><i class="fa-solid fa-print mr-1"></i> Print Report</button>
    </div>

    <!-- Analytics Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
        <div class="bg-[#1a222d] border border-[#334155] p-5 rounded-xl shadow-lg">
            <h3 class="text-gray-400 font-medium mb-1 text-xs uppercase">Total Withdrawn (Approved)</h3>
            <div class="text-2xl font-bold text-green-400">${{ number_format($totalWithdrawn, 2) }}</div>
        </div>
        <div class="bg-[#1a222d] border border-[#334155] p-5 rounded-xl shadow-lg">
            <h3 class="text-gray-400 font-medium mb-1 text-xs uppercase">Pending Withdrawals</h3>
            <div class="text-2xl font-bold text-orange-400">${{ number_format($pendingWithdrawn, 2) }}</div>
        </div>
    </div>

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden shadow-lg">
        <div class="table-scroll">
            <table class="w-full table-custom">
                <thead>
                    <tr>
                        <th class="text-left">Date Requested</th>
                        <th class="text-left">Transaction ID</th>
                        <th class="text-left">Amount</th>
                        <th class="text-left">Admin Fee</th>
                        <th class="text-left">Net Payable</th>
                        <th class="text-left">Method</th>
                        <th class="text-right">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $item)
                    <tr class="transition">
                        <td class="whitespace-nowrap text-gray-400">{{ \Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}<br><span class="text-xs">{{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}</span></td>
                        <td class="text-gray-300 font-mono text-sm">{{ $item->transaction_id ?? 'WD-'.str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td class="font-bold text-gray-100">${{ number_format($item->amount, 2) }}</td>
                        <td class="text-red-400">-${{ number_format($item->admin_fee ?? 0, 2) }}</td>
                        <td class="font-bold text-green-400">${{ number_format($item->net_payable ?? $item->amount, 2) }}</td>
                        <td class="text-gray-300 capitalize">{{ str_replace('_', ' ', $item->payment_method ?? 'crypto') }}</td>
                        <td class="text-right">
                            @if($item->status == 'approved')
                                <span class="bg-green-900/50 text-green-400 border border-green-500/30 px-2 py-1 rounded text-xs uppercase"><i class="fa-solid fa-check mr-1"></i> Approved</span>
                            @elseif($item->status == 'pending')
                                <span class="bg-orange-900/50 text-orange-400 border border-orange-500/30 px-2 py-1 rounded text-xs uppercase"><i class="fa-solid fa-clock mr-1"></i> Pending</span>
                            @elseif($item->status == 'rejected')
                                <span class="bg-red-900/50 text-red-400 border border-red-500/30 px-2 py-1 rounded text-xs uppercase"><i class="fa-solid fa-xmark mr-1"></i> Rejected</span>
                            @else
                                <span class="bg-gray-800 text-gray-300 border border-gray-600 px-2 py-1 rounded text-xs uppercase">{{ $item->status }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center p-12 text-gray-500">
                            <i class="fa-solid fa-money-bill-transfer text-4xl mb-3 block text-gray-600"></i>
                            No withdrawal transactions found yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($reports->hasPages())
        <div class="px-6 py-4 border-t border-[#334155]">
            {{ $reports->links() }}
        </div>
        @endif
    </div>
</div>
@endsection