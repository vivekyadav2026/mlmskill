@extends('layouts.user')
@section('title', 'My Dashboard â€” XVolty Trade')

@section('content')
<!-- Welcome Banner -->
<div class="card border-themed mb-4">
  <div class="card-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
      <div>
        <h4 class="fw-heading mb-1">Welcome back, {{ $user->name }} <i class="fa-solid fa-hand-sparkles text-accent"></i></h4>
        <div class="d-flex flex-wrap gap-2 small">
          <span class="badge text-bg-secondary"><i class="fa-solid fa-id-badge me-1"></i>{{ $user->referral_code }}</span>
                      <span class="badge bg-warning text-dark"><i class="fa-solid fa-trophy me-1"></i>Unranked</span>
                    <span class="badge bg-info text-dark"><i class="fa-solid fa-network-wired me-1"></i>2 in
            Network</span>
        </div>
      </div>
      <div class="d-flex gap-2 flex-wrap">
        <a href="{{ url('user/deposit') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-arrow-down me-1"></i>Deposit</a>
        <a href="{{ url('user/withdraw') }}" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-arrow-up me-1"></i>Withdraw</a>
        <a href="{{ url('user/invest') }}" class="btn btn-success btn-sm"><i class="fa-solid fa-box me-1"></i>Buy Package</a>
      </div>
    </div>
  </div>
</div>

<!-- â”€â”€â”€ Referral Link â”€â”€â”€ -->
<div class="card border-themed mb-4">
  <div class="card-body py-2">
    <div class="d-flex align-items-center gap-2 flex-wrap">
      <label class="form-label small text-muted mb-0 me-2"><i class="fa-solid fa-link me-1"></i> Referral Link</label>
      <div class="input-group input-group-sm flex-grow-1" style="min-width:280px;max-width:600px;">
        <input type="text" id="refLink" class="form-control" value="{{ url('register?ref=' . $user->referral_code) }}" readonly="">
        <button class="btn btn-outline-primary copy-btn" data-target="refLink" title="Copy"><i class="fa-solid fa-copy"></i></button>
      </div>
    </div>
  </div>
</div>

<!-- â”€â”€â”€ Time Filter â”€â”€â”€ -->
<div class="d-flex justify-content-end mb-3">
  <div class="btn-group btn-group-sm" role="group">
          <a href="../user/index.html?days=7" class="btn btn-outline-secondary">7D</a>
          <a href="../user/index.html?days=30" class="btn btn-primary">30D</a>
          <a href="../user/index.html?days=90" class="btn btn-outline-secondary">90D</a>
          <a href="../user/index.html?days=365" class="btn btn-outline-secondary">1Y</a>
      </div>
</div>

<!-- â”€â”€â”€ KPI Wallet Cards â”€â”€â”€ -->
<div class="row g-3 mb-4">
      <div class="col-6 col-lg-3">
      <div class="card border-themed h-100">
        <div class="card-body">
          <div class="d-flex align-items-center gap-3">
            <span class="xvt-avatar lg" style="background:#087E8B22;color:#087E8B;"><i class="fa-solid fa-wallet"></i></span>
            <div>
              <div class="text-muted small">Active Wallet</div>
              <h5 class="mb-0 fw-bold">${{ number_format($user->wallet_balance, 2) }}</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
      <div class="col-6 col-lg-3">
      <div class="card border-themed h-100">
        <div class="card-body">
          <div class="d-flex align-items-center gap-3">
            <span class="xvt-avatar lg" style="background:#10b98122;color:#10b981;"><i class="fa-solid fa-chart-line"></i></span>
            <div>
              <div class="text-muted small">ROI Wallet</div>
              <h5 class="mb-0 fw-bold">${{ number_format($user->roi_balance, 2) }}</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
      <div class="col-6 col-lg-3">
      <div class="card border-themed h-100">
        <div class="card-body">
          <div class="d-flex align-items-center gap-3">
            <span class="xvt-avatar lg" style="background:#f59e0b22;color:#f59e0b;"><i class="fa-solid fa-lock"></i></span>
            <div>
              <div class="text-muted small">Inactive Wallet</div>
              <h5 class="mb-0 fw-bold">$0.00</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
      <div class="col-6 col-lg-3">
      <div class="card border-themed h-100">
        <div class="card-body">
          <div class="d-flex align-items-center gap-3">
            <span class="xvt-avatar lg" style="background:#06BEE122;color:#06BEE1;"><i class="fa-solid fa-sack-dollar"></i></span>
            <div>
              <div class="text-muted small">Total Earned</div>
              <h5 class="mb-0 fw-bold">${{ number_format($user->total_earned, 2) }}</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- â”€â”€â”€ Earning Cap & Network KPIs â”€â”€â”€ -->
<div class="row g-3 mb-4">
  <div class="col-lg-6">
    <div class="card border-themed h-100">
      <div class="card-body">
        <div class="d-flex justify-content-between mb-2">
          <h6 class="fw-heading mb-0"><i class="fa-solid fa-shield-halved me-2 text-warning"></i>Earning Cap Usage</h6>
          <div class="d-flex gap-2 align-items-center">
            <span class="badge bg-info">Non Working (2.00×)</span>
            <span class="badge bg-success">2.2%</span>
          </div>
        </div>
        <div class="progress mb-3" style="height:10px;">
          <div class="progress-bar bg-success" style="width:2.1593090211132%"></div>
        </div>
        <div class="row g-2 small">
          <div class="col-4">
            <div class="text-muted">Invested</div><strong>$521.00</strong>
          </div>
          <div class="col-4">
            <div class="text-muted">Earned</div><strong class="text-success">$22.50</strong>
          </div>
          <div class="col-4">
            <div class="text-muted">Cap</div><strong>$1,042.00</strong>
          </div>
        </div>
        <div class="mt-2 small text-muted">Remaining Cap: <strong class="text-info">$1,019.50</strong>
          <strong>2</strong> active package(s)
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card border-themed h-100">
      <div class="card-body">
        <h6 class="fw-heading mb-3"><i class="fa-solid fa-people-group me-2 text-info"></i>Network Snapshot</h6>
        <div class="row g-2 text-center">
          <div class="col-4">
            <div class="p-2 rounded" style="background:rgba(8,126,139,.1);">
              <div class="text-muted small">Direct</div>
              <h5 class="mb-0 fw-bold">2</h5>
            </div>
          </div>
          <div class="col-4">
            <div class="p-2 rounded" style="background:rgba(6,190,225,.1);">
              <div class="text-muted small">Total Network</div>
              <h5 class="mb-0 fw-bold">2</h5>
            </div>
          </div>
          <div class="col-4">
            <div class="p-2 rounded" style="background:rgba(245,158,11,.1);">
              <div class="text-muted small">Withdrawal Wallet</div>
              <h5 class="mb-0 fw-bold">$66.50</h5>
            </div>
          </div>
        </div>
        <div class="mt-3" style="position:relative;height:140px;"><canvas id="levelChart" width="653" height="210" style="display: block; box-sizing: border-box; height: 140px; width: 435px;"></canvas></div>
      </div>
    </div>
  </div>
</div>

<!-- â”€â”€â”€ Charts: Earnings Trend + Income Breakdown â”€â”€â”€ -->
<div class="row g-3 mb-4">
  <div class="col-lg-8">
    <div class="card border-themed h-100">
      <div class="card-header bg-transparent border-themed d-flex align-items-center justify-content-between">
        <h6 class="mb-0"><i class="fa-solid fa-chart-line me-2"></i>Earnings Trend (last 30 days)</h6>
        <span class="badge bg-secondary" id="earnBadge">$22.50</span>
      </div>
      <div class="card-body">
        <div style="position:relative;height:300px;"><canvas id="earningsChart" width="895" height="450" style="display: block; box-sizing: border-box; height: 300px; width: 597px;"></canvas></div>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card border-themed h-100">
      <div class="card-header bg-transparent border-themed">
        <h6 class="mb-0"><i class="fa-solid fa-chart-pie me-2"></i>Income Breakdown</h6>
      </div>
      <div class="card-body">
        <div style="position:relative;height:260px;"><canvas id="breakdownChart" width="411" height="390" style="display: block; box-sizing: border-box; height: 260px; width: 274px;"></canvas></div>
      </div>
    </div>
  </div>
</div>

<!-- â”€â”€â”€ Rank Progress â”€â”€â”€ -->
  <div class="card border-themed mb-4">
    <div class="card-body">
      <div class="d-flex justify-content-between flex-wrap gap-2 mb-3">
        <h6 class="fw-heading mb-0"><i class="fa-solid fa-medal me-2 text-warning"></i>Rank Progress</h6>
        <div class="small">
          <span class="badge bg-secondary me-1">No Rank</span>
          <i class="fa-solid fa-arrow-right mx-1 text-muted"></i>
          <span class="badge bg-warning text-dark">S1 — Bronze</span>
        </div>
      </div>
      <div class="progress mb-2" style="height:14px;">
        <div class="progress-bar bg-warning" style="width:40%">
          40.0%
        </div>
      </div>
      <div class="small text-muted">Direct Referrals: <strong>2</strong> /
        <strong>5</strong> | Need <strong class="text-warning">5</strong> more direct referrals
      </div>
    </div>
  </div>

<!-- â”€â”€â”€ Package ROI Tracker â”€â”€â”€ -->
<div class="card border-themed mb-4">
  <div class="card-header bg-transparent border-themed d-flex align-items-center justify-content-between">
    <h6 class="mb-0"><i class="fa-solid fa-cubes-stacked me-2"></i>My Active Packages</h6>
    <a href="{{ url('user/portfolio') }}" class="small">View all</a>
  </div>
  <div class="table-responsive">
    <table class="table table-hover mb-0 align-middle">
      <thead class="small text-muted text-uppercase">
        <tr>
          <th class="ps-3">Package</th>
          <th>Daily ROI</th>
          <th>Invested</th>
          <th>Cap</th>
          <th>ROI Earned</th>
          <th>Progress</th>
          <th class="pe-3">Status</th>
        </tr>
      </thead>
      <tbody>
                    <tr>
              <td class="ps-3"><strong>Starter Pack</strong></td>
              <td class="small">1.00%</td>
              <td class="small">$21.00</td>
              <td class="small">$42.00</td>
              <td class="small text-success">$0.00</td>
              <td style="min-width:140px;">
                <div class="progress" style="height:8px;">
                  <div class="progress-bar bg-success" style="width:0%"></div>
                </div>
                <div class="small text-muted mt-1">0.0%</div>
              </td>
              <td class="pe-3"><span class="badge bg-success">Active</span>
              </td>
            </tr>
                      <tr>
              <td class="ps-3"><strong>Investor Pack</strong></td>
              <td class="small">1.00%</td>
              <td class="small">$500.00</td>
              <td class="small">$1,000.00</td>
              <td class="small text-success">$15.00</td>
              <td style="min-width:140px;">
                <div class="progress" style="height:8px;">
                  <div class="progress-bar bg-success" style="width:1.5%"></div>
                </div>
                <div class="small text-muted mt-1">1.5%</div>
              </td>
              <td class="pe-3"><span class="badge bg-success">Active</span>
              </td>
            </tr>
                </tbody>
    </table>
  </div>
</div>

<!-- â”€â”€â”€ Recent Activity â”€â”€â”€ -->
<div class="row g-3 mb-4">
  <div class="col-lg-6">
    <div class="card border-themed h-100">
      <div class="card-header bg-transparent border-themed d-flex align-items-center justify-content-between">
        <h6 class="mb-0"><i class="fa-solid fa-coins me-2"></i>Recent Income</h6>
        <a href="{{ url('user/incomes') }}" class="small">View all</a>
      </div>
      <div class="table-responsive">
        <table class="table table-sm table-hover mb-0 align-middle">
          <thead class="small text-muted text-uppercase">
            <tr>
              <th class="ps-3">Type</th>
              <th>Amount</th>
              <th class="pe-3">When</th>
            </tr>
          </thead>
          <tbody>
                            <tr>
                  <td class="ps-3"><span class="badge bg-secondary text-uppercase small">roi</span>
                  </td>
                  <td class="small text-success">$5.00</td>
                  <td class="pe-3 small text-muted">2026-05-01 10:31:20</td>
                </tr>
                              <tr>
                  <td class="ps-3"><span class="badge bg-secondary text-uppercase small">roi</span>
                  </td>
                  <td class="small text-success">$5.00</td>
                  <td class="pe-3 small text-muted">2026-04-29 11:00:54</td>
                </tr>
                              <tr>
                  <td class="ps-3"><span class="badge bg-secondary text-uppercase small">roi</span>
                  </td>
                  <td class="small text-success">$5.00</td>
                  <td class="pe-3 small text-muted">2026-04-25 10:35:57</td>
                </tr>
                              <tr>
                  <td class="ps-3"><span class="badge bg-secondary text-uppercase small">direct</span>
                  </td>
                  <td class="small text-success">$5.00</td>
                  <td class="pe-3 small text-muted">2026-04-24 08:38:41</td>
                </tr>
                              <tr>
                  <td class="ps-3"><span class="badge bg-secondary text-uppercase small">level</span>
                  </td>
                  <td class="small text-success">$2.50</td>
                  <td class="pe-3 small text-muted">2026-04-24 08:38:41</td>
                </tr>
                        </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card border-themed h-100">
      <div class="card-header bg-transparent border-themed d-flex align-items-center justify-content-between">
        <h6 class="mb-0"><i class="fa-solid fa-user-plus me-2"></i>Recent Referrals</h6>
        <a href="{{ url('user/referrals') }}" class="small">View all</a>
      </div>
      <div class="table-responsive">
        <table class="table table-sm table-hover mb-0 align-middle">
          <thead class="small text-muted text-uppercase">
            <tr>
              <th class="ps-3">User</th>
              <th>Status</th>
              <th class="pe-3">Joined</th>
            </tr>
          </thead>
          <tbody>
                            <tr>
                  <td class="ps-3 small"><strong>POONAM SINGH</strong><br><span class="text-muted">XV442258</span></td>
                  <td><span class="badge bg-success">Active</span>
                  </td>
                  <td class="pe-3 small text-muted">2026-04-21 10:49:07</td>
                </tr>
                              <tr>
                  <td class="ps-3 small"><strong>Ravishankar Tiwari</strong><br><span class="text-muted">XV528556</span></td>
                  <td><span class="badge bg-secondary">Inactive</span>
                  </td>
                  <td class="pe-3 small text-muted">2026-04-21 10:14:21</td>
                </tr>
                        </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="row g-3 mb-4">
  <div class="col-lg-6">
    <div class="card border-themed h-100">
      <div class="card-header bg-transparent border-themed d-flex align-items-center justify-content-between">
        <h6 class="mb-0"><i class="fa-solid fa-arrow-down me-2"></i>Recent Deposits</h6>
        <a href="{{ url('user/deposit') }}" class="small">View all</a>
      </div>
      <div class="table-responsive">
        <table class="table table-sm table-hover mb-0 align-middle">
          <thead class="small text-muted text-uppercase">
            <tr>
              <th class="ps-3">Amount</th>
              <th>Method</th>
              <th>Status</th>
              <th class="pe-3">When</th>
            </tr>
          </thead>
          <tbody>
                            <tr>
                  <td class="ps-3 small">$1,000.00</td>
                  <td class="small">crypto</td>
                  <td><span class="badge bg-success">Approved</span></td>
                  <td class="pe-3 small text-muted">2026-04-21 05:20:46</td>
                </tr>
                              <tr>
                  <td class="ps-3 small">$10.00</td>
                  <td class="small">crypto</td>
                  <td><span class="badge bg-success">Approved</span></td>
                  <td class="pe-3 small text-muted">2026-04-20 11:16:43</td>
                </tr>
                              <tr>
                  <td class="ps-3 small">$10.00</td>
                  <td class="small">crypto</td>
                  <td><span class="badge bg-success">Approved</span></td>
                  <td class="pe-3 small text-muted">2026-04-20 11:07:08</td>
                </tr>
                        </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card border-themed h-100">
      <div class="card-header bg-transparent border-themed d-flex align-items-center justify-content-between">
        <h6 class="mb-0"><i class="fa-solid fa-arrow-up me-2"></i>Recent Withdrawals</h6>
        <a href="{{ url('user/withdraw') }}" class="small">View all</a>
      </div>
      <div class="table-responsive">
        <table class="table table-sm table-hover mb-0 align-middle">
          <thead class="small text-muted text-uppercase">
            <tr>
              <th class="ps-3">Amount</th>
              <th>Net</th>
              <th>Status</th>
              <th class="pe-3">When</th>
            </tr>
          </thead>
          <tbody>
                            <tr>
                  <td class="ps-3 small">$29.00</td>
                  <td class="small">$27.55</td>
                  <td><span class="badge bg-success">Approved</span></td>
                  <td class="pe-3 small text-muted">2026-04-21 05:31:23</td>
                </tr>
                              <tr>
                  <td class="ps-3 small">$29.00</td>
                  <td class="small">$27.55</td>
                  <td><span class="badge bg-danger">Rejected</span></td>
                  <td class="pe-3 small text-muted">2026-04-21 05:28:05</td>
                </tr>
                              <tr>
                  <td class="ps-3 small">$29.00</td>
                  <td class="small">$27.55</td>
                  <td><span class="badge bg-danger">Rejected</span></td>
                  <td class="pe-3 small text-muted">2026-04-21 05:28:02</td>
                </tr>
                              <tr>
                  <td class="ps-3 small">$29.00</td>
                  <td class="small">$27.55</td>
                  <td><span class="badge bg-danger">Rejected</span></td>
                  <td class="pe-3 small text-muted">2026-04-21 05:27:48</td>
                </tr>
                              <tr>
                  <td class="ps-3 small">$20.99</td>
                  <td class="small">$19.94</td>
                  <td><span class="badge bg-danger">Rejected</span></td>
                  <td class="pe-3 small text-muted">2026-04-21 05:27:04</td>
                </tr>
                        </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Payout Wallet Widget -->
<div class="card border-themed mb-4">
  <div class="card-header bg-transparent border-themed d-flex align-items-center justify-content-between">
    <h6 class="mb-0"><i class="fa-solid fa-wallet me-2"></i>Payout Wallet</h6>
    <a href="{{ url('user/payout-wallet') }}" class="small">Manage</a>
  </div>
  <div class="card-body">
          <div class="d-flex align-items-start gap-3">
                  <img src="{{ asset('assets/My Dashboard â€” XVolty Trade_files/pqr_0df9a2229d506bdb78cc8cc755417b3c.png') }}" alt="QR" class="img-thumbnail" style="max-width:60px;">
                <div>
          <strong>My Wallet</strong>
          <span class="badge bg-info text-dark ms-1">ERC20</span>
          <span class="badge bg-success ms-1">verified</span>
          <div class="mt-1"><code class="small" style="word-break:break-all;">test</code></div>
                  </div>
      </div>
      </div>
</div>

<div class="card border-themed mb-4">
  <div class="card-body">
    <h6 class="fw-heading mb-3">Quick Actions</h6>
    <div class="d-flex flex-wrap gap-2">
      <a href="{{ url('user/invest') }}" class="btn btn-success btn-sm"><i class="fa-solid fa-box me-1"></i>Buy Package</a>
      <a href="{{ url('user/withdraw') }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-arrow-up me-1"></i>Withdraw</a>
      <a href="{{ url('user/tree') }}" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-network-wired me-1"></i>View
        Network</a>
      <a href="{{ url('user/incomes') }}" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-coins me-1"></i>Income
        History</a>
      <a href="{{ url('user/referrals') }}" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-user-plus me-1"></i>Referrals</a>
      <a href="{{ url('user/profile') }}" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-user me-1"></i>Profile</a>
    </div>
  </div>
</div>

<script src="{{ asset('assets/js/chart.umd.min.js') }}"></script>
<script>
  (function () {
    const DAYS = 30;
    const LEVEL_COUNTS = [{"1":2,"2":0,"3":0,"4":0,"5":0,"6":0,"7":0,"8":0},2];
    const COLORS = { primary: '#087E8B', success: '#10b981', warning: '#f59e0b', info: '#06BEE1', danger: '#ef4444', purple: '#8b5cf6' };
    const isDark = document.documentElement.getAttribute('data-bs-theme') === 'dark';
    Chart.defaults.color = isDark ? 'rgba(255,255,255,.65)' : 'rgba(0,0,0,.65)';
    Chart.defaults.borderColor = isDark ? 'rgba(255,255,255,.08)' : 'rgba(0,0,0,.08)';

    const fetchJSON = async (type) => {
      const r = await fetch(`/user/dashboard-data?type=${type}&days=${DAYS}`, { credentials: 'same-origin' });
      const j = await r.json();
      if (!j.ok) throw new Error(j.error || 'fetch failed');
      return j.data;
    };

    // Earnings trend
    fetchJSON('earnings').then(data => {
      const labels = Object.keys(data), values = Object.values(data);
      const total = values.reduce((a, b) => a + (+b || 0), 0);
      document.getElementById('earnBadge').textContent = '$' + total.toFixed(2);
      new Chart(document.getElementById('earningsChart'), {
        type: 'line',
        data: { labels, datasets: [{ label: 'Earnings ($)', data: values, borderColor: COLORS.success, backgroundColor: COLORS.success + '22', fill: true, tension: 0.35, pointRadius: 2 }] },
        options: { responsive: true, maintainAspectRatio: false, scales: { y: { beginAtZero: true } }, plugins: { legend: { display: false } } }
      });
    }).catch(console.error);

    // Income breakdown
    fetchJSON('breakdown').then(data => {
      new Chart(document.getElementById('breakdownChart'), {
        type: 'doughnut',
        data: {
          labels: ['ROI', 'Direct', 'Level', 'Salary', 'Rank Reward'], datasets: [{
            data: [data.roi || 0, data.direct || 0, data.level || 0, data.salary || 0, data.rank_reward || 0],
            backgroundColor: [COLORS.success, COLORS.primary, COLORS.info, COLORS.warning, COLORS.danger], borderWidth: 0
          }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, padding: 8 } } } }
      });
    }).catch(console.error);

    // Copy referral link
    document.querySelectorAll('.copy-btn').forEach(btn => {
      btn.addEventListener('click', async () => {
        const targetId = btn.getAttribute('data-target');
        const input = targetId ? document.getElementById(targetId) : null;
        if (!input) return;
        const text = input.value || input.textContent || '';
        try {
          if (navigator.clipboard && window.isSecureContext) {
            await navigator.clipboard.writeText(text);
          } else {
            input.removeAttribute('readonly');
            input.select();
            input.setSelectionRange(0, text.length);
            document.execCommand('copy');
            input.setAttribute('readonly', 'readonly');
            input.blur();
          }
          const icon = btn.querySelector('i');
          const original = icon ? icon.className : '';
          if (icon) icon.className = 'fa-solid fa-check';
          btn.classList.add('btn-success');
          btn.classList.remove('btn-outline-primary');
          setTimeout(() => {
            if (icon && original) icon.className = original;
            btn.classList.remove('btn-success');
            btn.classList.add('btn-outline-primary');
          }, 1500);
        } catch (e) {
          console.error('Copy failed', e);
        }
      });
    });

    // Network levels (inline)
    if (LEVEL_COUNTS.length) {
      new Chart(document.getElementById('levelChart'), {
        type: 'bar',
        data: {
          labels: LEVEL_COUNTS.map((_, i) => 'L' + (i + 1)),
          datasets: [{ label: 'Members', data: LEVEL_COUNTS, backgroundColor: COLORS.purple }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false }, title: { display: true, text: 'Members per Level' } }, scales: { y: { beginAtZero: true, ticks: { precision: 0 } } } }
      });
    }
  })();
</script>
@endsection
