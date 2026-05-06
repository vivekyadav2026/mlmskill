@extends('layouts.admin')
@section('content')
<style>.table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; } .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; text-transform: capitalize; }</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Active Users</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead><tr><th>Name</th><th>Email</th><th>Referral Code</th><th>Status</th><th>Joined</th></tr></thead>
            <tbody>
                @forelse($users as $u)
                <tr>
                    <td class="font-bold">{{ $u->name }}</td>
                    <td><span class="lowercase">{{ $u->email }}</span></td>
                    <td class="text-indigo-400 font-mono">{{ $u->referral_code }}</td>
                    <td><span class="px-2 py-1 text-xs rounded bg-{{ $u->status=='active'?'green':'red' }}-900 text-{{ $u->status=='active'?'green':'red' }}-300">{{ $u->status }}</span></td>
                    <td>{{ $u->created_at->format('M d, Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center p-8 text-gray-500">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[#334155]">{{ $users->links() ?? '' }}</div>
    </div>
</div>
@endsection