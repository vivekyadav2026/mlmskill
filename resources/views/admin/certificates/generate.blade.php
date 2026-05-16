@extends('layouts.admin')
@section('content')
<div class="tailwind-scope mt-4 max-w-[1100px] mx-auto">
    <div class="mb-6 flex justify-between items-center flex-wrap gap-3">
        <div>
            <h2 class="text-2xl font-bold text-gray-100"><i class="fa-solid fa-certificate mr-2 text-yellow-400"></i>Issue Certificate</h2>
            <p class="text-gray-400 text-sm mt-1">Issue certificates module-wise to users who have completed their training.</p>
        </div>
        <a href="{{ route('admin.certificates.issued') }}" class="px-4 py-2 bg-[#334155] hover:bg-[#475569] text-white rounded shadow transition text-sm">
            <i class="fa-solid fa-list mr-1"></i> View All Issued
        </a>
    </div>

    @if(session('error'))
    <div class="bg-red-900/60 border border-red-500/50 text-red-300 p-4 mb-5 rounded-lg flex items-center gap-2">
        <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
    </div>
    @endif
    @if(session('success'))
    <div class="bg-green-900/60 border border-green-500/50 text-green-300 p-4 mb-5 rounded-lg flex items-center gap-2">
        <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- LEFT: Pending Users --}}
        <div class="bg-[#1a222d] border border-[#334155] rounded-lg overflow-hidden shadow-xl">
            <div class="flex items-center justify-between p-4 border-b border-[#334155] bg-[#0f172a]">
                <div>
                    <h3 class="text-gray-100 font-semibold"><i class="fa-solid fa-hourglass-half mr-2 text-yellow-400"></i>Pending Certificate Requests</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Users who completed training but haven't received a certificate yet.</p>
                </div>
                <span class="bg-yellow-900/60 text-yellow-300 border border-yellow-700/50 px-2 py-1 rounded text-xs font-bold">
                    {{ $pendingUsers->count() }} Pending
                </span>
            </div>

            @if($pendingUsers->isEmpty())
            <div class="p-10 text-center text-gray-500">
                <i class="fa-solid fa-check-circle text-4xl text-green-700 mb-3 block"></i>
                All completed users already have certificates!
            </div>
            @else
            <div class="divide-y divide-[#334155] max-h-[500px] overflow-y-auto">
                @foreach($pendingUsers as $pu)
                <div class="flex items-center gap-3 p-4 hover:bg-[#1e293b] transition group">
                    <div class="w-10 h-10 rounded-full bg-indigo-800 text-indigo-200 flex items-center justify-center font-bold text-sm flex-shrink-0">
                        {{ strtoupper(substr($pu->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="font-medium text-gray-200 text-sm truncate">{{ $pu->name }}</div>
                        <div class="text-xs text-gray-500 truncate">{{ $pu->email }}</div>
                        <div class="text-xs font-mono text-indigo-400 mt-0.5">{{ $pu->referral_code }}</div>
                        <div class="text-xs text-green-400 mt-0.5">
                            <i class="fa-solid fa-graduation-cap mr-1"></i>
                            Completed {{ $pu->course_completed_at->diffForHumans() }}
                        </div>
                    </div>
                    <button type="button"
                        onclick="quickIssue({{ $pu->id }}, '{{ addslashes($pu->name) }}', '{{ addslashes($pu->email) }}', '{{ $pu->referral_code }}')"
                        class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-500 text-white text-xs rounded-lg transition flex-shrink-0 opacity-0 group-hover:opacity-100">
                        <i class="fa-solid fa-certificate mr-1"></i> Issue
                    </button>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        {{-- RIGHT: Issue Form --}}
        <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6 shadow-xl">
            <h3 class="text-gray-100 font-semibold mb-4"><i class="fa-solid fa-pen-to-square mr-2 text-indigo-400"></i>Issue Certificate</h3>

            <form action="{{ route('admin.certificates.generate') }}" method="POST">
                @csrf

                {{-- User Search --}}
                <div class="mb-5">
                    <label class="block text-gray-300 font-medium mb-2 text-sm">
                        <i class="fa-solid fa-user mr-1 text-indigo-400"></i> Select User
                    </label>
                    <div class="relative">
                        <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-sm"></i>
                        <input type="text" id="userSearch" placeholder="Search by name, email or SD-ID..."
                            autocomplete="off"
                            class="w-full bg-[#0f172a] border border-[#334155] text-white pl-9 pr-4 py-2.5 rounded-lg focus:outline-none focus:border-indigo-500 text-sm transition">
                    </div>
                    <div id="userDropdown" class="hidden mt-1 bg-[#0f172a] border border-[#334155] rounded-lg overflow-hidden shadow-xl max-h-52 overflow-y-auto relative z-10"></div>
                    <input type="hidden" name="user_id" id="user_id" required>
                    <div id="selectedUser" class="mt-2 hidden">
                        <div class="flex items-center gap-3 bg-indigo-900/20 border border-indigo-700/40 rounded-lg p-3">
                            <div id="selAvatar" class="w-9 h-9 rounded-full bg-indigo-700 text-white flex items-center justify-center font-bold text-sm flex-shrink-0"></div>
                            <div class="flex-1 min-w-0">
                                <div id="selName" class="text-white font-semibold text-sm"></div>
                                <div id="selMeta" class="text-indigo-400 text-xs font-mono truncate"></div>
                            </div>
                            <button type="button" onclick="clearUser()" class="text-gray-500 hover:text-red-400 transition">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Module Select --}}
                <div class="mb-6">
                    <label for="module_id" class="block text-gray-300 font-medium mb-2 text-sm">
                        <i class="fa-solid fa-layer-group mr-1 text-green-400"></i> Select Module
                    </label>
                    <select name="module_id" id="module_id" class="w-full bg-[#0f172a] border border-[#334155] text-white rounded-lg px-4 py-2.5 focus:outline-none focus:border-indigo-500 text-sm" required>
                        <option value="" disabled selected>-- Choose a Module --</option>
                        @foreach($modules as $module)
                            <option value="{{ $module->id }}">{{ $module->name }}</option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-600 mt-2">
                        <i class="fa-solid fa-info-circle mr-1"></i>
                        The certificate will be issued for the selected module.
                    </p>
                </div>

                <button type="submit" class="w-full px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg shadow-lg transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-certificate"></i> Generate & Issue Certificate
                </button>
            </form>
        </div>
    </div>
</div>

<script>
const allUsers = @json($usersJson);
const searchEl  = document.getElementById('userSearch');
const dropdown  = document.getElementById('userDropdown');
const hiddenId  = document.getElementById('user_id');

searchEl.addEventListener('input', function() {
    const q = this.value.trim().toLowerCase();
    if (!q) { dropdown.classList.add('hidden'); return; }
    const matches = allUsers.filter(u =>
        u.name.toLowerCase().includes(q) ||
        u.email.toLowerCase().includes(q) ||
        u.code.toLowerCase().includes(q)
    ).slice(0, 10);

    dropdown.innerHTML = matches.length
        ? matches.map(u => `
            <div class="flex items-center gap-3 px-4 py-2.5 cursor-pointer hover:bg-indigo-900/30 border-b border-[#334155] transition"
                 onclick="selectUser(${u.id},'${u.name.replace(/'/g,"\\'")}','${u.email}','${u.code}')">
                <div class="w-8 h-8 rounded-full ${u.completed ? 'bg-green-700' : 'bg-indigo-700'} text-white flex items-center justify-center font-bold text-xs flex-shrink-0">${u.name.charAt(0).toUpperCase()}</div>
                <div>
                    <div class="text-white text-sm font-medium">${u.name} ${u.completed ? '<span style="color:#86efac;font-size:0.65rem">&#10003; Completed</span>' : ''}</div>
                    <div class="text-gray-400 text-xs">${u.email} &bull; <span class="font-mono text-indigo-400">${u.code}</span></div>
                </div>
            </div>`).join('')
        : '<div class="p-3 text-gray-500 text-sm">No users found.</div>';
    dropdown.classList.remove('hidden');
});

document.addEventListener('click', e => {
    if (!e.target.closest('#userSearch') && !e.target.closest('#userDropdown')) dropdown.classList.add('hidden');
});

function selectUser(id, name, email, code) {
    hiddenId.value = id;
    searchEl.value = '';
    dropdown.classList.add('hidden');
    document.getElementById('selAvatar').textContent = name.charAt(0).toUpperCase();
    document.getElementById('selName').textContent   = name;
    document.getElementById('selMeta').textContent   = code + ' · ' + email;
    document.getElementById('selectedUser').classList.remove('hidden');
}

function clearUser() {
    hiddenId.value = '';
    document.getElementById('selectedUser').classList.add('hidden');
    searchEl.value = '';
    searchEl.focus();
}

function quickIssue(id, name, email, code) {
    selectUser(id, name, email, code);
    document.getElementById('module_id').focus();
    window.scrollTo({ top: document.getElementById('module_id').getBoundingClientRect().top + window.scrollY - 100, behavior: 'smooth' });
}
</script>
@endsection