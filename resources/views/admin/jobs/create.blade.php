@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-[800px] mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Create New Job/Placement</h2>
    </div>

    <form action="{{ route('admin.jobs.store') }}" method="POST" class="bg-[#1a222d] border border-[#334155] rounded-xl p-6 space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-400 mb-1">Job Title</label>
                <input type="text" name="title" required class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="e.g. Senior Software Engineer">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Company Name</label>
                <input type="text" name="company_name" required class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="e.g. Google India">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Category</label>
                <select name="category" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white focus:outline-none">
                    <option value="job">Direct Job</option>
                    <option value="company_placement">Company Placement</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Location</label>
                <input type="text" name="location" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="e.g. Remote, Mumbai">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Salary Range</label>
                <input type="text" name="salary_range" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="e.g. 5LPA - 8LPA">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Job Type</label>
                <select name="job_type" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white focus:outline-none">
                    <option value="full_time">Full Time</option>
                    <option value="part_time">Part Time</option>
                    <option value="internship">Internship</option>
                    <option value="contract">Contract</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1">Description & Requirements</label>
            <textarea name="description" rows="6" required class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-1 focus:ring-indigo-500" placeholder="Enter detailed job description and candidate requirements..."></textarea>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-[#334155]">
            <a href="{{ route('admin.jobs.index') }}" class="px-4 py-2 text-gray-400 hover:text-white transition">Cancel</a>
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 shadow-lg shadow-indigo-500/20 transition">Create Posting</button>
        </div>
    </form>
</div>
@endsection
