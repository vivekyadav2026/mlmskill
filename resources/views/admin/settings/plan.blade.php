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
  .info-box { background:#1e293b; border:1px solid #334155; border-radius:.5rem; padding:.75rem 1rem; color:#94a3b8; font-size:.8rem; margin-top:.5rem; }
</style>

<div class="tailwind-scope mt-4 max-w-4xl mx-auto">
  <div class="flex justify-between items-center mb-6">
    <div>
      <h2 class="text-2xl font-bold text-gray-100">MLM Plan Settings</h2>
      <p class="text-gray-400 text-sm">Configure registration fees, commission percentages, and withdrawal limits</p>
    </div>
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

  <form action="{{ url('admin/settings/plan') }}" method="POST">
    @csrf

    <!-- Plan Identity -->
    <div class="s-card">
      <div class="s-header"><i class="fa-solid fa-diagram-project text-indigo-400"></i><h3>Plan Identity</h3></div>
      <div class="s-body grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="f-label">Plan Name</label>
          <input type="text" name="plan_name" class="f-ctrl" value="{{ $settings['plan_name'] ?? 'Standard MLM Plan' }}" placeholder="e.g. Pro Earners Plan">
        </div>
        <div>
          <label class="f-label">Registration / Joining Fee ($)</label>
          <input type="number" step="0.01" name="registration_fee" class="f-ctrl" value="{{ $settings['registration_fee'] ?? '0' }}" required>
        </div>
        <div class="md:col-span-2">
          <label class="f-label">Plan Description</label>
          <textarea name="plan_description" class="f-ctrl" rows="2" placeholder="Brief plan description shown on user registration...">{{ $settings['plan_description'] ?? '' }}</textarea>
        </div>
      </div>
    </div>

    <!-- Commission Structure -->
    <div class="s-card">
      <div class="s-header"><i class="fa-solid fa-dollar-sign text-green-400"></i><h3>Multi-Level Commission Structure ($)</h3></div>
      <div class="s-body grid grid-cols-2 md:grid-cols-5 gap-4">
        @for($i=1; $i<=10; $i++)
        <div>
          <label class="f-label">Level {{ $i }} ($)</label>
          <input type="number" step="0.01" name="level_{{ $i }}_amt" class="f-ctrl" value="{{ $settings['level_'.$i.'_amt'] ?? ($i==1 ? '15' : ($i==2 ? '10' : ($i==3 ? '6' : ($i==4 ? '3' : ($i==5 ? '2' : '0.5'))))) }}" required>
        </div>
        @endfor
      </div>
      <div class="s-body border-t border-[#334155] pt-0">
        <div class="grid grid-cols-1 gap-4">
            <div>
              <label class="f-label">Maximum Levels (Active)</label>
              <input type="number" name="max_levels" class="f-ctrl max-w-[200px]" value="{{ $settings['max_levels'] ?? '10' }}" min="1" max="10" required>
            </div>
            <p class="info-box mt-0">Level 1 corresponds to "Direct Commission". Levels 2-10 are "Team/Level Commissions". Note: You must also set the Maximum Levels field above to control how deep commissions go.</p>
        </div>
      </div>
    </div>

    <!-- Withdrawal Rules -->
    <div class="s-card">
      <div class="s-header"><i class="fa-solid fa-arrow-up-from-bracket text-orange-400"></i><h3>Withdrawal Rules</h3></div>
      <div class="s-body grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <label class="f-label">Minimum Withdrawal ($)</label>
          <input type="number" step="0.01" name="min_withdrawal" class="f-ctrl" value="{{ $settings['min_withdrawal'] ?? '10' }}" required>
        </div>
        <div>
          <label class="f-label">Maximum Withdrawal ($)</label>
          <input type="number" step="0.01" name="max_withdrawal" class="f-ctrl" value="{{ $settings['max_withdrawal'] ?? '5000' }}" required>
        </div>
        <div>
          <label class="f-label">Withdrawal Charge (%)</label>
          <input type="number" step="0.01" name="withdrawal_charge_pct" class="f-ctrl" value="{{ $settings['withdrawal_charge_pct'] ?? '5' }}" required>
          <p class="info-box">Fee deducted from each withdrawal</p>
        </div>
      </div>
    </div>

    <!-- NEXA 2.0 Target -->
    <div class="s-card">
      <div class="s-header"><i class="fa-solid fa-rotate text-cyan-400"></i><h3>NEXA 2.0 Target</h3></div>
      <div class="s-body grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="f-label">NEXA 2.0 Target Amount ($)</label>
          <input type="number" step="0.01" name="renewal_target" class="f-ctrl" value="{{ $settings['renewal_target'] ?? '300' }}" required>
          <p class="info-box">Users must accumulate this amount in NEXA 2.0 to renew their account</p>
        </div>
      </div>
    </div>

    <div class="flex justify-end">
      <button type="submit" class="btn-save"><i class="fa-solid fa-floppy-disk mr-2"></i> Save Plan Settings</button>
    </div>
  </form>
</div>
@endsection