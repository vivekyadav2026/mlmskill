@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-[800px] mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-100">Edit Job/Placement Posting</h2>
        <a href="{{ route('admin.jobs.index') }}" class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600 transition">Back</a>
    </div>

    @if ($errors->any())
    <div class="bg-red-900 border-l-4 border-red-500 text-red-200 p-4 mb-6 rounded">
        <ul class="list-disc ml-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.jobs.update', $job->id) }}" method="POST" class="bg-[#1a222d] border border-[#334155] rounded-xl p-6 space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-400 mb-1">Job Title</label>
                <input type="text" name="title" value="{{ old('title', $job->title) }}" required class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-1 focus:ring-indigo-500">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Company Name</label>
                <input type="text" name="company_name" value="{{ old('company_name', $job->company_name) }}" required class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-1 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Category</label>
                <select name="category" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white focus:outline-none">
                    <option value="job" {{ old('category', $job->category) == 'job' ? 'selected' : '' }}>Direct Job</option>
                    <option value="company_placement" {{ old('category', $job->category) == 'company_placement' ? 'selected' : '' }}>Company Placement</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Location</label>
                <input type="text" name="location" value="{{ old('location', $job->location) }}" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-1 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Salary Range</label>
                <input type="text" name="salary_range" value="{{ old('salary_range', $job->salary_range) }}" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-1 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Job Type</label>
                <select name="job_type" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white focus:outline-none">
                    <option value="full_time" {{ old('job_type', $job->job_type) == 'full_time' ? 'selected' : '' }}>Full Time</option>
                    <option value="part_time" {{ old('job_type', $job->job_type) == 'part_time' ? 'selected' : '' }}>Part Time</option>
                    <option value="internship" {{ old('job_type', $job->job_type) == 'internship' ? 'selected' : '' }}>Internship</option>
                    <option value="contract" {{ old('job_type', $job->job_type) == 'contract' ? 'selected' : '' }}>Contract</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Status</label>
                <select name="status" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white focus:outline-none">
                    <option value="active" {{ old('status', $job->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $job->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1">Description & Requirements</label>
            <textarea name="description" rows="6" required class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-1 focus:ring-indigo-500">{{ old('description', $job->description) }}</textarea>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-[#334155]">
            <a href="{{ route('admin.jobs.index') }}" class="px-4 py-2 text-gray-400 hover:text-white transition">Cancel</a>
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 shadow-lg shadow-indigo-500/20 transition">Save Changes</button>
        </div>
    </form>
</div>
@endsection
