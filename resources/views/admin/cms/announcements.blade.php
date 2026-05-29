@extends('layouts.admin')

@section('content')
<style>
  .table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; }
  .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }
</style>

<div class="tailwind-scope mt-4 max-w-[1400px] mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">Platform Announcements</h2>
            <p class="text-gray-400 text-sm">Broadcast messages to all user dashboards</p>
        </div>
        <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded shadow transition" onclick="document.getElementById('addModal').classList.remove('hidden')"><i class="fa-solid fa-bullhorn mr-1"></i> New Announcement</button>
    </div>

    @if(session('success'))
        <div class="bg-green-900 border border-green-500 text-green-300 px-4 py-3 rounded relative mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden shadow-lg">
        <table class="w-full table-custom">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Title & Content</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($announcements as $ann)
                <tr class="hover:bg-[#1e293b] transition">
                    <td class="text-gray-400 text-sm whitespace-nowrap">{{ $ann->created_at->format('M d, Y') }}</td>
                    <td>
                        @if($ann->type == 'info') <span class="bg-blue-900/50 text-blue-400 px-2 py-1 rounded text-xs font-medium">Info</span>
                        @elseif($ann->type == 'warning') <span class="bg-orange-900/50 text-orange-400 px-2 py-1 rounded text-xs font-medium">Warning</span>
                        @elseif($ann->type == 'success') <span class="bg-green-900/50 text-green-400 px-2 py-1 rounded text-xs font-medium">Success</span>
                        @else <span class="bg-red-900/50 text-red-400 px-2 py-1 rounded text-xs font-medium">Danger</span>
                        @endif
                    </td>
                    <td>
                        <div class="font-bold text-gray-200 mb-1">{{ $ann->title }}</div>
                        <div class="text-gray-400 text-sm truncate max-w-md">{{ $ann->content }}</div>
                    </td>
                    <td>
                        <div class="flex items-center gap-3">
                            <button type="button" class="text-indigo-400 hover:text-indigo-300" onclick="editAnnouncement({{ json_encode($ann) }})">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <form action="{{ route('admin.cms.announcements.destroy', $ann->id) }}" method="POST" onsubmit="return confirm('Delete announcement?');" class="inline">
                                @csrf
                                <button type="submit" class="text-red-400 hover:text-red-300"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center p-12 text-gray-500">
                        <i class="fa-solid fa-bullhorn text-4xl mb-3 block text-gray-600"></i>
                        No announcements published yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add Modal -->
<div id="addModal" class="fixed inset-0 z-50 hidden bg-black/60 flex items-center justify-center backdrop-blur-sm">
    <div class="bg-[#1a222d] border border-[#334155] rounded-xl w-full max-w-lg p-6 shadow-2xl">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-white">Publish Announcement</h3>
            <button onclick="document.getElementById('addModal').classList.add('hidden')" class="text-gray-400 hover:text-white"><i class="fa-solid fa-times text-xl"></i></button>
        </div>
        <form action="{{ url('admin/cms/announcements') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-300 font-medium mb-2">Title</label>
                <input type="text" name="title" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 font-medium mb-2">Message Type</label>
                <select name="type" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" required>
                    <option value="info">Info (Blue)</option>
                    <option value="success">Success (Green)</option>
                    <option value="warning">Warning (Orange)</option>
                    <option value="danger">Urgent/Danger (Red)</option>
                </select>
            </div>
            <div class="mb-6">
                <label class="block text-gray-300 font-medium mb-2">Content</label>
                <textarea name="content" rows="4" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" required></textarea>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')" class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600 transition">Cancel</button>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700 transition">Publish</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 z-50 hidden bg-black/60 flex items-center justify-center backdrop-blur-sm">
    <div class="bg-[#1a222d] border border-[#334155] rounded-xl w-full max-w-lg p-6 shadow-2xl">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-white">Edit Announcement</h3>
            <button onclick="document.getElementById('editModal').classList.add('hidden')" class="text-gray-400 hover:text-white"><i class="fa-solid fa-times text-xl"></i></button>
        </div>
        <form action="" method="POST" id="editAnnouncementForm">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-300 font-medium mb-2">Title</label>
                <input type="text" name="title" id="editTitle" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 font-medium mb-2">Message Type</label>
                <select name="type" id="editType" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" required>
                    <option value="info">Info (Blue)</option>
                    <option value="success">Success (Green)</option>
                    <option value="warning">Warning (Orange)</option>
                    <option value="danger">Urgent/Danger (Red)</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 font-medium mb-2">Status</label>
                <select name="status" id="editStatus" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" required>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="mb-6">
                <label class="block text-gray-300 font-medium mb-2">Content</label>
                <textarea name="content" id="editContent" rows="4" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" required></textarea>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')" class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600 transition">Cancel</button>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700 transition">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
function editAnnouncement(ann) {
    document.getElementById('editTitle').value = ann.title;
    document.getElementById('editType').value = ann.type;
    document.getElementById('editStatus').value = ann.status;
    document.getElementById('editContent').value = ann.content;
    
    const form = document.getElementById('editAnnouncementForm');
    form.action = `/admin/cms/announcements/${ann.id}/update`;
    
    document.getElementById('editModal').classList.remove('hidden');
}
</script>
@endsection