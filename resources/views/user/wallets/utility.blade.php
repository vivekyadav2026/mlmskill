@extends('layouts.user')

@section('content')

<style>
  .app-main { padding: 20px; }
</style>
<div class="tailwind-scope mt-4">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">NEXA 1.0 Wallet</h2>
        <p class="text-gray-400">Daily tokens credited for utility use and conversion.</p>
    </div>

    <!-- Top Row: Balance and Chart -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Balance Card -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-900 rounded-lg shadow-lg overflow-hidden border border-indigo-500/50 flex flex-col justify-center p-6">
            <h3 class="text-indigo-100 font-medium text-lg mb-1">Available Tokens</h3>
            <div class="text-4xl font-bold text-white">{{ number_format($balance, 2) }} {{ strtoupper($tokenName) }}</div>
            <div class="mt-4 flex gap-3">
                <a href="{{ url('user/token/conversion') }}" class="bg-white text-indigo-800 px-4 py-2 rounded font-medium shadow hover:bg-gray-100 transition">Convert to Package Wallet</a>
            </div>
        </div>

        <!-- Chart Card -->
        <div class="md:col-span-2 bg-[#1a222d] rounded-lg shadow-lg border border-[#334155] p-6">
            <h3 class="text-gray-300 font-medium mb-4">NEXA 1.0s Earned (Last 30 Days)</h3>
            <div class="h-48 w-full relative">
                <canvas id="tokenChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartData = @json($chartData);
            const labels = chartData.map(item => item.date);
            const dataPoints = chartData.map(item => item.total);

            const ctx = document.getElementById('tokenChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'NEXA 1.0s',
                        data: dataPoints,
                        borderColor: '#60a5fa',
                        backgroundColor: 'rgba(96, 165, 250, 0.2)',
                        borderWidth: 2,
                        pointBackgroundColor: '#3b82f6',
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { beginAtZero: true, ticks: { color: '#9ca3af', stepSize: 1 }, grid: { color: '#334155' } },
                        x: { ticks: { color: '#9ca3af' }, grid: { display: false } }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        });
    </script>

    <!-- History Table -->
    <div class="bg-[#1a222d] rounded-lg shadow-lg overflow-hidden border border-[#334155]">
        <div class="px-6 py-4 border-b border-[#334155] bg-[#161f2d]">
            <h3 class="text-lg font-medium text-gray-200">Token History</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#334155]">
                <thead class="bg-[#14172a]">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#334155]">
                    @forelse($history as $item)
                    <tr class="hover:bg-[#1f2937] transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ \Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                NEXA 1.0
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            Daily ROI Distribution
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-blue-400">
                            +{{ number_format($item->token_count, 2) }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                            <i class="fa-solid fa-coins text-3xl mb-3"></i>
                            <p>No token history found.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-3 border-t border-[#334155]">
            {{ $history->links() }}
        </div>
    </div>
</div>
@endsection
