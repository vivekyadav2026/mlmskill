@extends('layouts.admin')
@section('content')
<style>
    .table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; }
    .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }
</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Loan Applications</h2>
        <p class="text-gray-400">Manage and process loan requests from platform members.</p>
    </div>

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead>
                <tr>
                    <th>Member</th>
                    <th>Scheme</th>
                    <th>Requested</th>
                    <th>Tenure</th>
                    <th>Monthly EMI</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $loan)
                <tr>
                    <td>
                        <div class="font-bold text-gray-100">{{ $loan->user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $loan->user->referral_code }}</div>
                    </td>
                    <td>
                        <div class="font-medium text-indigo-400">{{ $loan->scheme->name }}</div>
                        <div class="text-[10px] text-gray-500">{{ $loan->scheme->interest_rate }}% Interest</div>
                    </td>
                    <td class="font-bold text-gray-100">${{ number_format($loan->amount, 2) }}</td>
                    <td>{{ $loan->tenure_months }} Months</td>
                    <td class="text-green-400 font-bold">${{ number_format($loan->monthly_emi, 2) }}</td>
                    <td>
                        <span class="px-2 py-1 text-[10px] rounded uppercase font-bold 
                            @if($loan->status == 'pending') bg-yellow-900 text-yellow-300 
                            @elseif($loan->status == 'approved') bg-blue-900 text-blue-300
                            @elseif($loan->status == 'disbursed') bg-green-900 text-green-300
                            @elseif($loan->status == 'active') bg-indigo-900 text-indigo-300
                            @else bg-red-900 text-red-300 @endif">
                            {{ $loan->status }}
                        </span>
                    </td>
                    <td>
                        <button onclick="openLoanModal({{ $loan->id }}, '{{ $loan->status }}', '{{ addslashes($loan->admin_remarks) }}')" class="px-3 py-1 bg-gray-800 text-gray-300 border border-gray-700 rounded text-xs hover:bg-gray-700 transition">Manage</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-8 text-gray-500">No loan requests found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[#334155]">
            {{ $requests->links() }}
        </div>
    </div>
</div>

<!-- Loan Update Modal -->
<div id="loanModal" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-[#1a222d] border border-[#334155] rounded-xl w-full max-w-md overflow-hidden">
        <div class="px-6 py-4 border-b border-[#334155] flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-100">Manage Loan Request</h3>
            <button onclick="closeLoanModal()" class="text-gray-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <form id="loanForm" method="POST" action="">
            @csrf
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Status</label>
                    <select name="status" id="loanStatus" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white">
                        <option value="pending">Pending</option>
                        <option value="approved">Approve Application</option>
                        <option value="rejected">Reject Application</option>
                        <option value="disbursed">Disburse Amount</option>
                        <option value="active">Mark as Active</option>
                        <option value="closed">Close Loan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Admin Remarks</label>
                    <textarea name="admin_remarks" id="loanRemarks" rows="4" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white" placeholder="Notes for the user..."></textarea>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-[#334155] bg-[#0f172a] flex justify-end gap-3">
                <button type="button" onclick="closeLoanModal()" class="px-4 py-2 text-gray-400 hover:text-white transition">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Update Request</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openLoanModal(id, status, remarks) {
        document.getElementById('loanForm').action = "/admin/loans/requests/" + id + "/update";
        document.getElementById('loanStatus').value = status;
        document.getElementById('loanRemarks').value = remarks;
        document.getElementById('loanModal').classList.remove('hidden');
    }
    function closeLoanModal() {
        document.getElementById('loanModal').classList.add('hidden');
    }
</script>
@endsection
