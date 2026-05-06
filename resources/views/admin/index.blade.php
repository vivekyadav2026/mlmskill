@extends('layouts.admin')
@section('title', 'Admin Dashboard â€” XVolty Trade')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
  <div>
    <h3 class="fw-heading mb-1">Platform Overview</h3>
    <p class="text-muted mb-0 small">Welcome back, admin. Live operational intelligence.</p>
  </div>
  <div class="btn-group btn-group-sm" role="group" aria-label="Time filter">
          <a href="../admin/index.html?days=1" class="btn btn-outline-secondary">Today</a>
          <a href="../admin/index.html?days=7" class="btn btn-outline-secondary">7D</a>
          <a href="../admin/index.html?days=30" class="btn btn-primary">30D</a>
          <a href="../admin/index.html?days=90" class="btn btn-outline-secondary">90D</a>
          <a href="../admin/index.html?days=365" class="btn btn-outline-secondary">1Y</a>
      </div>
</div>

<!-- â”€â”€â”€ Operational Alerts â”€â”€â”€ -->

<!-- â”€â”€â”€ KPI Cards (Top Row) â”€â”€â”€ -->
<div class="row g-3 mb-4">
      <div class="col-6 col-lg-3">
      <a href="{{ url('admin/users') }}" class="text-decoration-none">
        <div class="card h-100 border-themed kpi-card">
          <div class="card-body">
            <div class="d-flex align-items-center gap-3">
              <span class="xvt-avatar lg" style="background:#087E8B22;color:#087E8B;"><i class="fa-solid fa-users"></i></span>
              <div class="flex-grow-1">
                <div class="text-muted small">Total Users</div>
                <h4 class="mb-0 fw-bold">16</h4>
                <div class="small text-success mt-1">+0 today</div>              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
      <div class="col-6 col-lg-3">
      <a href="../admin/users.html?status=active" class="text-decoration-none">
        <div class="card h-100 border-themed kpi-card">
          <div class="card-body">
            <div class="d-flex align-items-center gap-3">
              <span class="xvt-avatar lg" style="background:#10b98122;color:#10b981;"><i class="fa-solid fa-user-check"></i></span>
              <div class="flex-grow-1">
                <div class="text-muted small">Active Users</div>
                <h4 class="mb-0 fw-bold">6</h4>
                              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
      <div class="col-6 col-lg-3">
      <a href="../admin/users.html?status=inactive" class="text-decoration-none">
        <div class="card h-100 border-themed kpi-card">
          <div class="card-body">
            <div class="d-flex align-items-center gap-3">
              <span class="xvt-avatar lg" style="background:#f59e0b22;color:#f59e0b;"><i class="fa-solid fa-user-clock"></i></span>
              <div class="flex-grow-1">
                <div class="text-muted small">Inactive Users</div>
                <h4 class="mb-0 fw-bold">10</h4>
                              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
      <div class="col-6 col-lg-3">
      <a href="{{ url('admin/investments') }}" class="text-decoration-none">
        <div class="card h-100 border-themed kpi-card">
          <div class="card-body">
            <div class="d-flex align-items-center gap-3">
              <span class="xvt-avatar lg" style="background:#06BEE122;color:#06BEE1;"><i class="fa-solid fa-cubes-stacked"></i></span>
              <div class="flex-grow-1">
                <div class="text-muted small">Active Packages</div>
                <h4 class="mb-0 fw-bold">7</h4>
                              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>

<!-- â”€â”€â”€ Financial KPIs â”€â”€â”€ -->
<div class="row g-3 mb-4">
      <div class="col-6 col-lg-3">
      <a href="{{ url('admin/deposits') }}" class="text-decoration-none">
        <div class="card h-100 border-themed kpi-card">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
              <div>
                <div class="text-muted small">Total Deposits</div>
                <h4 class="mb-1 fw-bold">$217,103.00</h4>
                <div class="small text-muted">$0.00 today</div>              </div>
              <span class="xvt-avatar" style="background:#10b98122;color:#10b981;"><i class="fa-solid fa-arrow-down"></i></span>
            </div>
          </div>
        </div>
      </a>
    </div>
      <div class="col-6 col-lg-3">
      <a href="{{ url('admin/withdrawals') }}" class="text-decoration-none">
        <div class="card h-100 border-themed kpi-card">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
              <div>
                <div class="text-muted small">Total Withdrawals</div>
                <h4 class="mb-1 fw-bold">$66.50</h4>
                <div class="small text-muted">$0.00 today</div>              </div>
              <span class="xvt-avatar" style="background:#f59e0b22;color:#f59e0b;"><i class="fa-solid fa-arrow-up"></i></span>
            </div>
          </div>
        </div>
      </a>
    </div>
      <div class="col-6 col-lg-3">
      <a href="{{ url('admin/investments') }}" class="text-decoration-none">
        <div class="card h-100 border-themed kpi-card">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
              <div>
                <div class="text-muted small">Total Invested</div>
                <h4 class="mb-1 fw-bold">$5,684.00</h4>
                              </div>
              <span class="xvt-avatar" style="background:#8b5cf622;color:#8b5cf6;"><i class="fa-solid fa-sack-dollar"></i></span>
            </div>
          </div>
        </div>
      </a>
    </div>
      <div class="col-6 col-lg-3">
      <a href="../admin/withdrawals.html?status=pending" class="text-decoration-none">
        <div class="card h-100 border-themed kpi-card">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
              <div>
                <div class="text-muted small">Pending Withdrawals</div>
                <h4 class="mb-1 fw-bold">$0.00</h4>
                <div class="small text-muted">0 requests</div>              </div>
              <span class="xvt-avatar" style="background:#ef444422;color:#ef4444;"><i class="fa-solid fa-clock"></i></span>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>

<!-- â”€â”€â”€ Income Payout KPIs â”€â”€â”€ -->
<div class="row g-3 mb-4">
      <div class="col-6 col-md-4 col-lg-2">
      <div class="card border-themed h-100 text-center"><div class="card-body py-3">
        <i class="fa-solid fa-chart-line fa-lg text-success mb-2"></i>
        <div class="text-muted small">Total ROI Paid</div>
        <h6 class="fw-bold mb-0">$169.26</h6>
      </div></div>
    </div>
      <div class="col-6 col-md-4 col-lg-2">
      <div class="card border-themed h-100 text-center"><div class="card-body py-3">
        <i class="fa-solid fa-handshake fa-lg text-primary mb-2"></i>
        <div class="text-muted small">Direct Income Paid</div>
        <h6 class="fw-bold mb-0">$5.00</h6>
      </div></div>
    </div>
      <div class="col-6 col-md-4 col-lg-2">
      <div class="card border-themed h-100 text-center"><div class="card-body py-3">
        <i class="fa-solid fa-layer-group fa-lg text-info mb-2"></i>
        <div class="text-muted small">Level Income Paid</div>
        <h6 class="fw-bold mb-0">$44.50</h6>
      </div></div>
    </div>
      <div class="col-6 col-md-4 col-lg-2">
      <div class="card border-themed h-100 text-center"><div class="card-body py-3">
        <i class="fa-solid fa-money-bill fa-lg text-warning mb-2"></i>
        <div class="text-muted small">Weekly Salary Paid</div>
        <h6 class="fw-bold mb-0">$0.00</h6>
      </div></div>
    </div>
      <div class="col-6 col-md-4 col-lg-2">
      <div class="card border-themed h-100 text-center"><div class="card-body py-3">
        <i class="fa-solid fa-trophy fa-lg text-danger mb-2"></i>
        <div class="text-muted small">Rank Rewards Paid</div>
        <h6 class="fw-bold mb-0">$0.00</h6>
      </div></div>
    </div>
      <div class="col-6 col-md-4 col-lg-2">
      <div class="card border-themed h-100 text-center"><div class="card-body py-3">
        <i class="fa-solid fa-shield fa-lg text-secondary mb-2"></i>
        <div class="text-muted small">Outstanding Liabilities</div>
        <h6 class="fw-bold mb-0">$11,149.24</h6>
      </div></div>
    </div>
  </div>

<!-- ─── Wallet Management Quick Stats ─── -->
<div class="row g-3 mb-4">
  <div class="col-6 col-lg-3">
    <a href="{{ url('admin/deposit-wallets') }}" class="text-decoration-none">
      <div class="card border-themed h-100 kpi-card"><div class="card-body">
        <div class="d-flex align-items-center gap-3">
          <span class="xvt-avatar lg" style="background:#06BEE122;color:#06BEE1;"><i class="fa-solid fa-building-columns"></i></span>
          <div><div class="text-muted small">Active Deposit Wallets</div><h4 class="mb-0 fw-bold">1</h4></div>
        </div>
      </div></div>
    </a>
  </div>
  <div class="col-6 col-lg-3">
    <a href="../admin/deposit-requests.html?status=pending" class="text-decoration-none">
      <div class="card border-themed h-100 kpi-card"><div class="card-body">
        <div class="d-flex align-items-center gap-3">
          <span class="xvt-avatar lg" style="background:#f59e0b22;color:#f59e0b;"><i class="fa-solid fa-file-invoice-dollar"></i></span>
          <div><div class="text-muted small">Pending Deposit Requests</div><h4 class="mb-0 fw-bold">0</h4></div>
        </div>
      </div></div>
    </a>
  </div>
  <div class="col-6 col-lg-3">
    <a href="../admin/deposit-requests.html?status=approved" class="text-decoration-none">
      <div class="card border-themed h-100 kpi-card"><div class="card-body">
        <div class="d-flex align-items-center gap-3">
          <span class="xvt-avatar lg" style="background:#10b98122;color:#10b981;"><i class="fa-solid fa-circle-check"></i></span>
          <div><div class="text-muted small">Approved Deposits</div><h4 class="mb-0 fw-bold">21</h4></div>
        </div>
      </div></div>
    </a>
  </div>
  <div class="col-6 col-lg-3">
    <a href="{{ url('admin/payout-directory') }}" class="text-decoration-none">
      <div class="card border-themed h-100 kpi-card"><div class="card-body">
        <div class="d-flex align-items-center gap-3">
          <span class="xvt-avatar lg" style="background:#8b5cf622;color:#8b5cf6;"><i class="fa-solid fa-address-book"></i></span>
          <div><div class="text-muted small">Payout Wallets</div><h4 class="mb-0 fw-bold">6 rejected</h4></div>
        </div>
      </div></div>
    </a>
  </div>
</div>

<!-- ─── Charts: Growth & Income Distribution ─── -->
<div class="row g-3 mb-4">
  <div class="col-lg-8">
    <div class="card border-themed h-100">
      <div class="card-header bg-transparent border-themed d-flex align-items-center justify-content-between">
        <h6 class="mb-0"><i class="fa-solid fa-chart-line me-2"></i>User Growth (last 30 days)</h6>
        <span class="badge bg-secondary" id="growthBadge">16 new</span>
      </div>
      <div class="card-body"><div style="position:relative;height:300px;"><canvas id="userGrowthChart" width="895" height="450" style="display: block; box-sizing: border-box; height: 300px; width: 597px;"></canvas></div></div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card border-themed h-100">
      <div class="card-header bg-transparent border-themed"><h6 class="mb-0"><i class="fa-solid fa-chart-pie me-2"></i>Income Distribution</h6></div>
      <div class="card-body"><div style="position:relative;height:260px;"><canvas id="incomeDistChart" width="411" height="390" style="display: block; box-sizing: border-box; height: 260px; width: 274px;"></canvas></div></div>
    </div>
  </div>
</div>

<!-- â”€â”€â”€ Charts: Package Sales & Payout Trend â”€â”€â”€ -->
<div class="row g-3 mb-4">
  <div class="col-lg-6">
    <div class="card border-themed h-100">
      <div class="card-header bg-transparent border-themed"><h6 class="mb-0"><i class="fa-solid fa-box me-2"></i>Package Sales Volume</h6></div>
      <div class="card-body"><div style="position:relative;height:300px;"><canvas id="packageSalesChart" width="653" height="450" style="display: block; box-sizing: border-box; height: 300px; width: 435px;"></canvas></div></div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card border-themed h-100">
      <div class="card-header bg-transparent border-themed"><h6 class="mb-0"><i class="fa-solid fa-coins me-2"></i>Daily Payout Trend</h6></div>
      <div class="card-body"><div style="position:relative;height:300px;"><canvas id="payoutTrendChart" width="653" height="450" style="display: block; box-sizing: border-box; height: 300px; width: 435px;"></canvas></div></div>
    </div>
  </div>
</div>

<!-- â”€â”€â”€ Rank Distribution â”€â”€â”€ -->
<div class="card border-themed mb-4">
  <div class="card-header bg-transparent border-themed"><h6 class="mb-0"><i class="fa-solid fa-ranking-star me-2"></i>Users by Rank <small class="text-muted ms-2">click bar to filter</small></h6></div>
  <div class="card-body">
          <div style="position:relative;height:280px;"><canvas id="rankDistChart" width="1381" height="420" style="display: block; box-sizing: border-box; height: 280px; width: 920px;"></canvas></div>
      </div>
</div>

<!-- â”€â”€â”€ Recent Activity Feed â”€â”€â”€ -->
<div class="row g-3 mb-4">
  <div class="col-lg-6">
    <div class="card border-themed h-100">
      <div class="card-header bg-transparent border-themed d-flex align-items-center justify-content-between">
        <h6 class="mb-0"><i class="fa-solid fa-user-plus me-2"></i>Latest Registrations</h6>
        <a href="{{ url('admin/users') }}" class="small">View all</a>
      </div>
      <div class="table-responsive"><table class="table table-sm table-hover mb-0 align-middle">
        <thead class="small text-muted text-uppercase"><tr><th class="ps-3">User</th><th>Email</th><th class="pe-3">When</th></tr></thead>
        <tbody>
                  <tr>
            <td class="ps-3"><strong class="d-block small">werweqerweerweer</strong><span class="text-muted small">XV653796</span></td>
            <td class="small">cube-good-tinker@duck.com</td>
            <td class="pe-3 small text-muted">2026-04-22 10:48:33</td>
          </tr>
                  <tr>
            <td class="ps-3"><strong class="d-block small">werwersfsdfwer</strong><span class="text-muted small">XV406921</span></td>
            <td class="small">fruit-tint-marina@duck.com</td>
            <td class="pe-3 small text-muted">2026-04-22 10:44:16</td>
          </tr>
                  <tr>
            <td class="ps-3"><strong class="d-block small">qwewqrwerwtert</strong><span class="text-muted small">XV698744</span></td>
            <td class="small">wok-defame-gem@duck.com</td>
            <td class="pe-3 small text-muted">2026-04-22 10:43:36</td>
          </tr>
                  <tr>
            <td class="ps-3"><strong class="d-block small">werwerwrwerwsdfsdf</strong><span class="text-muted small">XV906404</span></td>
            <td class="small">path-pebbly-shaded@duck.com</td>
            <td class="pe-3 small text-muted">2026-04-22 10:42:56</td>
          </tr>
                  <tr>
            <td class="ps-3"><strong class="d-block small">ertertertert</strong><span class="text-muted small">XV939801</span></td>
            <td class="small">prude-jinx-giggle@duck.com</td>
            <td class="pe-3 small text-muted">2026-04-22 10:42:11</td>
          </tr>
                  <tr>
            <td class="ps-3"><strong class="d-block small">rtyryhfrhgbfgh</strong><span class="text-muted small">XV937656</span></td>
            <td class="small">unseen-control-duh@duck.com</td>
            <td class="pe-3 small text-muted">2026-04-22 10:41:17</td>
          </tr>
                </tbody>
      </table></div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card border-themed h-100">
      <div class="card-header bg-transparent border-themed d-flex align-items-center justify-content-between">
        <h6 class="mb-0"><i class="fa-solid fa-cubes-stacked me-2"></i>Latest Activations</h6>
        <a href="{{ url('admin/investments') }}" class="small">View all</a>
      </div>
      <div class="table-responsive"><table class="table table-sm table-hover mb-0 align-middle">
        <thead class="small text-muted text-uppercase"><tr><th class="ps-3">User</th><th>Package</th><th>Amount</th><th class="pe-3">When</th></tr></thead>
        <tbody>
                  <tr>
            <td class="ps-3 small">XVoltyTrade</td>
            <td class="small">Starter Pack</td>
            <td class="small">$21.00</td>
            <td class="pe-3 small text-muted">2026-05-01 10:38:14</td>
          </tr>
                  <tr>
            <td class="ps-3 small">TestUser1</td>
            <td class="small">Beginner Pack</td>
            <td class="small">$50.00</td>
            <td class="pe-3 small text-muted">2026-04-25 09:06:00</td>
          </tr>
                  <tr>
            <td class="ps-3 small">POONAM SINGH</td>
            <td class="small">Beginner Pack</td>
            <td class="small">$50.00</td>
            <td class="pe-3 small text-muted">2026-04-24 08:38:41</td>
          </tr>
                  <tr>
            <td class="ps-3 small">erwerweerwerwer</td>
            <td class="small">Starter Pack</td>
            <td class="small">$21.00</td>
            <td class="pe-3 small text-muted">2026-04-22 10:56:39</td>
          </tr>
                  <tr>
            <td class="ps-3 small">werweqerweerweer</td>
            <td class="small">Starter Pack</td>
            <td class="small">$21.00</td>
            <td class="pe-3 small text-muted">2026-04-22 10:55:46</td>
          </tr>
                  <tr>
            <td class="ps-3 small">fdgfdgfdgd</td>
            <td class="small">Diamond Investor</td>
            <td class="small">$5,000.00</td>
            <td class="pe-3 small text-muted">2026-04-22 10:20:12</td>
          </tr>
                </tbody>
      </table></div>
    </div>
  </div>
</div>

<div class="row g-3 mb-4">
  <div class="col-lg-6">
    <div class="card border-themed h-100">
      <div class="card-header bg-transparent border-themed d-flex align-items-center justify-content-between">
        <h6 class="mb-0"><i class="fa-solid fa-arrow-up me-2"></i>Latest Withdrawals</h6>
        <a href="{{ url('admin/withdrawals') }}" class="small">View all</a>
      </div>
      <div class="table-responsive"><table class="table table-sm table-hover mb-0 align-middle">
        <thead class="small text-muted text-uppercase"><tr><th class="ps-3">User</th><th>Amount</th><th>Net</th><th>Status</th><th class="pe-3">When</th></tr></thead>
        <tbody>
                  <tr>
            <td class="ps-3 small">XVoltyTrade</td>
            <td class="small">$29.00</td>
            <td class="small">$27.55</td>
            <td><span class="badge bg-success">Approved</span></td>
            <td class="pe-3 small text-muted">2026-04-21 05:31:23</td>
          </tr>
                  <tr>
            <td class="ps-3 small">XVoltyTrade</td>
            <td class="small">$29.00</td>
            <td class="small">$27.55</td>
            <td><span class="badge bg-danger">Rejected</span></td>
            <td class="pe-3 small text-muted">2026-04-21 05:28:05</td>
          </tr>
                  <tr>
            <td class="ps-3 small">XVoltyTrade</td>
            <td class="small">$29.00</td>
            <td class="small">$27.55</td>
            <td><span class="badge bg-danger">Rejected</span></td>
            <td class="pe-3 small text-muted">2026-04-21 05:28:02</td>
          </tr>
                  <tr>
            <td class="ps-3 small">XVoltyTrade</td>
            <td class="small">$29.00</td>
            <td class="small">$27.55</td>
            <td><span class="badge bg-danger">Rejected</span></td>
            <td class="pe-3 small text-muted">2026-04-21 05:27:48</td>
          </tr>
                  <tr>
            <td class="ps-3 small">XVoltyTrade</td>
            <td class="small">$20.99</td>
            <td class="small">$19.94</td>
            <td><span class="badge bg-danger">Rejected</span></td>
            <td class="pe-3 small text-muted">2026-04-21 05:27:04</td>
          </tr>
                  <tr>
            <td class="ps-3 small">XVoltyTrade</td>
            <td class="small">$20.99</td>
            <td class="small">$19.94</td>
            <td><span class="badge bg-success">Approved</span></td>
            <td class="pe-3 small text-muted">2026-04-21 05:26:30</td>
          </tr>
                </tbody>
      </table></div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card border-themed h-100">
      <div class="card-header bg-transparent border-themed d-flex align-items-center justify-content-between">
        <h6 class="mb-0"><i class="fa-solid fa-clock-rotate-left me-2"></i>Recent Setting Changes</h6>
        <a href="{{ url('admin/settings-overview') }}" class="small">Audit Log</a>
      </div>
      <div class="table-responsive"><table class="table table-sm table-hover mb-0 align-middle">
        <thead class="small text-muted text-uppercase"><tr><th class="ps-3">Setting</th><th>Old</th><th>New</th><th class="pe-3">By / When</th></tr></thead>
        <tbody>
                  <tr>
            <td class="ps-3"><code class="small">smtp_enabled</code></td>
            <td class="small"><span class="badge bg-secondary">1</span></td>
            <td class="small"><span class="badge bg-primary">0</span></td>
            <td class="pe-3 small text-muted">admin Â· 2026-04-21 11:08:24</td>
          </tr>
                  <tr>
            <td class="ps-3"><code class="small">smtp_enabled</code></td>
            <td class="small"><span class="badge bg-secondary">0</span></td>
            <td class="small"><span class="badge bg-primary">1</span></td>
            <td class="pe-3 small text-muted">admin Â· 2026-04-21 10:58:00</td>
          </tr>
                  <tr>
            <td class="ps-3"><code class="small">smtp_encryption</code></td>
            <td class="small"><span class="badge bg-secondary">tls</span></td>
            <td class="small"><span class="badge bg-primary">none</span></td>
            <td class="pe-3 small text-muted">admin Â· 2026-04-21 10:57:56</td>
          </tr>
                  <tr>
            <td class="ps-3"><code class="small">smtp_encryption</code></td>
            <td class="small"><span class="badge bg-secondary">ssl</span></td>
            <td class="small"><span class="badge bg-primary"></span></td>
            <td class="pe-3 small text-muted">admin Â· 2026-04-21 10:54:06</td>
          </tr>
                  <tr>
            <td class="ps-3"><code class="small">smtp_encryption</code></td>
            <td class="small"><span class="badge bg-secondary">tls</span></td>
            <td class="small"><span class="badge bg-primary">ssl</span></td>
            <td class="pe-3 small text-muted">admin Â· 2026-04-21 10:54:02</td>
          </tr>
                  <tr>
            <td class="ps-3"><code class="small">smtp_encryption</code></td>
            <td class="small"><span class="badge bg-secondary">tls</span></td>
            <td class="small"><span class="badge bg-primary"></span></td>
            <td class="pe-3 small text-muted">admin Â· 2026-04-21 10:53:57</td>
          </tr>
                </tbody>
      </table></div>
    </div>
  </div>
</div>

<!-- Capping Profile Distribution -->
<div class="card border-themed mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h6 class="mb-0"><i class="fa-solid fa-shield me-2"></i>Capping Profiles</h6>
    <a href="{{ url('admin/settings-capping') }}" class="small">Manage</a>
  </div>
  <div class="table-responsive">
    <table class="table table-sm table-hover mb-0 align-middle">
      <thead class="small text-muted text-uppercase">
        <tr><th class="ps-3">Profile</th><th>Direct Range</th><th>Cap Multiplier</th><th class="pe-3">Users</th></tr>
      </thead>
      <tbody>
              <tr>
          <td class="ps-3"><strong>Working</strong></td>
          <td><span class="badge bg-secondary">3 – ∞</span></td>
          <td><span class="fw-bold text-primary">5.00×</span></td>
          <td class="pe-3">0</td>
        </tr>
              <tr>
          <td class="ps-3"><strong>Non Working</strong></td>
          <td><span class="badge bg-secondary">0 – 2</span></td>
          <td><span class="fw-bold text-primary">2.00×</span></td>
          <td class="pe-3">16</td>
        </tr>
            </tbody>
    </table>
  </div>
</div>

<div class="card border-themed mb-4">
  <div class="card-body">
    <h6 class="fw-heading mb-3">Quick Actions</h6>
    <div class="d-flex flex-wrap gap-2">
      <a href="../admin/users.html?kyc=pending" class="btn btn-warning btn-sm"><i class="fa-solid fa-id-card me-1"></i> Approve KYC</a>
      <a href="../admin/withdrawals.html?status=pending" class="btn btn-primary btn-sm"><i class="fa-solid fa-arrow-up me-1"></i> Approve Withdrawals</a>
      <a href="../admin/deposits.html?status=pending" class="btn btn-success btn-sm"><i class="fa-solid fa-arrow-down me-1"></i> Verify Deposits</a>
      <a href="{{ url('admin/settings-packages') }}" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-box me-1"></i> Packages</a>
      <a href="{{ url('admin/settings-overview') }}" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-gear me-1"></i> Income Settings</a>
      <a href="{{ url('admin/settings-engines') }}" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-power-off me-1"></i> Engine Controls</a>
    </div>
  </div>
</div>

<script src="{{ asset('assets/js/chart.umd.min.js') }}"></script>
<script>
(function(){
  const DAYS = 30;
  const RANK_DATA = [{"rank_name":"S1 \u2014 Bronze","rank_type":"salary","users":0},{"rank_name":"S2 \u2014 Silver","rank_type":"salary","users":0},{"rank_name":"S3 \u2014 Gold","rank_type":"salary","users":0},{"rank_name":"S4 \u2014 Platinum","rank_type":"salary","users":0},{"rank_name":"S5 \u2014 Diamond","rank_type":"salary","users":0},{"rank_name":"Starter","rank_type":"reward","users":0},{"rank_name":"Beginner","rank_type":"reward","users":0},{"rank_name":"Learner","rank_type":"reward","users":0},{"rank_name":"Trader","rank_type":"reward","users":0},{"rank_name":"Investor","rank_type":"reward","users":0},{"rank_name":"Pro Investor","rank_type":"reward","users":0},{"rank_name":"Gold Investor","rank_type":"reward","users":0},{"rank_name":"Diamond Investor","rank_type":"reward","users":0}];
  const COLORS = {
    primary:'#087E8B', success:'#10b981', warning:'#f59e0b',
    info:'#06BEE1', danger:'#ef4444', purple:'#8b5cf6'
  };
  const isDark = document.documentElement.getAttribute('data-bs-theme') === 'dark';
  Chart.defaults.color = isDark ? 'rgba(255,255,255,.65)' : 'rgba(0,0,0,.65)';
  Chart.defaults.borderColor = isDark ? 'rgba(255,255,255,.08)' : 'rgba(0,0,0,.08)';

  const fetchJSON = async (type) => {
    const r = await fetch(`/admin/dashboard-data?type=${type}&days=${DAYS}`, {credentials:'same-origin'});
    const j = await r.json();
    if (!j.ok) throw new Error(j.error || 'fetch failed');
    return j.data;
  };

  fetchJSON('growth').then(data => {
    const labels = Object.keys(data), values = Object.values(data);
    document.getElementById('growthBadge').textContent = values.reduce((a,b)=>a+b,0) + ' new';
    new Chart(document.getElementById('userGrowthChart'), {
      type:'line',
      data:{labels, datasets:[{label:'New Users', data:values, borderColor:COLORS.primary, backgroundColor:COLORS.primary+'22', fill:true, tension:0.35, pointRadius:2}]},
      options:{responsive:true, maintainAspectRatio:false, scales:{y:{beginAtZero:true, ticks:{precision:0}}}, plugins:{legend:{display:false}}}
    });
  }).catch(console.error);

  fetchJSON('income').then(data => {
    new Chart(document.getElementById('incomeDistChart'), {
      type:'doughnut',
      data:{labels:['ROI','Direct','Level','Salary','Rank Reward'], datasets:[{
        data:[data.roi, data.direct, data.level, data.salary, data.rank_reward],
        backgroundColor:[COLORS.success, COLORS.primary, COLORS.info, COLORS.warning, COLORS.danger], borderWidth:0
      }]},
      options:{responsive:true, maintainAspectRatio:false, plugins:{legend:{position:'bottom', labels:{boxWidth:10, padding:8}}}}
    });
  }).catch(console.error);

  fetchJSON('sales').then(data => {
    new Chart(document.getElementById('packageSalesChart'), {
      type:'bar',
      data:{labels:data.map(r=>r.package_name), datasets:[
        {label:'Sales (count)', data:data.map(r=>+r.sales), backgroundColor:COLORS.primary, yAxisID:'y'},
        {label:'Volume ($)', data:data.map(r=>+r.volume), backgroundColor:COLORS.success, yAxisID:'y1'}
      ]},
      options:{responsive:true, maintainAspectRatio:false, scales:{
        y:{beginAtZero:true, position:'left', ticks:{precision:0}, title:{display:true,text:'Sales'}},
        y1:{beginAtZero:true, position:'right', grid:{drawOnChartArea:false}, title:{display:true,text:'Volume ($)'}}
      }}
    });
  }).catch(console.error);

  fetchJSON('payout').then(data => {
    const labels = Object.keys(data), values = Object.values(data);
    new Chart(document.getElementById('payoutTrendChart'), {
      type:'line',
      data:{labels, datasets:[{label:'Daily Payout ($)', data:values, borderColor:COLORS.warning, backgroundColor:COLORS.warning+'22', fill:true, tension:0.35, pointRadius:2}]},
      options:{responsive:true, maintainAspectRatio:false, scales:{y:{beginAtZero:true}}}
    });
  }).catch(console.error);

  if (RANK_DATA.length) {
    new Chart(document.getElementById('rankDistChart'), {
      type:'bar',
      data:{
        labels: RANK_DATA.map(r=>r.rank_name + (r.rank_type==='salary'?' (S)':r.rank_type==='reward'?' (R)':'')),
        datasets:[{label:'Users', data: RANK_DATA.map(r=>+r.users),
          backgroundColor: RANK_DATA.map(r => r.rank_type==='salary'?COLORS.primary : r.rank_type==='reward'?COLORS.warning : COLORS.info)}]
      },
      options:{responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}},
        scales:{y:{beginAtZero:true, ticks:{precision:0}}},
        onClick:(evt, els)=>{ if(!els.length) return; const r = RANK_DATA[els[0].index]; window.location.href='users.php?rank='+encodeURIComponent(r.rank_name); }}
    });
  }
})();
</script>
@endsection
