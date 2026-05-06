@extends('layouts.admin')
@section('title', 'Capping Settings — XVolty Trade')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4"><div><h3 class="fw-heading mb-1"><i class="fa-solid fa-shield me-2"></i>Capping Settings</h3><p class="text-muted mb-0 small">Dynamic capping profiles — cap multiplier is determined by direct referrals.</p></div></div>
<!-- ─── Profile Management ─── -->
<div class="card border-themed mb-4">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h6 class="mb-0"><i class="fa-solid fa-layer-group me-2"></i>Capping Profiles</h6>
    <div class="d-flex gap-2">
      <form method="POST" class="d-inline">
        <input type="hidden" name="action" value="recalc_all">
        <button type="submit" class="btn btn-outline-warning btn-sm" onclick="return confirm(&#39;Recalculate earning caps for ALL active activations?&#39;)">
          <i class="fa-solid fa-arrows-rotate me-1"></i> Recalc All Caps
        </button>
      </form>
      <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#profileModal" onclick="openNewProfile()">
        <i class="fa-solid fa-plus me-1"></i> New Profile
      </button>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-hover mb-0 align-middle">
      <thead class="small text-muted text-uppercase">
        <tr>
          <th class="ps-3">Profile</th>
          <th>Direct Range</th>
          <th>Cap Multiplier</th>
          <th>Users</th>
          <th>Priority</th>
          <th>Status</th>
          <th class="pe-3 text-end">Actions</th>
        </tr>
      </thead>
      <tbody>
              <tr>
          <td class="ps-3"><strong>Working</strong></td>
          <td><span class="badge bg-secondary">3 – ∞</span></td>
          <td><span class="fw-bold text-primary">5.00×</span></td>
          <td>0</td>
          <td>1</td>
          <td><span class="badge bg-success">Active</span></td>
          <td class="pe-3 text-end">
            <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#profileModal" onclick="openEditProfile({&quot;id&quot;:2,&quot;profile_name&quot;:&quot;Working&quot;,&quot;min_directs&quot;:3,&quot;max_directs&quot;:null,&quot;cap_multiplier&quot;:&quot;5.00&quot;,&quot;status&quot;:&quot;active&quot;,&quot;priority&quot;:1,&quot;created_at&quot;:&quot;2026-04-20 10:22:45&quot;,&quot;updated_at&quot;:&quot;2026-04-20 10:31:16&quot;})">
              <i class="fa-solid fa-pen"></i>
            </button>
            <form method="POST" class="d-inline">
              <input type="hidden" name="action" value="delete_profile">
              <input type="hidden" name="profile_id" value="2">
              <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm(&#39;Delete profile &quot;Working&quot;?&#39;)">
                <i class="fa-solid fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
              <tr>
          <td class="ps-3"><strong>Non Working</strong></td>
          <td><span class="badge bg-secondary">0 – 2</span></td>
          <td><span class="fw-bold text-primary">2.00×</span></td>
          <td>16</td>
          <td>2</td>
          <td><span class="badge bg-success">Active</span></td>
          <td class="pe-3 text-end">
            <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#profileModal" onclick="openEditProfile({&quot;id&quot;:1,&quot;profile_name&quot;:&quot;Non Working&quot;,&quot;min_directs&quot;:0,&quot;max_directs&quot;:2,&quot;cap_multiplier&quot;:&quot;2.00&quot;,&quot;status&quot;:&quot;active&quot;,&quot;priority&quot;:2,&quot;created_at&quot;:&quot;2026-04-20 10:22:45&quot;,&quot;updated_at&quot;:&quot;2026-04-20 10:31:41&quot;})">
              <i class="fa-solid fa-pen"></i>
            </button>
            <form method="POST" class="d-inline">
              <input type="hidden" name="action" value="delete_profile">
              <input type="hidden" name="profile_id" value="1">
              <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm(&#39;Delete profile &quot;Non Working&quot;?&#39;)">
                <i class="fa-solid fa-trash"></i>
              </button>
            </form>
          </td>
        </tr>
            </tbody>
    </table>
  </div>
</div>

<!-- ─── Income Types Counted Toward Cap ─── -->
<form method="POST">
  <input type="hidden" name="action" value="save_income_toggles">
  <div class="card border-themed mb-4">
    <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-list-check me-2"></i>Income Types Counted Toward Cap</h6></div>
    <div class="card-body">
      <p class="text-muted small mb-3">Uncheck to exclude an income type from the cap calculation (it will still be paid).</p>
      <div class="row g-3">
                <div class="col-md-4 col-6">
          <div class="card border-themed h-100">
            <div class="card-body py-3">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="cap_income_roi" value="1" id="cap_income_roi" checked="">
                <label class="form-check-label d-flex align-items-center" for="cap_income_roi">
                  <i class="fa-solid fa-chart-line me-2 text-primary"></i> ROI Income                </label>
              </div>
            </div>
          </div>
        </div>
                <div class="col-md-4 col-6">
          <div class="card border-themed h-100">
            <div class="card-body py-3">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="cap_income_direct" value="1" id="cap_income_direct" checked="">
                <label class="form-check-label d-flex align-items-center" for="cap_income_direct">
                  <i class="fa-solid fa-handshake me-2 text-primary"></i> Direct Income                </label>
              </div>
            </div>
          </div>
        </div>
                <div class="col-md-4 col-6">
          <div class="card border-themed h-100">
            <div class="card-body py-3">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="cap_income_level" value="1" id="cap_income_level" checked="">
                <label class="form-check-label d-flex align-items-center" for="cap_income_level">
                  <i class="fa-solid fa-layer-group me-2 text-primary"></i> Level Income                </label>
              </div>
            </div>
          </div>
        </div>
                <div class="col-md-4 col-6">
          <div class="card border-themed h-100">
            <div class="card-body py-3">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="cap_income_salary" value="1" id="cap_income_salary" checked="">
                <label class="form-check-label d-flex align-items-center" for="cap_income_salary">
                  <i class="fa-solid fa-money-bill me-2 text-primary"></i> Salary Income                </label>
              </div>
            </div>
          </div>
        </div>
                <div class="col-md-4 col-6">
          <div class="card border-themed h-100">
            <div class="card-body py-3">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="cap_income_rank_reward" value="1" id="cap_income_rank_reward" checked="">
                <label class="form-check-label d-flex align-items-center" for="cap_income_rank_reward">
                  <i class="fa-solid fa-trophy me-2 text-primary"></i> Rank Reward                </label>
              </div>
            </div>
          </div>
        </div>
              </div>
    </div>
  </div>
  <button type="submit" class="btn btn-primary mb-4"><i class="fa-solid fa-check me-1"></i> Save Income Toggles</button>
</form>

<!-- ─── Audit Log ─── -->
<div class="card border-themed mb-4">
  <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-clock-rotate-left me-2"></i>Recent Capping Changes</h6></div>
  <div class="table-responsive">
    <table class="table table-sm table-hover mb-0 align-middle">
      <thead class="small text-muted text-uppercase">
        <tr><th class="ps-3">Action</th><th>Details</th><th>Changed By</th><th class="pe-3">When</th></tr>
      </thead>
      <tbody>
              <tr>
          <td class="ps-3"><span class="badge bg-primary">Updated</span></td>
          <td class="small" style="max-width:400px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{&quot;profile_name&quot;:&quot;Non Working&quot;,&quot;min_directs&quot;:0,&quot;max_directs&quot;:2,&quot;cap_multiplier&quot;:2,&quot;status&quot;:&quot;active&quot;,&quot;priority&quot;:2}">{"profile_name":"Non Working","min_directs":0,"max_directs":2,"cap_multiplier":2</td>
          <td class="small">1</td>
          <td class="pe-3 small text-muted">2026-04-20 10:31:41</td>
        </tr>
              <tr>
          <td class="ps-3"><span class="badge bg-primary">Updated</span></td>
          <td class="small" style="max-width:400px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{&quot;profile_name&quot;:&quot;Working&quot;,&quot;min_directs&quot;:3,&quot;max_directs&quot;:null,&quot;cap_multiplier&quot;:5,&quot;status&quot;:&quot;active&quot;,&quot;priority&quot;:1}">{"profile_name":"Working","min_directs":3,"max_directs":null,"cap_multiplier":5,</td>
          <td class="small">1</td>
          <td class="pe-3 small text-muted">2026-04-20 10:31:16</td>
        </tr>
            </tbody>
    </table>
  </div>
</div>

<!-- ─── Profile Create/Edit Modal ─── -->
<div class="modal fade" id="profileModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" id="profileForm">
        <input type="hidden" name="action" id="formAction" value="create_profile">
        <input type="hidden" name="profile_id" id="formProfileId" value="">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitle">New Capping Profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Profile Name <span class="text-danger">*</span></label>
            <input type="text" name="profile_name" id="fName" class="form-control" required="" maxlength="100">
          </div>
          <div class="row g-3 mb-3">
            <div class="col-6">
              <label class="form-label">Min Directs <span class="text-danger">*</span></label>
              <input type="number" name="min_directs" id="fMin" class="form-control" min="0" required="">
            </div>
            <div class="col-6">
              <label class="form-label">Max Directs <small class="text-muted">(blank = ∞)</small></label>
              <input type="number" name="max_directs" id="fMax" class="form-control" min="0">
            </div>
          </div>
          <div class="row g-3 mb-3">
            <div class="col-6">
              <label class="form-label">Cap Multiplier <span class="text-danger">*</span></label>
              <div class="input-group">
                <input type="number" step="0.01" min="0.01" name="cap_multiplier" id="fMul" class="form-control" required="">
                <span class="input-group-text">×</span>
              </div>
            </div>
            <div class="col-6">
              <label class="form-label">Priority</label>
              <input type="number" name="priority" id="fPri" class="form-control" min="0" value="0">
              <small class="text-muted">Lower = checked first</small>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" id="fStatus" class="form-select">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" id="formSubmitBtn"><i class="fa-solid fa-check me-1"></i> Create</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function openNewProfile() {
  document.getElementById('modalTitle').textContent = 'New Capping Profile';
  document.getElementById('formAction').value = 'create_profile';
  document.getElementById('formProfileId').value = '';
  document.getElementById('formSubmitBtn').innerHTML = '<i class="fa-solid fa-check me-1"></i> Create';
  document.getElementById('fName').value = '';
  document.getElementById('fMin').value = '0';
  document.getElementById('fMax').value = '';
  document.getElementById('fMul').value = '';
  document.getElementById('fPri').value = '0';
  document.getElementById('fStatus').value = 'active';
}
function openEditProfile(p) {
  document.getElementById('modalTitle').textContent = 'Edit Capping Profile';
  document.getElementById('formAction').value = 'update_profile';
  document.getElementById('formProfileId').value = p.id;
  document.getElementById('formSubmitBtn').innerHTML = '<i class="fa-solid fa-check me-1"></i> Update';
  document.getElementById('fName').value = p.profile_name;
  document.getElementById('fMin').value = p.min_directs;
  document.getElementById('fMax').value = p.max_directs ?? '';
  document.getElementById('fMul').value = p.cap_multiplier;
  document.getElementById('fPri').value = p.priority;
  document.getElementById('fStatus').value = p.status;
}
</script>
@endsection
