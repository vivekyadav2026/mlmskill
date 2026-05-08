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

    <div class="bg-[#1a222d] border border-[#334155] rounded-xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="bg-[#0f172a] text-gray-400 font-semibold text-xs uppercase tracking-wider p-4 border-b border-[#334155]">Transaction Type</th>
                        <th class="bg-[#0f172a] text-gray-400 font-semibold text-xs uppercase tracking-wider p-4 border-b border-[#334155]">Details</th>
                        <th class="bg-[#0f172a] text-gray-400 font-semibold text-xs uppercase tracking-wider p-4 border-b border-[#334155]">Date & Time</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#334155]">
                    @forelse($history as $log)
                        <tr class="hover:bg-[#0b1220] transition">
                            <td class="p-4">
                                @if($log->action === 'p2p_transfer')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-900/30 text-red-400 border border-red-500/30">
                                        <i class="fa-solid fa-arrow-up"></i> Sent
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-900/30 text-green-400 border border-green-500/30">
                                        <i class="fa-solid fa-arrow-down"></i> Received
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-gray-200">
                                {{ $log->details }}
                            </td>
                            <td class="p-4 text-gray-400 text-sm">
                                {{ $log->created_at->format('M d, Y h:i A') }}
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
