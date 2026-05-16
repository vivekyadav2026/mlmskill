@extends('layouts.admin')
@section('content')
<style>
    .table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; }
    .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }
</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Loan Schemes</h2>
        <a href="{{ route('admin.loans.create_scheme') }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition shadow">
            <i class="fa-solid fa-plus mr-1"></i> Create New Scheme
        </a>
    </div>

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead>
                <tr>
                    <th>Scheme Name</th>
                    <th>Amount Range</th>
                    <th>Interest Rate</th>
                    <th>Max Tenure</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($schemes as $s)
                <tr>
                    <td class="font-bold text-indigo-400">{{ $s->name }}</td>
                    <td>${{ number_format($s->min_amount) }} - ${{ number_format($s->max_amount) }}</td>
                    <td class="text-green-400 font-bold">{{ $s->interest_rate }}% <span class="text-[10px] text-gray-500 font-normal">p.a.</span></td>
                    <td>{{ $s->max_tenure_months }} Months</td>
                    <td>
                        <span class="px-2 py-1 text-xs rounded {{ $s->status == 'active' ? 'bg-green-900 text-green-300' : 'bg-red-900 text-red-300' }}">
                            {{ ucfirst($s->status) }}
                        </span>
                    </td>
                    <td>
                        <div class="flex gap-2">
                            <button class="text-gray-400 hover:text-white"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="text-red-400 hover:text-red-300"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-8 text-gray-500">No loan schemes found. Create your first one!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[#334155]">
            {{ $schemes->links() }}
        </div>
    </div>
</div>
@endsection
