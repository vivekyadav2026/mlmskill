@extends('layouts.user')
@section('title', 'My Payout Wallet — XVolty Trade')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
  <div>
    <h3 class="fw-heading mb-1">My Payout Wallet</h3>
    <p class="text-muted mb-0 small">Save your withdrawal wallet address. Admin will use this to send payouts.</p>
  </div>
  <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#pwModal" onclick="openPwCreate()">
    <i class="fa-solid fa-plus me-1"></i> Add Wallet
  </button>
</div>

<!-- Saved Wallets -->
<div class="row g-3 mb-4">
      <div class="col-md-6 col-xl-4">
      <div class="card border-themed h-100">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h6 class="mb-0">
            My Wallet            <span class="badge bg-success ms-1">Default</span>          </h6>
          <span class="badge bg-success">verified</span>
        </div>
        <div class="card-body">
          <div class="mb-2">
            <small class="text-muted d-block">Network</small>
            <span class="badge bg-info text-dark">ERC20</span>
          </div>
          <div class="mb-2">
            <small class="text-muted d-block">Payout Address</small>
            <code class="small user-select-all" style="word-break:break-all;">test</code>
          </div>
                      <div class="mb-2">
              <img src="{{ asset('assets/My Payout Wallet — XVolty Trade_files/pqr_0df9a2229d506bdb78cc8cc755417b3c.png" alt="QR" class="img-thumbnail" style="max-width:100px;">
            </div>
                  </div>
        <div class="card-footer d-flex gap-1">
          <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#pwModal" onclick="openPwEdit({&quot;id&quot;:3,&quot;user_id&quot;:&quot;XV000001&quot;,&quot;wallet_name&quot;:&quot;My Wallet&quot;,&quot;network&quot;:&quot;ERC20&quot;,&quot;payout_address&quot;:&quot;test&quot;,&quot;qr_image&quot;:&quot;uploads\/payout_qr\/pqr_0df9a2229d506bdb78cc8cc755417b3c.png&quot;,&quot;is_default&quot;:1,&quot;verified_status&quot;:&quot;verified&quot;,&quot;created_at&quot;:&quot;2026-04-21 05:24:12&quot;,&quot;updated_at&quot;:&quot;2026-04-21 06:36:08&quot;})">
            <i class="fa-solid fa-pen"></i> Edit
          </button>
          <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="openPwDelete(3)">
            <i class="fa-solid fa-trash"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

<!-- Add/Edit Modal -->
<div class="modal fade" id="pwModal" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <form method="POST" enctype="multipart/form-data" id="pwForm">
      <input type="hidden" name="form_action" id="pwAction" value="create">
      <input type="hidden" name="wallet_id" id="pwId" value="">
      <div class="modal-header">
        <h5 class="modal-title" id="pwTitle">Add Payout Wallet</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Wallet Label</label>
          <input type="text" name="wallet_name" id="pwName" class="form-control" placeholder="e.g. My Trust Wallet" value="My Wallet">
        </div>
        <div class="mb-3">
          <label class="form-label">Network <span class="text-danger">*</span></label>
          <select name="network" id="pwNetwork" class="form-select">
            <option value="BEP20">BEP20 (BSC)</option>
            <option value="TRC20">TRC20 (Tron)</option>
            <option value="ERC20">ERC20 (Ethereum)</option>
            <option value="SOL">Solana</option>
            <option value="MATIC">Polygon</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Wallet Address <span class="text-danger">*</span></label>
          <input type="text" name="payout_address" id="pwAddress" class="form-control font-monospace" required="" placeholder="0x...">
        </div>
        <div class="mb-3">
          <label class="form-label">QR Code Image (optional, JPG/PNG/WebP)</label>
          <input type="file" name="qr_image" accept="image/jpeg,image/png,image/webp" class="form-control">
          <div id="pwQrPreview" class="mt-2"></div>
        </div>
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" name="is_default" value="1" id="pwDefault" checked="">
          <label class="form-check-label" for="pwDefault">Set as Default</label>
        </div>
        <hr>
        <div class="mb-0">
          <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
          <input type="password" name="confirm_password" class="form-control" required="" placeholder="Enter your login password">
          <small class="text-muted">Required for security when changing payout details.</small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" id="pwSubmitBtn">Save Wallet</button>
      </div>
    </form>
  </div></div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <form method="POST">
      <input type="hidden" name="form_action" value="delete">
      <input type="hidden" name="wallet_id" id="delWalletId">
      <div class="modal-header">
        <h5 class="modal-title">Delete Payout Wallet</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to remove this payout wallet?</p>
        <div class="mb-0">
          <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
          <input type="password" name="confirm_password" class="form-control" required="">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger">Delete</button>
      </div>
    </form>
  </div></div>
</div>

<script>
function openPwCreate() {
  document.getElementById('pwAction').value = 'create';
  document.getElementById('pwId').value = '';
  document.getElementById('pwName').value = 'My Wallet';
  document.getElementById('pwNetwork').value = 'BEP20';
  document.getElementById('pwAddress').value = '';
  document.getElementById('pwDefault').checked = true;
  document.getElementById('pwQrPreview').innerHTML = '';
  document.getElementById('pwTitle').textContent = 'Add Payout Wallet';
  document.getElementById('pwSubmitBtn').textContent = 'Save Wallet';
}
function openPwEdit(w) {
  document.getElementById('pwAction').value = 'update';
  document.getElementById('pwId').value = w.id;
  document.getElementById('pwName').value = w.wallet_name;
  document.getElementById('pwNetwork').value = w.network;
  document.getElementById('pwAddress').value = w.payout_address;
  document.getElementById('pwDefault').checked = !!parseInt(w.is_default);
  document.getElementById('pwQrPreview').innerHTML = w.qr_image
    ? '<img src="../' + w.qr_image + '" class="img-thumbnail" style="max-width:80px;">'
    : '';
  document.getElementById('pwTitle').textContent = 'Edit Payout Wallet';
  document.getElementById('pwSubmitBtn').textContent = 'Update Wallet';
}
function openPwDelete(id) {
  document.getElementById('delWalletId').value = id;
}
</script>
@endsection
