@extends('layouts.user')

@section('content')
<div class="tailwind-scope mt-10 max-w-4xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-white">Activate Member</h1>
        <p class="text-gray-400">Use your wallet balance to activate another user's account using their Sponsor Activation ID.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-900/40 border border-green-500/50 text-green-300 px-4 py-3 rounded-lg mb-6 flex items-center gap-2">
            <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-900/40 border border-red-500/50 text-red-300 px-4 py-3 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <div class="md:col-span-2">
            <div class="bg-[#1a222d] border border-[#334155] rounded-xl p-8 shadow-xl">
                <form action="{{ route('package.activate_member.submit') }}" method="POST" onsubmit="return confirm('Are you sure you want to deduct $300 from your package wallet to activate this member?');">
                    @csrf
                    
                    <div class="mb-6">
                        <label class="block text-gray-300 font-bold mb-2">Sponsor Activation ID <span class="text-red-500">*</span></label>
                        <input type="text" name="sponsor_id" id="sponsor_id" placeholder="e.g. SD000012" class="w-full bg-[#0b1220] text-white border border-[#334155] rounded-lg px-4 py-3 focus:outline-none focus:border-indigo-500 font-mono tracking-wider uppercase" required>
                        
                        <!-- Real-time User Details Card -->
                        <div id="member-details-container" class="mt-3 hidden transition-all duration-300">
                            <div class="bg-indigo-950/20 border border-indigo-500/30 rounded-lg p-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                                <div>
                                    <div class="text-xs text-indigo-400 uppercase font-extrabold tracking-wider mb-1">Target Account Found</div>
                                    <div class="font-bold text-white text-lg" id="member-name">...</div>
                                    <div class="text-sm text-gray-400" id="member-email">...</div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span id="member-id-badge" class="px-2.5 py-1 bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 rounded-md font-mono text-sm uppercase">...</span>
                                    <span id="member-status-badge" class="px-2.5 py-1 rounded-md text-xs font-bold uppercase">...</span>
                                </div>
                            </div>
                        </div>
                        
                        <div id="member-loading" class="mt-3 hidden text-indigo-400 text-sm flex items-center gap-2">
                            <i class="fa-solid fa-circle-notch fa-spin"></i> Checking member details...
                        </div>
                        <div id="member-error" class="mt-3 hidden text-red-400 text-sm flex items-center gap-2">
                            <i class="fa-solid fa-circle-exclamation"></i> <span id="member-error-text">Member not found</span>
                        </div>

                        <p class="text-sm text-gray-500 mt-2"><i class="fa-solid fa-info-circle"></i> Ask the inactive member to share their Activation ID from their checkout page.</p>
                    </div>

                    <div class="mb-8">
                        <label class="block text-gray-300 font-bold mb-2">Select Course Module <span class="text-red-500">*</span></label>
                        <div class="space-y-3">
                            @foreach($modules as $module)
                            <label class="flex items-center gap-3 bg-[#0b1220] border border-[#334155] rounded-lg p-4 cursor-pointer hover:border-indigo-500 transition">
                                <input type="radio" name="module_id" value="{{ $module->id }}" required class="w-5 h-5 text-indigo-600 border-gray-600 bg-gray-700">
                                <div>
                                    <div class="font-bold text-white">{{ $module->name }}</div>
                                    <div class="text-sm text-gray-400">{{ $module->description }}</div>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-8 p-4 bg-indigo-500/5 border border-indigo-500/20 rounded-lg">
                        <label class="block text-gray-300 font-bold mb-2">Security MPIN <span class="text-red-500">*</span></label>
                        <input type="password" name="mpin" maxlength="4" pattern="\d{4}" title="Please enter exactly 4 digits" placeholder="••••" class="w-full bg-[#0b1220] text-white border border-[#334155] rounded-lg px-4 py-3 focus:outline-none focus:border-indigo-500 font-mono tracking-[1em] text-center text-2xl" required>
                        <p class="text-xs text-gray-500 mt-2"><i class="fa-solid fa-shield-halved"></i> For security, verify your 4-digit MPIN to authorize this transaction.</p>
                    </div>

                    <div class="border-t border-[#334155] pt-6 flex justify-end">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition flex items-center gap-2 text-lg">
                            <i class="fa-solid fa-bolt"></i> Activate Member for $300
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="md:col-span-1">
            <div class="bg-[#1a222d] border border-indigo-500/30 rounded-xl p-6 shadow-lg mb-6">
                <div class="flex items-center gap-3 mb-4 text-indigo-400">
                    <i class="fa-solid fa-wallet text-2xl"></i>
                    <h3 class="text-lg font-bold text-white">Your Wallet</h3>
                </div>
                
                <p class="text-sm text-gray-400 mb-2">Available Balance</p>
                <div class="text-3xl font-black {{ $balance >= 300 ? 'text-green-400' : 'text-red-400' }}">
                    ${{ number_format($balance, 2) }}
                </div>
                
                @if($balance < 300)
                    <div class="mt-4 bg-red-900/20 border border-red-500/30 text-red-400 p-3 rounded text-sm">
                        <i class="fa-solid fa-triangle-exclamation"></i> You need at least $300 to activate a member.
                    </div>
                @endif
            </div>

            <div class="bg-[#1a222d] border border-[#334155] rounded-xl p-6 shadow-lg">
                <h3 class="font-bold text-white mb-3 border-b border-[#334155] pb-2">How it works</h3>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-1 text-indigo-500 mt-1"></i>
                        <span>Get the Activation ID from the new member.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-2 text-indigo-500 mt-1"></i>
                        <span>Enter the ID and select their preferred course module.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-3 text-indigo-500 mt-1"></i>
                        <span>$300 will be deducted from your Package Wallet.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-4 text-indigo-500 mt-1"></i>
                        <span>The member will be instantly activated and commissions distributed.</span>
                    </li>
                </ul>
            </div>
        </div>
        
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sponsorInput = document.getElementById('sponsor_id');
    const detailsContainer = document.getElementById('member-details-container');
    const memberName = document.getElementById('member-name');
    const memberEmail = document.getElementById('member-email');
    const memberIdBadge = document.getElementById('member-id-badge');
    const memberStatusBadge = document.getElementById('member-status-badge');
    const loadingDiv = document.getElementById('member-loading');
    const errorDiv = document.getElementById('member-error');
    const errorText = document.getElementById('member-error-text');

    let debounceTimeout;

    sponsorInput.addEventListener('input', function() {
        clearTimeout(debounceTimeout);
        const value = sponsorInput.value.trim();

        // Clear everything if input is too short
        if (value.length < 3) {
            detailsContainer.classList.add('hidden');
            loadingDiv.classList.add('hidden');
            errorDiv.classList.add('hidden');
            return;
        }

        // Show loading spinner
        loadingDiv.classList.remove('hidden');
        detailsContainer.classList.add('hidden');
        errorDiv.classList.add('hidden');

        debounceTimeout = setTimeout(() => {
            fetch(`{{ route('package.lookup_member') }}?sponsor_id=${encodeURIComponent(value)}`)
                .then(response => response.json())
                .then(data => {
                    loadingDiv.classList.add('hidden');
                    if (data.success) {
                        const user = data.user;
                        memberName.textContent = user.name;
                        memberEmail.textContent = user.email;
                        memberIdBadge.textContent = user.referral_code;
                        
                        // Status badge customization
                        memberStatusBadge.textContent = user.status;
                        if (user.status === 'active') {
                            memberStatusBadge.className = 'px-2.5 py-1 rounded-md text-xs font-bold uppercase bg-green-500/20 text-green-300 border border-green-500/30';
                        } else {
                            memberStatusBadge.className = 'px-2.5 py-1 rounded-md text-xs font-bold uppercase bg-yellow-500/20 text-yellow-300 border border-yellow-500/30';
                        }

                        detailsContainer.classList.remove('hidden');
                    } else {
                        errorText.textContent = data.message || 'Member not found.';
                        errorDiv.classList.remove('hidden');
                    }
                })
                .catch(err => {
                    loadingDiv.classList.add('hidden');
                    errorText.textContent = 'Error verifying member ID.';
                    errorDiv.classList.remove('hidden');
                });
        }, 500); // 500ms debounce
    });
});
</script>
@endsection
