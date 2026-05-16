@extends('layouts.user')
@section('content')
<div class="tailwind-scope mt-4 max-w-[1200px] mx-auto">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-100">Career Opportunities</h2>
        <p class="text-gray-400">Explore exclusive job openings and company placements for our members.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($jobs as $job)
        <div class="bg-[#1a222d] border border-[#334155] rounded-xl overflow-hidden hover:border-indigo-500/50 transition group">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <span class="px-2 py-1 text-[10px] rounded uppercase font-bold {{ $job->category == 'job' ? 'bg-blue-900 text-blue-300' : 'bg-purple-900 text-purple-300' }}">
                        {{ str_replace('_', ' ', $job->category) }}
                    </span>
                    <span class="text-xs text-gray-500">{{ $job->created_at->diffForHumans() }}</span>
                </div>
                <h3 class="text-xl font-bold text-gray-100 mb-1 group-hover:text-indigo-400 transition">{{ $job->title }}</h3>
                <p class="text-gray-400 text-sm mb-4"><i class="fa-solid fa-building mr-1"></i> {{ $job->company_name }}</p>
                
                <div class="flex flex-wrap gap-2 mb-6">
                    <span class="bg-[#0b1220] border border-[#334155] text-gray-400 text-[10px] px-2 py-1 rounded-full"><i class="fa-solid fa-location-dot mr-1"></i> {{ $job->location ?? 'Remote' }}</span>
                    <span class="bg-[#0b1220] border border-[#334155] text-gray-400 text-[10px] px-2 py-1 rounded-full"><i class="fa-solid fa-clock mr-1"></i> {{ ucfirst(str_replace('_', ' ', $job->job_type)) }}</span>
                    @if($job->salary_range)
                    <span class="bg-[#0b1220] border border-[#334155] text-green-400 text-[10px] px-2 py-1 rounded-full"><i class="fa-solid fa-wallet mr-1"></i> {{ $job->salary_range }}</span>
                    @endif
                </div>

                <a href="{{ route('user.jobs.show', $job->id) }}" class="block w-full text-center py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition shadow-lg shadow-indigo-500/10">View Details</a>
            </div>
        </div>
        @empty
        <div class="col-span-full py-20 text-center bg-[#1a222d] border border-[#334155] rounded-xl">
            <i class="fa-solid fa-briefcase text-5xl text-gray-600 mb-4"></i>
            <p class="text-gray-400">No new opportunities available at the moment. Check back soon!</p>
        </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $jobs->links() }}
    </div>
</div>
@endsection
