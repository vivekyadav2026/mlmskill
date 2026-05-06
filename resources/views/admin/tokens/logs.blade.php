@extends('layouts.admin')
@section('content')
<style>.table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; } .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Token Distribution Logs</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead><tr><th>User</th><th>Token Type</th><th>Amount</th><th>Date</th></tr></thead>
            <tbody>
                @forelse($logs as $log)
                <tr>
                    <td class="font-bold">{{ $log->user->name ?? 'System' }}</td>
                    <td><span class="text-xs uppercase bg-gray-800 border border-gray-600 px-2 py-1 rounded">{{ $log->token_type }}</span></td>
                    <td class="text-indigo-400 font-mono">+{{ number_format($log->token_count, 2) }}</td>
                    <td>{{ $log->created_at->format('M d, Y H:i') }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center p-8 text-gray-500">No tokens minted.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[#334155]">{{ $logs->links() ?? '' }}</div>
    </div>
</div>
@endsection