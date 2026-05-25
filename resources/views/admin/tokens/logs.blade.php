@extends('layouts.admin')
@section('content')
<style>
.table-custom th { background:#0f172a; color:#94a3b8; font-weight:600; font-size:0.72rem; text-transform:uppercase; letter-spacing:0.05em; padding:0.75rem 1rem; border-bottom:1px solid #334155; white-space:nowrap; }
.table-custom td { padding:0.85rem 1rem; border-bottom:1px solid #1e293b; color:#e2e8f0; font-size:0.875rem; vertical-align:middle; }
.table-custom tr:hover td { background:rgba(255,255,255,0.03); }
.badge-utility  { background:rgba(99,102,241,0.15); color:#818cf8; border:1px solid rgba(99,102,241,0.3); padding:0.2rem 0.7rem; border-radius:999px; font-size:0.72rem; font-weight:600; }
.badge-renewal  { background:rgba(245,158,11,0.15); color:#fbbf24; border:1px solid rgba(245,158,11,0.3); padding:0.2rem 0.7rem; border-radius:999px; font-size:0.72rem; font-weight:600; }
.badge-credited { background:rgba(16,185,129,0.15); color:#34d399; border:1px solid rgba(16,185,129,0.3); padding:0.2rem 0.6rem; border-radius:999px; font-size:0.7rem; }
.badge-pending  { background:rgba(234,179,8,0.15);  color:#facc15; border:1px solid rgba(234,179,8,0.3);  padding:0.2rem 0.6rem; border-radius:999px; font-size:0.7rem; }
.badge-used     { background:rgba(148,163,184,0.1);  color:#94a3b8; border:1px solid rgba(148,163,184,0.2);padding:0.2rem 0.6rem; border-radius:999px; font-size:0.7rem; }
</style>

<div class="tailwind-scope mt-4 max-w-[1400px] mx-auto">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6 flex-wrap gap-3">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">Token Distribution Logs</h2>
            <p class="text-gray-400 text-sm mt-1">Complete history of all NEXA 1.0 & NEXA 2.0 distributed to users.</p>
        </div>
        <a href="{{ url('admin/tokens/manual') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2 rounded transition flex items-center gap-2">
            <i class="fa-solid fa-coins"></i> Manual Credit
        </a>
    </div>

    {{-- Stats Row --}}
    @php
        $allLogs        = \App\Models\TokenLedger::all();
        $totalUtility   = $allLogs->where('token_type','utility')->sum('token_count');
        $totalRenewal   = $allLogs->where('token_type','renewal')->sum('token_count');
        $totalNexa3     = $allLogs->where('token_type','nexa_3')->sum('token_count');
        $totalCredited  = $allLogs->where('status','credited')->count();
        $totalUsed      = $allLogs->where('status','used')->count();
    @endphp
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-[#111827] rounded-lg p-5 border border-[#334155]">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">NEXA 1.0 Issued</p>
            <h3 class="text-2xl font-bold text-indigo-400">{{ number_format($totalUtility, 2) }}</h3>
        </div>
        <div class="bg-[#111827] rounded-lg p-5 border border-[#334155]">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">NEXA 2.0 Issued</p>
            <h3 class="text-2xl font-bold text-yellow-400">{{ number_format($totalRenewal, 2) }}</h3>
        </div>
        <div class="bg-[#111827] rounded-lg p-5 border border-[#334155]">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">NEXA 3.0 Issued</p>
            <h3 class="text-2xl font-bold text-teal-400">{{ number_format($totalNexa3, 2) }}</h3>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full table-custom">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>User</th>
                        <th>Token Type</th>
                        <th>Amount</th>
                        <th>Value (₹/$)</th>
                        <th>Source</th>
                        <th>Status</th>
                        <th>Credited On</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                    <tr>
                        <td class="text-gray-500 text-xs">{{ $log->id }}</td>
                        <td>
                            <span class="text-gray-300">{{ $log->created_at->format('d M Y') }}</span><br>
                            <span class="text-gray-500 text-xs">{{ $log->created_at->format('h:i A') }}</span>
                        </td>
                        <td>
                            <a href="{{ url('admin/users/' . $log->user_id) }}" class="text-white hover:text-indigo-400 font-medium">
                                {{ $log->user->name ?? 'Unknown' }}
                            </a><br>
                            <span class="text-gray-500 text-xs">{{ $log->user->referral_code ?? '' }}</span>
                        </td>
                        <td>
                            @if($log->token_type === 'utility')
                                <span class="badge-utility"><i class="fa-solid fa-circle-bolt mr-1"></i>NEXA 1.0</span>
                            @elseif($log->token_type === 'renewal')
                                <span class="badge-renewal"><i class="fa-solid fa-rotate mr-1"></i>NEXA 2.0</span>
                            @elseif($log->token_type === 'nexa_3')
                                <span class="text-xs bg-teal-900/40 text-teal-400 border border-teal-800 px-2 py-1 rounded-full"><i class="fa-solid fa-graduation-cap mr-1"></i>NEXA 3.0</span>
                            @else
                                <span class="text-xs bg-gray-900/40 text-gray-400 border border-gray-800 px-2 py-1 rounded-full">{{ ucfirst($log->token_type) }}</span>
                            @endif
                        </td>
                        <td class="font-mono font-bold text-indigo-300">
                            +{{ number_format($log->token_count, 4) }}
                        </td>
                        <td class="font-mono text-gray-300">
                            {{ $log->token_value ? '₹' . number_format($log->token_value, 4) : '—' }}
                        </td>
                        <td>
                            <span class="text-gray-400 text-sm capitalize">{{ $log->source ?? 'Daily Distribution' }}</span>
                        </td>
                        <td>
                            @if($log->status === 'credited')
                                <span class="badge-credited">Credited</span>
                            @elseif($log->status === 'used')
                                <span class="badge-used">Used</span>
                            @else
                                <span class="badge-pending">{{ ucfirst($log->status ?? 'Pending') }}</span>
                            @endif
                        </td>
                        <td class="text-gray-400 text-sm">
                            {{ $log->credited_date ? $log->credited_date->format('d M Y') : '—' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-16 text-gray-500">
                            <i class="fa-solid fa-coins text-4xl mb-3 block opacity-20"></i>
                            No token distributions recorded yet.<br>
                            <span class="text-xs mt-2 inline-block">Tokens are distributed automatically every day via the Cron Job scheduler.</span>
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

</div>
@endsection