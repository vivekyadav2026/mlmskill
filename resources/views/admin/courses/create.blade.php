@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-2xl mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Create New Course</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6">
        <form method="POST" action="{{ url('admin/courses/create') }}">
            @csrf
            <div class="mb-4"><label class="block text-gray-300 mb-2">Course Title</label><input type="text" name="title" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" required></div>
            <div class="mb-4"><label class="block text-gray-300 mb-2">Description</label><textarea name="description" rows="4" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded"></textarea></div>
            <div class="mb-4"><label class="block text-gray-300 mb-2">Price ($)</label><input type="number" step="0.01" name="price" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded" required></div>
            <div class="mb-6"><label class="block text-gray-300 mb-2">Status</label><select name="status" class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded"><option value="active">Active</option><option value="inactive">Inactive</option></select></div>
            <button class="bg-indigo-600 text-white px-6 py-2 rounded font-bold w-full">Publish Course</button>
        </form>
    </div>
</div>
@endsection