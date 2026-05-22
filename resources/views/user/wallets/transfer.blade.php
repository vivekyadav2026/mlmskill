@extends('layouts.user')

@section('content')
<div class="tailwind-scope mt-4 max-w-4xl mx-auto">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-100">P2P Wallet Transfer</h2>
        <p class="text-gray-400">Transfer funds from your Income Wallet to another user's Package Wallet.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-900/40 border border-green-500/50 text-green-300 px-4 py-3 rounded-lg mb-4 flex items-center gap-2">
            <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-900/40 border border-red-500/50 text-red-300 px-4 py-3 rounded-lg mb-4">
            {{ session('error') }}
        </div>
    @endif
    @if($errors->any())
        <div class="bg-red-900/40 border border-red-500/50 text-red-300 px-4 py-3 rounded-lg mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Balance Info -->
        <div class="space-y-4">
            <div id="card_income_wallet" class="bg-[#1f2937] border-2 border-green-500 rounded-xl p-6 shadow-lg text-center cursor-pointer transition transform hover:-translate-y-1" onclick="selectWallet('income_wallet')">
                <div class="w-12 h-12 bg-green-500/20 text-green-400 rounded-full flex items-center justify-center mx-auto mb-3 text-xl">
                    <i class="fa-solid fa-wallet"></i>
                </div>
                <h3 class="text-gray-300 font-bold uppercase tracking-wider text-xs mb-1">Income Wallet</h3>
                <div class="text-3xl font-black text-white mb-2">${{ number_format($balance, 2) }}</div>
                <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-500/10 text-green-400 rounded-full text-xs font-semibold">
                    <input type="radio" name="source_wallet_display" checked value="income_wallet" class="accent-green-500 pointer-events-none"> Selected
                </div>
            </div>

            <div id="card_package_wallet" class="bg-[#1a222d] border-2 border-[#334155] rounded-xl p-6 shadow-lg text-center cursor-pointer transition transform hover:-translate-y-1" onclick="selectWallet('package_wallet')">
                <div class="w-12 h-12 bg-purple-500/20 text-purple-400 rounded-full flex items-center justify-center mx-auto mb-3 text-xl">
                    <i class="fa-solid fa-box-open"></i>
                </div>
                <h3 class="text-gray-300 font-bold uppercase tracking-wider text-xs mb-1">Package Wallet</h3>
                <div class="text-3xl font-black text-white mb-2">${{ number_format($packageBalance, 2) }}</div>
                <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-purple-500/10 text-purple-400 rounded-full text-xs font-semibold">
                    <input type="radio" name="source_wallet_display" value="package_wallet" class="accent-purple-500 pointer-events-none"> Select
                </div>
            </div>
        </div>

        <!-- Transfer Form -->
        <div class="md:col-span-2 bg-[#1a222d] border border-indigo-500/30 rounded-xl p-8 shadow-xl relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/10 rounded-bl-full"></div>
            
            <form action="{{ route('wallets.transfer.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="source_wallet" id="source_wallet" value="income_wallet">
                <div class="mb-6 relative z-10">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Recipient User ID (Referral Code) *</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-user text-gray-500"></i>
                        </div>
                        <input type="text" name="recipient_id" id="recipient_id" value="{{ old('recipient_id') }}" placeholder="e.g. SKS12345" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg pl-10 pr-4 py-3 text-white focus:outline-none focus:border-indigo-500 transition shadow-inner font-mono tracking-wider uppercase">
                    </div>
                    
                    <!-- Real-time Recipient Details Card -->
                    <div id="recipient-details-container" class="mt-3 hidden transition-all duration-300">
                        <div class="bg-indigo-950/20 border border-indigo-500/30 rounded-lg p-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                            <div>
                                <div class="text-xs text-indigo-400 uppercase font-extrabold tracking-wider mb-1" id="recipient-relation-type">Recipient Found</div>
                                <div class="font-bold text-white text-lg" id="recipient-name">...</div>
                                <div class="text-sm text-gray-400" id="recipient-email">...</div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span id="recipient-id-badge" class="px-2.5 py-1 bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 rounded-md font-mono text-sm uppercase">...</span>
                                <span id="recipient-status-badge" class="px-2.5 py-1 rounded-md text-xs font-bold uppercase">...</span>
                            </div>
                        </div>
                    </div>
                    
                    <div id="recipient-loading" class="mt-3 hidden text-indigo-400 text-sm flex items-center gap-2">
                        <i class="fa-solid fa-circle-notch fa-spin"></i> Verifying recipient details...
                    </div>
                    <div id="recipient-error" class="mt-3 hidden text-red-400 text-sm flex items-center gap-2">
                        <i class="fa-solid fa-circle-exclamation"></i> <span id="recipient-error-text">Recipient not found</span>
                    </div>

                    <p class="text-xs text-gray-500 mt-2">The exact Referral Code of the user you wish to send funds to.</p>
                </div>

                <div class="mb-8 relative z-10">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Transfer To (Recipient's Destination Wallet) *</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label id="lbl_dest_package" class="bg-[#1f2937] border-2 border-purple-500 text-purple-300 p-4 rounded-lg flex items-center justify-between cursor-pointer font-bold transition">
                            <span class="flex items-center gap-2"><i class="fa-solid fa-box-open text-purple-400"></i> Package Wallet</span>
                            <input type="radio" name="destination_wallet" checked value="package_wallet" class="accent-purple-500 pointer-events-none" onclick="updateDestStyle('package_wallet')">
                        </label>
                        <!-- <label id="lbl_dest_income" class="bg-[#0b1220] border-2 border-[#334155] text-gray-400 p-4 rounded-lg flex items-center justify-between cursor-pointer font-bold transition">
                            <span class="flex items-center gap-2"><i class="fa-solid fa-wallet text-green-400"></i> Income Wallet</span>
                            <input type="radio" name="destination_wallet" value="income_wallet" class="accent-green-500 pointer-events-none" onclick="updateDestStyle('income_wallet')">
                        </label> -->
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Select which wallet in the recipient's account should receive these funds.</p>
                </div>

                <div class="mb-8 relative z-10">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Amount to Transfer ($) *</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-dollar-sign text-gray-500"></i>
                        </div>
                        <input type="number" name="amount" id="amount" value="{{ old('amount', 300) }}" step="0.01" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg pl-10 pr-4 py-3 text-white text-xl font-bold focus:outline-none focus:border-indigo-500 transition shadow-inner">
                    </div>
                    <div id="amount-error" class="mt-3 hidden text-red-400 text-sm flex items-center gap-2">
                        <i class="fa-solid fa-circle-exclamation"></i> <span>Insufficient funds in your Income Wallet.</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Enter 300 to fully fund a new user's package activation.</p>
                </div>

                <div class="mb-8 relative z-10 border-t border-[#334155] pt-6">
                    <label class="block text-sm font-medium text-gray-300 mb-2"><i class="fa-solid fa-lock text-yellow-500 mr-2"></i>Enter your 4-Digit MPIN to confirm *</label>
                    <input type="password" name="mpin" id="mpin" maxlength="4" class="w-full bg-[#0b1220] border border-[#334155] rounded-lg px-4 py-3 text-white text-2xl tracking-[1em] text-center focus:outline-none focus:border-indigo-500 transition shadow-inner" placeholder="">
                </div>

                <div class="relative z-10">
                    <button type="submit" id="submit-btn" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-lg shadow-lg transition flex items-center justify-center gap-2 text-lg">
                        <i class="fa-solid fa-paper-plane"></i> Send Funds Now
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const recipientInput = document.getElementById('recipient_id');
    const amountInput = document.getElementById('amount');
    const submitBtn = document.getElementById('submit-btn');
    
    const detailsContainer = document.getElementById('recipient-details-container');
    const recipientRelationType = document.getElementById('recipient-relation-type');
    const recipientName = document.getElementById('recipient-name');
    const recipientEmail = document.getElementById('recipient-email');
    const recipientIdBadge = document.getElementById('recipient-id-badge');
    const recipientStatusBadge = document.getElementById('recipient-status-badge');
    
    const loadingDiv = document.getElementById('recipient-loading');
    const errorDiv = document.getElementById('recipient-error');
    const errorText = document.getElementById('recipient-error-text');
    
    const amountErrorDiv = document.getElementById('amount-error');

    const incomeBalance = {{ (float) $balance }};
    const packageBalance = {{ (float) $packageBalance }};
    let availableBalance = incomeBalance;
    let selectedWalletName = 'Income Wallet';
    const currentUserReferral = '{{ auth()->user()->referral_code }}';

    window.selectWallet = function(type) {
        document.getElementById('source_wallet').value = type;
        
        const cardIncome = document.getElementById('card_income_wallet');
        const cardPackage = document.getElementById('card_package_wallet');
        
        if (type === 'income_wallet') {
            availableBalance = incomeBalance;
            selectedWalletName = 'Income Wallet';
            cardIncome.className = 'bg-[#1f2937] border-2 border-green-500 rounded-xl p-6 shadow-lg text-center cursor-pointer transition transform hover:-translate-y-1';
            cardIncome.querySelector('input').checked = true;
            cardPackage.className = 'bg-[#1a222d] border-2 border-[#334155] rounded-xl p-6 shadow-lg text-center cursor-pointer transition transform hover:-translate-y-1';
            cardPackage.querySelector('input').checked = false;
        } else {
            availableBalance = packageBalance;
            selectedWalletName = 'Package Wallet';
            cardPackage.className = 'bg-[#1f2937] border-2 border-purple-500 rounded-xl p-6 shadow-lg text-center cursor-pointer transition transform hover:-translate-y-1';
            cardPackage.querySelector('input').checked = true;
            cardIncome.className = 'bg-[#1a222d] border-2 border-[#334155] rounded-xl p-6 shadow-lg text-center cursor-pointer transition transform hover:-translate-y-1';
            cardIncome.querySelector('input').checked = false;
        }
        checkFormValidity();
    };

    window.updateDestStyle = function(val) {
        const lblPackage = document.getElementById('lbl_dest_package');
        const lblIncome = document.getElementById('lbl_dest_income');
        if (val === 'package_wallet') {
            lblPackage.className = 'bg-[#1f2937] border-2 border-purple-500 text-purple-300 p-4 rounded-lg flex items-center justify-between cursor-pointer font-bold transition';
            lblIncome.className = 'bg-[#0b1220] border-2 border-[#334155] text-gray-400 p-4 rounded-lg flex items-center justify-between cursor-pointer font-bold transition';
        } else {
            lblIncome.className = 'bg-[#1f2937] border-2 border-green-500 text-green-300 p-4 rounded-lg flex items-center justify-between cursor-pointer font-bold transition';
            lblPackage.className = 'bg-[#0b1220] border-2 border-[#334155] text-gray-400 p-4 rounded-lg flex items-center justify-between cursor-pointer font-bold transition';
        }
    };

    let isRecipientValid = false;
    let isAmountValid = true;
    let debounceTimeout;

    function checkFormValidity() {
        const amount = parseFloat(amountInput.value) || 0;
        
        // 1. Amount validation
        if (amount <= 0) {
            isAmountValid = false;
            amountErrorDiv.classList.add('hidden');
        } else if (amount > availableBalance) {
            isAmountValid = false;
            amountErrorDiv.querySelector('span').textContent = `Insufficient funds in your ${selectedWalletName}.`;
            amountErrorDiv.classList.remove('hidden');
        } else {
            isAmountValid = true;
            amountErrorDiv.classList.add('hidden');
        }
    }

    function lookupRecipient() {
        const value = recipientInput.value.trim().toUpperCase();

        if (value.length < 3) {
            detailsContainer.classList.add('hidden');
            loadingDiv.classList.add('hidden');
            errorDiv.classList.add('hidden');
            isRecipientValid = false;
            checkFormValidity();
            return;
        }

        loadingDiv.classList.remove('hidden');
        detailsContainer.classList.add('hidden');
        errorDiv.classList.add('hidden');
        isRecipientValid = false;
        checkFormValidity();

        fetch(`{{ route('package.lookup_member') }}?sponsor_id=${encodeURIComponent(value)}`)
            .then(response => response.json())
            .then(data => {
                loadingDiv.classList.add('hidden');
                if (data.success) {
                    const user = data.user;
                    recipientName.textContent = user.name;
                    recipientEmail.textContent = user.email;
                    recipientIdBadge.textContent = user.referral_code;
                    recipientStatusBadge.textContent = user.status;

                    if (user.referral_code === currentUserReferral) {
                        recipientRelationType.textContent = 'Self Wallet Conversion';
                        recipientRelationType.className = 'text-xs text-indigo-400 uppercase font-extrabold tracking-wider mb-1';
                        recipientStatusBadge.className = 'px-2.5 py-1 rounded-md text-xs font-bold uppercase bg-blue-500/20 text-blue-300 border border-blue-500/30';
                        isRecipientValid = true;
                        detailsContainer.classList.remove('hidden');
                    } else if (user.status === 'active') {
                        recipientRelationType.textContent = 'Recipient Found';
                        recipientRelationType.className = 'text-xs text-green-400 uppercase font-extrabold tracking-wider mb-1';
                        recipientStatusBadge.className = 'px-2.5 py-1 rounded-md text-xs font-bold uppercase bg-green-500/20 text-green-300 border border-green-500/30';
                        isRecipientValid = true;
                        detailsContainer.classList.remove('hidden');
                    } else {
                        // Recipient is inactive, show custom warning
                        errorText.innerHTML = `Recipient account (${user.name}) is inactive. Transfers are only allowed to active members.`;
                        errorDiv.classList.remove('hidden');
                        isRecipientValid = false;
                    }
                } else {
                    errorText.textContent = data.message || 'Recipient not found.';
                    errorDiv.classList.remove('hidden');
                    isRecipientValid = false;
                }
                checkFormValidity();
            })
            .catch(err => {
                loadingDiv.classList.add('hidden');
                errorText.textContent = 'Error verifying recipient ID.';
                errorDiv.classList.remove('hidden');
                isRecipientValid = false;
                checkFormValidity();
            });
    }

    recipientInput.addEventListener('input', function() {
        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(lookupRecipient, 500);
    });

    amountInput.addEventListener('input', function() {
        checkFormValidity();
    });

    // Form submission confirmation with user details context
    const form = recipientInput.closest('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            
            const recipientVal = recipientInput.value.trim().toUpperCase();
            const amountVal = parseFloat(amountInput.value) || 0;
            
            // Check recipient validity first
            if (!isRecipientValid) {
                e.preventDefault();
                alert('Please enter a valid, active Recipient User ID (Referral Code).');
                recipientInput.focus();
                return;
            }

            // Check amount validity
            if (amountVal <= 0) {
                e.preventDefault();
                alert('Please enter a valid amount of $1 or more to transfer.');
                amountInput.focus();
                return;
            }

            if (amountVal > availableBalance) {
                e.preventDefault();
                alert(`Insufficient funds. Your available ${selectedWalletName} balance is $${availableBalance.toFixed(2)}.`);
                amountInput.focus();
                return;
            }

            // Check MPIN validity
            const mpinInput = document.getElementById('mpin');
            if (mpinInput) {
                const mpinVal = mpinInput.value.trim();
                if (!mpinVal) {
                    e.preventDefault();
                    alert('Please enter your 4-digit Security MPIN.');
                    mpinInput.focus();
                    return;
                }
                if (!/^\d{4}$/.test(mpinVal)) {
                    e.preventDefault();
                    alert('Security MPIN must be exactly 4 digits.');
                    mpinInput.focus();
                    return;
                }
            }

            const sourceVal = document.getElementById('source_wallet').value;
            const destRadio = document.querySelector('input[name="destination_wallet"]:checked');
            const destVal = destRadio ? destRadio.value : 'package_wallet';
            const destLabel = (destVal === 'income_wallet') ? 'Income Wallet' : 'Package Wallet';

            if (recipientVal === currentUserReferral && sourceVal === destVal) {
                e.preventDefault();
                alert(`Cannot transfer from ${selectedWalletName} to your own ${destLabel}. Please choose different source and destination wallets.`);
                return;
            }

            let msg = '';
            if (recipientVal === currentUserReferral) {
                msg = `Are you sure you want to convert $${amountVal.toFixed(2)} from your ${selectedWalletName} to your ${destLabel}?`;
            } else {
                const name = recipientName.textContent;
                msg = `Are you sure you want to transfer $${amountVal.toFixed(2)} from your ${selectedWalletName} to ${name}'s ${destLabel} (${recipientVal})?\nThis action cannot be undone.`;
            }
            
            if (!confirm(msg)) {
                e.preventDefault();
            }
        });
    }

    // Run initial checks on load
    if (recipientInput.value.trim().length >= 3) {
        lookupRecipient();
    } else {
        checkFormValidity();
    }
});
</script>
@endsection
