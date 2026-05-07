@extends('layouts.admin')
@section('content')
<style>.table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; } .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; text-transform: capitalize; }</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">All Users</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead><tr><th>Name</th><th>Email</th><th>Referral Code</th><th>Status</th><th>Time Track</th><th>Joined</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($users as $u)
                <tr>
                    <td class="font-bold">{{ $u->name }}</td>
                    <td><span class="lowercase">{{ $u->email }}</span></td>
                    <td class="text-indigo-400 font-mono">{{ $u->referral_code }}</td>
                    <td><span class="px-2 py-1 text-xs rounded bg-{{ $u->status=='active'?'green':'red' }}-900 text-{{ $u->status=='active'?'green':'red' }}-300">{{ $u->status }}</span></td>
                    <td>
                        @php
                            $time = $u->total_time_spent;
                            $h = floor($time / 3600);
                            $m = floor(($time % 3600) / 60);
                            $timeStr = $h > 0 ? "{$h}h {$m}m" : "{$m}m";
                            $isOnline = $u->last_seen_at && $u->last_seen_at->diffInMinutes(now()) < 5;
                        @endphp
                        <div class="flex items-center gap-2">
                            @if($isOnline)
                                <span class="relative flex h-2.5 w-2.5">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
                                </span>
                                <span class="text-xs text-green-400 font-semibold">Online</span>
                            @else
                                <span class="h-2.5 w-2.5 rounded-full bg-gray-600"></span>
                                <span class="text-xs text-gray-500">Offline</span>
                            @endif
                        </div>
                        <span class="text-xs text-indigo-300 block mt-1"><i class="fa-regular fa-clock"></i> {{ $timeStr }}</span>
                    </td>
                    <td>{{ $u->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.users.show', $u->id) }}" class="p-1 text-blue-400 hover:text-blue-300" title="View"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('admin.users.edit', $u->id) }}" class="p-1 text-yellow-400 hover:text-yellow-300" title="Edit"><i class="fa-solid fa-pen"></i></a>
                            <form action="{{ route('admin.users.status', $u->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="p-1 {{ $u->status == 'active' ? 'text-orange-400 hover:text-orange-300' : 'text-green-400 hover:text-green-300' }}" title="{{ $u->status == 'active' ? 'Deactivate' : 'Activate' }}">
                                    <i class="fa-solid {{ $u->status == 'active' ? 'fa-ban' : 'fa-check' }}"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                <button type="submit" class="p-1 text-red-400 hover:text-red-300" title="Delete"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center p-8 text-gray-500">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[#334155]">{{ $users->links() ?? '' }}</div>
    </div>
</div>
@endsection