@extends('layouts.admin')
@section('title', 'Payout Wallet Directory — Admin — XVolty Trade')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
  <div>
    <h3 class="fw-heading mb-1">Payout Wallet Directory</h3>
    <p class="text-muted mb-0 small">2 users have saved payout wallets.</p>
  </div>
  <form class="d-flex gap-2" method="GET">
    <input type="text" name="user" class="form-control form-control-sm" placeholder="Search by User ID" value="" style="min-width:180px;">
    <button class="btn btn-primary btn-sm"><i class="fa-solid fa-search"></i></button>
      </form>
</div>

<div class="card border-themed">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead>
          <tr>
            <th>#</th><th>User</th><th>Label</th><th>Network</th><th>Payout Address</th><th>QR</th><th>Default</th><th>Status</th><th>Created</th><th>Action</th>
          </tr>
        </thead>
        <tbody>
                      <tr>
              <td>1</td>
              <td>
                <strong>XV152488</strong>
                <br><small class="text-muted">TestUser1</small>
              </td>
              <td>My Wallet</td>
              <td><span class="badge bg-info text-dark">ERC20</span></td>
              <td><code class="small user-select-all" style="word-break:break-all;">qwesadcz2312qwesadasdc3</code></td>
              <td>
                                  <a href="{{ asset('assets/Payout Wallet Directory — Admin — XVolty Trade_files/pqr_54096468ad36a470c518f3ebe237fb88.png" target="_blank">
                    <img src="{{ asset('assets/Payout Wallet Directory — Admin — XVolty Trade_files/pqr_54096468ad36a470c518f3ebe237fb88.png" alt="QR" class="img-thumbnail" style="max-width:50px;">
                  </a>
                              </td>
              <td><i class="fa-solid fa-star text-warning"></i></td>
              <td><span class="badge bg-success">verified</span></td>
              <td class="small">2026-04-22 08:01:24</td>
              <td>
                <form method="POST" class="d-inline">
                  <input type="hidden" name="wallet_id" value="5">
                  <input type="hidden" name="return_user" value="">
                                      <input type="hidden" name="action" value="unverify">
                    <button type="submit" class="btn btn-outline-secondary btn-sm">Mark Unverified</button>
                                  </form>
              </td>
            </tr>
                      <tr>
              <td>2</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td>My Wallet</td>
              <td><span class="badge bg-info text-dark">ERC20</span></td>
              <td><code class="small user-select-all" style="word-break:break-all;">test</code></td>
              <td>
                                  <a href="{{ asset('assets/Payout Wallet Directory — Admin — XVolty Trade_files/pqr_0df9a2229d506bdb78cc8cc755417b3c.png" target="_blank">
                    <img src="{{ asset('assets/Payout Wallet Directory — Admin — XVolty Trade_files/pqr_0df9a2229d506bdb78cc8cc755417b3c.png" alt="QR" class="img-thumbnail" style="max-width:50px;">
                  </a>
                              </td>
              <td><i class="fa-solid fa-star text-warning"></i></td>
              <td><span class="badge bg-success">verified</span></td>
              <td class="small">2026-04-21 05:24:12</td>
              <td>
                <form method="POST" class="d-inline">
                  <input type="hidden" name="wallet_id" value="3">
                  <input type="hidden" name="return_user" value="">
                                      <input type="hidden" name="action" value="unverify">
                    <button type="submit" class="btn btn-outline-secondary btn-sm">Mark Unverified</button>
                                  </form>
              </td>
            </tr>
                  </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
