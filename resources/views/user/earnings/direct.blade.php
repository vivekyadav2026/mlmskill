@extends('layouts.user')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<style>
  .app-main { padding: 20px; }
</style>
<div class="tailwind-scope mt-4">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Direct Income</h2>
        <p class="text-gray-400">Commissions earned from your direct referrals purchasing the course.</p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 max-w-2xl">
        <div class="bg-[#1a222d] rounded-lg p-5 border border-[#334155] border-l-4 border-l-indigo-500">
            <p class="text-sm text-gray-400 mb-1">Total Direct Income</p>
            <p class="text-3xl font-bold text-indigo-400">${{ number_format($totalDirect, 2) }}</p>
        </div>
    </div>

    <!-- History Table -->
    <div class="bg-[#1a222d] rounded-lg shadow-lg overflow-hidden border border-[#334155]">
        <div class="px-6 py-4 border-b border-[#334155] bg-[#0f172a]">
            <h3 class="text-lg font-medium text-gray-200">Direct Income Ledger</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#334155]">
                <thead class="bg-[#14172a]">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">From User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Amount Earned</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#334155]">
                    @forelse($earnings as $item)
                    <tr class="hover:bg-[#1f2937] transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ \Carbon\Carbon::parse($item->created_at)->format('M d, Y h:i A') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">
                            {{ $item->fromUser->name ?? 'Unknown' }} <span class="text-gray-500 text-xs">({{ $item->fromUser->referral_code ?? '' }})</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-900 text-indigo-300 border border-indigo-700">
                                Direct Referral
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-green-400">
                            +${{ number_format($item->amount, 2) }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                            <i class="fa-solid fa-handshake text-3xl mb-3"></i>
                            <p>No direct income recorded yet.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-3 border-t border-[#334155]">
            {{ $earnings->links() }}
        </div>
    </div>
</div>
@endsection
