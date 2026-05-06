@extends('layouts.user')

@section('content')

<style>
  .app-main { padding: 20px; }
</style>
<div class="tailwind-scope mt-4">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">My Sponsor</h2>
        <p class="text-gray-400">Information about the person who referred you to the system.</p>
    </div>

    <div class="bg-[#1a222d] rounded-lg shadow-lg overflow-hidden border border-[#334155] max-w-2xl mx-auto">
        <div class="p-8 text-center">
            @if($sponsor)
                <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-indigo-500 mb-6 border-4 border-[#0b1220] shadow-xl text-white text-3xl font-bold">
                    {{ substr($sponsor->name, 0, 1) }}
                </div>
                <h3 class="text-2xl font-bold text-white mb-2">{{ $sponsor->name }}</h3>
                <p class="text-indigo-400 font-mono mb-6 text-lg">{{ $sponsor->referral_code }}</p>
                
                <div class="grid grid-cols-2 gap-4 text-left border-t border-[#334155] pt-6">
                    <div>
                        <p class="text-sm text-gray-400">Email Address</p>
                        <p class="font-medium text-gray-200">{{ $sponsor->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400">Status</p>
                        <p class="font-medium text-gray-200">
                            @if($sponsor->status === 'active')
                                <span class="text-green-500"><i class="fa-solid fa-circle-check mr-1"></i> Active</span>
                            @else
                                <span class="text-red-500"><i class="fa-solid fa-circle-xmark mr-1"></i> Inactive</span>
                            @endif
                        </p>
                    </div>
                </div>
            @else
                <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-gray-700 mb-6 text-gray-400 text-4xl">
                    <i class="fa-solid fa-user-slash"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-2">No Sponsor Found</h3>
                <p class="text-gray-400 mb-6">You joined the system without a referral link or your sponsor account was removed.</p>
            @endif
        </div>
    </div>
</div>
@endsection
