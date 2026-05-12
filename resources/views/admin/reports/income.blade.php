@extends('layouts.admin')
@section('content')
<style>
.table-custom th { background:#0f172a; color:#94a3b8; font-weight:600; font-size:0.72rem; text-transform:uppercase; letter-spacing:0.05em; padding:0.75rem 1rem; border-bottom:1px solid #334155; white-space:nowrap; }
.table-custom td { padding:0.85rem 1rem; border-bottom:1px solid #1e293b; color:#e2e8f0; font-size:0.875rem; vertical-align:middle; }
.table-custom tr:hover td { background:rgba(255,255,255,0.03); }
.stat-card { background:#1a222d; border:1px solid #334155; border-radius:0.5rem; padding:1.25rem; }
.table-scroll { overflow-x:auto; -webkit-overflow-scrolling:touch; }
.table-scroll table { min-width:700px; }
@media(max-width:767px){
  .report-header { flex-direction:column; align-items:flex-start !important; }
  .stat-card { padding:0.875rem; }
  .stat-card p.text-2xl, .stat-card p.text-xl { font-size:1.25rem; }
  canvas { max-height:180px !important; }
  .hide-mobile { display:none !important; }
}
</style>

<div class="tailwind-scope mt-4 max-w-[1400px] mx-auto">

    {{-- Header --}}
    <div class="report-header flex items-center justify-between mb-6 flex-wrap gap-3">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">Income Reports</h2>
            <p class="text-gray-400 text-sm mt-1">Complete view of all Direct & Level commissions distributed on the platform.</p>
        </div>
        <span class="text-xs text-gray-500">Generated: {{ now()->format('d M Y, h:i A') }}</span>
    </div>

    {{-- Stats Row --}}
    <div class="grid grid-cols-2 md:grid-cols-5 gap-3 mb-6">
        <div class="stat-card border-green-900">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Total Distributed</p>
            <p class="text-2xl font-bold text-green-400">${{ number_format($totalIncome, 2) }}</p>
        </div>
        <div class="stat-card border-blue-900">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Direct Income</p>
            <p class="text-2xl font-bold text-blue-400">${{ number_format($directTotal, 2) }}</p>
        </div>
        <div class="stat-card border-purple-900">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Level Income</p>
            <p class="text-2xl font-bold text-purple-400">${{ number_format($levelTotal, 2) }}</p>
        </div>
        <div class="stat-card">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Total Entries</p>
            <p class="text-2xl font-bold text-white">{{ number_format($totalEntries) }}</p>
        </div>
        <div class="stat-card">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Unique Earners</p>
            <p class="text-2xl font-bold text-indigo-400">{{ $uniqueEarners }}</p>
        </div>
    </div>

    {{-- Monthly Chart --}}
    <div class="stat-card mb-6">
        <h3 class="text-gray-300 font-semibold mb-4 flex items-center gap-2">
            <i class="fa-solid fa-chart-line text-green-400"></i> Monthly Income Trend (Last 6 Months)
        </h3>
        <canvas id="incomeChart" height="80"></canvas>
    </div>

    {{-- Table --}}
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <div class="table-scroll">
            <table class="w-full table-custom">
                <thead>
                    <tr>
                        <th>TX ID</th>
                        <th>Date</th>
                        <th>Earner</th>
                        <th class="hide-mobile">From User</th>
                        <th>Type</th>
                        <th class="hide-mobile">Level</th>
                        <th>Amount</th>
                        <th class="hide-mobile">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($commissions as $comm)
                    <tr>
                        <td class="font-mono text-xs text-indigo-400">TX-{{ str_pad($comm->id, 6, '0', STR_PAD_LEFT) }}</td>
                        <td>
                            <span class="text-gray-300">{{ $comm->created_at->format('d M Y') }}</span><br>
                            <span class="text-gray-500 text-xs">{{ $comm->created_at->format('h:i A') }}</span>
                        </td>
                        <td>
                            <a href="{{ url('admin/users/'.$comm->user_id) }}" class="text-white hover:text-indigo-400 font-medium">
                                {{ $comm->user->name ?? 'Unknown' }}
                            </a>
                        </td>
                        <td class="text-gray-400 hide-mobile">{{ $comm->fromUser->name ?? '—' }}</td>
                        <td>
                            @if($comm->commission_type === 'direct')
                                <span class="text-xs bg-blue-900/40 text-blue-400 border border-blue-800 px-2 py-1 rounded-full">Direct</span>
                            @elseif($comm->commission_type === 'level')
                                <span class="text-xs bg-purple-900/40 text-purple-400 border border-purple-800 px-2 py-1 rounded-full">Level</span>
                            @else
                                <span class="text-xs bg-gray-800 text-gray-400 border border-gray-700 px-2 py-1 rounded-full">{{ ucfirst($comm->commission_type) }}</span>
                            @endif
                        </td>
                        <td class="text-center hide-mobile">
                            @if($comm->level)
                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-indigo-600 text-white text-xs font-bold">L{{ $comm->level }}</span>
                            @else
                                <span class="text-gray-600">—</span>
                            @endif
                        </td>
                        <td class="font-bold text-green-400 font-mono">+${{ number_format($comm->amount, 2) }}</td>
                        <td class="hide-mobile">
                            <span class="text-xs bg-green-500/10 text-green-400 border border-green-800 px-2 py-1 rounded-full">
                                {{ ucfirst($comm->status ?? 'credited') }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-16 text-gray-500">
                            <i class="fa-solid fa-money-bill-transfer text-4xl mb-3 block opacity-20"></i>
                            No income records found yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($commissions->hasPages())
        <div class="p-4 border-t border-[#334155] flex justify-center">
            {{ $commissions->links() }}
        </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
new Chart(document.getElementById('incomeChart'), {
    type: 'bar',
    data: {
        labels: @json($monthlyLabels),
        datasets: [{
            label: 'Income Distributed ($)',
            data: @json($monthlyData),
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