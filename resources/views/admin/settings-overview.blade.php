@extends('layouts.admin')
@section('title', 'Income Overview — Settings — XVolty Trade')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4"><div><h3 class="fw-heading mb-1"><i class="fa-solid fa-chart-pie me-2"></i>Income Overview</h3><p class="text-muted mb-0 small">Dashboard of compensation parameters and recent settings changes.</p></div></div>
<!-- ──── Summary Cards ──── -->
<div class="row g-3 mb-4">
  <div class="col-6 col-md-4 col-lg-3">
    <div class="card border-themed h-100"><div class="card-body text-center py-3">
      <i class="fa-solid fa-handshake fa-2x text-primary mb-2"></i>
      <div class="text-muted small">Direct Income</div>
      <h4 class="fw-bold mb-0">10.00%</h4>
    </div></div>
  </div>
  <div class="col-6 col-md-4 col-lg-3">
    <div class="card border-themed h-100"><div class="card-body text-center py-3">
      <i class="fa-solid fa-chart-line fa-2x text-success mb-2"></i>
      <div class="text-muted small">Daily ROI (package)</div>
      <h4 class="fw-bold mb-0">Per-Package</h4>
    </div></div>
  </div>
  <div class="col-6 col-md-4 col-lg-3">
    <div class="card border-themed h-100"><div class="card-body text-center py-3">
      <i class="fa-solid fa-box fa-2x text-info mb-2"></i>
      <div class="text-muted small">Active Packages</div>
      <h4 class="fw-bold mb-0">8</h4>
    </div></div>
  </div>
  <div class="col-6 col-md-4 col-lg-3">
    <div class="card border-themed h-100"><div class="card-body text-center py-3">
      <i class="fa-solid fa-layer-group fa-2x text-warning mb-2"></i>
      <div class="text-muted small">Levels Enabled</div>
      <h4 class="fw-bold mb-0">8 / 8</h4>
    </div></div>
  </div>
  <div class="col-6 col-md-4 col-lg-3">
    <div class="card border-themed h-100"><div class="card-body text-center py-3">
      <i class="fa-solid fa-money-bill fa-2x text-primary mb-2"></i>
      <div class="text-muted small">Salary Ranks</div>
      <h4 class="fw-bold mb-0">5</h4>
    </div></div>
  </div>
  <div class="col-6 col-md-4 col-lg-3">
    <div class="card border-themed h-100"><div class="card-body text-center py-3">
      <i class="fa-solid fa-trophy fa-2x text-success mb-2"></i>
      <div class="text-muted small">Reward Ranks</div>
      <h4 class="fw-bold mb-0">8</h4>
    </div></div>
  </div>
  <div class="col-6 col-md-4 col-lg-3">
    <div class="card border-themed h-100"><div class="card-body text-center py-3">
      <i class="fa-solid fa-shield fa-2x text-danger mb-2"></i>
      <div class="text-muted small">Cap Multiplier</div>
      <h4 class="fw-bold mb-0">5.0×</h4>
    </div></div>
  </div>
  <div class="col-6 col-md-4 col-lg-3">
    <div class="card border-themed h-100"><div class="card-body text-center py-3">
            <i class="fa-solid fa-power-off fa-2x text-success mb-2"></i>
      <div class="text-muted small">Engines</div>
      <h4 class="fw-bold mb-0">All Running</h4>
    </div></div>
  </div>
</div>

<!-- ──── Engine Status Row ──── -->
<div class="card border-themed mb-4">
  <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-gauge me-2"></i>Engine Status</h6></div>
  <div class="card-body">
    <div class="row g-2 text-center">
            <div class="col">
        <div class="p-2 rounded" style="background: var(--xvt-card-bg); border: 1px solid var(--xvt-border);">
          <i class="fa-solid fa-chart-line text-success"></i>
          <div class="small fw-semibold">ROI</div>
          <span class="badge bg-success">On</span>
        </div>
      </div>
            <div class="col">
        <div class="p-2 rounded" style="background: var(--xvt-card-bg); border: 1px solid var(--xvt-border);">
          <i class="fa-solid fa-handshake text-success"></i>
          <div class="small fw-semibold">Direct</div>
          <span class="badge bg-success">On</span>
        </div>
      </div>
            <div class="col">
        <div class="p-2 rounded" style="background: var(--xvt-card-bg); border: 1px solid var(--xvt-border);">
          <i class="fa-solid fa-layer-group text-success"></i>
          <div class="small fw-semibold">Level</div>
          <span class="badge bg-success">On</span>
        </div>
      </div>
            <div class="col">
        <div class="p-2 rounded" style="background: var(--xvt-card-bg); border: 1px solid var(--xvt-border);">
          <i class="fa-solid fa-money-bill text-success"></i>
          <div class="small fw-semibold">Salary</div>
          <span class="badge bg-success">On</span>
        </div>
      </div>
            <div class="col">
        <div class="p-2 rounded" style="background: var(--xvt-card-bg); border: 1px solid var(--xvt-border);">
          <i class="fa-solid fa-trophy text-success"></i>
          <div class="small fw-semibold">Rank</div>
          <span class="badge bg-success">On</span>
        </div>
      </div>
          </div>
  </div>
</div>

<!-- ──── Activity Log ──── -->
<div class="card border-themed">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h6 class="mb-0"><i class="fa-solid fa-clock-rotate-left me-2"></i>Settings Activity Log</h6>
    <span class="badge bg-secondary">30 recent</span>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover table-sm align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th class="ps-3">Date</th>
            <th>Setting Changed</th>
            <th>Old Value</th>
            <th>New Value</th>
            <th>Admin User</th>
          </tr>
        </thead>
        <tbody>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 11:08:24</td>
              <td><code class="small">smtp_enabled</code></td>
              <td><span class="badge bg-secondary">1</span></td>
              <td><span class="badge bg-primary">0</span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 10:58:00</td>
              <td><code class="small">smtp_enabled</code></td>
              <td><span class="badge bg-secondary">0</span></td>
              <td><span class="badge bg-primary">1</span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 10:57:56</td>
              <td><code class="small">smtp_encryption</code></td>
              <td><span class="badge bg-secondary">tls</span></td>
              <td><span class="badge bg-primary">none</span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 10:54:06</td>
              <td><code class="small">smtp_encryption</code></td>
              <td><span class="badge bg-secondary">ssl</span></td>
              <td><span class="badge bg-primary"></span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 10:54:02</td>
              <td><code class="small">smtp_encryption</code></td>
              <td><span class="badge bg-secondary">tls</span></td>
              <td><span class="badge bg-primary">ssl</span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 10:53:57</td>
              <td><code class="small">smtp_encryption</code></td>
              <td><span class="badge bg-secondary">tls</span></td>
              <td><span class="badge bg-primary"></span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 10:53:57</td>
              <td><code class="small">smtp_enabled</code></td>
              <td><span class="badge bg-secondary">1</span></td>
              <td><span class="badge bg-primary">0</span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 10:53:50</td>
              <td><code class="small">smtp_encryption</code></td>
              <td><span class="badge bg-secondary">tls</span></td>
              <td><span class="badge bg-primary"></span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 10:53:45</td>
              <td><code class="small">smtp_encryption</code></td>
              <td><span class="badge bg-secondary">tls</span></td>
              <td><span class="badge bg-primary"></span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 10:53:31</td>
              <td><code class="small">smtp_encryption</code></td>
              <td><span class="badge bg-secondary">tls</span></td>
              <td><span class="badge bg-primary"></span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 10:53:16</td>
              <td><code class="small">smtp_encryption</code></td>
              <td><span class="badge bg-secondary">ssl</span></td>
              <td><span class="badge bg-primary"></span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 10:53:16</td>
              <td><code class="small">smtp_username</code></td>
              <td><span class="badge bg-secondary">info@aryaveda.startupitsolution.com</span></td>
              <td><span class="badge bg-primary">smtp.freesmtpservers.com</span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 10:53:16</td>
              <td><code class="small">smtp_port</code></td>
              <td><span class="badge bg-secondary">465</span></td>
              <td><span class="badge bg-primary">25</span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 10:53:16</td>
              <td><code class="small">smtp_host</code></td>
              <td><span class="badge bg-secondary">smtp.hostinger.com</span></td>
              <td><span class="badge bg-primary">smtp.freesmtpservers.com</span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 10:47:25</td>
              <td><code class="small">smtp_port</code></td>
              <td><span class="badge bg-secondary">461</span></td>
              <td><span class="badge bg-primary">465</span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 10:47:06</td>
              <td><code class="small">smtp_password</code></td>
              <td><span class="badge bg-secondary"></span></td>
              <td><span class="badge bg-primary">Aryaveda@9999</span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 10:47:06</td>
              <td><code class="small">smtp_encryption</code></td>
              <td><span class="badge bg-secondary">tls</span></td>
              <td><span class="badge bg-primary">ssl</span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 10:47:06</td>
              <td><code class="small">smtp_username</code></td>
              <td><span class="badge bg-secondary">demo@xvoltytrade.com</span></td>
              <td><span class="badge bg-primary">info@aryaveda.startupitsolution.com</span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 10:47:06</td>
              <td><code class="small">smtp_port</code></td>
              <td><span class="badge bg-secondary">587</span></td>
              <td><span class="badge bg-primary">461</span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 10:47:06</td>
              <td><code class="small">smtp_host</code></td>
              <td><span class="badge bg-secondary">smtp.gmail.com</span></td>
              <td><span class="badge bg-primary">smtp.hostinger.com</span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 10:47:06</td>
              <td><code class="small">smtp_enabled</code></td>
              <td><span class="badge bg-secondary">0</span></td>
              <td><span class="badge bg-primary">1</span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 07:10:13</td>
              <td><code class="small">youtube_enabled</code></td>
              <td><span class="badge bg-secondary">0</span></td>
              <td><span class="badge bg-primary">1</span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 07:10:13</td>
              <td><code class="small">youtube_url</code></td>
              <td><span class="badge bg-secondary"></span></td>
              <td><span class="badge bg-primary">http://localhost/Xvoltytrade/admin/site-settings.php</span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 07:10:13</td>
              <td><code class="small">telegram_enabled</code></td>
              <td><span class="badge bg-secondary">0</span></td>
              <td><span class="badge bg-primary">1</span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 07:10:13</td>
              <td><code class="small">telegram_url</code></td>
              <td><span class="badge bg-secondary"></span></td>
              <td><span class="badge bg-primary">http://localhost/Xvoltytrade/admin/site-settings.php</span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 07:10:13</td>
              <td><code class="small">facebook_enabled</code></td>
              <td><span class="badge bg-secondary">0</span></td>
              <td><span class="badge bg-primary">1</span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 07:10:13</td>
              <td><code class="small">facebook_url</code></td>
              <td><span class="badge bg-secondary"></span></td>
              <td><span class="badge bg-primary">http://localhost/Xvoltytrade/admin/site-settings.php</span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 07:02:44</td>
              <td><code class="small">site_favicon</code></td>
              <td><span class="badge bg-secondary">uploads/site/favicon_20260421_090236_a25b227c.png</span></td>
              <td><span class="badge bg-primary"></span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 07:02:44</td>
              <td><code class="small">company_logo</code></td>
              <td><span class="badge bg-secondary">uploads/site/logo_20260421_090236_a170db8f.png</span></td>
              <td><span class="badge bg-primary"></span></td>
              <td class="small">admin</td>
            </tr>
                      <tr>
              <td class="ps-3 small text-muted">2026-04-21 07:02:36</td>
              <td><code class="small">site_favicon</code></td>
              <td><span class="badge bg-secondary"></span></td>
              <td><span class="badge bg-primary">uploads/site/favicon_20260421_090236_a25b227c.png</span></td>
              <td class="small">admin</td>
            </tr>
                  </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
