@extends('layouts.user')
@section('title', 'My Network — XVolty Trade')

@section('content')
<!-- ===== Network Tree Content ===== -->
<div class="mb-4">
  <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
    <div>
      <h3 class="fw-heading mb-1"><i class="fa-solid fa-sitemap me-2"></i>My Network</h3>
              <p class="text-muted mb-0 small">8-Level sponsor chain network overview</p>
          </div>
    <!-- Search within own network -->
    <form class="d-flex gap-2" method="GET" style="max-width:380px;width:100%;">
            <input type="hidden" name="level" value="1">
      <input type="text" name="search" class="form-control form-control-sm" placeholder="Search ID / Name / Mobile" value="">
      <button class="btn btn-sm btn-primary" type="submit"><i class="fa-solid fa-search"></i></button>
          </form>
  </div>

  <!-- ===== Level Cards ===== -->
  <div class="row g-2 mb-4">
        <div class="col-6 col-md-3 col-lg">
      <a href="../user/tree.html?level=1" class="card border-themed text-decoration-none h-100 network-level-card active">
        <div class="card-body text-center py-3 px-2">
          <div class="small text-uppercase fw-semibold mb-1" style="letter-spacing:.5px;">Level 1</div>
          <div class="h4 fw-bold mb-0">2</div>
        </div>
      </a>
    </div>
        <div class="col-6 col-md-3 col-lg">
      <a href="../user/tree.html?level=2" class="card border-themed text-decoration-none h-100 network-level-card">
        <div class="card-body text-center py-3 px-2">
          <div class="small text-uppercase fw-semibold mb-1" style="letter-spacing:.5px;">Level 2</div>
          <div class="h4 fw-bold mb-0">0</div>
        </div>
      </a>
    </div>
        <div class="col-6 col-md-3 col-lg">
      <a href="../user/tree.html?level=3" class="card border-themed text-decoration-none h-100 network-level-card">
        <div class="card-body text-center py-3 px-2">
          <div class="small text-uppercase fw-semibold mb-1" style="letter-spacing:.5px;">Level 3</div>
          <div class="h4 fw-bold mb-0">0</div>
        </div>
      </a>
    </div>
        <div class="col-6 col-md-3 col-lg">
      <a href="../user/tree.html?level=4" class="card border-themed text-decoration-none h-100 network-level-card">
        <div class="card-body text-center py-3 px-2">
          <div class="small text-uppercase fw-semibold mb-1" style="letter-spacing:.5px;">Level 4</div>
          <div class="h4 fw-bold mb-0">0</div>
        </div>
      </a>
    </div>
        <div class="col-6 col-md-3 col-lg">
      <a href="../user/tree.html?level=5" class="card border-themed text-decoration-none h-100 network-level-card">
        <div class="card-body text-center py-3 px-2">
          <div class="small text-uppercase fw-semibold mb-1" style="letter-spacing:.5px;">Level 5</div>
          <div class="h4 fw-bold mb-0">0</div>
        </div>
      </a>
    </div>
        <div class="col-6 col-md-3 col-lg">
      <a href="../user/tree.html?level=6" class="card border-themed text-decoration-none h-100 network-level-card">
        <div class="card-body text-center py-3 px-2">
          <div class="small text-uppercase fw-semibold mb-1" style="letter-spacing:.5px;">Level 6</div>
          <div class="h4 fw-bold mb-0">0</div>
        </div>
      </a>
    </div>
        <div class="col-6 col-md-3 col-lg">
      <a href="../user/tree.html?level=7" class="card border-themed text-decoration-none h-100 network-level-card">
        <div class="card-body text-center py-3 px-2">
          <div class="small text-uppercase fw-semibold mb-1" style="letter-spacing:.5px;">Level 7</div>
          <div class="h4 fw-bold mb-0">0</div>
        </div>
      </a>
    </div>
        <div class="col-6 col-md-3 col-lg">
      <a href="../user/tree.html?level=8" class="card border-themed text-decoration-none h-100 network-level-card">
        <div class="card-body text-center py-3 px-2">
          <div class="small text-uppercase fw-semibold mb-1" style="letter-spacing:.5px;">Level 8</div>
          <div class="h4 fw-bold mb-0">0</div>
        </div>
      </a>
    </div>
        <!-- Total Card -->
    <div class="col-6 col-md-3 col-lg">
      <div class="card border-themed h-100 network-level-card total">
        <div class="card-body text-center py-3 px-2">
          <div class="small text-uppercase fw-semibold mb-1" style="letter-spacing:.5px;">Total</div>
          <div class="h4 fw-bold mb-0">2</div>
        </div>
      </div>
    </div>
  </div>

  <!-- ===== Level Members Table ===== -->
  <div class="card border-themed">
    <div class="card-header bg-transparent border-themed d-flex align-items-center justify-content-between">
      <strong><i class="fa-solid fa-users me-1"></i>Level 1 Members</strong>
      <span class="badge bg-primary">2 found</span>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th class="ps-3">#</th>
              <th>User</th>
              <th>User ID</th>
              <th>Mobile</th>
              <th>Sponsor</th>
              <th>Directs</th>
              <th>Status</th>
              <th>Joined</th>
              <th class="text-end pe-3">Action</th>
            </tr>
          </thead>
          <tbody>
                          <tr>
                <td class="ps-3 text-muted small">1</td>
                <td>
                  <div class="d-flex align-items-center gap-2">
                    <span class="xvt-avatar" style="width:32px;height:32px;font-size:.75rem;">P</span>
                    <div>
                      <div class="fw-semibold">POONAM SINGH</div>
                      <div class="small text-muted">berokakinz@gmail.com</div>
                    </div>
                  </div>
                </td>
                <td><span class="fw-bold" style="color:var(--xvt-primary);">XV442258</span></td>
                <td class="small">9876543200</td>
                <td class="small">
                  XVoltyTrade                  <div class="text-muted" style="font-size:.75rem;">XV000001</div>
                </td>
                <td class="fw-semibold">0</td>
                <td><span class="badge bg-success">Active</span></td>
                <td class="small text-muted">Apr 21, 2026</td>
                <td class="text-end pe-3">
                                      <span class="btn btn-sm btn-outline-secondary disabled"><i class="fa-solid fa-sitemap"></i></span>
                                  </td>
              </tr>
                          <tr>
                <td class="ps-3 text-muted small">2</td>
                <td>
                  <div class="d-flex align-items-center gap-2">
                    <span class="xvt-avatar" style="width:32px;height:32px;font-size:.75rem;">R</span>
                    <div>
                      <div class="fw-semibold">Ravishankar Tiwari</div>
                      <div class="small text-muted">snikit141@gmail.com</div>
                    </div>
                  </div>
                </td>
                <td><span class="fw-bold" style="color:var(--xvt-primary);">XV528556</span></td>
                <td class="small">9876543210</td>
                <td class="small">
                  XVoltyTrade                  <div class="text-muted" style="font-size:.75rem;">XV000001</div>
                </td>
                <td class="fw-semibold">0</td>
                <td><span class="badge bg-secondary">Inactive</span></td>
                <td class="small text-muted">Apr 21, 2026</td>
                <td class="text-end pe-3">
                                      <span class="btn btn-sm btn-outline-secondary disabled"><i class="fa-solid fa-sitemap"></i></span>
                                  </td>
              </tr>
                      </tbody>
        </table>
      </div>
    </div>

      </div>
</div>
@endsection
