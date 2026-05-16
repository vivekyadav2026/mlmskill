<!DOCTYPE html>
<!-- saved from url=(0043)../admin/index.html -->
@php $tm = \App\Models\Setting::get('theme_mode', 'dark'); @endphp
<html lang="en" data-bs-theme="{{ $tm }}"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard â€” XVolty Trade</title>
  
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
  [data-bs-theme="light"] .tailwind-scope .border-\[\#334155\] { border-color: #e2e8f0 !important; }
  [data-bs-theme="light"] .tailwind-scope .text-gray-100,
  [data-bs-theme="light"] .tailwind-scope .text-gray-200,
  [data-bs-theme="light"] .tailwind-scope .text-gray-300 { color: #0f172a !important; }
  [data-bs-theme="light"] .tailwind-scope .text-gray-400,
  [data-bs-theme="light"] .tailwind-scope .text-gray-500 { color: #64748b !important; }

  </style>

  <!-- Theme component CSS -->
  <link rel="stylesheet" href="{{ asset('assets/dist/theme.css') }}">
</head>
<body>
  @include('components.preloader')
  <!-- ===== App Shell starts here ===== -->
<div class="app-shell">

  <!-- ===== Admin Sidebar ===== -->
  <aside id="appSidebar" class="app-sidebar">
        <a href="{{ url('admin/dashboard') }}" class="sidebar-brand d-flex align-items-center gap-2">
              <img src="{{ asset('logo.png') }}" alt="Logo" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
        <span> Samarth Digital</span>
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
          <!-- <li><a href="{{ url('admin/activations/requests') }}" class="nav-link sub-link"><span>Activation Requests</span></a></li> -->
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
          <li><a href="{{ url('admin/settings/token') }}" class="nav-link sub-link"><span>Token Settings</span></a></li>
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
          <li><a href="{{ url('admin/commissions/direct') }}" class="nav-link sub-link"><span>Direct Commission</span></a></li>
          <li><a href="{{ url('admin/commissions/level') }}" class="nav-link sub-link"><span>Level Commission</span></a></li>
          <li><a href="{{ url('admin/settings/plan') }}" class="nav-link sub-link"><span>Commission Settings</span></a></li>
        </ul>
      </li>

      <li class="nav-section">Value Added Services</li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-briefcase"></i><span>Job & Placements</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ route('admin.jobs.index') }}" class="nav-link sub-link"><span>Postings</span></a></li>
          <li><a href="{{ route('admin.jobs.applications') }}" class="nav-link sub-link"><span>Applications</span></a></li>
          <li><a href="{{ route('admin.jobs.create') }}" class="nav-link sub-link"><span>Create New</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-hand-holding-dollar"></i><span>Loan Facility</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ route('admin.loans.requests') }}" class="nav-link sub-link"><span>Loan Requests</span></a></li>
          <li><a href="{{ route('admin.loans.schemes') }}" class="nav-link sub-link"><span>Loan Schemes</span></a></li>
        </ul>
      </li>

      <li class="has-submenu">
        <a href="#" class="nav-link nav-dropdown-toggle">
          <i class="fa-solid fa-graduation-cap"></i><span>Course Management</span>
          <i class="fa-solid fa-chevron-down nav-arrow"></i>
        </a>
        <ul class="nav-submenu list-unstyled mb-0">
          <li><a href="{{ url('admin/courses/modules') }}" class="nav-link sub-link"><span>Course Modules</span></a></li>
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

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.support.*') ? 'active' : '' }}" href="{{ route('admin.support.index') }}">
          <i class="fa-solid fa-headset"></i><span>Support Center</span>
          @php
            $unreadSupport = \App\Models\SupportChat::where('sender', 'user')->where('is_read', false)->count();
          @endphp
          <span id="adminSupportBadge" class="badge bg-danger rounded-pill float-end mt-1 {{ $unreadSupport > 0 ? '' : 'd-none' }}">{{ $unreadSupport }}</span>
        </a>
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

      {{-- ROLES & PERMISSIONS MODULE DISABLED --
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
      --}}

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
        <!-- Messages Link -->
        <a href="{{ route('admin.support.index') }}" class="btn btn-sm btn-outline-secondary position-relative me-2" title="Support Messages">
          <i class="fa-solid fa-envelope"></i>
          @php
            $unreadSupport = \App\Models\SupportChat::where('sender', 'user')->where('is_read', false)->count();
          @endphp
          <span id="adminTopMessageBadge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger {{ $unreadSupport > 0 ? '' : 'd-none' }}" style="font-size:0.6rem;">
              {{ $unreadSupport }}
          </span>
        </a>

        <!-- Notifications dropdown -->
        <div class="dropdown">
          <button class="btn btn-sm btn-outline-secondary position-relative" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-bell"></i>
            @if(auth()->check() && auth()->user()->unreadNotifications->count() > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:0.6rem;">
                    {{ auth()->user()->unreadNotifications->count() }}
                </span>
            @endif
          </button>
          <div class="dropdown-menu dropdown-menu-end p-0 shadow-lg" style="min-width:320px; background: var(--xvt-card-bg); border-color: var(--xvt-border);">
            <div class="dropdown-header d-flex justify-content-between align-items-center border-bottom border-secondary">
                <h6 class="mb-0 text-white">Notifications</h6>
                @if(auth()->check() && auth()->user()->unreadNotifications->count() > 0)
                    <a href="{{ url('admin/notifications/mark-all-read') }}" class="text-xs text-indigo-400 hover:text-indigo-300">Mark all read</a>
                @endif
            </div>
            
            <div style="max-height: 300px; overflow-y: auto;">
                @if(auth()->check())
                    @forelse(auth()->user()->notifications()->take(5)->get() as $notification)
                        <a class="dropdown-item d-flex gap-3 py-3 border-bottom border-secondary {{ $notification->read_at ? 'opacity-75' : 'bg-secondary bg-opacity-10' }}" href="{{ $notification->data['url'] ?? '#' }}">
                            <div class="xvt-avatar flex-shrink-0" style="background:var(--xvt-primary); color: white;"><i class="fa-solid fa-user-plus"></i></div>
                            <div>
                                <span class="small text-white d-block"><strong>{{ $notification->data['user_name'] ?? 'New User' }}</strong> registered</span>
                                <span class="text-muted" style="font-size: 0.75rem;">{{ $notification->created_at->diffForHumans() }}</span>
                            </div>
                        </a>
                    @empty
                        <div class="p-4 text-center text-muted small">No new notifications.</div>
                    @endforelse
                @endif
            </div>
          </div>
        </div>

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
        <p class="text-muted small">Drag a color to preview live. Click Save to persist site-wide.</p>
        <form id="themeForm">

          <!-- Theme Mode Toggle -->
          <div class="mb-3">
            <label class="form-label">Theme Mode</label>
            <div class="d-flex gap-2">
              @php $tm = \App\Models\Setting::get('theme_mode', 'dark'); @endphp
              <button type="button" id="btn_dark" onclick="switchMode('dark')"
                class="btn btn-sm {{ $tm === 'dark' ? 'btn-primary' : 'btn-outline-secondary' }} flex-fill">
                <i class="fa-solid fa-moon me-1"></i> Dark
              </button>
              <button type="button" id="btn_light" onclick="switchMode('light')"
                class="btn btn-sm {{ $tm !== 'dark' ? 'btn-primary' : 'btn-outline-secondary' }} flex-fill">
                <i class="fa-solid fa-sun me-1"></i> Light
              </button>
            </div>
            <input type="hidden" name="theme_mode" id="theme_mode" value="{{ $tm }}">
          </div>

          <div class="mb-3">
            <label class="form-label">Primary color</label>
            <input type="color" name="theme_primary" id="theme_primary" class="form-control form-control-color w-100" value="{{ $tp }}">
          </div>
          <div class="mb-3">
            <label class="form-label">Accent color</label>
            <input type="color" name="theme_accent" id="theme_accent" class="form-control form-control-color w-100" value="{{ $ta }}">
          </div>
          <div class="mb-3">
            <label class="form-label">Corner radius</label>
            <select name="theme_radius" class="form-select">
              <option value="4px"  {{ $tr === '4px'  ? 'selected' : '' }}>Small (4px)</option>
              <option value="8px"  {{ $tr === '8px'  ? 'selected' : '' }}>Medium (8px)</option>
              <option value="12px" {{ $tr === '12px' ? 'selected' : '' }}>Large (12px)</option>
              <option value="16px" {{ $tr === '16px' ? 'selected' : '' }}>Extra Large (16px)</option>
            </select>
          </div>
          <details class="mb-3">
            <summary class="small text-muted mb-2">Advanced colors</summary>
            <div class="mb-2"><label class="form-label small">Body background</label>
              <input type="color" name="theme_body_bg" class="form-control form-control-color w-100" value="{{ $tbb }}"></div>
            <div class="mb-2"><label class="form-label small">Card background</label>
              <input type="color" name="theme_card_bg" class="form-control form-control-color w-100" value="{{ $tcb }}"></div>
            <div class="mb-2"><label class="form-label small">Sidebar background</label>
              <input type="color" name="theme_sidebar_bg" class="form-control form-control-color w-100" value="{{ $tsb }}"></div>
            <div class="mb-2"><label class="form-label small">Topbar background</label>
              <input type="color" name="theme_topbar_bg" class="form-control form-control-color w-100" value="{{ $ttb }}"></div>
            <div class="mb-2"><label class="form-label small">Text Color</label>
              <input type="color" name="theme_text" class="form-control form-control-color w-100" value="{{ $txt }}"></div>
          </details>
          <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-floppy-disk me-1"></i> Save Theme</button>
          <button type="button" class="btn btn-outline-secondary w-100 mt-2" onclick="resetTheme()"><i class="fa-solid fa-rotate-left me-1"></i> Reset to Default</button>
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
<script src="{{ asset('assets/dist/bootstrap.bundle.min.js') }}"></script>

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

  // ═══════════════════════════════════════════════════
  // THEME CUSTOMIZER — Complete Working Implementation
  // ═══════════════════════════════════════════════════

  const DARK_DEFAULTS = {
    theme_primary:    '#1f512c',
    theme_accent:     '#f48a20',
    theme_radius:     '8px',
    theme_body_bg:    '#0d1510',
    theme_card_bg:    '#16231a',
    theme_sidebar_bg: '#111c15',
    theme_topbar_bg:  '#132018',
    theme_text:       '#e2e8f0',
    theme_mode:       'dark',
  };

  const LIGHT_DEFAULTS = {
    theme_primary:    '#1f512c',
    theme_accent:     '#f48a20',
    theme_radius:     '8px',
    theme_body_bg:    '#f4fcf6',
    theme_card_bg:    '#ffffff',
    theme_sidebar_bg: '#1f512c',
    theme_topbar_bg:  '#ffffff',
    theme_text:       '#0f172a',
    theme_mode:       'light',
  };

  // Apply a CSS variable to :root
  function applyVar(prop, val) {
    document.documentElement.style.setProperty(prop, val);
  }

  // Apply full set of CSS vars + update pickers
  function applyTheme(values, isLight) {
    applyVar('--xvt-primary',    values.theme_primary);
    applyVar('--xvt-accent',     values.theme_accent);
    applyVar('--xvt-radius',     values.theme_radius);
    applyVar('--xvt-body-bg',    values.theme_body_bg);
    applyVar('--xvt-card-bg',    values.theme_card_bg);
    applyVar('--xvt-sidebar-bg', values.theme_sidebar_bg);
    applyVar('--xvt-topbar-bg',  values.theme_topbar_bg);
    applyVar('--xvt-text',       values.theme_text);
    if (isLight) {
      applyVar('--xvt-muted',   '#64748b');
      applyVar('--xvt-border',  '#e2e8f0');
      applyVar('--bs-body-bg',     '#f1f5f9');
      applyVar('--bs-body-color',  values.theme_text || '#0f172a');
    } else {
      applyVar('--xvt-muted',   '#94a3b8');
      applyVar('--xvt-border',  '#334155');
      applyVar('--bs-body-bg',     values.theme_body_bg);
      applyVar('--bs-body-color',  values.theme_text || '#e2e8f0');
    }
    // Update color pickers to match
    const setPicker = (name, val) => {
      const el = name === 'theme_primary' ? document.getElementById('theme_primary')
               : name === 'theme_accent'  ? document.getElementById('theme_accent')
               : document.querySelector(`[name="${name}"]`);
      if (el && val) el.value = val;
    };
    setPicker('theme_primary',    values.theme_primary);
    setPicker('theme_accent',     values.theme_accent);
    setPicker('theme_body_bg',    values.theme_body_bg);
    setPicker('theme_card_bg',    values.theme_card_bg);
    setPicker('theme_sidebar_bg', values.theme_sidebar_bg);
    setPicker('theme_topbar_bg',  values.theme_topbar_bg);
    setPicker('theme_text',       values.theme_text);
    // Update radius select
    const radEl = document.querySelector('[name="theme_radius"]');
    if (radEl) radEl.value = values.theme_radius;
  }

  // Switch dark / light mode
  function switchMode(mode) {
    document.documentElement.setAttribute('data-bs-theme', mode);
    const modeInput = document.getElementById('theme_mode');
    if (modeInput) modeInput.value = mode;

    const isLight = (mode === 'light');
    // Apply colour vars immediately
    if (isLight) {
      applyTheme(LIGHT_DEFAULTS, true);
    } else {
      // Restore current picker values for dark
      const current = {
        theme_primary:    document.getElementById('theme_primary')?.value    || DARK_DEFAULTS.theme_primary,
        theme_accent:     document.getElementById('theme_accent')?.value     || DARK_DEFAULTS.theme_accent,
        theme_radius:     document.querySelector('[name="theme_radius"]')?.value || DARK_DEFAULTS.theme_radius,
        theme_body_bg:    document.querySelector('[name="theme_body_bg"]')?.value    || DARK_DEFAULTS.theme_body_bg,
        theme_card_bg:    document.querySelector('[name="theme_card_bg"]')?.value    || DARK_DEFAULTS.theme_card_bg,
        theme_sidebar_bg: document.querySelector('[name="theme_sidebar_bg"]')?.value || DARK_DEFAULTS.theme_sidebar_bg,
        theme_topbar_bg:  document.querySelector('[name="theme_topbar_bg"]')?.value  || DARK_DEFAULTS.theme_topbar_bg,
        theme_text:       document.querySelector('[name="theme_text"]')?.value       || DARK_DEFAULTS.theme_text,
      };
      applyTheme(current, false);
    }
    // Update toggle buttons appearance
    document.getElementById('btn_dark').className  = isLight ? 'btn btn-sm btn-outline-secondary flex-fill' : 'btn btn-sm btn-primary flex-fill';
    document.getElementById('btn_light').className = isLight ? 'btn btn-sm btn-primary flex-fill'            : 'btn btn-sm btn-outline-secondary flex-fill';
  }

  // Reset to defaults — saves to DB automatically
  function resetTheme() {
    const mode    = document.getElementById('theme_mode')?.value || 'dark';
    const isLight = (mode === 'light');
    const defs    = isLight ? LIGHT_DEFAULTS : DARK_DEFAULTS;
    document.documentElement.setAttribute('data-bs-theme', defs.theme_mode);
    applyTheme(defs, isLight);

    // Auto-save the reset to DB
    const fd = new FormData();
    fd.append('_token', '{{ csrf_token() }}');
    Object.entries(defs).forEach(([k, v]) => fd.append(k, v));
    fetch('{{ url("admin/settings/theme") }}', {
      method: 'POST',
      headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      body: fd
    }).then(r => r.json()).then(data => {
      const msg = document.getElementById('themeMsg');
      if (msg) {
        msg.innerHTML = '<span class="text-success"><i class="fa-solid fa-check"></i> Reset to defaults!</span>';
        setTimeout(() => msg.textContent = '', 3000);
      }
    }).catch(() => {});
  }

  // Expose to global scope so onclick= attributes can reach them
  window.switchMode  = switchMode;
  window.resetTheme  = resetTheme;

  // ── Wire up live preview listeners ──
  const themeForm = document.getElementById('themeForm');
  if (themeForm) {
    const liveBindings = [
      { id: 'theme_primary',       prop: '--xvt-primary' },
      { id: 'theme_accent',        prop: '--xvt-accent' },
      { name: 'theme_body_bg',     prop: '--xvt-body-bg' },
      { name: 'theme_card_bg',     prop: '--xvt-card-bg' },
      { name: 'theme_sidebar_bg',  prop: '--xvt-sidebar-bg' },
      { name: 'theme_topbar_bg',   prop: '--xvt-topbar-bg' },
      { name: 'theme_radius',      prop: '--xvt-radius' },
      { name: 'theme_text',        prop: '--xvt-text' },
    ];
    liveBindings.forEach(b => {
      const el = b.id
        ? document.getElementById(b.id)
        : document.querySelector(`[name="${b.name}"]`);
      if (el) el.addEventListener('input', e => applyVar(b.prop, e.target.value));
    });

    // Save to Laravel on submit
    themeForm.addEventListener('submit', async (e) => {
      e.preventDefault();
      const msg = document.getElementById('themeMsg');
      const btn = themeForm.querySelector('[type="submit"]');
      msg.innerHTML = '<span class="text-muted"><i class="fa-solid fa-spinner fa-spin"></i> Saving...</span>';
      btn.disabled = true;
      const fd = new FormData(themeForm);
      fd.append('_token', '{{ csrf_token() }}');
      try {
        const res  = await fetch('{{ url("admin/settings/theme") }}', {
          method:  'POST',
          headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          body:    fd
        });
        const data = await res.json();
        msg.innerHTML = data.status === 'success'
          ? '<span class="text-success"><i class="fa-solid fa-check"></i> Theme saved!</span>'
          : '<span class="text-danger">' + (data.message || 'Error') + '</span>';
      } catch (err) {
        msg.innerHTML = '<span class="text-danger">Network error: ' + err.message + '</span>';
      }
      btn.disabled = false;
      setTimeout(() => msg.textContent = '', 4000);
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

<script>
  // Admin Support Unread Polling
  setInterval(() => {
    fetch('/admin/support/unread')
      .then(res => res.json())
      .then(data => {
        const badge1 = document.getElementById('adminSupportBadge');
        const badge2 = document.getElementById('adminTopMessageBadge');
        if (data.unread > 0) {
          if (badge1) { badge1.innerText = data.unread; badge1.classList.remove('d-none'); }
          if (badge2) { badge2.innerText = data.unread; badge2.classList.remove('d-none'); }
        } else {
          if (badge1) { badge1.classList.add('d-none'); }
          if (badge2) { badge2.classList.add('d-none'); }
        }
      })
      .catch(err => console.error(err));
  }, 5000);
</script>

</body></html>
