@extends('layouts.admin')

@section('content')
<div class="tailwind-scope mt-4 max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6 flex-wrap gap-3">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">Process Closing Report</h2>
            <p class="text-gray-400 text-sm">Finalize statements for the current period</p>
        </div>
        <a href="{{ route('admin.closing.history') }}" class="px-4 py-2 bg-[#334155] hover:bg-[#475569] text-white rounded shadow transition"><i class="fa-solid fa-clock-rotate-left mr-1"></i> View History</a>
    </div>

    @if(session('error'))
        <div class="bg-red-900 border border-red-500 text-red-300 px-4 py-3 rounded relative mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Date Filter Form -->
    <!-- <form method="GET" action="{{ url('admin/closing/generate') }}" class="bg-[#1a222d] border border-[#334155] rounded-xl p-6 shadow-xl mb-6">
        <h3 class="text-gray-200 font-bold mb-4 flex items-center border-b border-[#334155] pb-2">
            <i class="fa-solid fa-calendar-days text-indigo-500 mr-2"></i> Select Date Range
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <div>
                <label class="block text-gray-400 text-sm mb-2">Start Date</label>
                <input type="date" name="start_date" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" value="{{ $startDateInput }}" required>
            </div>
            <div>
                <label class="block text-gray-400 text-sm mb-2">End Date</label>
                <input type="date" name="end_date" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" value="{{ $endDateInput }}" required>
            </div>
            <div>
                <button type="submit" class="w-full px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg transition">
                    <i class="fa-solid fa-arrows-rotate mr-1"></i> Update Preview
                </button>
            </div>
        </div>
    </form> -->

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Preview Data -->
        <div class="bg-[#1a222d] border border-[#334155] rounded-xl p-6 shadow-xl">
            <h3 class="text-gray-200 font-bold mb-4 flex items-center border-b border-[#334155] pb-2">
                <i class="fa-solid fa-magnifying-glass-chart text-indigo-500 mr-2"></i> Selected Period Preview
            </h3>
            
            <div class="space-y-4">
                <div class="flex justify-between items-center border-b border-[#334155]/30 pb-2">
                    <span class="text-gray-400 text-sm">Period</span>
                    <span class="text-indigo-300 font-mono text-xs">{{ $startDateInput }} to {{ $endDateInput }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-400 text-sm">Active Users</span>
                    <span class="text-white font-medium">{{ number_format($preview['total_active_users']) }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-400 text-sm">Total Income Generated</span>
                    <span class="text-green-400 font-bold">${{ number_format($preview['total_income_generated'], 2) }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-400 text-sm">Total Withdrawals Paid</span>
                    <span class="text-orange-400 font-bold">${{ number_format($preview['total_withdrawals'], 2) }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-400 text-sm">Tokens Issued</span>
                    <span class="text-purple-400 font-medium">{{ number_format($preview['total_tokens_issued']) }} <i class="fa-solid fa-coins text-xs"></i></span>
                </div>
            </div>
            
            <div class="mt-6 p-4 bg-yellow-900/30 border border-yellow-700/50 rounded-lg text-yellow-500 text-sm flex gap-3">
                <i class="fa-solid fa-triangle-exclamation mt-1"></i>
                <p>Processing a closing will take a snapshot of these metrics for permanent historical record keeping.</p>
            </div>
        </div>

        <!-- Processing Form -->
        <div class="bg-[#1a222d] border border-[#334155] rounded-xl p-6 shadow-xl">
            <h3 class="text-gray-200 font-bold mb-4 flex items-center border-b border-[#334155] pb-2">
                <i class="fa-solid fa-gear text-indigo-500 mr-2"></i> Execute Closing
            </h3>

            <form action="{{ url('admin/closing/generate') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-400 text-sm mb-2">Start Date</label>
                        <input type="date" name="start_date" id="closing_start_date" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" value="{{ $startDateInput }}" required>
                    </div>
                    <div>
                        <label class="block text-gray-400 text-sm mb-2">End Date</label>
                        <input type="date" name="end_date" id="closing_end_date" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" value="{{ $endDateInput }}" required>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-400 text-sm mb-2">Closing Notes (Optional)</label>
                    <textarea name="notes" rows="3" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" placeholder="e.g. Statement processed for specified custom date range..."></textarea>
                </div>

                <button type="submit" class="w-full px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg shadow-lg transition flex justify-center items-center gap-2" onclick="return confirm('Are you absolutely sure you want to finalize this closing? This action will securely lock the metrics for the specified date range.');">
                    <i class="fa-solid fa-lock"></i> Finalize Closing Report
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterStart = document.querySelector('form[method="GET"] input[name="start_date"]');
    const filterEnd = document.querySelector('form[method="GET"] input[name="end_date"]');
    const closingStart = document.getElementById('closing_start_date');
    const closingEnd = document.getElementById('closing_end_date');

    if (filterStart && closingStart) {
        filterStart.addEventListener('change', function() {
            closingStart.value = this.value;
        });
        closingStart.addEventListener('change', function() {
            filterStart.value = this.value;
        });
    }

    if (filterEnd && closingEnd) {
        filterEnd.addEventListener('change', function() {
            closingEnd.value = this.value;
        });
        closingEnd.addEventListener('change', function() {
            filterEnd.value = this.value;
        });
    }
});
</script>
@endsection
