@extends('layouts.admin')
@section('content')
<style>.table-custom th { background: #0f172a; color: #94a3b8; font-weight: 600; padding: 0.75rem 1rem; border-bottom: 1px solid #334155; } .table-custom td { padding: 1rem; border-bottom: 1px solid #334155; color: #e2e8f0; text-transform: capitalize; }</style>
<div class="tailwind-scope mt-4 max-w-[1600px] mx-auto">
    <div class="mb-6"><h2 class="text-2xl font-bold text-gray-100">Inactive Users</h2></div>
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden">
        <table class="w-full table-custom">
            <thead><tr><th>Name</th><th>Email</th><th>Referral Code</th><th>Status</th><th>Joined</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($users as $u)
                <tr>
                    <td class="font-bold">{{ $u->name }}</td>
                    <td><span class="lowercase">{{ $u->email }}</span></td>
                    <td class="text-indigo-400 font-mono">{{ $u->referral_code }}</td>
                    <td><span class="px-2 py-1 text-xs rounded bg-{{ $u->status=='active'?'green':'red' }}-900 text-{{ $u->status=='active'?'green':'red' }}-300">{{ $u->status }}</span></td>
                    <td>{{ $u->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.users.show', $u->id) }}" class="p-1 text-blue-400 hover:text-blue-300" title="View"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('admin.users.edit', $u->id) }}" class="p-1 text-yellow-400 hover:text-yellow-300" title="Edit"><i class="fa-solid fa-pen"></i></a>
                            <button type="button" class="p-1 text-indigo-400 hover:text-indigo-300" title="Change Password" onclick="openPasswordModal({{ $u->id }}, '{{ addslashes($u->name) }}')"><i class="fa-solid fa-key"></i></button>
                            <form action="{{ route('admin.users.status', $u->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="p-1 {{ $u->status == 'active' ? 'text-orange-400 hover:text-orange-300' : 'text-green-400 hover:text-green-300' }}" title="{{ $u->status == 'active' ? 'Deactivate' : 'Activate' }}">
                                    <i class="fa-solid {{ $u->status == 'active' ? 'fa-ban' : 'fa-check' }}"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                <button type="submit" class="p-1 text-red-400 hover:text-red-300" title="Delete"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center p-8 text-gray-500">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4 border-t border-[#334155]">{{ $users->links() ?? '' }}</div>
    </div>
</div>

<!-- Change Password Modal -->
<div id="passwordModal" class="fixed inset-0 z-50 hidden bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-[#1a222d] border border-[#334155] rounded-xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all">
        <div class="px-6 py-4 border-b border-[#334155] flex justify-between items-center bg-[#0f172a]">
            <h3 class="text-lg font-bold text-gray-100 flex items-center gap-2">
                <i class="fa-solid fa-key text-indigo-400"></i> Change Password
            </h3>
            <button type="button" class="text-gray-400 hover:text-white transition" onclick="closePasswordModal()">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>
        <form id="passwordForm" method="POST" action="">
            @csrf
            <div class="p-6 space-y-4">
                <p class="text-sm text-gray-400 mb-2">Changing password for <strong id="pwdUserName" class="text-white"></strong></p>
                
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">New Password <span class="text-red-500">*</span></label>
                    <input type="password" name="new_password" required minlength="6" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2.5 text-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition" placeholder="Minimum 6 characters">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-1">Confirm New Password <span class="text-red-500">*</span></label>
                    <input type="password" name="confirm_password" required minlength="6" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2.5 text-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 transition" placeholder="Re-enter new password">
                </div>
            </div>
            
            <div class="px-6 py-4 border-t border-[#334155] bg-[#0f172a] flex justify-end gap-3">
                <button type="button" class="px-4 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-[#334155] transition" onclick="closePasswordModal()">Cancel</button>
                <button type="submit" class="px-4 py-2 rounded-lg text-sm font-medium bg-indigo-600 hover:bg-indigo-700 text-white shadow shadow-indigo-500/20 transition flex items-center gap-2">
                    <i class="fa-solid fa-save"></i> Update Password
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openPasswordModal(id, name) {
        document.getElementById('pwdUserName').textContent = name;
        document.getElementById('passwordForm').action = "{{ url('admin/users') }}/" + id + "/password";
        document.getElementById('passwordModal').classList.remove('hidden');
    }
    
    function closePasswordModal() {
        document.getElementById('passwordModal').classList.add('hidden');
        document.getElementById('passwordForm').reset();
    }
</script>
@endsection