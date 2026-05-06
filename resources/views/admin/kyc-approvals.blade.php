@extends('layouts.admin')
@section('title', 'KYC Approvals - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
  <div>
    <h3 class="fw-heading mb-1">KYC Approvals</h3>
    <p class="text-muted mb-0 small">Review and action user KYC submissions.</p>
  </div>
</div>


<div class="card border-themed mb-3">
  <div class="card-body py-3">
    <form method="GET" class="row g-2 align-items-center">
      <div class="col-md-4">
        <div class="btn-group btn-group-sm" role="group">
                      <a href="../admin/kyc-approvals.html?status=all" class="btn btn-primary">
              All                          </a>
                      <a href="../admin/kyc-approvals.html?status=pending" class="btn btn-outline-secondary">
              Pending                          </a>
                      <a href="../admin/kyc-approvals.html?status=approved" class="btn btn-outline-secondary">
              Approved                              <span class="badge bg-light text-dark ms-1">2</span>
                          </a>
                      <a href="../admin/kyc-approvals.html?status=rejected" class="btn btn-outline-secondary">
              Rejected                          </a>
                  </div>
      </div>
      <div class="col-md-5">
        <div class="input-group input-group-sm">
          <input type="hidden" name="status" value="all">
          <input type="text" name="q" class="form-control" placeholder="Search by User ID or Name" value="">
          <button class="btn btn-outline-primary" type="submit"><i class="fa-solid fa-search"></i></button>
                  </div>
      </div>
    </form>
  </div>
</div>

<div class="card border-themed">
  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="small text-muted text-uppercase">
        <tr>
          <th class="ps-3">User</th>
          <th>Mobile</th>
          <th>PAN</th>
          <th>Aadhaar</th>
          <th>Documents</th>
          <th>Status</th>
          <th>Submitted</th>
          <th class="pe-3 text-end">Action</th>
        </tr>
      </thead>
      <tbody>
              <tr>
          <td class="ps-3">
            <strong class="d-block small">TestUser1</strong>
            <span class="text-muted small">XV152488</span>
          </td>
          <td class="small">7982965620</td>
          <td class="small"><code>ZWSXA1232A</code></td>
          <td class="small"><code>123123123123</code></td>
          <td class="small">
                          <a href="https://xvoltytrade.bgtl.in/uploads/kyc/pan_2e33c3adf49c494f53168ef721d38e42.png" target="_blank" class="btn btn-sm btn-outline-secondary me-1" title="PAN"><i class="fa-regular fa-file-image"></i> PAN</a>
                                      <a href="https://xvoltytrade.bgtl.in/uploads/kyc/aadhaar_front_444eff9ca47e0fe36055b3611aeda4d7.png" target="_blank" class="btn btn-sm btn-outline-secondary me-1" title="Aadhaar Front"><i class="fa-regular fa-file-image"></i> Front</a>
                                      <a href="https://xvoltytrade.bgtl.in/uploads/kyc/aadhaar_back_e008709db4d26be419c65998cec92975.png" target="_blank" class="btn btn-sm btn-outline-secondary" title="Aadhaar Back"><i class="fa-regular fa-file-image"></i> Back</a>
                      </td>
          <td>
            <span class="badge bg-success">Approved</span>
                      </td>
          <td class="small text-muted">2026-04-22 07:45:12</td>
          <td class="pe-3 text-end">
                          <span class="text-muted small">No action</span>
                      </td>
        </tr>
              <tr>
          <td class="ps-3">
            <strong class="d-block small">XVoltyTrade</strong>
            <span class="text-muted small">XV000001</span>
          </td>
          <td class="small">9876543211</td>
          <td class="small"><code>ABCDE1234F</code></td>
          <td class="small"><code>123456789012</code></td>
          <td class="small">
                          <a href="https://xvoltytrade.bgtl.in/uploads/kyc/pan_a431ffb5c44cb03743e21b3f2a689eaf.jpg" target="_blank" class="btn btn-sm btn-outline-secondary me-1" title="PAN"><i class="fa-regular fa-file-image"></i> PAN</a>
                                      <a href="https://xvoltytrade.bgtl.in/uploads/kyc/aadhaar_front_d4668b422ff475ff7a28ee3a0d6a77d2.jpg" target="_blank" class="btn btn-sm btn-outline-secondary me-1" title="Aadhaar Front"><i class="fa-regular fa-file-image"></i> Front</a>
                                      <a href="https://xvoltytrade.bgtl.in/uploads/kyc/aadhaar_back_7b9c14f4f7448dfe6790a8cc9144f0e6.jpg" target="_blank" class="btn btn-sm btn-outline-secondary" title="Aadhaar Back"><i class="fa-regular fa-file-image"></i> Back</a>
                      </td>
          <td>
            <span class="badge bg-success">Approved</span>
                      </td>
          <td class="small text-muted">2026-04-21 07:39:16</td>
          <td class="pe-3 text-end">
                          <span class="text-muted small">No action</span>
                      </td>
        </tr>
            </tbody>
    </table>
  </div>
</div>
@endsection
