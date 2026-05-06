<!DOCTYPE html>
<!-- saved from url=(0043)../admin/index.html -->
<html lang="en" data-bs-theme="dark"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard â€” XVolty Trade</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
  <link href="{{ asset('assets/Admin Dashboard â€” XVolty Trade_files/css2') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Bootstrap (local) -->
  <link rel="stylesheet" href="{{ asset('assets/Admin Dashboard â€” XVolty Trade_files/bootstrap.min.css') }}">
  <!-- Tailwind CSS without Preflight -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      corePlugins: {
        preflight: false,
      }
    }
  </script>

  <!-- Theme variables (from site_settings) -->
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

  <!-- Constant theme CSS (Bootstrap overrides + bespoke components) -->
  <link rel="stylesheet" href="{{ asset('assets/Admin Dashboard â€” XVolty Trade_files/theme.css') }}">
</head>
<body>
  <!-- ===== App Shell starts here ===== -->
<div class="app-shell">

  <!-- ===== Admin Sidebar ===== -->
  <aside id="appSidebar" class="app-sidebar">
        <a href="{{ url('admin/index') }}" class="sidebar-brand">
              <i class="fa-solid fa-bolt-lightning"></i>
        <span>X VOLTY TRADE</span>
          </a>
    <ul class="list-unstyled mb-0 pb-3">
      <li class="nav-section">Main</li>
      
      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-house"></i><span>Dashboard</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ route('admin.dashboard') }}" class="nav-link sub-link"><span>Overview</span></a></li>
          <li><a href="{{ url('admin/analytics') }}" class="nav-link sub-link"><span>Analytics</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-users"></i><span>User Management</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('admin/users') }}" class="nav-link sub-link"><span>All Users</span></a></li>
          <li><a href="{{ url('admin/users/active') }}" class="nav-link sub-link"><span>Active Users</span></a></li>
          <li><a href="{{ url('admin/users/inactive') }}" class="nav-link sub-link"><span>Inactive Users</span></a></li>
          <li><a href="{{ url('admin/users/create') }}" class="nav-link sub-link"><span>Add User</span></a></li>
          <li><a href="{{ url('admin/users/tree') }}" class="nav-link sub-link"><span>Sponsor Tree View</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-credit-card"></i><span>Activation / Payments</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('admin/activations/requests') }}" class="nav-link sub-link"><span>Activation Requests</span></a></li>
          <li><a href="{{ url('admin/activations/history') }}" class="nav-link sub-link"><span>Payment History</span></a></li>
          <li><a href="{{ url('admin/activations/manual') }}" class="nav-link sub-link"><span>Manual Activation</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-wallet"></i><span>Wallet Management</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('admin/wallets') }}" class="nav-link sub-link"><span>All Wallets</span></a></li>
          <li><a href="{{ url('admin/wallets/adjustments') }}" class="nav-link sub-link"><span>Wallet Adjustments</span></a></li>
          <li><a href="{{ url('admin/wallets/logs') }}" class="nav-link sub-link"><span>Wallet Logs</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-coins"></i><span>Token Management</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('admin/tokens/settings') }}" class="nav-link sub-link"><span>Token Settings</span></a></li>
          <li><a href="{{ url('admin/tokens/logs') }}" class="nav-link sub-link"><span>Token Distribution Logs</span></a></li>
          <li><a href="{{ url('admin/tokens/manual') }}" class="nav-link sub-link"><span>Manual Token Credit</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-sack-dollar"></i><span>Commission Management</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('admin/commissions/direct') }}" class="nav-link sub-link"><span>Direct Income Logs</span></a></li>
          <li><a href="{{ url('admin/commissions/level') }}" class="nav-link sub-link"><span>Level Income Logs</span></a></li>
          <li><a href="{{ url('admin/commissions/settings') }}" class="nav-link sub-link"><span>Commission Settings</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-graduation-cap"></i><span>Course Management</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('admin/courses') }}" class="nav-link sub-link"><span>All Courses</span></a></li>
          <li><a href="{{ url('admin/courses/create') }}" class="nav-link sub-link"><span>Add Course</span></a></li>
          <li><a href="{{ url('admin/courses/content') }}" class="nav-link sub-link"><span>Course Content</span></a></li>
          <li><a href="{{ url('admin/courses/progress') }}" class="nav-link sub-link"><span>User Course Progress</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-certificate"></i><span>Certificate Management</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('admin/certificates/generate') }}" class="nav-link sub-link"><span>Generate Certificate</span></a></li>
          <li><a href="{{ url('admin/certificates/issued') }}" class="nav-link sub-link"><span>Issued Certificates</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-arrow-up-from-bracket"></i><span>Withdrawal Management</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('admin/withdrawals/pending') }}" class="nav-link sub-link"><span>Pending Withdrawals</span></a></li>
          <li><a href="{{ url('admin/withdrawals/approved') }}" class="nav-link sub-link"><span>Approved Withdrawals</span></a></li>
          <li><a href="{{ url('admin/withdrawals/rejected') }}" class="nav-link sub-link"><span>Rejected Withdrawals</span></a></li>
          <li><a href="{{ url('admin/withdrawals/logs') }}" class="nav-link sub-link"><span>Payment Logs</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-chart-bar"></i><span>Reports & Analytics</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('admin/reports/income') }}" class="nav-link sub-link"><span>Income Reports</span></a></li>
          <li><a href="{{ url('admin/reports/token') }}" class="nav-link sub-link"><span>Token Reports</span></a></li>
          <li><a href="{{ url('admin/reports/user') }}" class="nav-link sub-link"><span>User Reports</span></a></li>
          <li><a href="{{ url('admin/reports/financial') }}" class="nav-link sub-link"><span>Financial Reports</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-calendar-check"></i><span>Monthly Closing</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('admin/closing/generate') }}" class="nav-link sub-link"><span>Generate Closing</span></a></li>
          <li><a href="{{ url('admin/closing/history') }}" class="nav-link sub-link"><span>Closing History</span></a></li>
          <li><a href="{{ url('admin/closing/reports') }}" class="nav-link sub-link"><span>Settlement Reports</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-newspaper"></i><span>CMS / Content</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('admin/cms/banners') }}" class="nav-link sub-link"><span>Banners</span></a></li>
          <li><a href="{{ url('admin/cms/announcements') }}" class="nav-link sub-link"><span>Announcements</span></a></li>
          <li><a href="{{ url('admin/cms/pages') }}" class="nav-link sub-link"><span>Pages</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-gear"></i><span>System Settings</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('admin/settings/general') }}" class="nav-link sub-link"><span>General Settings</span></a></li>
          <li><a href="{{ url('admin/settings/plan') }}" class="nav-link sub-link"><span>MLM Plan Settings</span></a></li>
          <li><a href="{{ url('admin/settings/token') }}" class="nav-link sub-link"><span>Token Settings</span></a></li>
          <li><a href="{{ url('admin/settings/payment') }}" class="nav-link sub-link"><span>Payment Settings</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-user-shield"></i><span>Role & Permission</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('admin/roles') }}" class="nav-link sub-link"><span>Roles</span></a></li>
          <li><a href="{{ url('admin/permissions') }}" class="nav-link sub-link"><span>Permissions</span></a></li>
          <li><a href="{{ url('admin/permissions/assign') }}" class="nav-link sub-link"><span>Assign Permissions</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-server"></i><span>Logs & Monitoring</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('admin/logs/system') }}" class="nav-link sub-link"><span>System Logs</span></a></li>
          <li><a href="{{ url('admin/logs/activity') }}" class="nav-link sub-link"><span>Activity Logs</span></a></li>
          <li><a href="{{ url('admin/logs/error') }}" class="nav-link sub-link"><span>Error Logs</span></a></li>
        </ul>
      </li>

      <li><a href="{{ route('logout') }}" class="nav-link"><i class="fa-solid fa-right-from-bracket"></i><span>Logout</span></a></li>
    </ul>
  </aside>
  <div class="app-sidebar-backdrop" id="appSidebarBackdrop"></div>

  <!-- ===== Main column ===== -->
  <div class="app-main">
    <!-- ===== Topbar ===== -->
    <nav class="app-topbar d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center gap-2">
        <button class="btn btn-sm btn-outline-secondary d-lg-none" id="sidebarMobileBtn" aria-label="Open sidebar">
          <i class="fa-solid fa-bars"></i>
        </button>
        <h6 class="mb-0 fw-heading d-none d-md-block">Dashboard</h6>
      </div>

      <div class="d-flex align-items-center gap-2">
        <!-- Notifications dropdown -->
        <!-- <div class="dropdown">
          <button class="btn btn-sm btn-outline-secondary position-relative" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-bell"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:0.6rem;">3</span>
          </button>
          <div class="dropdown-menu dropdown-menu-end p-0" style="min-width:320px;">
            <h6 class="dropdown-header">Notifications</h6>
            <a class="dropdown-item d-flex gap-2 py-2" href="#">
              <span class="xvt-avatar" style="background:#10b981;"><i class="fa-solid fa-arrow-down"></i></span>
              <span class="small"><strong>$5,200</strong> deposit received<br><span class="text-muted">2 minutes ago</span></span>
            </a>
            <a class="dropdown-item d-flex gap-2 py-2" href="#">
              <span class="xvt-avatar"><i class="fa-solid fa-user-plus"></i></span>
              <span class="small"><strong>John D.</strong> registered<br><span class="text-muted">15 minutes ago</span></span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-center small" href="#">View all</a>
          </div>
        </div> -->

        <!-- Theme customizer trigger -->
        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="offcanvas" data-bs-target="#themeCustomizer" aria-label="Theme settings">
          <i class="fa-solid fa-palette"></i>
        </button>

        <!-- Admin profile dropdown -->
        <div class="dropdown">
          <button class="btn btn-sm btn-outline-secondary d-flex align-items-center gap-2" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="xvt-avatar" style="width:28px; height:28px; font-size:0.75rem;">AD</span>
            <span class="d-none d-md-inline">{{ auth()->user()->name ?? 'Admin' }}</span>
            <i class="fa-solid fa-chevron-down small"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><h6 class="dropdown-header">{{ auth()->user()->name ?? 'Admin' }}<br><small class="text-muted">{{ auth()->user()->email ?? '' }}</small></h6></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ url('admin/settings') }}"><i class="fa-solid fa-gear me-2"></i>Settings</a></li>
            <li><a class="dropdown-item" href="{{ route('logout') }}"><i class="fa-solid fa-right-from-bracket me-2"></i>Log Out</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- ===== Theme Customizer Offcanvas ===== -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="themeCustomizer">
      <div class="offcanvas-header border-bottom border-themed">
        <h5 class="offcanvas-title"><i class="fa-solid fa-palette me-2"></i>Theme Customizer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
      </div>
      <div class="offcanvas-body">
        <p class="text-muted small">Changes apply site-wide and are saved to the database.</p>
        <form id="themeForm">
          <div class="mb-3">
            <label class="form-label">Primary color</label>
            <input type="color" name="theme_primary" class="form-control form-control-color w-100" value="#f24a4a">
          </div>
          <div class="mb-3">
            <label class="form-label">Accent color</label>
            <input type="color" name="theme_accent" class="form-control form-control-color w-100" value="#8c54c4">
          </div>
          <div class="mb-3">
            <label class="form-label">Mode</label>
            <select name="theme_mode" class="form-select">
              <option value="dark" selected="">Dark</option>
              <option value="light">Light</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Corner radius</label>
            <select name="theme_radius" class="form-select">
              <option value="4px">Small (4px)</option>
              <option value="8px" selected="">Medium (8px)</option>
              <option value="12px">Large (12px)</option>
              <option value="16px">Extra Large (16px)</option>
            </select>
          </div>
          <details class="mb-3">
            <summary class="small text-muted mb-2">Advanced colors</summary>
            <div class="mb-2"><label class="form-label small">Body background</label>
              <input type="color" name="theme_body_bg" class="form-control form-control-color w-100" value="#0b1220"></div>
            <div class="mb-2"><label class="form-label small">Card background</label>
              <input type="color" name="theme_card_bg" class="form-control form-control-color w-100" value="#1a222d"></div>
            <div class="mb-2"><label class="form-label small">Sidebar background</label>
              <input type="color" name="theme_sidebar_bg" class="form-control form-control-color w-100" value="#14172a"></div>
            <div class="mb-2"><label class="form-label small">Topbar background</label>
              <input type="color" name="theme_topbar_bg" class="form-control form-control-color w-100" value="#161f2d"></div>
          </details>
          <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-check me-1"></i> Save &amp; Reload</button>
        </form>
        <div id="themeMsg" class="small mt-3"></div>
      </div>
    </div>

    <!-- ===== Start page content ===== -->
    <main class="app-content">
  @yield('content')
</main>
  </div><!-- /.app-main -->
</div><!-- /.app-shell -->

<!-- Bootstrap bundle -->
<script src="{{ asset('assets/Admin Dashboard â€” XVolty Trade_files/bootstrap.bundle.min.js.download') }}"></script>

<!-- App-wide dashboard JS: sidebar toggle + submenu + theme form -->
<script>
(function(){
  // Mobile sidebar toggle
  const sidebar  = document.getElementById('appSidebar');
  const backdrop = document.getElementById('appSidebarBackdrop');
  const mobileBtn = document.getElementById('sidebarMobileBtn');
  const openSidebar  = () => { sidebar.classList.add('show'); backdrop.classList.add('show'); };
  const closeSidebar = () => { sidebar.classList.remove('show'); backdrop.classList.remove('show'); };
  if (mobileBtn)   mobileBtn.addEventListener('click', openSidebar);
  if (backdrop)    backdrop.addEventListener('click', closeSidebar);

  // Sidebar collapsible submenu
  document.querySelectorAll('.app-sidebar .nav-dropdown-toggle').forEach(a => {
    a.addEventListener('click', (e) => {
      e.preventDefault();
      a.closest('.has-submenu').classList.toggle('open');
    });
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

  // Theme customizer AJAX save
  const themeForm = document.getElementById('themeForm');
  if (themeForm) {
    themeForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const msg = document.getElementById('themeMsg');
      msg.textContent = 'Saving...';
      try {
        const fd = new FormData(themeForm);
        const res = await fetch('../app/Controllers/api/save_theme.php', { method: 'POST', body: fd });
        const data = await res.json();
        if (data.status === 'success') {
          msg.innerHTML = '<span class="text-success"><i class="fa-solid fa-check"></i> Saved. Reloading...</span>';
          setTimeout(() => location.reload(), 500);
        } else {
          msg.innerHTML = '<span class="text-danger">' + (data.message || 'Error saving theme') + '</span>';
        }
      } catch (err) {
        msg.innerHTML = '<span class="text-danger">Network error: ' + err.message + '</span>';
      }
    });
  }
})();
</script>

<!-- Auto-cron beacon (runs due tasks silently in background) -->
<script>
(function(){
  setTimeout(function(){
    fetch('../cron/auto_runner.php', {credentials:'same-origin'}).catch(function(){});
  }, 3000);
})();
</script>



</body></html>



