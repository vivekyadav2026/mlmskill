@extends('layouts.user')
@section('title', 'Direct Team — XVolty Trade')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
  <h3 class="fw-heading mb-0">My Direct Team</h3>
  <div class="d-flex gap-3">
    <span class="badge bg-primary fs-6">2 Direct</span>
    <span class="badge bg-success fs-6">1 Active</span>
    <span class="badge bg-info fs-6">2 Total Team</span>
  </div>
</div>

<!-- 8-Level Team Overview -->
<div class="card border-themed mb-4">
  <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-layer-group me-2"></i>8-Level Team Overview (Sponsor Chain)</h6></div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-sm mb-0 text-center">
        <thead>
          <tr>
            <th>Level</th>
                          <th>L1</th>
                          <th>L2</th>
                          <th>L3</th>
                          <th>L4</th>
                          <th>L5</th>
                          <th>L6</th>
                          <th>L7</th>
                          <th>L8</th>
                        <th class="table-light">Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="fw-semibold text-muted">Members</td>
                          <td>
                                                  <span class="badge bg-primary">2</span>
                              </td>
                          <td>
                                                  <span class="text-muted">0</span>
                              </td>
                          <td>
                                                  <span class="text-muted">0</span>
                              </td>
                          <td>
                                                  <span class="text-muted">0</span>
                              </td>
                          <td>
                                                  <span class="text-muted">0</span>
                              </td>
                          <td>
                                                  <span class="text-muted">0</span>
                              </td>
                          <td>
                                                  <span class="text-muted">0</span>
                              </td>
                          <td>
                                                  <span class="text-muted">0</span>
                              </td>
                        <td class="table-light fw-bold">2</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="card border-themed">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-sm table-hover mb-0">
        <thead><tr><th>#</th><th>User ID</th><th>Name</th><th>Email</th><th>Package</th><th>Status</th><th>Joined</th></tr></thead>
        <tbody>
                      <tr>
              <td>1</td>
              <td class="fw-semibold">XV442258</td>
              <td>POONAM SINGH</td>
              <td class="small">berokakinz@gmail.com</td>
              <td>Beginner Pack</td>
              <td><span class="badge bg-success">active</span></td>
              <td class="small">2026-04-21 10:49:07</td>
            </tr>
                      <tr>
              <td>2</td>
              <td class="fw-semibold">XV528556</td>
              <td>Ravishankar Tiwari</td>
              <td class="small">snikit141@gmail.com</td>
              <td>$0</td>
              <td><span class="badge bg-secondary">inactive</span></td>
              <td class="small">2026-04-21 10:14:21</td>
            </tr>
                  </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
