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
            <thead><tr><th>Course Title</th><th>Module</th><th>Price</th><th>Status</th><th>Videos</th><th>Action</th></tr></thead>
            <tbody>
                @forelse($courses as $c)
                <tr>
                    <td class="font-bold">{{ $c->title }}</td>
                    <td>
                        @if($c->module)
                            <span class="bg-indigo-900/50 text-indigo-300 border border-indigo-700/50 px-2 py-1 rounded text-xs">{{ $c->module->name }}</span>
                        @else
                            <span class="text-gray-500 text-xs italic">Standalone</span>
                        @endif
                    </td>
                    <td class="text-green-400 font-mono">${{ number_format($c->price, 2) }}</td>
                    <td><span class="bg-green-900 text-green-300 px-2 py-1 rounded text-xs">{{ ucfirst($c->status) }}</span></td>
                    <td>{{ $c->lessons->count() ?? '0' }} Videos</td>
                    <td>
                        <a href="{{ route('admin.courses.edit', $c->id) }}" class="text-indigo-400 hover:text-white mr-3"><i class="fa-solid fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.courses.destroy', $c->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this course?');">
                            @csrf
                            <button type="submit" class="text-red-400 hover:text-red-300"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center p-8 text-gray-500">No courses available.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection