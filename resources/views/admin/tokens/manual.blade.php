@extends('layouts.admin')
@section('content')
{{-- Tom Select CSS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.min.css">
<style>
/* ── Tom Select dark-theme overrides ── */
.ts-wrapper.full .ts-control,
.ts-control {
    background: #0b1220 !important;
    border: 1px solid #334155 !important;
    color: #f1f5f9 !important;
    border-radius: 0.5rem !important;
    padding: 0.6rem 1rem !important;
    min-height: 48px !important;
    box-shadow: none !important;
}
.ts-control input {
    color: #f1f5f9 !important;
    background: transparent !important;
}
.ts-control input::placeholder { color: #64748b !important; }
.ts-dropdown {
    background: #0f172a !important;
    border: 1px solid #334155 !important;
    border-radius: 0.5rem !important;
    box-shadow: 0 10px 40px rgba(0,0,0,0.5) !important;
    margin-top: 4px !important;
    overflow: hidden;
}
.ts-dropdown .ts-dropdown-content { padding: 4px !important; }
.ts-dropdown .option {
    color: #e2e8f0 !important;
    padding: 0.6rem 0.85rem !important;
    border-radius: 0.35rem;
    font-size: 0.875rem;
    cursor: pointer;
    transition: background 0.15s;
}
.ts-dropdown .option:hover,
.ts-dropdown .option.active  { background: #1e3a5f !important; color: #fff !important; }
.ts-dropdown .option.selected { background: rgba(99,102,241,.2) !important; color: #a5b4fc !important; }
.ts-control .item            { color: #f1f5f9 !important; background: transparent !important; }
</style>

<div class="tailwind-scope mt-4 max-w-2xl mx-auto">

    {{-- Header --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">Manual Token Credit</h2>
        <p class="text-gray-400 text-sm mt-1">Manually credit NEXA 1.0 or NEXA 2.0 to any active user. All credits are logged.</p>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
    <div class="flex items-center gap-3 bg-green-500/10 border border-green-700 text-green-400 p-4 rounded-lg mb-6">
        <i class="fa-solid fa-circle-check text-xl flex-shrink-0"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    {{-- Error Alert --}}
    @if($errors->any())
    <div class="bg-red-500/10 border border-red-700 text-red-400 p-4 rounded-lg mb-6">
        <i class="fa-solid fa-triangle-exclamation mr-2"></i>
        <strong>Please fix the errors below:</strong>
        <ul class="mt-2 list-disc list-inside text-sm">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Form --}}
    <div class="bg-[#1a222d] border border-[#334155] rounded-lg p-6">
        <form method="POST" action="{{ route('admin.tokens.manual.submit') }}">
            @csrf

            {{-- User Select --}}
            <div class="mb-5">
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fa-solid fa-user mr-1 text-indigo-400"></i> Target User <span class="text-red-400">*</span>
                </label>
                <select id="tokenUserSelect" name="user_id" required>
                    <option value="">-- Select Active User --</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? 'selected' : '' }}>
                            {{ $u->name }} ({{ $u->referral_code }}) — {{ $u->email }}
                        </option>
                    @endforeach
                </select>
                <p class="text-gray-500 text-xs mt-2">
                    <i class="fa-solid fa-circle-info mr-1"></i>Type name, email or referral code to search.
                </p>
            </div>

            {{-- Token Type --}}
            <div class="mb-5">
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fa-solid fa-coins mr-1 text-yellow-400"></i> Token Type <span class="text-red-400">*</span>
                </label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <!-- Token Type: NEXA 1.0 -->
                    <label class="cursor-pointer relative block">
                        <input type="radio" name="token_type" value="utility" class="sr-only peer" {{ old('token_type', 'utility') === 'utility' ? 'checked' : '' }} required>
                        <div class="flex items-center p-4 border border-[#334155] rounded-lg cursor-pointer transition-all peer-checked:border-indigo-500 peer-checked:bg-indigo-500/10 hover:border-[#475569] h-full">
                            <div class="w-10 h-10 rounded-full bg-indigo-900/30 text-indigo-400 flex items-center justify-center text-lg mr-3">
                                <i class="fa-solid fa-circle-bolt"></i>
                            </div>
                            <div>
                                <p class="text-white font-semibold text-sm">NEXA 1.0</p>
                                <p class="text-xs text-gray-500">Daily income, convertible</p>
                            </div>
                            <div class="ml-auto w-5 h-5 rounded-full border-2 border-gray-600 peer-checked:border-indigo-500 flex items-center justify-center">
                                <div class="w-2.5 h-2.5 rounded-full bg-indigo-500 opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                            </div>
                        </div>
                    </label>

                    <!-- Token Type: NEXA 2.0 -->
                    <label class="cursor-pointer relative block">
                        <input type="radio" name="token_type" value="renewal" class="sr-only peer" {{ old('token_type') === 'renewal' ? 'checked' : '' }}>
                        <div class="flex items-center p-4 border border-[#334155] rounded-lg cursor-pointer transition-all peer-checked:border-cyan-500 peer-checked:bg-cyan-500/10 hover:border-[#475569] h-full">
                            <div class="w-10 h-10 rounded-full bg-cyan-900/30 text-cyan-400 flex items-center justify-center text-lg mr-3">
                                <i class="fa-solid fa-rotate"></i>
                            </div>
                            <div>
                                <p class="text-white font-semibold text-sm">NEXA 2.0</p>
                                <p class="text-xs text-gray-500">Renewal Token (RT)</p>
                            </div>
                            <div class="ml-auto w-5 h-5 rounded-full border-2 border-gray-600 peer-checked:border-cyan-500 flex items-center justify-center">
                                <div class="w-2.5 h-2.5 rounded-full bg-cyan-500 opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                            </div>
                        </div>
                    </label>
                    
                    <!-- Token Type: NEXA 3.0 -->
                    <label class="cursor-pointer relative block">
                        <input type="radio" name="token_type" value="nexa_3" class="sr-only peer" {{ old('token_type') === 'nexa_3' ? 'checked' : '' }}>
                        <div class="flex items-center p-4 border border-[#334155] rounded-lg cursor-pointer transition-all peer-checked:border-teal-500 peer-checked:bg-teal-500/10 hover:border-[#475569] h-full">
                            <div class="w-10 h-10 rounded-full bg-teal-900/30 text-teal-400 flex items-center justify-center text-lg mr-3">
                                <i class="fa-solid fa-graduation-cap"></i>
                            </div>
                            <div>
                                <p class="text-white font-semibold text-sm">NEXA 3.0</p>
                                <p class="text-xs text-gray-500">Course Reward Token</p>
                            </div>
                            <div class="ml-auto w-5 h-5 rounded-full border-2 border-gray-600 peer-checked:border-teal-500 flex items-center justify-center">
                                <div class="w-2.5 h-2.5 rounded-full bg-teal-500 opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            {{-- Number of Tokens --}}
            <div class="mb-5">
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fa-solid fa-hashtag mr-1 text-green-400"></i> Number of Tokens <span class="text-red-400">*</span>
                </label>
                <input type="number"
                       name="amount"
                       step="0.0001"
                       min="0.0001"
                       value="{{ old('amount') }}"
                       placeholder="e.g. 50 or 100.5"
                       class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded focus:border-indigo-500 focus:outline-none"
                       required>
                <p class="text-gray-500 text-xs mt-1">
                    This is the <strong class="text-gray-300">number of tokens</strong> to credit — not a rupee/dollar amount.
                    </p>
                    <p class="text-gray-400 text-sm">
                    Each NEXA 1.0 ≈ <span class="text-indigo-400">₹{{ \App\Models\Setting::get('utility_token_value', '1') }}</span> &nbsp;|&nbsp; 
                    Each NEXA 2.0 ≈ <span class="text-cyan-400">₹{{ \App\Models\Setting::get('renewal_token_value', '1') }}</span> &nbsp;|&nbsp; 
                    Each NEXA 3.0 ≈ <span class="text-teal-400">₹{{ \App\Models\Setting::get('nexa_3_token_value', '1') }}</span>
                    </p>
            </div>

            {{-- Note / Reason --}}
            <div class="mb-6">
                <label class="block text-gray-300 text-sm font-medium mb-2">
                    <i class="fa-solid fa-note-sticky mr-1 text-gray-400"></i> Reason / Note <span class="text-gray-500 font-normal">(optional)</span>
                </label>
                <input type="text"
                       name="note"
                       value="{{ old('note') }}"
                       placeholder="e.g. Bonus credit, Campaign reward, Manual correction..."
                       class="w-full bg-[#0b1220] border border-[#334155] text-white p-3 rounded focus:border-indigo-500 focus:outline-none">
            </div>

            {{-- Submit --}}
            <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded transition flex items-center justify-center gap-2">
                <i class="fa-solid fa-paper-plane"></i> Credit Tokens Now
            </button>
        </form>
    </div>

    {{-- Quick links --}}
    <div class="mt-4 flex justify-between text-sm">
        <a href="{{ route('admin.tokens.logs') }}" class="text-indigo-400 hover:text-indigo-300">
            <i class="fa-solid fa-list mr-1"></i>View Token Logs →
        </a>
        <a href="{{ route('admin.tokens.settings') }}" class="text-gray-400 hover:text-gray-300">
            <i class="fa-solid fa-gear mr-1"></i>Token Settings
        </a>
    </div>
</div>

{{-- Tom Select JS --}}
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    new TomSelect('#tokenUserSelect', {
        placeholder: 'Type to search user by name, email or referral code...',
        searchField: ['text'],
        maxOptions: 300,
        render: {
            option: function(data, escape) {
                return '<div>' + escape(data.text) + '</div>';
            },
            item: function(data, escape) {
                return '<div class="text-white">' + escape(data.text) + '</div>';
            }
        }
    });
});
</script>
@endsection