@extends('layouts.user')
@section('content')
<style>.table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; } .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }</style>
<div class="tailwind-scope mt-4"><h2 class="text-2xl font-bold text-gray-100 mb-6">Withdrawal History</h2>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom"><thead><tr><th>Date</th><th>Amount</th><th>Status</th></tr></thead>
        <tbody>@forelse($withdrawals as $w) <tr><td>{{ $w->created_at->format('M d, Y') }}</td><td class="font-bold text-gray-200">$\{{ number_format($w->amount, 2) }}</td><td><span class="text-xs px-2 py-1 rounded bg-{{ $w->status=='approved'?'green':'yellow' }}-900 text-{{ $w->status=='approved'?'green':'yellow' }}-300">{{ ucfirst($w->status) }}</span></td></tr> @empty <tr><td colspan="3" class="text-center p-8 text-gray-500">No withdrawals yet</td></tr> @endforelse</tbody></table>
        <div class="p-4 border-t border-[#334155]">{{ $withdrawals->links() }}</div>
    </div>
</div>
@endsection