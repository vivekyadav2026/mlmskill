@extends('layouts.admin')
@section('title', 'Investments — Admin — XVolty Trade')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
  <div>
    <h3 class="fw-heading mb-1">Investments</h3>
    <p class="text-muted mb-0 small">All user package activations with earning cap progress.</p>
  </div>
</div>

<!-- Stats -->
<div class="row g-3 mb-4">
  <div class="col-6 col-lg-3">
    <div class="card border-themed h-100"><div class="card-body text-center">
      <div class="text-muted small">Active Investments</div>
      <h3 class="fw-bold mb-0 text-success">7</h3>
    </div></div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="card border-themed h-100"><div class="card-body text-center">
      <div class="text-muted small">Capped</div>
      <h3 class="fw-bold mb-0 text-warning">1</h3>
    </div></div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="card border-themed h-100"><div class="card-body text-center">
      <div class="text-muted small">Total Invested</div>
      <h3 class="fw-bold mb-0">$5,684.00</h3>
    </div></div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="card border-themed h-100"><div class="card-body text-center">
      <div class="text-muted small">Total Earned</div>
      <h3 class="fw-bold mb-0">$218.76</h3>
    </div></div>
  </div>
</div>

<!-- Filter -->
<div class="mb-3 d-flex gap-2">
  <a href="{{ url('admin/investments') }}" class="btn btn-sm btn-primary">All</a>
  <a href="../admin/investments.html?status=active" class="btn btn-sm btn-outline-success">Active</a>
  <a href="../admin/investments.html?status=capped" class="btn btn-sm btn-outline-warning">Capped</a>
  <a href="../admin/investments.html?status=cancelled" class="btn btn-sm btn-outline-danger">Cancelled</a>
</div>

<!-- Table -->
<div class="card border-themed">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead>
          <tr>
            <th>#</th><th>User</th><th>Package</th><th>Invested</th><th>Earned</th><th>Cap</th><th>Progress</th><th>Status</th><th>Date</th>
          </tr>
        </thead>
        <tbody>
                      <tr>
              <td>1</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td>Starter Pack</td>
              <td>$21.00</td>
              <td>$0.00</td>
              <td>$42.00</td>
              <td style="min-width:120px;">
                <div class="progress" style="height:6px;">
                  <div class="progress-bar bg-success" style="width:0%"></div>
                </div>
                <small class="text-muted">0%</small>
              </td>
              <td>
                <span class="badge bg-success">active</span>              </td>
              <td class="small">2026-05-01 10:38:14</td>
            </tr>
                      <tr>
              <td>2</td>
              <td>
                <strong>XV152488</strong>
                <br><small class="text-muted">TestUser1</small>
              </td>
              <td>Beginner Pack</td>
              <td>$50.00</td>
              <td>$1.50</td>
              <td>$100.00</td>
              <td style="min-width:120px;">
                <div class="progress" style="height:6px;">
                  <div class="progress-bar bg-success" style="width:1.5%"></div>
                </div>
                <small class="text-muted">1.5%</small>
              </td>
              <td>
                <span class="badge bg-success">active</span>              </td>
              <td class="small">2026-04-25 09:06:00</td>
            </tr>
                      <tr>
              <td>3</td>
              <td>
                <strong>XV442258</strong>
                <br><small class="text-muted">POONAM SINGH</small>
              </td>
              <td>Beginner Pack</td>
              <td>$50.00</td>
              <td>$1.50</td>
              <td>$100.00</td>
              <td style="min-width:120px;">
                <div class="progress" style="height:6px;">
                  <div class="progress-bar bg-success" style="width:1.5%"></div>
                </div>
                <small class="text-muted">1.5%</small>
              </td>
              <td>
                <span class="badge bg-success">active</span>              </td>
              <td class="small">2026-04-24 08:38:41</td>
            </tr>
                      <tr>
              <td>4</td>
              <td>
                <strong>XV963517</strong>
                <br><small class="text-muted">erwerweerwerwer</small>
              </td>
              <td>Starter Pack</td>
              <td>$21.00</td>
              <td>$0.63</td>
              <td>$42.00</td>
              <td style="min-width:120px;">
                <div class="progress" style="height:6px;">
                  <div class="progress-bar bg-success" style="width:1.5%"></div>
                </div>
                <small class="text-muted">1.5%</small>
              </td>
              <td>
                <span class="badge bg-success">active</span>              </td>
              <td class="small">2026-04-22 10:56:39</td>
            </tr>
                      <tr>
              <td>5</td>
              <td>
                <strong>XV653796</strong>
                <br><small class="text-muted">werweqerweerweer</small>
              </td>
              <td>Starter Pack</td>
              <td>$21.00</td>
              <td>$0.63</td>
              <td>$42.00</td>
              <td style="min-width:120px;">
                <div class="progress" style="height:6px;">
                  <div class="progress-bar bg-success" style="width:1.5%"></div>
                </div>
                <small class="text-muted">1.5%</small>
              </td>
              <td>
                <span class="badge bg-success">active</span>              </td>
              <td class="small">2026-04-22 10:55:46</td>
            </tr>
                      <tr>
              <td>6</td>
              <td>
                <strong>XV430358</strong>
                <br><small class="text-muted">fdgfdgfdgd</small>
              </td>
              <td>Diamond Investor</td>
              <td>$5,000.00</td>
              <td>$150.00</td>
              <td>$10,000.00</td>
              <td style="min-width:120px;">
                <div class="progress" style="height:6px;">
                  <div class="progress-bar bg-success" style="width:1.5%"></div>
                </div>
                <small class="text-muted">1.5%</small>
              </td>
              <td>
                <span class="badge bg-success">active</span>              </td>
              <td class="small">2026-04-22 10:20:12</td>
            </tr>
                      <tr>
              <td>7</td>
              <td>
                <strong>XV152488</strong>
                <br><small class="text-muted">TestUser1</small>
              </td>
              <td>Starter Pack</td>
              <td>$21.00</td>
              <td>$42.00</td>
              <td>$42.00</td>
              <td style="min-width:120px;">
                <div class="progress" style="height:6px;">
                  <div class="progress-bar bg-danger" style="width:100%"></div>
                </div>
                <small class="text-muted">100%</small>
              </td>
              <td>
                <span class="badge bg-warning">capped</span>              </td>
              <td class="small">2026-04-22 10:13:17</td>
            </tr>
                      <tr>
              <td>8</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td>Investor Pack</td>
              <td>$500.00</td>
              <td>$22.50</td>
              <td>$1,000.00</td>
              <td style="min-width:120px;">
                <div class="progress" style="height:6px;">
                  <div class="progress-bar bg-success" style="width:2.3%"></div>
                </div>
                <small class="text-muted">2.3%</small>
              </td>
              <td>
                <span class="badge bg-success">active</span>              </td>
              <td class="small">2026-04-21 05:44:47</td>
            </tr>
                  </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
