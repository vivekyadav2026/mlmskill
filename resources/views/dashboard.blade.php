@extends('layouts.user')

@section('content')

<style>
  .app-main { padding: 20px; }
  .stat-card { background: #1e293b; border: 1px solid #334155; border-radius: 0.5rem; padding: 1.25rem; display: flex; align-items: center; transition: all 0.3s ease; }
  .stat-card:hover { border-color: #475569; transform: translateY(-2px); }
  .stat-icon { width: 48px; height: 48px; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; margin-right: 1rem; flex-shrink: 0; }
  .table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; }
  .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; font-size: 0.875rem; }
  .table-custom tr:hover { background: #1e293b; }
</style>

<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <!-- Header Block -->
    <div class="bg-[#1a222d] rounded-lg border border-[#334155] p-6 mb-6 flex flex-col md:flex-row justify-between items-start md:items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-100 flex items-center">Welcome {{ $user->name }} <span class="ml-2">👋</span></h2>
            <div class="flex items-center mt-2 gap-2 text-sm flex-wrap">
                <span class="bg-gray-800 text-gray-300 border border-gray-600 px-2 py-1 rounded font-mono flex items-center gap-2" title="Your ID">
                    <i class="fa-solid fa-id-badge"></i> {{ $user->referral_code }}
                    <button onclick="navigator.clipboard.writeText('{{ $user->referral_code }}'); alert('ID copied!');" class="text-gray-400 hover:text-white transition" title="Copy ID"><i class="fa-solid fa-copy"></i></button>
                </span>
                @if($user->status === 'active')
                    <span class="bg-green-900 text-green-300 border border-green-700 px-2 py-1 rounded"><i class="fa-solid fa-bolt mr-1"></i> Active</span>
                    <span class="border px-2 py-1 rounded flex items-center gap-1" style="background-color: {{ $currentRank['current_color'] }}22; color: {{ $currentRank['current_color'] }}; border-color: {{ $currentRank['current_color'] }}44;">
                        <i class="fa-solid fa-trophy text-xs"></i> 
                        <span class="font-bold">{{ $currentRank['current_rank'] }}</span>
                    </span>
                @else
                    <span class="bg-red-900 text-red-300 border border-red-700 px-2 py-1 rounded"><i class="fa-solid fa-lock mr-1"></i> Inactive</span>
                @endif
                <span class="bg-blue-900 text-blue-300 border border-blue-700 px-2 py-1 rounded"><i class="fa-solid fa-users mr-1"></i> {{ $directCount }} in Network</span>
            </div>
        </div>
        <div class="mt-4 md:mt-0 flex gap-2">
            <a href="{{ url('user/package/upgrade') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded font-medium shadow transition"><i class="fa-solid fa-box mr-1"></i> Buy Package</a>
            <a href="{{ url('user/withdraw/request') }}" class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded font-medium shadow transition"><i class="fa-solid fa-arrow-up-from-bracket mr-1"></i> Withdraw</a>
        </div>
    </div>

    <!-- Announcements -->
    @if($announcements->count() > 0)
    <div class="mb-6 space-y-3">
        @foreach($announcements as $ann)
            @php
                $annColor = 'blue';
                if($ann->type == 'warning') $annColor = 'orange';
                if($ann->type == 'success') $annColor = 'green';
                if($ann->type == 'danger') $annColor = 'red';
            @endphp
            <div class="bg-{{ $annColor }}-900/30 border-l-4 border-{{ $annColor }}-500 p-4 rounded-r-lg flex items-start shadow-sm">
                <div class="flex-shrink-0 mr-3 mt-0.5">
                    <i class="fa-solid fa-bullhorn text-{{ $annColor }}-400 text-lg"></i>
                </div>
                <div>
                    <h4 class="text-{{ $annColor }}-300 font-bold text-sm">{{ $ann->title }}</h4>
                    <p class="text-gray-300 text-sm mt-1">{{ $ann->content }}</p>
                </div>
            </div>
        @endforeach
    </div>
    @endif

    <!-- Banners (Basic Grid for now) -->
    @if($banners->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-{{ min(3, $banners->count()) }} gap-4 mb-6">
        @foreach($banners as $banner)
            <div class="rounded-lg overflow-hidden border border-[#334155] shadow-lg group relative h-40">
                @if($banner->link_url)
                    <a href="{{ $banner->link_url }}" target="_blank" class="block w-full h-full">
                @endif
                
                <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}" class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/90 to-transparent p-3 pt-8">
                    <h4 class="text-white font-bold text-sm drop-shadow-md">{{ $banner->title }}</h4>
                </div>

                @if($banner->link_url)
                    </a>
                @endif
            </div>
        @endforeach
    </div>
    @endif

    <!-- Referral Link Bar -->
    <div class="bg-[#1a222d] rounded-lg border border-[#334155] p-3 mb-6 flex flex-col md:flex-row items-center gap-3">
        <div class="flex items-center w-full md:w-auto">
            <i class="fa-solid fa-link text-gray-400 mr-2"></i>
            <span class="text-gray-400 text-sm whitespace-nowrap">Referral Link</span>
        </div>
        <div class="flex items-center w-full md:flex-grow gap-2">
            <input type="text" readonly value="{{ url('register?ref=' . $user->referral_code) }}" class="w-full min-w-0 bg-[#0b1220] border border-[#334155] rounded px-3 py-1.5 text-gray-300 font-mono text-sm focus:outline-none text-ellipsis">
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-1.5 rounded transition shadow flex-shrink-0" onclick="navigator.clipboard.writeText('{{ url('register?ref=' . $user->referral_code) }}'); alert('Copied!');"><i class="fa-solid fa-copy"></i></button>
        </div>
    </div>

    <!-- 4 Stat Cards Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="stat-card border-l-4 border-l-green-500">
            <div class="stat-icon bg-green-500/10 text-green-500"><i class="fa-solid fa-wallet"></i></div>
            <div class="flex-grow">
                <p class="text-sm font-medium text-gray-400">Income Wallet</p>
                <h3 class="text-2xl font-bold text-gray-100">${{ number_format($wallet->income_wallet ?? 0, 2) }}</h3>
            </div>
        </div>
        <div class="stat-card border-l-4 border-l-purple-500">
            <div class="stat-icon bg-purple-500/10 text-purple-500"><i class="fa-solid fa-box"></i></div>
            <div class="flex-grow">
                <p class="text-sm font-medium text-gray-400">Package Wallet</p>
                <h3 class="text-2xl font-bold text-gray-100">${{ number_format($wallet->package_wallet ?? 0, 2) }}</h3>
            </div>
        </div>
        <div class="stat-card border-l-4 border-l-blue-500">
            <div class="stat-icon bg-blue-500/10 text-blue-500"><i class="fa-solid fa-coins"></i></div>
            <div class="flex-grow">
                <p class="text-sm font-medium text-gray-400">Utility Tokens</p>
                <h3 class="text-2xl font-bold text-gray-100">{{ number_format($wallet->utility_token_wallet ?? 0, 2) }} {{ strtoupper($tokenName) }}</h3>
            </div>
        </div>
        <div class="stat-card border-l-4 border-l-indigo-500">
            <div class="stat-icon bg-indigo-500/10 text-indigo-500"><i class="fa-solid fa-chart-line"></i></div>
            <div class="flex-grow">
                <p class="text-sm font-medium text-gray-400">Total Earned</p>
                <h3 class="text-2xl font-bold text-gray-100">${{ number_format($totalEarned, 2) }}</h3>
            </div>
        </div>
    </div>

    <!-- Usage & Network Snapshot Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- <div class="bg-[#1a222d] rounded-lg border border-[#334155] p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-gray-200 font-medium"><i class="fa-solid fa-shield mr-2 text-yellow-500"></i>Renewal Progress</h3>
                <span class="text-xs font-bold bg-cyan-900 text-cyan-300 px-2 py-1 rounded">Target: ${{ $renewalTarget }}</span>
            </div>
            @php $renewPct = min(100, (($wallet->renewal_token_wallet ?? 0) / max(1, $renewalTarget)) * 100); @endphp
            <div class="w-full bg-gray-900 rounded-full h-2 mb-2 border border-[#334155]">
                <div class="bg-cyan-500 h-2 rounded-full" style="width: {{ $renewPct }}%"></div>
            </div>
            <div class="flex justify-between text-sm mt-4 border-t border-[#334155] pt-4">
                <div><p class="text-gray-500">Current Saved</p><p class="text-green-400 font-bold">${{ number_format($wallet->renewal_token_wallet ?? 0, 2) }}</p></div>
                <div class="text-right"><p class="text-gray-500">Remaining to Renew</p><p class="text-gray-200 font-bold">${{ number_format(max(0, $renewalTarget - ($wallet->renewal_token_wallet ?? 0)), 2) }}</p></div>
            </div>
        </div> -->

        <div class="bg-[#1a222d] rounded-lg border border-[#334155] p-6">
            <h3 class="text-gray-200 font-medium mb-4"><i class="fa-solid fa-users mr-2 text-blue-400"></i>Network Snapshot</h3>
            <div class="grid grid-cols-3 gap-2">
                <div class="bg-[#0b1220] border border-[#334155] rounded p-3 text-center">
                    <p class="text-xs text-gray-500 uppercase">Direct</p>
                    <p class="text-xl font-bold text-gray-100">{{ $directCount }}</p>
                </div>
                <div class="bg-[#0b1220] border border-[#334155] rounded p-3 text-center">
                    <p class="text-xs text-gray-500 uppercase">Total Network</p>
                    <p class="text-xl font-bold text-gray-100">{{ $networkCount + $directCount }}</p>
                </div>
                <div class="bg-[#0b1220] border border-[#334155] rounded p-3 text-center">
                    <p class="text-xs text-gray-500 uppercase">Active Status</p>
                    <p class="text-lg font-bold {{ $user->status === 'active' ? 'text-green-400' : 'text-red-400' }} mt-1 capitalize">{{ $user->status }}</p>
                </div>
            </div>
        </div>

        <div class="bg-[#1a222d] rounded-lg border border-[#334155] p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-gray-200 font-medium"><i class="fa-solid fa-medal mr-2 text-indigo-400"></i>Rank Progression</h3>
                @if($currentRank['next_rank'])
                    <span class="text-xs font-bold text-gray-400">Next: <span class="text-indigo-400">{{ $currentRank['next_rank'] }}</span></span>
                @else
                    <span class="text-xs font-bold text-yellow-500"><i class="fa-solid fa-crown"></i> Max Rank</span>
                @endif
            </div>

            @if($currentRank['next_rank'])
                <div class="w-full bg-gray-900 rounded-full h-2 mb-2 border border-[#334155]">
                    <div class="h-2 rounded-full" style="width: {{ $currentRank['progress_pct'] }}%; background-color: {{ $currentRank['current_color'] }}"></div>
                </div>
                <div class="flex justify-between text-xs mt-4 border-t border-[#334155] pt-4">
                    <div>
                        <p class="text-gray-500">Directs</p>
                        <p class="text-gray-200 font-bold">{{ $currentRank['direct_count'] }} / {{ $currentRank['next_directs'] }}</p>
                    </div>
                    @if($currentRank['next_team'] > 0)
                    <div class="text-right">
                        <p class="text-gray-500">Team Size</p>
                        <p class="text-gray-200 font-bold">{{ $currentRank['team_size'] }} / {{ $currentRank['next_team'] }}</p>
                    </div>
                    @endif
                </div>
            @else
                <div class="py-4 text-center">
                    <i class="fa-solid fa-medal text-yellow-500 text-4xl mb-2"></i>
                    <p class="text-gray-400 text-sm">You have achieved the highest rank!</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Bonus Tracking Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Reward Income Progress -->
        <div class="bg-[#1a222d] rounded-lg border border-[#334155] p-6 shadow-lg">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-gray-200 font-medium"><i class="fa-solid fa-trophy mr-2 text-yellow-500"></i>Next Reward Milestone</h3>
                @if($rewardProgress)
                <span class="text-xs font-bold bg-green-900 text-green-300 px-2 py-1 rounded">Reward: ${{ number_format($rewardProgress['reward'], 0) }}</span>
                @else
                <span class="text-xs font-bold bg-yellow-900 text-yellow-300 px-2 py-1 rounded">Max Level</span>
                @endif
            </div>
            
            @if($rewardProgress)
            <div class="w-full bg-gray-900 rounded-full h-2 mb-2 border border-[#334155]">
                <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ $rewardProgress['percent'] }}%"></div>
            </div>
            <div class="flex justify-between text-sm mt-4 border-t border-[#334155] pt-4">
                <div><p class="text-gray-500">Current Team</p><p class="text-green-400 font-bold">{{ $rewardProgress['current'] }} members</p></div>
                <div class="text-right"><p class="text-gray-500">Target Team Size</p><p class="text-gray-200 font-bold">{{ $rewardProgress['target'] }} members</p></div>
            </div>
            @else
            <div class="py-4 text-center">
                <i class="fa-solid fa-crown text-yellow-500 text-4xl mb-2"></i>
                <p class="text-gray-400 text-sm">Congratulations! You have unlocked all Team Size Reward Milestones.</p>
            </div>
            @endif
        </div>

        <!-- Salary Bonus Status -->
        <div class="bg-[#1a222d] rounded-lg border border-[#334155] p-6 shadow-lg">
            <h3 class="text-gray-200 font-medium mb-4"><i class="fa-solid fa-money-check-dollar mr-2 text-green-400"></i>Monthly Salary Status</h3>
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="bg-[#0b1220] border border-[#334155] rounded p-3 text-center">
                    <p class="text-xs text-gray-500 uppercase">Active Salary Tier</p>
                    @if($salaryStatus['active_amount'] > 0)
                        <p class="text-xl font-bold text-green-400">${{ number_format($salaryStatus['active_amount'], 0) }} /mo</p>
                    @else
                        <p class="text-xl font-bold text-gray-500">None</p>
                    @endif
                </div>
                <div class="bg-[#0b1220] border border-[#334155] rounded p-3 text-center">
                    <p class="text-xs text-gray-500 uppercase">Next Tier (${{ number_format($salaryStatus['next_amount'], 0) }})</p>
                    <p class="text-lg font-bold text-gray-100 mt-1">{{ $salaryStatus['current_directs'] }} / {{ $salaryStatus['next_tier'] }} Directs</p>
                </div>
            </div>
            
            @if($salaryStatus['next_tier'] > 0)
            @php $salPct = min(100, ($salaryStatus['current_directs'] / $salaryStatus['next_tier']) * 100); @endphp
            <div class="w-full bg-gray-900 rounded-full h-1.5 mb-1 border border-[#334155]">
                <div class="bg-green-500 h-1.5 rounded-full" style="width: {{ $salPct }}%"></div>
            </div>
            <p class="text-xs text-gray-500 text-right">Need {{ $salaryStatus['next_tier'] - $salaryStatus['current_directs'] }} more directs for upgrade</p>
            @endif
        </div>
    </div>

    <!-- Live Market Tracker (Stock Graph) -->
    <!-- <div class="mb-6 bg-[#1a222d] rounded-lg border border-[#334155] p-5 shadow-lg relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-green-500/5 rounded-full blur-3xl -mr-10 -mt-10 pointer-events-none"></div>
        <div class="flex justify-between items-center mb-4 relative z-10">
            <h3 class="text-gray-200 font-medium"><i class="fa-solid fa-arrow-trend-up mr-2 text-green-400"></i>Live Token Market ({{ strtoupper($tokenName) }}/USD)</h3>
            <span class="text-xs font-bold bg-green-900 text-green-300 border border-green-700 px-2 py-1 rounded animate-pulse">
                <i class="fa-solid fa-circle text-[8px] mr-1"></i> Live Market
            </span>
        </div>
        <div class="flex items-end gap-3 mb-2 relative z-10">
            <h1 class="text-3xl font-bold text-white font-mono" id="currentStockPrice">${{ number_format($tokenPrice, 4) }}</h1>
            <span class="text-green-400 text-sm font-semibold mb-1 bg-green-900/30 px-2 py-0.5 rounded" id="todayChangeBadge"><i class="fa-solid fa-caret-up mr-1"></i>+0.0% Today</span>
        </div>
        <div class="h-64 rounded flex items-center justify-center text-gray-500 relative z-10">
            <canvas id="stockChart"></canvas>
        </div>
    </div> -->

    <!-- Main Trend Chart Row -->
    <!-- <div class="mb-6 bg-[#1a222d] rounded-lg border border-[#334155] p-5 shadow-lg">
        <h3 class="text-gray-200 font-medium mb-4"><i class="fa-solid fa-chart-line mr-2 text-indigo-400"></i>Overall Financial Growth (Last 7 Days)</h3>
        <div class="h-72 rounded flex items-center justify-center text-gray-500 relative">
            <canvas id="earningsChart"></canvas>
        </div>
    </div> -->

    <!-- Breakdown Charts Row -->
    <!-- <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <div class="bg-[#1a222d] rounded-lg border border-[#334155] p-5 shadow-lg">
            <h3 class="text-gray-200 font-medium mb-4"><i class="fa-solid fa-chart-pie mr-2 text-purple-400"></i>Income Breakdown</h3>
            <div class="h-64 rounded flex items-center justify-center text-gray-500 relative">
                <canvas id="breakdownChart"></canvas>
            </div>
        </div>
        <div class="bg-[#1a222d] rounded-lg border border-[#334155] p-5 shadow-lg">
            <h3 class="text-gray-200 font-medium mb-4"><i class="fa-solid fa-wallet mr-2 text-green-400"></i>Current Asset Distribution</h3>
            <div class="h-64 rounded flex items-center justify-center text-gray-500 relative">
                <canvas id="assetChart"></canvas>
            </div>
        </div>
    </div> -->

    <!-- 4 Tables Grid Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Recent Income -->
        <div class="bg-[#1a222d] rounded-lg border border-[#334155] overflow-hidden">
            <div class="flex justify-between items-center p-4 border-b border-[#334155]">
                <h3 class="text-gray-200 font-medium"><i class="fa-solid fa-money-bill-wave mr-2 text-green-400"></i>Recent Income</h3>
                <a href="{{ url('user/wallets/income') }}" class="text-xs text-indigo-400 hover:text-indigo-300">View all</a>
            </div>
            <table class="w-full table-custom">
                <thead><tr><th>Type</th><th>Amount</th><th>When</th></tr></thead>
                <tbody>
                    @forelse($recentIncome as $inc)
                    <tr>
                        <td><span class="text-xs bg-gray-800 border border-gray-600 px-2 py-1 rounded uppercase">{{ $inc->commission_type }}</span></td>
                        <td class="font-bold text-green-400">+${{ number_format($inc->amount, 2) }}</td>
                        <td>{{ \Carbon\Carbon::parse($inc->created_at)->format('Y-m-d H:i') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center text-gray-500 py-4">No recent income</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Recent Referrals -->
        <div class="bg-[#1a222d] rounded-lg border border-[#334155] overflow-hidden">
            <div class="flex justify-between items-center p-4 border-b border-[#334155]">
                <h3 class="text-gray-200 font-medium"><i class="fa-solid fa-user-plus mr-2 text-blue-400"></i>Recent Referrals</h3>
                <a href="{{ url('user/network/direct') }}" class="text-xs text-indigo-400 hover:text-indigo-300">View all</a>
            </div>
            <table class="w-full table-custom">
                <thead><tr><th>User</th><th>Status</th><th>Joined</th></tr></thead>
                <tbody>
                    @forelse($recentReferrals as $ref)
                    <tr>
                        <td>
                            <div class="font-medium">{{ $ref->name }}</div>
                            <div class="text-xs text-gray-500">{{ $ref->referral_code }}</div>
                        </td>
                        <td>
                            @if($ref->status === 'active') <span class="text-xs bg-green-900 text-green-300 px-2 py-1 rounded">Active</span> @else <span class="text-xs bg-gray-800 text-gray-400 px-2 py-1 rounded">Inactive</span> @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($ref->created_at)->format('Y-m-d') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center text-gray-500 py-4">No recent referrals</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Recent Tokens -->
        <div class="bg-[#1a222d] rounded-lg border border-[#334155] overflow-hidden">
            <div class="flex justify-between items-center p-4 border-b border-[#334155]">
                <h3 class="text-gray-200 font-medium"><i class="fa-solid fa-coins mr-2 text-indigo-400"></i>Recent Tokens</h3>
                <a href="{{ url('user/wallets/utility') }}" class="text-xs text-indigo-400 hover:text-indigo-300">View all</a>
            </div>
            <table class="w-full table-custom">
                <thead><tr><th>Type</th><th>Amount</th><th>When</th></tr></thead>
                <tbody>
                    @forelse($recentTokens as $tok)
                    <tr>
                        <td><span class="text-xs bg-indigo-900 text-indigo-300 px-2 py-1 rounded capitalize">{{ $tok->token_type }}</span></td>
                        <td class="font-bold text-indigo-400">+{{ number_format($tok->token_count, 2) }}</td>
                        <td>{{ \Carbon\Carbon::parse($tok->created_at)->format('Y-m-d H:i') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center text-gray-500 py-4">No recent tokens</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Recent Withdrawals -->
        <div class="bg-[#1a222d] rounded-lg border border-[#334155] overflow-hidden">
            <div class="flex justify-between items-center p-4 border-b border-[#334155]">
                <h3 class="text-gray-200 font-medium"><i class="fa-solid fa-arrow-up-from-bracket mr-2 text-orange-400"></i>Recent Withdrawals</h3>
                <a href="{{ url('user/withdraw/history') }}" class="text-xs text-indigo-400 hover:text-indigo-300">View all</a>
            </div>
            <table class="w-full table-custom">
                <thead><tr><th>Amount</th><th>Status</th><th>When</th></tr></thead>
                <tbody>
                    @forelse($recentWithdrawals as $w)
                    <tr>
                        <td class="font-bold">${{ number_format($w->amount, 2) }}</td>
                        <td>
                            @if($w->status === 'pending') <span class="text-xs bg-yellow-900 text-yellow-300 px-2 py-1 rounded">Pending</span>
                            @elseif($w->status === 'approved') <span class="text-xs bg-green-900 text-green-300 px-2 py-1 rounded">Approved</span>
                            @else <span class="text-xs bg-red-900 text-red-300 px-2 py-1 rounded">Rejected</span> @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($w->created_at)->format('Y-m-d H:i') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center text-gray-500 py-4">No recent withdrawals</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions Panel -->
    <div class="bg-[#1a222d] rounded-lg border border-[#334155] p-5 mb-8">
        <h3 class="text-gray-200 font-medium mb-4"><i class="fa-solid fa-bolt mr-2"></i>Quick Actions</h3>
        <div class="flex flex-wrap gap-3">
            <a href="{{ url('user/package/upgrade') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded text-sm transition"><i class="fa-solid fa-box mr-1"></i> Activate Package</a>
            <a href="{{ url('user/wallets/transfer') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded text-sm transition shadow"><i class="fa-solid fa-paper-plane mr-1"></i> P2P Transfer</a>
            <a href="{{ url('user/withdraw/request') }}" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded text-sm transition"><i class="fa-solid fa-arrow-up-from-bracket mr-1"></i> Withdraw</a>
            <a href="{{ url('user/network/tree') }}" class="px-4 py-2 bg-[#334155] hover:bg-[#475569] text-white rounded text-sm transition"><i class="fa-solid fa-sitemap mr-1"></i> View Network</a>
            <a href="{{ url('user/wallets/history') }}" class="px-4 py-2 bg-[#334155] hover:bg-[#475569] text-white rounded text-sm transition"><i class="fa-solid fa-receipt mr-1"></i> Wallet History</a>
            <a href="{{ url('user/network/direct') }}" class="px-4 py-2 bg-[#334155] hover:bg-[#475569] text-white rounded text-sm transition"><i class="fa-solid fa-users mr-1"></i> Referrals</a>
            <a href="{{ url('user/profile') }}" class="px-4 py-2 bg-[#334155] hover:bg-[#475569] text-white rounded text-sm transition"><i class="fa-solid fa-user mr-1"></i> Profile</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Overall Financial Growth (Mixed Chart: Bar for Income, Line for Tokens)
    const trendCtx = document.getElementById('earningsChart').getContext('2d');
    new Chart(trendCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($trendLabels) !!},
            datasets: [
                {
                    type: 'line',
                    label: 'Tokens Earned',
                    data: {!! json_encode($tokenTrend) !!},
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#34d399',
                    pointRadius: 4,
                    order: 1
                },
                {
                    type: 'bar',
                    label: 'Income Earned ($)',
                    data: {!! json_encode($earningsTrend) !!},
                    backgroundColor: 'rgba(99, 102, 241, 0.8)',
                    borderRadius: 4,
                    order: 2
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { 
                    position: 'top',
                    labels: { color: '#94a3b8', usePointStyle: true, boxWidth: 8 }
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#334155', drawBorder: false },
                    ticks: { color: '#94a3b8' }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#94a3b8' }
                }
            },
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            }
        }
    });

    // 2. Income Breakdown Doughnut Chart
    const breakCtx = document.getElementById('breakdownChart').getContext('2d');
    new Chart(breakCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($breakdownLabels) !!},
            datasets: [{
                data: {!! json_encode($breakdownData) !!},
                backgroundColor: [
                    '#3b82f6', // blue
                    '#10b981', // green
                    '#8b5cf6', // purple
                    '#f59e0b', // yellow
                    '#ec4899'  // pink
                ],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { color: '#94a3b8', padding: 20, usePointStyle: true }
                }
            }
        }
    });

    // 3. Current Asset Distribution Chart
    const assetCtx = document.getElementById('assetChart').getContext('2d');
    new Chart(assetCtx, {
        type: 'polarArea',
        data: {
            labels: ['Income Wallet', 'Package Wallet', 'Utility Tokens'],
            datasets: [{
                data: [
                    {{ $wallet->income_wallet ?? 0 }},
                    {{ $wallet->package_wallet ?? 0 }},
                    {{ $wallet->utility_token_wallet ?? 0 }}
                ],
                backgroundColor: [
                    'rgba(16, 185, 129, 0.7)', // Green for Income
                    'rgba(139, 92, 246, 0.7)', // Purple for Package
                    'rgba(59, 130, 246, 0.7)'  // Blue for Tokens
                ],
                borderWidth: 1,
                borderColor: '#1a222d'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                r: {
                    grid: { color: '#334155' },
                    ticks: { display: false },
                    angleLines: { color: '#334155' }
                }
            },
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { color: '#94a3b8', padding: 20, usePointStyle: true }
                }
            }
        }
    });

    // 4. Live Stock Market Dummy Graph
    const stockCtx = document.getElementById('stockChart').getContext('2d');
    
    // Generate simulated stock data ending at actual Token Price
    const stockLabels = [];
    const stockData = [];
    const actualPrice = {{ $tokenPrice }};
    
    // Create realistic-looking historical data working backwards from current price
    let simPrice = actualPrice;
    
    // Generate backwards
    const historicalData = [];
    for (let i = 0; i <= 30; i++) {
        historicalData.unshift(simPrice);
        // Random walk backward, slight upward bias in general trend
        let volatility = actualPrice * 0.05; // 5% daily volatility max
        let change = (Math.random() - 0.45) * volatility; 
        simPrice = Math.max(actualPrice * 0.5, simPrice - change);
    }
    
    // Generate labels and load data forward
    for (let i = 30; i >= 0; i--) {
        let d = new Date();
        d.setDate(d.getDate() - i);
        stockLabels.push(d.toLocaleDateString('en-US', { month: 'short', day: 'numeric' }));
        stockData.push(historicalData[30 - i].toFixed(4));
    }
    
    // Ensure the last price exactly matches the db price
    stockData[stockData.length - 1] = actualPrice.toFixed(4);
    
    // Update the "+X% Today" badge dynamically based on the simulated opening price
    const openPrice = parseFloat(stockData[stockData.length - 2]);
    const closePrice = actualPrice;
    const pctChange = ((closePrice - openPrice) / openPrice) * 100;
    
    const badge = document.getElementById('todayChangeBadge');
    if (pctChange >= 0) {
        badge.innerHTML = '<i class="fa-solid fa-caret-up mr-1"></i>+' + pctChange.toFixed(1) + '% Today';
        badge.className = 'text-green-400 text-sm font-semibold mb-1 bg-green-900/30 px-2 py-0.5 rounded';
    } else {
        badge.innerHTML = '<i class="fa-solid fa-caret-down mr-1"></i>' + pctChange.toFixed(1) + '% Today';
        badge.className = 'text-red-400 text-sm font-semibold mb-1 bg-red-900/30 px-2 py-0.5 rounded';
    }
    
    // Create gradient
    let gradient = stockCtx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(16, 185, 129, 0.4)'); // Green
    gradient.addColorStop(1, 'rgba(16, 185, 129, 0.0)');
    
    new Chart(stockCtx, {
        type: 'line',
        data: {
            labels: stockLabels,
            datasets: [{
                label: 'SKT Price ($)',
                data: stockData,
                borderColor: '#10b981', // green
                backgroundColor: gradient,
                borderWidth: 2,
                tension: 0.05, // slightly jagged for stock look
                fill: true,
                pointRadius: 0,
                pointHoverRadius: 6,
                pointHoverBackgroundColor: '#10b981',
                pointHoverBorderColor: '#fff',
                pointHoverBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    titleColor: '#94a3b8',
                    bodyColor: '#10b981',
                    borderColor: '#334155',
                    borderWidth: 1,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return '$' + parseFloat(context.parsed.y).toFixed(4);
                        }
                    }
                }
            },
            scales: {
                y: {
                    grid: { color: '#334155', drawBorder: false },
                    ticks: { 
                        color: '#94a3b8',
                        callback: function(value) { return '$' + parseFloat(value).toFixed(2); }
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#94a3b8', maxTicksLimit: 7 }
                }
            },
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            }
        }
    });
});
</script>
@endsection
