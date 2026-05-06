@extends('layouts.admin')
@section('title', 'Deposit Requests — Admin — XVolty Trade')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
  <div>
    <h3 class="fw-heading mb-1">Deposit Requests</h3>
    <p class="text-muted mb-0 small">Verify TXID and approve or reject user crypto deposits.</p>
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
      <h3 class="fw-bold mb-0 text-danger">6</h3>
    </div></div>
  </div>
</div>

<!-- Filter Tabs -->
<div class="mb-3 d-flex gap-2">
  <a href="{{ url('admin/deposit-requests') }}" class="btn btn-sm btn-primary">All</a>
  <a href="../admin/deposit-requests.html?status=pending" class="btn btn-sm btn-outline-warning">Pending</a>
  <a href="../admin/deposit-requests.html?status=approved" class="btn btn-sm btn-outline-success">Approved</a>
  <a href="../admin/deposit-requests.html?status=rejected" class="btn btn-sm btn-outline-danger">Rejected</a>
</div>

<!-- Table -->
<div class="card border-themed">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead>
          <tr>
            <th>#</th><th>User</th><th>Wallet</th><th>Network</th><th>Amount</th>
            <th>TX Hash</th><th>Receipt</th><th>Status</th><th>Date</th><th>Actions</th>
          </tr>
        </thead>
        <tbody>
                      <tr>
              <td>1</td>
              <td>
                <strong>XV442258</strong>
                <br><small class="text-muted">POONAM SINGH</small>
              </td>
              <td class="small">demo</td>
              <td><span class="badge bg-info text-dark">BEP20</span></td>
              <td class="fw-semibold">$1,000.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="test">test…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_48ef9a4b9cb740881295fc9cc44098fb.png" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-24 08:36:23</td>
              <td>
                                  <small class="text-muted"></small>
                              </td>
            </tr>
                      <tr>
              <td>2</td>
              <td>
                <strong>XV653796</strong>
                <br><small class="text-muted">werweqerweerweer</small>
              </td>
              <td class="small">demo</td>
              <td><span class="badge bg-info text-dark">BEP20</span></td>
              <td class="fw-semibold">$100.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="werwfdsfsfdsdfsf">werwfdsfsfdsdfsf…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_1edcd8b9c1afe372bc4653955be733c4.jpg" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:48:54</td>
              <td>
                                  <small class="text-muted"></small>
                              </td>
            </tr>
                      <tr>
              <td>3</td>
              <td>
                <strong>XV406921</strong>
                <br><small class="text-muted">werwersfsdfwer</small>
              </td>
              <td class="small">demo</td>
              <td><span class="badge bg-info text-dark">BEP20</span></td>
              <td class="fw-semibold">$100.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="dgterwtgbcvbrgfsdfgfdfgdffgsdff">dgterwtgbcvbrgfs…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_fda4f4e86ec121e1ee21e866f7606dae.jpg" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:47:36</td>
              <td>
                                  <small class="text-muted"></small>
                              </td>
            </tr>
                      <tr>
              <td>4</td>
              <td>
                <strong>XV698744</strong>
                <br><small class="text-muted">qwewqrwerwtert</small>
              </td>
              <td class="small">demo</td>
              <td><span class="badge bg-info text-dark">BEP20</span></td>
              <td class="fw-semibold">$100.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="erterrterrtdfbcvbvcxb">erterrterrtdfbcv…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_947f2c72376d542da7314019edf15363.jpg" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:47:19</td>
              <td>
                                  <small class="text-muted"></small>
                              </td>
            </tr>
                      <tr>
              <td>5</td>
              <td>
                <strong>XV698744</strong>
                <br><small class="text-muted">qwewqrwerwtert</small>
              </td>
              <td class="small">demo</td>
              <td><span class="badge bg-info text-dark">BEP20</span></td>
              <td class="fw-semibold">$100.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="erterrterrtdfbcvbvcxb">erterrterrtdfbcv…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_f0075ceeb1d1387755e531cc74e4000f.jpg" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:47:19</td>
              <td>
                                  <small class="text-muted"></small>
                              </td>
            </tr>
                      <tr>
              <td>6</td>
              <td>
                <strong>XV906404</strong>
                <br><small class="text-muted">werwerwrwerwsdfsdf</small>
              </td>
              <td class="small">demo</td>
              <td><span class="badge bg-info text-dark">BEP20</span></td>
              <td class="fw-semibold">$100.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="er4fetfdfgdfgerter">er4fetfdfgdfgert…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_8de3d9329f68389fadff917770c1ddff.jpg" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:46:59</td>
              <td>
                                  <small class="text-muted"></small>
                              </td>
            </tr>
                      <tr>
              <td>7</td>
              <td>
                <strong>XV939801</strong>
                <br><small class="text-muted">ertertertert</small>
              </td>
              <td class="small">demo</td>
              <td><span class="badge bg-info text-dark">BEP20</span></td>
              <td class="fw-semibold">$100.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="e44rtfetfgdgfdg">e44rtfetfgdgfdg…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_7c4d678976d1213e43635493ebfa6a4f.jpg" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:46:05</td>
              <td>
                                  <small class="text-muted"></small>
                              </td>
            </tr>
                      <tr>
              <td>8</td>
              <td>
                <strong>XV937656</strong>
                <br><small class="text-muted">rtyryhfrhgbfgh</small>
              </td>
              <td class="small">demo</td>
              <td><span class="badge bg-info text-dark">BEP20</span></td>
              <td class="fw-semibold">$100.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="eredgffdfgertgdfgergergtgtt">eredgffdfgertgdf…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_abb64d5966f55dd691d01a14db010e98.jpg" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:45:52</td>
              <td>
                                  <small class="text-muted"></small>
                              </td>
            </tr>
                      <tr>
              <td>9</td>
              <td>
                <strong>XV226535</strong>
                <br><small class="text-muted">wteregvfdg</small>
              </td>
              <td class="small">demo</td>
              <td><span class="badge bg-info text-dark">BEP20</span></td>
              <td class="fw-semibold">$100.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="ertdfgsdffgdfgfdfgvcb">ertdfgsdffgdfgfd…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_05812429303dc58104dbb58dc7fb7935.jpg" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:45:36</td>
              <td>
                                  <small class="text-muted"></small>
                              </td>
            </tr>
                      <tr>
              <td>10</td>
              <td>
                <strong>XV963517</strong>
                <br><small class="text-muted">erwerweerwerwer</small>
              </td>
              <td class="small">demo</td>
              <td><span class="badge bg-info text-dark">BEP20</span></td>
              <td class="fw-semibold">$100.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="dfgdffgdfgdfgdfgfsdfg">dfgdffgdfgdfgdfg…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_55b4d52e647d95fde637bbf386662240.jpg" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:45:20</td>
              <td>
                                  <small class="text-muted"></small>
                              </td>
            </tr>
                      <tr>
              <td>11</td>
              <td>
                <strong>XV298561</strong>
                <br><small class="text-muted">qdsaxzv cbz</small>
              </td>
              <td class="small">demo</td>
              <td><span class="badge bg-info text-dark">BEP20</span></td>
              <td class="fw-semibold">$100.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="fgtdgdfgdfgdfggdgs">fgtdgdfgdfgdfggd…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_02230c5c5436964926e103891b187c56.jpg" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:45:03</td>
              <td>
                                  <small class="text-muted"></small>
                              </td>
            </tr>
                      <tr>
              <td>12</td>
              <td>
                <strong>XV430358</strong>
                <br><small class="text-muted">fdgfdgfdgd</small>
              </td>
              <td class="small">demo</td>
              <td><span class="badge bg-info text-dark">BEP20</span></td>
              <td class="fw-semibold">$212,312.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="sfsdffsfsfsfwerwevsdfsdffds">sfsdffsfsfsfwerw…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_abe6fb4c21a238cf567e8420a101829d.jpg" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:18:26</td>
              <td>
                                  <small class="text-muted"></small>
                              </td>
            </tr>
                      <tr>
              <td>13</td>
              <td>
                <strong>XV187153</strong>
                <br><small class="text-muted">qweqweqw</small>
              </td>
              <td class="small">demo</td>
              <td><span class="badge bg-info text-dark">BEP20</span></td>
              <td class="fw-semibold">$210.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="88fyuvhgjrtfxsdcgtyfghcvtfyjgh">88fyuvhgjrtfxsdc…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_5faeb9ac77b4ac3fa56126edb98fa0bf.jpg" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:14:53</td>
              <td>
                                  <small class="text-muted"></small>
                              </td>
            </tr>
                      <tr>
              <td>14</td>
              <td>
                <strong>XV187153</strong>
                <br><small class="text-muted">qweqweqw</small>
              </td>
              <td class="small">demo</td>
              <td><span class="badge bg-info text-dark">BEP20</span></td>
              <td class="fw-semibold">$500.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="rurcfvhg bn8yyhk jmbn">rurcfvhg bn8yyhk…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_080fc102cc9adb2a84dae48ba365dc00.jpg" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:14:40</td>
              <td>
                                  <small class="text-muted"></small>
                              </td>
            </tr>
                      <tr>
              <td>15</td>
              <td>
                <strong>XV152488</strong>
                <br><small class="text-muted">TestUser1</small>
              </td>
              <td class="small">demo</td>
              <td><span class="badge bg-info text-dark">BEP20</span></td>
              <td class="fw-semibold">$11.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="ewwrefsdfsdfdstrrertefdsfsd">ewwrefsdfsdfdstr…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_95899e9555b4a1fb324aecaff465cdc4.png" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:11:19</td>
              <td>
                                  <small class="text-muted"></small>
                              </td>
            </tr>
                      <tr>
              <td>16</td>
              <td>
                <strong>XV152488</strong>
                <br><small class="text-muted">TestUser1</small>
              </td>
              <td class="small">demo</td>
              <td><span class="badge bg-info text-dark">BEP20</span></td>
              <td class="fw-semibold">$500.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="324rwe234wecdsarew34wersdcdsrewt43">324rwe234wecdsar…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_0775ad8fa71d77c294948c10cd773b69.png" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:11:03</td>
              <td>
                                  <small class="text-muted"></small>
                              </td>
            </tr>
                      <tr>
              <td>17</td>
              <td>
                <strong>XV152488</strong>
                <br><small class="text-muted">TestUser1</small>
              </td>
              <td class="small">demo</td>
              <td><span class="badge bg-info text-dark">BEP20</span></td>
              <td class="fw-semibold">$500.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="tdryxfhcvbhnjyuitgfvbnm,">tdryxfhcvbhnjyui…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_be0902d67162f432e155cf7eab172470.png" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 10:08:58</td>
              <td>
                                  <small class="text-muted"></small>
                              </td>
            </tr>
                      <tr>
              <td>18</td>
              <td>
                <strong>XV187153</strong>
                <br><small class="text-muted">qweqweqw</small>
              </td>
              <td class="small">demo</td>
              <td><span class="badge bg-info text-dark">BEP20</span></td>
              <td class="fw-semibold">$50.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="875t8y7uhtg9jbbvjhjhgjhjhjhjhv">875t8y7uhtg9jbbv…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_229f5408e09c3075cd517d891ce1ffcf.jpg" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-22 08:27:43</td>
              <td>
                                  <small class="text-muted"></small>
                              </td>
            </tr>
                      <tr>
              <td>19</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td class="small">test 2</td>
              <td><span class="badge bg-info text-dark">TRC20</span></td>
              <td class="fw-semibold">$1,000.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="test 2">test 2…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_acbd6ee0d8c5cd6307380cb4837d6c16.png" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-21 05:20:20</td>
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
              <td class="small">test 2</td>
              <td><span class="badge bg-info text-dark">TRC20</span></td>
              <td class="fw-semibold">$1,000.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="test">test…</code>
                              </td>
              <td>
                                  <span class="text-muted">—</span>
                              </td>
              <td>
                <span class="badge bg-danger">rejected</span>              </td>
              <td class="small">2026-04-21 05:19:10</td>
              <td>
                                  <small class="text-muted">failed</small>
                              </td>
            </tr>
                      <tr>
              <td>21</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td class="small">demo</td>
              <td><span class="badge bg-info text-dark">BEP20</span></td>
              <td class="fw-semibold">$10.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="test user">test user…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_5fe44e347e5d0b8778c8f78fdcb887d8.png" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-danger">rejected</span>              </td>
              <td class="small">2026-04-20 11:24:05</td>
              <td>
                                  <small class="text-muted"></small>
                              </td>
            </tr>
                      <tr>
              <td>22</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td class="small">demo</td>
              <td><span class="badge bg-info text-dark">BEP20</span></td>
              <td class="fw-semibold">$10.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="test user">test user…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_1ec19db9079ba16807399318cb4bd00f.png" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-danger">rejected</span>              </td>
              <td class="small">2026-04-20 11:20:53</td>
              <td>
                                  <small class="text-muted"></small>
                              </td>
            </tr>
                      <tr>
              <td>23</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td class="small">demo</td>
              <td><span class="badge bg-info text-dark">BEP20</span></td>
              <td class="fw-semibold">$10.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="test user">test user…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_5a3e23c5b142cac091135d4670d2486f.png" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-danger">rejected</span>              </td>
              <td class="small">2026-04-20 11:17:42</td>
              <td>
                                  <small class="text-muted">false</small>
                              </td>
            </tr>
                      <tr>
              <td>24</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td class="small">demo</td>
              <td><span class="badge bg-info text-dark">BEP20</span></td>
              <td class="fw-semibold">$10.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="test user">test user…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_990221fe74ffda840b05bc1bb25e0ae3.png" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-20 11:13:33</td>
              <td>
                                  <small class="text-muted">Test approve</small>
                              </td>
            </tr>
                      <tr>
              <td>25</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td class="small">demo</td>
              <td><span class="badge bg-info text-dark">BEP20</span></td>
              <td class="fw-semibold">$10.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="test user">test user…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_4f1d946fb4100f690e39913e5281eb7c.png" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-danger">rejected</span>              </td>
              <td class="small">2026-04-20 11:07:22</td>
              <td>
                                  <small class="text-muted">false</small>
                              </td>
            </tr>
                      <tr>
              <td>26</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td class="small">demo</td>
              <td><span class="badge bg-info text-dark">BEP20</span></td>
              <td class="fw-semibold">$10.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="test user">test user…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_2463d5cd407352c0989836b30f592fac.png" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-success">approved</span>              </td>
              <td class="small">2026-04-20 11:06:31</td>
              <td>
                                  <small class="text-muted"></small>
                              </td>
            </tr>
                      <tr>
              <td>27</td>
              <td>
                <strong>XV000001</strong>
                <br><small class="text-muted">XVoltyTrade</small>
              </td>
              <td class="small">demo</td>
              <td><span class="badge bg-info text-dark">BEP20</span></td>
              <td class="fw-semibold">$10.00</td>
              <td>
                                  <code class="small" style="word-break:break-all;" title="test user">test user…</code>
                              </td>
              <td>
                                  <a href="https://xvoltytrade.bgtl.in/uploads/deposit_receipts/wqr_9f376cd8e4ee98c4f894f9b87531fa66.png" target="_blank" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-image"></i></a>
                              </td>
              <td>
                <span class="badge bg-danger">rejected</span>              </td>
              <td class="small">2026-04-20 11:05:54</td>
              <td>
                                  <small class="text-muted">wrong</small>
                              </td>
            </tr>
                  </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Approve/Reject Modal -->
<div class="modal fade" id="drModal" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <form method="POST">
      <input type="hidden" name="request_id" id="drId">
      <input type="hidden" name="action" id="drAction">
      <div class="modal-header">
        <h5 class="modal-title" id="drTitle">Process Deposit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p id="drDesc"></p>
        <div id="drTxInfo" class="mb-3"></div>
        <div class="mb-3">
          <label class="form-label">Admin Remark (optional)</label>
          <textarea name="admin_remark" class="form-control" rows="2"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn" id="drSubmitBtn">Confirm</button>
      </div>
    </form>
  </div></div>
</div>

<script>
function openDrAction(id, action, userId, amount, txHash) {
  document.getElementById('drId').value = id;
  document.getElementById('drAction').value = action;
  var btn = document.getElementById('drSubmitBtn');
  var txInfo = txHash ? '<div class="alert alert-secondary small mb-0"><strong>TX Hash:</strong> <code>' + txHash + '</code></div>' : '';
  document.getElementById('drTxInfo').innerHTML = txInfo;
  if (action === 'approve') {
    document.getElementById('drTitle').textContent = 'Approve Deposit';
    document.getElementById('drDesc').innerHTML = 'Approve <strong>$' + amount + '</strong> deposit from <strong>' + userId + '</strong>? Amount will be credited to their wallet.';
    btn.className = 'btn btn-success'; btn.textContent = 'Approve & Credit';
  } else {
    document.getElementById('drTitle').textContent = 'Reject Deposit';
    document.getElementById('drDesc').innerHTML = 'Reject <strong>$' + amount + '</strong> deposit from <strong>' + userId + '</strong>?';
    btn.className = 'btn btn-danger'; btn.textContent = 'Reject';
  }
}
</script>
@endsection
