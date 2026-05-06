@extends('layouts.user')

@section('content')

<style>
  .app-main { padding: 20px; }
</style>
<div class="tailwind-scope mt-4">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Income Wallet</h2>
        <p class="text-gray-400">View your earned commissions available for withdrawal.</p>
    </div>

    <!-- Balance Card -->
    <div class="bg-gradient-to-r from-green-600 to-green-900 rounded-lg shadow-lg overflow-hidden border border-green-500/50 mb-8 max-w-sm">
        <div class="p-6">
            <h3 class="text-green-100 font-medium text-lg mb-1">Available Balance</h3>
            <div class="text-4xl font-bold text-white">${{ number_format($balance, 2) }}</div>
            <div class="mt-4 flex gap-3">
                <a href="{{ url('user/withdraw/request') }}" class="bg-white text-green-800 px-4 py-2 rounded font-medium shadow hover:bg-gray-100 transition">Withdraw Funds</a>
            </div>
        </div>
    </div>

    <!-- History Table -->
    <div class="bg-[#1a222d] rounded-lg shadow-lg overflow-hidden border border-[#334155]">
        <div class="px-6 py-4 border-b border-[#334155] bg-[#161f2d]">
            <h3 class="text-lg font-medium text-gray-200">Income History</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#334155]">
                <thead class="bg-[#14172a]">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">From Level</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#334155]">
                    @forelse($history as $item)
                    <tr class="hover:bg-[#1f2937] transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ \Carbon\Carbon::parse($item->created_at)->format('M d, Y h:i A') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ ucfirst($item->commission_type) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                            {{ $item->level ? 'Level ' . $item->level : 'Direct' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-green-400">
                            +${{ number_format($item->amount, 2) }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                            <i class="fa-solid fa-receipt text-3xl mb-3"></i>
                            <p>No income history found.</p>
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
