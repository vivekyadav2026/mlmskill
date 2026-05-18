@extends('layouts.user')

@section('content')

<style>
  .app-main { padding: 20px; }
</style>
<div class="tailwind-scope mt-4">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Package Wallet</h2>
        <p class="text-gray-400">Funds converted from NEXA 1.0s to be used for Package Upgrades.</p>
    </div>

    <!-- Balance Card -->
    <div class="bg-gradient-to-r from-purple-600 to-purple-900 rounded-lg shadow-lg overflow-hidden border border-purple-500/50 mb-8 max-w-sm">
        <div class="p-6">
            <h3 class="text-purple-100 font-medium text-lg mb-1">Package Balance</h3>
            <div class="text-4xl font-bold text-white">${{ number_format($balance, 2) }}</div>
            <div class="mt-4 flex gap-3">
                <a href="{{ url('user/package/upgrade') }}" class="bg-white text-purple-800 px-4 py-2 rounded font-medium shadow hover:bg-gray-100 transition">Upgrade Package Now</a>
            </div>
        </div>
    </div>

    <div class="bg-[#1a222d] rounded-lg shadow-lg overflow-hidden border border-[#334155]">
        <div class="px-6 py-4 border-b border-[#334155] bg-[#161f2d]">
            <h3 class="text-lg font-medium text-gray-200">Recent Package Wallet Activity</h3>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ \Carbon\Carbon::parse($item['date'])->format('M d, Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                {{ $item['type'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $item['desc'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-green-400">
                            +{{ $item['amount'] }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                            <i class="fa-solid fa-box-open text-3xl mb-3"></i>
                            <p>No recent activity in your package wallet.</p>
                            <p class="text-sm mt-2 text-gray-400">Convert NEXA 1.0s to add funds here.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($history->hasPages())
        <div class="px-6 py-3 border-t border-[#334155]">
            {{ $history->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
