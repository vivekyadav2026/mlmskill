@extends('layouts.admin')

@section('content')

<style>
  .app-main { padding: 20px; }
  .stat-card {
      background: #1e293b;
      border: 1px solid #334155;
      border-radius: 0.5rem;
      padding: 1.25rem;
      display: flex;
      align-items: center;
      transition: all 0.3s ease;
  }
  .stat-card:hover {
      border-color: #475569;
      transform: translateY(-2px);
  }
  .stat-icon {
      width: 48px;
      height: 48px;
      border-radius: 0.5rem;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.25rem;
      margin-right: 1rem;
      flex-shrink: 0;
  }
  .table-custom th {
      background: #0f172a;
      color: #94a3b8;
      font-weight: 600;
      font-size: 0.75rem;
      text-transform: uppercase;
      padding: 0.75rem 1rem;
      border-bottom: 1px solid #334155;
  }
  .table-custom td {
      padding: 1rem;
      border-bottom: 1px solid #334155;
      color: #e2e8f0;
      font-size: 0.875rem;
  }
  .table-custom tr:hover {
      background: #1e293b;
  }
</style>

<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">Platform Overview</h2>
            <p class="text-gray-400">Welcome back, Admin. Live operational intelligence.</p>
        </div>
        <div class="flex bg-[#1a222d] rounded-lg p-1 border border-[#334155]">
            <button class="px-4 py-1 text-sm bg-indigo-600 text-white rounded shadow">Today</button>
            <button class="px-4 py-1 text-sm text-gray-400 hover:text-white">7D</button>
            <button class="px-4 py-1 text-sm text-gray-400 hover:text-white">30D</button>
            <button class="px-4 py-1 text-sm text-gray-400 hover:text-white">All</button>
        </div>
    </div>

    <!-- Row 1: Users Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        <div class="stat-card">
            <div class="stat-icon bg-blue-500/10 text-blue-500"><i class="fa-solid fa-users"></i></div>
            <div>
                <p class="text-sm font-medium text-gray-400">Total Users</p>
                <h3 class="text-2xl font-bold text-gray-100">{{ $totalUsers }}</h3>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-green-500/10 text-green-500"><i class="fa-solid fa-user-check"></i></div>
            <div>
                <p class="text-sm font-medium text-gray-400">Active Users</p>
                <h3 class="text-2xl font-bold text-gray-100">{{ $activeUsers }}</h3>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-yellow-500/10 text-yellow-500"><i class="fa-solid fa-user-clock"></i></div>
            <div>
                <p class="text-sm font-medium text-gray-400">Inactive Users</p>
                <h3 class="text-2xl font-bold text-gray-100">{{ $inactiveUsers }}</h3>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-purple-500/10 text-purple-500"><i class="fa-solid fa-box"></i></div>
            <div>
                <p class="text-sm font-medium text-gray-400">Active Packages</p>
                <h3 class="text-2xl font-bold text-gray-100">{{ $activeUsers }}</h3>
            </div>
        </div>
    </div>

    <!-- Row 2: Finance Core Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        <div class="stat-card border-l-4 border-l-green-500">
            <div class="flex-grow">
                <p class="text-sm font-medium text-gray-400">Total Income Dist.</p>
                <h3 class="text-2xl font-bold text-green-400">${{ number_format($totalIncome, 2) }}</h3>
                <p class="text-xs text-gray-500 mt-1">Platform commissions</p>
            </div>
            <div class="stat-icon bg-green-500/10 text-green-500"><i class="fa-solid fa-arrow-down"></i></div>
        </div>
        <div class="stat-card border-l-4 border-l-orange-500">
            <div class="flex-grow">
                <p class="text-sm font-medium text-gray-400">Total Withdrawals</p>
                <h3 class="text-2xl font-bold text-gray-100">${{ number_format($totalWithdrawalsPaid, 2) }}</h3>
                <p class="text-xs text-gray-500 mt-1">Successfully paid out</p>
            </div>
            <div class="stat-icon bg-orange-500/10 text-orange-500"><i class="fa-solid fa-arrow-up"></i></div>
        </div>
        <div class="stat-card border-l-4 border-l-indigo-500">
            <div class="flex-grow">
                <p class="text-sm font-medium text-gray-400">Utility Tokens</p>
                <h3 class="text-2xl font-bold text-gray-100">{{ number_format($totalUtilityTokens, 2) }}</h3>
                <p class="text-xs text-gray-500 mt-1">Distributed globally</p>
            </div>
            <div class="stat-icon bg-indigo-500/10 text-indigo-500"><i class="fa-solid fa-coins"></i></div>
        </div>
        <div class="stat-card border-l-4 border-l-red-500 relative overflow-hidden">
            <div class="flex-grow">
                <p class="text-sm font-medium text-gray-400">Pending Withdrawals</p>
                <h3 class="text-2xl font-bold text-red-400">${{ number_format($pendingWithdrawalsAmount, 2) }}</h3>
                <p class="text-xs text-gray-500 mt-1">{{ $pendingWithdrawalsCount }} requests</p>
            </div>
            <div class="stat-icon bg-red-500/10 text-red-500"><i class="fa-solid fa-clock"></i></div>
            @if($pendingWithdrawalsCount > 0)
                <div class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full animate-ping mt-4 mr-4"></div>
            @endif
        </div>
    </div>

    <!-- Row 3: Income Detail Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
        <div class="bg-[#1a222d] rounded-lg p-4 border border-[#334155] text-center">
            <i class="fa-solid fa-handshake text-indigo-400 mb-2"></i>
            <p class="text-xs text-gray-400 uppercase tracking-wide">Direct Income</p>
            <p class="text-lg font-bold text-gray-100">${{ number_format($directIncomePaid, 2) }}</p>
        </div>
        <div class="bg-[#1a222d] rounded-lg p-4 border border-[#334155] text-center">
            <i class="fa-solid fa-layer-group text-blue-400 mb-2"></i>
            <p class="text-xs text-gray-400 uppercase tracking-wide">Level Income</p>
            <p class="text-lg font-bold text-gray-100">${{ number_format($levelIncomePaid, 2) }}</p>
        </div>
        <div class="bg-[#1a222d] rounded-lg p-4 border border-[#334155] text-center">
            <i class="fa-solid fa-sync text-orange-400 mb-2"></i>
            <p class="text-xs text-gray-400 uppercase tracking-wide">Renewal Tokens</p>
            <p class="text-lg font-bold text-gray-100">{{ number_format($totalRenewalTokens, 2) }}</p>
        </div>
        <div class="bg-[#1a222d] rounded-lg p-4 border border-[#334155] text-center opacity-50">
            <i class="fa-solid fa-money-bill text-green-400 mb-2"></i>
            <p class="text-xs text-gray-400 uppercase tracking-wide">Weekly Salary</p>
            <p class="text-lg font-bold text-gray-100">$0.00</p>
        </div>
        <div class="bg-[#1a222d] rounded-lg p-4 border border-[#334155] text-center opacity-50">
            <i class="fa-solid fa-trophy text-yellow-400 mb-2"></i>
            <p class="text-xs text-gray-400 uppercase tracking-wide">Rank Rewards</p>
            <p class="text-lg font-bold text-gray-100">$0.00</p>
        </div>
        <div class="bg-[#1a222d] rounded-lg p-4 border border-[#334155] text-center">
            <i class="fa-solid fa-shield text-gray-400 mb-2"></i>
            <p class="text-xs text-gray-400 uppercase tracking-wide">Avg Package</p>
            <p class="text-lg font-bold text-gray-100">$300.00</p>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="lg:col-span-2 bg-[#1a222d] rounded-lg border border-[#334155] p-5">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-gray-200 font-medium"><i class="fa-solid fa-chart-line mr-2"></i>User Growth (Last 30 Days)</h3>
            </div>
            <div class="h-64 relative">
                <canvas id="growthChart"></canvas>
            </div>
        </div>
        <div class="bg-[#1a222d] rounded-lg border border-[#334155] p-5">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-gray-200 font-medium"><i class="fa-solid fa-chart-pie mr-2"></i>Income Distribution</h3>
            </div>
            <div class="h-64 relative">
                <canvas id="incomeDistChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Lists Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        
        <!-- Latest Registrations -->
        <div class="bg-[#1a222d] rounded-lg border border-[#334155] overflow-hidden">
            <div class="flex justify-between items-center p-4 border-b border-[#334155]">
                <h3 class="text-gray-200 font-medium"><i class="fa-solid fa-user-plus mr-2 text-indigo-400"></i>Latest Registrations</h3>
                <a href="{{ url('admin/users') }}" class="text-xs text-indigo-400 hover:text-indigo-300">View all</a>
            </div>
            <table class="w-full table-custom">
                <thead><tr><th>User</th><th>Email</th><th>When</th></tr></thead>
                <tbody>
                    @forelse($latestRegistrations as $u)
                    <tr>
                        <td>
                            <div class="font-medium">{{ $u->name }}</div>
                            <div class="text-xs text-gray-500">{{ $u->referral_code }}</div>
                        </td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->created_at->diffForHumans() }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center text-gray-500 py-4">No users found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Latest Activations -->
        <div class="bg-[#1a222d] rounded-lg border border-[#334155] overflow-hidden">
            <div class="flex justify-between items-center p-4 border-b border-[#334155]">
                <h3 class="text-gray-200 font-medium"><i class="fa-solid fa-bolt mr-2 text-green-400"></i>Latest Activations</h3>
                <a href="{{ url('admin/users/active') }}" class="text-xs text-green-400 hover:text-green-300">View all</a>
            </div>
            <table class="w-full table-custom">
                <thead><tr><th>User</th><th>Package</th><th>When</th></tr></thead>
                <tbody>
                    @forelse($latestActivations as $u)
                    <tr>
                        <td>
                            <div class="font-medium">{{ $u->name }}</div>
                        </td>
                        <td><span class="text-xs bg-indigo-900 text-indigo-300 px-2 py-1 rounded">Course $300</span></td>
                        <td>{{ \Carbon\Carbon::parse($u->activation_date)->diffForHumans() }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center text-gray-500 py-4">No activations found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Latest Withdrawals -->
        <div class="bg-[#1a222d] rounded-lg border border-[#334155] overflow-hidden">
            <div class="flex justify-between items-center p-4 border-b border-[#334155]">
                <h3 class="text-gray-200 font-medium"><i class="fa-solid fa-arrow-up-from-bracket mr-2 text-orange-400"></i>Latest Withdrawals</h3>
                <a href="{{ url('admin/withdrawals/pending') }}" class="text-xs text-orange-400 hover:text-orange-300">View all</a>
            </div>
            <table class="w-full table-custom">
                <thead><tr><th>User</th><th>Amount</th><th>Status</th></tr></thead>
                <tbody>
                    @forelse($latestWithdrawals as $w)
                    <tr>
                        <td class="font-medium">{{ $w->user->name ?? 'Unknown' }}</td>
                        <td class="font-bold">${{ number_format($w->amount, 2) }}</td>
                        <td>
                            @if($w->status === 'pending')
                                <span class="text-xs bg-yellow-900 text-yellow-300 px-2 py-1 rounded">Pending</span>
                            @elseif($w->status === 'approved')
                                <span class="text-xs bg-green-900 text-green-300 px-2 py-1 rounded">Approved</span>
                            @else
                                <span class="text-xs bg-red-900 text-red-300 px-2 py-1 rounded">Rejected</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center text-gray-500 py-4">No withdrawals found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions Panel -->
    <div class="bg-[#1a222d] rounded-lg border border-[#334155] p-5 mb-8">
        <h3 class="text-gray-200 font-medium mb-4"><i class="fa-solid fa-bolt mr-2"></i>Quick Actions</h3>
        <div class="flex flex-wrap gap-3">
            <a href="{{ url('admin/withdrawals/pending') }}" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded text-sm transition"><i class="fa-solid fa-check-double mr-1"></i> Approve Withdrawals</a>
            <a href="{{ url('admin/activations/manual') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded text-sm transition"><i class="fa-solid fa-user-check mr-1"></i> Manual Activation</a>
            <a href="{{ url('admin/users') }}" class="px-4 py-2 bg-[#334155] hover:bg-[#475569] text-white rounded text-sm transition"><i class="fa-solid fa-users mr-1"></i> All Users</a>
            <a href="{{ url('admin/settings/plan') }}" class="px-4 py-2 bg-[#334155] hover:bg-[#475569] text-white rounded text-sm transition"><i class="fa-solid fa-gear mr-1"></i> Income Settings</a>
            <a href="{{ url('admin/tokens/manual') }}" class="px-4 py-2 bg-[#334155] hover:bg-[#475569] text-white rounded text-sm transition"><i class="fa-solid fa-coins mr-1"></i> Token Controls</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // User Growth Line Chart
    const growthCtx = document.getElementById('growthChart').getContext('2d');
    new Chart(growthCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($growthLabels) !!},
            datasets: [{
                label: 'New Users',
                data: {!! json_encode($growthData) !!},
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#60a5fa',
                pointRadius: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#334155' },
                    ticks: { color: '#94a3b8', stepSize: 1 }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#94a3b8', maxRotation: 0 }
                }
            }
        }
    });

    // Income Distribution Donut Chart
    const distCtx = document.getElementById('incomeDistChart').getContext('2d');
    new Chart(distCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($distLabels) !!},
            datasets: [{
                data: {!! json_encode($distData) !!},
                backgroundColor: ['#6366f1', '#10b981', '#f59e0b', '#ec4899', '#8b5cf6'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: { position: 'bottom', labels: { color: '#94a3b8', padding: 20 } }
            }
        }
    });
});
</script>
@endsection
