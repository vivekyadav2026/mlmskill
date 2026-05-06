@extends('layouts.admin')
@section('content')
<style>.table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; } .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Payment & Activation History</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead><tr><th>User</th><th>Package</th><th>Activated On</th></tr></thead>
            <tbody>
                @forelse($activations as $u)
                <tr>
                    <td class="font-bold">{{ $u->name }} <span class="text-xs text-gray-500 block">{{ $u->email }}</span></td>
                    <td><span class="text-xs bg-indigo-900 text-indigo-300 px-2 py-1 rounded">Course $300</span></td>
                    <td>{{ \Carbon\Carbon::parse($u->activation_date)->format('M d, Y H:i') }}</td>
                </tr>
                @empty
                <tr><td colspan="3" class="text-center p-8 text-gray-500">No history found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[#334155]">{{ $activations->links() ?? '' }}</div>
    </div>
</div>
@endsection