@extends('layouts.admin')

@section('content')
<style>
  .table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; }
  .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }
</style>

<div class="tailwind-scope mt-4 max-w-[1200px] mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Course Content Management</h2>
        <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow" onclick="document.getElementById('addContentModal').classList.remove('hidden')">
            <i class="fa-solid fa-plus mr-1"></i> Add Module / Video
        </button>
    </div>

    @if(session('success'))
        <div class="bg-green-900 border border-green-500 text-green-300 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Select Course to filter -->
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-4 mb-6 flex items-center gap-4">
        <label for="courseFilter" class="text-gray-300 font-medium">Select Course:</label>
        <select id="courseFilter" class="bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500 w-64" onchange="filterCourses(this.value)">
            <option value="all">All Courses</option>
            @foreach($courses as $course)
                <option value="{{ $course->id }}">{{ $course->title }}</option>
            @endforeach
        </select>
    </div>

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Module Title</th>
                    <th>Video URL</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $hasContent = false; @endphp
                @foreach($courses as $course)
                    @foreach($course->lessons as $lesson)
                        @php $hasContent = true; @endphp
                        <tr class="lesson-row" data-course-id="{{ $course->id }}">
                            <td class="font-semibold text-gray-300">{{ $course->title }}</td>
                            <td>{{ $lesson->title }}</td>
                            <td>
                                @if($lesson->video_url)
                                    <a href="{{ $lesson->video_url }}" target="_blank" class="text-blue-400 hover:underline"><i class="fa-solid fa-play-circle mr-1"></i> Watch</a>
                                @else
                                    <span class="text-gray-500">N/A</span>
                                @endif
                            </td>
                            <td>{{ $lesson->duration ? $lesson->duration . ' mins' : 'N/A' }}</td>
                            <td><span class="bg-green-900 text-green-300 px-2 py-1 rounded text-xs">{{ ucfirst($lesson->status) }}</span></td>
                            <td>
                                <form action="{{ route('admin.courses.content.destroy', $lesson->id) }}" method="POST" onsubmit="return confirm('Delete this lesson?');">
                                    @csrf
                                    <button type="submit" class="text-red-400 hover:text-red-300"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
                
                @if(!$hasContent)
                <tr id="emptyRow">
                    <td colspan="6" class="text-center p-8 text-gray-500">
                        <i class="fa-solid fa-folder-open text-4xl mb-3 block text-gray-600"></i>
                        No course content available. Click "Add Module / Video" to create content.
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Add Content Modal -->
<div id="addContentModal" class="fixed inset-0 z-50 hidden bg-black/60 flex items-center justify-center backdrop-blur-sm">
    <div class="bg-[#1a222d] border border-[#334155] rounded-xl w-full max-w-lg p-6 shadow-2xl">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-white">Add Course Content</h3>
            <button onclick="document.getElementById('addContentModal').classList.add('hidden')" class="text-gray-400 hover:text-white"><i class="fa-solid fa-times text-xl"></i></button>
        </div>
        
        <form action="{{ route('admin.courses.content.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-300 font-medium mb-2">Select Course</label>
                <select name="course_id" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" required>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 font-medium mb-2">Module / Lesson Title</label>
                <input type="text" name="title" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" required placeholder="e.g. Introduction to Trading">
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 font-medium mb-2">Video URL (YouTube / Vimeo)</label>
                <input type="url" name="video_url" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" placeholder="https://...">
            </div>
            <div class="mb-6">
                <label class="block text-gray-300 font-medium mb-2">Duration (minutes)</label>
                <input type="number" name="duration" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" placeholder="e.g. 15">
            </div>
            
            <div class="flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('addContentModal').classList.add('hidden')" class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600 transition">Cancel</button>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700 transition">Save Content</button>
            </div>
        </form>
    </div>
</div>

<script>
    function filterCourses(courseId) {
        let rows = document.querySelectorAll('.lesson-row');
        let visibleCount = 0;
        rows.forEach(row => {
            if (courseId === 'all' || row.dataset.courseId === courseId) {
                row.style.display = 'table-row';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });
        
        // Handle empty state manually if we want, but it's okay.
    }
</script>
@endsection