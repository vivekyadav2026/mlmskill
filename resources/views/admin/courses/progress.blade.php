@extends('layouts.admin')

@section('content')
<style>
  .table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; }
  .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }
  
  .progress-bar-container {
      width: 100%;
      background-color: #334155;
      border-radius: 9999px;
      height: 0.5rem;
      overflow: hidden;
  }
  .progress-bar-fill {
      height: 100%;
      border-radius: 9999px;
      transition: width 0.5s ease;
  }
</style>

<div class="tailwind-scope mt-4 max-w-[1400px] mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-100">User Course Progress</h2>
        <div class="text-gray-400 text-sm">
            Tracking {{ $progressRecords->total() }} student enrollments
        </div>
    </div>

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden shadow-lg">
        <table class="w-full table-custom">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Email</th>
                    <th>Course Title</th>
                    <th>Progress</th>
                    <th>Status</th>
                    <th>Completion Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($progressRecords as $record)
                <tr class="hover:bg-[#1e293b] transition">
                    <td class="font-medium text-gray-200">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-indigo-900/50 text-indigo-400 flex items-center justify-center font-bold text-xs">
                                {{ substr($record->user->name ?? 'U', 0, 2) }}
                            </div>
                            {{ $record->user->name ?? 'Unknown User' }}
                        </div>
                    </td>
                    <td class="text-gray-400 text-sm">{{ $record->user->email ?? 'N/A' }}</td>
                    <td class="font-semibold text-indigo-300">{{ $record->course->title ?? 'Deleted Course' }}</td>
                    <td class="w-48">
                        <div class="flex items-center justify-between mb-1 text-xs">
                            <span class="text-gray-300">{{ $record->progress_percentage }}%</span>
                        </div>
                        <div class="progress-bar-container">
                            <div class="progress-bar-fill {{ $record->progress_percentage == 100 ? 'bg-green-500' : 'bg-indigo-500' }}" style="width: {{ $record->progress_percentage }}%;"></div>
                        </div>
                    </td>
                    <td>
                        @if($record->progress_percentage == 100)
                            <span class="bg-green-900/50 border border-green-500/50 text-green-400 px-2 py-1 rounded text-xs font-medium"><i class="fa-solid fa-check-circle mr-1"></i> Completed</span>
                        @elseif($record->progress_percentage > 0)
                            <span class="bg-indigo-900/50 border border-indigo-500/50 text-indigo-400 px-2 py-1 rounded text-xs font-medium"><i class="fa-solid fa-spinner fa-spin mr-1"></i> In Progress</span>
                        @else
                            <span class="bg-gray-800 border border-gray-600 text-gray-400 px-2 py-1 rounded text-xs font-medium">Not Started</span>
                        @endif
                    </td>
                    <td class="text-sm text-gray-400">
                        @if($record->completed_at)
                            {{ $record->completed_at->format('M d, Y h:i A') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center p-12 text-gray-500">
                        <i class="fa-solid fa-chart-line text-4xl mb-3 block text-gray-600"></i>
                        No student progress records found yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-end">
        {{ $progressRecords->links('pagination::tailwind') }}
    </div>
</div>
@endsection