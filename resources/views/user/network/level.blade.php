@extends('layouts.user')

@section('content')

<style>
  .app-main { padding: 20px; }
</style>
<div class="tailwind-scope mt-4">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Level Income Report</h2>
        <p class="text-gray-400">Detailed breakdown of commissions earned from your 10-level deep network.</p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-[#1a222d] rounded-lg p-5 border border-[#334155] border-l-4 border-l-indigo-500">
            <p class="text-sm text-gray-400 mb-1">Total Level Income</p>
            <p class="text-2xl font-bold text-indigo-400">${{ number_format($totalLevelIncome, 2) }}</p>
        </div>
        <div class="bg-[#1a222d] rounded-lg p-5 border border-[#334155] border-l-4 border-l-green-500">
            <p class="text-sm text-gray-400 mb-1">This Month</p>
            <p class="text-2xl font-bold text-green-400">${{ number_format($monthlyLevelIncome, 2) }}</p>
        </div>
        <div class="bg-[#1a222d] rounded-lg p-5 border border-[#334155] border-l-4 border-l-purple-500">
            <p class="text-sm text-gray-400 mb-1">Total Network Members</p>
            <p class="text-2xl font-bold text-purple-400">{{ $networkCount }}</p>
        </div>
    </div>

    <!-- Level Breakdown -->
    <div class="bg-[#1a222d] rounded-lg shadow-lg overflow-hidden border border-[#334155] mb-6">
        <div class="px-6 py-4 border-b border-[#334155] bg-[#161f2d]">
            <h3 class="text-lg font-medium text-gray-200">Network Level Breakdown</h3>
            <p class="text-sm text-gray-400">See how many members you have at each specific level.</p>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                @foreach($levelCounts as $level => $count)
                <div class="bg-[#0b1220] border border-[#334155] rounded-lg p-4 text-center">
                    <p class="text-gray-400 text-sm font-bold uppercase mb-1">Level {{ $level }}</p>
                    <div class="flex justify-center items-end gap-2 mb-2">
                        <span class="text-2xl font-black {{ $count > 0 ? 'text-indigo-400' : 'text-gray-600' }}">{{ $count }}</span>
                        <span class="text-xs text-gray-500 mb-1">Members</span>
                    </div>
                    <div class="bg-[#1a222d] border border-green-500/30 rounded py-1 px-2 inline-block">
                        <span class="text-xs text-gray-400 mr-1">Earned:</span>
                        <span class="text-sm font-bold {{ $levelEarnings[$level] > 0 ? 'text-green-400' : 'text-gray-500' }}">${{ number_format($levelEarnings[$level], 2) }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- History Table -->
    <div class="bg-[#1a222d] rounded-lg shadow-lg overflow-hidden border border-[#334155]">
        <div class="px-6 py-4 border-b border-[#334155] bg-[#161f2d]">
            <h3 class="text-lg font-medium text-gray-200">Level Income Ledger</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-[#334155]">
                <thead class="bg-[#14172a]">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">From User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Level</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Amount Earned</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#334155]">
                    @forelse($history as $item)
                    <tr class="hover:bg-[#1f2937] transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ \Carbon\Carbon::parse($item->created_at)->format('M d, Y h:i A') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">
                            {{ $item->fromUser->name ?? 'Unknown' }} <span class="text-gray-500 text-xs">({{ $item->from_user_id }})</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                Level {{ $item->level }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-green-400">
                            +${{ number_format($item->amount, 2) }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                            <i class="fa-solid fa-chart-network text-3xl mb-3"></i>
                            <p>No level income recorded yet.</p>
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
