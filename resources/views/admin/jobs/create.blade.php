@extends('layouts.admin')
@section('content')

<div class="tailwind-scope mt-4 w-full max-w-[800px] mx-auto px-3 sm:px-4">

    {{-- Header --}}
    <div class="mb-5 flex items-center gap-3">
        <a href="{{ route('admin.jobs.index') }}"
           class="text-gray-400 hover:text-white transition p-1.5 rounded-lg hover:bg-white/10">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-100">Create New Job/Placement</h2>
            <p class="text-gray-500 text-xs mt-0.5">Fill all fields and publish the posting.</p>
        </div>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="flex items-center gap-2 bg-green-500/10 border border-green-700 text-green-400 p-3 rounded-lg mb-4 text-sm">
            <i class="fa-solid fa-circle-check flex-shrink-0"></i> {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="bg-red-500/10 border border-red-700 text-red-400 p-3 rounded-lg mb-4 text-sm">
            <i class="fa-solid fa-triangle-exclamation mr-1"></i>
            <ul class="mt-1 list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.jobs.store') }}" method="POST"
          class="bg-[#1a222d] border border-[#334155] rounded-xl p-4 sm:p-6 space-y-4">
        @csrf

        {{-- Job Title — full width always --}}
        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1">
                Job Title <span class="text-red-400">*</span>
            </label>
            <input type="text" name="title" required value="{{ old('title') }}"
                   class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2.5 text-white
                          placeholder-gray-600 focus:outline-none focus:ring-1 focus:ring-indigo-500 text-sm"
                   placeholder="e.g. Senior Software Engineer">
        </div>

        {{-- 2-col grid — stacks to 1-col on mobile --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">
                    Company Name <span class="text-red-400">*</span>
                </label>
                <input type="text" name="company_name" required value="{{ old('company_name') }}"
                       class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2.5 text-white
                              placeholder-gray-600 focus:outline-none focus:ring-1 focus:ring-indigo-500 text-sm"
                       placeholder="e.g. Google India">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Category</label>
                <select name="category"
                        class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2.5 text-white
                               focus:outline-none focus:ring-1 focus:ring-indigo-500 text-sm">
                    <option value="job"               {{ old('category')=='job'?'selected':'' }}>Direct Job</option>
                    <option value="company_placement" {{ old('category')=='company_placement'?'selected':'' }}>Company Placement</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Location</label>
                <input type="text" name="location" value="{{ old('location') }}"
                       class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2.5 text-white
                              placeholder-gray-600 focus:outline-none focus:ring-1 focus:ring-indigo-500 text-sm"
                       placeholder="e.g. Remote, Mumbai">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Salary Range</label>
                <input type="text" name="salary_range" value="{{ old('salary_range') }}"
                       class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2.5 text-white
                              placeholder-gray-600 focus:outline-none focus:ring-1 focus:ring-indigo-500 text-sm"
                       placeholder="e.g. 5LPA – 8LPA">
            </div>

            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-400 mb-1">Job Type</label>
                <select name="job_type"
                        class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2.5 text-white
                               focus:outline-none focus:ring-1 focus:ring-indigo-500 text-sm">
                    <option value="full_time"   {{ old('job_type')=='full_time'?'selected':'' }}>Full Time</option>
                    <option value="part_time"   {{ old('job_type')=='part_time'?'selected':'' }}>Part Time</option>
                    <option value="internship"  {{ old('job_type')=='internship'?'selected':'' }}>Internship</option>
                    <option value="contract"    {{ old('job_type')=='contract'?'selected':'' }}>Contract</option>
                </select>
            </div>

        </div>

        {{-- Description — full width --}}
        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1">
                Description &amp; Requirements <span class="text-red-400">*</span>
            </label>
            <textarea name="description" rows="5" required
                      class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2.5 text-white
                             placeholder-gray-600 focus:outline-none focus:ring-1 focus:ring-indigo-500 text-sm resize-y"
                      placeholder="Enter detailed job description and candidate requirements...">{{ old('description') }}</textarea>
        </div>

        {{-- Buttons — stack on mobile --}}
        <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-4 border-t border-[#334155]">
            <a href="{{ route('admin.jobs.index') }}"
               class="w-full sm:w-auto text-center px-5 py-2.5 text-gray-400 hover:text-white border border-[#334155]
                      hover:border-gray-500 rounded-lg transition text-sm">
                Cancel
            </a>
            <button type="submit"
                    class="w-full sm:w-auto px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold
                           rounded-lg shadow-lg shadow-indigo-500/20 transition text-sm flex items-center justify-center gap-2">
                <i class="fa-solid fa-plus"></i> Create Posting
            </button>
        </div>

    </form>
</div>
@endsection
