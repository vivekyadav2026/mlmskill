@extends('layouts.admin')
@section('content')
<style>.table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; } .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100 capitalize">level Income Logs</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead><tr><th>User</th><th>Amount</th><th>Details</th><th>Date</th></tr></thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td class="font-bold">{{ $log->user->name ?? 'System' }}</td>
                    <td class="text-green-400 font-mono">+${{ number_format($log->amount, 2) }}</td>
                    <td class="text-gray-400 text-sm">{{ $log->details ?? 'Commission payout' }}</td>
                    <td>{{ $log->created_at->format('M d, Y H:i') }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center p-8 text-gray-500">No commissions recorded.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[#334155]">{{ $logs->links() ?? '' }}</div>
    </div>
</div>
@endsection