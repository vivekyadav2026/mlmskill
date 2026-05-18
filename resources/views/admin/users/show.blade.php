@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-[1000px] mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-100">User Details</h2>
        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600">Back to Users</a>
    </div>

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6">
        <!-- Profile Header -->
        <div class="flex items-center gap-6 mb-8 border-b border-[#334155] pb-6">
            <div class="w-24 h-24 rounded-full border-4 border-[#334155] overflow-hidden bg-gray-800">
                @if($user->profile_image)
                    <img src="{{ asset($user->profile_image) }}" alt="Photo" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-3xl font-bold text-gray-500">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                @endif
            </div>
            <div>
                <h3 class="text-3xl font-bold text-gray-100">{{ $user->name }}</h3>
                <p class="text-indigo-400 font-mono text-lg mb-2">{{ $user->referral_code }}</p>
                <span class="px-3 py-1 text-xs rounded-full bg-{{ $user->status=='active'?'green':'red' }}-900/50 text-{{ $user->status=='active'?'green':'red' }}-400 border border-{{ $user->status=='active'?'green':'red' }}-500 uppercase tracking-wide">{{ $user->status }}</span>
                @php 
                    $rank = app(\App\Services\BonusService::class)->getCurrentRank($user);
                @endphp
                <span class="ml-2 px-3 py-1 text-xs rounded-full border" style="background-color: {{ $rank['current_color'] }}22; color: {{ $rank['current_color'] }}; border-color: {{ $rank['current_color'] }}44;">
                    <i class="fa-solid fa-trophy mr-1 text-[10px]"></i> {{ $rank['current_rank'] }}
                </span>
                @if($user->role === 'admin')
                    <span class="ml-2 px-3 py-1 text-xs rounded-full bg-blue-900/50 text-blue-400 border border-blue-500 uppercase tracking-wide">Admin</span>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Personal Information -->
            <div class="bg-[#0f172a] p-5 rounded-lg border border-[#334155]">
                <h4 class="text-lg font-bold text-gray-200 mb-4 flex items-center"><i class="fa-solid fa-address-card mr-2 text-indigo-400"></i> Personal Info</h4>
                <div class="space-y-4">
                    <div><p class="text-gray-500 text-xs uppercase tracking-wider mb-1">Email</p><p class="text-gray-200 break-all">{{ $user->email }}</p></div>
                    <div><p class="text-gray-500 text-xs uppercase tracking-wider mb-1">Phone</p><p class="text-gray-200">{{ $user->phone ?? 'Not provided' }}</p></div>
                    <div><p class="text-gray-500 text-xs uppercase tracking-wider mb-1">Gender</p><p class="text-gray-200 capitalize">{{ $user->gender ?? 'Not provided' }}</p></div>
                    <div><p class="text-gray-500 text-xs uppercase tracking-wider mb-1">Address</p>
                        <p class="text-gray-200">
                            {{ $user->address ?? 'N/A' }}<br>
                            {{ $user->city ? $user->city . ',' : '' }} {{ $user->state ?? '' }} {{ $user->zip ?? '' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Account Details -->
            <div class="bg-[#0f172a] p-5 rounded-lg border border-[#334155]">
                <h4 class="text-lg font-bold text-gray-200 mb-4 flex items-center"><i class="fa-solid fa-shield-halved mr-2 text-indigo-400"></i> Account Data</h4>
                <div class="space-y-4">
                    <div><p class="text-gray-500 text-xs uppercase tracking-wider mb-1">Sponsor ID</p><p class="text-gray-200 font-mono">{{ $user->sponsor_id ?? 'None' }}</p></div>
                    <div><p class="text-gray-500 text-xs uppercase tracking-wider mb-1">Registration Date</p><p class="text-gray-200">{{ $user->created_at->format('M d, Y h:i A') }}</p></div>
                    <div><p class="text-gray-500 text-xs uppercase tracking-wider mb-1">Activation Date</p><p class="text-gray-200">{{ $user->activation_date ? $user->activation_date->format('M d, Y h:i A') : 'Pending' }}</p></div>
                    <div><p class="text-gray-500 text-xs uppercase tracking-wider mb-1">Course Completion</p><p class="text-gray-200">{{ $user->course_completed_at ? $user->course_completed_at->format('M d, Y') : 'Incomplete' }}</p></div>
                </div>
            </div>

            <!-- Financials / Wallets -->
            <div class="bg-[#0f172a] p-5 rounded-lg border border-[#334155]">
                <h4 class="text-lg font-bold text-gray-200 mb-4 flex items-center"><i class="fa-solid fa-wallet mr-2 text-indigo-400"></i> Wallets</h4>
                <div class="space-y-4">
                    <div class="flex justify-between items-center border-b border-[#334155] pb-2">
                        <span class="text-gray-400 text-sm">Package Wallet</span>
                        <span class="text-gray-100 font-bold">${{ number_format($user->wallet->package_wallet ?? 0, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-[#334155] pb-2">
                        <span class="text-gray-400 text-sm">Income Wallet</span>
                        <span class="text-green-400 font-bold">${{ number_format($user->wallet->income_wallet ?? 0, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-[#334155] pb-2">
                        <span class="text-gray-400 text-sm">NEXA 1.0</span>
                        <span class="text-indigo-400 font-bold">{{ number_format($user->wallet->utility_token_wallet ?? 0, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-[#334155] pb-2">
                        <span class="text-gray-400 text-sm">NEXA 2.0</span>
                        <span class="text-orange-400 font-bold">{{ number_format($user->wallet->renewal_token_wallet ?? 0, 2) }}</span>
                    </div>
                </div>
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
