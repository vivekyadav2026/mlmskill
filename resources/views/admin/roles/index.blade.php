@extends('layouts.admin')
@section('content')
<style>
  .s-card { background:#1a222d; border:1px solid #334155; border-radius:.75rem; margin-bottom:1.5rem; overflow:hidden; }
  .s-header { background:#0f172a; padding:.85rem 1.5rem; border-bottom:1px solid #334155; display:flex; align-items:center; gap:.75rem; }
  .s-header h3 { color:#e2e8f0; font-weight:600; margin:0; font-size:.95rem; flex:1; }
  .tbl th { background:#0f172a; color:#94a3b8; font-size:.75rem; text-transform:uppercase; font-weight:600; padding:.75rem 1rem; border-bottom:1px solid #334155; }
  .tbl td { padding:.9rem 1rem; border-bottom:1px solid #1e293b; color:#e2e8f0; vertical-align:middle; }
  .tbl tr:hover td { background:#1e293b; }
  .badge-role { display:inline-block; padding:.2rem .65rem; border-radius:9999px; font-size:.7rem; font-weight:700; text-transform:uppercase; letter-spacing:.05em; }
  .f-ctrl { background:#0f172a; border:1px solid #334155; color:#e2e8f0; border-radius:.5rem; padding:.55rem .9rem; width:100%; }
  .f-ctrl:focus { outline:none; border-color:#6366f1; }
</style>

<div class="tailwind-scope mt-4 max-w-[1400px] mx-auto">
  <div class="flex justify-between items-center mb-6">
    <div>
      <h2 class="text-2xl font-bold text-gray-100">Roles Management</h2>
      <p class="text-gray-400 text-sm">Create and manage admin roles. Assign permissions per role.</p>
    </div>
    <button class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow transition text-sm font-semibold"
      onclick="document.getElementById('addModal').classList.remove('hidden')">
      <i class="fa-solid fa-plus mr-1"></i> Create Role
    </button>
  </div>

  @if(session('success'))
    <div class="bg-green-900/40 border border-green-500/50 text-green-300 px-4 py-3 rounded-lg mb-4 flex items-center gap-2">
      <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
    </div>
  @endif
  @if(session('error'))
    <div class="bg-red-900/40 border border-red-500/50 text-red-300 px-4 py-3 rounded-lg mb-4">{{ session('error') }}</div>
  @endif

  <div class="s-card">
    <div class="s-header">
      <i class="fa-solid fa-user-shield text-indigo-400"></i>
      <h3>All Roles ({{ $roles->count() }})</h3>
    </div>
    <table class="w-full tbl">
      <thead>
        <tr>
          <th>Role</th>
          <th>Slug</th>
          <th>Permissions</th>
          <th>Users Assigned</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($roles as $role)
        <tr>
          <td>
            <span class="badge-role bg-{{ $role->color }}-900/50 text-{{ $role->color }}-300 border border-{{ $role->color }}-500/40">
              {{ $role->display_name }}
            </span>
            @if($role->description)
              <p class="text-gray-500 text-xs mt-1">{{ $role->description }}</p>
            @endif
          </td>
          <td class="font-mono text-sm text-gray-400">{{ $role->name }}</td>
          <td>
            <span class="text-indigo-300 font-semibold">{{ $role->permissions->count() }}</span>
            <span class="text-gray-500 text-sm"> permissions</span>
          </td>
          <td>
            <span class="text-yellow-300 font-semibold">{{ $role->users_count }}</span>
            <span class="text-gray-500 text-sm"> users</span>
          </td>
          <td class="flex items-center gap-2">
            <a href="{{ url('admin/roles/'.$role->id.'/permissions') }}"
               class="px-3 py-1 bg-indigo-700 hover:bg-indigo-600 text-white text-xs rounded transition">
              <i class="fa-solid fa-key mr-1"></i> Permissions
            </a>
            <form action="{{ url('admin/roles/'.$role->id.'/delete') }}" method="POST"
                  onsubmit="return confirm('Delete role {{ $role->display_name }}?')">
              @csrf
              <button type="submit" class="px-3 py-1 bg-red-800 hover:bg-red-700 text-white text-xs rounded transition">
                <i class="fa-solid fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="5" class="text-center py-12 text-gray-500">
            <i class="fa-solid fa-user-shield text-4xl mb-3 block text-gray-600"></i>
            No roles created yet.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Assign or Remove role -->
  <div class="s-card">
    <div class="s-header"><i class="fa-solid fa-user-tag text-yellow-400"></i><h3>Assign / Remove Role</h3></div>
    <div class="p-5">
      <form action="{{ url('admin/roles/assign-user') }}" method="POST" class="flex flex-wrap gap-3 items-end">
        @csrf
        <div class="flex-grow min-w-[220px]">
          <label class="text-gray-400 text-xs font-semibold uppercase block mb-1">User (Email)</label>
          <input type="text" name="user_id" list="user_list" placeholder="Search user email..."
            class="f-ctrl" required>
          <datalist id="user_list">
            @foreach(\App\Models\User::select('id','name','email')->latest()->take(200)->get() as $u)
              <option value="{{ $u->id }}" label="{{ $u->name }} — {{ $u->email }}">{{ $u->name }} ({{ $u->email }})</option>
            @endforeach
          </datalist>
        </div>
        <div class="min-w-[180px]">
          <label class="text-gray-400 text-xs font-semibold uppercase block mb-1">Role</label>
          <select name="role" class="f-ctrl">
            <option value="">-- None (Remove Role) --</option>
            @foreach($roles as $role)
              <option value="{{ $role->name }}">{{ $role->display_name }}</option>
            @endforeach
          </select>
        </div>
        <button type="submit" class="px-5 py-2 bg-yellow-600 hover:bg-yellow-500 text-white font-semibold rounded-lg transition">
          <i class="fa-solid fa-check mr-1"></i> Apply
        </button>
      </form>
    </div>
  </div>
</div>

<!-- Create Role Modal -->
<div id="addModal" class="hidden fixed inset-0 z-50 bg-black/60 flex items-center justify-center backdrop-blur-sm">
  <div class="bg-[#1a222d] border border-[#334155] rounded-xl w-full max-w-md p-6 shadow-2xl">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-lg font-bold text-white">Create New Role</h3>
      <button onclick="document.getElementById('addModal').classList.add('hidden')" class="text-gray-400 hover:text-white">
        <i class="fa-solid fa-times text-xl"></i>
      </button>
    </div>
    <form action="{{ url('admin/roles') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label class="text-gray-400 text-xs font-semibold uppercase block mb-1">Display Name</label>
        <input type="text" name="display_name" class="f-ctrl" required placeholder="e.g. Support Manager">
      </div>
      <div class="mb-3">
        <label class="text-gray-400 text-xs font-semibold uppercase block mb-1">Slug (unique identifier)</label>
        <input type="text" name="name" class="f-ctrl" required placeholder="e.g. support_manager">
        <p class="text-gray-500 text-xs mt-1">Lowercase, underscores only. Cannot be changed later.</p>
      </div>
      <div class="mb-3">
        <label class="text-gray-400 text-xs font-semibold uppercase block mb-1">Description</label>
        <input type="text" name="description" class="f-ctrl" placeholder="Optional description...">
      </div>
      <div class="mb-5">
        <label class="text-gray-400 text-xs font-semibold uppercase block mb-1">Badge Color</label>
        <select name="color" class="f-ctrl">
          <option value="indigo">Indigo</option>
          <option value="green">Green</option>
          <option value="blue">Blue</option>
          <option value="yellow">Yellow</option>
          <option value="red">Red</option>
          <option value="purple">Purple</option>
          <option value="orange">Orange</option>
        </select>
      </div>
      <div class="flex justify-end gap-3">
        <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')"
          class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600 transition">Cancel</button>
        <button type="submit" class="px-5 py-2 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700 transition">
          Create Role
        </button>
      </div>
    </form>
  </div>
</div>
@endsection