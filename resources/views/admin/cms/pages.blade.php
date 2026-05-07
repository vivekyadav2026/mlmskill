@extends('layouts.admin')

@section('content')
<style>
  .table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; }
  .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }
</style>

<div class="tailwind-scope mt-4 max-w-[1400px] mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">Dynamic Pages</h2>
            <p class="text-gray-400 text-sm">Manage website content pages (About, Terms, Privacy)</p>
        </div>
        <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded shadow transition" onclick="document.getElementById('addModal').classList.remove('hidden')"><i class="fa-solid fa-file-circle-plus mr-1"></i> Create Page</button>
    </div>

    @if(session('success'))
        <div class="bg-green-900 border border-green-500 text-green-300 px-4 py-3 rounded relative mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden shadow-lg">
        <table class="w-full table-custom">
            <thead>
                <tr>
                    <th>Page Title</th>
                    <th>URL Slug</th>
                    <th>Last Updated</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pages as $page)
                <tr class="hover:bg-[#1e293b] transition">
                    <td class="font-medium text-gray-200">{{ $page->title }}</td>
                    <td class="font-mono text-sm text-indigo-400">/page/{{ $page->slug }}</td>
                    <td class="text-gray-400 text-sm">{{ $page->updated_at->diffForHumans() }}</td>
                    <td><span class="bg-green-900/50 border border-green-500/50 text-green-400 px-2 py-1 rounded text-xs font-medium">Published</span></td>
                    <td>
                        <form action="{{ route('admin.cms.pages.destroy', $page->id) }}" method="POST" onsubmit="return confirm('Delete page permanently?');">
                            @csrf
                            <button type="submit" class="text-red-400 hover:text-red-300"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center p-12 text-gray-500">
                        <i class="fa-solid fa-file-lines text-4xl mb-3 block text-gray-600"></i>
                        No dynamic pages created yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Add Modal -->
<div id="addModal" class="fixed inset-0 z-50 hidden bg-black/60 flex items-center justify-center backdrop-blur-sm">
    <div class="bg-[#1a222d] border border-[#334155] rounded-xl w-full max-w-3xl p-6 shadow-2xl">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-white">Create New Page</h3>
            <button onclick="document.getElementById('addModal').classList.add('hidden')" class="text-gray-400 hover:text-white"><i class="fa-solid fa-times text-xl"></i></button>
        </div>
        <form action="{{ url('admin/cms/pages') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-300 font-medium mb-2">Page Title</label>
                <input type="text" name="title" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500" required placeholder="e.g. Terms and Conditions">
                <p class="text-xs text-gray-500 mt-1">The URL slug will be automatically generated from the title.</p>
            </div>
            <div class="mb-6">
                <label class="block text-gray-300 font-medium mb-2">Page Content (HTML Supported)</label>
                <textarea name="content" rows="10" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500 font-mono text-sm" required placeholder="<h1>Heading</h1><p>Content goes here...</p>"></textarea>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')" class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600 transition">Cancel</button>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700 transition">Publish Page</button>
            </div>
        </form>
    </div>
</div>
@endsection