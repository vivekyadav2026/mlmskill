@extends('layouts.admin')
@section('content')
<style>
  .s-card { background:#1a222d; border:1px solid #334155; border-radius:.75rem; margin-bottom:1.5rem; overflow:hidden; }
  .s-header { background:#0f172a; padding:.85rem 1.5rem; border-bottom:1px solid #334155; display:flex; align-items:center; gap:.75rem; }
  .s-header h3 { color:#e2e8f0; font-weight:600; margin:0; font-size:.95rem; flex:1; }
  .role-tab { display:flex; align-items:center; gap:.6rem; padding:.7rem 1.2rem; border-radius:.5rem; cursor:pointer;
    border:1px solid transparent; color:#94a3b8; font-size:.85rem; font-weight:500; transition:all .15s; text-decoration:none; }
  .role-tab:hover { background:#1e293b; color:#e2e8f0; }
  .role-tab.active { background:#312e81; border-color:#4f46e5; color:#a5b4fc; font-weight:600; }
  .role-tab .badge { background:#1e293b; color:#6366f1; font-size:.65rem; padding:.1rem .45rem; border-radius:9999px; font-weight:700; }
  .role-tab.active .badge { background:#4338ca; color:#c7d2fe; }
  .perm-row { display:flex; align-items:center; justify-content:space-between; padding:.75rem 1rem;
    border-bottom:1px solid #1e293b; transition:background .1s; }
  .perm-row:last-child { border-bottom:none; }
  .perm-row:hover { background:#1a2636; }
  .perm-row label { display:flex; align-items:center; gap:.75rem; cursor:pointer; flex:1; }
  .group-pill { display:inline-block; background:#1e293b; color:#6366f1; font-size:.65rem; font-weight:700;
    text-transform:uppercase; letter-spacing:.06em; padding:.25rem .7rem; border-radius:9999px; margin-bottom:.6rem; }
  .progress-bar { height:4px; background:#334155; border-radius:2px; margin-top:.5rem; }
  .progress-fill { height:4px; background:linear-gradient(90deg,#6366f1,#8b5cf6); border-radius:2px; transition:width .3s; }
</style>

<div class="tailwind-scope mt-4 max-w-[1300px] mx-auto">

  {{-- Page header --}}
  <div class="flex justify-between items-center mb-6">
    <div>
      <h2 class="text-2xl font-bold text-gray-100">Assign Permissions to Role</h2>
      <p class="text-gray-400 text-sm">Select a role on the left, then check the permissions for it</p>
    </div>
    <div class="flex gap-2">
      <a href="{{ url('admin/roles') }}" class="px-3 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg text-sm transition">
        <i class="fa-solid fa-user-shield mr-1"></i> All Roles
      </a>
      <a href="{{ url('admin/permissions') }}" class="px-3 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg text-sm transition">
        <i class="fa-solid fa-key mr-1"></i> All Permissions
      </a>
    </div>
  </div>

  @if(session('success'))
    <div class="bg-green-900/40 border border-green-500/50 text-green-300 px-4 py-3 rounded-lg mb-4 flex items-center gap-2">
      <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
    </div>
  @endif
  @if(session('error'))
    <div class="bg-red-900/40 border border-red-500/50 text-red-300 px-4 py-3 rounded-lg mb-4">{{ session('error') }}</div>
  @endif

  @if($roles->isEmpty())
    <div class="s-card p-12 text-center text-gray-500">
      <i class="fa-solid fa-user-shield text-4xl mb-3 block text-gray-600"></i>
      No roles exist yet.
      <a href="{{ url('admin/roles') }}" class="text-indigo-400 hover:underline ml-1">Create roles first →</a>
    </div>
  @else
  <div class="grid grid-cols-12 gap-5">

    {{-- LEFT: Role selector --}}
    <div class="col-span-12 md:col-span-3">
      <div class="s-card sticky top-4">
        <div class="s-header"><i class="fa-solid fa-user-shield text-indigo-400"></i><h3>Roles</h3></div>
        <div class="p-3 flex flex-col gap-1">
          @foreach($roles as $role)
            <a href="{{ url('admin/permissions/assign?role_id='.$role->id) }}"
               class="role-tab {{ $selectedRole && $selectedRole->id === $role->id ? 'active' : '' }}">
              <span class="flex-1">{{ $role->display_name }}</span>
              <span class="badge">{{ $role->permissions->count() }}</span>
            </a>
          @endforeach
        </div>
      </div>
    </div>

    {{-- RIGHT: Permission checkboxes --}}
    <div class="col-span-12 md:col-span-9">
      @if($selectedRole)

        {{-- Role summary banner --}}
        <div class="bg-indigo-900/20 border border-indigo-500/30 rounded-xl p-4 mb-4 flex items-center gap-4">
          <div class="w-11 h-11 bg-indigo-600/30 border border-indigo-500/40 rounded-full flex items-center justify-center shrink-0">
            <i class="fa-solid fa-user-shield text-indigo-400"></i>
          </div>
          <div class="flex-1 min-w-0">
            <h3 class="text-indigo-200 font-bold text-base">{{ $selectedRole->display_name }}</h3>
            <p class="text-gray-400 text-xs">{{ $selectedRole->description ?: 'No description.' }}</p>
            <div class="progress-bar mt-1">
              @php $total = $permissions->flatten()->count(); $assigned = $selectedRole->permissions->count(); @endphp
              <div class="progress-fill" style="width:{{ $total > 0 ? round($assigned/$total*100) : 0 }}%"></div>
            </div>
          </div>
          <div class="text-right shrink-0">
            <p class="text-xl font-bold text-indigo-300">{{ $assigned }}/{{ $total }}</p>
            <p class="text-gray-500 text-xs">permissions</p>
          </div>
        </div>

        <form action="{{ url('admin/permissions/assign') }}" method="POST" id="assignForm">
          @csrf
          <input type="hidden" name="role_id" value="{{ $selectedRole->id }}">

          {{-- Select All / Deselect All --}}
          <div class="flex justify-between items-center mb-3">
            <p class="text-gray-400 text-sm">
              <span id="checkedCount">{{ $assigned }}</span> of {{ $total }} permissions enabled
            </p>
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

          {{-- Permission groups --}}
          @foreach($permissions as $group => $perms)
          <div class="s-card mb-4">
            <div class="s-header">
              <i class="fa-solid fa-layer-group text-indigo-400"></i>
              <h3>{{ ucfirst($group) }}</h3>
              <span class="ml-auto">
                <span class="text-indigo-400 text-xs font-semibold" id="gc-{{ $group }}">
                  {{ $perms->filter(fn($p) => $selectedRole->permissions->contains($p->id))->count() }}
                </span>
                <span class="text-gray-500 text-xs">/{{ $perms->count() }}</span>
              </span>
            </div>

            {{-- Group select all --}}
            <div class="px-4 pt-3 pb-1 flex gap-2">
              <button type="button" onclick="toggleGroup('group-{{ $group }}', true)"
                class="text-xs text-indigo-400 hover:text-indigo-300 transition">+ All</button>
              <span class="text-gray-600">|</span>
              <button type="button" onclick="toggleGroup('group-{{ $group }}', false)"
                class="text-xs text-gray-500 hover:text-gray-300 transition">− None</button>
            </div>

            <div>
              @foreach($perms as $perm)
              <div class="perm-row">
                <label>
                  <input type="checkbox" name="permissions[]" value="{{ $perm->id }}"
                    class="perm-cb group-{{ $group }} w-4 h-4 accent-indigo-500"
                    onchange="updateCount()"
                    {{ $selectedRole->permissions->contains($perm->id) ? 'checked' : '' }}>
                  <div>
                    <p class="text-gray-200 text-sm font-medium leading-tight">{{ $perm->display_name }}</p>
                    <p class="text-gray-500 text-xs font-mono">{{ $perm->name }}</p>
                  </div>
                </label>
              </div>
              @endforeach
            </div>
          </div>
          @endforeach

          @if($permissions->isEmpty())
          <div class="s-card p-10 text-center text-gray-500">
            <i class="fa-solid fa-key text-3xl mb-3 block text-gray-600"></i>
            No permissions exist yet.
            <a href="{{ url('admin/permissions') }}" class="text-indigo-400 hover:underline ml-1">
              Create or seed permissions first →
            </a>
          </div>
          @endif

          <div class="flex justify-between items-center mt-4">
            <p class="text-gray-500 text-sm">Changes saved immediately to the database.</p>
            <button type="submit"
              class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow transition flex items-center gap-2">
              <i class="fa-solid fa-floppy-disk"></i> Save Permissions
            </button>
          </div>
        </form>

      @else
        <div class="s-card p-10 text-center text-gray-500">
          <i class="fa-solid fa-arrow-left text-3xl mb-3 block text-gray-600"></i>
          Select a role from the left panel.
        </div>
      @endif
    </div>
  </div>
  @endif
</div>

<script>
function toggleAll(state) {
  document.querySelectorAll('.perm-cb').forEach(cb => cb.checked = state);
  updateCount();
}

function toggleGroup(cls, state) {
  document.querySelectorAll('.' + cls).forEach(cb => cb.checked = state);
  updateCount();
}

function updateCount() {
  const all     = document.querySelectorAll('.perm-cb');
  const checked = document.querySelectorAll('.perm-cb:checked');
  const el = document.getElementById('checkedCount');
  if (el) el.textContent = checked.length;
}
</script>
@endsection
