@extends('layouts.user')
@section('content')
<div class="tailwind-scope mt-4 max-w-[1200px] mx-auto">
    <div class="mb-10 text-center">
        <h2 class="text-4xl font-bold text-gray-100 mb-2">Financial Empowerment</h2>
        <p class="text-gray-400">Exclusive loan facilities designed to support your growth and aspirations.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($schemes as $s)
        <div class="bg-[#1a222d] border border-[#334155] rounded-2xl overflow-hidden hover:border-green-500/40 transition-all transform hover:-translate-y-2 flex flex-col h-full shadow-2xl">
            <div class="p-8 flex-1">
                <div class="w-16 h-16 bg-green-500/10 rounded-2xl flex items-center justify-center text-green-500 text-3xl mb-6">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-100 mb-2">{{ $s->name }}</h3>
                <p class="text-gray-400 text-sm mb-6 line-clamp-3">{{ $s->description }}</p>

                <div class="space-y-4 mb-8">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500">Interest Rate</span>
                        <span class="text-green-400 font-bold text-lg">{{ $s->interest_rate }}% <small class="text-[10px] font-normal">p.a.</small></span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500">Loan Amount</span>
                        <span class="text-gray-200 font-bold">${{ number_format($s->min_amount) }} - ${{ number_format($s->max_amount) }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500">Max Tenure</span>
                        <span class="text-gray-200 font-bold">{{ $s->max_tenure_months }} Months</span>
                    </div>
                    @if($s->required_rank)
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-500">Eligibility</span>
                        <span class="px-2 py-0.5 bg-yellow-900/30 text-yellow-500 border border-yellow-700/50 rounded text-[10px] font-bold uppercase">{{ $s->required_rank }} Rank</span>
                    </div>
                    @endif
                </div>

                <button onclick="openApplyModal({{ $s->id }}, '{{ $s->name }}', {{ $s->min_amount }}, {{ $s->max_amount }}, {{ $s->max_tenure_months }}, {{ $s->interest_rate }})" 
                        class="w-full py-3 bg-green-600 hover:bg-green-700 text-white rounded-xl font-bold transition shadow-lg shadow-green-500/10">
                    Apply Now
                </button>
            </div>
            <div class="px-8 py-3 bg-[#0b1220] border-t border-[#334155] text-center text-[10px] text-gray-500 uppercase tracking-widest font-bold">
                Terms & Conditions Apply
            </div>
        </div>
        @empty
        <div class="col-span-full py-20 text-center bg-[#1a222d] border border-[#334155] rounded-2xl">
            <i class="fa-solid fa-piggy-bank text-5xl text-gray-600 mb-4"></i>
            <p class="text-gray-400">No active loan schemes available at this time.</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Application Modal -->
<div id="applyModal" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-[#1a222d] border border-[#334155] rounded-2xl w-full max-w-lg overflow-hidden shadow-2xl">
        <div class="px-8 py-6 border-b border-[#334155] flex justify-between items-center">
            <h3 class="text-xl font-bold text-gray-100" id="modalSchemeName">Apply for Loan</h3>
            <button onclick="closeApplyModal()" class="text-gray-400 hover:text-white"><i class="fa-solid fa-xmark text-xl"></i></button>
        </div>
        <form id="applyForm" method="POST" action="">
            @csrf
            <div class="p-8 space-y-6">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Loan Amount ($)</label>
                        <input type="number" name="amount" id="loanAmount" required class="w-full bg-[#0b1220] border border-[#334155] rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-green-500 transition" oninput="calculateEmi()">
                        <p class="text-[10px] text-gray-500 mt-1" id="amountRangeLabel"></p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Tenure (Months)</label>
                        <input type="number" name="tenure_months" id="loanTenure" required class="w-full bg-[#0b1220] border border-[#334155] rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-green-500 transition" oninput="calculateEmi()">
                        <p class="text-[10px] text-gray-500 mt-1" id="tenureRangeLabel"></p>
                    </div>
                </div>

                <div class="bg-green-600/10 border border-green-500/20 rounded-2xl p-6 text-center">
                    <p class="text-gray-400 text-xs uppercase font-bold tracking-widest mb-1">Estimated Monthly EMI</p>
                    <h2 class="text-4xl font-bold text-green-400">$<span id="emiDisplay">0.00</span></h2>
                    <p class="text-[10px] text-gray-500 mt-2 italic">*Calculation based on annual simple interest</p>
                </div>

                <div class="bg-[#0b1220] p-4 rounded-xl border border-[#334155]">
                    <div class="flex items-start gap-3">
                        <input type="checkbox" required class="mt-1">
                        <p class="text-xs text-gray-400 leading-relaxed">I understand that this is an application for financial assistance and is subject to verification and approval. I agree to the platform's terms regarding loan repayment.</p>
                    </div>
                </div>
            </div>
            <div class="px-8 py-6 border-t border-[#334155] bg-[#0f172a] flex justify-end gap-3">
                <button type="button" onclick="closeApplyModal()" class="px-6 py-2 text-gray-400 hover:text-white transition">Cancel</button>
                <button type="submit" class="px-8 py-2 bg-green-600 hover:bg-green-700 text-white rounded-xl font-bold transition shadow-lg shadow-green-500/20">Submit Application</button>
            </div>
        </form>
    </div>
</div>

<script>
    let currentRate = 0;

    function openApplyModal(id, name, min, max, maxTenure, rate) {
        document.getElementById('applyForm').action = "/user/loans/" + id + "/apply";
        document.getElementById('modalSchemeName').innerText = name;
        document.getElementById('loanAmount').min = min;
        document.getElementById('loanAmount').max = max;
        document.getElementById('loanAmount').value = min;
        document.getElementById('loanTenure').max = maxTenure;
        document.getElementById('loanTenure').value = Math.min(12, maxTenure);
        document.getElementById('amountRangeLabel').innerText = "Range: $" + min + " - $" + max;
        document.getElementById('tenureRangeLabel').innerText = "Max: " + maxTenure + " Months";
        currentRate = rate;
        calculateEmi();
        document.getElementById('applyModal').classList.remove('hidden');
    }

    function calculateEmi() {
        const principal = parseFloat(document.getElementById('loanAmount').value) || 0;
        const months = parseInt(document.getElementById('loanTenure').value) || 0;
        
        if (principal > 0 && months > 0) {
            const years = months / 12;
            const totalInterest = (principal * currentRate * years) / 100;
            const emi = (principal + totalInterest) / months;
            document.getElementById('emiDisplay').innerText = emi.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
        } else {
            document.getElementById('emiDisplay').innerText = "0.00";
        }
    }

    function closeApplyModal() {
        document.getElementById('applyModal').classList.add('hidden');
    }
</script>
@endsection
