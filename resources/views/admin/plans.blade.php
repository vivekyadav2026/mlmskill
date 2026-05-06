@extends('layouts.admin')
@section('title', 'Package Plans — Admin — XVolty Trade')

@section('content')
<!-- Flash Messages -->

<!-- Page Header -->
<div class="d-flex align-items-center justify-content-between mb-4">
  <div>
    <h3 class="fw-heading mb-1">Package Plans</h3>
    <p class="text-muted mb-0 small">Manage investment packages. All percentages and caps are configurable.</p>
  </div>
  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#packageModal" onclick="openCreateModal()">
    <i class="fa-solid fa-plus me-1"></i> Add Package
  </button>
</div>

<!-- Stats Row -->
<div class="row g-3 mb-4">
  <div class="col-6 col-lg-3">
    <div class="card border-themed h-100"><div class="card-body text-center">
      <div class="text-muted small">Total Packages</div>
      <h3 class="fw-bold mb-0">8</h3>
    </div></div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="card border-themed h-100"><div class="card-body text-center">
      <div class="text-muted small">Active</div>
      <h3 class="fw-bold mb-0 text-success">8</h3>
    </div></div>
  </div>
  <div class="col-6 col-lg-3">
    <div class="card border-themed h-100"><div class="card-body text-center">
      <div class="text-muted small">Inactive</div>
      <h3 class="fw-bold mb-0 text-danger">0</h3>
    </div></div>
  </div>
</div>

<!-- Packages Table -->
<div class="card border-themed">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead>
          <tr>
            <th>#</th>
            <th>Image</th>
            <th>Package Name</th>
            <th>Amount ($)</th>
            <th>Daily ROI %</th>
            <th>ROI Days/Week</th>
            <th>Cap Multiplier</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
                                    <tr>
                <td>1</td>
                <td>
                                      <div class="d-flex align-items-center justify-content-center text-muted" style="width:48px;height:48px;border-radius:8px;background:var(--xvt-card-bg);border:1px dashed var(--xvt-border);"><i class="fa-solid fa-image"></i></div>
                                  </td>
                <td class="fw-semibold">Starter Pack</td>
                <td>$21.00</td>
                <td>1.0000%</td>
                <td>6</td>
                <td>5.00×</td>
                <td>
                                      <span class="badge bg-success">Active</span>
                                  </td>
                <td>
                  <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary" title="Edit" onclick="openEditModal({&quot;id&quot;:1,&quot;package_name&quot;:&quot;Starter Pack&quot;,&quot;image_url&quot;:null,&quot;amount&quot;:&quot;21.00&quot;,&quot;daily_roi_percent&quot;:&quot;1.0000&quot;,&quot;roi_days_per_week&quot;:6,&quot;cap_multiplier&quot;:&quot;5.00&quot;,&quot;status&quot;:&quot;active&quot;,&quot;created_at&quot;:&quot;2026-04-20 09:21:14&quot;,&quot;updated_at&quot;:&quot;2026-04-22 09:09:32&quot;})">
                      <i class="fa-solid fa-pen"></i>
                    </button>
                    <form method="POST" style="display:inline;">
                      <input type="hidden" name="action" value="toggle">
                      <input type="hidden" name="id" value="1">
                      <button type="submit" class="btn btn-outline-warning" title="Deactivate">
                        <i class="fa-solid fa-pause"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
                          <tr>
                <td>2</td>
                <td>
                                      <div class="d-flex align-items-center justify-content-center text-muted" style="width:48px;height:48px;border-radius:8px;background:var(--xvt-card-bg);border:1px dashed var(--xvt-border);"><i class="fa-solid fa-image"></i></div>
                                  </td>
                <td class="fw-semibold">Beginner Pack</td>
                <td>$50.00</td>
                <td>1.0000%</td>
                <td>6</td>
                <td>5.00×</td>
                <td>
                                      <span class="badge bg-success">Active</span>
                                  </td>
                <td>
                  <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary" title="Edit" onclick="openEditModal({&quot;id&quot;:2,&quot;package_name&quot;:&quot;Beginner Pack&quot;,&quot;image_url&quot;:null,&quot;amount&quot;:&quot;50.00&quot;,&quot;daily_roi_percent&quot;:&quot;1.0000&quot;,&quot;roi_days_per_week&quot;:6,&quot;cap_multiplier&quot;:&quot;5.00&quot;,&quot;status&quot;:&quot;active&quot;,&quot;created_at&quot;:&quot;2026-04-20 09:21:14&quot;,&quot;updated_at&quot;:&quot;2026-04-20 09:21:14&quot;})">
                      <i class="fa-solid fa-pen"></i>
                    </button>
                    <form method="POST" style="display:inline;">
                      <input type="hidden" name="action" value="toggle">
                      <input type="hidden" name="id" value="2">
                      <button type="submit" class="btn btn-outline-warning" title="Deactivate">
                        <i class="fa-solid fa-pause"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
                          <tr>
                <td>3</td>
                <td>
                                      <div class="d-flex align-items-center justify-content-center text-muted" style="width:48px;height:48px;border-radius:8px;background:var(--xvt-card-bg);border:1px dashed var(--xvt-border);"><i class="fa-solid fa-image"></i></div>
                                  </td>
                <td class="fw-semibold">Learner Pack</td>
                <td>$100.00</td>
                <td>1.0000%</td>
                <td>6</td>
                <td>5.00×</td>
                <td>
                                      <span class="badge bg-success">Active</span>
                                  </td>
                <td>
                  <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary" title="Edit" onclick="openEditModal({&quot;id&quot;:3,&quot;package_name&quot;:&quot;Learner Pack&quot;,&quot;image_url&quot;:null,&quot;amount&quot;:&quot;100.00&quot;,&quot;daily_roi_percent&quot;:&quot;1.0000&quot;,&quot;roi_days_per_week&quot;:6,&quot;cap_multiplier&quot;:&quot;5.00&quot;,&quot;status&quot;:&quot;active&quot;,&quot;created_at&quot;:&quot;2026-04-20 09:21:14&quot;,&quot;updated_at&quot;:&quot;2026-04-20 09:21:14&quot;})">
                      <i class="fa-solid fa-pen"></i>
                    </button>
                    <form method="POST" style="display:inline;">
                      <input type="hidden" name="action" value="toggle">
                      <input type="hidden" name="id" value="3">
                      <button type="submit" class="btn btn-outline-warning" title="Deactivate">
                        <i class="fa-solid fa-pause"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
                          <tr>
                <td>4</td>
                <td>
                                      <div class="d-flex align-items-center justify-content-center text-muted" style="width:48px;height:48px;border-radius:8px;background:var(--xvt-card-bg);border:1px dashed var(--xvt-border);"><i class="fa-solid fa-image"></i></div>
                                  </td>
                <td class="fw-semibold">Trader Pack</td>
                <td>$250.00</td>
                <td>1.0000%</td>
                <td>6</td>
                <td>5.00×</td>
                <td>
                                      <span class="badge bg-success">Active</span>
                                  </td>
                <td>
                  <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary" title="Edit" onclick="openEditModal({&quot;id&quot;:4,&quot;package_name&quot;:&quot;Trader Pack&quot;,&quot;image_url&quot;:null,&quot;amount&quot;:&quot;250.00&quot;,&quot;daily_roi_percent&quot;:&quot;1.0000&quot;,&quot;roi_days_per_week&quot;:6,&quot;cap_multiplier&quot;:&quot;5.00&quot;,&quot;status&quot;:&quot;active&quot;,&quot;created_at&quot;:&quot;2026-04-20 09:21:14&quot;,&quot;updated_at&quot;:&quot;2026-04-20 09:21:14&quot;})">
                      <i class="fa-solid fa-pen"></i>
                    </button>
                    <form method="POST" style="display:inline;">
                      <input type="hidden" name="action" value="toggle">
                      <input type="hidden" name="id" value="4">
                      <button type="submit" class="btn btn-outline-warning" title="Deactivate">
                        <i class="fa-solid fa-pause"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
                          <tr>
                <td>5</td>
                <td>
                                      <div class="d-flex align-items-center justify-content-center text-muted" style="width:48px;height:48px;border-radius:8px;background:var(--xvt-card-bg);border:1px dashed var(--xvt-border);"><i class="fa-solid fa-image"></i></div>
                                  </td>
                <td class="fw-semibold">Investor Pack</td>
                <td>$500.00</td>
                <td>1.0000%</td>
                <td>6</td>
                <td>5.00×</td>
                <td>
                                      <span class="badge bg-success">Active</span>
                                  </td>
                <td>
                  <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary" title="Edit" onclick="openEditModal({&quot;id&quot;:5,&quot;package_name&quot;:&quot;Investor Pack&quot;,&quot;image_url&quot;:null,&quot;amount&quot;:&quot;500.00&quot;,&quot;daily_roi_percent&quot;:&quot;1.0000&quot;,&quot;roi_days_per_week&quot;:6,&quot;cap_multiplier&quot;:&quot;5.00&quot;,&quot;status&quot;:&quot;active&quot;,&quot;created_at&quot;:&quot;2026-04-20 09:21:14&quot;,&quot;updated_at&quot;:&quot;2026-04-20 09:21:14&quot;})">
                      <i class="fa-solid fa-pen"></i>
                    </button>
                    <form method="POST" style="display:inline;">
                      <input type="hidden" name="action" value="toggle">
                      <input type="hidden" name="id" value="5">
                      <button type="submit" class="btn btn-outline-warning" title="Deactivate">
                        <i class="fa-solid fa-pause"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
                          <tr>
                <td>6</td>
                <td>
                                      <div class="d-flex align-items-center justify-content-center text-muted" style="width:48px;height:48px;border-radius:8px;background:var(--xvt-card-bg);border:1px dashed var(--xvt-border);"><i class="fa-solid fa-image"></i></div>
                                  </td>
                <td class="fw-semibold">Pro Investor</td>
                <td>$1,000.00</td>
                <td>1.0000%</td>
                <td>6</td>
                <td>5.00×</td>
                <td>
                                      <span class="badge bg-success">Active</span>
                                  </td>
                <td>
                  <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary" title="Edit" onclick="openEditModal({&quot;id&quot;:6,&quot;package_name&quot;:&quot;Pro Investor&quot;,&quot;image_url&quot;:null,&quot;amount&quot;:&quot;1000.00&quot;,&quot;daily_roi_percent&quot;:&quot;1.0000&quot;,&quot;roi_days_per_week&quot;:6,&quot;cap_multiplier&quot;:&quot;5.00&quot;,&quot;status&quot;:&quot;active&quot;,&quot;created_at&quot;:&quot;2026-04-20 09:21:14&quot;,&quot;updated_at&quot;:&quot;2026-04-20 09:21:14&quot;})">
                      <i class="fa-solid fa-pen"></i>
                    </button>
                    <form method="POST" style="display:inline;">
                      <input type="hidden" name="action" value="toggle">
                      <input type="hidden" name="id" value="6">
                      <button type="submit" class="btn btn-outline-warning" title="Deactivate">
                        <i class="fa-solid fa-pause"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
                          <tr>
                <td>7</td>
                <td>
                                      <div class="d-flex align-items-center justify-content-center text-muted" style="width:48px;height:48px;border-radius:8px;background:var(--xvt-card-bg);border:1px dashed var(--xvt-border);"><i class="fa-solid fa-image"></i></div>
                                  </td>
                <td class="fw-semibold">Gold Investor</td>
                <td>$2,500.00</td>
                <td>1.0000%</td>
                <td>6</td>
                <td>5.00×</td>
                <td>
                                      <span class="badge bg-success">Active</span>
                                  </td>
                <td>
                  <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary" title="Edit" onclick="openEditModal({&quot;id&quot;:7,&quot;package_name&quot;:&quot;Gold Investor&quot;,&quot;image_url&quot;:null,&quot;amount&quot;:&quot;2500.00&quot;,&quot;daily_roi_percent&quot;:&quot;1.0000&quot;,&quot;roi_days_per_week&quot;:6,&quot;cap_multiplier&quot;:&quot;5.00&quot;,&quot;status&quot;:&quot;active&quot;,&quot;created_at&quot;:&quot;2026-04-20 09:21:14&quot;,&quot;updated_at&quot;:&quot;2026-04-20 09:21:14&quot;})">
                      <i class="fa-solid fa-pen"></i>
                    </button>
                    <form method="POST" style="display:inline;">
                      <input type="hidden" name="action" value="toggle">
                      <input type="hidden" name="id" value="7">
                      <button type="submit" class="btn btn-outline-warning" title="Deactivate">
                        <i class="fa-solid fa-pause"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
                          <tr>
                <td>8</td>
                <td>
                                      <div class="d-flex align-items-center justify-content-center text-muted" style="width:48px;height:48px;border-radius:8px;background:var(--xvt-card-bg);border:1px dashed var(--xvt-border);"><i class="fa-solid fa-image"></i></div>
                                  </td>
                <td class="fw-semibold">Diamond Investor</td>
                <td>$5,000.00</td>
                <td>1.0000%</td>
                <td>6</td>
                <td>5.00×</td>
                <td>
                                      <span class="badge bg-success">Active</span>
                                  </td>
                <td>
                  <div class="btn-group btn-group-sm">
                    <button class="btn btn-outline-primary" title="Edit" onclick="openEditModal({&quot;id&quot;:8,&quot;package_name&quot;:&quot;Diamond Investor&quot;,&quot;image_url&quot;:null,&quot;amount&quot;:&quot;5000.00&quot;,&quot;daily_roi_percent&quot;:&quot;1.0000&quot;,&quot;roi_days_per_week&quot;:6,&quot;cap_multiplier&quot;:&quot;5.00&quot;,&quot;status&quot;:&quot;active&quot;,&quot;created_at&quot;:&quot;2026-04-20 09:21:14&quot;,&quot;updated_at&quot;:&quot;2026-04-20 09:21:14&quot;})">
                      <i class="fa-solid fa-pen"></i>
                    </button>
                    <form method="POST" style="display:inline;">
                      <input type="hidden" name="action" value="toggle">
                      <input type="hidden" name="id" value="8">
                      <button type="submit" class="btn btn-outline-warning" title="Deactivate">
                        <i class="fa-solid fa-pause"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
                              </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Package Modal (Create / Edit) -->
<div class="modal fade" id="packageModal" tabindex="-1">
  <div class="modal-dialog"><div class="modal-content">
    <form method="POST" id="packageForm" enctype="multipart/form-data">
      <input type="hidden" name="action" id="pkgAction" value="create">
      <input type="hidden" name="id" id="pkgId" value="">
      <input type="hidden" name="remove_image" id="pkgRemoveImage" value="0">
      <div class="modal-header">
        <h5 class="modal-title" id="pkgModalTitle">Add Package</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3 text-center" id="pkgImagePreviewWrap">
          <img id="pkgImagePreview" src="../admin/plans.html" alt="" class="d-none" style="max-height:140px;border-radius:10px;border:1px solid var(--xvt-border);">
          <div id="pkgImagePlaceholder" class="d-inline-flex align-items-center justify-content-center text-muted" style="width:100px;height:100px;border-radius:10px;background:var(--xvt-card-bg);border:1px dashed var(--xvt-border);"><i class="fa-solid fa-image fa-2x"></i></div>
          <div class="mt-2">
            <button type="button" class="btn btn-sm btn-outline-danger d-none" id="pkgRemoveImageBtn" onclick="removePkgImage()"><i class="fa-solid fa-trash me-1"></i> Remove Image</button>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Package Image <small class="text-muted">(JPG, PNG, WebP, GIF — max 2MB)</small></label>
          <input type="file" name="image" id="pkgImageInput" accept="image/jpeg,image/png,image/webp,image/gif" class="form-control" onchange="previewPkgImage(event)">
        </div>
        <div class="mb-3">
          <label class="form-label">Package Name <span class="text-danger">*</span></label>
          <input type="text" name="package_name" id="pkgName" class="form-control" required="">
        </div>
        <div class="row g-3">
          <div class="col-md-6 mb-3">
            <label class="form-label">Amount ($) <span class="text-danger">*</span></label>
            <input type="number" step="0.01" min="1" name="amount" id="pkgAmount" class="form-control" required="">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Daily ROI %</label>
            <input type="number" step="0.0001" min="0" name="daily_roi_percent" id="pkgROI" class="form-control" value="1.0000">
          </div>
        </div>
        <div class="row g-3">
          <div class="col-md-4 mb-3">
            <label class="form-label">ROI Days/Week</label>
            <input type="number" min="1" max="7" name="roi_days_per_week" id="pkgDays" class="form-control" value="6">
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label">Cap Multiplier</label>
            <input type="number" step="0.01" min="1" name="cap_multiplier" id="pkgCap" class="form-control" value="5.00">
          </div>
          <div class="col-md-4 mb-3">
            <label class="form-label">Status</label>
            <select name="status" id="pkgStatus" class="form-select">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" id="pkgSubmitBtn">Create Package</button>
      </div>
    </form>
  </div></div>
</div>

<script>
function resetPkgImagePreview() {
  const img = document.getElementById('pkgImagePreview');
  const ph  = document.getElementById('pkgImagePlaceholder');
  const btn = document.getElementById('pkgRemoveImageBtn');
  img.src = '';
  img.classList.add('d-none');
  ph.classList.remove('d-none');
  btn.classList.add('d-none');
  document.getElementById('pkgRemoveImage').value = '0';
  document.getElementById('pkgImageInput').value = '';
}
function showPkgImagePreview(url) {
  const img = document.getElementById('pkgImagePreview');
  const ph  = document.getElementById('pkgImagePlaceholder');
  const btn = document.getElementById('pkgRemoveImageBtn');
  img.src = url;
  img.classList.remove('d-none');
  ph.classList.add('d-none');
  btn.classList.remove('d-none');
}
function previewPkgImage(ev) {
  const f = ev.target.files[0];
  if (!f) return;
  const r = new FileReader();
  r.onload = e => showPkgImagePreview(e.target.result);
  r.readAsDataURL(f);
  document.getElementById('pkgRemoveImage').value = '0';
}
function removePkgImage() {
  document.getElementById('pkgImageInput').value = '';
  document.getElementById('pkgRemoveImage').value = '1';
  resetPkgImagePreview();
}
function openCreateModal() {
  document.getElementById('pkgAction').value = 'create';
  document.getElementById('pkgId').value = '';
  document.getElementById('pkgModalTitle').textContent = 'Add Package';
  document.getElementById('pkgSubmitBtn').textContent = 'Create Package';
  document.getElementById('packageForm').reset();
  document.getElementById('pkgDays').value = 6;
  document.getElementById('pkgCap').value = '5.00';
  document.getElementById('pkgROI').value = '1.0000';
  resetPkgImagePreview();
}
function openEditModal(pkg) {
  document.getElementById('pkgAction').value = 'update';
  document.getElementById('pkgId').value = pkg.id;
  document.getElementById('pkgModalTitle').textContent = 'Edit Package';
  document.getElementById('pkgSubmitBtn').textContent = 'Update Package';
  document.getElementById('pkgName').value = pkg.package_name;
  document.getElementById('pkgAmount').value = pkg.amount;
  document.getElementById('pkgROI').value = pkg.daily_roi_percent;
  document.getElementById('pkgDays').value = pkg.roi_days_per_week;
  document.getElementById('pkgCap').value = pkg.cap_multiplier;
  document.getElementById('pkgStatus').value = pkg.status;
  resetPkgImagePreview();
  if (pkg.image_url) {
    showPkgImagePreview('../' + pkg.image_url);
  }
  new bootstrap.Modal(document.getElementById('packageModal')).show();
}
</script>
@endsection
