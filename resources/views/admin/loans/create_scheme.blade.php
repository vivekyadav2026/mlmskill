@extends('layouts.admin')
@section('content')

<div class="tailwind-scope mt-4 w-full max-w-[800px] mx-auto px-3 sm:px-4">

    {{-- Header --}}
    <div class="mb-5 flex items-center gap-3">
        <a href="{{ route('admin.loans.schemes') }}"
           class="text-gray-400 hover:text-white transition p-1.5 rounded-lg hover:bg-white/10">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-100">Create New Loan Scheme</h2>
            <p class="text-gray-500 text-xs mt-0.5">Define terms, limits and interest for this scheme.</p>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="flex items-center gap-2 bg-green-500/10 border border-green-700 text-green-400 p-3 rounded-lg mb-4 text-sm">
            <i class="fa-solid fa-circle-check flex-shrink-0"></i> {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="bg-red-500/10 border border-red-700 text-red-400 p-3 rounded-lg mb-4 text-sm">
            <i class="fa-solid fa-triangle-exclamation mr-1"></i>
            <ul class="mt-1 list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.loans.store_scheme') }}" method="POST"
          class="bg-[#1a222d] border border-[#334155] rounded-xl p-4 sm:p-6 space-y-4">
        @csrf

        {{-- Scheme Name — full width always --}}
        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1">
                Scheme Name <span class="text-red-400">*</span>
            </label>
            <input type="text" name="name" required value="{{ old('name') }}"
                   class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2.5 text-white
                          placeholder-gray-600 focus:outline-none focus:ring-1 focus:ring-indigo-500 text-sm"
                   placeholder="e.g. Personal Growth Loan">
        </div>

        {{-- 2-col grid — stacks to 1-col on mobile --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">
                    Min Amount (₹) <span class="text-red-400">*</span>
                </label>
                <input type="number" name="min_amount" required step="0.01" min="0"
                       value="{{ old('min_amount') }}"
                       class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2.5 text-white
                              placeholder-gray-600 focus:outline-none focus:ring-1 focus:ring-indigo-500 text-sm"
                       placeholder="0.00">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">
                    Max Amount (₹) <span class="text-red-400">*</span>
                </label>
                <input type="number" name="max_amount" required step="0.01" min="0"
                       value="{{ old('max_amount') }}"
                       class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2.5 text-white
                              placeholder-gray-600 focus:outline-none focus:ring-1 focus:ring-indigo-500 text-sm"
                       placeholder="0.00">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">
                    Interest Rate (% p.a.) <span class="text-red-400">*</span>
                </label>
                <input type="number" name="interest_rate" required step="0.01" min="0"
                       value="{{ old('interest_rate') }}"
                       class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2.5 text-white
                              placeholder-gray-600 focus:outline-none focus:ring-1 focus:ring-indigo-500 text-sm"
                       placeholder="e.g. 12.50">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">
                    Max Tenure (Months) <span class="text-red-400">*</span>
                </label>
                <input type="number" name="max_tenure_months" required min="1"
                       value="{{ old('max_tenure_months') }}"
                       class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2.5 text-white
                              placeholder-gray-600 focus:outline-none focus:ring-1 focus:ring-indigo-500 text-sm"
                       placeholder="e.g. 24">
            </div>

            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-400 mb-1">
                    Required Rank
                    <span class="text-gray-600 font-normal">(Optional)</span>
                </label>
                <input type="text" name="required_rank" value="{{ old('required_rank') }}"
                       class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2.5 text-white
                              placeholder-gray-600 focus:outline-none focus:ring-1 focus:ring-indigo-500 text-sm"
                       placeholder="e.g. Manager, Diamond">
            </div>

        </div>

        {{-- Description — full width --}}
        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1">Scheme Description</label>
            <textarea name="description" rows="4"
                      class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2.5 text-white
                             placeholder-gray-600 focus:outline-none focus:ring-1 focus:ring-indigo-500 text-sm resize-y"
                      placeholder="Enter terms, conditions and description...">{{ old('description') }}</textarea>
        </div>

        {{-- Buttons — stack on mobile --}}
        <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-4 border-t border-[#334155]">
            <a href="{{ route('admin.loans.schemes') }}"
               class="w-full sm:w-auto text-center px-5 py-2.5 text-gray-400 hover:text-white border border-[#334155]
                      hover:border-gray-500 rounded-lg transition text-sm">
                Cancel
            </a>
            <button type="submit"
                    class="w-full sm:w-auto px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold
                           rounded-lg shadow-lg shadow-indigo-500/20 transition text-sm flex items-center justify-center gap-2">
                <i class="fa-solid fa-plus"></i> Create Scheme
            </button>
        </div>

    </form>
</div>
@endsection
