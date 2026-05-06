@extends('layouts.user')
@section('title', 'Deposit — XVolty Trade')

@section('content')
<div class="row g-4">

  <!-- ── Deposit Wallet Info ── -->
  <div class="col-lg-5">
        <div class="card border-themed mb-3">
      <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-wallet me-2"></i>Send USDT Here</h6></div>
      <div class="card-body text-center">
                  <img src="{{ asset('assets/Deposit — XVolty Trade_files/wqr_d59159d304850f5d52da27549b37674a.png" alt="QR Code" class="img-thumbnail mb-3" style="max-width:200px;">
                <div class="mb-2">
          <span class="badge bg-info text-dark">BEP20</span>
          <span class="fw-semibold ms-1">demo</span>
        </div>
        <div class="input-group mb-2">
          <input type="text" class="form-control form-control-sm font-monospace text-center" value="test wallet" id="walletAddr" readonly="">
          <button class="btn btn-outline-primary btn-sm" onclick="copyAddress()" title="Copy address"><i class="fa-solid fa-copy"></i></button>
        </div>
        <small class="text-muted" id="copyMsg"></small>
                  <div class="alert alert-info small mt-3 mb-0 text-start">
            <i class="fa-solid fa-info-circle me-1"></i> usdt send          </div>
              </div>
    </div>
    
      </div>

  <!-- ── Deposit Form ── -->
  <div class="col-lg-7">
    <div class="card border-themed mb-3">
      <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-arrow-down me-2"></i>Submit Deposit</h6></div>
      <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Amount ($) <span class="text-danger">*</span></label>
              <input type="number" name="amount" min="10" step="0.01" class="form-control" required="" placeholder="Min $10">
            </div>
            <div class="col-md-6">
              <label class="form-label">Deposit Wallet <span class="text-danger">*</span></label>
              <select name="wallet_id" class="form-select" required="">
                                  <option value="1">
                    demo (BEP20)                  </option>
                              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Transaction Hash (TXID) <span class="text-danger">*</span></label>
              <input type="text" name="tx_hash" class="form-control font-monospace" required="" placeholder="e.g. 0xabc123...">
            </div>
            <div class="col-12">
              <label class="form-label">Receipt Screenshot (JPG/PNG/WebP, max 3MB)</label>
              <input type="file" name="receipt_image" accept="image/jpeg,image/png,image/webp" class="form-control">
            </div>
          </div>
          <button type="submit" class="btn btn-primary w-100 mt-3"><i class="fa-solid fa-paper-plane me-1"></i> Submit Deposit Request</button>
        </form>
              </div>
    </div>

    <!-- Deposit History -->
    <div class="card border-themed">
      <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-clock-rotate-left me-2"></i>Deposit History</h6></div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-sm table-hover mb-0">
            <thead><tr><th>Amount</th><th>Wallet</th><th>TX Hash</th><th>Status</th><th>Date</th></tr></thead>
            <tbody>
                              <tr>
                  <td class="fw-semibold">$1,000.00</td>
                  <td class="small">test 2 <span class="badge bg-info text-dark">TRC20</span></td>
                  <td class="small"><code title="test 2">test 2…</code></td>
                  <td><span class="badge bg-success">approved</span></td>
                  <td class="small">2026-04-21 05:20:20</td>
                </tr>
                              <tr>
                  <td class="fw-semibold">$1,000.00</td>
                  <td class="small">test 2 <span class="badge bg-info text-dark">TRC20</span></td>
                  <td class="small"><code title="test">test…</code></td>
                  <td><span class="badge bg-danger">rejected</span></td>
                  <td class="small">2026-04-21 05:19:10</td>
                </tr>
                              <tr>
                  <td class="fw-semibold">$10.00</td>
                  <td class="small">demo <span class="badge bg-info text-dark">BEP20</span></td>
                  <td class="small"><code title="test user">test user…</code></td>
                  <td><span class="badge bg-danger">rejected</span></td>
                  <td class="small">2026-04-20 11:24:05</td>
                </tr>
                              <tr>
                  <td class="fw-semibold">$10.00</td>
                  <td class="small">demo <span class="badge bg-info text-dark">BEP20</span></td>
                  <td class="small"><code title="test user">test user…</code></td>
                  <td><span class="badge bg-danger">rejected</span></td>
                  <td class="small">2026-04-20 11:20:53</td>
                </tr>
                              <tr>
                  <td class="fw-semibold">$10.00</td>
                  <td class="small">demo <span class="badge bg-info text-dark">BEP20</span></td>
                  <td class="small"><code title="test user">test user…</code></td>
                  <td><span class="badge bg-danger">rejected</span></td>
                  <td class="small">2026-04-20 11:17:42</td>
                </tr>
                              <tr>
                  <td class="fw-semibold">$10.00</td>
                  <td class="small">demo <span class="badge bg-info text-dark">BEP20</span></td>
                  <td class="small"><code title="test user">test user…</code></td>
                  <td><span class="badge bg-success">approved</span></td>
                  <td class="small">2026-04-20 11:13:33</td>
                </tr>
                              <tr>
                  <td class="fw-semibold">$10.00</td>
                  <td class="small">demo <span class="badge bg-info text-dark">BEP20</span></td>
                  <td class="small"><code title="test user">test user…</code></td>
                  <td><span class="badge bg-danger">rejected</span></td>
                  <td class="small">2026-04-20 11:07:22</td>
                </tr>
                              <tr>
                  <td class="fw-semibold">$10.00</td>
                  <td class="small">demo <span class="badge bg-info text-dark">BEP20</span></td>
                  <td class="small"><code title="test user">test user…</code></td>
                  <td><span class="badge bg-success">approved</span></td>
                  <td class="small">2026-04-20 11:06:31</td>
                </tr>
                              <tr>
                  <td class="fw-semibold">$10.00</td>
                  <td class="small">demo <span class="badge bg-info text-dark">BEP20</span></td>
                  <td class="small"><code title="test user">test user…</code></td>
                  <td><span class="badge bg-danger">rejected</span></td>
                  <td class="small">2026-04-20 11:05:54</td>
                </tr>
                          </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function copyAddress() {
  var addr = document.getElementById('walletAddr');
  navigator.clipboard.writeText(addr.value).then(function() {
    document.getElementById('copyMsg').textContent = 'Address copied!';
    setTimeout(function() { document.getElementById('copyMsg').textContent = ''; }, 2000);
  });
}
</script>
@endsection
