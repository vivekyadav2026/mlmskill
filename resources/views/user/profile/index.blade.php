@extends('layouts.user')

@section('content')
<style>
  .app-main { padding: 16px; }

  /* ── Stat Cards ── */
  .stat-card {
    background: #1a222d;
    border: 1px solid #334155;
    border-radius: 12px;
    padding: 16px;
    transition: transform .2s, box-shadow .2s;
  }
  .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,.4); }

  /* ── Tabs ── */
  .tab-bar { display:flex; gap:4px; padding:10px; border-bottom:1px solid #334155; overflow-x:auto; flex-wrap:nowrap; }
  .tab-btn {
    cursor:pointer; padding:7px 14px; border-radius:8px;
    font-size:.82rem; font-weight:600; transition:all .2s;
    color:#94a3b8; background:transparent; border:none;
    white-space:nowrap; flex-shrink:0;
  }
  .tab-btn.active { background:#4f46e5; color:#fff; }
  .tab-pane { display:none; }
  .tab-pane.active { display:block; }

  /* ── Badges ── */
  .badge-active   { background:rgba(34,197,94,.15); color:#4ade80; border:1px solid rgba(34,197,94,.3); }
  .badge-inactive { background:rgba(239,68,68,.15);  color:#f87171; border:1px solid rgba(239,68,68,.3); }

  /* ── Copy Button ── */
  .copy-btn {
    background:#1e293b; border:1px solid #334155; color:#94a3b8;
    padding:3px 9px; border-radius:6px; font-size:.75rem;
    cursor:pointer; transition:all .2s;
  }
  .copy-btn:hover { background:#4f46e5; color:#fff; border-color:#4f46e5; }

  /* ── Responsive Helpers ── */
  @media(max-width:640px){
    .hero-info-grid { grid-template-columns: 1fr 1fr !important; }
    .stat-grid      { grid-template-columns: 1fr 1fr !important; }
    .earn-grid      { grid-template-columns: 1fr !important; }
    .wallet-grid    { grid-template-columns: 1fr 1fr !important; }
    .header-btns a  { padding: 6px 12px !important; font-size:.78rem !important; }
  }
</style>

<div class="tailwind-scope mt-3 max-w-5xl mx-auto" style="padding:0 4px;">

  {{-- ── PAGE HEADER ───────────────────────────────────────────── --}}
  <div class="flex flex-wrap justify-between items-center gap-3 mb-5">
    <div>
      <h2 class="text-xl md:text-2xl font-bold text-gray-100">My Profile</h2>
      <p class="text-gray-400 text-xs md:text-sm">Your complete account overview</p>
    </div>
    <div class="header-btns flex gap-2 flex-wrap">
      <a href="{{ route('profile.edit') }}"
         class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 md:px-4 rounded-lg text-xs md:text-sm font-medium transition flex items-center gap-1">
        <i class="fa-solid fa-pen-to-square"></i><span class="hidden sm:inline">Edit Profile</span>
      </a>
      <a href="{{ route('profile.password') }}"
         class="bg-[#1a222d] hover:bg-[#243040] border border-[#334155] text-gray-300 px-3 py-2 md:px-4 rounded-lg text-xs md:text-sm font-medium transition flex items-center gap-1">
        <i class="fa-solid fa-lock"></i><span class="hidden sm:inline">Password</span>
      </a>
      @if($user->status === 'active')
      <a href="{{ route('user.idcard') }}"
         class="bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-2 md:px-4 rounded-lg text-xs md:text-sm font-medium transition flex items-center gap-1">
        <i class="fa-solid fa-id-card"></i><span class="hidden sm:inline">ID Card</span>
      </a>
      @endif
    </div>
  </div>

  {{-- ── HERO CARD ──────────────────────────────────────────────── --}}
  <div class="bg-[#1a222d] rounded-xl border border-[#334155] overflow-hidden mb-5">
    <div class="h-16 md:h-20 bg-gradient-to-r from-indigo-700 via-purple-700 to-indigo-900"></div>
    <div class="px-4 md:px-6 pb-5">

      {{-- Avatar Row --}}
      <div class="flex items-end gap-3 -mt-8 md:-mt-10 mb-4">
        <div class="h-16 w-16 md:h-20 md:w-20 rounded-full border-4 border-[#1a222d] overflow-hidden bg-indigo-600 flex items-center justify-center text-white text-2xl md:text-3xl font-bold shadow-xl flex-shrink-0">
          @if($user->profile_image)
            <img src="{{ asset($user->profile_image) }}" class="w-full h-full object-cover"
                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=4f46e5&color=fff&size=80'">
          @else
            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=4f46e5&color=fff&size=80" class="w-full h-full object-cover">
          @endif
        </div>
        <div class="flex-1 min-w-0 pt-8 md:pt-10">
          <h3 class="text-base md:text-xl font-bold text-white truncate">{{ $user->name }}</h3>
          <p class="text-gray-400 text-xs md:text-sm truncate">{{ $user->email }}</p>
        </div>
        <div class="pt-10">
          @if($user->status === 'active')
            <span class="badge-active px-2 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
              <i class="fa-solid fa-bolt mr-1"></i><span class="hidden sm:inline">Active</span>
            </span>
          @else
            <span class="badge-inactive px-2 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
              <i class="fa-solid fa-circle-exclamation mr-1"></i><span class="hidden sm:inline">Inactive</span>
            </span>
          @endif
        </div>
      </div>

      {{-- Info Grid --}}
      <div class="hero-info-grid grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4">
        <div>
          <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Referral Code</p>
          <div class="flex items-center gap-1 flex-wrap">
            <span class="text-indigo-400 font-mono font-semibold text-xs md:text-sm" id="refCode">{{ $user->referral_code }}</span>
            <button class="copy-btn" onclick="copyText('refCode', this)"><i class="fa-regular fa-copy"></i></button>
          </div>
        </div>
        <div>
          <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Phone</p>
          <p class="text-gray-200 text-xs md:text-sm font-medium">{{ $user->phone ?? '—' }}</p>
        </div>
        <div>
          <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Gender</p>
          <p class="text-gray-200 text-xs md:text-sm font-medium capitalize">{{ $user->gender ?? '—' }}</p>
        </div>
        <div>
          <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Member Since</p>
          <p class="text-gray-200 text-xs md:text-sm font-medium">{{ $user->created_at->format('d M Y') }}</p>
        </div>
        <div>
          <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Location</p>
          <p class="text-gray-200 text-xs md:text-sm font-medium">
            {{ collect([$user->city, $user->state])->filter()->implode(', ') ?: '—' }}
          </p>
        </div>
        <div>
          <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Activation</p>
          <p class="text-gray-200 text-xs md:text-sm font-medium">
            {{ $user->activation_date ? \Carbon\Carbon::parse($user->activation_date)->format('d M Y') : 'Not Activated' }}
          </p>
        </div>
        <div>
          <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Sponsor</p>
          <p class="text-gray-200 text-xs md:text-sm font-medium">
            {{ $sponsor ? $sponsor->name : ($user->sponsor_id ?? 'None') }}
          </p>
        </div>
        <div>
          <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">KYC</p>
          <p class="text-xs md:text-sm font-medium {{ $user->is_profile_complete ? 'text-green-400' : 'text-yellow-400' }}">
            {{ $user->is_profile_complete ? 'Complete' : 'Incomplete' }}
          </p>
        </div>
      </div>
    </div>
  </div>

  {{-- ── STATS GRID ──────────────────────────────────────────────── --}}
  <div class="stat-grid grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 mb-5">
    <div class="stat-card">
      <p class="text-xs text-gray-500 uppercase tracking-wide mb-2">Total Earned</p>
      <p class="text-lg md:text-2xl font-bold text-green-400">${{ number_format($totalEarned, 2) }}</p>
      <p class="text-xs text-gray-500 mt-1">All commissions</p>
    </div>
    <div class="stat-card">
      <p class="text-xs text-gray-500 uppercase tracking-wide mb-2">Direct Referrals</p>
      <p class="text-lg md:text-2xl font-bold text-indigo-400">{{ $directCount }}</p>
      <p class="text-xs text-gray-500 mt-1"><span class="text-green-400">{{ $activeDirectCount }} active</span></p>
    </div>
    <div class="stat-card">
      <p class="text-xs text-gray-500 uppercase tracking-wide mb-2">{{ $tokenName }} Tokens</p>
      <p class="text-lg md:text-2xl font-bold text-yellow-400">{{ number_format($totalTokens, 2) }}</p>
      <p class="text-xs text-gray-500 mt-1">≈ ${{ number_format($totalTokens * $tokenPrice, 2) }}</p>
    </div>
    <div class="stat-card">
      <p class="text-xs text-gray-500 uppercase tracking-wide mb-2">Total Withdrawn</p>
      <p class="text-lg md:text-2xl font-bold text-purple-400">${{ number_format($totalWithdrawn, 2) }}</p>
      @if($pendingWithdrawal > 0)
        <p class="text-xs text-yellow-400 mt-1">${{ number_format($pendingWithdrawal, 2) }} pending</p>
      @else
        <p class="text-xs text-gray-500 mt-1">No pending</p>
      @endif
    </div>
  </div>

  {{-- ── WALLET BALANCES ────────────────────────────────────────── --}}
  @if($wallet)
  <div class="bg-[#1a222d] rounded-xl border border-[#334155] p-4 md:p-6 mb-5">
    <h4 class="text-xs md:text-sm font-semibold text-gray-300 uppercase tracking-wide mb-3">
      <i class="fa-solid fa-wallet mr-2 text-indigo-400"></i>Wallet Balances
    </h4>
    <div class="wallet-grid grid grid-cols-2 md:grid-cols-4 gap-3">
      @foreach(['income_balance' => 'Income', 'package_balance' => 'Package', 'utility_balance' => 'Utility', 'renewal_balance' => 'Renewal'] as $col => $label)
        @if(isset($wallet->$col))
        <div class="bg-[#0b1220] rounded-lg p-3 md:p-4 border border-[#1e293b]">
          <p class="text-xs text-gray-500 mb-1">{{ $label }}</p>
          <p class="text-base md:text-lg font-bold text-white">${{ number_format($wallet->$col, 2) }}</p>
        </div>
        @endif
      @endforeach
    </div>
  </div>
  @endif

  {{-- ── EARNINGS BREAKDOWN ────────────────────────────────────── --}}
  <div class="bg-[#1a222d] rounded-xl border border-[#334155] p-4 md:p-6 mb-5">
    <h4 class="text-xs md:text-sm font-semibold text-gray-300 uppercase tracking-wide mb-3">
      <i class="fa-solid fa-chart-pie mr-2 text-purple-400"></i>Earnings Breakdown
    </h4>
    <div class="earn-grid grid grid-cols-1 md:grid-cols-2 gap-3">
      <div class="bg-[#0b1220] rounded-lg p-3 md:p-4 border border-[#1e293b] flex justify-between items-center">
        <div>
          <p class="text-xs text-gray-500 mb-1">Direct Commission</p>
          <p class="text-lg md:text-xl font-bold text-green-400">${{ number_format($directEarned, 2) }}</p>
        </div>
        <div class="h-10 w-10 rounded-full bg-green-500/10 flex items-center justify-center">
          <i class="fa-solid fa-users text-green-400 text-sm"></i>
        </div>
      </div>
      <div class="bg-[#0b1220] rounded-lg p-3 md:p-4 border border-[#1e293b] flex justify-between items-center">
        <div>
          <p class="text-xs text-gray-500 mb-1">Team Commission</p>
          <p class="text-lg md:text-xl font-bold text-blue-400">${{ number_format($teamEarned, 2) }}</p>
        </div>
        <div class="h-10 w-10 rounded-full bg-blue-500/10 flex items-center justify-center">
          <i class="fa-solid fa-sitemap text-blue-400 text-sm"></i>
        </div>
      </div>
    </div>
  </div>

  {{-- ── ACTIVITY TABS ─────────────────────────────────────────── --}}
  <div class="bg-[#1a222d] rounded-xl border border-[#334155] overflow-hidden mb-5">
    <div class="tab-bar">
      <button class="tab-btn active" onclick="switchTab('commissions', this)">
        <i class="fa-solid fa-coins mr-1"></i>Commissions
      </button>
      <button class="tab-btn" onclick="switchTab('referrals', this)">
        <i class="fa-solid fa-user-plus mr-1"></i>Referrals
      </button>
      <button class="tab-btn" onclick="switchTab('withdrawals', this)">
        <i class="fa-solid fa-money-bill-transfer mr-1"></i>Withdrawals
      </button>
      <button class="tab-btn" onclick="switchTab('tokens', this)">
        <i class="fa-solid fa-circle-dollar-to-slot mr-1"></i>Tokens
      </button>
    </div>

    <div class="p-3 md:p-4">

      {{-- Commissions --}}
      <div id="tab-commissions" class="tab-pane active">
        @forelse($recentCommissions as $c)
          <div class="flex justify-between items-center py-3 border-b border-[#1e293b] last:border-0 gap-2">
            <div class="min-w-0">
              <p class="text-sm text-gray-200 font-medium capitalize truncate">{{ str_replace('_', ' ', $c->commission_type) }}</p>
              <p class="text-xs text-gray-500">{{ $c->created_at->format('d M Y, h:i A') }}</p>
            </div>
            <span class="text-green-400 font-bold text-sm flex-shrink-0">+${{ number_format($c->amount, 2) }}</span>
          </div>
        @empty
          <p class="text-gray-500 text-sm text-center py-8">No commission records yet.</p>
        @endforelse
      </div>

      {{-- Referrals --}}
      <div id="tab-referrals" class="tab-pane">
        @forelse($recentReferrals as $r)
          <div class="flex justify-between items-center py-3 border-b border-[#1e293b] last:border-0 gap-2">
            <div class="flex items-center gap-3 min-w-0">
              <div class="h-9 w-9 rounded-full bg-indigo-600 flex items-center justify-center text-white text-sm font-bold flex-shrink-0">
                {{ strtoupper(substr($r->name, 0, 1)) }}
              </div>
              <div class="min-w-0">
                <p class="text-sm text-gray-200 font-medium truncate">{{ $r->name }}</p>
                <p class="text-xs text-gray-500">{{ $r->created_at->format('d M Y') }}</p>
              </div>
            </div>
            @if($r->status === 'active')
              <span class="badge-active px-2 py-0.5 rounded-full text-xs font-semibold flex-shrink-0">Active</span>
            @else
              <span class="badge-inactive px-2 py-0.5 rounded-full text-xs font-semibold flex-shrink-0">Inactive</span>
            @endif
          </div>
        @empty
          <p class="text-gray-500 text-sm text-center py-8">No referrals yet.</p>
        @endforelse
      </div>

      {{-- Withdrawals --}}
      <div id="tab-withdrawals" class="tab-pane">
        @forelse($recentWithdrawals as $w)
          <div class="flex justify-between items-center py-3 border-b border-[#1e293b] last:border-0 gap-2">
            <div class="min-w-0">
              <p class="text-sm text-gray-200 font-medium">${{ number_format($w->amount, 2) }}</p>
              <p class="text-xs text-gray-500">{{ $w->created_at->format('d M Y, h:i A') }}</p>
            </div>
            <span class="px-2 py-0.5 rounded-full text-xs font-semibold flex-shrink-0
              {{ $w->status === 'approved' ? 'bg-green-500/10 text-green-400 border border-green-500/30' :
                 ($w->status === 'pending'  ? 'bg-yellow-500/10 text-yellow-400 border border-yellow-500/30' :
                                              'bg-red-500/10 text-red-400 border border-red-500/30') }}">
              {{ ucfirst($w->status) }}
            </span>
          </div>
        @empty
          <p class="text-gray-500 text-sm text-center py-8">No withdrawal records yet.</p>
        @endforelse
      </div>

      {{-- Tokens --}}
      <div id="tab-tokens" class="tab-pane">
        @forelse($recentTokens as $t)
          <div class="flex justify-between items-center py-3 border-b border-[#1e293b] last:border-0 gap-2">
            <div class="min-w-0">
              <p class="text-sm text-gray-200 font-medium capitalize truncate">{{ str_replace('_', ' ', $t->type ?? 'Token Credit') }}</p>
              <p class="text-xs text-gray-500">{{ $t->created_at->format('d M Y, h:i A') }}</p>
            </div>
            <span class="text-yellow-400 font-bold text-sm flex-shrink-0">
              {{ $t->token_count > 0 ? '+' : '' }}{{ number_format($t->token_count, 2) }} {{ $tokenName }}
            </span>
          </div>
        @empty
          <p class="text-gray-500 text-sm text-center py-8">No token records yet.</p>
        @endforelse
      </div>

    </div>
  </div>

</div>

<script>
function switchTab(name, btn) {
  document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
  document.getElementById('tab-' + name).classList.add('active');
  btn.classList.add('active');
}
function copyText(id, btn) {
  const txt = document.getElementById(id).innerText;
  navigator.clipboard.writeText(txt).then(() => {
    btn.innerHTML = '<i class="fa-solid fa-check"></i>';
    setTimeout(() => btn.innerHTML = '<i class="fa-regular fa-copy"></i>', 1500);
  });
}
</script>
@endsection
