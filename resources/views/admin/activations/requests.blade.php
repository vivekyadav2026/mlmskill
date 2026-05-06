@extends('layouts.admin')
@section('content')
<style>.table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; } .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Activation Requests (Payment Proofs)</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead><tr><th>User</th><th>Transaction ID</th><th>Proof Image</th><th>Status</th><th>Action</th></tr></thead>
            <tbody>
                @forelse($requests as $req)
                <tr>
                    <td>{{ $req->user->name }}</td>
                    <td class="font-mono text-indigo-400">{{ $req->txn_id }}</td>
                    <td><a href="#" class="text-blue-400 hover:underline">View Receipt</a></td>
                    <td><span class="bg-yellow-900 text-yellow-300 px-2 py-1 rounded text-xs">Pending</span></td>
                    <td>
                        <button class="bg-green-600 text-white px-2 py-1 rounded text-xs">Approve</button>
                        <button class="bg-red-600 text-white px-2 py-1 rounded text-xs">Reject</button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center p-8 text-gray-500">No pending activation requests. All clear!</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection