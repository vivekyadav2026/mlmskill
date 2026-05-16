@extends('layouts.admin')
@section('content')
<style>
.table-custom th { background:#0f172a; color:#94a3b8; font-weight:600; font-size:0.72rem; text-transform:uppercase; letter-spacing:0.05em; padding:0.75rem 1rem; border-bottom:1px solid #334155; white-space:nowrap; }
.table-custom td { padding:0.85rem 1rem; border-bottom:1px solid #1e293b; color:#e2e8f0; font-size:0.875rem; vertical-align:middle; }
.table-custom tr:hover td { background:rgba(255,255,255,0.03); }
.stat-card { background:#1a222d; border:1px solid #334155; border-radius:0.5rem; padding:1.25rem; }
.table-scroll { overflow-x:auto; -webkit-overflow-scrolling:touch; }
.table-scroll table { min-width:680px; }
@media(max-width:767px){
  .report-header { flex-direction:column; align-items:flex-start !important; }
  .stat-card { padding:0.875rem; }
  .stat-card p.text-xl { font-size:1.1rem; }
  canvas { max-height:180px !important; }
  .hide-mobile { display:none !important; }
}
</style>

<div class="tailwind-scope mt-4 max-w-[1400px] mx-auto">

    {{-- Header --}}
    <div class="report-header flex items-center justify-between mb-6 flex-wrap gap-3">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">Transaction / Financial Reports</h2>
            <p class="text-gray-400 text-sm mt-1">Complete withdrawal history — approved, pending and rejected transactions.</p>
        </div>
        <div class="flex items-center gap-2">
            <div class="flex gap-2 mr-4">
                <a href="{{ route('admin.reports.financial.excel') }}" class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-600 transition flex items-center gap-2 text-sm shadow-lg shadow-green-900/20">
                    <i class="fa-solid fa-file-excel"></i> Excel
                </a>
                <a href="{{ route('admin.reports.financial.pdf') }}" class="px-4 py-2 bg-red-700 text-white rounded-lg hover:bg-red-600 transition flex items-center gap-2 text-sm shadow-lg shadow-red-900/20">
                    <i class="fa-solid fa-file-pdf"></i> PDF
                </a>
            </div>
            <span class="text-xs text-gray-500 hide-mobile">Generated: {{ now()->format('d M Y, h:i A') }}</span>
        </div>
    </div>

    {{-- Stats Row --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 mb-6">
        <div class="stat-card border-green-900">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Total Paid Out</p>
            <p class="text-xl font-bold text-green-400">${{ number_format($totalPaid, 2) }}</p>
            <p class="text-gray-500 text-xs mt-1">{{ $countApproved }} transactions</p>
        </div>
        <div class="stat-card border-orange-900">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Pending Liability</p>
            <p class="text-xl font-bold text-orange-400">${{ number_format($totalPending, 2) }}</p>
            <p class="text-gray-500 text-xs mt-1">{{ $countPending }} requests</p>
        </div>
        <div class="stat-card border-red-900">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Total Rejected</p>
            <p class="text-xl font-bold text-red-400">${{ number_format($totalRejected, 2) }}</p>
            <p class="text-gray-500 text-xs mt-1">{{ $countRejected }} rejections</p>
        </div>
        <div class="stat-card">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">All Requests</p>
            <p class="text-xl font-bold text-white">{{ $withdrawals->total() }}</p>
        </div>
        <div class="stat-card col-span-2">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-2">Approval Rate</p>
            @php
                $total = $countApproved + $countRejected;
                $rate  = $total > 0 ? round(($countApproved / $total) * 100) : 0;
            @endphp
            <div class="flex items-center gap-3">
                <p class="text-2xl font-bold text-white">{{ $rate }}%</p>
                <div class="flex-1 bg-gray-800 rounded-full h-2">
                    <div class="bg-green-500 h-2 rounded-full" style="width:{{ $rate }}%"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart --}}
    <div class="stat-card mb-6">
        <h3 class="text-gray-300 font-semibold mb-4 flex items-center gap-2">
            <i class="fa-solid fa-chart-line text-green-400"></i> Monthly Withdrawal Payouts (Last 6 Months)
        </h3>
        <canvas id="txChart" height="80"></canvas>
    </div>

    {{-- Table --}}
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <div class="table-scroll">
            <table class="w-full table-custom">
                <thead>
                    <tr>
                        <th>TX ID</th>
                        <th>Date</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th class="hide-mobile">Processed By</th>
                        <th class="hide-mobile">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($withdrawals as $w)
                    <tr>
                        <td class="font-mono text-xs text-indigo-400">WD-{{ str_pad($w->id, 6, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            <span class="text-gray-300">{{ $w->created_at->format('d M Y') }}</span><br>
                            <span class="text-gray-500 text-xs">{{ $w->created_at->format('h:i A') }}</span>
                        </td>
                        <td>
                            <a href="{{ url('admin/users/'.$w->user_id) }}" class="text-white hover:text-indigo-400 font-medium">
                                {{ $w->user->name ?? 'Unknown' }}
                            </a><br>
                            <span class="text-gray-500 text-xs">{{ $w->user->referral_code ?? '' }}</span>
                        </td>
                        <td class="font-mono font-bold text-lg
                            {{ $w->status === 'approved' ? 'text-green-400' : ($w->status === 'rejected' ? 'text-red-400' : 'text-orange-400') }}">
                            ${{ number_format($w->amount, 2) }}
                        </td>
                        <td>
                            @if($w->status === 'approved')
                                <span class="text-xs bg-green-500/10 text-green-400 border border-green-800 px-2 py-1 rounded-full"><i class="fa-solid fa-check mr-1"></i>Paid</span>
                            @elseif($w->status === 'pending')
                                <span class="text-xs bg-orange-500/10 text-orange-400 border border-orange-800 px-2 py-1 rounded-full"><i class="fa-solid fa-clock mr-1"></i>Pending</span>
                            @else
                                <span class="text-xs bg-red-500/10 text-red-400 border border-red-800 px-2 py-1 rounded-full"><i class="fa-solid fa-xmark mr-1"></i>Rejected</span>
                            @endif
                        </td>
                        <td class="text-gray-400 text-sm hide-mobile">
                            {{ $w->approver->name ?? '—' }}
                        </td>
                        <td class="text-gray-500 text-xs hide-mobile max-w-[200px] truncate" title="{{ $w->remarks }}">
                            {{ $w->remarks ?? '—' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-16 text-gray-500">
                            <i class="fa-solid fa-building-columns text-4xl mb-3 block opacity-20"></i>
                            No withdrawal records found yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($withdrawals->hasPages())
        <div class="p-4 border-t border-[#334155] flex justify-center">
            {{ $withdrawals->links() }}
        </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
new Chart(document.getElementById('txChart'), {
    type: 'bar',
    data: {
        labels: @json($monthlyLabels),
        datasets: [{
            label: 'Amount Paid Out ($)',
            data: @json($monthlyPaid),
            backgroundColor: 'rgba(34,197,94,0.2)',
            borderColor: '#22c55e',
            borderWidth: 2,
            borderRadius: 4,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { labels: { color: '#94a3b8' } } },
        scales: {
            x: { ticks: { color: '#64748b' }, grid: { color: '#1e293b' } },
            y: { ticks: { color: '#64748b', callback: v => '$'+v }, grid: { color: '#1e293b' }, beginAtZero: true }
        }
    }
});
</script>
@endsection