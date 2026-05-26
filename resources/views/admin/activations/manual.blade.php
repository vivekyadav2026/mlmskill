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
    padding: 0.75rem 1rem !important;
    min-height: 48px !important;
    box-shadow: none !important;
}
.ts-control input {
    color: #f1f5f9 !important;
    background: transparent !important;
}
.ts-control input::placeholder {
    color: #64748b !important;
}
.ts-dropdown {
    background: #0f172a !important;
    border: 1px solid #334155 !important;
    border-radius: 0.5rem !important;
    box-shadow: 0 10px 40px rgba(0,0,0,0.5) !important;
    margin-top: 4px !important;
    overflow: hidden;
}
.ts-dropdown .ts-dropdown-content {
    padding: 4px !important;
}
.ts-dropdown .option {
    color: #e2e8f0 !important;
    padding: 0.6rem 0.85rem !important;
    border-radius: 0.35rem;
    font-size: 0.875rem;
    cursor: pointer;
    transition: background 0.15s;
}
.ts-dropdown .option:hover,
.ts-dropdown .option.active {
    background: #1e3a5f !important;
    color: #fff !important;
}
.ts-dropdown .option.selected {
    background: rgba(99,102,241,0.2) !important;
    color: #a5b4fc !important;
}
.ts-dropdown-header-tablist { display: none; }
/* Search box inside dropdown */
.ts-dropdown .ts-dropdown-input-full input {
    background: #1a222d !important;
    border: 1px solid #334155 !important;
    color: #f1f5f9 !important;
    border-radius: 0.4rem;
    padding: 0.5rem 0.75rem !important;
    width: 100%;
}
/* The "x" clear button and selected item chip */
.ts-control .item {
    color: #f1f5f9 !important;
    background: transparent !important;
}
.ts-control .ts-input-hidden {
    display: none;
}
</style>

<div class="tailwind-scope mt-4 max-w-2xl mx-auto">

    {{-- Header --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">
            <i class="fa-solid fa-bolt-lightning mr-2 text-indigo-400"></i>Manual User Activation
        </h2>
        <p class="text-gray-400 mt-1 text-sm">Manually activate a user account bypassing the automated payment gateway.</p>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="flex items-center gap-3 bg-green-500/10 border border-green-700 text-green-400 p-4 rounded-lg mb-4">
            <i class="fa-solid fa-circle-check text-xl flex-shrink-0"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="flex items-center gap-3 bg-red-500/10 border border-red-700 text-red-400 p-4 rounded-lg mb-4">
            <i class="fa-solid fa-triangle-exclamation text-xl flex-shrink-0"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif
    @if($errors->any())
        <div class="bg-red-500/10 border border-red-700 text-red-400 p-4 rounded-lg mb-4">
            <i class="fa-solid fa-triangle-exclamation mr-2"></i><strong>Please fix the following:</strong>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
            </ul>
        </div>
    @endif

    {{-- Form Card --}}
    <div class="bg-[#1a222d] border border-[#334155] rounded-xl p-8 shadow-xl">
        <form action="{{ url('admin/activations/manual') }}" method="POST">
            @csrf

            {{-- User Select --}}
            <div class="mb-6">
                <label class="block text-gray-300 text-sm font-semibold mb-2">
                    <i class="fa-solid fa-user mr-1 text-indigo-400"></i>
                    Select Inactive User <span class="text-red-400">*</span>
                </label>

                {{-- Native select — Tom Select will enhance this --}}
                <select
                    id="userSelect"
                    name="user_id"
                    required
                    placeholder="🔍 Type to search user by name or email..."
                >
                    <option value="">-- Choose User --</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}"
                                data-name="{{ $u->name }}"
                                data-email="{{ $u->email }}"
                                data-code="{{ $u->referral_code ?? '' }}">
                            {{ $u->name }} — {{ $u->email }} ({{ $u->referral_code ?? 'N/A' }})
                        </option>
                    @endforeach
                </select>

                <p class="text-gray-500 text-xs mt-2">
                    <i class="fa-solid fa-circle-info mr-1"></i>
                    Only inactive users are listed. Type name, email, or referral code to search.
                </p>
            </div>

            {{-- Info box --}}
            <div class="bg-indigo-500/10 border border-indigo-700/50 rounded-lg p-4 mb-6 flex items-start gap-3">
                <i class="fa-solid fa-circle-info text-indigo-400 mt-0.5 flex-shrink-0"></i>
                <div class="text-sm text-indigo-300">
                    <strong class="text-indigo-200">Manual Activation</strong> will immediately mark this user as
                    <span class="text-green-400 font-semibold">Active</span>,
                    trigger commission distribution to their upline, and generate wallet entries.
                    This action <strong>cannot be undone</strong> automatically.
                </div>
            </div>

            {{-- Submit --}}
            <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white font-bold py-3 rounded-lg shadow-lg shadow-indigo-900/30 transition flex items-center justify-center gap-2">
                <i class="fa-solid fa-bolt-lightning"></i>
                Activate User Account
            </button>
        </form>
    </div>

    {{-- Back link --}}
    <div class="mt-4 text-center">
        <a href="{{ url('admin/activations') }}" class="text-gray-500 hover:text-gray-300 text-sm transition">
            <i class="fa-solid fa-arrow-left mr-1"></i>Back to Activation Requests
        </a>
    </div>
</div>

{{-- Tom Select JS --}}
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    new TomSelect('#userSelect', {
        placeholder: 'Type to search user by name or email...',
        searchField: ['text'],   // search the displayed option text
        maxOptions: 200,
        render: {
            option: function (data, escape) {
                // Parse out name / email / code from option text
                return '<div class="py-1">' +
                    '<span class="font-medium text-white">' + escape(data.text) + '</span>' +
                '</div>';
            },
            item: function (data, escape) {
                return '<div class="text-white">' + escape(data.text) + '</div>';
            }
        }
    });
});
</script>
@endsection