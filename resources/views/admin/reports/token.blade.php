@extends('layouts.admin')
@section('content')
<style>
.table-custom th { background:#0f172a; color:#94a3b8; font-weight:600; font-size:0.72rem; text-transform:uppercase; letter-spacing:0.05em; padding:0.75rem 1rem; border-bottom:1px solid #334155; white-space:nowrap; }
.table-custom td { padding:0.85rem 1rem; border-bottom:1px solid #1e293b; color:#e2e8f0; font-size:0.875rem; vertical-align:middle; }
.table-custom tr:hover td { background:rgba(255,255,255,0.03); }
.stat-card { background:#1a222d; border:1px solid #334155; border-radius:0.5rem; padding:1.25rem; }
.table-scroll { overflow-x:auto; -webkit-overflow-scrolling:touch; }
.table-scroll table { min-width:750px; }
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
            <h2 class="text-2xl font-bold text-gray-100">Token Distribution Reports</h2>
            <p class="text-gray-400 text-sm mt-1">All Utility & NEXA 2.0 distributions across the platform.</p>
        </div>
        <span class="text-xs text-gray-500">Generated: {{ now()->format('d M Y, h:i A') }}</span>
    </div>

    {{-- Stats Row --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 mb-6">
        <div class="stat-card border-indigo-900">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">NEXA 1.0</p>
            <p class="text-xl font-bold text-indigo-400">{{ number_format($totalUtility, 2) }}</p>
        </div>
        <div class="stat-card border-yellow-900">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">NEXA 2.0</p>
            <p class="text-xl font-bold text-yellow-400">{{ number_format($totalRenewal, 2) }}</p>
        </div>
        <div class="stat-card">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Total Entries</p>
            <p class="text-xl font-bold text-white">{{ number_format($totalEntries) }}</p>
        </div>
        <div class="stat-card">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Unique Holders</p>
            <p class="text-xl font-bold text-white">{{ $uniqueHolders }}</p>
        </div>
        <div class="stat-card border-green-900">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Active</p>
            <p class="text-xl font-bold text-green-400">{{ $totalCredited }}</p>
        </div>
        <div class="stat-card">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Used/Redeemed</p>
            <p class="text-xl font-bold text-gray-400">{{ $totalUsed }}</p>
        </div>
    </div>

    {{-- Chart --}}
    <div class="stat-card mb-6">
        <h3 class="text-gray-300 font-semibold mb-4 flex items-center gap-2">
            <i class="fa-solid fa-chart-line text-indigo-400"></i> Monthly Token Distribution (Last 6 Months)
        </h3>
        <canvas id="tokenChart" height="80"></canvas>
    </div>

    {{-- Table --}}
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <div class="table-scroll">
            <table class="w-full table-custom">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>User</th>
                        <th>Token Type</th>
                        <th>Tokens</th>
                        <th class="hide-mobile">Value / Token</th>
                        <th class="hide-mobile">Source</th>
                        <th>Status</th>
                        <th class="hide-mobile">Credited On</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tokens as $token)
                    <tr>
                        <td class="text-gray-500 text-xs">{{ $token->id }}</td>
                        <td>
                            <span class="text-gray-300">{{ $token->created_at->format('d M Y') }}</span><br>
                            <span class="text-gray-500 text-xs">{{ $token->created_at->format('h:i A') }}</span>
                        </td>
                        <td>
                            <a href="{{ url('admin/users/'.$token->user_id) }}" class="text-white hover:text-indigo-400 font-medium">
                                {{ $token->user->name ?? 'Unknown' }}
                            </a><br>
                            <span class="text-gray-500 text-xs">{{ $token->user->referral_code ?? '' }}</span>
                        </td>
                        <td>
                            @if($token->token_type === 'utility')
                                <span class="text-xs bg-indigo-900/40 text-indigo-400 border border-indigo-800 px-2 py-1 rounded-full"><i class="fa-solid fa-circle-bolt mr-1"></i>Utility</span>
                            @else
                                <span class="text-xs bg-yellow-900/40 text-yellow-400 border border-yellow-800 px-2 py-1 rounded-full"><i class="fa-solid fa-rotate mr-1"></i>Renewal</span>
                            @endif
                        </td>
                        <td class="font-mono font-bold {{ $token->status === 'credited' ? 'text-green-400' : 'text-gray-400' }}">
                            {{ $token->status === 'credited' ? '+' : '' }}{{ number_format($token->token_count, 4) }}
                        </td>
                        <td class="font-mono text-gray-400 text-sm hide-mobile">
                            {{ $token->token_value ? '₹'.number_format($token->token_value, 4) : '—' }}
                        </td>
                        <td class="text-gray-400 text-sm hide-mobile max-w-[180px] truncate" title="{{ $token->source ?? 'System' }}">
                            {{ $token->source ?? 'Daily Distribution' }}
                        </td>
                        <td>
                            @if($token->status === 'credited')
                                <span class="text-xs bg-green-500/10 text-green-400 border border-green-800 px-2 py-1 rounded-full">Credited</span>
                            @elseif($token->status === 'used')
                                <span class="text-xs bg-gray-500/10 text-gray-400 border border-gray-700 px-2 py-1 rounded-full">Used</span>
                            @else
                                <span class="text-xs bg-yellow-500/10 text-yellow-400 border border-yellow-800 px-2 py-1 rounded-full">{{ ucfirst($token->status) }}</span>
                            @endif
                        </td>
                        <td class="text-gray-400 text-sm hide-mobile">
                            {{ $token->credited_date ? $token->credited_date->format('d M Y') : '—' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-16 text-gray-500">
                            <i class="fa-solid fa-coins text-4xl mb-3 block opacity-20"></i>
                            No token records found yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($tokens->hasPages())
        <div class="p-4 border-t border-[#334155] flex justify-center">
            {{ $tokens->links() }}
        </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
new Chart(document.getElementById('tokenChart'), {
    type: 'bar',
    data: {
        labels: @json($monthlyLabels),
        datasets: [
            {
                label: 'NEXA 1.0',
                data: @json($utilityMonthly),
                backgroundColor: 'rgba(99,102,241,0.3)',
                borderColor: '#818cf8',
                borderWidth: 2,
                borderRadius: 4,
            },
            {
                label: 'NEXA 2.0',
                data: @json($renewalMonthly),
                backgroundColor: 'rgba(245,158,11,0.3)',
                borderColor: '#fbbf24',
                borderWidth: 2,
                borderRadius: 4,
            }
        ]
    },
    options: {
        responsive: true,
        plugins: { legend: { labels: { color: '#94a3b8' } } },
        scales: {
            x: { ticks: { color: '#64748b' }, grid: { color: '#1e293b' } },
            y: { ticks: { color: '#64748b' }, grid: { color: '#1e293b' }, beginAtZero: true }
        }
    }
});
</script>
@endsection