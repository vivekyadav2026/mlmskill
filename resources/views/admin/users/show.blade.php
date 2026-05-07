@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-[1000px] mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-100">User Details</h2>
        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600">Back to Users</a>
    </div>

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-gray-400 text-sm mb-1">Name</p>
                <p class="text-gray-100 font-semibold text-lg">{{ $user->name }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-sm mb-1">Email</p>
                <p class="text-gray-100 font-semibold text-lg lowercase">{{ $user->email }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-sm mb-1">Referral Code</p>
                <p class="text-indigo-400 font-mono text-lg">{{ $user->referral_code }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-sm mb-1">Status</p>
                <span class="px-2 py-1 text-sm rounded bg-{{ $user->status=='active'?'green':'red' }}-900 text-{{ $user->status=='active'?'green':'red' }}-300 capitalize">{{ $user->status }}</span>
            </div>
            <div>
                <p class="text-gray-400 text-sm mb-1">Joined Date</p>
                <p class="text-gray-100">{{ $user->created_at->format('M d, Y h:i A') }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-sm mb-1">Sponsor ID</p>
                <p class="text-gray-100">{{ $user->sponsor_id ?? 'N/A' }}</p>
            </div>
        </div>
        
        <div class="mt-8 border-t border-[#334155] pt-6 flex gap-4">
            <a href="{{ route('admin.users.edit', $user->id) }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700"><i class="fa-solid fa-pen mr-2"></i> Edit User</a>
            <form action="{{ route('admin.users.status', $user->id) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2 {{ $user->status == 'active' ? 'bg-orange-600 hover:bg-orange-700' : 'bg-green-600 hover:bg-green-700' }} text-white rounded">
                    <i class="fa-solid {{ $user->status == 'active' ? 'fa-ban' : 'fa-check' }} mr-2"></i> {{ $user->status == 'active' ? 'Deactivate' : 'Activate' }} User
                </button>
            </form>
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700"><i class="fa-solid fa-trash mr-2"></i> Delete User</button>
            </form>
        </div>
    </div>
</div>
@endsection
