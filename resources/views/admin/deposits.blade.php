@extends('layouts.admin')
@section('title', 'Deposits — Admin — XVolty Trade')

@section('content')
<!-- Flash Messages -->

<div class="d-flex align-items-center justify-content-between mb-4">
  <div>
    <h3 class="fw-heading mb-1">Deposits</h3>
    <p class="text-muted mb-0 small">Review and process user deposit requests.</p>
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
      <h3 class="fw-bold mb-0 text-success">21</h3>
    </div></div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="card border-themed h-100"><div class="card-body text-center">
      <div class="text-muted small">Rejected</div>
      <h3 class="fw-bold mb-0 text-danger">0</h3>
    </div></div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="card border-themed h-100"><div class="card-body text-center">
      <div class="text-muted small">Total Approved</div>
      <h3 class="fw-bold mb-0">$217,103.00</h3>
    </div></div>
  </div>
</div>

<!-- Filter Buttons -->
<div class="mb-3 d-flex gap-2">
  <a href="{{ url('admin/deposits') }}" class="btn btn-sm btn-primary">All</a>
  <a href="../admin/deposits.html?status=pending" class="btn btn-sm btn-outline-warning">Pending</a>
  <a href="../admin/deposits.html?status=approved" class="btn btn-sm btn-outline-success">Approved</a>
  <a href="../admin/deposits.html?status=rejected" class="btn btn-sm btn-outline-danger">Rejected</a>
</div>

<!-- Deposits Table -->
<div class="card border-themed">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead>
          <tr>
            <th>#</th>
            <th>User</th>
            <th>Amount ($)</th>
            <th>Method</th>
            <th>Reference</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
                      <tr>
              <td>1</td>
              <td>
                <strong>XV442258</strong>
                <br><small class="text-muted">POONAM SINGH</small>
              </td>
              <td class="fw-semibold">$1,000.00</td>
              <td>crypto</td>
              <td class="small">test</td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-24 08:38:23</td>
              <td>
                                  <span class="text-muted">—</span>
                              </td>
            </tr>
                      <tr>
              <td>2</td>
              <td>
                <strong>XV298561</strong>
                <br><small class="text-muted">qdsaxzv cbz</small>
              </td>
              <td class="fw-semibold">$100.00</td>
              <td>crypto</td>
              <td class="small">fgtdgdfgdfgdfggdgs</td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:50:57</td>
              <td>
                                  <span class="text-muted">—</span>
                              </td>
            </tr>
                      <tr>
              <td>3</td>
              <td>
                <strong>XV963517</strong>
                <br><small class="text-muted">erwerweerwerwer</small>
              </td>
              <td class="fw-semibold">$100.00</td>
              <td>crypto</td>
              <td class="small">dfgdffgdfgdfgdfgfsdfg</td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:50:53</td>
              <td>
                                  <span class="text-muted">—</span>
                              </td>
            </tr>
                      <tr>
              <td>4</td>
              <td>
                <strong>XV226535</strong>
                <br><small class="text-muted">wteregvfdg</small>
              </td>
              <td class="fw-semibold">$100.00</td>
              <td>crypto</td>
              <td class="small">ertdfgsdffgdfgfdfgvcb</td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:50:49</td>
              <td>
                                  <span class="text-muted">—</span>
                              </td>
            </tr>
                      <tr>
              <td>5</td>
              <td>
                <strong>XV937656</strong>
                <br><small class="text-muted">rtyryhfrhgbfgh</small>
              </td>
              <td class="fw-semibold">$100.00</td>
              <td>crypto</td>
              <td class="small">eredgffdfgertgdfgergergtgtt</td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:50:46</td>
              <td>
                                  <span class="text-muted">—</span>
                              </td>
            </tr>
                      <tr>
              <td>6</td>
              <td>
                <strong>XV939801</strong>
                <br><small class="text-muted">ertertertert</small>
              </td>
              <td class="fw-semibold">$100.00</td>
              <td>crypto</td>
              <td class="small">e44rtfetfgdgfdg</td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:50:43</td>
              <td>
                                  <span class="text-muted">—</span>
                              </td>
            </tr>
                      <tr>
              <td>7</td>
              <td>
                <strong>XV906404</strong>
                <br><small class="text-muted">werwerwrwerwsdfsdf</small>
              </td>
              <td class="fw-semibold">$100.00</td>
              <td>crypto</td>
              <td class="small">er4fetfdfgdfgerter</td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:50:38</td>
              <td>
                                  <span class="text-muted">—</span>
                              </td>
            </tr>
                      <tr>
              <td>8</td>
              <td>
                <strong>XV698744</strong>
                <br><small class="text-muted">qwewqrwerwtert</small>
              </td>
              <td class="fw-semibold">$100.00</td>
              <td>crypto</td>
              <td class="small">erterrterrtdfbcvbvcxb</td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:50:35</td>
              <td>
                                  <span class="text-muted">—</span>
                              </td>
            </tr>
                      <tr>
              <td>9</td>
              <td>
                <strong>XV698744</strong>
                <br><small class="text-muted">qwewqrwerwtert</small>
              </td>
              <td class="fw-semibold">$100.00</td>
              <td>crypto</td>
              <td class="small">erterrterrtdfbcvbvcxb</td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:50:32</td>
              <td>
                                  <span class="text-muted">—</span>
                              </td>
            </tr>
                      <tr>
              <td>10</td>
              <td>
                <strong>XV406921</strong>
                <br><small class="text-muted">werwersfsdfwer</small>
              </td>
              <td class="fw-semibold">$100.00</td>
              <td>crypto</td>
              <td class="small">dgterwtgbcvbrgfsdfgfdfgdffgsdff</td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:50:29</td>
              <td>
                                  <span class="text-muted">—</span>
                              </td>
            </tr>
                      <tr>
              <td>11</td>
              <td>
                <strong>XV653796</strong>
                <br><small class="text-muted">werweqerweerweer</small>
              </td>
              <td class="fw-semibold">$100.00</td>
              <td>crypto</td>
              <td class="small">werwfdsfsfdsdfsf</td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:50:26</td>
              <td>
                                  <span class="text-muted">—</span>
                              </td>
            </tr>
                      <tr>
              <td>12</td>
              <td>
                <strong>XV430358</strong>
                <br><small class="text-muted">fdgfdgfdgd</small>
              </td>
              <td class="fw-semibold">$212,312.00</td>
              <td>crypto</td>
              <td class="small">sfsdffsfsfsfwerwevsdfsdffds</td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:19:51</td>
              <td>
                                  <span class="text-muted">—</span>
                              </td>
            </tr>
                      <tr>
              <td>13</td>
              <td>
                <strong>XV187153</strong>
                <br><small class="text-muted">qweqweqw</small>
              </td>
              <td class="fw-semibold">$500.00</td>
              <td>crypto</td>
              <td class="small">rurcfvhg bn8yyhk jmbn</td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:15:11</td>
              <td>
                                  <span class="text-muted">—</span>
                              </td>
            </tr>
                      <tr>
              <td>14</td>
              <td>
                <strong>XV187153</strong>
                <br><small class="text-muted">qweqweqw</small>
              </td>
              <td class="fw-semibold">$210.00</td>
              <td>crypto</td>
              <td class="small">88fyuvhgjrtfxsdcgtyfghcvtfyjgh</td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:15:08</td>
              <td>
                                  <span class="text-muted">—</span>
                              </td>
            </tr>
                      <tr>
              <td>15</td>
              <td>
                <strong>XV152488</strong>
                <br><small class="text-muted">TestUser1</small>
              </td>
              <td class="fw-semibold">$11.00</td>
              <td>crypto</td>
              <td class="small">ewwrefsdfsdfdstrrertefdsfsd</td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:12:42</td>
              <td>
                                  <span class="text-muted">—</span>
                              </td>
            </tr>
                      <tr>
              <td>16</td>
              <td>
                <strong>XV152488</strong>
                <br><small class="text-muted">TestUser1</small>
              </td>
              <td class="fw-semibold">$500.00</td>
              <td>crypto</td>
              <td class="small">324rwe234wecdsarew34wersdcdsrewt43</td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:12:39</td>
              <td>
                                  <span class="text-muted">—</span>
                              </td>
            </tr>
                      <tr>
              <td>17</td>
              <td>
                <strong>XV152488</strong>
                <br><small class="text-muted">TestUser1</small>
              </td>
              <td class="fw-semibold">$500.00</td>
              <td>crypto</td>
              <td class="small">tdryxfhcvbhnjyuitgfvbnm,</td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:09:32</td>
              <td>
                                  <span class="text-muted">—</span>
                              </td>
            </tr>
                      <tr>
              <td>18</td>
              <td>
                <strong>XV187153</strong>
                <br><small class="text-muted">qweqweqw</small>
              </td>
              <td class="fw-semibold">$50.00</td>
              <td>crypto</td>
              <td class="small">875t8y7uhtg9jbbvjhjhgjhjhjhjhv</td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:09:30</td>
              <td>
                                  <span class="text-muted">—</span>
                              </td>
            </tr>
                      <tr>
              <td>19</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td class="fw-semibold">$1,000.00</td>
              <td>crypto</td>
              <td class="small">test 2</td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-21 05:20:46</td>
              <td>
                                  <small class="text-muted">ok</small>
                              </td>
            </tr>
                      <tr>
              <td>20</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td class="fw-semibold">$10.00</td>
              <td>crypto</td>
              <td class="small">test user</td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-20 11:16:43</td>
              <td>
                                  <small class="text-muted">Test approve</small>
                              </td>
            </tr>
                      <tr>
              <td>21</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td class="fw-semibold">$10.00</td>
              <td>crypto</td>
              <td class="small">test user</td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-20 11:07:08</td>
              <td>
                                  <span class="text-muted">—</span>
                              </td>
            </tr>
                  </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Action Modal -->
<div class="modal fade" id="actionModal" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <form method="POST">
      <input type="hidden" name="deposit_id" id="actDepositId">
      <input type="hidden" name="action" id="actAction">
      <div class="modal-header">
        <h5 class="modal-title" id="actTitle">Process Deposit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p id="actDesc"></p>
        <div class="mb-3">
          <label class="form-label">Admin Remark (optional)</label>
          <textarea name="admin_remark" class="form-control" rows="2"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn" id="actSubmitBtn">Confirm</button>
      </div>
    </form>
  </div></div>
</div>

<script>
function openAction(id, action, userId, amount) {
  document.getElementById('actDepositId').value = id;
  document.getElementById('actAction').value = action;
  const btn = document.getElementById('actSubmitBtn');
  if (action === 'approve') {
    document.getElementById('actTitle').textContent = 'Approve Deposit';
    document.getElementById('actDesc').innerHTML = 'Approve <strong>$' + amount + '</strong> deposit from <strong>' + userId + '</strong>?';
    btn.className = 'btn btn-success';
    btn.textContent = 'Approve';
  } else {
    document.getElementById('actTitle').textContent = 'Reject Deposit';
    document.getElementById('actDesc').innerHTML = 'Reject <strong>$' + amount + '</strong> deposit from <strong>' + userId + '</strong>?';
    btn.className = 'btn btn-danger';
    btn.textContent = 'Reject';
  }
}
</script>
@endsection
