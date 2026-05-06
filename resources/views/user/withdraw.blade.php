@extends('layouts.user')
@section('title', 'Withdraw — XVolty Trade')

@section('content')
<div class="row g-4">
  <!-- Wallet Balances -->
  <div class="col-lg-4">
    <div class="card border-themed mb-3">
      <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-wallet me-2"></i>Your Wallets</h6></div>
      <div class="card-body">
        <div class="d-flex justify-content-between mb-2">
          <span>Active Wallet</span>
          <strong class="text-success">$436.50</strong>
        </div>
        <div class="d-flex justify-content-between mb-2">
          <span>ROI Wallet</span>
          <strong class="text-info">$15.00</strong>
        </div>
        <div class="d-flex justify-content-between">
          <span>Inactive Wallet</span>
          <strong class="text-warning">$0.00</strong>
        </div>
        <hr>
        <div class="small text-muted">
          <i class="fa-solid fa-info-circle me-1"></i>
          Withdrawal charge: <strong>5%</strong>. Min: $20.00        </div>
      </div>
    </div>

    <!-- Withdraw Form -->
    <div class="card border-themed">
      <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-arrow-up me-2"></i>Request Withdrawal</h6></div>
      <div class="card-body">
                <!-- Payout Wallet Preview -->
        <div class="card bg-body-secondary mb-3">
          <div class="card-body small">
            <div class="d-flex justify-content-between align-items-center mb-1">
              <h6 class="fw-semibold mb-0"><i class="fa-solid fa-wallet me-1"></i>Payout To</h6>
              <a href="{{ url('user/payout-wallet') }}" class="btn btn-outline-primary btn-sm py-0 px-2"><i class="fa-solid fa-pen me-1"></i>Change</a>
            </div>
            <div><strong>My Wallet</strong> <span class="badge bg-info text-dark">ERC20</span></div>
            <code class="small" style="word-break:break-all;">test</code>
          </div>
        </div>
        <form method="POST">
          <input type="hidden" name="payout_wallet_id" value="3">
          <div class="mb-3">
            <label class="form-label">Select Wallet <span class="text-danger">*</span></label>
            <select name="wallet_source" class="form-select" id="walletSelect" required="">
              <option value="active_wallet">Active Wallet ($436.50)</option>
              <option value="roi_wallet">ROI Wallet ($15.00)</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Amount ($) <span class="text-danger">*</span></label>
            <input type="number" name="amount" min="20" step="0.01" class="form-control" id="wthAmount" required="">
          </div>
          <div class="mb-3">
            <div class="d-flex justify-content-between small text-muted">
              <span>Charge (5%)</span>
              <span id="chargeDisplay">$0.00</span>
            </div>
            <div class="d-flex justify-content-between small fw-semibold">
              <span>You'll Receive</span>
              <span id="netDisplay">$0.00</span>
            </div>
          </div>
          <button type="submit" class="btn btn-warning w-100"><i class="fa-solid fa-paper-plane me-1"></i> Submit Withdrawal</button>
        </form>
              </div>
    </div>
  </div>

  <!-- History -->
  <div class="col-lg-8">
    <div class="card border-themed">
      <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-clock-rotate-left me-2"></i>Withdrawal History</h6></div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-sm table-hover mb-0">
            <thead><tr><th>Amount</th><th>Charge</th><th>Net</th><th>Wallet</th><th>Status</th><th>Date</th></tr></thead>
            <tbody>
                              <tr>
                  <td>$29.00</td>
                  <td>$1.45</td>
                  <td class="fw-semibold">$27.55</td>
                  <td class="small">active wallet</td>
                  <td><span class="badge bg-success">approved</span></td>
                  <td class="small">2026-04-21 05:31:23</td>
                </tr>
                              <tr>
                  <td>$29.00</td>
                  <td>$1.45</td>
                  <td class="fw-semibold">$27.55</td>
                  <td class="small">active wallet</td>
                  <td><span class="badge bg-danger">rejected</span></td>
                  <td class="small">2026-04-21 05:28:05</td>
                </tr>
                              <tr>
                  <td>$29.00</td>
                  <td>$1.45</td>
                  <td class="fw-semibold">$27.55</td>
                  <td class="small">active wallet</td>
                  <td><span class="badge bg-danger">rejected</span></td>
                  <td class="small">2026-04-21 05:28:02</td>
                </tr>
                              <tr>
                  <td>$29.00</td>
                  <td>$1.45</td>
                  <td class="fw-semibold">$27.55</td>
                  <td class="small">active wallet</td>
                  <td><span class="badge bg-danger">rejected</span></td>
                  <td class="small">2026-04-21 05:27:48</td>
                </tr>
                              <tr>
                  <td>$20.99</td>
                  <td>$1.05</td>
                  <td class="fw-semibold">$19.94</td>
                  <td class="small">active wallet</td>
                  <td><span class="badge bg-danger">rejected</span></td>
                  <td class="small">2026-04-21 05:27:04</td>
                </tr>
                              <tr>
                  <td>$20.99</td>
                  <td>$1.05</td>
                  <td class="fw-semibold">$19.94</td>
                  <td class="small">active wallet</td>
                  <td><span class="badge bg-success">approved</span></td>
                  <td class="small">2026-04-21 05:26:30</td>
                </tr>
                              <tr>
                  <td>$20.01</td>
                  <td>$1.00</td>
                  <td class="fw-semibold">$19.01</td>
                  <td class="small">active wallet</td>
                  <td><span class="badge bg-success">approved</span></td>
                  <td class="small">2026-04-21 05:24:28</td>
                </tr>
                              <tr>
                  <td>$100.00</td>
                  <td>$5.00</td>
                  <td class="fw-semibold">$95.00</td>
                  <td class="small">active wallet</td>
                  <td><span class="badge bg-danger">rejected</span></td>
                  <td class="small">2026-04-21 05:21:16</td>
                </tr>
                          </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
(function(){
  const amt = document.getElementById('wthAmount');
  const rate = 5;
  amt.addEventListener('input', function(){
    const a = parseFloat(this.value) || 0;
    const c = Math.round(a * rate) / 100;
    document.getElementById('chargeDisplay').textContent = '$' + c.toFixed(2);
    document.getElementById('netDisplay').textContent = '$' + (a - c).toFixed(2);
  });
})();
</script>
@endsection
