@extends('layouts.admin')
@section('content')
<style>.table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; } .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }</style>

<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Activation Requests</h2>
        <p class="text-gray-400 text-sm">Review user payment proofs for joining fee.</p>
    </div>
    
    @if(session('success'))
        <div class="bg-green-900/40 border border-green-500/50 text-green-300 px-4 py-3 rounded-lg mb-4 flex items-center gap-2">
            <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-900/40 border border-red-500/50 text-red-300 px-4 py-3 rounded-lg mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead>
                <tr>
                    <th>User Details</th>
                    <th>Payment Info</th>
                    <th>Amount</th>
                    <th>Proof</th>
                    <th>Submitted</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $req)
                <tr>
                    <td>
                        <div class="font-bold text-gray-200">{{ $req->user->name ?? 'Deleted User' }}</div>
                        <div class="text-xs text-gray-400">{{ $req->user->email ?? '' }}</div>
                    </td>
                    <td>
                        <div class="font-semibold text-indigo-400">{{ $req->payment_method }}</div>
                        <div class="text-xs text-gray-500 font-mono">Trx: {{ $req->transaction_id }}</div>
                    </td>
                    <td class="font-bold text-green-400">${{ number_format($req->amount, 2) }}</td>
                    <td>
                        @if($req->screenshot)
                        <a href="{{ asset('storage/' . $req->screenshot) }}" target="_blank" class="block w-16 h-16 rounded overflow-hidden border border-gray-600 hover:border-indigo-500 transition">
                            <img src="{{ asset('storage/' . $req->screenshot) }}" alt="Proof" class="w-full h-full object-cover">
                        </a>
                        @else
                        <span class="text-xs text-indigo-400 bg-indigo-900/30 px-2 py-1 rounded font-bold border border-indigo-500/30">
                            <i class="fa-solid fa-paper-plane"></i> Direct Request
                        </span>
                        @endif
                    </td>
                    <td>{{ $req->created_at->diffForHumans() }}</td>
                    <td>
                        <div class="flex gap-2">
                            <form action="{{ route('admin.activations.approve', $req->id) }}" method="POST" onsubmit="return confirm('Approve this payment and activate the user?');">
                                @csrf
                                <button type="submit" class="px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-xs font-bold rounded shadow">Approve</button>
                            </form>
                            
                            <button type="button" onclick="rejectRequest({{ $req->id }})" class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded shadow">Reject</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center p-10 text-gray-500">No pending activation requests.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="hidden fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4">
    <div class="bg-[#1a222d] border border-[#334155] rounded-xl p-6 w-full max-w-md shadow-2xl">
        <h3 class="text-xl font-bold text-white mb-4">Reject Request</h3>
        <form id="rejectForm" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-400 text-sm mb-2">Reason for Rejection</label>
                <textarea name="remarks" rows="3" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded p-2 focus:border-red-500 focus:outline-none" required placeholder="e.g. Transaction ID not found in bank statement..."></textarea>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('rejectModal').classList.add('hidden')" class="px-4 py-2 text-gray-400 hover:text-white">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded">Confirm Rejection</button>
            </div>
        </form>
    </div>
</div>

<script>
function rejectRequest(id) {
    document.getElementById('rejectForm').action = `{{ url('admin/activations/requests') }}/${id}/reject`;
    document.getElementById('rejectModal').classList.remove('hidden');
}
</script>
@endsection