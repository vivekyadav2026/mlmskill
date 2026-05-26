@extends('layouts.admin')
@section('content')
<style>.table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; } .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Pending Withdrawals</h2></div>
    @if(session('success')) <div class="bg-green-500/10 text-green-400 p-4 rounded mb-4">{{ session('success') }}</div> @endif
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead><tr><th>User</th><th>Requested Amount</th><th>Charges</th><th>Net Payable</th><th>Status</th><th>Requested At</th><th>Action</th></tr></thead>
            <tbody>
                @forelse($withdrawals as $w)
                @php 
                    $chargePct = (float) \App\Models\Setting::get('withdrawal_charge_pct', 5);
                    $charge = $w->amount * ($chargePct / 100);
                    $net = $w->amount - $charge;
                @endphp
                <tr>
                    <td class="font-bold">{{ $w->user->name ?? 'Unknown' }}</td>
                    <td class="font-bold text-gray-300">${{ number_format($w->amount, 2) }}</td>
                    <td class="text-red-400 font-semibold">${{ number_format($charge, 2) }} <span class="text-[10px] text-gray-500">({{ $chargePct }}%)</span></td>
                    <td class="font-bold text-green-400">${{ number_format($net, 2) }}</td>
                    <td><span class="px-2 py-1 text-xs rounded capitalize bg-{{ $w->status=='approved'?'green':($w->status=='rejected'?'red':'yellow') }}-900 text-{{ $w->status=='approved'?'green':($w->status=='rejected'?'red':'yellow') }}-300">{{ $w->status }}</span></td>
                    <td>{{ $w->created_at->format('M d, Y H:i') }}</td>
                    <td>
                        @if($w->status === 'pending')
                        <div class="flex gap-2">
                            <form method="POST" action="{{ url('admin/withdrawals/'.$w->id.'/approve') }}">@csrf<button class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs shadow"><i class="fa-solid fa-check"></i> Approve</button></form>
                            <form method="POST" action="{{ url('admin/withdrawals/'.$w->id.'/reject') }}">@csrf<button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs shadow"><i class="fa-solid fa-xmark"></i> Reject</button></form>
                        </div>
                        @else
                        <span class="text-gray-500 text-xs italic">Processed</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center p-8 text-gray-500">No withdrawals found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[#334155]">{{ $withdrawals->links() ?? '' }}</div>
    </div>
</div>
@endsection