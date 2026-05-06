@extends('layouts.admin')
@section('title', 'Deposit Wallets — Admin — XVolty Trade')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
  <div>
    <h3 class="fw-heading mb-1">Deposit Wallets</h3>
    <p class="text-muted mb-0 small">Manage company wallets where users send USDT deposits.</p>
  </div>
  <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#walletModal" onclick="openCreate()">
    <i class="fa-solid fa-plus me-1"></i> Add Wallet
  </button>
</div>

<!-- Wallets Grid -->
<div class="row g-3 mb-4">
      <div class="col-md-6 col-xl-4">
      <div class="card border-themed h-100 opacity-50">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h6 class="mb-0">
            test 2                      </h6>
          <span class="badge bg-secondary">inactive</span>
        </div>
        <div class="card-body">
          <div class="mb-2">
            <small class="text-muted d-block">Network</small>
            <span class="badge bg-info text-dark">TRC20</span>
          </div>
          <div class="mb-2">
            <small class="text-muted d-block">Address</small>
            <code class="small user-select-all" style="word-break:break-all;">test wallet</code>
          </div>
                      <div class="mb-2">
              <img src="{{ asset('assets/Deposit Wallets — Admin — XVolty Trade_files/wqr_6355e5043c91622560f2a750d3e87762.png" alt="QR" class="img-thumbnail" style="max-width:120px;">
            </div>
                                <div class="mb-2">
              <small class="text-muted d-block">Instructions</small>
              <small>wallet 2</small>
            </div>
                  </div>
        <div class="card-footer d-flex gap-1 flex-wrap">
          <button class="btn btn-outline-primary btn-sm" onclick="openEdit({&quot;id&quot;:2,&quot;wallet_name&quot;:&quot;test 2&quot;,&quot;network&quot;:&quot;TRC20&quot;,&quot;wallet_address&quot;:&quot;test wallet&quot;,&quot;qr_image&quot;:&quot;uploads\/wallet_qr\/wqr_6355e5043c91622560f2a750d3e87762.png&quot;,&quot;instructions&quot;:&quot;wallet 2&quot;,&quot;is_default&quot;:0,&quot;status&quot;:&quot;inactive&quot;,&quot;created_at&quot;:&quot;2026-04-21 05:15:08&quot;,&quot;updated_at&quot;:&quot;2026-04-22 08:07:44&quot;})" data-bs-toggle="modal" data-bs-target="#walletModal">
            <i class="fa-solid fa-pen"></i> Edit
          </button>
          <form method="POST" class="d-inline">
            <input type="hidden" name="form_action" value="toggle">
            <input type="hidden" name="wallet_id" value="2">
            <button class="btn btn-outline-success btn-sm">
              <i class="fa-solid fa-play"></i>
              Enable            </button>
          </form>
                      <form method="POST" class="d-inline">
              <input type="hidden" name="form_action" value="set_default">
              <input type="hidden" name="wallet_id" value="2">
              <button class="btn btn-outline-success btn-sm"><i class="fa-solid fa-star"></i> Set Default</button>
            </form>
                  </div>
      </div>
    </div>
      <div class="col-md-6 col-xl-4">
      <div class="card border-themed h-100 ">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h6 class="mb-0">
            demo                      </h6>
          <span class="badge bg-success">active</span>
        </div>
        <div class="card-body">
          <div class="mb-2">
            <small class="text-muted d-block">Network</small>
            <span class="badge bg-info text-dark">BEP20</span>
          </div>
          <div class="mb-2">
            <small class="text-muted d-block">Address</small>
            <code class="small user-select-all" style="word-break:break-all;">test wallet</code>
          </div>
                      <div class="mb-2">
              <img src="{{ asset('assets/Deposit Wallets — Admin — XVolty Trade_files/wqr_d59159d304850f5d52da27549b37674a.png" alt="QR" class="img-thumbnail" style="max-width:120px;">
            </div>
                                <div class="mb-2">
              <small class="text-muted d-block">Instructions</small>
              <small>usdt send</small>
            </div>
                  </div>
        <div class="card-footer d-flex gap-1 flex-wrap">
          <button class="btn btn-outline-primary btn-sm" onclick="openEdit({&quot;id&quot;:1,&quot;wallet_name&quot;:&quot;demo&quot;,&quot;network&quot;:&quot;BEP20&quot;,&quot;wallet_address&quot;:&quot;test wallet&quot;,&quot;qr_image&quot;:&quot;uploads\/wallet_qr\/wqr_d59159d304850f5d52da27549b37674a.png&quot;,&quot;instructions&quot;:&quot;usdt send&quot;,&quot;is_default&quot;:0,&quot;status&quot;:&quot;active&quot;,&quot;created_at&quot;:&quot;2026-04-20 11:04:19&quot;,&quot;updated_at&quot;:&quot;2026-04-22 08:07:37&quot;})" data-bs-toggle="modal" data-bs-target="#walletModal">
            <i class="fa-solid fa-pen"></i> Edit
          </button>
          <form method="POST" class="d-inline">
            <input type="hidden" name="form_action" value="toggle">
            <input type="hidden" name="wallet_id" value="1">
            <button class="btn btn-outline-warning btn-sm">
              <i class="fa-solid fa-pause"></i>
              Disable            </button>
          </form>
                      <form method="POST" class="d-inline">
              <input type="hidden" name="form_action" value="set_default">
              <input type="hidden" name="wallet_id" value="1">
              <button class="btn btn-outline-success btn-sm"><i class="fa-solid fa-star"></i> Set Default</button>
            </form>
                  </div>
      </div>
    </div>
  </div>

<!-- Audit Log -->
<div class="card border-themed">
  <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-clock-rotate-left me-2"></i>Wallet Audit Log</h6></div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-sm table-hover mb-0">
        <thead><tr><th>Time</th><th>Actor</th><th>Action</th><th>Target</th><th>Details</th></tr></thead>
        <tbody>
                      <tr>
              <td class="small">2026-04-24 08:38:23</td>
              <td><span class="badge bg-secondary">admin:1</span></td>
              <td class="small">deposit_approved</td>
              <td class="small">deposit_requests#28</td>
              <td class="small text-truncate" style="max-width:200px;" title="">
                —              </td>
            </tr>
                      <tr>
              <td class="small">2026-04-22 10:50:57</td>
              <td><span class="badge bg-secondary">admin:1</span></td>
              <td class="small">deposit_approved</td>
              <td class="small">deposit_requests#18</td>
              <td class="small text-truncate" style="max-width:200px;" title="">
                —              </td>
            </tr>
                      <tr>
              <td class="small">2026-04-22 10:50:53</td>
              <td><span class="badge bg-secondary">admin:1</span></td>
              <td class="small">deposit_approved</td>
              <td class="small">deposit_requests#19</td>
              <td class="small text-truncate" style="max-width:200px;" title="">
                —              </td>
            </tr>
                      <tr>
              <td class="small">2026-04-22 10:50:49</td>
              <td><span class="badge bg-secondary">admin:1</span></td>
              <td class="small">deposit_approved</td>
              <td class="small">deposit_requests#20</td>
              <td class="small text-truncate" style="max-width:200px;" title="">
                —              </td>
            </tr>
                      <tr>
              <td class="small">2026-04-22 10:50:46</td>
              <td><span class="badge bg-secondary">admin:1</span></td>
              <td class="small">deposit_approved</td>
              <td class="small">deposit_requests#21</td>
              <td class="small text-truncate" style="max-width:200px;" title="">
                —              </td>
            </tr>
                      <tr>
              <td class="small">2026-04-22 10:50:43</td>
              <td><span class="badge bg-secondary">admin:1</span></td>
              <td class="small">deposit_approved</td>
              <td class="small">deposit_requests#22</td>
              <td class="small text-truncate" style="max-width:200px;" title="">
                —              </td>
            </tr>
                      <tr>
              <td class="small">2026-04-22 10:50:38</td>
              <td><span class="badge bg-secondary">admin:1</span></td>
              <td class="small">deposit_approved</td>
              <td class="small">deposit_requests#23</td>
              <td class="small text-truncate" style="max-width:200px;" title="">
                —              </td>
            </tr>
                      <tr>
              <td class="small">2026-04-22 10:50:35</td>
              <td><span class="badge bg-secondary">admin:1</span></td>
              <td class="small">deposit_approved</td>
              <td class="small">deposit_requests#25</td>
              <td class="small text-truncate" style="max-width:200px;" title="">
                —              </td>
            </tr>
                      <tr>
              <td class="small">2026-04-22 10:50:32</td>
              <td><span class="badge bg-secondary">admin:1</span></td>
              <td class="small">deposit_approved</td>
              <td class="small">deposit_requests#24</td>
              <td class="small text-truncate" style="max-width:200px;" title="">
                —              </td>
            </tr>
                      <tr>
              <td class="small">2026-04-22 10:50:29</td>
              <td><span class="badge bg-secondary">admin:1</span></td>
              <td class="small">deposit_approved</td>
              <td class="small">deposit_requests#26</td>
              <td class="small text-truncate" style="max-width:200px;" title="">
                —              </td>
            </tr>
                      <tr>
              <td class="small">2026-04-22 10:50:26</td>
              <td><span class="badge bg-secondary">admin:1</span></td>
              <td class="small">deposit_approved</td>
              <td class="small">deposit_requests#27</td>
              <td class="small text-truncate" style="max-width:200px;" title="">
                —              </td>
            </tr>
                      <tr>
              <td class="small">2026-04-22 10:19:51</td>
              <td><span class="badge bg-secondary">admin:1</span></td>
              <td class="small">deposit_approved</td>
              <td class="small">deposit_requests#17</td>
              <td class="small text-truncate" style="max-width:200px;" title="">
                —              </td>
            </tr>
                      <tr>
              <td class="small">2026-04-22 10:15:11</td>
              <td><span class="badge bg-secondary">admin:1</span></td>
              <td class="small">deposit_approved</td>
              <td class="small">deposit_requests#15</td>
              <td class="small text-truncate" style="max-width:200px;" title="">
                —              </td>
            </tr>
                      <tr>
              <td class="small">2026-04-22 10:15:08</td>
              <td><span class="badge bg-secondary">admin:1</span></td>
              <td class="small">deposit_approved</td>
              <td class="small">deposit_requests#16</td>
              <td class="small text-truncate" style="max-width:200px;" title="">
                —              </td>
            </tr>
                      <tr>
              <td class="small">2026-04-22 10:12:42</td>
              <td><span class="badge bg-secondary">admin:1</span></td>
              <td class="small">deposit_approved</td>
              <td class="small">deposit_requests#14</td>
              <td class="small text-truncate" style="max-width:200px;" title="">
                —              </td>
            </tr>
                      <tr>
              <td class="small">2026-04-22 10:12:39</td>
              <td><span class="badge bg-secondary">admin:1</span></td>
              <td class="small">deposit_approved</td>
              <td class="small">deposit_requests#13</td>
              <td class="small text-truncate" style="max-width:200px;" title="">
                —              </td>
            </tr>
                      <tr>
              <td class="small">2026-04-22 10:09:32</td>
              <td><span class="badge bg-secondary">admin:1</span></td>
              <td class="small">deposit_approved</td>
              <td class="small">deposit_requests#12</td>
              <td class="small text-truncate" style="max-width:200px;" title="">
                —              </td>
            </tr>
                      <tr>
              <td class="small">2026-04-22 10:09:30</td>
              <td><span class="badge bg-secondary">admin:1</span></td>
              <td class="small">deposit_approved</td>
              <td class="small">deposit_requests#11</td>
              <td class="small text-truncate" style="max-width:200px;" title="">
                —              </td>
            </tr>
                      <tr>
              <td class="small">2026-04-22 08:07:44</td>
              <td><span class="badge bg-secondary">admin:1</span></td>
              <td class="small">wallet_status_toggled</td>
              <td class="small">deposit_wallets#2</td>
              <td class="small text-truncate" style="max-width:200px;" title="">
                —              </td>
            </tr>
                      <tr>
              <td class="small">2026-04-22 08:07:37</td>
              <td><span class="badge bg-secondary">admin:1</span></td>
              <td class="small">wallet_status_toggled</td>
              <td class="small">deposit_wallets#1</td>
              <td class="small text-truncate" style="max-width:200px;" title="">
                —              </td>
            </tr>
                  </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Create/Edit Modal -->
<div class="modal fade" id="walletModal" tabindex="-1">
  <div class="modal-dialog modal-lg"><div class="modal-content">
    <form method="POST" enctype="multipart/form-data" id="walletForm">
      <input type="hidden" name="form_action" id="fAction" value="create">
      <input type="hidden" name="wallet_id" id="fWalletId" value="">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Add Deposit Wallet</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Wallet Name <span class="text-danger">*</span></label>
            <input type="text" name="wallet_name" id="fName" class="form-control" required="" placeholder="e.g. USDT Main Wallet">
          </div>
          <div class="col-md-6">
            <label class="form-label">Network <span class="text-danger">*</span></label>
            <select name="network" id="fNetwork" class="form-select">
              <option value="BEP20">BEP20 (BSC)</option>
              <option value="TRC20">TRC20 (Tron)</option>
              <option value="ERC20">ERC20 (Ethereum)</option>
              <option value="SOL">Solana</option>
              <option value="MATIC">Polygon</option>
              <option value="OTHER">Other</option>
            </select>
          </div>
          <div class="col-12">
            <label class="form-label">Wallet Address <span class="text-danger">*</span></label>
            <input type="text" name="wallet_address" id="fAddress" class="form-control font-monospace" required="" placeholder="0x...">
          </div>
          <div class="col-md-6">
            <label class="form-label">QR Code Image (JPG/PNG/WebP, max 3MB)</label>
            <input type="file" name="qr_image" accept="image/jpeg,image/png,image/webp" class="form-control">
            <div id="qrPreview" class="mt-2"></div>
          </div>
          <div class="col-md-3">
            <label class="form-label">Status</label>
            <select name="status" id="fStatus" class="form-select">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>
          <div class="col-md-3 d-flex align-items-end">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="is_default" value="1" id="fDefault">
              <label class="form-check-label" for="fDefault">Set as Default</label>
            </div>
          </div>
          <div class="col-12">
            <label class="form-label">Display Instructions</label>
            <textarea name="instructions" id="fInstructions" class="form-control" rows="3" placeholder="e.g. Send only USDT to this address. Minimum $10."></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" id="modalSubmitBtn">Create Wallet</button>
      </div>
    </form>
  </div></div>
</div>

<script>
function openCreate() {
  document.getElementById('fAction').value = 'create';
  document.getElementById('fWalletId').value = '';
  document.getElementById('fName').value = '';
  document.getElementById('fNetwork').value = 'BEP20';
  document.getElementById('fAddress').value = '';
  document.getElementById('fStatus').value = 'active';
  document.getElementById('fDefault').checked = false;
  document.getElementById('fInstructions').value = '';
  document.getElementById('qrPreview').innerHTML = '';
  document.getElementById('modalTitle').textContent = 'Add Deposit Wallet';
  document.getElementById('modalSubmitBtn').textContent = 'Create Wallet';
}

function openEdit(w) {
  document.getElementById('fAction').value = 'update';
  document.getElementById('fWalletId').value = w.id;
  document.getElementById('fName').value = w.wallet_name;
  document.getElementById('fNetwork').value = w.network;
  document.getElementById('fAddress').value = w.wallet_address;
  document.getElementById('fStatus').value = w.status;
  document.getElementById('fDefault').checked = !!parseInt(w.is_default);
  document.getElementById('fInstructions').value = w.instructions || '';
  document.getElementById('qrPreview').innerHTML = w.qr_image
    ? '<img src="../' + w.qr_image + '" class="img-thumbnail" style="max-width:100px;">'
    : '';
  document.getElementById('modalTitle').textContent = 'Edit Deposit Wallet';
  document.getElementById('modalSubmitBtn').textContent = 'Update Wallet';
}
</script>
@endsection
