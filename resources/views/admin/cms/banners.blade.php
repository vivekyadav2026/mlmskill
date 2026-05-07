@extends('layouts.admin')

@section('content')
<style>
  .table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; }
  .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }
</style>

<div class="tailwind-scope mt-4 max-w-[1400px] mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">Banner Management</h2>
            <p class="text-gray-400 text-sm">Control homepage and dashboard slider images</p>
        </div>
        <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded shadow transition" onclick="document.getElementById('addModal').classList.remove('hidden')"><i class="fa-solid fa-plus mr-1"></i> Add Banner</button>
    </div>

    @if(session('success'))
        <div class="bg-green-900 border border-green-500 text-green-300 px-4 py-3 rounded relative mb-4">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="bg-red-900 border border-red-500 text-red-300 px-4 py-3 rounded relative mb-4">
            <ul class="list-disc ml-5">
                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden shadow-lg">
        <table class="w-full table-custom">
            <thead>
                <tr>
                    <th>Preview</th>
                    <th>Title</th>
                    <th>Link URL</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($banners as $banner)
                <tr class="hover:bg-[#1e293b] transition">
                    <td class="w-32"><img src="{{ $banner->image_url }}" alt="Banner" class="w-24 h-12 object-cover rounded border border-gray-600"></td>
                    <td class="font-medium text-gray-200">{{ $banner->title }}</td>
                    <td class="text-gray-400 text-sm">
                        @if($banner->link_url) <a href="{{ $banner->link_url }}" target="_blank" class="text-blue-400 hover:underline">{{ $banner->link_url }}</a> @else N/A @endif
                    </td>
                    <td><span class="bg-green-900/50 border border-green-500/50 text-green-400 px-2 py-1 rounded text-xs font-medium">Active</span></td>
                    <td>
                        <form action="{{ route('admin.cms.banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Delete banner?');">
                            @csrf
                            <button type="submit" class="text-red-400 hover:text-red-300"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center p-12 text-gray-500">
                        <i class="fa-solid fa-image text-4xl mb-3 block text-gray-600"></i>
                        No banners added yet.
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
            <h3 class="text-xl font-bold text-white">Add New Banner</h3>
            <button onclick="document.getElementById('addModal').classList.add('hidden')" class="text-gray-400 hover:text-white"><i class="fa-solid fa-times text-xl"></i></button>
        </div>
        <form action="{{ url('admin/cms/banners') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-300 font-medium mb-2">Banner Title</label>
                <input type="text" name="title" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-300 font-medium mb-2">Banner Image</label>
                <input type="file" name="image" accept="image/*" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-300 font-medium mb-2">Target Link URL (Optional)</label>
                <input type="url" name="link_url" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')" class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600 transition">Cancel</button>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700 transition">Save Banner</button>
            </div>
        </form>
    </div>
</div>
@endsection