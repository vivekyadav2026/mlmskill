@extends('layouts.user')
@section('title', 'Invest — XVolty Trade')

@section('content')
<!-- Wallet Balance -->
<div class="card border-themed mb-4">
  <div class="card-body d-flex justify-content-between align-items-center">
    <div><i class="fa-solid fa-wallet me-2 text-success"></i> <strong>Active Wallet:</strong> $436.50</div>
    <a href="{{ url('user/deposit') }}" class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-plus me-1"></i>Add Funds</a>
  </div>
</div>

<!-- Available Packages -->
<h5 class="fw-heading mb-3"><i class="fa-solid fa-cubes-stacked me-2"></i>Available Packages</h5>
  <div class="row g-3 mb-4">
          <div class="col-md-6 col-lg-4">
        <div class="card border-themed h-100">
          <div class="card-body text-center">
            <div class="xvt-avatar lg mx-auto mb-2" style="background:#087E8B22;color:#087E8B;"><i class="fa-solid fa-gem"></i></div>
            <h5 class="fw-heading">Starter Pack</h5>
            <div class="text-muted small mb-2">
              $21.00            </div>
            <div class="mb-2">
              <span class="badge bg-info">ROI 1.0000% /day</span>
              <span class="badge bg-secondary">Cap 5.00x</span>
            </div>
            <button class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#investModal" onclick="openInvest(1, &#39;Starter Pack&#39;, 21)">
              <i class="fa-solid fa-coins me-1"></i> Invest Now
            </button>
          </div>
        </div>
      </div>
          <div class="col-md-6 col-lg-4">
        <div class="card border-themed h-100">
          <div class="card-body text-center">
            <div class="xvt-avatar lg mx-auto mb-2" style="background:#f59e0b22;color:#f59e0b;"><i class="fa-solid fa-gem"></i></div>
            <h5 class="fw-heading">Beginner Pack</h5>
            <div class="text-muted small mb-2">
              $50.00            </div>
            <div class="mb-2">
              <span class="badge bg-info">ROI 1.0000% /day</span>
              <span class="badge bg-secondary">Cap 5.00x</span>
            </div>
            <button class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#investModal" onclick="openInvest(2, &#39;Beginner Pack&#39;, 50)">
              <i class="fa-solid fa-coins me-1"></i> Invest Now
            </button>
          </div>
        </div>
      </div>
          <div class="col-md-6 col-lg-4">
        <div class="card border-themed h-100">
          <div class="card-body text-center">
            <div class="xvt-avatar lg mx-auto mb-2" style="background:#8b5cf622;color:#8b5cf6;"><i class="fa-solid fa-gem"></i></div>
            <h5 class="fw-heading">Learner Pack</h5>
            <div class="text-muted small mb-2">
              $100.00            </div>
            <div class="mb-2">
              <span class="badge bg-info">ROI 1.0000% /day</span>
              <span class="badge bg-secondary">Cap 5.00x</span>
            </div>
            <button class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#investModal" onclick="openInvest(3, &#39;Learner Pack&#39;, 100)">
              <i class="fa-solid fa-coins me-1"></i> Invest Now
            </button>
          </div>
        </div>
      </div>
          <div class="col-md-6 col-lg-4">
        <div class="card border-themed h-100">
          <div class="card-body text-center">
            <div class="xvt-avatar lg mx-auto mb-2" style="background:#ef444422;color:#ef4444;"><i class="fa-solid fa-gem"></i></div>
            <h5 class="fw-heading">Trader Pack</h5>
            <div class="text-muted small mb-2">
              $250.00            </div>
            <div class="mb-2">
              <span class="badge bg-info">ROI 1.0000% /day</span>
              <span class="badge bg-secondary">Cap 5.00x</span>
            </div>
            <button class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#investModal" onclick="openInvest(4, &#39;Trader Pack&#39;, 250)">
              <i class="fa-solid fa-coins me-1"></i> Invest Now
            </button>
          </div>
        </div>
      </div>
          <div class="col-md-6 col-lg-4">
        <div class="card border-themed h-100">
          <div class="card-body text-center">
            <div class="xvt-avatar lg mx-auto mb-2" style="background:#06BEE122;color:#06BEE1;"><i class="fa-solid fa-gem"></i></div>
            <h5 class="fw-heading">Investor Pack</h5>
            <div class="text-muted small mb-2">
              $500.00            </div>
            <div class="mb-2">
              <span class="badge bg-info">ROI 1.0000% /day</span>
              <span class="badge bg-secondary">Cap 5.00x</span>
            </div>
            <button class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#investModal" onclick="openInvest(5, &#39;Investor Pack&#39;, 500)">
              <i class="fa-solid fa-coins me-1"></i> Invest Now
            </button>
          </div>
        </div>
      </div>
          <div class="col-md-6 col-lg-4">
        <div class="card border-themed h-100">
          <div class="card-body text-center">
            <div class="xvt-avatar lg mx-auto mb-2" style="background:#10b98122;color:#10b981;"><i class="fa-solid fa-gem"></i></div>
            <h5 class="fw-heading">Pro Investor</h5>
            <div class="text-muted small mb-2">
              $1,000.00            </div>
            <div class="mb-2">
              <span class="badge bg-info">ROI 1.0000% /day</span>
              <span class="badge bg-secondary">Cap 5.00x</span>
            </div>
            <button class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#investModal" onclick="openInvest(6, &#39;Pro Investor&#39;, 1000)">
              <i class="fa-solid fa-coins me-1"></i> Invest Now
            </button>
          </div>
        </div>
      </div>
          <div class="col-md-6 col-lg-4">
        <div class="card border-themed h-100">
          <div class="card-body text-center">
            <div class="xvt-avatar lg mx-auto mb-2" style="background:#087E8B22;color:#087E8B;"><i class="fa-solid fa-gem"></i></div>
            <h5 class="fw-heading">Gold Investor</h5>
            <div class="text-muted small mb-2">
              $2,500.00            </div>
            <div class="mb-2">
              <span class="badge bg-info">ROI 1.0000% /day</span>
              <span class="badge bg-secondary">Cap 5.00x</span>
            </div>
            <button class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#investModal" onclick="openInvest(7, &#39;Gold Investor&#39;, 2500)">
              <i class="fa-solid fa-coins me-1"></i> Invest Now
            </button>
          </div>
        </div>
      </div>
          <div class="col-md-6 col-lg-4">
        <div class="card border-themed h-100">
          <div class="card-body text-center">
            <div class="xvt-avatar lg mx-auto mb-2" style="background:#f59e0b22;color:#f59e0b;"><i class="fa-solid fa-gem"></i></div>
            <h5 class="fw-heading">Diamond Investor</h5>
            <div class="text-muted small mb-2">
              $5,000.00            </div>
            <div class="mb-2">
              <span class="badge bg-info">ROI 1.0000% /day</span>
              <span class="badge bg-secondary">Cap 5.00x</span>
            </div>
            <button class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#investModal" onclick="openInvest(8, &#39;Diamond Investor&#39;, 5000)">
              <i class="fa-solid fa-coins me-1"></i> Invest Now
            </button>
          </div>
        </div>
      </div>
      </div>

<!-- My Activations -->
  <h5 class="fw-heading mb-3"><i class="fa-solid fa-chart-line me-2"></i>My Investments</h5>
  <div class="card border-themed">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-sm table-hover mb-0">
          <thead><tr><th>Package</th><th>Invested</th><th>Earned</th><th>Cap</th><th>Progress</th><th>Status</th><th>Date</th></tr></thead>
          <tbody>
                          <tr>
                <td class="fw-semibold">Starter Pack</td>
                <td>$21.00</td>
                <td>$0.00</td>
                <td>$42.00</td>
                <td style="min-width:100px;">
                  <div class="progress" style="height:5px;"><div class="progress-bar bg-success" style="width:0%"></div></div>
                  <small>0%</small>
                </td>
                <td><span class="badge bg-success">active</span></td>
                <td class="small">2026-05-01 10:38:14</td>
              </tr>
                          <tr>
                <td class="fw-semibold">Investor Pack</td>
                <td>$500.00</td>
                <td>$22.50</td>
                <td>$1,000.00</td>
                <td style="min-width:100px;">
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

<!-- Invest Modal -->
<div class="modal fade" id="investModal" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <form method="POST">
      <input type="hidden" name="package_id" id="investPkgId">
      <input type="hidden" name="wallet_source" value="active_wallet">
      <div class="modal-header">
        <h5 class="modal-title" id="investTitle">Invest</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p class="text-muted small">Investing from Active Wallet. Available: $436.50</p>
        <div class="mb-3">
          <label class="form-label">Amount ($) <span class="text-danger">*</span></label>
          <input type="number" name="amount" id="investAmt" step="0.01" class="form-control" required="">
          <div class="form-text" id="investRange"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-coins me-1"></i> Confirm Investment</button>
      </div>
    </form>
  </div></div>
</div>

<script>
function openInvest(pkgId, name, fixed) {
  document.getElementById('investPkgId').value = pkgId;
  document.getElementById('investTitle').textContent = 'Invest in ' + name;
  const amt = document.getElementById('investAmt');
  amt.min = fixed; amt.max = fixed; amt.value = fixed; amt.readOnly = true;
  document.getElementById('investRange').textContent = 'Fixed amount: $' + fixed.toLocaleString();
}
</script>
@endsection
