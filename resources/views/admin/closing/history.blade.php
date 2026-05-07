@extends('layouts.admin')

@section('content')
<style>
  .table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; }
  .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }
</style>

<div class="tailwind-scope mt-4 max-w-[1400px] mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">Monthly Closing History</h2>
            <p class="text-gray-400 text-sm">Review past finalized monthly statements</p>
        </div>
        <a href="{{ route('admin.closing.generate') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded shadow transition"><i class="fa-solid fa-calculator mr-1"></i> Process New Closing</a>
    </div>

    @if(session('success'))
        <div class="bg-green-900 border border-green-500 text-green-300 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden shadow-lg">
        <table class="w-full table-custom">
            <thead>
                <tr>
                    <th>Closing Period</th>
                    <th>Processed On</th>
                    <th>Active Users</th>
                    <th>Total Income Generated</th>
                    <th>Total Withdrawals</th>
                    <th>Tokens Issued</th>
                </tr>
            </thead>
            <tbody>
                @forelse($closings as $closing)
                <tr class="hover:bg-[#1e293b] transition">
                    <td class="font-bold text-indigo-400">
                        {{ date('F', mktime(0, 0, 0, $closing->month, 10)) }} {{ $closing->year }}
                    </td>
                    <td class="text-gray-400 text-sm">{{ $closing->created_at->format('M d, Y h:i A') }}</td>
                    <td class="font-medium text-gray-200">{{ number_format($closing->total_active_users) }}</td>
                    <td class="font-bold text-green-400">${{ number_format($closing->total_income_generated, 2) }}</td>
                    <td class="font-bold text-orange-400">${{ number_format($closing->total_withdrawals, 2) }}</td>
                    <td class="text-purple-400 font-medium">{{ number_format($closing->total_tokens_issued) }} <i class="fa-solid fa-coins text-xs"></i></td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center p-12 text-gray-500">
                        <i class="fa-solid fa-file-invoice text-4xl mb-3 block text-gray-600"></i>
                        No monthly closings have been processed yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4 flex justify-end">{{ $closings->links('pagination::tailwind') }}</div>
</div>
@endsection