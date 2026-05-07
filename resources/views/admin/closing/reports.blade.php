@extends('layouts.admin')

@section('content')
<style>
  .table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; }
  .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }
</style>

<div class="tailwind-scope mt-4 max-w-[1400px] mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">Settlement Reports</h2>
            <p class="text-gray-400 text-sm">Aggregated overview of platform settlements</p>
        </div>
        <div class="flex gap-4">
            <button class="px-4 py-2 bg-[#334155] hover:bg-[#475569] text-white rounded transition" onclick="window.print()"><i class="fa-solid fa-print mr-1"></i> Print Report</button>
            <a href="{{ route('admin.closing.generate') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded shadow transition"><i class="fa-solid fa-plus mr-1"></i> New Closing</a>
        </div>
    </div>

    <!-- Analytics Overview -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-[#1a222d] border border-[#334155] p-6 rounded-xl shadow-lg">
            <h3 class="text-gray-400 font-medium mb-1">Total Months Closed</h3>
            <div class="text-3xl font-bold text-white">{{ count($closings) }}</div>
        </div>
        <div class="bg-[#1a222d] border border-[#334155] p-6 rounded-xl shadow-lg">
            <h3 class="text-gray-400 font-medium mb-1">Lifetime Income</h3>
            <div class="text-3xl font-bold text-green-400">${{ number_format($closings->sum('total_income_generated'), 2) }}</div>
        </div>
        <div class="bg-[#1a222d] border border-[#334155] p-6 rounded-xl shadow-lg">
            <h3 class="text-gray-400 font-medium mb-1">Lifetime Withdrawals</h3>
            <div class="text-3xl font-bold text-orange-400">${{ number_format($closings->sum('total_withdrawals'), 2) }}</div>
        </div>
        <div class="bg-[#1a222d] border border-[#334155] p-6 rounded-xl shadow-lg">
            <h3 class="text-gray-400 font-medium mb-1">Tokens Distributed</h3>
            <div class="text-3xl font-bold text-purple-400">{{ number_format($closings->sum('total_tokens_issued')) }}</div>
        </div>
    </div>

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden shadow-lg">
        <table class="w-full table-custom">
            <thead>
                <tr>
                    <th>Reporting Period</th>
                    <th>Gross Income</th>
                    <th>Paid Withdrawals</th>
                    <th>Net Retention</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($closings as $closing)
                @php
                    $netRetention = $closing->total_income_generated - $closing->total_withdrawals;
                @endphp
                <tr class="hover:bg-[#1e293b] transition">
                    <td class="font-bold text-indigo-400">
                        {{ date('F Y', mktime(0, 0, 0, $closing->month, 10, $closing->year)) }}
                    </td>
                    <td class="font-medium text-green-400">${{ number_format($closing->total_income_generated, 2) }}</td>
                    <td class="font-medium text-orange-400">${{ number_format($closing->total_withdrawals, 2) }}</td>
                    <td class="font-bold {{ $netRetention >= 0 ? 'text-blue-400' : 'text-red-400' }}">
                        ${{ number_format($netRetention, 2) }}
                    </td>
                    <td>
                        <span class="bg-green-900/50 border border-green-500/50 text-green-400 px-2 py-1 rounded text-xs font-medium"><i class="fa-solid fa-check"></i> Settled</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center p-12 text-gray-500">
                        <i class="fa-solid fa-chart-line text-4xl mb-3 block text-gray-600"></i>
                        No settlement reports available. Generate a closing first.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection