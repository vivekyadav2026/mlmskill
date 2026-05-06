@extends('layouts.admin')
@section('title', 'Weekly Salary Settings — XVolty Trade')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4"><div><h3 class="fw-heading mb-1"><i class="fa-solid fa-money-bill me-2"></i>Weekly Salary Settings</h3><p class="text-muted mb-0 small">Rank-based weekly salary. Document presets: S1–S5 with chained qualifications.</p></div></div>
<form method="POST">
  <input type="hidden" name="action" value="save_all">

  <div class="card border-themed mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h6 class="mb-0"><i class="fa-solid fa-gauge me-2"></i>Engine &amp; Cron Status</h6>
    </div>
    <div class="card-body">
      <div class="row g-3">
        <div class="col-md-4"><label class="form-label">Salary Engine</label>
          <select name="salary_engine_enabled" class="form-select">
            <option value="enabled" selected="">Enabled</option>
            <option value="disabled">Disabled</option>
          </select>
        </div>
        <div class="col-md-4"><label class="form-label">Weekly Cron</label>
          <select name="cron_weekly_salary" class="form-select">
            <option value="enabled" selected="">Enabled</option>
            <option value="disabled">Disabled</option>
          </select>
        </div>
      </div>
    </div>
  </div>

  <div class="card border-themed mb-4">
    <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-list-ol me-2"></i>Salary Ranks (S1–S5)</h6></div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th class="ps-3">Rank</th>
              <th>Required Directs</th>
              <th>Must Have Achieved</th>
              <th>Weekly Salary ($)</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
                          <tr>
                <td class="ps-3 fw-semibold">S1 — Bronze</td>
                <td><input type="number" min="0" name="rank[1][directs]" class="form-control form-control-sm" style="max-width:100px;" value="5"></td>
                <td>
                  <select name="rank[1][required_rank_id]" class="form-select form-select-sm" style="max-width:200px;">
                    <option value="">— None (base rank)</option>
                                          <option value="2">S2 — Silver</option>
                                          <option value="3">S3 — Gold</option>
                                          <option value="4">S4 — Platinum</option>
                                          <option value="5">S5 — Diamond</option>
                                      </select>
                </td>
                <td><input type="number" step="0.01" min="0" name="rank[1][salary]" class="form-control form-control-sm" style="max-width:130px;" value="12.00"></td>
                <td>
                  <select name="rank[1][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
              </tr>
                          <tr>
                <td class="ps-3 fw-semibold">S2 — Silver</td>
                <td><input type="number" min="0" name="rank[2][directs]" class="form-control form-control-sm" style="max-width:100px;" value="3"></td>
                <td>
                  <select name="rank[2][required_rank_id]" class="form-select form-select-sm" style="max-width:200px;">
                    <option value="">— None (base rank)</option>
                                          <option value="1" selected="">S1 — Bronze</option>
                                          <option value="3">S3 — Gold</option>
                                          <option value="4">S4 — Platinum</option>
                                          <option value="5">S5 — Diamond</option>
                                      </select>
                </td>
                <td><input type="number" step="0.01" min="0" name="rank[2][salary]" class="form-control form-control-sm" style="max-width:130px;" value="25.00"></td>
                <td>
                  <select name="rank[2][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
              </tr>
                          <tr>
                <td class="ps-3 fw-semibold">S3 — Gold</td>
                <td><input type="number" min="0" name="rank[3][directs]" class="form-control form-control-sm" style="max-width:100px;" value="3"></td>
                <td>
                  <select name="rank[3][required_rank_id]" class="form-select form-select-sm" style="max-width:200px;">
                    <option value="">— None (base rank)</option>
                                          <option value="1">S1 — Bronze</option>
                                          <option value="2" selected="">S2 — Silver</option>
                                          <option value="4">S4 — Platinum</option>
                                          <option value="5">S5 — Diamond</option>
                                      </select>
                </td>
                <td><input type="number" step="0.01" min="0" name="rank[3][salary]" class="form-control form-control-sm" style="max-width:130px;" value="50.00"></td>
                <td>
                  <select name="rank[3][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
              </tr>
                          <tr>
                <td class="ps-3 fw-semibold">S4 — Platinum</td>
                <td><input type="number" min="0" name="rank[4][directs]" class="form-control form-control-sm" style="max-width:100px;" value="3"></td>
                <td>
                  <select name="rank[4][required_rank_id]" class="form-select form-select-sm" style="max-width:200px;">
                    <option value="">— None (base rank)</option>
                                          <option value="1">S1 — Bronze</option>
                                          <option value="2">S2 — Silver</option>
                                          <option value="3" selected="">S3 — Gold</option>
                                          <option value="5">S5 — Diamond</option>
                                      </select>
                </td>
                <td><input type="number" step="0.01" min="0" name="rank[4][salary]" class="form-control form-control-sm" style="max-width:130px;" value="100.00"></td>
                <td>
                  <select name="rank[4][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
              </tr>
                          <tr>
                <td class="ps-3 fw-semibold">S5 — Diamond</td>
                <td><input type="number" min="0" name="rank[5][directs]" class="form-control form-control-sm" style="max-width:100px;" value="3"></td>
                <td>
                  <select name="rank[5][required_rank_id]" class="form-select form-select-sm" style="max-width:200px;">
                    <option value="">— None (base rank)</option>
                                          <option value="1">S1 — Bronze</option>
                                          <option value="2">S2 — Silver</option>
                                          <option value="3">S3 — Gold</option>
                                          <option value="4" selected="">S4 — Platinum</option>
                                      </select>
                </td>
                <td><input type="number" step="0.01" min="0" name="rank[5][salary]" class="form-control form-control-sm" style="max-width:130px;" value="200.00"></td>
                <td>
                  <select name="rank[5][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
              </tr>
                      </tbody>
        </table>
      </div>
      <div class="p-3 small text-muted border-top">
        <i class="fa-solid fa-info-circle me-1"></i> Document presets — S1: 5 directs w/ $100 min = $12, S2: 3×S1 = $25, S3: 3×S2 = $50, S4: 3×S3 = $100, S5: 3×S4 = $200.
        To <strong>rename</strong> ranks, use <a href="{{ url('admin/settings-ranks') }}">Rank Management</a>.
      </div>
    </div>
  </div>

  <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check me-1"></i> Save Salary Settings</button>
</form>

<!-- Add New Salary Rank -->
<div class="card border-themed mt-4">
  <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-plus me-2"></i>Add New Salary Rank</h6></div>
  <div class="card-body">
    <form method="POST" class="row g-3">
      <input type="hidden" name="action" value="add">
      <div class="col-md-5"><label class="form-label">Rank Name</label><input type="text" name="new_name" class="form-control" placeholder="e.g. S6 — Emerald" required=""></div>
      <div class="col-md-2"><label class="form-label">Required Directs</label><input type="number" min="0" name="new_directs" class="form-control" value="3"></div>
      <div class="col-md-3"><label class="form-label">Weekly Salary ($)</label><input type="number" step="0.01" min="0" name="new_salary" class="form-control" required=""></div>
      <div class="col-md-2 d-flex align-items-end"><button type="submit" class="btn btn-success w-100"><i class="fa-solid fa-plus me-1"></i> Add</button></div>
    </form>
  </div>
</div>
@endsection
