@extends('layouts.user')

@section('content')
<div class="tailwind-scope mt-4 max-w-4xl mx-auto">
    
    @if(session('success'))
        <div class="bg-green-900/40 border border-green-500/50 text-green-300 px-4 py-3 rounded-lg mb-4 flex items-center gap-2">
            <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-900/40 border border-red-500/50 text-red-300 px-4 py-3 rounded-lg mb-4">
            {{ session('error') }}
        </div>
    @endif
    @if($errors->any())
        <div class="bg-red-900/40 border border-red-500/50 text-red-300 px-4 py-3 rounded-lg mb-4 text-sm">
            <ul class="list-disc ml-4 space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- Left: Status & Bank Details -->
        <!-- <div>   -->
            <!-- <div class="bg-[#1a222d] border border-red-500/50 rounded-xl p-8 shadow-lg mb-6 text-center">
                <div class="w-20 h-20 bg-red-500/10 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-lock text-3xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-white mb-2">Account Inactive</h2>
                <div class="inline-block bg-indigo-900/30 border border-indigo-500/30 text-indigo-300 px-5 py-2 rounded-lg font-bold text-xl">
                    Joining Fee: ${{ number_format($fee, 2) }}
                </div>
            </div> -->

            <!-- Bank Details from Settings -->
            <!-- <div class="bg-[#1a222d] border border-[#334155] rounded-xl p-6 shadow-lg">
                <h3 class="text-lg font-semibold text-white mb-4 border-b border-[#334155] pb-2">
                    <i class="fa-solid fa-building-columns text-green-400 mr-2"></i> Payment Details
                </h3>
                
                @if(!empty($settings['bank_name']))
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between border-b border-[#334155] pb-2">
                        <span class="text-gray-400">Bank Name</span>
                        <span class="text-gray-200 font-semibold">{{ $settings['bank_name'] }}</span>
                    </div>
                    <div class="flex justify-between border-b border-[#334155] pb-2">
                        <span class="text-gray-400">Account Name</span>
                        <span class="text-gray-200 font-semibold">{{ $settings['bank_account_name'] ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between border-b border-[#334155] pb-2">
                        <span class="text-gray-400">Account Number</span>
                        <span class="text-gray-200 font-mono">{{ $settings['bank_account_number'] ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between border-b border-[#334155] pb-2">
                        <span class="text-gray-400">IFSC / Routing</span>
                        <span class="text-gray-200 font-mono">{{ $settings['bank_ifsc'] ?? 'N/A' }}</span>
                    </div>
                </div>
                @else
                <div class="text-gray-500 text-sm text-center py-4">
                    Bank details have not been configured by the admin yet.
                </div>
                @endif
                
                @if(!empty($settings['upi_id']))
                <div class="mt-4 pt-4 border-t border-[#334155]">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400 text-sm">UPI ID</span>
                        <span class="text-gray-200 font-mono text-sm bg-black/30 px-3 py-1 rounded">{{ $settings['upi_id'] }}</span>
                    </div>
                </div>
                @endif
            </div> -->
        <!-- </div> -->

        <!-- Right: Simple Activation Request -->
        <div class="bg-[#1a222d] border border-[#334155] rounded-xl p-8 shadow-lg h-full flex flex-col justify-center text-center">
            
            @if($pendingRequest)
                <div class="mb-6">
                    <div class="w-16 h-16 bg-yellow-500/20 text-yellow-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-hourglass-half text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Verification Pending</h3>
                    <p class="text-gray-400 mb-4">Your activation request has been submitted successfully. Please wait while our admin team reviews and approves your account.</p>
                    <div class="bg-yellow-900/30 border border-yellow-500/30 text-yellow-300 px-4 py-2 rounded font-mono text-sm inline-block">
                        ID: {{ $pendingRequest->transaction_id }}
                    </div>
                </div>
            @else
                <div class="mb-6">
                    <div class="w-16 h-16 bg-indigo-500/20 text-indigo-400 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-paper-plane text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Request Account Activation</h3>
                    <p class="text-gray-400 mb-6">Click the button below to notify the admin to review and activate your account.</p>
                    
                    <form action="{{ route('user.activate.submit') }}" method="POST" onsubmit="return confirm('Submit activation request to Admin?');">
                        @csrf
                        <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg transition shadow-lg text-lg flex justify-center items-center gap-2">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i> Send Activation Request
                        </button>
                    </form>
                </div>
            @endif
            
            <div class="mt-auto pt-6 border-t border-[#334155]">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-gray-400 hover:text-white text-sm transition">
                        <i class="fa-solid fa-arrow-right-from-bracket mr-1"></i> Logout from account
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
