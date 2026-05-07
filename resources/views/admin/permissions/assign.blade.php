@extends('layouts.admin')
@section('content')
<style>
  .s-card { background:#1a222d; border:1px solid #334155; border-radius:.75rem; margin-bottom:1.5rem; overflow:hidden; }
  .s-header { background:#0f172a; padding:.85rem 1.5rem; border-bottom:1px solid #334155; display:flex; align-items:center; gap:.75rem; }
  .s-header h3 { color:#e2e8f0; font-weight:600; margin:0; font-size:.95rem; flex:1; }
  .perm-card { background:#0f172a; border:1px solid #334155; border-radius:.5rem; padding:1rem; margin-bottom:.5rem; display:flex; align-items:center; justify-content:space-between; }
  .group-label { background:#1e293b; color:#6366f1; font-size:.7rem; font-weight:700; text-transform:uppercase; letter-spacing:.06em; padding:.3rem .8rem; border-radius:9999px; margin-bottom:.75rem; display:inline-block; }
  .toggle-label { display:flex; align-items:center; gap:.75rem; cursor:pointer; }
</style>

<div class="tailwind-scope mt-4 max-w-3xl mx-auto">
  <div class="flex justify-between items-center mb-6">
    <div>
      <h2 class="text-2xl font-bold text-gray-100">Assign Permissions</h2>
      <p class="text-gray-400 text-sm">Configure what the <strong class="text-indigo-400">{{ $role->display_name }}</strong> role can access</p>
    </div>
    <a href="{{ url('admin/roles') }}" class="px-3 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg text-sm transition">
      <i class="fa-solid fa-arrow-left mr-1"></i> Back to Roles
    </a>
  </div>

  @if(session('success'))
    <div class="bg-green-900/40 border border-green-500/50 text-green-300 px-4 py-3 rounded-lg mb-4 flex items-center gap-2">
      <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
    </div>
  @endif

  <!-- Role info banner -->
  <div class="bg-indigo-900/20 border border-indigo-500/30 rounded-xl p-4 mb-6 flex items-center gap-4">
    <div class="w-12 h-12 bg-indigo-600/30 border border-indigo-500/50 rounded-full flex items-center justify-center">
      <i class="fa-solid fa-user-shield text-indigo-400 text-lg"></i>
    </div>
    <div>
      <h3 class="text-indigo-200 font-bold text-lg">{{ $role->display_name }}</h3>
      <p class="text-gray-400 text-sm">{{ $role->description ?: 'No description provided.' }}</p>
    </div>
    <div class="ml-auto text-right">
      <p class="text-2xl font-bold text-indigo-300">{{ $role->permissions->count() }}</p>
      <p class="text-gray-500 text-xs">active permissions</p>
    </div>
  </div>

  <form action="{{ url('admin/roles/'.$role->id.'/permissions') }}" method="POST">
    @csrf

    <!-- Select All / Deselect All -->
    <div class="flex justify-between items-center mb-4">
      <p class="text-gray-400 text-sm">Check the permissions you want this role to have:</p>
      <div class="flex gap-2">
        <button type="button" onclick="toggleAll(true)"
          class="px-3 py-1.5 bg-indigo-700 hover:bg-indigo-600 text-white text-xs rounded transition">
          ✓ Select All
        </button>
        <button type="button" onclick="toggleAll(false)"
          class="px-3 py-1.5 bg-gray-700 hover:bg-gray-600 text-white text-xs rounded transition">
          ✗ Deselect All
        </button>
      </div>
    </div>

    @foreach($permissions as $group => $perms)
    <div class="s-card mb-4">
      <div class="s-header">
        <i class="fa-solid fa-layer-group text-indigo-400"></i>
        <h3>{{ ucfirst($group) }}</h3>
        <span class="ml-auto text-gray-500 text-xs">{{ $perms->count() }} permissions</span>
      </div>
      <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-2">
        @foreach($perms as $perm)
        <label class="perm-card hover:border-indigo-500/50 transition cursor-pointer">
          <div>
            <p class="text-gray-200 text-sm font-medium">{{ $perm->display_name }}</p>
            <p class="text-gray-500 text-xs font-mono">{{ $perm->name }}</p>
          </div>
          <input type="checkbox" name="permissions[]" value="{{ $perm->id }}" class="perm-cb w-4 h-4 accent-indigo-500"
            {{ $role->permissions->contains($perm->id) ? 'checked' : '' }}>
        </label>
        @endforeach
      </div>
    </div>
    @endforeach

    @if($permissions->isEmpty())
    <div class="s-card p-10 text-center text-gray-500">
      <i class="fa-solid fa-key text-3xl mb-3 block text-gray-600"></i>
      No permissions exist yet.
      <a href="{{ url('admin/permissions') }}" class="text-indigo-400 hover:underline ml-1">Create permissions first →</a>
    </div>
    @endif

    <div class="flex justify-end mt-4">
      <button type="submit"
        class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow transition">
        <i class="fa-solid fa-floppy-disk mr-2"></i> Save Permissions
      </button>
    </div>
  </form>
</div>

<script>
function toggleAll(state) {
  document.querySelectorAll('.perm-cb').forEach(cb => cb.checked = state);
}
</script>
@endsection