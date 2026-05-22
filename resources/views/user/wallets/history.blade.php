@extends('layouts.user')

@section('content')

<style>
  .app-main { padding: 20px; }
</style>
<div class="tailwind-scope mt-4">
    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">Consolidated Wallet History</h2>
            <p class="text-gray-400">A comprehensive view of all your wallet activities across the platform.</p>
        </div>
        
        <!-- Date Filter Form -->
        <form method="GET" action="{{ route('wallets.history') }}" class="flex items-center gap-3 bg-[#1a222d] p-3 rounded-lg border border-[#334155] shadow-sm">
            <div class="flex items-center gap-2">
                <label class="text-xs text-gray-400 font-semibold uppercase">From</label>
                <input type="date" name="from_date" value="{{ request('from_date') }}" class="bg-[#0f172a] border border-[#334155] text-gray-200 text-sm rounded px-2 py-1 focus:outline-none focus:border-indigo-500">
            </div>
            <div class="flex items-center gap-2">
                <label class="text-xs text-gray-400 font-semibold uppercase">To</label>
                <input type="date" name="to_date" value="{{ request('to_date') }}" class="bg-[#0f172a] border border-[#334155] text-gray-200 text-sm rounded px-2 py-1 focus:outline-none focus:border-indigo-500">
            </div>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-1.5 rounded transition shadow">
                Filter
            </button>
            <button type="submit" name="export" value="csv" class="bg-[#334155] hover:bg-[#475569] text-white text-sm font-semibold px-4 py-1.5 rounded transition shadow" title="Download CSV Statement">
                <i class="fa-solid fa-file-csv mr-1"></i> Export
            </button>
            @if(request('from_date') || request('to_date'))
                <a href="{{ route('wallets.history') }}" class="bg-gray-600 hover:bg-gray-700 text-white text-sm font-semibold px-3 py-1.5 rounded transition shadow" title="Clear Filters">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            @endif
        </form>
    </div>

    <!-- Overview Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-[#1a222d] rounded-lg p-5 border border-[#334155]">
            <p class="text-sm text-gray-400 mb-1">Income Wallet</p>
            <p class="text-2xl font-bold text-green-400">${{ number_format($user->wallet->income_wallet ?? 0, 2) }}</p>
        </div>
        <div class="bg-[#1a222d] rounded-lg p-5 border border-[#334155]">
            <p class="text-sm text-gray-400 mb-1">Package Wallet</p>
            <p class="text-2xl font-bold text-purple-400">${{ number_format($user->wallet->package_wallet ?? 0, 2) }}</p>
        </div>
        <div class="bg-[#1a222d] rounded-lg p-5 border border-[#334155]">
            <p class="text-sm text-gray-400 mb-1">NEXA 1.0</p>
            <p class="text-2xl font-bold text-blue-400">{{ number_format($user->wallet->utility_token_wallet ?? 0, 2) }}</p>
        </div>
        <div class="bg-[#1a222d] rounded-lg p-5 border border-[#334155]">
            <p class="text-sm text-gray-400 mb-1">NEXA 2.0</p>
            <p class="text-2xl font-bold text-orange-400">{{ number_format($user->wallet->renewal_token_wallet ?? 0, 2) }}  </p>
        </div>
    </div>

    <div class="bg-[#1a222d] rounded-lg shadow-lg overflow-hidden border border-[#334155]">
        <div class="px-6 py-4 border-b border-[#334155] bg-[#161f2d]">
            <h3 class="text-lg font-medium text-gray-200">Consolidated Ledger</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#334155]">
                <thead class="bg-[#14172a]">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Wallet</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Transaction Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Amount / Effect</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#334155]">
                    @forelse($paginatedHistory as $item)
                    <tr class="hover:bg-[#1f2937] transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ \Carbon\Carbon::parse($item['date'])->format('M d, Y - H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item['bg'] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $item['wallet'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $item['type'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold {{ $item['color'] ?? 'text-gray-400' }}">
                            {{ $item['amount'] }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                            <i class="fa-solid fa-clock-rotate-left text-3xl mb-3"></i>
                            <p>No transaction history found across any wallets.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($paginatedHistory->hasPages())
        <div class="px-6 py-3 border-t border-[#334155]">
            {{ $paginatedHistory->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
