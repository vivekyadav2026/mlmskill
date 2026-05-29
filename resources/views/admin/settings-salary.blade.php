@extends('layouts.admin')
@section('title', 'Salary Settings & Adjustment')

@section('content')
{{-- Tom Select CSS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.min.css">
<style>
/* ── Tom Select dark overrides ── */
.ts-wrapper.full .ts-control,
.ts-control {
    background: #0b1220 !important;
    border: 1px solid #334155 !important;
    color: #f1f5f9 !important;
    border-radius: 0.5rem !important;
    padding: 0.5rem 0.9rem !important;
    min-height: 44px !important;
    box-shadow: none !important;
}
.ts-control input { color: #f1f5f9 !important; background: transparent !important; }
.ts-control input::placeholder { color: #64748b !important; }
.ts-dropdown {
    background: #0f172a !important;
    border: 1px solid #334155 !important;
    border-radius: 0.5rem !important;
    box-shadow: 0 10px 40px rgba(0,0,0,.5) !important;
    margin-top: 4px !important;
    overflow: hidden;
}
.ts-dropdown .ts-dropdown-content { padding: 4px !important; }
.ts-dropdown .option {
    color: #e2e8f0 !important; padding: 0.55rem 0.85rem !important;
    border-radius: 0.35rem; font-size: 0.875rem; cursor: pointer; transition: background .15s;
}
.ts-dropdown .option:hover,
.ts-dropdown .option.active  { background: #1e3a5f !important; color: #fff !important; }
.ts-dropdown .option.selected { background: rgba(99,102,241,.2) !important; color: #a5b4fc !important; }
.ts-control .item            { color: #f1f5f9 !important; background: transparent !important; }
</style>

<div class="tailwind-scope mt-4 max-w-[900px] mx-auto px-3 sm:px-4 space-y-6">

    {{-- Page Header --}}
    <div>
        <h2 class="text-xl sm:text-2xl font-bold text-gray-100">
            <i class="fa-solid fa-money-bill mr-2 text-yellow-400"></i>Salary Settings & Adjustment
        </h2>
        <p class="text-gray-400 text-sm mt-1">
            Rank-based weekly salary configuration and manual add/deduct tool.
        </p>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="flex items-center gap-3 bg-green-500/10 border border-green-700 text-green-400 p-4 rounded-lg text-sm">
            <i class="fa-solid fa-circle-check text-lg flex-shrink-0"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="flex items-center gap-3 bg-red-500/10 border border-red-700 text-red-400 p-4 rounded-lg text-sm">
            <i class="fa-solid fa-triangle-exclamation text-lg flex-shrink-0"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif
    @if($errors->any())
        <div class="bg-red-500/10 border border-red-700 text-red-400 p-4 rounded-lg text-sm">
            <i class="fa-solid fa-triangle-exclamation mr-2"></i><strong>Please fix the following:</strong>
            <ul class="mt-2 list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
            </ul>
        </div>
    @endif

    {{-- ─────────────────────────────────────────────────────────
         SECTION 1 — SALARY ADJUSTMENT (Add / Deduct)
    ──────────────────────────────────────────────────────────── --}}
    <div class="bg-[#1a222d] border border-yellow-700/40 rounded-xl overflow-hidden">
        <div class="bg-yellow-500/10 border-b border-yellow-700/40 px-5 py-3 flex items-center gap-2">
            <i class="fa-solid fa-money-bill-transfer text-yellow-400"></i>
            <h3 class="text-base font-semibold text-yellow-300">Manual Salary Adjustment</h3>
            <span class="ml-auto text-xs text-yellow-500/70 bg-yellow-500/10 border border-yellow-700/30 px-2 py-0.5 rounded-full">
                Add / Deduct
            </span>
        </div>
        <div class="p-5">
            <p class="text-gray-400 text-sm mb-4">
                <i class="fa-solid fa-circle-info mr-1 text-yellow-500/70"></i>
                Manually credit or debit salary bonus to any user's <strong class="text-gray-300">Income Wallet</strong>.
                Transaction is logged under <em>Salary Bonus</em> history.
                Use a <strong class="text-red-400">negative amount</strong> to deduct.
            </p>

            <form method="POST" action="{{ route('admin.salary.adjust') }}">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                    {{-- Target User --}}
                    <div class="sm:col-span-2 lg:col-span-1">
                        <label class="block text-sm font-medium text-gray-300 mb-1">
                            <i class="fa-solid fa-user mr-1 text-indigo-400"></i>
                            Target User <span class="text-red-400">*</span>
                        </label>
                        <select id="salaryUserSelect" name="user_id" required>
                            <option value="">-- Select User --</option>
                            @foreach($users as $u)
                                <option value="{{ $u->id }}" {{ old('user_id')==$u->id?'selected':'' }}>
                                    {{ $u->name }} ({{ $u->referral_code }}) — {{ $u->email }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-gray-600 text-xs mt-1">Type to search by name, email or ID</p>
                    </div>

                    {{-- Amount --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">
                            <i class="fa-solid fa-indian-rupee-sign mr-1 text-green-400"></i>
                            Amount <span class="text-red-400">*</span>
                        </label>
                        <input type="number" step="0.01" name="amount"
                               value="{{ old('amount') }}"
                               placeholder="e.g. 500 or -200"
                               required
                               class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2.5
                                      text-white placeholder-gray-600 focus:outline-none focus:ring-1
                                      focus:ring-yellow-500 text-sm">
                        <p class="text-gray-600 text-xs mt-1">Negative = deduct from wallet</p>
                    </div>

                    {{-- Reason --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">
                            <i class="fa-solid fa-note-sticky mr-1 text-gray-400"></i>
                            Reason / Remark <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="note"
                               value="{{ old('note') }}"
                               placeholder="e.g. Performance bonus, Correction..."
                               required
                               class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2.5
                                      text-white placeholder-gray-600 focus:outline-none focus:ring-1
                                      focus:ring-yellow-500 text-sm">
                    </div>

                </div>

                {{-- Submit --}}
                <div class="mt-4 flex flex-col sm:flex-row gap-3 items-start sm:items-center">
                    <button type="submit"
                            class="w-full sm:w-auto px-6 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-black
                                   font-bold rounded-lg transition text-sm flex items-center justify-center gap-2
                                   shadow-lg shadow-yellow-500/20">
                        <i class="fa-solid fa-bolt"></i> Execute Salary Adjustment
                    </button>
                    <span class="text-gray-600 text-xs">
                        This action is <strong class="text-gray-400">irreversible</strong> — double check the amount before submitting.
                    </span>
                </div>
            </form>
        </div>
    </div>

    {{-- ─────────────────────────────────────────────────────────
         SECTION 2 — SALARY SETTINGS (Rank amounts + Payout day)
    ──────────────────────────────────────────────────────────── --}}
    <form method="POST" action="{{ route('admin.settings.salary') }}">
        @csrf

        {{-- Payout Schedule --}}
        <div class="bg-[#1a222d] border border-[#334155] rounded-xl overflow-hidden mb-4">
            <div class="bg-[#0f172a] border-b border-[#334155] px-5 py-3 flex items-center gap-2">
                <i class="fa-solid fa-calendar-day text-indigo-400"></i>
                <h3 class="text-base font-semibold text-gray-200">Payout Schedule</h3>
            </div>
            <div class="p-5">
                <label class="block text-sm font-medium text-gray-300 mb-2">
                    Distribution Day (Day of the week)
                </label>
                <select name="salary_payout_day_of_week"
                        class="bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-2.5 text-white
                               focus:outline-none focus:ring-1 focus:ring-indigo-500 text-sm w-full sm:w-auto">
                    @php $days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday']; @endphp
                    @foreach($days as $i => $day)
                        <option value="{{ $i }}" {{ ($payout_day_of_week ?? 1) == $i ? 'selected' : '' }}>{{ $day }}</option>
                    @endforeach
                </select>
                <p class="text-gray-500 text-xs mt-2">
                    <i class="fa-solid fa-circle-info mr-1"></i>
                    Automated weekly salary cron will run on this day every week.
                </p>
            </div>
        </div>

        {{-- Rank Salary Table --}}
        <div class="bg-[#1a222d] border border-[#334155] rounded-xl overflow-hidden mb-4">
            <div class="bg-[#0f172a] border-b border-[#334155] px-5 py-3 flex items-center gap-2">
                <i class="fa-solid fa-list-ol text-indigo-400"></i>
                <h3 class="text-base font-semibold text-gray-200">Rank Salary Amounts</h3>
                <span class="ml-auto text-xs text-gray-500">Paid weekly • Max 12 weeks per rank</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-[#334155]">
                            <th class="text-left text-gray-400 text-xs uppercase tracking-wider px-5 py-3 font-semibold">Rank</th>
                            <th class="text-left text-gray-400 text-xs uppercase tracking-wider px-5 py-3 font-semibold">Weekly Salary ($)</th>
                            <th class="text-left text-gray-400 text-xs uppercase tracking-wider px-5 py-3 font-semibold hidden sm:table-cell">Notes</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#1e293b]">
                        @foreach($ranks as $rankName => $amount)
                        <tr class="hover:bg-white/[0.02] transition">
                            <td class="px-5 py-3 font-semibold text-gray-200">
                                <i class="fa-solid fa-trophy mr-2 text-yellow-500/60 text-xs"></i>{{ $rankName }}
                            </td>
                            <td class="px-5 py-3">
                                <div class="flex items-center gap-2">
                                    <span class="text-gray-400 text-sm">$</span>
                                    <input type="number" step="0.01" min="0"
                                           name="ranks[{{ $rankName }}]"
                                           value="{{ old('ranks.'.$rankName, $amount) }}"
                                           class="bg-[#0b1220] border border-[#334155] rounded-lg px-3 py-1.5
                                                  text-white focus:outline-none focus:ring-1 focus:ring-indigo-500
                                                  text-sm w-32">
                                </div>
                            </td>
                            <td class="px-5 py-3 text-gray-500 text-xs hidden sm:table-cell">
                                Paid weekly for 12 weeks upon reaching <strong class="text-gray-400">{{ $rankName }}</strong>.
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-5 py-3 border-t border-[#334155] bg-[#0f172a]/50">
                <p class="text-gray-500 text-xs">
                    <i class="fa-solid fa-info-circle mr-1"></i>
                    The <strong class="text-gray-400">highest</strong> qualifying rank's salary is paid each week. Max 12 payments per rank.
                </p>
            </div>
        </div>

        {{-- Save Button --}}
        <div class="flex justify-end">
            <button type="submit"
                    class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold
                           rounded-lg shadow-lg shadow-indigo-500/20 transition text-sm flex items-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i> Save Salary Settings
            </button>
        </div>
    </form>

</div>

{{-- Tom Select JS --}}
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    new TomSelect('#salaryUserSelect', {
        placeholder: 'Type to search user by name, email or ID...',
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
