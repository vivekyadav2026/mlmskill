<!DOCTYPE html>
<!-- saved from url=(0042)../user/index.html -->
<html lang="en" data-bs-theme="dark"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Dashboard â€” XVolty Trade</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
  <link href="{{ asset('assets/My Dashboard â€” XVolty Trade_files/css2') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Bootstrap (local) -->
  <link rel="stylesheet" href="{{ asset('assets/My Dashboard â€” XVolty Trade_files/bootstrap.min.css') }}">
  <!-- Tailwind CSS without Preflight -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      corePlugins: {
        preflight: false,
      }
    }
  </script>

  <!-- Theme variables -->
  <style id="xvt-theme-vars">
  :root,
  [data-bs-theme="dark"] {
    --xvt-primary: #f24a4a;
    --xvt-accent:  #8c54c4;
    --xvt-radius:  8px;
    --xvt-body-bg: #0b1220;
    --xvt-card-bg: #1a222d;
    --xvt-sidebar-bg: #14172a;
    --xvt-topbar-bg:  #161f2d;
    --xvt-text:    #e2e8f0;
    --xvt-muted:   #94a3b8;
    --xvt-border:  #334155;

    /* Bootstrap overrides */
    --bs-primary: var(--xvt-primary);
    --bs-primary-rgb: 8, 126, 139;
    --bs-link-color: var(--xvt-primary);
    --bs-link-hover-color: var(--xvt-accent);
    --bs-body-bg: var(--xvt-body-bg);
    --bs-body-color: var(--xvt-text);
    --bs-border-color: var(--xvt-border);
    --bs-border-radius: var(--xvt-radius);
    --bs-border-radius-sm: calc(var(--xvt-radius) * 0.625);
    --bs-border-radius-lg: calc(var(--xvt-radius) * 1.25);
  }
</style>

  <!-- Constant theme CSS -->
  <link rel="stylesheet" href="{{ asset('assets/My Dashboard â€” XVolty Trade_files/theme.css') }}">
</head>
<body>
  <!-- ===== App Shell ===== -->
<div class="app-shell">

  <!-- ===== User Sidebar ===== -->
  <aside id="appSidebar" class="app-sidebar">
        <a href="{{ url('user/index') }}" class="sidebar-brand">
              <i class="fa-solid fa-bolt-lightning"></i>
        <span>X VOLTY TRADE</span>
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
          <li><a href="{{ url('user/wallets/utility') }}" class="nav-link sub-link"><span>Utility Token Wallet</span></a></li>
          <li><a href="{{ url('user/wallets/renewal') }}" class="nav-link sub-link"><span>Renewal Token Wallet</span></a></li>
          <li><a href="{{ url('user/wallets/history') }}" class="nav-link sub-link"><span>Wallet History</span></a></li>
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
          <li><a href="{{ url('user/network/level') }}" class="nav-link sub-link"><span>Level Income Report</span></a></li>
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
          <li><a href="{{ url('user/course/progress') }}" class="nav-link sub-link"><span>Course Progress</span></a></li>
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
          <li><a href="{{ url('user/token/history') }}" class="nav-link sub-link"><span>Daily Token History</span></a></li>
          <li><a href="{{ url('user/token/utility') }}" class="nav-link sub-link"><span>Utility Token Details</span></a></li>
          <li><a href="{{ url('user/token/renewal') }}" class="nav-link sub-link"><span>Renewal Token Details</span></a></li>
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
            <span class="xvt-avatar" style="width:28px; height:28px; font-size:0.75rem;"><img src="{{ asset('assets/My Dashboard â€” XVolty Trade_files/3448ce1363001e09fd873ae7a8b81485.png') }}" alt=""></span>
            <span class="d-none d-md-inline">{{ auth()->user()->name ?? 'User' }}</span>
            <i class="fa-solid fa-chevron-down small"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><h6 class="dropdown-header">{{ auth()->user()->name ?? 'User' }}<br><small class="text-muted">{{ auth()->user()->email ?? '' }}</small></h6></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ url('user/profile') }}"><i class="fa-solid fa-user me-2"></i>Profile</a></li>
            <li><a class="dropdown-item" href="{{ url('user/change-password') }}"><i class="fa-solid fa-shield-halved me-2"></i>Security</a></li>
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

<script src="{{ asset('assets/My Dashboard â€” XVolty Trade_files/bootstrap.bundle.min.js.download') }}"></script>
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


</body></html>



