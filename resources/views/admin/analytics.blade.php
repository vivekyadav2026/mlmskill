@extends('layouts.admin')

@section('content')
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Deep Analytics Dashboard</h2>
        <p class="text-gray-400 text-sm">Visualizing platform performance and user engagement</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-br from-indigo-900/50 to-[#1a222d] border border-indigo-500/30 p-6 rounded-xl shadow-lg relative overflow-hidden">
            <div class="absolute right-0 top-0 opacity-10 p-4"><i class="fa-solid fa-chart-line text-8xl"></i></div>
            <h3 class="text-gray-400 font-medium mb-1">Monthly Growth</h3>
            <div class="text-3xl font-bold text-white mb-2">+24.5%</div>
            <div class="text-xs text-green-400"><i class="fa-solid fa-arrow-trend-up mr-1"></i> Compared to last month</div>
        </div>
        
        <div class="bg-gradient-to-br from-blue-900/50 to-[#1a222d] border border-blue-500/30 p-6 rounded-xl shadow-lg relative overflow-hidden">
            <div class="absolute right-0 top-0 opacity-10 p-4"><i class="fa-solid fa-users text-8xl"></i></div>
            <h3 class="text-gray-400 font-medium mb-1">Conversion Rate</h3>
            <div class="text-3xl font-bold text-white mb-2">{{ $conversionRate }}%</div>
            <div class="text-xs text-blue-400"><i class="fa-solid fa-bolt mr-1"></i> Visitors to Active Users</div>
        </div>

        <div class="bg-gradient-to-br from-purple-900/50 to-[#1a222d] border border-purple-500/30 p-6 rounded-xl shadow-lg relative overflow-hidden">
            <div class="absolute right-0 top-0 opacity-10 p-4"><i class="fa-solid fa-graduation-cap text-8xl"></i></div>
            <h3 class="text-gray-400 font-medium mb-1">Course Completion</h3>
            <div class="text-3xl font-bold text-white mb-2">0.0%</div>
            <div class="text-xs text-purple-400"><i class="fa-solid fa-check-double mr-1"></i> Global completion rate</div>
        </div>

        <div class="bg-gradient-to-br from-green-900/50 to-[#1a222d] border border-green-500/30 p-6 rounded-xl shadow-lg relative overflow-hidden">
            <div class="absolute right-0 top-0 opacity-10 p-4"><i class="fa-solid fa-wallet text-8xl"></i></div>
            <h3 class="text-gray-400 font-medium mb-1">Avg. Commission</h3>
            <div class="text-3xl font-bold text-white mb-2">${{ number_format($avgCommission, 2) }}</div>
            <div class="text-xs text-green-400"><i class="fa-solid fa-money-bill-wave mr-1"></i> Per active user</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-[#1a222d] border border-[#334155] p-6 rounded-xl shadow-lg relative">
            <h3 class="text-gray-200 font-bold mb-6 flex items-center"><i class="fa-solid fa-chart-area text-indigo-500 mr-2"></i> Revenue & Registration Trends</h3>
            <div class="h-64 relative">
                <canvas id="trendChart"></canvas>
            </div>
        </div>

        <div class="bg-[#1a222d] border border-[#334155] p-6 rounded-xl shadow-lg">
            <h3 class="text-gray-200 font-bold mb-6 flex items-center"><i class="fa-solid fa-chart-pie text-orange-500 mr-2"></i> User Distribution by Package</h3>
            <div class="h-64 relative">
                <canvas id="courseChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Trend Chart (Mixed: Line for Revenue, Bar for Registrations)
    const trendCtx = document.getElementById('trendChart').getContext('2d');
    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($trendLabels) !!},
            datasets: [
                {
                    label: 'Revenue ($)',
                    data: {!! json_encode($revenueData) !!},
                    borderColor: '#6366f1',
                    backgroundColor: '#6366f1',
                    borderWidth: 2,
                    type: 'line',
                    yAxisID: 'y',
                    tension: 0.3
                },
                {
                    label: 'New Users',
                    data: {!! json_encode($registrationData) !!},
                    backgroundColor: 'rgba(16, 185, 129, 0.5)',
                    borderColor: '#10b981',
                    borderWidth: 1,
                    type: 'bar',
                    yAxisID: 'y1'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    grid: { color: '#334155' },
                    ticks: { color: '#94a3b8' }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    grid: { drawOnChartArea: false },
                    ticks: { color: '#94a3b8', stepSize: 1 }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#94a3b8' }
                }
            },
            plugins: {
                legend: { labels: { color: '#e2e8f0' } }
            }
        }
    });

    // Course Distribution Chart
    const courseCtx = document.getElementById('courseChart').getContext('2d');
    new Chart(courseCtx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($courseLabels) !!},
            datasets: [{
                data: {!! json_encode($courseData) !!},
                backgroundColor: ['#6366f1', '#f97316', '#10b981', '#8b5cf6', '#ec4899'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'right', labels: { color: '#e2e8f0', padding: 20 } }
            }
        }
    });
});
</script>
@endsection