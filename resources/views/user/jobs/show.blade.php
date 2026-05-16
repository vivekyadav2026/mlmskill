@extends('layouts.user')
@section('content')
<div class="tailwind-scope mt-4 max-w-[900px] mx-auto">
    <div class="mb-6">
        <a href="{{ route('user.jobs.index') }}" class="text-gray-400 hover:text-white transition"><i class="fa-solid fa-arrow-left mr-1"></i> Back to Jobs</a>
    </div>

    <div class="bg-[#1a222d] border border-[#334155] rounded-2xl overflow-hidden shadow-2xl">
        <div class="p-8 border-b border-[#334155] bg-gradient-to-r from-indigo-600/10 to-transparent">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-100 mb-2">{{ $job->title }}</h1>
                    <p class="text-xl text-indigo-400 font-medium">{{ $job->company_name }}</p>
                </div>
                <span class="px-3 py-1 bg-indigo-600/20 text-indigo-400 border border-indigo-500/30 rounded-full text-xs font-bold uppercase tracking-wider">
                    {{ str_replace('_', ' ', $job->category) }}
                </span>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-[#0b1220] p-3 rounded-xl border border-[#334155]">
                    <p class="text-[10px] text-gray-500 uppercase font-bold mb-1">Location</p>
                    <p class="text-gray-200 text-sm"><i class="fa-solid fa-location-dot mr-1 text-indigo-500"></i> {{ $job->location ?? 'Remote' }}</p>
                </div>
                <div class="bg-[#0b1220] p-3 rounded-xl border border-[#334155]">
                    <p class="text-[10px] text-gray-500 uppercase font-bold mb-1">Type</p>
                    <p class="text-gray-200 text-sm"><i class="fa-solid fa-clock mr-1 text-blue-500"></i> {{ ucfirst(str_replace('_', ' ', $job->job_type)) }}</p>
                </div>
                <div class="bg-[#0b1220] p-3 rounded-xl border border-[#334155]">
                    <p class="text-[10px] text-gray-500 uppercase font-bold mb-1">Salary</p>
                    <p class="text-green-400 text-sm font-bold"><i class="fa-solid fa-wallet mr-1"></i> {{ $job->salary_range ?? 'Not Disclosed' }}</p>
                </div>
                <div class="bg-[#0b1220] p-3 rounded-xl border border-[#334155]">
                    <p class="text-[10px] text-gray-500 uppercase font-bold mb-1">Posted</p>
                    <p class="text-gray-200 text-sm"><i class="fa-solid fa-calendar mr-1 text-purple-500"></i> {{ $job->created_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>

        <div class="p-8">
            <h3 class="text-xl font-bold text-gray-100 mb-4">Job Description & Requirements</h3>
            <div class="text-gray-300 leading-relaxed whitespace-pre-line mb-10">
                {{ $job->description }}
            </div>

            @if($alreadyApplied)
                <div class="bg-green-900/30 border border-green-500/30 rounded-xl p-6 text-center">
                    <i class="fa-solid fa-circle-check text-green-500 text-4xl mb-3"></i>
                    <h4 class="text-green-400 font-bold text-lg">Application Submitted!</h4>
                    <p class="text-gray-400 text-sm">You have already applied for this position. You can track your status in "My Applications".</p>
                    <a href="{{ route('user.jobs.applications') }}" class="inline-block mt-4 text-indigo-400 hover:underline text-sm font-medium">View Application Status</a>
                </div>
            @else
                <div class="bg-[#0b1220] border border-[#334155] rounded-2xl p-8">
                    <h3 class="text-xl font-bold text-gray-100 mb-6">Apply Now</h3>
                    <form action="{{ route('user.jobs.apply', $job->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Upload Resume (PDF/DOC, Max 2MB)</label>
                            <div class="relative group">
                                <input type="file" name="resume" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="w-full bg-[#1a222d] border-2 border-dashed border-[#334155] group-hover:border-indigo-500 transition rounded-xl p-6 text-center">
                                    <i class="fa-solid fa-cloud-arrow-up text-3xl text-gray-500 group-hover:text-indigo-400 mb-2"></i>
                                    <p class="text-sm text-gray-400 group-hover:text-gray-200">Click or drag to upload your CV</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Cover Letter / Professional Summary (Optional)</label>
                            <textarea name="cover_letter" rows="4" class="w-full bg-[#1a222d] border border-[#334155] rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition" placeholder="Tell us why you are a good fit for this role..."></textarea>
                        </div>

                        <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold text-lg shadow-xl shadow-indigo-500/20 transition transform hover:-translate-y-1">
                            Submit My Application
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
