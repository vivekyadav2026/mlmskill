@extends('layouts.admin')

@section('content')
<style>
.table-custom th { background:#0f172a; color:#94a3b8; font-weight:600; font-size:0.72rem; text-transform:uppercase; letter-spacing:0.05em; padding:0.75rem 1rem; border-bottom:1px solid #334155; white-space:nowrap; }
.table-custom td { padding:0.85rem 1rem; border-bottom:1px solid #1e293b; color:#e2e8f0; font-size:0.875rem; vertical-align:middle; }
.table-custom tr:hover td { background:rgba(255,255,255,0.03); }
.table-scroll { overflow-x:auto; -webkit-overflow-scrolling:touch; }
.table-scroll table { min-width:650px; }
@media(max-width:767px){
  .report-header { flex-direction:column; align-items:flex-start !important; }
  .hide-mobile { display:none !important; }
}
</style>

<div class="tailwind-scope mt-4 max-w-[1400px] mx-auto">
    <div class="report-header flex items-center justify-between mb-6 flex-wrap gap-3">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">Settlement Reports</h2>
            <p class="text-gray-400 text-sm">Aggregated overview of platform settlements</p>
        </div>
        <div class="flex gap-4">
            <button class="px-4 py-2 bg-[#334155] hover:bg-[#475569] text-white rounded transition" onclick="window.print()"><i class="fa-solid fa-print mr-1"></i> Print Report</button>
            <a href="{{ route('admin.closing.generate') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded shadow transition"><i class="fa-solid fa-plus mr-1"></i> New Closing</a>
        </div>
    </div>

    <!-- Analytics Overview -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-[#1a222d] border border-[#334155] p-5 rounded-xl shadow-lg">
            <h3 class="text-gray-400 font-medium mb-1 text-xs uppercase">Total Months Closed</h3>
            <div class="text-2xl font-bold text-white">{{ count($closings) }}</div>
        </div>
        <div class="bg-[#1a222d] border border-[#334155] p-5 rounded-xl shadow-lg">
            <h3 class="text-gray-400 font-medium mb-1 text-xs uppercase">Lifetime Income</h3>
            <div class="text-2xl font-bold text-green-400">${{ number_format($lifetimeIncome, 2) }}</div>
        </div>
        <div class="bg-[#1a222d] border border-[#334155] p-5 rounded-xl shadow-lg">
            <h3 class="text-gray-400 font-medium mb-1 text-xs uppercase">Lifetime Withdrawals</h3>
            <div class="text-2xl font-bold text-orange-400">${{ number_format($lifetimeWithdrawals, 2) }}</div>
        </div>
        <div class="bg-[#1a222d] border border-[#334155] p-5 rounded-xl shadow-lg">
            <h3 class="text-gray-400 font-medium mb-1 text-xs uppercase">Tokens Distributed</h3>
            <div class="text-2xl font-bold text-purple-400">{{ number_format($lifetimeTokens) }}</div>
        </div>
    </div>
    
    {{-- Chart --}}
    <div class="bg-[#1a222d] border border-[#334155] rounded-xl p-6 shadow-lg mb-8">
        <h3 class="text-gray-300 font-semibold mb-4 flex items-center gap-2">
            <i class="fa-solid fa-chart-line text-blue-400"></i> Net Retention Trend (Last 6 Closings)
        </h3>
        <canvas id="closingChart" height="80"></canvas>
    </div>

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden shadow-lg">
        <div class="table-scroll">
            <table class="w-full table-custom">
            <thead>
                <tr>
                    <th>Reporting Period</th>
                    <th>Gross Income</th>
                    <th>Paid Withdrawals</th>
                    <th>Net Retention</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($closings as $closing)
                @php
                    $netRetention = $closing->total_income_generated - $closing->total_withdrawals;
                @endphp
                <tr class="hover:bg-[#1e293b] transition">
                    <td class="font-bold text-indigo-400 font-mono text-xs">
                        @if(isset($closing->report_json['start_date']) && isset($closing->report_json['end_date']))
                            {{ \Carbon\Carbon::parse($closing->report_json['start_date'])->format('d-m-Y') }} to {{ \Carbon\Carbon::parse($closing->report_json['end_date'])->format('d-m-Y') }}
                        @else
                            {{ date('F Y', mktime(0, 0, 0, $closing->month, 10, $closing->year)) }}
                        @endif
                    </td>
                    <td class="font-medium text-green-400">${{ number_format($closing->total_income_generated, 2) }}</td>
                    <td class="font-medium text-orange-400">${{ number_format($closing->total_withdrawals, 2) }}</td>
                    <td class="font-bold {{ $netRetention >= 0 ? 'text-blue-400' : 'text-red-400' }}">
                        ${{ number_format($netRetention, 2) }}
                    </td>
                    <td>
                        <span class="bg-green-900/50 border border-green-500/50 text-green-400 px-2 py-1 rounded text-xs font-medium"><i class="fa-solid fa-check"></i> Settled</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center p-12 text-gray-500">
                        <i class="fa-solid fa-chart-line text-4xl mb-3 block text-gray-600"></i>
                        No settlement reports available. Generate a closing first.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
new Chart(document.getElementById('closingChart'), {
    type: 'bar',
    data: {
        labels: @json($chartLabels),
        datasets: [
            {
                label: 'Gross Income ($)',
                data: @json($chartIncome),
                backgroundColor: 'rgba(34,197,94,0.3)',
                borderColor: '#22c55e',
                borderWidth: 2,
                borderRadius: 4,
            },
            {
                label: 'Paid Withdrawals ($)',
                data: @json($chartWithdrawals),
                backgroundColor: 'rgba(249,115,22,0.3)',
                borderColor: '#f97316',
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
            y: { ticks: { color: '#64748b', callback: v => '$'+v }, grid: { color: '#1e293b' }, beginAtZero: true }
        }
    }
});
</script>
@endsection