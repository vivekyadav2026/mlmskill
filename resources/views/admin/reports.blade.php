@extends('layouts.admin')
@section('title', 'Reports — Admin — XVolty Trade')

@section('content')
<h3 class="fw-heading mb-4">Platform Reports</h3>

<!-- Overview Cards -->
<div class="row g-3 mb-4">
      <div class="col-6 col-lg-2">
      <div class="card border-themed h-100"><div class="card-body text-center py-3">
        <i class="fa-solid fa-users text-primary mb-1" style="font-size:1.2rem;"></i>
        <div class="text-muted small">Total Users</div>
        <h5 class="fw-bold mb-0">16</h5>
      </div></div>
    </div>
      <div class="col-6 col-lg-2">
      <div class="card border-themed h-100"><div class="card-body text-center py-3">
        <i class="fa-solid fa-user-check text-success mb-1" style="font-size:1.2rem;"></i>
        <div class="text-muted small">Active Users</div>
        <h5 class="fw-bold mb-0">6</h5>
      </div></div>
    </div>
      <div class="col-6 col-lg-2">
      <div class="card border-themed h-100"><div class="card-body text-center py-3">
        <i class="fa-solid fa-arrow-down text-info mb-1" style="font-size:1.2rem;"></i>
        <div class="text-muted small">Total Deposits</div>
        <h5 class="fw-bold mb-0">$217,103.00</h5>
      </div></div>
    </div>
      <div class="col-6 col-lg-2">
      <div class="card border-themed h-100"><div class="card-body text-center py-3">
        <i class="fa-solid fa-arrow-up text-warning mb-1" style="font-size:1.2rem;"></i>
        <div class="text-muted small">Total Withdrawals</div>
        <h5 class="fw-bold mb-0">$66.50</h5>
      </div></div>
    </div>
      <div class="col-6 col-lg-2">
      <div class="card border-themed h-100"><div class="card-body text-center py-3">
        <i class="fa-solid fa-coins text-danger mb-1" style="font-size:1.2rem;"></i>
        <div class="text-muted small">Total Invested</div>
        <h5 class="fw-bold mb-0">$5,684.00</h5>
      </div></div>
    </div>
      <div class="col-6 col-lg-2">
      <div class="card border-themed h-100"><div class="card-body text-center py-3">
        <i class="fa-solid fa-sack-dollar text-success mb-1" style="font-size:1.2rem;"></i>
        <div class="text-muted small">Total Incomes Paid</div>
        <h5 class="fw-bold mb-0">$218.76</h5>
      </div></div>
    </div>
  </div>

<div class="row g-4 mb-4">
  <!-- Income Breakdown -->
  <div class="col-lg-6">
    <div class="card border-themed h-100">
      <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-chart-pie me-2"></i>Income Breakdown</h6></div>
      <div class="card-body p-0">
        <table class="table table-sm mb-0">
          <thead><tr><th>Type</th><th class="text-end">Amount</th></tr></thead>
          <tbody>
                          <tr><td>Direct Bonus</td><td class="text-end fw-semibold">$5.00</td></tr>
                          <tr><td>Daily ROI</td><td class="text-end fw-semibold">$169.26</td></tr>
                          <tr><td>Level Income</td><td class="text-end fw-semibold">$44.50</td></tr>
                          <tr><td>Weekly Salary</td><td class="text-end fw-semibold">$0.00</td></tr>
                          <tr><td>Rank Reward</td><td class="text-end fw-semibold">$0.00</td></tr>
                      </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Top Earners -->
  <div class="col-lg-6">
    <div class="card border-themed h-100">
      <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-ranking-star me-2"></i>Top 10 Earners</h6></div>
      <div class="card-body p-0">
        <table class="table table-sm mb-0">
          <thead><tr><th>#</th><th>User</th><th class="text-end">Earned</th></tr></thead>
          <tbody>
                          <tr>
                <td>1</td>
                <td><strong>XV430358</strong> <small class="text-muted">fdgfdgfdgd</small></td>
                <td class="text-end fw-semibold text-success">$150.00</td>
              </tr>
                          <tr>
                <td>2</td>
                <td><strong>XV152488</strong> <small class="text-muted">TestUser1</small></td>
                <td class="text-end fw-semibold text-success">$43.50</td>
              </tr>
                          <tr>
                <td>3</td>
                <td><strong>XV000001</strong> <small class="text-muted">XVoltyTrade</small></td>
                <td class="text-end fw-semibold text-success">$22.50</td>
              </tr>
                          <tr>
                <td>4</td>
                <td><strong>XV442258</strong> <small class="text-muted">POONAM SINGH</small></td>
                <td class="text-end fw-semibold text-success">$1.50</td>
              </tr>
                          <tr>
                <td>5</td>
                <td><strong>XV653796</strong> <small class="text-muted">werweqerweerweer</small></td>
                <td class="text-end fw-semibold text-success">$0.63</td>
              </tr>
                          <tr>
                <td>6</td>
                <td><strong>XV963517</strong> <small class="text-muted">erwerweerwerwer</small></td>
                <td class="text-end fw-semibold text-success">$0.63</td>
              </tr>
                                  </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Level-Wise Income Breakdown -->
<div class="card border-themed mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h6 class="mb-0"><i class="fa-solid fa-layer-group me-2"></i>Level-Wise Income Breakdown (8-Level Sponsor Chain)</h6>
          <span class="badge bg-success">Enabled</span>
      </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-sm table-hover mb-0">
        <thead>
          <tr><th>Level</th><th>Rate</th><th class="text-center">Transactions</th><th class="text-end">Total Paid</th></tr>
        </thead>
        <tbody>
                      <tr>
              <td><span class="badge bg-primary">Level 1</span></td>
              <td>5%</td>
              <td class="text-center">1</td>
              <td class="text-end fw-semibold">$2.50</td>
            </tr>
                      <tr>
              <td><span class="badge bg-primary">Level 2</span></td>
              <td>4%</td>
              <td class="text-center">1</td>
              <td class="text-end fw-semibold">$42.00</td>
            </tr>
                      <tr>
              <td><span class="badge bg-primary">Level 3</span></td>
              <td>4%</td>
              <td class="text-center">0</td>
              <td class="text-end fw-semibold">$0.00</td>
            </tr>
                      <tr>
              <td><span class="badge bg-primary">Level 4</span></td>
              <td>3%</td>
              <td class="text-center">0</td>
              <td class="text-end fw-semibold">$0.00</td>
            </tr>
                      <tr>
              <td><span class="badge bg-primary">Level 5</span></td>
              <td>2%</td>
              <td class="text-center">0</td>
              <td class="text-end fw-semibold">$0.00</td>
            </tr>
                      <tr>
              <td><span class="badge bg-primary">Level 6</span></td>
              <td>2%</td>
              <td class="text-center">0</td>
              <td class="text-end fw-semibold">$0.00</td>
            </tr>
                      <tr>
              <td><span class="badge bg-primary">Level 7</span></td>
              <td>1%</td>
              <td class="text-center">0</td>
              <td class="text-end fw-semibold">$0.00</td>
            </tr>
                      <tr>
              <td><span class="badge bg-primary">Level 8</span></td>
              <td>1%</td>
              <td class="text-center">0</td>
              <td class="text-end fw-semibold">$0.00</td>
            </tr>
                  </tbody>
        <tfoot>
          <tr class="table-light">
            <td colspan="2" class="fw-bold">Total Level Income</td>
            <td></td>
            <td class="text-end fw-bold text-success">$44.50</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<!-- Cron Logs -->
<div class="card border-themed">
  <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-clock me-2"></i>Recent Cron Logs</h6></div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-sm table-hover mb-0">
        <thead><tr><th>Task</th><th>Status</th><th>Records</th><th>Started</th><th>Finished</th></tr></thead>
        <tbody>
                      <tr>
              <td class="fw-semibold">rank_reward</td>
              <td><span class="badge bg-danger">failed</span></td>
              <td class="text-center">0</td>
              <td class="small">2026-05-01 10:42:40</td>
              <td class="small">2026-05-01 10:42:40</td>
            </tr>
                      <tr>
              <td class="fw-semibold">rank_reward</td>
              <td><span class="badge bg-danger">failed</span></td>
              <td class="text-center">0</td>
              <td class="small">2026-05-01 10:41:36</td>
              <td class="small">2026-05-01 10:41:36</td>
            </tr>
                      <tr>
              <td class="fw-semibold">rank_reward</td>
              <td><span class="badge bg-danger">failed</span></td>
              <td class="text-center">0</td>
              <td class="small">2026-05-01 10:40:18</td>
              <td class="small">2026-05-01 10:40:18</td>
            </tr>
                      <tr>
              <td class="fw-semibold">rank_reward</td>
              <td><span class="badge bg-danger">failed</span></td>
              <td class="text-center">0</td>
              <td class="small">2026-05-01 10:35:54</td>
              <td class="small">2026-05-01 10:35:54</td>
            </tr>
                      <tr>
              <td class="fw-semibold">rank_reward</td>
              <td><span class="badge bg-danger">failed</span></td>
              <td class="text-center">0</td>
              <td class="small">2026-05-01 10:34:49</td>
              <td class="small">2026-05-01 10:34:49</td>
            </tr>
                      <tr>
              <td class="fw-semibold">rank_reward</td>
              <td><span class="badge bg-danger">failed</span></td>
              <td class="text-center">0</td>
              <td class="small">2026-05-01 10:33:48</td>
              <td class="small">2026-05-01 10:33:48</td>
            </tr>
                      <tr>
              <td class="fw-semibold">rank_reward</td>
              <td><span class="badge bg-danger">failed</span></td>
              <td class="text-center">0</td>
              <td class="small">2026-05-01 10:32:20</td>
              <td class="small">2026-05-01 10:32:20</td>
            </tr>
                      <tr>
              <td class="fw-semibold">rank_reward</td>
              <td><span class="badge bg-danger">failed</span></td>
              <td class="text-center">0</td>
              <td class="small">2026-05-01 10:31:21</td>
              <td class="small">2026-05-01 10:31:21</td>
            </tr>
                      <tr>
              <td class="fw-semibold">daily_roi</td>
              <td><span class="badge bg-success">success</span></td>
              <td class="text-center">6</td>
              <td class="small">2026-05-01 10:31:20</td>
              <td class="small">2026-05-01 10:31:21</td>
            </tr>
                      <tr>
              <td class="fw-semibold">rank_reward</td>
              <td><span class="badge bg-danger">failed</span></td>
              <td class="text-center">0</td>
              <td class="small">2026-04-29 11:00:54</td>
              <td class="small">2026-04-29 11:00:54</td>
            </tr>
                      <tr>
              <td class="fw-semibold">daily_roi</td>
              <td><span class="badge bg-success">success</span></td>
              <td class="text-center">6</td>
              <td class="small">2026-04-29 11:00:54</td>
              <td class="small">2026-04-29 11:00:54</td>
            </tr>
                      <tr>
              <td class="fw-semibold">rank_reward</td>
              <td><span class="badge bg-danger">failed</span></td>
              <td class="text-center">0</td>
              <td class="small">2026-04-26 01:24:45</td>
              <td class="small">2026-04-26 01:24:45</td>
            </tr>
                      <tr>
              <td class="fw-semibold">daily_roi</td>
              <td><span class="badge bg-success">success</span></td>
              <td class="text-center">0</td>
              <td class="small">2026-04-26 01:24:45</td>
              <td class="small">2026-04-26 01:24:45</td>
            </tr>
                      <tr>
              <td class="fw-semibold">rank_reward</td>
              <td><span class="badge bg-success">success</span></td>
              <td class="text-center">0</td>
              <td class="small">2026-04-25 10:35:57</td>
              <td class="small">2026-04-25 10:35:57</td>
            </tr>
                      <tr>
              <td class="fw-semibold">weekly_salary</td>
              <td><span class="badge bg-success">success</span></td>
              <td class="text-center">0</td>
              <td class="small">2026-04-25 10:35:57</td>
              <td class="small">2026-04-25 10:35:57</td>
            </tr>
                      <tr>
              <td class="fw-semibold">daily_roi</td>
              <td><span class="badge bg-success">success</span></td>
              <td class="text-center">6</td>
              <td class="small">2026-04-25 10:35:57</td>
              <td class="small">2026-04-25 10:35:57</td>
            </tr>
                  </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
