@extends('layouts.admin')
@section('content')
<style>
  .s-card { background:#1a222d; border:1px solid #334155; border-radius:.75rem; margin-bottom:1.5rem; overflow:hidden; }
  .s-header { background:#0f172a; padding:.85rem 1.5rem; border-bottom:1px solid #334155; display:flex; align-items:center; gap:.5rem; }
  .s-header h3 { color:#e2e8f0; font-weight:600; margin:0; font-size:.95rem; }
  .s-body { padding:1.5rem; }
  .f-label { color:#94a3b8; font-size:.75rem; font-weight:600; text-transform:uppercase; letter-spacing:.05em; margin-bottom:.4rem; display:block; }
  .f-ctrl { background:#0f172a; border:1px solid #334155; color:#e2e8f0; border-radius:.5rem; padding:.6rem 1rem; width:100%; transition:border-color .2s; }
  .f-ctrl:focus { outline:none; border-color:#6366f1; }
  .f-ctrl::placeholder { color:#475569; }
  .btn-save { background:linear-gradient(135deg,#6366f1,#4f46e5); color:white; border:none; padding:.65rem 1.75rem; border-radius:.5rem; font-weight:600; cursor:pointer; transition:all .2s; }
  .btn-save:hover { opacity:.9; transform:translateY(-1px); }
  .method-toggle { display:flex; align-items:center; justify-content:space-between; margin-bottom:1rem; padding:.75rem 1rem; background:#0f172a; border:1px solid #334155; border-radius:.5rem; }
</style>

<div class="tailwind-scope mt-4 max-w-4xl mx-auto">
  <div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-100">Payment Settings</h2>
    <p class="text-gray-400 text-sm">Configure currency, UPI, bank transfer, and crypto payment methods</p>
  </div>

  @if(session('success'))
    <div class="bg-green-900/40 border border-green-500/50 text-green-300 px-4 py-3 rounded-lg mb-4 flex items-center gap-2">
      <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
    </div>
  @endif
  @if($errors->any())
    <div class="bg-red-900/40 border border-red-500/50 text-red-300 px-4 py-3 rounded-lg mb-4 text-sm">
      <ul class="list-disc ml-4 space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
  @endif

  <form action="{{ url('admin/settings/payment') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Currency -->
    <div class="s-card">
      <div class="s-header"><i class="fa-solid fa-dollar-sign text-yellow-400"></i><h3>Currency Configuration</h3></div>
      <div class="s-body grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="f-label">Currency Code</label>
          <input type="text" name="payment_currency" class="f-ctrl" value="{{ $settings['payment_currency'] ?? 'USD' }}" placeholder="USD, INR, EUR..." maxlength="10" required>
        </div>
        <div>
          <label class="f-label">Currency Symbol</label>
          <input type="text" name="payment_currency_sym" class="f-ctrl" value="{{ $settings['payment_currency_sym'] ?? '$' }}" placeholder="$, ₹, €..." maxlength="5" required>
        </div>
      </div>
    </div>

    <!-- UPI -->
    <div class="s-card">
      <div class="s-header">
        <i class="fa-solid fa-mobile-screen text-green-400"></i>
        <h3>UPI Payment</h3>
        <label class="ml-auto flex items-center gap-2 cursor-pointer">
          <input type="checkbox" name="payment_upi_enabled" value="1" class="w-4 h-4 rounded" {{ ($settings['payment_upi_enabled'] ?? '0') == '1' ? 'checked' : '' }}>
          <span class="text-gray-400 text-sm font-normal">Enable UPI</span>
        </label>
      </div>
      <div class="s-body grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="f-label">UPI ID</label>
          <input type="text" name="upi_id" class="f-ctrl" value="{{ $settings['upi_id'] ?? '' }}" placeholder="yourname@upi">
        </div>
        <div>
          <label class="f-label">Account Holder Name</label>
          <input type="text" name="upi_name" class="f-ctrl" value="{{ $settings['upi_name'] ?? '' }}" placeholder="Name on UPI account">
        </div>
        <div class="md:col-span-2">
          <label class="f-label">UPI QR Code Image</label>
          @if(!empty($settings['qr_code_url']))
            <div class="mb-3">
              <p class="text-gray-500 text-xs mb-1">Current QR Code:</p>
              <img src="{{ $settings['qr_code_url'] }}" class="w-28 h-28 object-contain border border-gray-700 rounded p-1 bg-white">
            </div>
          @endif
          <input type="file" name="qr_image" class="f-ctrl" accept="image/*">
        </div>
      </div>
    </div>

    <!-- Bank Transfer -->
    <div class="s-card">
      <div class="s-header">
        <i class="fa-solid fa-building-columns text-blue-400"></i>
        <h3>Bank Transfer</h3>
        <label class="ml-auto flex items-center gap-2 cursor-pointer">
          <input type="checkbox" name="payment_bank_enabled" value="1" class="w-4 h-4 rounded" {{ ($settings['payment_bank_enabled'] ?? '0') == '1' ? 'checked' : '' }}>
          <span class="text-gray-400 text-sm font-normal">Enable Bank Transfer</span>
        </label>
      </div>
      <div class="s-body grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="f-label">Bank Name</label>
          <input type="text" name="bank_name" class="f-ctrl" value="{{ $settings['bank_name'] ?? '' }}" placeholder="e.g. State Bank of India">
        </div>
        <div>
          <label class="f-label">Account Holder Name</label>
          <input type="text" name="bank_holder_name" class="f-ctrl" value="{{ $settings['bank_holder_name'] ?? '' }}" placeholder="Full name on account">
        </div>
        <div>
          <label class="f-label">Account Number</label>
          <input type="text" name="bank_account_no" class="f-ctrl" value="{{ $settings['bank_account_no'] ?? '' }}" placeholder="XXXX XXXX XXXX XXXX">
        </div>
        <div>
          <label class="f-label">IFSC / Routing Code</label>
          <input type="text" name="bank_ifsc" class="f-ctrl" value="{{ $settings['bank_ifsc'] ?? '' }}" placeholder="e.g. SBIN0001234">
        </div>
      </div>
    </div>

    <!-- Crypto -->
    <div class="s-card">
      <div class="s-header">
        <i class="fa-brands fa-bitcoin text-orange-400"></i>
        <h3>Cryptocurrency</h3>
        <label class="ml-auto flex items-center gap-2 cursor-pointer">
          <input type="checkbox" name="payment_crypto_enabled" value="1" class="w-4 h-4 rounded" {{ ($settings['payment_crypto_enabled'] ?? '0') == '1' ? 'checked' : '' }}>
          <span class="text-gray-400 text-sm font-normal">Enable Crypto</span>
        </label>
      </div>
      <div class="s-body grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="f-label">Wallet Address</label>
          <input type="text" name="crypto_wallet_address" class="f-ctrl" value="{{ $settings['crypto_wallet_address'] ?? '' }}" placeholder="0x...">
        </div>
        <div>
          <label class="f-label">Network / Coin</label>
          <input type="text" name="crypto_network" class="f-ctrl" value="{{ $settings['crypto_network'] ?? '' }}" placeholder="e.g. USDT (TRC20), BTC, ETH">
        </div>
      </div>
    </div>

    <div class="flex justify-end">
      <button type="submit" class="btn-save"><i class="fa-solid fa-floppy-disk mr-2"></i> Save Payment Settings</button>
    </div>
  </form>
</div>
@endsection