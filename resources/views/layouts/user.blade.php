<!DOCTYPE html>
<!-- saved from url=(0042)../user/index.html -->
<html lang="en" data-bs-theme="{{ \App\Models\Setting::get('theme_mode', 'dark') }}"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Dashboard â€” XVolty Trade</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets/dist/bootstrap.min.css') }}">
  <!-- Tailwind CSS without Preflight -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      corePlugins: {
        preflight: false,
      },
      theme: {
        extend: {
          fontFamily: {
            sans: ['"Outfit"', 'sans-serif'],
          }
        }
      }
    }
  </script>
  <style>
    body, h1, h2, h3, h4, h5, h6, p, span, div, a, button, input, select, textarea {
        font-family: 'Outfit', sans-serif !important;
    }
  </style>

@php
    $tp  = \App\Models\Setting::get('theme_primary',    '#6366f1');
    $ta  = \App\Models\Setting::get('theme_accent',     '#8b5cf6');
    $tr  = \App\Models\Setting::get('theme_radius',     '8px');
    $tbb = \App\Models\Setting::get('theme_body_bg',    '#0b1220');
    $tcb = \App\Models\Setting::get('theme_card_bg',    '#1a222d');
    $tsb = \App\Models\Setting::get('theme_sidebar_bg', '#14172a');
    $ttb = \App\Models\Setting::get('theme_topbar_bg',  '#161f2d');
    $txt = \App\Models\Setting::get('theme_text',       '#e2e8f0');
    $tm  = \App\Models\Setting::get('theme_mode',       'dark');
@endphp
  <!-- Theme variables (loaded from database) -->
  <style id="xvt-theme-vars">
  /* ── SHARED (radius + primary across both modes) ── */
  :root {
    --xvt-primary:    {{ $tp }};
    --xvt-accent:     {{ $ta }};
    --xvt-radius:     {{ $tr }};
    --xvt-text:       {{ $txt }};
    --bs-primary:     var(--xvt-primary);
    --bs-link-color:  var(--xvt-primary);
    --bs-link-hover-color: var(--xvt-accent);
    --bs-border-radius:    var(--xvt-radius);
    --bs-border-radius-sm: calc(var(--xvt-radius) * 0.625);
    --bs-border-radius-lg: calc(var(--xvt-radius) * 1.25);
    --bs-body-color:  var(--xvt-text);
    color: var(--xvt-text);
  }

  /* ── DARK MODE ── */
  [data-bs-theme="dark"] {
    --xvt-body-bg:    {{ $tbb }};
    --xvt-card-bg:    {{ $tcb }};
    --xvt-sidebar-bg: {{ $tsb }};
    --xvt-topbar-bg:  {{ $ttb }};
    --xvt-muted:  #94a3b8;
    --xvt-border: #334155;
    --bs-body-bg:    var(--xvt-body-bg);
    --bs-border-color: var(--xvt-border);
    background-color: var(--xvt-body-bg);
  }
  [data-bs-theme="dark"] .app-sidebar  { background: var(--xvt-sidebar-bg) !important; }
  [data-bs-theme="dark"] .app-topbar   { background: var(--xvt-topbar-bg)  !important; }
  [data-bs-theme="dark"] .app-content  { background: var(--xvt-body-bg)    !important; }
  [data-bs-theme="dark"] .card,
  [data-bs-theme="dark"] .bg-card      { background: var(--xvt-card-bg)    !important; }

  /* ── LIGHT MODE ── */
  [data-bs-theme="light"] {
    --xvt-body-bg:    #f1f5f9;
    --xvt-card-bg:    #ffffff;
    --xvt-sidebar-bg: #1e293b;
    --xvt-topbar-bg:  #ffffff;
    --xvt-text:   #0f172a;
    --xvt-muted:  #64748b;
    --xvt-border: #e2e8f0;
    --bs-body-bg:    var(--xvt-body-bg);
    --bs-body-color: var(--xvt-text);
    --bs-border-color: var(--xvt-border);
    background-color: var(--xvt-body-bg);
  }
  [data-bs-theme="light"] .app-sidebar  { background: var(--xvt-sidebar-bg) !important; }
  [data-bs-theme="light"] .app-sidebar .nav-link,
  [data-bs-theme="light"] .app-sidebar .sidebar-brand { color: #e2e8f0 !important; }
  [data-bs-theme="light"] .app-topbar   { background: var(--xvt-topbar-bg);  border-bottom: 1px solid #e2e8f0; }
  [data-bs-theme="light"] .app-content  { background: var(--xvt-body-bg)    !important; }
  [data-bs-theme="light"] .card         { background: var(--xvt-card-bg); border-color: #e2e8f0; }
  [data-bs-theme="light"] .tailwind-scope .bg-\[\#1a222d\] { background-color: #ffffff !important; }
  [data-bs-theme="light"] .tailwind-scope .bg-\[\#0f172a\] { background-color: #f8fafc !important; }
  [data-bs-theme="light"] .tailwind-scope .bg-\[\#0b1220\] { background-color: #f1f5f9 !important; }
  [data-bs-theme="light"] .tailwind-scope .bg-gray-800 { background-color: #e2e8f0 !important; }
  [data-bs-theme="light"] .tailwind-scope .bg-gray-900 { background-color: #cbd5e1 !important; }
  [data-bs-theme="light"] .tailwind-scope .bg-\[\#161f2d\] { background-color: #f8fafc !important; }
  [data-bs-theme="light"] .tailwind-scope .bg-\[\#14172a\] { background-color: #f1f5f9 !important; }
  [data-bs-theme="light"] .tailwind-scope .hover\:bg-\[\#1f2937\]:hover { background-color: #f1f5f9 !important; }
  [data-bs-theme="light"] .tailwind-scope .border-\[\#334155\] { border-color: #e2e8f0 !important; }
  [data-bs-theme="light"] .tailwind-scope .divide-\[\#334155\] > :not([hidden]) ~ :not([hidden]) { border-color: #e2e8f0 !important; }
  [data-bs-theme="light"] .tailwind-scope .text-gray-100,
  [data-bs-theme="light"] .tailwind-scope .text-gray-200,
  [data-bs-theme="light"] .tailwind-scope .text-gray-300 { color: #0f172a !important; }
  [data-bs-theme="light"] .tailwind-scope .text-gray-400,
  [data-bs-theme="light"] .tailwind-scope .text-gray-500 { color: #64748b !important; }
  [data-bs-theme="light"] .table-custom th { background-color: #f8fafc !important; color: #475569 !important; border-bottom-color: #e2e8f0 !important; }
  [data-bs-theme="light"] .table-custom td { background-color: #ffffff !important; color: #0f172a !important; border-bottom-color: #e2e8f0 !important; }
  </style>

  <!-- Theme component CSS -->
  <link rel="stylesheet" href="{{ asset('assets/dist/theme.css') }}">
</head>
<body>
  @include('components.preloader')
  <!-- ===== App Shell ===== -->
<div class="app-shell">

  <!-- ===== Sidebar (Left) -->
  <aside id="appSidebar" class="app-sidebar shadow-lg">
        <a href="{{ route('dashboard') }}" class="sidebar-brand d-flex align-items-center gap-2">
            <img src="{{ asset('logo.png') }}" alt="Logo" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
        <span> Samarth Digital</span>
          </a>
    <ul class="list-unstyled mb-0 pb-3">
      <li class="nav-section">Main</li>
      <li><a href="{{ route('dashboard') }}" class="nav-link"><i class="fa-solid fa-house"></i><span>Dashboard</span></a></li>
      
      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-user"></i><span>My Profile</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('user/profile') }}" class="nav-link sub-link"><i class="fa-solid fa-id-card"></i><span>View Profile</span></a></li>
          <li><a href="{{ url('user/profile/edit') }}" class="nav-link sub-link"><i class="fa-solid fa-user-pen"></i><span>Edit Profile</span></a></li>
          <li><a href="{{ url('user/profile/password') }}" class="nav-link sub-link"><i class="fa-solid fa-key"></i><span>Change Password</span></a></li>
          <li><a href="{{ url('user/id-card') }}" class="nav-link sub-link"><i class="fa-solid fa-id-badge"></i><span>Digital ID Card</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-wallet"></i><span>Wallets</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('user/wallets/income') }}" class="nav-link sub-link"><span>Income Wallet</span></a></li>
          <li><a href="{{ url('user/wallets/package') }}" class="nav-link sub-link"><span>Package Wallet</span></a></li>
          <li><a href="{{ url('user/wallets/utility') }}" class="nav-link sub-link"><span>NEXA 1.0 Wallet</span></a></li>
          <li><a href="{{ url('user/wallets/renewal') }}" class="nav-link sub-link"><span>NEXA 2.0 Wallet</span></a></li>
          <li><a href="{{ url('user/wallets/history') }}" class="nav-link sub-link"><span>Wallet History</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-exchange-alt"></i><span>P2P System</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('user/wallets/transfer') }}" class="nav-link sub-link"><span>Transfer Funds</span></a></li>
          <li><a href="{{ url('user/p2p/history') }}" class="nav-link sub-link"><span>Transfer History</span></a></li>
          <li><a href="{{ url('user/p2p/mpin') }}" class="nav-link sub-link"><span>Manage MPIN</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-users"></i><span>My Network</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('user/network/sponsor') }}" class="nav-link sub-link"><span>My Sponsor</span></a></li>
          <li><a href="{{ url('user/network/direct') }}" class="nav-link sub-link"><span>Direct Referrals</span></a></li>
          <li><a href="{{ url('user/network/tree') }}" class="nav-link sub-link"><span>Team Tree (Level View)</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-link"></i><span>Referral</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('user/referral/link') }}" class="nav-link sub-link"><span>My Referral Link</span></a></li>
          <li><a href="{{ url('user/referral/invite') }}" class="nav-link sub-link"><span>Invite / Share</span></a></li>
          <li><a href="{{ url('user/referral/history') }}" class="nav-link sub-link"><span>Referral History</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-money-bill-wave"></i><span>Earnings</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('user/earnings/direct') }}" class="nav-link sub-link"><span>Direct Income</span></a></li>
          <li><a href="{{ url('user/network/level') }}" class="nav-link sub-link"><span>Level Income</span></a></li>
          <li><a href="{{ url('user/earnings/team') }}" class="nav-link sub-link"><span>Team Income</span></a></li>
          <li><a href="{{ url('user/earnings/total') }}" class="nav-link sub-link"><span>Total Earnings Report</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-graduation-cap"></i><span>Course & Training</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('user/course/my') }}" class="nav-link sub-link"><span>My Course</span></a></li>
          <li><a href="{{ url('user/course/complete') }}" class="nav-link sub-link"><span>Complete Course</span></a></li>
          <li><a href="{{ url('user/course/certificate') }}" class="nav-link sub-link"><span>Download Certificate</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-coins"></i><span>Token System</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <!-- <li><a href="{{ url('user/token/history') }}" class="nav-link sub-link"><span>Daily Token History</span></a></li> -->
          <li><a href="{{ url('user/token/utility') }}" class="nav-link sub-link"><span>NEXA 1.0 Details</span></a></li>
          <li><a href="{{ url('user/token/renewal') }}" class="nav-link sub-link"><span>NEXA 2.0 Details</span></a></li>
          <li><a href="{{ url('user/token/conversion') }}" class="nav-link sub-link"><span>Token Conversion</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-box"></i><span>Package / Upgrade</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('user/package/upgrade') }}" class="nav-link sub-link"><span>Upgrade Package</span></a></li>
          <li><a href="{{ url('user/package/activate-member') }}" class="nav-link sub-link"><span>Activate Member</span></a></li>
          <li><a href="{{ url('user/package/history') }}" class="nav-link sub-link"><span>Package History</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-arrow-up-from-bracket"></i><span>Withdrawals</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('user/withdraw/request') }}" class="nav-link sub-link"><span>Request Withdrawal</span></a></li>
          <li><a href="{{ url('user/withdraw/history') }}" class="nav-link sub-link"><span>Withdrawal History</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-chart-line"></i><span>Reports</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('user/reports/income') }}" class="nav-link sub-link"><span>Income Report</span></a></li>
          <li><a href="{{ url('user/reports/token') }}" class="nav-link sub-link"><span>Token Report</span></a></li>
          <li><a href="{{ url('user/reports/transaction') }}" class="nav-link sub-link"><span>Transaction Report</span></a></li>
        </ul>
      </li>

      <li class="nav-section">Value Added Services</li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-briefcase"></i><span>Job Placements</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ route('user.jobs.index') }}" class="nav-link sub-link"><span>Available Jobs</span></a></li>
          <li><a href="{{ route('user.jobs.applications') }}" class="nav-link sub-link"><span>My Applications</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-hand-holding-dollar"></i><span>Loan Facility</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ route('user.loans.index') }}" class="nav-link sub-link"><span>Loan Schemes</span></a></li>
          <li><a href="{{ route('user.loans.history') }}" class="nav-link sub-link"><span>My Loan Requests</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-bell"></i><span>Notifications</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('user/notifications/system') }}" class="nav-link sub-link"><span>System Notifications</span></a></li>
          <li><a href="{{ url('user/notifications/announcements') }}" class="nav-link sub-link"><span>Announcements</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-gear"></i><span>Settings</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('user/settings/account') }}" class="nav-link sub-link"><span>Account Settings</span></a></li>
          <li><a href="{{ url('user/settings/security') }}" class="nav-link sub-link"><span>Security Settings</span></a></li>
        </ul>
      </li>

      <li><a href="{{ route('logout') }}" class="nav-link"><i class="fa-solid fa-right-from-bracket"></i><span>Logout</span></a></li>
    </ul>
  </aside>
  <div class="app-sidebar-backdrop" id="appSidebarBackdrop"></div>

  <!-- Main column -->
  <div class="app-main">
    <!-- ===== User Topbar ===== -->
        <nav class="app-topbar d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center gap-2">
        <button class="btn btn-sm btn-outline-secondary d-lg-none" id="sidebarMobileBtn" aria-label="Open sidebar">
          <i class="fa-solid fa-bars"></i>
        </button>
        <h6 class="mb-0 fw-heading d-none d-md-block">Dashboard</h6>
      </div>

      <div class="d-flex align-items-center gap-2">
        <!-- Notifications -->
        <!-- <div class="dropdown">
          <button class="btn btn-sm btn-outline-secondary position-relative" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-bell"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:0.6rem;">2</span>
          </button>
          <div class="dropdown-menu dropdown-menu-end p-0" style="min-width:320px;">
            <h6 class="dropdown-header">Notifications</h6>
            <a class="dropdown-item d-flex gap-2 py-2" href="#">
              <span class="xvt-avatar" style="background:#10b981;"><i class="fa-solid fa-check"></i></span>
              <span class="small"><strong>$1,500</strong> deposit confirmed<br><span class="text-muted">10 minutes ago</span></span>
            </a>
            <a class="dropdown-item d-flex gap-2 py-2" href="#">
              <span class="xvt-avatar"><i class="fa-solid fa-chart-line"></i></span>
              <span class="small">Daily ROI <strong>$45.50</strong> credited<br><span class="text-muted">2 hours ago</span></span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-center small" href="#">View all</a>
          </div>
        </div> -->

        <!-- Profile -->
        <div class="dropdown">
          <button class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-2" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="xvt-avatar" style="width:28px; height:28px; font-size:0.75rem;">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}</span>
            <span class="d-none d-md-inline">{{ auth()->user()->name ?? 'User' }}</span>
            <i class="fa-solid fa-chevron-down small"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><h6 class="dropdown-header">{{ auth()->user()->name ?? 'User' }}<br><small class="text-muted">{{ auth()->user()->email ?? '' }}</small></h6></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ url('user/profile') }}"><i class="fa-solid fa-user me-2"></i>Profile</a></li>
            <li><a class="dropdown-item" href="{{ route('profile.password') }}"><i class="fa-solid fa-shield-halved me-2"></i>Security</a></li>
            <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="fa-solid fa-right-from-bracket me-2"></i>Log Out</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Start page content -->
    <main class="app-content">
  @yield('content')
</main>
  </div><!-- /.app-main -->
</div><!-- /.app-shell -->

<script src="{{ asset('assets/dist/bootstrap.bundle.min.js') }}"></script>
<script>
(function(){
  const sidebar  = document.getElementById('appSidebar');
  const backdrop = document.getElementById('appSidebarBackdrop');
  const btn      = document.getElementById('sidebarMobileBtn');
  if (btn)      btn.addEventListener('click', () => { sidebar.classList.add('show'); backdrop.classList.add('show'); });
  if (backdrop) backdrop.addEventListener('click', () => { sidebar.classList.remove('show'); backdrop.classList.remove('show'); });
  document.querySelectorAll('.app-sidebar .nav-dropdown-toggle').forEach(a => {
    a.addEventListener('click', (e) => { e.preventDefault(); a.closest('.has-submenu').classList.toggle('open'); });
  });

  // Auto-highlight active link based on current URL
  const currentUrl = window.location.href.split(/[?#]/)[0];
  document.querySelectorAll('.app-sidebar a').forEach(link => {
      if (link.href === currentUrl) {
          link.classList.add('active');
          link.style.color = 'var(--xvt-primary)';
          // If it's inside a submenu, open the parent
          const parentSubmenu = link.closest('.has-submenu');
          if (parentSubmenu) {
              parentSubmenu.classList.add('open');
              const toggle = parentSubmenu.querySelector('.nav-dropdown-toggle');
              if (toggle) toggle.classList.add('active');
          }
      }
  });
})();
</script>


<!-- Support Chat Widget -->
<div id="supportChatWidget" class="tailwind-scope fixed bottom-6 right-6" style="z-index: 9999;">
    <!-- Chat Button -->
    <button id="supportChatBtn" class="bg-indigo-600 hover:bg-indigo-700 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-2xl transition transform hover:scale-110 focus:outline-none relative">
        <i class="fa-solid fa-comments text-2xl"></i>
        <span id="supportChatBadge" class="hidden absolute top-0 right-0 bg-red-600 text-white text-xs font-bold w-5 h-5 flex items-center justify-center rounded-full border-2 border-[#1a222d]"></span>
    </button>

    <!-- Chat Box -->
    <div id="supportChatBox" class="hidden absolute bottom-16 right-0 w-80 rounded-xl shadow-2xl flex flex-col overflow-hidden border border-gray-700" style="height: 400px; background-color: #1a222d;">
        <div class="bg-indigo-600 text-white px-4 py-3 flex justify-between items-center">
            <h3 class="font-bold m-0 text-white"><i class="fa-solid fa-headset mr-2"></i> Support Team</h3>
            <button id="closeSupportChat" class="text-white hover:text-gray-200 focus:outline-none"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div id="supportChatMessages" class="flex-1 p-4 overflow-y-auto flex flex-col gap-3">
            <!-- Messages go here -->
        </div>
        <div class="p-3 border-t border-gray-700" style="background-color: #0b1220;">
            <form id="supportChatForm" class="flex gap-2 m-0">
                <input type="text" id="supportChatMessage" class="flex-1 text-white rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 border border-gray-700" style="background-color: #1a222d;" placeholder="Type a message..." required autocomplete="off">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 rounded-lg transition"><i class="fa-solid fa-paper-plane"></i></button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatBtn = document.getElementById('supportChatBtn');
    const chatBox = document.getElementById('supportChatBox');
    const closeChat = document.getElementById('closeSupportChat');
    const chatForm = document.getElementById('supportChatForm');
    const messageInput = document.getElementById('supportChatMessage');
    const messagesContainer = document.getElementById('supportChatMessages');
    let lastMessageCount = 0;

    if (!chatBtn) return; // Prevent errors if not logged in

    chatBtn.addEventListener('click', () => {
        chatBox.classList.toggle('hidden');
        if (!chatBox.classList.contains('hidden')) {
            document.getElementById('supportChatBadge').classList.add('hidden');
            fetchMessages();
        }
    });

    closeChat.addEventListener('click', () => {
        chatBox.classList.add('hidden');
    });

    // Unread count checker
    setInterval(() => {
        if (chatBox.classList.contains('hidden')) {
            fetch('/user/chat/unread')
                .then(res => res.json())
                .then(data => {
                    const badge = document.getElementById('supportChatBadge');
                    if (data.unread > 0) {
                        badge.innerText = data.unread;
                        badge.classList.remove('hidden');
                    } else {
                        badge.classList.add('hidden');
                    }
                })
                .catch(err => console.error(err));
        }
    }, 3000);

    function fetchMessages() {
        fetch('/user/chat/messages')
            .then(res => res.json())
            .then(data => {
                if (data.messages.length !== lastMessageCount) {
                    messagesContainer.innerHTML = '';
                    if(data.messages.length === 0) {
                        messagesContainer.innerHTML = '<div class="text-center text-gray-500 text-xs mt-4">Send a message to start chatting with support.</div>';
                    }
                    data.messages.forEach(msg => appendMessage(msg));
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                    lastMessageCount = data.messages.length;
                }
            })
            .catch(err => console.error(err));
    }

    function appendMessage(msg) {
        const div = document.createElement('div');
        const isUser = msg.sender === 'user';
        const bgClass = isUser ? 'bg-indigo-600 text-white self-end rounded-br-none' : 'text-gray-100 self-start rounded-bl-none';
        
        div.className = `max-w-[80%] rounded-lg px-3 py-2 text-sm ${bgClass}`;
        if (!isUser) {
            div.style.backgroundColor = '#334155';
        }
        div.innerText = msg.message;
        messagesContainer.appendChild(div);
    }

    if(chatForm) {
        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const msg = messageInput.value.trim();
            if(!msg) return;

            messageInput.value = '';
            messageInput.disabled = true;

            fetch('/user/chat/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ message: msg })
            })
            .then(res => res.json())
            .then(data => {
                messageInput.disabled = false;
                messageInput.focus();
                if(data.success) {
                    if(messagesContainer.innerHTML.includes('Send a message to start')) messagesContainer.innerHTML = '';
                    appendMessage(data.message);
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                    lastMessageCount++;
                }
            });
        });
    }

    // Auto refresh if open
    setInterval(() => {
        if (!chatBox.classList.contains('hidden')) {
            fetchMessages();
        }
    }, 1500);
});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: {!! json_encode(session('success')) !!},
            confirmButtonColor: '#4f46e5',
            background: '#1a222d',
            color: '#fff'
        });
    });
</script>
@endif
@if(session('error'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: {!! json_encode(session('error')) !!},
            confirmButtonColor: '#4f46e5',
            background: '#1a222d',
            color: '#fff'
        });
    });
</script>
@endif
</body>
</html>




