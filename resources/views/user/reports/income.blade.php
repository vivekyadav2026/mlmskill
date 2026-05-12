@extends('layouts.user')

@section('content')
<style>
  .table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; }
  .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; font-size: 0.875rem; }
  .table-custom tr:hover td { background: rgba(255,255,255,0.02); }
  .table-scroll { overflow-x:auto; -webkit-overflow-scrolling:touch; }
  .table-scroll table { min-width:650px; }
</style>

<div class="tailwind-scope mt-4 max-w-[1400px] mx-auto">
    <div class="flex items-center justify-between mb-6 flex-wrap gap-3">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">Income Report</h2>
            <p class="text-gray-400 text-sm">Detailed ledger of all commissions earned.</p>
        </div>
        <button class="px-4 py-2 bg-[#334155] hover:bg-[#475569] text-white rounded transition" onclick="window.print()"><i class="fa-solid fa-print mr-1"></i> Print Report</button>
    </div>

    <!-- Analytics Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <div class="bg-[#1a222d] border border-[#334155] p-5 rounded-xl shadow-lg">
            <h3 class="text-gray-400 font-medium mb-1 text-xs uppercase">Total Earned</h3>
            <div class="text-2xl font-bold text-green-400">${{ number_format($totalEarned, 2) }}</div>
        </div>
        <div class="bg-[#1a222d] border border-[#334155] p-5 rounded-xl shadow-lg">
            <h3 class="text-gray-400 font-medium mb-1 text-xs uppercase">Direct Income</h3>
            <div class="text-2xl font-bold text-blue-400">${{ number_format($directEarned, 2) }}</div>
        </div>
        <div class="bg-[#1a222d] border border-[#334155] p-5 rounded-xl shadow-lg">
            <h3 class="text-gray-400 font-medium mb-1 text-xs uppercase">Team Income</h3>
            <div class="text-2xl font-bold text-purple-400">${{ number_format($teamEarned, 2) }}</div>
        </div>
    </div>

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden shadow-lg">
        <div class="table-scroll">
            <table class="w-full table-custom">
                <thead>
                    <tr>
                        <th class="text-left">Date</th>
                        <th class="text-left">Income Type</th>
                        <th class="text-left">From User</th>
                        <th class="text-left">Level</th>
                        <th class="text-left">Description</th>
                        <th class="text-right">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $item)
                    <tr class="transition">
                        <td class="whitespace-nowrap text-gray-400">{{ \Carbon\Carbon::parse($item->created_at)->format('M d, Y') }}<br><span class="text-xs">{{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}</span></td>
                        <td>
                            @if($item->commission_type == 'direct')
                                <span class="bg-blue-900/50 text-blue-400 border border-blue-500/30 px-2 py-1 rounded text-xs uppercase">Direct</span>
                            @elseif($item->commission_type == 'team')
                                <span class="bg-purple-900/50 text-purple-400 border border-purple-500/30 px-2 py-1 rounded text-xs uppercase">Team</span>
                            @else
                                <span class="bg-gray-800 text-gray-300 border border-gray-600 px-2 py-1 rounded text-xs uppercase">{{ $item->commission_type }}</span>
                            @endif
                        </td>
                        <td class="text-gray-300">
                            @if($item->from_user_id)
                                @php $fromUser = \App\Models\User::find($item->from_user_id); @endphp
                                @if($fromUser)
                                    {{ $fromUser->name }}<br><span class="text-xs text-gray-500">{{ $fromUser->referral_code }}</span>
                                @else
                                    System
                                @endif
                            @else
                                System
                            @endif
                        </td>
                        <td class="text-gray-400">{{ $item->level ?? '-' }}</td>
                        <td class="text-gray-300">{{ $item->description }}</td>
                        <td class="text-right font-bold text-green-400">+${{ number_format($item->amount, 2) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center p-12 text-gray-500">
                            <i class="fa-solid fa-chart-line text-4xl mb-3 block text-gray-600"></i>
                            No income records found yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($reports->hasPages())
        <div class="px-6 py-4 border-t border-[#334155]">
            {{ $reports->links() }}
        </div>
        @endif
    </div>
</div>
@endsection