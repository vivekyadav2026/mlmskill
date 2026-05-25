@extends('layouts.user')

@section('content')

<style>
  .app-main { padding: 20px; }
</style>
<div class="tailwind-scope mt-4">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">NEXA 3.0 Details</h2>
        <p class="text-gray-400">Manage and view your NEXA 3.0 course reward token history.</p>
    </div>

    <!-- Top Row: Balance and Chart -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Balance Card -->
        <div class="bg-teal-900/20 border border-teal-800 rounded-lg p-6 flex flex-col justify-center items-center text-center">
            <div class="w-16 h-16 rounded-full bg-teal-900/50 flex items-center justify-center mb-4">
                <i class="fa-solid fa-graduation-cap text-3xl text-teal-400"></i>
            </div>
            <p class="text-teal-200 text-sm font-medium uppercase tracking-wider mb-1">Total NEXA 3.0 Balance</p>
            <div class="text-4xl font-bold text-white">{{ number_format($balance, 2) }} </div>
            <div class="mt-4 flex gap-3">
                <a href="{{ url('user/token/conversion') }}" class="bg-white text-indigo-800 px-4 py-2 rounded font-medium shadow hover:bg-gray-100 transition">Convert to Package Wallet</a>
            </div>
        </div>

        <!-- Chart Card -->
        <!-- <div class="md:col-span-2 bg-[#1a222d] rounded-lg shadow-lg border border-[#334155] p-6">
            <h3 class="text-gray-300 font-medium mb-4">NEXA 3.0 Earned (Last 30 Days)</h3>
            <div class="h-48 w-full relative">
                <canvas id="tokenChart"></canvas>
            </div>
        </div> -->
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
                        label: 'NEXA 3.0',
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
            <h3 class="text-lg font-bold text-gray-100 mb-4">NEXA 3.0 History</h3>
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
                                NEXA 3.0
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            TOKEN
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold">
                            @if($item->token_count > 0)
                                <span class="text-green-400">+{{ number_format($item->token_count, 2) }}</span>
                            @else
                                <span class="text-red-400">{{ number_format($item->token_count, 2) }}</span>
                            @endif
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
