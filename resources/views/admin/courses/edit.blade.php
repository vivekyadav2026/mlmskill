@extends('layouts.admin')

@section('content')
<div class="tailwind-scope mt-4 max-w-2xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-100">Edit Course</h2>
        <a href="{{ route('admin.courses.index') }}" class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600">Back</a>
    </div>

    @if ($errors->any())
    <div class="bg-red-900 border-l-4 border-red-500 text-red-200 p-4 mb-6">
        <ul class="list-disc ml-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6">
        <form action="{{ route('admin.courses.update', $course->id) }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="title" class="block text-gray-300 font-medium mb-2">Course Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $course->title) }}" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" required>
            </div>

            <div class="mb-4">
                <label for="module_id" class="block text-gray-300 font-medium mb-2">Assign to Module</label>
                <select name="module_id" id="module_id" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                    <option value="">-- No Module (Standalone) --</option>
                    @foreach($modules as $module)
                        <option value="{{ $module->id }}" {{ old('module_id', $course->module_id) == $module->id ? 'selected' : '' }}>{{ $module->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-300 font-medium mb-2">Price ($)</label>
                <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $course->price) }}" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" required>
            </div>

            <div class="mb-6">
                <label for="status" class="block text-gray-300 font-medium mb-2">Status</label>
                <select name="status" id="status" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                    <option value="active" {{ old('status', $course->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $course->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">Update Course</button>
            </div>
        </form>
    </div>
</div>
@endsection
