@extends('layouts.admin')
@section('content')
<style>
  .s-card { background:#1a222d; border:1px solid #334155; border-radius:.75rem; margin-bottom:1.5rem; overflow:hidden; }
  .s-header { background:#0f172a; padding:.85rem 1.5rem; border-bottom:1px solid #334155; display:flex; align-items:center; gap:.75rem; }
  .s-header h3 { color:#e2e8f0; font-weight:600; margin:0; font-size:.95rem; flex:1; }
  .tbl th { background:#0f172a; color:#94a3b8; font-size:.75rem; text-transform:uppercase; font-weight:600; padding:.75rem 1rem; border-bottom:1px solid #334155; }
  .tbl td { padding:.9rem 1rem; border-bottom:1px solid #1e293b; color:#e2e8f0; vertical-align:middle; }
  .tbl tr:hover td { background:#1e293b; }
  .f-ctrl { background:#0f172a; border:1px solid #334155; color:#e2e8f0; border-radius:.5rem; padding:.55rem .9rem; width:100%; }
  .f-ctrl:focus { outline:none; border-color:#6366f1; }
  .group-header { background:#1e293b; padding:.6rem 1rem; font-size:.7rem; color:#6366f1; font-weight:700; text-transform:uppercase; letter-spacing:.08em; border-bottom:1px solid #334155; }
</style>

<div class="tailwind-scope mt-4 max-w-[1400px] mx-auto">
  <div class="flex justify-between items-center mb-6">
    <div>
      <h2 class="text-2xl font-bold text-gray-100">Permissions</h2>
      <p class="text-gray-400 text-sm">Define system permissions grouped by module</p>
    </div>
    <div class="flex gap-2">
      <a href="{{ url('admin/roles') }}" class="px-3 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg text-sm transition">
        <i class="fa-solid fa-arrow-left mr-1"></i> Back to Roles
      </a>
      <button onclick="document.getElementById('addModal').classList.remove('hidden')"
        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow transition text-sm font-semibold">
        <i class="fa-solid fa-plus mr-1"></i> Add Permission
      </button>
    </div>
  </div>

  @if(session('success'))
    <div class="bg-green-900/40 border border-green-500/50 text-green-300 px-4 py-3 rounded-lg mb-4 flex items-center gap-2">
      <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
    </div>
  @endif

  @forelse($permissions as $group => $perms)
  <div class="s-card">
    <div class="s-header">
      <i class="fa-solid fa-layer-group text-indigo-400"></i>
      <h3>{{ ucfirst($group) }} <span class="text-gray-500 font-normal text-xs ml-2">({{ $perms->count() }} permissions)</span></h3>
    </div>
    <table class="w-full tbl">
      <thead>
        <tr>
          <th>Permission</th>
          <th>Slug</th>
          <th>Assigned to Roles</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($perms as $perm)
        <tr>
          <td class="font-medium text-gray-200">{{ $perm->display_name }}</td>
          <td class="font-mono text-xs text-gray-400">{{ $perm->name }}</td>
          <td>
            @foreach($perm->roles as $r)
              <span class="inline-block bg-indigo-900/50 text-indigo-300 text-xs px-2 py-0.5 rounded mr-1 mb-1 border border-indigo-500/30">{{ $r->display_name }}</span>
            @endforeach
            @if($perm->roles->isEmpty())
              <span class="text-gray-600 text-xs">— unassigned</span>
            @endif
          </td>
          <td>
            <form action="{{ url('admin/permissions/'.$perm->id.'/delete') }}" method="POST"
                  onsubmit="return confirm('Delete permission?')">
              @csrf
              <button type="submit" class="text-red-400 hover:text-red-300 text-sm">
                <i class="fa-solid fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @empty
  <div class="s-card p-12 text-center text-gray-500">
    <i class="fa-solid fa-key text-4xl mb-3 block text-gray-600"></i>
    No permissions defined yet. Add some below.
  </div>
  @endforelse

  <!-- Quick add default permissions -->
  <div class="s-card">
    <div class="s-header"><i class="fa-solid fa-bolt text-yellow-400"></i><h3>Quick Seed Default Permissions</h3></div>
    <div class="p-5">
      <p class="text-gray-400 text-sm mb-4">Click to insert all standard system permissions at once.</p>
      <form action="{{ url('admin/permissions/seed') }}" method="POST">
        @csrf
        <button type="submit" class="px-5 py-2 bg-yellow-700 hover:bg-yellow-600 text-white font-semibold rounded-lg transition text-sm">
          <i class="fa-solid fa-seedling mr-1"></i> Seed Default Permissions
        </button>
      </form>
    </div>
  </div>
</div>

<!-- Add Permission Modal -->
<div id="addModal" class="hidden fixed inset-0 z-50 bg-black/60 flex items-center justify-center backdrop-blur-sm">
  <div class="bg-[#1a222d] border border-[#334155] rounded-xl w-full max-w-md p-6 shadow-2xl">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-lg font-bold text-white">Add Permission</h3>
      <button onclick="document.getElementById('addModal').classList.add('hidden')" class="text-gray-400 hover:text-white">
        <i class="fa-solid fa-times text-xl"></i>
      </button>
    </div>
    <form action="{{ url('admin/permissions') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label class="text-gray-400 text-xs font-semibold uppercase block mb-1">Display Name</label>
        <input type="text" name="display_name" class="f-ctrl" required placeholder="e.g. Manage Users">
      </div>
      <div class="mb-3">
        <label class="text-gray-400 text-xs font-semibold uppercase block mb-1">Slug</label>
        <input type="text" name="name" class="f-ctrl" required placeholder="e.g. manage_users">
      </div>
      <div class="mb-5">
        <label class="text-gray-400 text-xs font-semibold uppercase block mb-1">Group / Module</label>
        <input type="text" name="group" list="group_list" class="f-ctrl" required placeholder="e.g. users, finance, settings">
        <datalist id="group_list">
          <option value="users"><option value="finance"><option value="settings">
          <option value="courses"><option value="reports"><option value="withdrawals">
          <option value="tokens"><option value="commissions"><option value="cms">
        </datalist>
      </div>
      <div class="flex justify-end gap-3">
        <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')"
          class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600 transition">Cancel</button>
        <button type="submit" class="px-5 py-2 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700 transition">
          Add Permission
        </button>
      </div>
    </form>
  </div>
</div>
@endsection