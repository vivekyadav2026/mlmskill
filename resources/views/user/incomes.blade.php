@extends('layouts.user')
@section('title', 'My Incomes — XVolty Trade')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
  <div>
    <h3 class="fw-heading mb-0">My Incomes</h3>
    <p class="text-muted small mb-0">Track all your earnings across income types.</p>
  </div>
  <div class="h4 fw-bold text-success mb-0">$22.50</div>
</div>

<!-- Income Type Cards -->
<div class="row g-3 mb-4">
      <div class="col-6 col-lg">
      <a href="../user/incomes.html?tab=direct" class="card border-themed h-100 text-decoration-none ">
        <div class="card-body text-center py-3">
          <i class="fa-solid fa-handshake mb-1" style="color:#10b981;font-size:1.2rem;"></i>
          <div class="text-muted small">Direct Bonus</div>
          <h6 class="fw-bold mb-0">$5.00</h6>
        </div>
      </a>
    </div>
      <div class="col-6 col-lg">
      <a href="../user/incomes.html?tab=roi" class="card border-themed h-100 text-decoration-none ">
        <div class="card-body text-center py-3">
          <i class="fa-solid fa-chart-line mb-1" style="color:#087E8B;font-size:1.2rem;"></i>
          <div class="text-muted small">Daily ROI</div>
          <h6 class="fw-bold mb-0">$15.00</h6>
        </div>
      </a>
    </div>
      <div class="col-6 col-lg">
      <a href="../user/incomes.html?tab=level" class="card border-themed h-100 text-decoration-none ">
        <div class="card-body text-center py-3">
          <i class="fa-solid fa-layer-group mb-1" style="color:#f59e0b;font-size:1.2rem;"></i>
          <div class="text-muted small">Level Income</div>
          <h6 class="fw-bold mb-0">$2.50</h6>
        </div>
      </a>
    </div>
      <div class="col-6 col-lg">
      <a href="../user/incomes.html?tab=salary" class="card border-themed h-100 text-decoration-none ">
        <div class="card-body text-center py-3">
          <i class="fa-solid fa-money-bill-wave mb-1" style="color:#8b5cf6;font-size:1.2rem;"></i>
          <div class="text-muted small">Weekly Salary</div>
          <h6 class="fw-bold mb-0">$0.00</h6>
        </div>
      </a>
    </div>
      <div class="col-6 col-lg">
      <a href="../user/incomes.html?tab=rank_reward" class="card border-themed h-100 text-decoration-none ">
        <div class="card-body text-center py-3">
          <i class="fa-solid fa-trophy mb-1" style="color:#ef4444;font-size:1.2rem;"></i>
          <div class="text-muted small">Rank Reward</div>
          <h6 class="fw-bold mb-0">$0.00</h6>
        </div>
      </a>
    </div>
  </div>

<!-- 8-Level Income Structure -->
<div class="card border-themed mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h6 class="mb-0"><i class="fa-solid fa-layer-group me-2"></i>8-Level Sponsor Chain Income Structure</h6>
          <span class="badge bg-success">Active</span>
      </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-sm mb-0 text-center">
        <thead>
          <tr>
            <th>Level</th>
                          <th>L1</th>
                          <th>L2</th>
                          <th>L3</th>
                          <th>L4</th>
                          <th>L5</th>
                          <th>L6</th>
                          <th>L7</th>
                          <th>L8</th>
                      </tr>
        </thead>
        <tbody>
          <tr>
            <td class="fw-semibold text-muted">Rate</td>
                          <td><span class="badge bg-primary">5%</span></td>
                          <td><span class="badge bg-primary">4%</span></td>
                          <td><span class="badge bg-primary">4%</span></td>
                          <td><span class="badge bg-primary">3%</span></td>
                          <td><span class="badge bg-primary">2%</span></td>
                          <td><span class="badge bg-primary">2%</span></td>
                          <td><span class="badge bg-primary">1%</span></td>
                          <td><span class="badge bg-primary">1%</span></td>
                      </tr>
          <tr>
            <td class="fw-semibold text-muted">Earned</td>
                          <td class="fw-semibold text-success">$2.50</td>
                          <td class="fw-semibold text-success">$0.00</td>
                          <td class="fw-semibold text-success">$0.00</td>
                          <td class="fw-semibold text-success">$0.00</td>
                          <td class="fw-semibold text-success">$0.00</td>
                          <td class="fw-semibold text-success">$0.00</td>
                          <td class="fw-semibold text-success">$0.00</td>
                          <td class="fw-semibold text-success">$0.00</td>
                      </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Tab Nav -->
<ul class="nav nav-pills mb-3">
  <li class="nav-item"><a class="nav-link active" href="../user/incomes.html?tab=all">All</a></li>
      <li class="nav-item"><a class="nav-link " href="../user/incomes.html?tab=direct">Direct Bonus</a></li>
      <li class="nav-item"><a class="nav-link " href="../user/incomes.html?tab=roi">Daily ROI</a></li>
      <li class="nav-item"><a class="nav-link " href="../user/incomes.html?tab=level">Level Income</a></li>
      <li class="nav-item"><a class="nav-link " href="../user/incomes.html?tab=salary">Weekly Salary</a></li>
      <li class="nav-item"><a class="nav-link " href="../user/incomes.html?tab=rank_reward">Rank Reward</a></li>
  </ul>

<!-- Table -->
<div class="card border-themed">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-sm table-hover mb-0">
        <thead>
          <tr><th>#</th><th>Type</th><th>Amount</th><th>From</th><th>Level</th><th>Wallet</th><th>Remarks</th><th>Date</th></tr>
        </thead>
        <tbody>
                      <tr>
              <td>1</td>
              <td><span class="badge bg-info">roi</span></td>
              <td class="fw-semibold">$5.00</td>
              <td class="small">
                —              </td>
              <td>—</td>
              <td class="small">roi wallet</td>
              <td class="small" style="max-width:180px;">Daily ROI 1% for 2026-05-01</td>
              <td class="small">2026-05-01 10:31:20</td>
            </tr>
                      <tr>
              <td>2</td>
              <td><span class="badge bg-info">roi</span></td>
              <td class="fw-semibold">$5.00</td>
              <td class="small">
                —              </td>
              <td>—</td>
              <td class="small">roi wallet</td>
              <td class="small" style="max-width:180px;">Daily ROI 1% for 2026-04-29</td>
              <td class="small">2026-04-29 11:00:54</td>
            </tr>
                      <tr>
              <td>3</td>
              <td><span class="badge bg-info">roi</span></td>
              <td class="fw-semibold">$5.00</td>
              <td class="small">
                —              </td>
              <td>—</td>
              <td class="small">roi wallet</td>
              <td class="small" style="max-width:180px;">Daily ROI 1% for 2026-04-25</td>
              <td class="small">2026-04-25 10:35:57</td>
            </tr>
                      <tr>
              <td>4</td>
              <td><span class="badge bg-success">direct</span></td>
              <td class="fw-semibold">$5.00</td>
              <td class="small">
                                  XV442258                  <br><span class="text-muted">POONAM SINGH</span>                              </td>
              <td>—</td>
              <td class="small">active wallet</td>
              <td class="small" style="max-width:180px;">Direct bonus 10% on XV442258 activation of $50.00</td>
              <td class="small">2026-04-24 08:38:41</td>
            </tr>
                      <tr>
              <td>5</td>
              <td><span class="badge bg-warning">level</span></td>
              <td class="fw-semibold">$2.50</td>
              <td class="small">
                                  XV442258                  <br><span class="text-muted">POONAM SINGH</span>                              </td>
              <td>L1</td>
              <td class="small">active wallet</td>
              <td class="small" style="max-width:180px;">Level 1 income (5%) from XV442258 activation of $50.00</td>
              <td class="small">2026-04-24 08:38:41</td>
            </tr>
                  </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
