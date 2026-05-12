@extends('layouts.admin')
@section('content')
<style>
.table-custom th { background:#0f172a; color:#94a3b8; font-weight:600; font-size:0.72rem; text-transform:uppercase; letter-spacing:0.05em; padding:0.75rem 1rem; border-bottom:1px solid #334155; white-space:nowrap; }
.table-custom td { padding:0.85rem 1rem; border-bottom:1px solid #1e293b; color:#e2e8f0; font-size:0.875rem; vertical-align:middle; }
.table-custom tr:hover td { background:rgba(255,255,255,0.03); }
.badge-credit { background:rgba(16,185,129,0.15); color:#10b981; border:1px solid rgba(16,185,129,0.3); padding:0.2rem 0.6rem; border-radius:999px; font-size:0.72rem; font-weight:600; }
.badge-debit  { background:rgba(239,68,68,0.15);  color:#f87171; border:1px solid rgba(239,68,68,0.3);  padding:0.2rem 0.6rem; border-radius:999px; font-size:0.72rem; font-weight:600; }
</style>

<div class="tailwind-scope mt-4 max-w-[1400px] mx-auto">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6 flex-wrap gap-3">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">Wallet Adjustment Logs</h2>
            <p class="text-gray-400 text-sm mt-1">Complete audit trail of all manual wallet modifications made by administrators.</p>
        </div>
        <a href="{{ url('admin/wallets/adjustments') }}"
           class="bg-orange-600 hover:bg-orange-700 text-white text-sm font-semibold px-4 py-2 rounded transition flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> New Adjustment
        </a>
    </div>

    {{-- Stats Row --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-4 text-center">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Total Adjustments</p>
            <p class="text-2xl font-bold text-white">{{ $logs->total() }}</p>
        </div>
        <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-4 text-center">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Total Credits</p>
            <p class="text-2xl font-bold text-green-400">
                +{{ number_format($logs->getCollection()->where('amount', '>', 0)->sum('amount'), 2) }}
            </p>
        </div>
        <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-4 text-center">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Total Debits</p>
            <p class="text-2xl font-bold text-red-400">
                {{ number_format($logs->getCollection()->where('amount', '<', 0)->sum('amount'), 2) }}
            </p>
        </div>
        <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-4 text-center">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">This Page</p>
            <p class="text-2xl font-bold text-indigo-400">{{ $logs->count() }}</p>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full table-custom">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date & Time</th>
                        <th>Admin</th>
                        <th>Target User</th>
                        <th>Wallet</th>
                        <th>Before</th>
                        <th>Amount</th>
                        <th>After</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                    <tr>
                        <td class="text-gray-500 text-xs">{{ $log->id }}</td>
                        <td>
                            <span class="text-gray-200">{{ $log->created_at->format('d M Y') }}</span><br>
                            <span class="text-gray-500 text-xs">{{ $log->created_at->format('h:i A') }}</span>
                        </td>
                        <td>
                            <span class="font-medium text-indigo-400">{{ $log->admin->name ?? 'N/A' }}</span>
                        </td>
                        <td>
                            <a href="{{ url('admin/users/' . $log->user_id) }}" class="text-white hover:text-indigo-400 font-medium">
                                {{ $log->user->name ?? 'N/A' }}
                            </a><br>
                            <span class="text-gray-500 text-xs">{{ $log->user->referral_code ?? '' }}</span>
                        </td>
                        <td>
                            <span class="bg-[#0f172a] text-gray-300 text-xs px-2 py-1 rounded">
                                {{ $log->wallet_label }}
                            </span>
                        </td>
                        <td class="text-gray-400 font-mono text-sm">{{ number_format($log->balance_before, 2) }}</td>
                        <td>
                            @if($log->amount >= 0)
                                <span class="badge-credit">+{{ number_format($log->amount, 2) }}</span>
                            @else
                                <span class="badge-debit">{{ number_format($log->amount, 2) }}</span>
                            @endif
                        </td>
                        <td class="font-mono text-sm font-semibold {{ $log->amount >= 0 ? 'text-green-400' : 'text-red-400' }}">
                            {{ number_format($log->balance_after, 2) }}
                        </td>
                        <td class="text-gray-400 text-sm">{{ $log->note ?: '—' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-16 text-gray-500">
                            <i class="fa-solid fa-file-circle-xmark text-4xl mb-3 block opacity-30"></i>
                            No wallet adjustments recorded yet.<br>
                            <a href="{{ url('admin/wallets/adjustments') }}" class="text-indigo-400 hover:underline text-sm mt-2 inline-block">Make your first adjustment →</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($logs->hasPages())
    <div class="mt-4 flex justify-center">
        {{ $logs->links() }}
    </div>
    @endif
</div>
@endsection