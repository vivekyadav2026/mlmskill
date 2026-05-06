@extends('layouts.user')

@section('content')

<style>
  .app-main { padding: 20px; }
</style>
<div class="tailwind-scope mt-4">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Utility Token Wallet</h2>
        <p class="text-gray-400">Daily tokens credited for utility use and conversion.</p>
    </div>

    <!-- Balance Card -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-900 rounded-lg shadow-lg overflow-hidden border border-indigo-500/50 mb-8 max-w-sm">
        <div class="p-6">
            <h3 class="text-indigo-100 font-medium text-lg mb-1">Available Tokens</h3>
            <div class="text-4xl font-bold text-white">{{ number_format($balance, 2) }} UT</div>
            <div class="mt-4 flex gap-3">
                <a href="{{ url('user/token/conversion') }}" class="bg-white text-indigo-800 px-4 py-2 rounded font-medium shadow hover:bg-gray-100 transition">Convert to Package Wallet</a>
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
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                Utility Token
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
