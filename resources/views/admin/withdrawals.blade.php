@extends('layouts.admin')
@section('title', 'Withdrawals — Admin — XVolty Trade')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
  <div>
    <h3 class="fw-heading mb-1">Withdrawals</h3>
    <p class="text-muted mb-0 small">Review and process user withdrawal requests.</p>
  </div>
</div>

<!-- Stats -->
<div class="row g-3 mb-4">
  <div class="col-6 col-lg-3">
    <div class="card border-themed h-100"><div class="card-body text-center">
      <div class="text-muted small">Pending</div>
      <h3 class="fw-bold mb-0 text-warning">0</h3>
    </div></div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="card border-themed h-100"><div class="card-body text-center">
      <div class="text-muted small">Approved</div>
      <h3 class="fw-bold mb-0 text-success">3</h3>
    </div></div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="card border-themed h-100"><div class="card-body text-center">
      <div class="text-muted small">Total Paid</div>
      <h3 class="fw-bold mb-0">$66.50</h3>
    </div></div>
  </div>
</div>

<!-- Filter -->
<div class="mb-3 d-flex gap-2">
  <a href="{{ url('admin/withdrawals') }}" class="btn btn-sm btn-primary">All</a>
  <a href="../admin/withdrawals.html?status=pending" class="btn btn-sm btn-outline-warning">Pending</a>
  <a href="../admin/withdrawals.html?status=approved" class="btn btn-sm btn-outline-success">Approved</a>
  <a href="../admin/withdrawals.html?status=rejected" class="btn btn-sm btn-outline-danger">Rejected</a>
</div>

<!-- Table -->
<div class="card border-themed">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead>
          <tr>
            <th>#</th><th>User</th><th>Amount</th><th>Charge</th><th>Net</th><th>Wallet</th><th>Status</th><th>Date</th><th>Actions</th>
          </tr>
        </thead>
        <tbody>
                      <tr>
              <td>1</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td>$29.00</td>
              <td>$1.45</td>
              <td class="fw-semibold">$27.55</td>
              <td><span class="badge bg-secondary">active wallet</span></td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-21 05:31:23</td>
              <td>
                                  <small class="text-muted"></small>
                              </td>
            </tr>
                      <tr>
              <td>2</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td>$29.00</td>
              <td>$1.45</td>
              <td class="fw-semibold">$27.55</td>
              <td><span class="badge bg-secondary">active wallet</span></td>
              <td>
                <span class="badge bg-danger">rejected</span>              </td>
              <td class="small">2026-04-21 05:28:05</td>
              <td>
                                  <small class="text-muted"></small>
                              </td>
            </tr>
                      <tr>
              <td>3</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td>$29.00</td>
              <td>$1.45</td>
              <td class="fw-semibold">$27.55</td>
              <td><span class="badge bg-secondary">active wallet</span></td>
              <td>
                <span class="badge bg-danger">rejected</span>              </td>
              <td class="small">2026-04-21 05:28:02</td>
              <td>
                                  <small class="text-muted"></small>
                              </td>
            </tr>
                      <tr>
              <td>4</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td>$29.00</td>
              <td>$1.45</td>
              <td class="fw-semibold">$27.55</td>
              <td><span class="badge bg-secondary">active wallet</span></td>
              <td>
                <span class="badge bg-danger">rejected</span>              </td>
              <td class="small">2026-04-21 05:27:48</td>
              <td>
                                  <small class="text-muted"></small>
                              </td>
            </tr>
                      <tr>
              <td>5</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td>$20.99</td>
              <td>$1.05</td>
              <td class="fw-semibold">$19.94</td>
              <td><span class="badge bg-secondary">active wallet</span></td>
              <td>
                <span class="badge bg-danger">rejected</span>              </td>
              <td class="small">2026-04-21 05:27:04</td>
              <td>
                                  <small class="text-muted">ok</small>
                              </td>
            </tr>
                      <tr>
              <td>6</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td>$20.99</td>
              <td>$1.05</td>
              <td class="fw-semibold">$19.94</td>
              <td><span class="badge bg-secondary">active wallet</span></td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-21 05:26:30</td>
              <td>
                                  <small class="text-muted">ok</small>
                              </td>
            </tr>
                      <tr>
              <td>7</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td>$20.01</td>
              <td>$1.00</td>
              <td class="fw-semibold">$19.01</td>
              <td><span class="badge bg-secondary">active wallet</span></td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-21 05:24:28</td>
              <td>
                                  <small class="text-muted">ok</small>
                              </td>
            </tr>
                      <tr>
              <td>8</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td>$100.00</td>
              <td>$5.00</td>
              <td class="fw-semibold">$95.00</td>
              <td><span class="badge bg-secondary">active wallet</span></td>
              <td>
                <span class="badge bg-danger">rejected</span>              </td>
              <td class="small">2026-04-21 05:21:16</td>
              <td>
                                  <small class="text-muted">rejected</small>
                              </td>
            </tr>
                  </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="wthModal" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <form method="POST">
      <input type="hidden" name="withdrawal_id" id="wthId">
      <input type="hidden" name="action" id="wthAction">
      <div class="modal-header">
        <h5 class="modal-title" id="wthTitle">Process Withdrawal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p id="wthDesc"></p>
        <div id="payoutInfo" class="mb-3"></div>
        <div class="mb-3">
          <label class="form-label">Admin Remark (optional)</label>
          <textarea name="admin_remark" class="form-control" rows="2"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn" id="wthSubmitBtn">Confirm</button>
      </div>
    </form>
  </div></div>
</div>

<script>
function openWthAction(id, action, userId, amount, payouts) {
  document.getElementById('wthId').value = id;
  document.getElementById('wthAction').value = action;
  const btn = document.getElementById('wthSubmitBtn');
  var payoutHtml = '';
  if (action === 'approve') {
    document.getElementById('wthTitle').textContent = 'Approve Withdrawal';
    document.getElementById('wthDesc').innerHTML = 'Pay <strong>$' + amount + '</strong> to <strong>' + userId + '</strong>?';
    btn.className = 'btn btn-success'; btn.textContent = 'Approve';
    if (payouts && payouts.length > 0) {
      payoutHtml = '<div class="card bg-body-secondary"><div class="card-body small"><h6 class="fw-semibold mb-2"><i class="fa-solid fa-wallet me-1"></i>User Payout Wallet</h6>';
      payouts.forEach(function(p) {
        payoutHtml += '<div class="mb-2">';
        payoutHtml += '<strong>' + p.wallet_name + '</strong> <span class="badge bg-info text-dark">' + p.network + '</span>';
        if (p.is_default == 1) payoutHtml += ' <span class="badge bg-success">Default</span>';
        payoutHtml += '<br><code style="word-break:break-all;">' + p.payout_address + '</code>';
        if (p.qr_image) payoutHtml += '<br><img src="../' + p.qr_image + '" class="img-thumbnail mt-1" style="max-width:80px;">';
        payoutHtml += '</div>';
      });
      payoutHtml += '</div></div>';
    } else {
      payoutHtml = '<div class="alert alert-warning small mb-0"><i class="fa-solid fa-exclamation-triangle me-1"></i> No payout wallet saved by this user.</div>';
    }
  } else {
    document.getElementById('wthTitle').textContent = 'Reject Withdrawal';
    document.getElementById('wthDesc').innerHTML = 'Reject withdrawal of <strong>$' + amount + '</strong> from <strong>' + userId + '</strong>? Amount will be refunded.';
    btn.className = 'btn btn-danger'; btn.textContent = 'Reject & Refund';
  }
  document.getElementById('payoutInfo').innerHTML = payoutHtml;
}
</script>
@endsection
