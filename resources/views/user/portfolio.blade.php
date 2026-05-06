@extends('layouts.user')
@section('title', 'Portfolio — XVolty Trade')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
  <h3 class="fw-heading mb-0">My Portfolio</h3>
  <span class="badge bg-warning text-dark fs-6"><i class="fa-solid fa-trophy me-1"></i>Unranked</span>
</div>

<!-- Wallet Overview -->
<div class="row g-3 mb-4">
      <div class="col-md-4">
      <div class="card border-themed h-100">
        <div class="card-body d-flex align-items-center gap-3">
          <span class="xvt-avatar lg" style="background:#10b98122;color:#10b981;"><i class="fa-solid fa-wallet"></i></span>
          <div>
            <div class="text-muted small">Active Wallet</div>
            <h5 class="fw-bold mb-0">$436.50</h5>
          </div>
        </div>
      </div>
    </div>
      <div class="col-md-4">
      <div class="card border-themed h-100">
        <div class="card-body d-flex align-items-center gap-3">
          <span class="xvt-avatar lg" style="background:#087E8B22;color:#087E8B;"><i class="fa-solid fa-chart-line"></i></span>
          <div>
            <div class="text-muted small">ROI Wallet</div>
            <h5 class="fw-bold mb-0">$15.00</h5>
          </div>
        </div>
      </div>
    </div>
      <div class="col-md-4">
      <div class="card border-themed h-100">
        <div class="card-body d-flex align-items-center gap-3">
          <span class="xvt-avatar lg" style="background:#f59e0b22;color:#f59e0b;"><i class="fa-solid fa-lock"></i></span>
          <div>
            <div class="text-muted small">Inactive Wallet</div>
            <h5 class="fw-bold mb-0">$0.00</h5>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Summary Row -->
<div class="row g-3 mb-4">
  <div class="col-6 col-lg-3">
    <div class="card border-themed h-100"><div class="card-body text-center">
      <div class="text-muted small">Total Invested</div>
      <h4 class="fw-bold mb-0">$521.00</h4>
    </div></div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="card border-themed h-100"><div class="card-body text-center">
      <div class="text-muted small">Total Earned</div>
      <h4 class="fw-bold mb-0 text-success">$22.50</h4>
    </div></div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="card border-themed h-100"><div class="card-body text-center">
      <div class="text-muted small">Active Investments</div>
      <h4 class="fw-bold mb-0">2</h4>
    </div></div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="card border-themed h-100"><div class="card-body text-center">
      <div class="text-muted small">Total Withdrawn</div>
      <h4 class="fw-bold mb-0 text-warning">$66.50</h4>
    </div></div>
  </div>
</div>

<!-- Overall Cap Progress -->
  <div class="card border-themed mb-4">
    <div class="card-body">
      <div class="d-flex justify-content-between mb-1">
        <strong>Overall Earning Progress</strong>
        <span>2.2% ($22.50 / $1,042.00)</span>
      </div>
      <div class="progress" style="height:10px;">
        <div class="progress-bar bg-success" style="width:2.2%"></div>
      </div>
    </div>
  </div>

<!-- Investments Table -->
<div class="card border-themed">
  <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-cubes-stacked me-2"></i>Investment Details</h6></div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-sm table-hover mb-0">
        <thead>
          <tr><th>Package</th><th>Amount</th><th>ROI/Day</th><th>Earned</th><th>Cap</th><th>Progress</th><th>Status</th><th>Since</th></tr>
        </thead>
        <tbody>
                      <tr>
              <td class="fw-semibold">Starter Pack</td>
              <td>$21.00</td>
              <td class="text-info">$0.21</td>
              <td class="text-success">$0.00</td>
              <td>$42.00</td>
              <td style="min-width:110px;">
                <div class="progress" style="height:5px;"><div class="progress-bar bg-success" style="width:0%"></div></div>
                <small>0%</small>
              </td>
              <td><span class="badge bg-success">active</span></td>
              <td class="small">2026-05-01 10:38:14</td>
            </tr>
                      <tr>
              <td class="fw-semibold">Investor Pack</td>
              <td>$500.00</td>
              <td class="text-info">$5.00</td>
              <td class="text-success">$22.50</td>
              <td>$1,000.00</td>
              <td style="min-width:110px;">
                <div class="progress" style="height:5px;"><div class="progress-bar bg-success" style="width:2.3%"></div></div>
                <small>2.3%</small>
              </td>
              <td><span class="badge bg-success">active</span></td>
              <td class="small">2026-04-21 05:44:47</td>
            </tr>
                  </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
