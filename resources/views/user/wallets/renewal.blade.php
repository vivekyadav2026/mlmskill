@extends('layouts.user')

@section('content')

<style>
  .app-main { padding: 20px; }
</style>
<div class="tailwind-scope mt-4">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Renewal Token Wallet</h2>
        <p class="text-gray-400">Tokens accumulated specifically for your ID renewal.</p>
    </div>

    <!-- Balance Card -->
    <div class="bg-gradient-to-r from-orange-600 to-red-900 rounded-lg shadow-lg overflow-hidden border border-orange-500/50 mb-8 max-w-sm">
        <div class="p-6">
            <h3 class="text-orange-100 font-medium text-lg mb-1">Renewal Tokens</h3>
            <div class="text-4xl font-bold text-white">{{ number_format($balance, 2) }} RT</div>
            <div class="mt-4">
                <div class="w-full bg-gray-900 rounded-full h-2.5 mb-1 dark:bg-gray-700">
                  <div class="bg-orange-400 h-2.5 rounded-full" style="width: {{ min(100, ($balance / 300) * 100) }}%"></div>
                </div>
                <p class="text-xs text-orange-200 text-right">{{ number_format(min(100, ($balance / 300) * 100), 1) }}% to Renewal target ($300)</p>
            </div>
        </div>
    </div>

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
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                Renewal Token
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            Daily ROI Distribution
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-orange-400">
                            +{{ number_format($item->token_count, 2) }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                            <i class="fa-solid fa-sync text-3xl mb-3"></i>
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
