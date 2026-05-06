@extends('layouts.admin')
@section('title', 'Transactions — Admin — XVolty Trade')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
  <div>
    <h3 class="fw-heading mb-1">Income Ledger</h3>
    <p class="text-muted mb-0 small">Master ledger of all income transactions across all types.</p>
  </div>
</div>

<!-- Totals -->
<div class="row g-3 mb-4">
      <div class="col-6 col-lg">
      <div class="card border-themed h-100"><div class="card-body text-center">
        <i class="fa-solid fa-handshake mb-2" style="color:#10b981;font-size:1.3rem;"></i>
        <div class="text-muted small">Direct Bonus</div>
        <h5 class="fw-bold mb-0">$5.00</h5>
      </div></div>
    </div>
      <div class="col-6 col-lg">
      <div class="card border-themed h-100"><div class="card-body text-center">
        <i class="fa-solid fa-chart-line mb-2" style="color:#087E8B;font-size:1.3rem;"></i>
        <div class="text-muted small">Daily ROI</div>
        <h5 class="fw-bold mb-0">$169.26</h5>
      </div></div>
    </div>
      <div class="col-6 col-lg">
      <div class="card border-themed h-100"><div class="card-body text-center">
        <i class="fa-solid fa-layer-group mb-2" style="color:#f59e0b;font-size:1.3rem;"></i>
        <div class="text-muted small">Level Income</div>
        <h5 class="fw-bold mb-0">$44.50</h5>
      </div></div>
    </div>
      <div class="col-6 col-lg">
      <div class="card border-themed h-100"><div class="card-body text-center">
        <i class="fa-solid fa-money-bill-wave mb-2" style="color:#8b5cf6;font-size:1.3rem;"></i>
        <div class="text-muted small">Weekly Salary</div>
        <h5 class="fw-bold mb-0">$0.00</h5>
      </div></div>
    </div>
      <div class="col-6 col-lg">
      <div class="card border-themed h-100"><div class="card-body text-center">
        <i class="fa-solid fa-trophy mb-2" style="color:#ef4444;font-size:1.3rem;"></i>
        <div class="text-muted small">Rank Reward</div>
        <h5 class="fw-bold mb-0">$0.00</h5>
      </div></div>
    </div>
  </div>

<!-- Filter Bar -->
<div class="card border-themed mb-4">
  <div class="card-body py-2">
    <form class="row g-2 align-items-end" method="GET">
      <div class="col-auto">
        <select name="type" class="form-select form-select-sm">
          <option value="">All Types</option>
                      <option value="direct">Direct Bonus</option>
                      <option value="roi">Daily ROI</option>
                      <option value="level">Level Income</option>
                      <option value="salary">Weekly Salary</option>
                      <option value="rank_reward">Rank Reward</option>
                  </select>
      </div>
      <div class="col-auto">
        <input type="text" name="user" class="form-control form-control-sm" placeholder="User ID" value="">
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-sm btn-primary"><i class="fa-solid fa-filter me-1"></i>Filter</button>
        <a href="{{ url('admin/transactions') }}" class="btn btn-sm btn-outline-secondary">Clear</a>
      </div>
    </form>
  </div>
</div>

<!-- Table -->
<div class="card border-themed">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover table-sm mb-0">
        <thead>
          <tr>
            <th>#</th><th>User</th><th>Type</th><th>Amount</th><th>Source</th><th>Level</th><th>Wallet</th><th>Remarks</th><th>Date</th>
          </tr>
        </thead>
        <tbody>
                      <tr>
              <td>1</td>
              <td>
                <strong>XV442258</strong>
                <br><small class="text-muted">POONAM SINGH</small>
              </td>
              <td><span class="badge bg-info">roi</span></td>
              <td class="fw-semibold">$0.50</td>
              <td class="small">—</td>
              <td>—</td>
              <td><small>roi wallet</small></td>
              <td class="small" style="max-width:200px;">Daily ROI 1% for 2026-05-01</td>
              <td class="small">2026-05-01 10:31:21</td>
            </tr>
                      <tr>
              <td>2</td>
              <td>
                <strong>XV152488</strong>
                <br><small class="text-muted">TestUser1</small>
              </td>
              <td><span class="badge bg-info">roi</span></td>
              <td class="fw-semibold">$0.50</td>
              <td class="small">—</td>
              <td>—</td>
              <td><small>roi wallet</small></td>
              <td class="small" style="max-width:200px;">Daily ROI 1% for 2026-05-01</td>
              <td class="small">2026-05-01 10:31:21</td>
            </tr>
                      <tr>
              <td>3</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td><span class="badge bg-info">roi</span></td>
              <td class="fw-semibold">$5.00</td>
              <td class="small">—</td>
              <td>—</td>
              <td><small>roi wallet</small></td>
              <td class="small" style="max-width:200px;">Daily ROI 1% for 2026-05-01</td>
              <td class="small">2026-05-01 10:31:20</td>
            </tr>
                      <tr>
              <td>4</td>
              <td>
                <strong>XV430358</strong>
                <br><small class="text-muted">fdgfdgfdgd</small>
              </td>
              <td><span class="badge bg-info">roi</span></td>
              <td class="fw-semibold">$50.00</td>
              <td class="small">—</td>
              <td>—</td>
              <td><small>roi wallet</small></td>
              <td class="small" style="max-width:200px;">Daily ROI 1% for 2026-05-01</td>
              <td class="small">2026-05-01 10:31:20</td>
            </tr>
                      <tr>
              <td>5</td>
              <td>
                <strong>XV653796</strong>
                <br><small class="text-muted">werweqerweerweer</small>
              </td>
              <td><span class="badge bg-info">roi</span></td>
              <td class="fw-semibold">$0.21</td>
              <td class="small">—</td>
              <td>—</td>
              <td><small>roi wallet</small></td>
              <td class="small" style="max-width:200px;">Daily ROI 1% for 2026-05-01</td>
              <td class="small">2026-05-01 10:31:20</td>
            </tr>
                      <tr>
              <td>6</td>
              <td>
                <strong>XV963517</strong>
                <br><small class="text-muted">erwerweerwerwer</small>
              </td>
              <td><span class="badge bg-info">roi</span></td>
              <td class="fw-semibold">$0.21</td>
              <td class="small">—</td>
              <td>—</td>
              <td><small>roi wallet</small></td>
              <td class="small" style="max-width:200px;">Daily ROI 1% for 2026-05-01</td>
              <td class="small">2026-05-01 10:31:20</td>
            </tr>
                      <tr>
              <td>7</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td><span class="badge bg-info">roi</span></td>
              <td class="fw-semibold">$5.00</td>
              <td class="small">—</td>
              <td>—</td>
              <td><small>roi wallet</small></td>
              <td class="small" style="max-width:200px;">Daily ROI 1% for 2026-04-29</td>
              <td class="small">2026-04-29 11:00:54</td>
            </tr>
                      <tr>
              <td>8</td>
              <td>
                <strong>XV430358</strong>
                <br><small class="text-muted">fdgfdgfdgd</small>
              </td>
              <td><span class="badge bg-info">roi</span></td>
              <td class="fw-semibold">$50.00</td>
              <td class="small">—</td>
              <td>—</td>
              <td><small>roi wallet</small></td>
              <td class="small" style="max-width:200px;">Daily ROI 1% for 2026-04-29</td>
              <td class="small">2026-04-29 11:00:54</td>
            </tr>
                      <tr>
              <td>9</td>
              <td>
                <strong>XV653796</strong>
                <br><small class="text-muted">werweqerweerweer</small>
              </td>
              <td><span class="badge bg-info">roi</span></td>
              <td class="fw-semibold">$0.21</td>
              <td class="small">—</td>
              <td>—</td>
              <td><small>roi wallet</small></td>
              <td class="small" style="max-width:200px;">Daily ROI 1% for 2026-04-29</td>
              <td class="small">2026-04-29 11:00:54</td>
            </tr>
                      <tr>
              <td>10</td>
              <td>
                <strong>XV963517</strong>
                <br><small class="text-muted">erwerweerwerwer</small>
              </td>
              <td><span class="badge bg-info">roi</span></td>
              <td class="fw-semibold">$0.21</td>
              <td class="small">—</td>
              <td>—</td>
              <td><small>roi wallet</small></td>
              <td class="small" style="max-width:200px;">Daily ROI 1% for 2026-04-29</td>
              <td class="small">2026-04-29 11:00:54</td>
            </tr>
                      <tr>
              <td>11</td>
              <td>
                <strong>XV442258</strong>
                <br><small class="text-muted">POONAM SINGH</small>
              </td>
              <td><span class="badge bg-info">roi</span></td>
              <td class="fw-semibold">$0.50</td>
              <td class="small">—</td>
              <td>—</td>
              <td><small>roi wallet</small></td>
              <td class="small" style="max-width:200px;">Daily ROI 1% for 2026-04-29</td>
              <td class="small">2026-04-29 11:00:54</td>
            </tr>
                      <tr>
              <td>12</td>
              <td>
                <strong>XV152488</strong>
                <br><small class="text-muted">TestUser1</small>
              </td>
              <td><span class="badge bg-info">roi</span></td>
              <td class="fw-semibold">$0.50</td>
              <td class="small">—</td>
              <td>—</td>
              <td><small>roi wallet</small></td>
              <td class="small" style="max-width:200px;">Daily ROI 1% for 2026-04-29</td>
              <td class="small">2026-04-29 11:00:54</td>
            </tr>
                      <tr>
              <td>13</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td><span class="badge bg-info">roi</span></td>
              <td class="fw-semibold">$5.00</td>
              <td class="small">—</td>
              <td>—</td>
              <td><small>roi wallet</small></td>
              <td class="small" style="max-width:200px;">Daily ROI 1% for 2026-04-25</td>
              <td class="small">2026-04-25 10:35:57</td>
            </tr>
                      <tr>
              <td>14</td>
              <td>
                <strong>XV430358</strong>
                <br><small class="text-muted">fdgfdgfdgd</small>
              </td>
              <td><span class="badge bg-info">roi</span></td>
              <td class="fw-semibold">$50.00</td>
              <td class="small">—</td>
              <td>—</td>
              <td><small>roi wallet</small></td>
              <td class="small" style="max-width:200px;">Daily ROI 1% for 2026-04-25</td>
              <td class="small">2026-04-25 10:35:57</td>
            </tr>
                      <tr>
              <td>15</td>
              <td>
                <strong>XV653796</strong>
                <br><small class="text-muted">werweqerweerweer</small>
              </td>
              <td><span class="badge bg-info">roi</span></td>
              <td class="fw-semibold">$0.21</td>
              <td class="small">—</td>
              <td>—</td>
              <td><small>roi wallet</small></td>
              <td class="small" style="max-width:200px;">Daily ROI 1% for 2026-04-25</td>
              <td class="small">2026-04-25 10:35:57</td>
            </tr>
                      <tr>
              <td>16</td>
              <td>
                <strong>XV963517</strong>
                <br><small class="text-muted">erwerweerwerwer</small>
              </td>
              <td><span class="badge bg-info">roi</span></td>
              <td class="fw-semibold">$0.21</td>
              <td class="small">—</td>
              <td>—</td>
              <td><small>roi wallet</small></td>
              <td class="small" style="max-width:200px;">Daily ROI 1% for 2026-04-25</td>
              <td class="small">2026-04-25 10:35:57</td>
            </tr>
                      <tr>
              <td>17</td>
              <td>
                <strong>XV442258</strong>
                <br><small class="text-muted">POONAM SINGH</small>
              </td>
              <td><span class="badge bg-info">roi</span></td>
              <td class="fw-semibold">$0.50</td>
              <td class="small">—</td>
              <td>—</td>
              <td><small>roi wallet</small></td>
              <td class="small" style="max-width:200px;">Daily ROI 1% for 2026-04-25</td>
              <td class="small">2026-04-25 10:35:57</td>
            </tr>
                      <tr>
              <td>18</td>
              <td>
                <strong>XV152488</strong>
                <br><small class="text-muted">TestUser1</small>
              </td>
              <td><span class="badge bg-info">roi</span></td>
              <td class="fw-semibold">$0.50</td>
              <td class="small">—</td>
              <td>—</td>
              <td><small>roi wallet</small></td>
              <td class="small" style="max-width:200px;">Daily ROI 1% for 2026-04-25</td>
              <td class="small">2026-04-25 10:35:57</td>
            </tr>
                      <tr>
              <td>19</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td><span class="badge bg-success">direct</span></td>
              <td class="fw-semibold">$5.00</td>
              <td class="small">XV442258</td>
              <td>—</td>
              <td><small>active wallet</small></td>
              <td class="small" style="max-width:200px;">Direct bonus 10% on XV442258 activation of $50.00</td>
              <td class="small">2026-04-24 08:38:41</td>
            </tr>
                      <tr>
              <td>20</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td><span class="badge bg-warning">level</span></td>
              <td class="fw-semibold">$2.50</td>
              <td class="small">XV442258</td>
              <td>L1</td>
              <td><small>active wallet</small></td>
              <td class="small" style="max-width:200px;">Level 1 income (5%) from XV442258 activation of $50.00</td>
              <td class="small">2026-04-24 08:38:41</td>
            </tr>
                      <tr>
              <td>21</td>
              <td>
                <strong>XV152488</strong>
                <br><small class="text-muted">TestUser1</small>
              </td>
              <td><span class="badge bg-warning">level</span></td>
              <td class="fw-semibold">$42.00</td>
              <td class="small">XV430358</td>
              <td>L2</td>
              <td><small>active wallet</small></td>
              <td class="small" style="max-width:200px;">Level 2 income (4%) from XV430358 activation of $5,000.00</td>
              <td class="small">2026-04-22 10:20:12</td>
            </tr>
                  </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
