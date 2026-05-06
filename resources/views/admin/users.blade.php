@extends('layouts.admin')
@section('title', 'User Management — Admin — XVolty Trade')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
  <div>
    <h3 class="fw-heading mb-1"><i class="fa-solid fa-users me-2"></i>User Management</h3>
    <p class="text-muted mb-0 small">Manage all registered users, their status and access.</p>
  </div>
</div>

<!-- Quick stats -->
<div class="row g-3 mb-4">
  <div class="col-6 col-lg-3">
    <div class="card h-100 border-themed">
      <div class="card-body d-flex align-items-center gap-3">
        <span class="xvt-avatar lg" style="background:rgba(var(--bs-primary-rgb),.15);color:var(--xvt-primary);"><i class="fa-solid fa-users"></i></span>
        <div>
          <div class="text-muted small text-uppercase">Total</div>
          <div class="h4 fw-bold mb-0">16</div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="card h-100 border-themed">
      <div class="card-body d-flex align-items-center gap-3">
        <span class="xvt-avatar lg" style="background:rgba(16,185,129,.15);color:#10b981;"><i class="fa-solid fa-circle-check"></i></span>
        <div>
          <div class="text-muted small text-uppercase">Active</div>
          <div class="h4 fw-bold mb-0">6</div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="card h-100 border-themed">
      <div class="card-body d-flex align-items-center gap-3">
        <span class="xvt-avatar lg" style="background:rgba(239,68,68,.15);color:#ef4444;"><i class="fa-solid fa-ban"></i></span>
        <div>
          <div class="text-muted small text-uppercase">Blocked</div>
          <div class="h4 fw-bold mb-0">0</div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="card h-100 border-themed">
      <div class="card-body d-flex align-items-center gap-3">
        <span class="xvt-avatar lg" style="background:rgba(245,158,11,.15);color:#f59e0b;"><i class="fa-solid fa-id-card"></i></span>
        <div>
          <div class="text-muted small text-uppercase">Pending KYC</div>
          <div class="h4 fw-bold mb-0">14</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Toolbar + Table -->
<div class="card border-themed">
  <div class="card-header bg-transparent border-themed">
    <div class="row g-2 align-items-center">
      <div class="col-md-6">
        <div class="input-group">
          <span class="input-group-text"><i class="fa-solid fa-search"></i></span>
          <input type="text" id="userSearch" class="form-control" placeholder="Search by User ID, name, or email...">
        </div>
      </div>
      <div class="col-md-3"><select id="statusFilter" class="form-select">
        <option value="">All Status</option><option value="active">Active</option>
        <option value="inactive">Inactive</option><option value="blocked">Blocked</option>
      </select></div>
      <div class="col-md-3"><select id="kycFilter" class="form-select">
        <option value="">All KYC</option><option value="pending">Pending</option>
        <option value="approved">Approved</option><option value="rejected">Rejected</option>
        <option value="na">N/A</option>
      </select></div>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-hover mb-0 align-middle" id="usersTable">
      <thead class="small text-uppercase text-muted">
        <tr>
          <th class="ps-3">#</th><th>User ID</th><th>Name</th><th>Package</th>
          <th>Status</th><th>KYC</th><th>Joined</th><th class="text-end pe-3">Actions</th>
        </tr>
      </thead>
      <tbody id="usersTableBody">
                  <tr data-user-id="XV653796" data-name="werweqerweerweer" data-email="cube-good-tinker@duck.com" data-status="active" data-kyc="pending">
            <td class="ps-3 text-muted small">1</td>
            <td><span class="fw-bold" style="color:var(--xvt-primary);">XV653796</span></td>
            <td>
              <div class="fw-semibold">werweqerweerweer</div>
              <div class="text-muted small">cube-good-tinker@duck.com</div>
            </td>
            <td>Starter Pack</td>
            <td><span class="badge bg-success">Active</span></td>
            <td><span class="badge bg-warning text-dark">Pending</span></td>
            <td class="small text-muted">22 Apr 2026</td>
            <td class="text-end pe-3">
              <div class="btn-group btn-group-sm" role="group" aria-label="User actions">
                <a class="btn btn-outline-secondary" href="../admin/profile.html?user_id=XV653796" title="View Profile" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user"></i>
                </a>

                <a class="btn btn-outline-secondary" href="../admin/referrals.html?user_id=XV653796" title="Direct Referrals" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user-group"></i>
                </a>
                <a class="btn btn-outline-secondary" href="../admin/change-password.html?user_id=XV653796&amp;from=users" title="Change Password" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-key"></i>
                </a>
                                  <a class="btn btn-outline-secondary" href="../admin/login-as.html?user_id=XV653796" title="Login as user" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-user-secret"></i>
                  </a>
                                                  <a class="btn btn-outline-danger" href="../admin/block-user.html?user_id=XV653796&amp;from=users" data-act="block" data-uid="XV653796" title="Block User" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-ban"></i>
                  </a>
                              </div>
            </td>
          </tr>
                  <tr data-user-id="XV406921" data-name="werwersfsdfwer" data-email="fruit-tint-marina@duck.com" data-status="inactive" data-kyc="pending">
            <td class="ps-3 text-muted small">2</td>
            <td><span class="fw-bold" style="color:var(--xvt-primary);">XV406921</span></td>
            <td>
              <div class="fw-semibold">werwersfsdfwer</div>
              <div class="text-muted small">fruit-tint-marina@duck.com</div>
            </td>
            <td>$0</td>
            <td><span class="badge bg-secondary">Inactive</span></td>
            <td><span class="badge bg-warning text-dark">Pending</span></td>
            <td class="small text-muted">22 Apr 2026</td>
            <td class="text-end pe-3">
              <div class="btn-group btn-group-sm" role="group" aria-label="User actions">
                <a class="btn btn-outline-secondary" href="../admin/profile.html?user_id=XV406921" title="View Profile" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user"></i>
                </a>

                <a class="btn btn-outline-secondary" href="../admin/referrals.html?user_id=XV406921" title="Direct Referrals" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user-group"></i>
                </a>
                <a class="btn btn-outline-secondary" href="../admin/change-password.html?user_id=XV406921&amp;from=users" title="Change Password" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-key"></i>
                </a>
                                  <a class="btn btn-outline-secondary" href="../admin/login-as.html?user_id=XV406921" title="Login as user" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-user-secret"></i>
                  </a>
                                                  <a class="btn btn-outline-danger" href="../admin/block-user.html?user_id=XV406921&amp;from=users" data-act="block" data-uid="XV406921" title="Block User" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-ban"></i>
                  </a>
                              </div>
            </td>
          </tr>
                  <tr data-user-id="XV698744" data-name="qwewqrwerwtert" data-email="wok-defame-gem@duck.com" data-status="inactive" data-kyc="pending">
            <td class="ps-3 text-muted small">3</td>
            <td><span class="fw-bold" style="color:var(--xvt-primary);">XV698744</span></td>
            <td>
              <div class="fw-semibold">qwewqrwerwtert</div>
              <div class="text-muted small">wok-defame-gem@duck.com</div>
            </td>
            <td>$0</td>
            <td><span class="badge bg-secondary">Inactive</span></td>
            <td><span class="badge bg-warning text-dark">Pending</span></td>
            <td class="small text-muted">22 Apr 2026</td>
            <td class="text-end pe-3">
              <div class="btn-group btn-group-sm" role="group" aria-label="User actions">
                <a class="btn btn-outline-secondary" href="../admin/profile.html?user_id=XV698744" title="View Profile" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user"></i>
                </a>

                <a class="btn btn-outline-secondary" href="../admin/referrals.html?user_id=XV698744" title="Direct Referrals" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user-group"></i>
                </a>
                <a class="btn btn-outline-secondary" href="../admin/change-password.html?user_id=XV698744&amp;from=users" title="Change Password" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-key"></i>
                </a>
                                  <a class="btn btn-outline-secondary" href="../admin/login-as.html?user_id=XV698744" title="Login as user" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-user-secret"></i>
                  </a>
                                                  <a class="btn btn-outline-danger" href="../admin/block-user.html?user_id=XV698744&amp;from=users" data-act="block" data-uid="XV698744" title="Block User" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-ban"></i>
                  </a>
                              </div>
            </td>
          </tr>
                  <tr data-user-id="XV906404" data-name="werwerwrwerwsdfsdf" data-email="path-pebbly-shaded@duck.com" data-status="inactive" data-kyc="pending">
            <td class="ps-3 text-muted small">4</td>
            <td><span class="fw-bold" style="color:var(--xvt-primary);">XV906404</span></td>
            <td>
              <div class="fw-semibold">werwerwrwerwsdfsdf</div>
              <div class="text-muted small">path-pebbly-shaded@duck.com</div>
            </td>
            <td>$0</td>
            <td><span class="badge bg-secondary">Inactive</span></td>
            <td><span class="badge bg-warning text-dark">Pending</span></td>
            <td class="small text-muted">22 Apr 2026</td>
            <td class="text-end pe-3">
              <div class="btn-group btn-group-sm" role="group" aria-label="User actions">
                <a class="btn btn-outline-secondary" href="../admin/profile.html?user_id=XV906404" title="View Profile" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user"></i>
                </a>

                <a class="btn btn-outline-secondary" href="../admin/referrals.html?user_id=XV906404" title="Direct Referrals" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user-group"></i>
                </a>
                <a class="btn btn-outline-secondary" href="../admin/change-password.html?user_id=XV906404&amp;from=users" title="Change Password" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-key"></i>
                </a>
                                  <a class="btn btn-outline-secondary" href="../admin/login-as.html?user_id=XV906404" title="Login as user" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-user-secret"></i>
                  </a>
                                                  <a class="btn btn-outline-danger" href="../admin/block-user.html?user_id=XV906404&amp;from=users" data-act="block" data-uid="XV906404" title="Block User" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-ban"></i>
                  </a>
                              </div>
            </td>
          </tr>
                  <tr data-user-id="XV939801" data-name="ertertertert" data-email="prude-jinx-giggle@duck.com" data-status="inactive" data-kyc="pending">
            <td class="ps-3 text-muted small">5</td>
            <td><span class="fw-bold" style="color:var(--xvt-primary);">XV939801</span></td>
            <td>
              <div class="fw-semibold">ertertertert</div>
              <div class="text-muted small">prude-jinx-giggle@duck.com</div>
            </td>
            <td>$0</td>
            <td><span class="badge bg-secondary">Inactive</span></td>
            <td><span class="badge bg-warning text-dark">Pending</span></td>
            <td class="small text-muted">22 Apr 2026</td>
            <td class="text-end pe-3">
              <div class="btn-group btn-group-sm" role="group" aria-label="User actions">
                <a class="btn btn-outline-secondary" href="../admin/profile.html?user_id=XV939801" title="View Profile" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user"></i>
                </a>

                <a class="btn btn-outline-secondary" href="../admin/referrals.html?user_id=XV939801" title="Direct Referrals" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user-group"></i>
                </a>
                <a class="btn btn-outline-secondary" href="../admin/change-password.html?user_id=XV939801&amp;from=users" title="Change Password" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-key"></i>
                </a>
                                  <a class="btn btn-outline-secondary" href="../admin/login-as.html?user_id=XV939801" title="Login as user" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-user-secret"></i>
                  </a>
                                                  <a class="btn btn-outline-danger" href="../admin/block-user.html?user_id=XV939801&amp;from=users" data-act="block" data-uid="XV939801" title="Block User" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-ban"></i>
                  </a>
                              </div>
            </td>
          </tr>
                  <tr data-user-id="XV937656" data-name="rtyryhfrhgbfgh" data-email="unseen-control-duh@duck.com" data-status="inactive" data-kyc="pending">
            <td class="ps-3 text-muted small">6</td>
            <td><span class="fw-bold" style="color:var(--xvt-primary);">XV937656</span></td>
            <td>
              <div class="fw-semibold">rtyryhfrhgbfgh</div>
              <div class="text-muted small">unseen-control-duh@duck.com</div>
            </td>
            <td>$0</td>
            <td><span class="badge bg-secondary">Inactive</span></td>
            <td><span class="badge bg-warning text-dark">Pending</span></td>
            <td class="small text-muted">22 Apr 2026</td>
            <td class="text-end pe-3">
              <div class="btn-group btn-group-sm" role="group" aria-label="User actions">
                <a class="btn btn-outline-secondary" href="../admin/profile.html?user_id=XV937656" title="View Profile" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user"></i>
                </a>

                <a class="btn btn-outline-secondary" href="../admin/referrals.html?user_id=XV937656" title="Direct Referrals" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user-group"></i>
                </a>
                <a class="btn btn-outline-secondary" href="../admin/change-password.html?user_id=XV937656&amp;from=users" title="Change Password" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-key"></i>
                </a>
                                  <a class="btn btn-outline-secondary" href="../admin/login-as.html?user_id=XV937656" title="Login as user" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-user-secret"></i>
                  </a>
                                                  <a class="btn btn-outline-danger" href="../admin/block-user.html?user_id=XV937656&amp;from=users" data-act="block" data-uid="XV937656" title="Block User" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-ban"></i>
                  </a>
                              </div>
            </td>
          </tr>
                  <tr data-user-id="XV226535" data-name="wteregvfdg" data-email="saga-cubicle-exert@duck.com" data-status="inactive" data-kyc="pending">
            <td class="ps-3 text-muted small">7</td>
            <td><span class="fw-bold" style="color:var(--xvt-primary);">XV226535</span></td>
            <td>
              <div class="fw-semibold">wteregvfdg</div>
              <div class="text-muted small">saga-cubicle-exert@duck.com</div>
            </td>
            <td>$0</td>
            <td><span class="badge bg-secondary">Inactive</span></td>
            <td><span class="badge bg-warning text-dark">Pending</span></td>
            <td class="small text-muted">22 Apr 2026</td>
            <td class="text-end pe-3">
              <div class="btn-group btn-group-sm" role="group" aria-label="User actions">
                <a class="btn btn-outline-secondary" href="../admin/profile.html?user_id=XV226535" title="View Profile" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user"></i>
                </a>

                <a class="btn btn-outline-secondary" href="../admin/referrals.html?user_id=XV226535" title="Direct Referrals" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user-group"></i>
                </a>
                <a class="btn btn-outline-secondary" href="../admin/change-password.html?user_id=XV226535&amp;from=users" title="Change Password" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-key"></i>
                </a>
                                  <a class="btn btn-outline-secondary" href="../admin/login-as.html?user_id=XV226535" title="Login as user" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-user-secret"></i>
                  </a>
                                                  <a class="btn btn-outline-danger" href="../admin/block-user.html?user_id=XV226535&amp;from=users" data-act="block" data-uid="XV226535" title="Block User" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-ban"></i>
                  </a>
                              </div>
            </td>
          </tr>
                  <tr data-user-id="XV963517" data-name="erwerweerwerwer" data-email="pushy-sector-snout@duck.com" data-status="active" data-kyc="pending">
            <td class="ps-3 text-muted small">8</td>
            <td><span class="fw-bold" style="color:var(--xvt-primary);">XV963517</span></td>
            <td>
              <div class="fw-semibold">erwerweerwerwer</div>
              <div class="text-muted small">pushy-sector-snout@duck.com</div>
            </td>
            <td>Starter Pack</td>
            <td><span class="badge bg-success">Active</span></td>
            <td><span class="badge bg-warning text-dark">Pending</span></td>
            <td class="small text-muted">22 Apr 2026</td>
            <td class="text-end pe-3">
              <div class="btn-group btn-group-sm" role="group" aria-label="User actions">
                <a class="btn btn-outline-secondary" href="../admin/profile.html?user_id=XV963517" title="View Profile" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user"></i>
                </a>

                <a class="btn btn-outline-secondary" href="../admin/referrals.html?user_id=XV963517" title="Direct Referrals" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user-group"></i>
                </a>
                <a class="btn btn-outline-secondary" href="../admin/change-password.html?user_id=XV963517&amp;from=users" title="Change Password" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-key"></i>
                </a>
                                  <a class="btn btn-outline-secondary" href="../admin/login-as.html?user_id=XV963517" title="Login as user" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-user-secret"></i>
                  </a>
                                                  <a class="btn btn-outline-danger" href="../admin/block-user.html?user_id=XV963517&amp;from=users" data-act="block" data-uid="XV963517" title="Block User" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-ban"></i>
                  </a>
                              </div>
            </td>
          </tr>
                  <tr data-user-id="XV298561" data-name="qdsaxzv cbz" data-email="shush-recess-amaze@duck.com" data-status="inactive" data-kyc="pending">
            <td class="ps-3 text-muted small">9</td>
            <td><span class="fw-bold" style="color:var(--xvt-primary);">XV298561</span></td>
            <td>
              <div class="fw-semibold">qdsaxzv cbz</div>
              <div class="text-muted small">shush-recess-amaze@duck.com</div>
            </td>
            <td>$0</td>
            <td><span class="badge bg-secondary">Inactive</span></td>
            <td><span class="badge bg-warning text-dark">Pending</span></td>
            <td class="small text-muted">22 Apr 2026</td>
            <td class="text-end pe-3">
              <div class="btn-group btn-group-sm" role="group" aria-label="User actions">
                <a class="btn btn-outline-secondary" href="../admin/profile.html?user_id=XV298561" title="View Profile" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user"></i>
                </a>

                <a class="btn btn-outline-secondary" href="../admin/referrals.html?user_id=XV298561" title="Direct Referrals" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user-group"></i>
                </a>
                <a class="btn btn-outline-secondary" href="../admin/change-password.html?user_id=XV298561&amp;from=users" title="Change Password" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-key"></i>
                </a>
                                  <a class="btn btn-outline-secondary" href="../admin/login-as.html?user_id=XV298561" title="Login as user" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-user-secret"></i>
                  </a>
                                                  <a class="btn btn-outline-danger" href="../admin/block-user.html?user_id=XV298561&amp;from=users" data-act="block" data-uid="XV298561" title="Block User" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-ban"></i>
                  </a>
                              </div>
            </td>
          </tr>
                  <tr data-user-id="XV430358" data-name="fdgfdgfdgd" data-email="jury-almighty-poem@duck.com" data-status="active" data-kyc="pending">
            <td class="ps-3 text-muted small">10</td>
            <td><span class="fw-bold" style="color:var(--xvt-primary);">XV430358</span></td>
            <td>
              <div class="fw-semibold">fdgfdgfdgd</div>
              <div class="text-muted small">jury-almighty-poem@duck.com</div>
            </td>
            <td>Diamond Investor</td>
            <td><span class="badge bg-success">Active</span></td>
            <td><span class="badge bg-warning text-dark">Pending</span></td>
            <td class="small text-muted">22 Apr 2026</td>
            <td class="text-end pe-3">
              <div class="btn-group btn-group-sm" role="group" aria-label="User actions">
                <a class="btn btn-outline-secondary" href="../admin/profile.html?user_id=XV430358" title="View Profile" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user"></i>
                </a>

                <a class="btn btn-outline-secondary" href="../admin/referrals.html?user_id=XV430358" title="Direct Referrals" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user-group"></i>
                </a>
                <a class="btn btn-outline-secondary" href="../admin/change-password.html?user_id=XV430358&amp;from=users" title="Change Password" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-key"></i>
                </a>
                                  <a class="btn btn-outline-secondary" href="../admin/login-as.html?user_id=XV430358" title="Login as user" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-user-secret"></i>
                  </a>
                                                  <a class="btn btn-outline-danger" href="../admin/block-user.html?user_id=XV430358&amp;from=users" data-act="block" data-uid="XV430358" title="Block User" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-ban"></i>
                  </a>
                              </div>
            </td>
          </tr>
                  <tr data-user-id="XV187153" data-name="qweqweqw" data-email="mud-fleshy-rework@duck.com" data-status="inactive" data-kyc="pending">
            <td class="ps-3 text-muted small">11</td>
            <td><span class="fw-bold" style="color:var(--xvt-primary);">XV187153</span></td>
            <td>
              <div class="fw-semibold">qweqweqw</div>
              <div class="text-muted small">mud-fleshy-rework@duck.com</div>
            </td>
            <td>$0</td>
            <td><span class="badge bg-secondary">Inactive</span></td>
            <td><span class="badge bg-warning text-dark">Pending</span></td>
            <td class="small text-muted">22 Apr 2026</td>
            <td class="text-end pe-3">
              <div class="btn-group btn-group-sm" role="group" aria-label="User actions">
                <a class="btn btn-outline-secondary" href="../admin/profile.html?user_id=XV187153" title="View Profile" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user"></i>
                </a>

                <a class="btn btn-outline-secondary" href="../admin/referrals.html?user_id=XV187153" title="Direct Referrals" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user-group"></i>
                </a>
                <a class="btn btn-outline-secondary" href="../admin/change-password.html?user_id=XV187153&amp;from=users" title="Change Password" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-key"></i>
                </a>
                                  <a class="btn btn-outline-secondary" href="../admin/login-as.html?user_id=XV187153" title="Login as user" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-user-secret"></i>
                  </a>
                                                  <a class="btn btn-outline-danger" href="../admin/block-user.html?user_id=XV187153&amp;from=users" data-act="block" data-uid="XV187153" title="Block User" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-ban"></i>
                  </a>
                              </div>
            </td>
          </tr>
                  <tr data-user-id="XV152488" data-name="testuser1" data-email="asda221@easf.com" data-status="active" data-kyc="approved">
            <td class="ps-3 text-muted small">12</td>
            <td><span class="fw-bold" style="color:var(--xvt-primary);">XV152488</span></td>
            <td>
              <div class="fw-semibold">TestUser1</div>
              <div class="text-muted small">asda221@easf.com</div>
            </td>
            <td>Beginner Pack</td>
            <td><span class="badge bg-success">Active</span></td>
            <td><span class="badge bg-success">Approved</span></td>
            <td class="small text-muted">22 Apr 2026</td>
            <td class="text-end pe-3">
              <div class="btn-group btn-group-sm" role="group" aria-label="User actions">
                <a class="btn btn-outline-secondary" href="../admin/profile.html?user_id=XV152488" title="View Profile" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user"></i>
                </a>

                <a class="btn btn-outline-secondary" href="../admin/referrals.html?user_id=XV152488" title="Direct Referrals" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user-group"></i>
                </a>
                <a class="btn btn-outline-secondary" href="../admin/change-password.html?user_id=XV152488&amp;from=users" title="Change Password" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-key"></i>
                </a>
                                  <a class="btn btn-outline-secondary" href="../admin/login-as.html?user_id=XV152488" title="Login as user" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-user-secret"></i>
                  </a>
                                                  <a class="btn btn-outline-danger" href="../admin/block-user.html?user_id=XV152488&amp;from=users" data-act="block" data-uid="XV152488" title="Block User" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-ban"></i>
                  </a>
                              </div>
            </td>
          </tr>
                  <tr data-user-id="XV252517" data-name="nikit singh" data-email="test@gmail.com" data-status="inactive" data-kyc="pending">
            <td class="ps-3 text-muted small">13</td>
            <td><span class="fw-bold" style="color:var(--xvt-primary);">XV252517</span></td>
            <td>
              <div class="fw-semibold">Nikit singh</div>
              <div class="text-muted small">test@gmail.com</div>
            </td>
            <td>$0</td>
            <td><span class="badge bg-secondary">Inactive</span></td>
            <td><span class="badge bg-warning text-dark">Pending</span></td>
            <td class="small text-muted">21 Apr 2026</td>
            <td class="text-end pe-3">
              <div class="btn-group btn-group-sm" role="group" aria-label="User actions">
                <a class="btn btn-outline-secondary" href="../admin/profile.html?user_id=XV252517" title="View Profile" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user"></i>
                </a>

                <a class="btn btn-outline-secondary" href="../admin/referrals.html?user_id=XV252517" title="Direct Referrals" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user-group"></i>
                </a>
                <a class="btn btn-outline-secondary" href="../admin/change-password.html?user_id=XV252517&amp;from=users" title="Change Password" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-key"></i>
                </a>
                                  <a class="btn btn-outline-secondary" href="../admin/login-as.html?user_id=XV252517" title="Login as user" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-user-secret"></i>
                  </a>
                                                  <a class="btn btn-outline-danger" href="../admin/block-user.html?user_id=XV252517&amp;from=users" data-act="block" data-uid="XV252517" title="Block User" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-ban"></i>
                  </a>
                              </div>
            </td>
          </tr>
                  <tr data-user-id="XV442258" data-name="poonam singh" data-email="berokakinz@gmail.com" data-status="active" data-kyc="pending">
            <td class="ps-3 text-muted small">14</td>
            <td><span class="fw-bold" style="color:var(--xvt-primary);">XV442258</span></td>
            <td>
              <div class="fw-semibold">POONAM SINGH</div>
              <div class="text-muted small">berokakinz@gmail.com</div>
            </td>
            <td>Beginner Pack</td>
            <td><span class="badge bg-success">Active</span></td>
            <td><span class="badge bg-warning text-dark">Pending</span></td>
            <td class="small text-muted">21 Apr 2026</td>
            <td class="text-end pe-3">
              <div class="btn-group btn-group-sm" role="group" aria-label="User actions">
                <a class="btn btn-outline-secondary" href="../admin/profile.html?user_id=XV442258" title="View Profile" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user"></i>
                </a>

                <a class="btn btn-outline-secondary" href="../admin/referrals.html?user_id=XV442258" title="Direct Referrals" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user-group"></i>
                </a>
                <a class="btn btn-outline-secondary" href="../admin/change-password.html?user_id=XV442258&amp;from=users" title="Change Password" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-key"></i>
                </a>
                                  <a class="btn btn-outline-secondary" href="../admin/login-as.html?user_id=XV442258" title="Login as user" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-user-secret"></i>
                  </a>
                                                  <a class="btn btn-outline-danger" href="../admin/block-user.html?user_id=XV442258&amp;from=users" data-act="block" data-uid="XV442258" title="Block User" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-ban"></i>
                  </a>
                              </div>
            </td>
          </tr>
                  <tr data-user-id="XV528556" data-name="ravishankar tiwari" data-email="snikit141@gmail.com" data-status="inactive" data-kyc="pending">
            <td class="ps-3 text-muted small">15</td>
            <td><span class="fw-bold" style="color:var(--xvt-primary);">XV528556</span></td>
            <td>
              <div class="fw-semibold">Ravishankar Tiwari</div>
              <div class="text-muted small">snikit141@gmail.com</div>
            </td>
            <td>$0</td>
            <td><span class="badge bg-secondary">Inactive</span></td>
            <td><span class="badge bg-warning text-dark">Pending</span></td>
            <td class="small text-muted">21 Apr 2026</td>
            <td class="text-end pe-3">
              <div class="btn-group btn-group-sm" role="group" aria-label="User actions">
                <a class="btn btn-outline-secondary" href="../admin/profile.html?user_id=XV528556" title="View Profile" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user"></i>
                </a>

                <a class="btn btn-outline-secondary" href="../admin/referrals.html?user_id=XV528556" title="Direct Referrals" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user-group"></i>
                </a>
                <a class="btn btn-outline-secondary" href="../admin/change-password.html?user_id=XV528556&amp;from=users" title="Change Password" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-key"></i>
                </a>
                                  <a class="btn btn-outline-secondary" href="../admin/login-as.html?user_id=XV528556" title="Login as user" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-user-secret"></i>
                  </a>
                                                  <a class="btn btn-outline-danger" href="../admin/block-user.html?user_id=XV528556&amp;from=users" data-act="block" data-uid="XV528556" title="Block User" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-ban"></i>
                  </a>
                              </div>
            </td>
          </tr>
                  <tr data-user-id="XV000001" data-name="xvoltytrade" data-email="user@xvoltytrade.com" data-status="active" data-kyc="approved">
            <td class="ps-3 text-muted small">16</td>
            <td><span class="fw-bold" style="color:var(--xvt-primary);">XV000001</span></td>
            <td>
              <div class="fw-semibold">XVoltyTrade</div>
              <div class="text-muted small">user@xvoltytrade.com</div>
            </td>
            <td>Starter Pack</td>
            <td><span class="badge bg-success">Active</span></td>
            <td><span class="badge bg-success">Approved</span></td>
            <td class="small text-muted">18 Apr 2026</td>
            <td class="text-end pe-3">
              <div class="btn-group btn-group-sm" role="group" aria-label="User actions">
                <a class="btn btn-outline-secondary" href="../admin/profile.html?user_id=XV000001" title="View Profile" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user"></i>
                </a>

                <a class="btn btn-outline-secondary" href="../admin/referrals.html?user_id=XV000001" title="Direct Referrals" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-user-group"></i>
                </a>
                <a class="btn btn-outline-secondary" href="../admin/change-password.html?user_id=XV000001&amp;from=users" title="Change Password" data-bs-toggle="tooltip">
                  <i class="fa-solid fa-key"></i>
                </a>
                                  <a class="btn btn-outline-secondary" href="../admin/login-as.html?user_id=XV000001" title="Login as user" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-user-secret"></i>
                  </a>
                                                  <a class="btn btn-outline-danger" href="../admin/block-user.html?user_id=XV000001&amp;from=users" data-act="block" data-uid="XV000001" title="Block User" data-bs-toggle="tooltip">
                    <i class="fa-solid fa-ban"></i>
                  </a>
                              </div>
            </td>
          </tr>
              </tbody>
    </table>
  </div>
</div>

<!-- ===== Bootstrap Modals ===== -->

<!-- View Profile -->
<div class="modal fade" id="profileModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa-solid fa-user-circle me-2"></i>User Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="profileModalBody">
        <div class="text-center py-5 text-muted"><i class="fa-solid fa-spinner fa-spin"></i> Loading...</div>
      </div>
    </div>
  </div>
</div>

<!-- Block User -->
<div class="modal fade" id="blockModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <form id="blockForm" class="modal-content">
      <input type="hidden" name="user_id" id="blockFormUserId">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa-solid fa-ban me-2 text-danger"></i>Block User <span id="blockUserId" class="text-muted"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-warning small"><i class="fa-solid fa-triangle-exclamation me-1"></i>Once blocked, the user will see a full-screen message with this exact reason on login.</div>
        <label for="block_reason" class="form-label">Reason for Blocking <span class="text-danger">*</span></label>
        <textarea id="block_reason" name="reason" rows="4" required="" class="form-control" placeholder="E.g., Suspicious activity, fraud, policy violation..."></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-ban me-1"></i>Confirm Block</button>
      </div>
    </form>
  </div>
</div>

<!-- Change Password -->
<div class="modal fade" id="passwordModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <form id="passwordForm" class="modal-content">
      <input type="hidden" name="user_id" id="pwdFormUserId">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa-solid fa-key me-2"></i>Change Password for <span id="pwdUserId" class="text-muted"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="new_password" class="form-label">New Password <span class="text-danger">*</span></label>
          <input type="password" id="new_password" name="new_password" required="" minlength="6" class="form-control" placeholder="Min 6 characters">
        </div>
        <div class="mb-0">
          <label for="confirm_password" class="form-label">Confirm New Password <span class="text-danger">*</span></label>
          <input type="password" id="confirm_password" name="confirm_password" required="" minlength="6" class="form-control" placeholder="Re-enter new password">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save me-1"></i>Update Password</button>
      </div>
    </form>
  </div>
</div>

<!-- Toast container -->
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index:3000;">
  <div id="umToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body d-flex align-items-center gap-2" id="umToastBody"></div>
  </div>
</div>

<script>
  window.UM_ACTION_URL = '../app/Controllers/api/admin_user_action.php';
  window.UM_DETAIL_URL = '../app/Controllers/api/get_user_details.php';
</script>
<script src="{{ asset('assets/User Management — Admin — XVolty Trade_files/user-management.js.download"></script>
<script>
// Inline filter logic (guaranteed to work after DOM is ready)
document.addEventListener('DOMContentLoaded', function() {
  var searchBox = document.getElementById('userSearch');
  var statusSel = document.getElementById('statusFilter');
  var kycSel    = document.getElementById('kycFilter');
  var tableBody = document.getElementById('usersTableBody');

  if (!tableBody) return;

  function applyFilters() {
    var q = (searchBox ? searchBox.value : '').trim().toLowerCase();
    var s = statusSel ? statusSel.value : '';
    var k = kycSel ? kycSel.value : '';

    var rows = tableBody.querySelectorAll('tr[data-user-id]');
    for (var i = 0; i < rows.length; i++) {
      var tr = rows[i];
      var uid    = (tr.getAttribute('data-user-id') || '').toLowerCase();
      var name   = (tr.getAttribute('data-name') || '');
      var email  = (tr.getAttribute('data-email') || '');
      var status = (tr.getAttribute('data-status') || '');
      var kyc    = (tr.getAttribute('data-kyc') || '');

      var matchQ = !q || uid.indexOf(q) !== -1 || name.indexOf(q) !== -1 || email.indexOf(q) !== -1;
      var matchS = !s || status === s;
      var matchK = !k || kyc === k;

      tr.style.display = (matchQ && matchS && matchK) ? '' : 'none';
    }
  }

  if (searchBox) searchBox.addEventListener('input', applyFilters);
  if (searchBox) searchBox.addEventListener('keyup', applyFilters);
  if (statusSel) statusSel.addEventListener('change', applyFilters);
  if (kycSel)    kycSel.addEventListener('change', applyFilters);
});
</script>
@endsection
