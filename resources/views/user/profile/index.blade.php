@extends('layouts.user')

@section('content')

<style>
  .app-main { padding: 20px; }
</style>
<div class="tailwind-scope mt-4 max-w-4xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">My Profile</h2>
            <p class="text-gray-400">View your account details and current status.</p>
        </div>
        <a href="{{ url('user/profile/edit') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow transition">
            <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Profile
        </a>
    </div>

    <div class="bg-[#1a222d] rounded-lg shadow-lg overflow-hidden border border-[#334155] mb-6">
        <div class="p-8">
            <div class="flex items-center space-x-6 border-b border-[#334155] pb-8">
                <div class="h-24 w-24 rounded-full bg-indigo-500 flex items-center justify-center text-white text-4xl font-bold border-4 border-[#0b1220] shadow-xl">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div>
                    <h3 class="text-3xl font-bold text-white mb-2">{{ auth()->user()->name }}</h3>
                    <p class="text-indigo-400 font-mono text-lg mb-2">Referral Code: {{ auth()->user()->referral_code }}</p>
                    <p class="text-sm text-gray-400">Joined {{ auth()->user()->created_at->format('F d, Y') }}</p>
                </div>
                <div class="ml-auto text-right">
                    @if(auth()->user()->status === 'active')
                        <span class="bg-green-500/20 text-green-400 border border-green-500/50 px-4 py-2 rounded-full font-bold text-sm tracking-wide uppercase shadow-[0_0_15px_rgba(34,197,94,0.3)]">
                            <i class="fa-solid fa-bolt text-green-400 mr-1"></i> Active Account
                        </span>
                    @else
                        <span class="bg-red-500/20 text-red-400 border border-red-500/50 px-4 py-2 rounded-full font-bold text-sm tracking-wide uppercase">
                            <i class="fa-solid fa-circle-exclamation text-red-400 mr-1"></i> Inactive Account
                        </span>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-8">
                <div>
                    <p class="text-sm text-gray-500 mb-1 uppercase tracking-wide">Email Address</p>
                    <p class="font-medium text-gray-200 text-lg">{{ auth()->user()->email }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1 uppercase tracking-wide">Sponsor ID</p>
                    <p class="font-medium text-gray-200 text-lg">{{ auth()->user()->sponsor_id ?? 'None' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1 uppercase tracking-wide">Account Status</p>
                    <p class="font-medium text-gray-200 text-lg capitalize">{{ auth()->user()->status }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1 uppercase tracking-wide">Activation Date</p>
                    <p class="font-medium text-gray-200 text-lg">{{ auth()->user()->activated_at ? \Carbon\Carbon::parse(auth()->user()->activated_at)->format('F d, Y h:i A') : 'Not Activated' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
