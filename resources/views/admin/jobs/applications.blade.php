@extends('layouts.admin')
@section('content')
<style>
    .table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; }
    .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; }
</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Job Applications</h2>
        <p class="text-gray-400">Review and manage candidate applications for all posted positions.</p>
    </div>

    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead>
                <tr>
                    <th>Candidate</th>
                    <th>Position</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Documents</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applications as $app)
                <tr>
                    <td>
                        <div class="font-bold text-gray-100">{{ $app->user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $app->user->email }}</div>
                    </td>
                    <td>
                        <div class="font-medium text-indigo-400">{{ $app->job->title }}</div>
                        <div class="text-xs text-gray-500">{{ $app->job->company_name }}</div>
                    </td>
                    <td>
                        <span class="px-2 py-1 text-[10px] rounded uppercase font-bold 
                            @if($app->status == 'pending') bg-yellow-900 text-yellow-300 
                            @elseif($app->status == 'shortlisted') bg-blue-900 text-blue-300
                            @elseif($app->status == 'hired') bg-green-900 text-green-300
                            @else bg-red-900 text-red-300 @endif">
                            {{ $app->status }}
                        </span>
                    </td>
                    <td>{{ $app->created_at->format('M d, Y') }}</td>
                    <td>
                        @if($app->resume_path)
                            <a href="{{ asset('storage/' . $app->resume_path) }}" target="_blank" class="text-indigo-400 hover:underline"><i class="fa-solid fa-file-pdf mr-1"></i> Resume</a>
                        @else
                            <span class="text-gray-500 italic">No resume</span>
                        @endif
                    </td>
                    <td>
                        <button onclick="openStatusModal({{ $app->id }}, '{{ $app->status }}', '{{ addslashes($app->admin_remarks) }}')" class="px-3 py-1 bg-gray-800 text-gray-300 border border-gray-700 rounded text-xs hover:bg-gray-700 transition">Update</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-8 text-gray-500">No applications received yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[#334155]">
            {{ $applications->links() }}
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div id="statusModal" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-[#1a222d] border border-[#334155] rounded-xl w-full max-w-md overflow-hidden">
        <div class="px-6 py-4 border-b border-[#334155] flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-100">Update Application</h3>
            <button onclick="closeStatusModal()" class="text-gray-400 hover:text-white"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <form id="statusForm" method="POST" action="">
            @csrf
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Status</label>
                    <select name="status" id="modalStatus" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white">
                        <option value="pending">Pending</option>
                        <option value="shortlisted">Shortlisted</option>
                        <option value="rejected">Rejected</option>
                        <option value="hired">Hired</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Admin Remarks</label>
                    <textarea name="admin_remarks" id="modalRemarks" rows="4" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2 text-white" placeholder="Reason for status change..."></textarea>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-[#334155] bg-[#0f172a] flex justify-end gap-3">
                <button type="button" onclick="closeStatusModal()" class="px-4 py-2 text-gray-400 hover:text-white transition">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openStatusModal(id, status, remarks) {
        document.getElementById('statusForm').action = "/admin/jobs/applications/" + id + "/update";
        document.getElementById('modalStatus').value = status;
        document.getElementById('modalRemarks').value = remarks;
        document.getElementById('statusModal').classList.remove('hidden');
    }
    function closeStatusModal() {
        document.getElementById('statusModal').classList.add('hidden');
    }
</script>
@endsection
