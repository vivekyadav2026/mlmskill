@extends('layouts.admin')
@section('content')
<style>
    .table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; }
    .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }
</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Job & Placement Postings</h2>
        <a href="{{ route('admin.jobs.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition shadow">
            <i class="fa-solid fa-plus mr-1"></i> Post New Position
        </a>
    </div>

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Company</th>
                    <th>Category</th>
                    <th>Applications</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jobs as $job)
                <tr>
                    <td class="font-bold text-indigo-400">{{ $job->title }}</td>
                    <td>{{ $job->company_name }}</td>
                    <td>
                        <span class="px-2 py-1 text-[10px] rounded uppercase font-bold {{ $job->category == 'job' ? 'bg-blue-900 text-blue-300' : 'bg-purple-900 text-purple-300' }}">
                            {{ str_replace('_', ' ', $job->category) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.jobs.applications') }}?job_id={{ $job->id }}" class="text-indigo-400 hover:underline">
                            {{ $job->applications_count }} Candidates
                        </a>
                    </td>
                    <td>
                        <span class="px-2 py-1 text-xs rounded {{ $job->status == 'active' ? 'bg-green-900 text-green-300' : 'bg-red-900 text-red-300' }}">
                            {{ ucfirst($job->status) }}
                        </span>
                    </td>
                    <td>{{ $job->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="flex gap-2">
                            <button class="text-gray-400 hover:text-white"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="text-red-400 hover:text-red-300"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-8 text-gray-500">No postings found. Create your first one!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[#334155]">
            {{ $jobs->links() }}
        </div>
    </div>
</div>
@endsection
