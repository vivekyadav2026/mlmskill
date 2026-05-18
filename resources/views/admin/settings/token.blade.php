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
  .btn-save { background:linear-gradient(135deg,#6366f1,#4f46e5); color:white; border:none; padding:.65rem 1.75rem; border-radius:.5rem; font-weight:600; cursor:pointer; transition:all .2s; }
  .btn-save:hover { opacity:.9; transform:translateY(-1px); }
  .toggle-row { display:flex; justify-content:space-between; align-items:center; padding:.75rem 0; border-bottom:1px solid #1e293b; }
  .toggle-row:last-child { border-bottom:none; }
</style>

<div class="tailwind-scope mt-4 max-w-4xl mx-auto">
  <div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-100">Token Settings</h2>
    <p class="text-gray-400 text-sm">Configure utility token and renewal token values, behaviour and rules</p>
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

  <form action="{{ url('admin/settings/token') }}" method="POST">
    @csrf

    <!-- Utility Token -->
    <div class="s-card">
      <div class="s-header"><i class="fa-solid fa-coins text-indigo-400"></i><h3>Utility Token (UT)</h3></div>
      <div class="s-body grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="f-label">Token Display Name</label>
          <input type="text" readonly name="utility_token_name" class="f-ctrl" value="{{ $settings['utility_token_name'] ?? 'Utility Token' }}" placeholder="e.g. Utility Token">
        </div>
        <div>
          <label class="f-label">Token Value ($) per 1 Token</label>
          <input type="number" step="0.0001" name="utility_token_value" class="f-ctrl" value="{{ $settings['utility_token_value'] ?? '1' }}" required>
        </div>
      </div>
    </div>

    <!-- Renewal Token -->
    <div class="s-card">
      <div class="s-header"><i class="fa-solid fa-rotate text-cyan-400"></i><h3>Renewal Token (RT)</h3></div>
      <div class="s-body grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="f-label">Token Display Name</label>
          <input type="text" readonly name="renewal_token_name" class="f-ctrl" value="{{ $settings['renewal_token_name'] ?? 'Renewal Token' }}" placeholder="e.g. Renewal Token">
        </div>
        <div>
          <label class="f-label">Token Value ($) per 1 Token</label>
          <input type="number" step="0.0001" name="renewal_token_value" class="f-ctrl" value="{{ $settings['renewal_token_value'] ?? '1' }}" required>
        </div>
      </div>
    </div>

    <!-- Token Rules -->
    <div class="s-card">
      <div class="s-header"><i class="fa-solid fa-sliders text-orange-400"></i><h3>Token Rules & Restrictions</h3></div>
      <div class="s-body grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="f-label">Token Expiry (Days) <small class="text-gray-500 normal-case font-normal">0 = Never Expire</small></label>
          <input type="number" name="token_expiry_days" class="f-ctrl" value="{{ $settings['token_expiry_days'] ?? '0' }}" min="0" required>
        </div>
        <div>
          <label class="f-label">Minimum Redeem Amount</label>
          <input type="number" step="0.01" name="min_token_redeem" class="f-ctrl" value="{{ $settings['min_token_redeem'] ?? '1' }}" min="0" required>
        </div>

        <div class="md:col-span-2">
          <div class="toggle-row">
            <div>
              <p class="text-gray-300 font-medium text-sm">Auto Credit Tokens</p>
              <p class="text-gray-500 text-xs">Automatically credit tokens when commission is earned</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="token_auto_credit" value="1" class="sr-only peer" {{ ($settings['token_auto_credit'] ?? '0') == '1' ? 'checked' : '' }}>
              <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
            </label>
          </div>
          <div class="toggle-row">
            <div>
              <p class="text-gray-300 font-medium text-sm">Allow Token Transfer</p>
              <p class="text-gray-500 text-xs">Allow users to transfer tokens to other members</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input type="checkbox" name="token_transferable" value="1" class="sr-only peer" {{ ($settings['token_transferable'] ?? '0') == '1' ? 'checked' : '' }}>
              <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
            </label>
          </div>
        </div>
      </div>
    </div>

    <div class="flex justify-end">
      <button type="submit" class="btn-save"><i class="fa-solid fa-floppy-disk mr-2"></i> Save Token Settings</button>
    </div>
  </form>
</div>
@endsection
