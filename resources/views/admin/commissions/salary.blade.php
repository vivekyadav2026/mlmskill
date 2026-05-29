@extends('layouts.admin')
@section('content')
<style>
.tbl th { background:#0f172a; color:#94a3b8; font-weight:600; font-size:0.72rem;
          text-transform:uppercase; letter-spacing:.05em; padding:.75rem 1rem;
          border-bottom:1px solid #334155; white-space:nowrap; }
.tbl td { padding:.85rem 1rem; border-bottom:1px solid #1e293b; color:#e2e8f0;
          font-size:.875rem; vertical-align:middle; }
.tbl tr:hover td { background:rgba(255,255,255,.03); }
</style>

<div class="tailwind-scope mt-4 max-w-[1300px] mx-auto px-3 sm:px-4">

    {{-- Header --}}
    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
        <div>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-100">
                <i class="fa-solid fa-money-bill-transfer mr-2 text-yellow-400"></i>Salary Adjustment Logs
            </h2>
            <p class="text-gray-400 text-sm mt-1">
                Complete history of all manual salary credit &amp; debit entries.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <form action="{{ url('admin/commissions/salary') }}" method="GET" class="flex items-center gap-2 bg-[#1a222d] border border-[#334155] rounded-lg p-1.5">
                <input type="date" name="from_date" value="{{ request('from_date') }}" class="bg-[#0f172a] border border-[#334155] text-gray-300 text-xs rounded px-2 py-1.5 focus:outline-none">
                <span class="text-gray-500 text-xs">to</span>
                <input type="date" name="to_date" value="{{ request('to_date') }}" class="bg-[#0f172a] border border-[#334155] text-gray-300 text-xs rounded px-2 py-1.5 focus:outline-none">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs px-3 py-1.5 rounded transition">Filter</button>
                @if(request('from_date') || request('to_date'))
                <a href="{{ url('admin/commissions/salary') }}" class="bg-gray-600 hover:bg-gray-700 text-white text-xs px-2 py-1.5 rounded transition"><i class="fa-solid fa-xmark"></i></a>
                @endif
            </form>
            <a href="{{ url('admin/settings/salary') }}"
               class="px-4 py-2 text-sm bg-yellow-500/10 border border-yellow-700/50 text-yellow-400
                      hover:bg-yellow-500/20 rounded-lg transition flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> New
            </a>
        </div>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
        <div class="bg-[#1a222d] border border-[#334155] rounded-xl p-4 text-center">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Total Records</p>
            <p class="text-2xl font-bold text-white">{{ $logs->total() }}</p>
        </div>
        <div class="bg-[#1a222d] border border-green-900/60 rounded-xl p-4 text-center">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Total Credited</p>
            <p class="text-2xl font-bold text-green-400">+${{ number_format($totalCredit, 2) }}</p>
        </div>
        <div class="bg-[#1a222d] border border-red-900/60 rounded-xl p-4 text-center">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Total Debited</p>
            <p class="text-2xl font-bold text-red-400">{{ number_format($totalDebit, 2) }}</p>
        </div>
        <div class="bg-[#1a222d] border border-yellow-900/60 rounded-xl p-4 text-center">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Net Balance</p>
            @php $net = $totalCredit + $totalDebit; @endphp
            <p class="text-2xl font-bold {{ $net >= 0 ? 'text-green-400' : 'text-red-400' }}">
                {{ $net >= 0 ? '+' : '' }}${{ number_format($net, 2) }}
            </p>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-[#1a222d] border border-[#334155] rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full tbl">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date & Time</th>
                        <th>User (Receiver)</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Done By (Admin)</th>
                        <th>Reason / Remark</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                    @php $isCredit = $log->amount >= 0; @endphp
                    <tr>
                        {{-- ID --}}
                        <td class="text-gray-500 text-xs">{{ $log->id }}</td>

                        {{-- Date --}}
                        <td>
                            <span class="text-gray-300">{{ $log->created_at->format('d M Y') }}</span><br>
                            <span class="text-gray-500 text-xs">{{ $log->created_at->format('h:i A') }}</span>
                        </td>

                        {{-- User --}}
                        <td>
                            @if($log->user)
                                <a href="{{ url('admin/users/' . $log->user_id) }}"
                                   class="text-white hover:text-indigo-400 font-medium transition">
                                    {{ $log->user->name }}
                                </a><br>
                                <span class="text-gray-500 text-xs font-mono">{{ $log->user->referral_code }}</span>
                            @else
                                <span class="text-gray-500">—</span>
                            @endif
                        </td>

                        {{-- Credit / Debit badge --}}
                        <td>
                            @if($isCredit)
                                <span class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full
                                             bg-green-500/15 text-green-400 border border-green-700/40">
                                    <i class="fa-solid fa-arrow-up text-[10px]"></i> CREDIT
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full
                                             bg-red-500/15 text-red-400 border border-red-700/40">
                                    <i class="fa-solid fa-arrow-down text-[10px]"></i> DEBIT
                                </span>
                            @endif
                        </td>

                        {{-- Amount --}}
                        <td>
                            <span class="font-mono font-bold text-base {{ $isCredit ? 'text-green-400' : 'text-red-400' }}">
                                {{ $isCredit ? '+' : '' }}${{ number_format($log->amount, 2) }}
                            </span>
                        </td>

                        {{-- Admin who did it --}}
                        <td>
                            @if($log->fromUser)
                                <span class="text-indigo-300 text-sm">{{ $log->fromUser->name }}</span><br>
                                <span class="text-gray-500 text-xs">{{ $log->fromUser->email }}</span>
                            @else
                                <span class="text-xs px-2 py-0.5 bg-indigo-500/10 border border-indigo-700/40
                                             text-indigo-400 rounded-full">System/Auto</span>
                            @endif
                        </td>

                        {{-- Remark --}}
                        <td class="max-w-[220px]">
                            <span class="text-gray-400 text-sm break-words">
                                {{ $log->remarks ?? '—' }}
                            </span>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-16 text-gray-500">
                            <i class="fa-solid fa-money-bill text-4xl mb-3 block opacity-20"></i>
                            No salary adjustments recorded yet.<br>
                            <a href="{{ url('admin/settings/salary') }}"
                               class="text-yellow-400 hover:text-yellow-300 text-sm mt-2 inline-block">
                                <i class="fa-solid fa-plus mr-1"></i>Make first adjustment →
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($logs->hasPages())
        <div class="p-4 border-t border-[#334155] flex justify-center">
            {{ $logs->links() }}
        </div>
        @endif
    </div>

    {{-- Legend --}}
    <div class="mt-4 flex flex-wrap gap-4 text-xs text-gray-500">
        <div class="flex items-center gap-1.5">
            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-green-500/15 text-green-400 border border-green-700/40">
                <i class="fa-solid fa-arrow-up text-[9px]"></i> CREDIT
            </span>
            — Amount added to user's Income Wallet
        </div>
        <div class="flex items-center gap-1.5">
            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-red-500/15 text-red-400 border border-red-700/40">
                <i class="fa-solid fa-arrow-down text-[9px]"></i> DEBIT
            </span>
            — Amount deducted from user's Income Wallet
        </div>
    </div>

</div>
@endsection
