@extends('layouts.user')
@section('content')
<div class="tailwind-scope mt-4 max-w-[1200px] mx-auto">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-100">My Job Applications</h2>
        <p class="text-gray-400">Track the status of your submissions for various positions.</p>
    </div>

    <div class="space-y-4">
        @forelse($applications as $app)
        <div class="bg-[#1a222d] border border-[#334155] rounded-xl p-6 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-4 w-full md:w-auto">
                <div class="w-14 h-14 bg-indigo-600/10 rounded-xl flex items-center justify-center text-indigo-400 text-2xl">
                    <i class="fa-solid fa-file-lines"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-100 mb-1">{{ $app->job->title }}</h3>
                    <p class="text-sm text-gray-400">{{ $app->job->company_name }} • Applied on {{ $app->created_at->format('d M, Y') }}</p>
                </div>
            </div>

            <div class="flex items-center gap-6 w-full md:w-auto justify-between md:justify-end">
                <div class="text-right">
                    <p class="text-[10px] text-gray-500 uppercase font-bold mb-1">Status</p>
                    <span class="px-3 py-1 text-xs rounded-full font-bold uppercase tracking-wider
                        @if($app->status == 'pending') bg-yellow-900 text-yellow-300 
                        @elseif($app->status == 'shortlisted') bg-blue-900 text-blue-300
                        @elseif($app->status == 'hired') bg-green-900 text-green-300
                        @else bg-red-900 text-red-300 @endif">
                        {{ $app->status }}
                    </span>
                </div>
                
                @if($app->admin_remarks)
                <button onclick="alert('Admin Remarks: {{ addslashes($app->admin_remarks) }}')" class="p-2 text-gray-400 hover:text-white transition" title="View Remarks">
                    <i class="fa-solid fa-circle-info text-xl"></i>
                </button>
                @endif
            </div>
        </div>
        @empty
        <div class="py-20 text-center bg-[#1a222d] border border-[#334155] rounded-xl">
            <i class="fa-solid fa-folder-open text-5xl text-gray-600 mb-4"></i>
            <p class="text-gray-400">You haven't applied for any jobs yet. <a href="{{ route('user.jobs.index') }}" class="text-indigo-400 hover:underline">Browse Opportunities</a></p>
        </div>
        @endforelse
    </div>
</div>
@endsection
