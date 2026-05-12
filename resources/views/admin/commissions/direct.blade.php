@extends('layouts.admin')
@section('content')
<style>
.table-custom th { background:#0f172a; color:#94a3b8; font-weight:600; font-size:0.72rem; text-transform:uppercase; letter-spacing:0.05em; padding:0.75rem 1rem; border-bottom:1px solid #334155; white-space:nowrap; }
.table-custom td { padding:0.85rem 1rem; border-bottom:1px solid #1e293b; color:#e2e8f0; font-size:0.875rem; vertical-align:middle; }
.table-custom tr:hover td { background:rgba(255,255,255,0.03); }
</style>

<div class="tailwind-scope mt-4 max-w-[1400px] mx-auto">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6 flex-wrap gap-3">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">Direct Income Logs</h2>
            <p class="text-gray-400 text-sm mt-1">Commission earned when a direct referral activates their package.</p>
        </div>
        <a href="{{ url('admin/commissions/level') }}"
           class="text-sm text-indigo-400 hover:text-indigo-300 border border-indigo-800 px-4 py-2 rounded transition">
            Level Income Logs <i class="fa-solid fa-arrow-right ml-1"></i>
        </a>
    </div>

    {{-- Stats --}}
    @php $all = \App\Models\CommissionLedger::where('commission_type','direct'); @endphp
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-4 text-center">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Total Records</p>
            <p class="text-2xl font-bold text-white">{{ $logs->total() }}</p>
        </div>
        <div class="bg-[#1a222d] border border-green-900 rounded-lg p-4 text-center">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Total Paid</p>
            <p class="text-2xl font-bold text-green-400">${{ number_format($all->sum('amount'), 2) }}</p>
        </div>
        <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-4 text-center">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Avg Per Entry</p>
            <p class="text-2xl font-bold text-indigo-400">
                ${{ $logs->total() > 0 ? number_format($all->avg('amount'), 2) : '0.00' }}
            </p>
        </div>
        <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-4 text-center">
            <p class="text-gray-400 text-xs uppercase tracking-wider mb-1">Unique Earners</p>
            <p class="text-2xl font-bold text-white">{{ $all->distinct('user_id')->count('user_id') }}</p>
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
                        <th>Earner (Sponsor)</th>
                        <th>From (New Member)</th>
                        <th>Commission</th>
                        <th>Status</th>
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
                            @if($log->fromUser)
                                <a href="{{ url('admin/users/' . $log->from_user_id) }}" class="text-gray-300 hover:text-white">
                                    {{ $log->fromUser->name }}
                                </a><br>
                                <span class="text-gray-500 text-xs">{{ $log->fromUser->referral_code ?? '' }}</span>
                            @else
                                <span class="text-gray-500">—</span>
                            @endif
                        </td>
                        <td>
                            <span class="text-green-400 font-mono font-bold text-base">+${{ number_format($log->amount, 2) }}</span>
                        </td>
                        <td>
                            @php $status = $log->status ?? 'credited'; @endphp
                            @if($status === 'credited')
                                <span class="text-xs bg-green-500/15 text-green-400 border border-green-700/40 px-2 py-1 rounded-full">Credited</span>
                            @else
                                <span class="text-xs bg-gray-500/15 text-gray-400 border border-gray-600 px-2 py-1 rounded-full">{{ ucfirst($status) }}</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-16 text-gray-500">
                            <i class="fa-solid fa-hand-holding-dollar text-4xl mb-3 block opacity-20"></i>
                            No direct income recorded yet.<br>
                            <span class="text-xs mt-2 inline-block">Direct income is triggered when a referred user purchases an activation package.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($logs->hasPages())
        <div class="p-4 border-t border-[#334155] flex justify-center">
            {{ $logs->links() }}
        </div>
        @endif
    </div>
</div>
@endsection