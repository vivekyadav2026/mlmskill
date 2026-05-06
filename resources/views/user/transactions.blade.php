@extends('layouts.user')
@section('title', 'Transactions — XVolty Trade')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
  <h3 class="fw-heading mb-0">Transaction History</h3>
</div>

<ul class="nav nav-pills mb-3">
  <li class="nav-item"><a class="nav-link active" href="../user/transactions.html?tab=incomes"><i class="fa-solid fa-sack-dollar me-1"></i>Incomes</a></li>
  <li class="nav-item"><a class="nav-link " href="../user/transactions.html?tab=deposits"><i class="fa-solid fa-arrow-down me-1"></i>Deposits</a></li>
  <li class="nav-item"><a class="nav-link " href="../user/transactions.html?tab=withdrawals"><i class="fa-solid fa-arrow-up me-1"></i>Withdrawals</a></li>
</ul>

<div class="card border-themed">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-sm table-hover mb-0">
        <thead>
          <tr><th>Type</th><th>Amount</th><th>Wallet</th><th>Remarks</th><th>Date</th></tr>
        </thead>
        <tbody>
                      <tr>
              <td><span class="badge bg-info">roi</span></td>
              <td class="fw-semibold">$5.00</td>
              <td class="small">roi wallet</td>
              <td class="small" style="max-width:200px;">Daily ROI 1% for 2026-05-01</td>
              <td class="small">2026-05-01 10:31:20</td>
            </tr>
                      <tr>
              <td><span class="badge bg-info">roi</span></td>
              <td class="fw-semibold">$5.00</td>
              <td class="small">roi wallet</td>
              <td class="small" style="max-width:200px;">Daily ROI 1% for 2026-04-29</td>
              <td class="small">2026-04-29 11:00:54</td>
            </tr>
                      <tr>
              <td><span class="badge bg-info">roi</span></td>
              <td class="fw-semibold">$5.00</td>
              <td class="small">roi wallet</td>
              <td class="small" style="max-width:200px;">Daily ROI 1% for 2026-04-25</td>
              <td class="small">2026-04-25 10:35:57</td>
            </tr>
                      <tr>
              <td><span class="badge bg-success">direct</span></td>
              <td class="fw-semibold">$5.00</td>
              <td class="small">active wallet</td>
              <td class="small" style="max-width:200px;">Direct bonus 10% on XV442258 activation of $50.00</td>
              <td class="small">2026-04-24 08:38:41</td>
            </tr>
                      <tr>
              <td><span class="badge bg-warning">level</span></td>
              <td class="fw-semibold">$2.50</td>
              <td class="small">active wallet</td>
              <td class="small" style="max-width:200px;">Level 1 income (5%) from XV442258 activation of $50.00</td>
              <td class="small">2026-04-24 08:38:41</td>
            </tr>
                  </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
