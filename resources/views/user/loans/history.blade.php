@extends('layouts.user')
@section('content')
<div class="tailwind-scope mt-4 max-w-[1200px] mx-auto">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-100">My Loan Portfolio</h2>
        <p class="text-gray-400">Manage your active loans and track the status of your recent applications.</p>
    </div>

    <div class="grid grid-cols-1 gap-4">
        @forelse($loans as $loan)
        <div class="bg-[#1a222d] border border-[#334155] rounded-2xl p-6 flex flex-col lg:flex-row justify-between items-center gap-6 group hover:border-green-500/30 transition">
            <div class="flex items-center gap-6 w-full lg:w-auto">
                <div class="w-16 h-16 bg-green-500/10 rounded-2xl flex items-center justify-center text-green-500 text-2xl">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-100 mb-1">{{ $loan->scheme->name }}</h3>
                    <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm">
                        <span class="text-gray-400"><i class="fa-solid fa-money-bill-wave mr-1 text-green-500"></i> Principal: <strong>${{ number_format($loan->amount, 2) }}</strong></span>
                        <span class="text-gray-400"><i class="fa-solid fa-calendar-check mr-1 text-blue-500"></i> Tenure: <strong>{{ $loan->tenure_months }} Mo</strong></span>
                        <span class="text-gray-400"><i class="fa-solid fa-percent mr-1 text-purple-500"></i> Rate: <strong>{{ $loan->scheme->interest_rate }}%</strong></span>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-8 w-full lg:w-auto justify-between lg:justify-end border-t lg:border-t-0 border-[#334155] pt-4 lg:pt-0">
                <div class="text-center lg:text-right">
                    <p class="text-[10px] text-gray-500 uppercase font-bold mb-1">Monthly EMI</p>
                    <p class="text-xl font-bold text-green-400">${{ number_format($loan->monthly_emi, 2) }}</p>
                </div>
                
                <div class="text-center lg:text-right">
                    <p class="text-[10px] text-gray-500 uppercase font-bold mb-1">Current Status</p>
                    <span class="px-3 py-1 text-xs rounded-full font-bold uppercase tracking-wider
                        @if($loan->status == 'pending') bg-yellow-900 text-yellow-300 
                        @elseif($loan->status == 'approved') bg-blue-900 text-blue-300
                        @elseif($loan->status == 'disbursed') bg-green-900 text-green-300
                        @elseif($loan->status == 'active') bg-indigo-900 text-indigo-300
                        @else bg-red-900 text-red-300 @endif">
                        {{ $loan->status }}
                    </span>
                </div>

                @if($loan->admin_remarks)
                <button onclick="alert('Admin Remarks: {{ addslashes($loan->admin_remarks) }}')" class="p-2 text-gray-400 hover:text-white transition" title="View Remarks">
                    <i class="fa-solid fa-circle-info text-2xl"></i>
                </button>
                @endif
            </div>
        </div>
        @empty
        <div class="py-20 text-center bg-[#1a222d] border border-[#334155] rounded-2xl">
            <i class="fa-solid fa-folder-open text-5xl text-gray-600 mb-4"></i>
            <p class="text-gray-400">No loan requests found. <a href="{{ route('user.loans.index') }}" class="text-green-400 hover:underline">Explore Loan Schemes</a></p>
        </div>
        @endforelse
    </div>
</div>
@endsection
