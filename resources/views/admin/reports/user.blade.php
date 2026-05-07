@extends('layouts.admin')

@section('content')
<style>
  .table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; }
  .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }
</style>

<div class="tailwind-scope mt-4 max-w-[1400px] mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">User Activity Reports</h2>
            <p class="text-gray-400 text-sm">Comprehensive platform user registry</p>
        </div>
        <div class="flex gap-4">
            <div class="bg-[#1a222d] border border-green-500/30 px-6 py-3 rounded-lg shadow">
                <span class="text-gray-400 text-sm block">Active Members</span>
                <span class="text-2xl font-bold text-green-400">{{ $totalActive }}</span>
            </div>
            <div class="bg-[#1a222d] border border-red-500/30 px-6 py-3 rounded-lg shadow">
                <span class="text-gray-400 text-sm block">Inactive Members</span>
                <span class="text-2xl font-bold text-red-400">{{ $totalInactive }}</span>
            </div>
        </div>
    </div>

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden shadow-lg">
        <table class="w-full table-custom">
            <thead>
                <tr>
                    <th>Joined Date</th>
                    <th>User / Referral Code</th>
                    <th>Sponsor</th>
                    <th>Wallet Balance</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr class="hover:bg-[#1e293b] transition">
                    <td class="text-gray-400">{{ $user->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="font-medium text-gray-200">{{ $user->name }}</div>
                        <div class="text-xs text-indigo-400 font-mono">{{ $user->referral_code }}</div>
                    </td>
                    <td class="text-gray-400 text-sm">{{ $user->sponsor->name ?? 'Direct' }}</td>
                    <td class="font-bold text-green-400">${{ number_format($user->wallet->balance ?? 0, 2) }}</td>
                    <td>
                        @if($user->status == 'active')
                            <span class="bg-green-900/50 border border-green-500/50 text-green-400 px-2 py-1 rounded text-xs font-medium">Active</span>
                        @else
                            <span class="bg-red-900/50 border border-red-500/50 text-red-400 px-2 py-1 rounded text-xs font-medium">Inactive</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center p-12 text-gray-500">
                        <i class="fa-solid fa-users text-4xl mb-3 block text-gray-600"></i>
                        No users registered yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4 flex justify-end">{{ $users->links('pagination::tailwind') }}</div>
</div>
@endsection