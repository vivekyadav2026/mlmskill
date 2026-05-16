@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-[800px] mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Create New Loan Scheme</h2>
    </div>

    <form action="{{ route('admin.loans.store_scheme') }}" method="POST" class="bg-[#1a222d] border border-[#334155] rounded-xl p-6 space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-400 mb-1">Scheme Name</label>
                <input type="text" name="name" required class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="e.g. Personal Growth Loan">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Min Amount ($)</label>
                <input type="number" name="min_amount" required step="0.01" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="0.00">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Max Amount ($)</label>
                <input type="number" name="max_amount" required step="0.01" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="0.00">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Interest Rate (% p.a.)</label>
                <input type="number" name="interest_rate" required step="0.01" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="0.00">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Max Tenure (Months)</label>
                <input type="number" name="max_tenure_months" required class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="e.g. 24">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Required Rank (Optional)</label>
                <input type="text" name="required_rank" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="e.g. Manager">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1">Scheme Description</label>
            <textarea name="description" rows="4" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="Enter terms, conditions and description..."></textarea>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-[#334155]">
            <a href="{{ route('admin.loans.schemes') }}" class="px-4 py-2 text-gray-400 hover:text-white transition">Cancel</a>
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 shadow-lg shadow-indigo-500/20 transition">Create Scheme</button>
        </div>
    </form>
</div>
@endsection
