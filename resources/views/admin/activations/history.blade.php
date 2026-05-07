@extends('layouts.admin')
@section('content')
<style>.table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; } .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Payment & Activation History</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead>
                <tr>
                    <th>User Details</th>
                    <th>Payment Info</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Admin Remarks</th>
                    <th>Action Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $req)
                <tr>
                    <td>
                        <div class="font-bold text-gray-200">{{ $req->user->name ?? 'Deleted User' }}</div>
                        <div class="text-xs text-gray-500">{{ $req->user->email ?? '' }}</div>
                    </td>
                    <td>
                        <div class="text-sm font-semibold text-indigo-400">{{ $req->payment_method }}</div>
                        <div class="text-xs text-gray-500 font-mono">Trx: {{ $req->transaction_id }}</div>
                    </td>
                    <td class="font-bold text-green-400">${{ number_format($req->amount, 2) }}</td>
                    <td>
                        @if($req->status == 'approved')
                            <span class="bg-green-900/50 text-green-400 border border-green-500 px-2 py-1 rounded text-xs font-semibold uppercase">Approved</span>
                        @else
                            <span class="bg-red-900/50 text-red-400 border border-red-500 px-2 py-1 rounded text-xs font-semibold uppercase">Rejected</span>
                        @endif
                    </td>
                    <td class="text-sm text-gray-400 max-w-xs truncate" title="{{ $req->remarks }}">{{ $req->remarks ?? 'N/A' }}</td>
                    <td class="text-sm">{{ $req->updated_at->format('M d, Y H:i') }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center p-8 text-gray-500">No history found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[#334155]">{{ $requests->links() ?? '' }}</div>
    </div>
</div>
@endsection