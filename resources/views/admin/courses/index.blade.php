@extends('layouts.admin')
@section('content')
<style>.table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; } .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Course Management</h2>
        <a href="{{ url('admin/courses/create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow"><i class="fa-solid fa-plus mr-1"></i> Add Course</a>
    </div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead><tr><th>Course Title</th><th>Price</th><th>Status</th><th>Modules</th><th>Action</th></tr></thead>
            <tbody>
                @forelse($courses as $c)
                <tr>
                    <td class="font-bold">{{ $c->title }}</td>
                    <td class="text-green-400 font-mono">$\{{ number_format($c->price, 2) }}</td>
                    <td><span class="bg-green-900 text-green-300 px-2 py-1 rounded text-xs">{{ $c->status }}</span></td>
                    <td>12 Videos</td>
                    <td><button class="text-indigo-400 hover:text-white"><i class="fa-solid fa-edit"></i> Edit</button></td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center p-8 text-gray-500">No courses available.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection