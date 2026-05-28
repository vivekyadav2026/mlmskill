@extends('layouts.user')

@section('content')
<div class="tailwind-scope mt-4 max-w-5xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-100"><i class="fa-solid fa-clock-rotate-left mr-2 text-indigo-500"></i>P2P Transfer History</h2>
            <p class="text-gray-400">View all your sent and received funds.</p>
        </div>
        <a href="{{ route('wallets.transfer') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded shadow text-sm font-bold">
            <i class="fa-solid fa-paper-plane mr-1"></i> Send Funds
        </a>
    </div>

    <!-- Filter Form -->
    <div class="bg-[#1a222d] border border-[#334155] rounded-xl p-4 mb-6 shadow-xl">
        <form method="GET" action="{{ route('p2p.history') }}" class="flex flex-col sm:flex-row gap-4 items-end">
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-400 mb-1">From Date</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full bg-[#0b1220] border border-[#334155] rounded-md py-2 px-3 text-gray-100 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
            </div>
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-400 mb-1">To Date</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full bg-[#0b1220] border border-[#334155] rounded-md py-2 px-3 text-gray-100 focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
            </div>
            <div class="flex flex-col sm:flex-row gap-2">
                <button type="submit" class="px-6 py-2 bg-[#334155] hover:bg-[#475569] text-white rounded-md shadow transition">
                    <i class="fa-solid fa-filter mr-1"></i> Filter
                </button>
                <button type="submit" name="export" value="csv" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md shadow transition">
                    <i class="fa-solid fa-file-csv mr-1"></i> Export
                </button>
                @if(request('date_from') || request('date_to'))
                    <a href="{{ route('p2p.history') }}" class="px-4 py-2 bg-red-900/30 text-red-400 border border-red-500/30 hover:bg-red-900/50 rounded-md shadow transition flex items-center justify-center">
                        Clear
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="bg-[#1a222d] border border-[#334155] rounded-xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="bg-[#0f172a] text-gray-400 font-semibold text-xs uppercase tracking-wider p-4 border-b border-[#334155]">Transaction Type</th>
                        <th class="bg-[#0f172a] text-gray-400 font-semibold text-xs uppercase tracking-wider p-4 border-b border-[#334155]">Sender</th>
                        <th class="bg-[#0f172a] text-gray-400 font-semibold text-xs uppercase tracking-wider p-4 border-b border-[#334155]">Receiver</th>
                        <th class="bg-[#0f172a] text-gray-400 font-semibold text-xs uppercase tracking-wider p-4 border-b border-[#334155]">Amount</th>
                        <th class="bg-[#0f172a] text-gray-400 font-semibold text-xs uppercase tracking-wider p-4 border-b border-[#334155]">Date & Time</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#334155]">
                    @forelse($history as $log)
                        <tr class="hover:bg-[#0b1220] transition">
                            <td class="p-4">
                                @if($log->type === 'p2p_transfer')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-900/30 text-red-400 border border-red-500/30">
                                        <i class="fa-solid fa-arrow-up"></i> Sent
                                    </span>
                                @elseif($log->type === 'wallet_conversion')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-900/30 text-blue-400 border border-blue-500/30">
                                        <i class="fa-solid fa-rotate"></i> Converted
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-900/30 text-green-400 border border-green-500/30">
                                        <i class="fa-solid fa-arrow-down"></i> Received
                                    </span>
                                @endif
                            </td>
                            
                            <!-- Sender Column -->
                            <td class="p-4">
                                @if($log->type === 'p2p_transfer' || $log->type === 'wallet_conversion')
                                    <!-- I sent this -->
                                    <div class="font-semibold text-gray-200">You ({{ auth()->user()->name }})</div>
                                    <div class="text-xs text-indigo-400">{{ auth()->user()->referral_code }}</div>
                                @else
                                    <!-- Someone sent to me -->
                                    <div class="font-semibold text-gray-200">{{ $log->target_name }}</div>
                                    <div class="text-xs text-indigo-400">{{ $log->target_id }}</div>
                                @endif
                            </td>
                            
                            <!-- Receiver Column -->
                            <td class="p-4">
                                @if($log->type === 'p2p_transfer' || $log->type === 'wallet_conversion')
                                    <!-- I sent to someone (or myself) -->
                                    <div class="font-semibold text-gray-200">{{ $log->target_name }}</div>
                                    <div class="text-xs text-indigo-400">{{ $log->target_id }}</div>
                                @else
                                    <!-- Someone sent to me -->
                                    <div class="font-semibold text-gray-200">You ({{ auth()->user()->name }})</div>
                                    <div class="text-xs text-indigo-400">{{ auth()->user()->referral_code }}</div>
                                @endif
                            </td>

                            <td class="p-4">
                                <span class="font-bold {{ $log->type === 'p2p_received' ? 'text-green-400' : ($log->type === 'wallet_conversion' ? 'text-blue-400' : 'text-red-400') }}">
                                    {{ $log->type === 'p2p_received' ? '+' : '-' }}${{ number_format((float)$log->amount, 2) }}
                                </span>
                            </td>
                            <td class="p-4 text-gray-400 text-sm">
                                {{ $log->date->format('d M, Y h:i A') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-8 text-center text-gray-500">
                                <div class="text-4xl mb-3 opacity-50"><i class="fa-solid fa-box-open"></i></div>
                                No P2P transactions found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-[#334155]">
            {{ $history->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection
