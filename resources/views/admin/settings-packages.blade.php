@extends('layouts.admin')
@section('title', 'Package Settings — XVolty Trade')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4"><div><h3 class="fw-heading mb-1"><i class="fa-solid fa-box me-2"></i>Package Settings</h3><p class="text-muted mb-0 small">Manage investment packages — 8 presets preloaded from the compensation document.</p></div></div>
<form method="POST">
  <input type="hidden" name="action" value="update_bulk">
  <div class="card border-themed mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h6 class="mb-0"><i class="fa-solid fa-list me-2"></i>All Packages</h6>
      <a href="{{ url('admin/plans') }}" class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-image me-1"></i> Manage Images</a>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th class="ps-3">Package Name</th>
              <th>Amount ($/$)</th>
              <th>Daily ROI %</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
                          <tr>
                <td class="ps-3"><input type="text" name="pkg[1][name]" class="form-control form-control-sm" value="Starter Pack" required=""></td>
                <td><input type="number" step="0.01" min="0" name="pkg[1][amount]" class="form-control form-control-sm" style="max-width:150px;" value="21.00" required=""></td>
                <td><input type="number" step="0.0001" min="0" max="100" name="pkg[1][roi]" class="form-control form-control-sm" style="max-width:120px;" value="1.0000"></td>
                <td>
                  <select name="pkg[1][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
              </tr>
                          <tr>
                <td class="ps-3"><input type="text" name="pkg[2][name]" class="form-control form-control-sm" value="Beginner Pack" required=""></td>
                <td><input type="number" step="0.01" min="0" name="pkg[2][amount]" class="form-control form-control-sm" style="max-width:150px;" value="50.00" required=""></td>
                <td><input type="number" step="0.0001" min="0" max="100" name="pkg[2][roi]" class="form-control form-control-sm" style="max-width:120px;" value="1.0000"></td>
                <td>
                  <select name="pkg[2][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
              </tr>
                          <tr>
                <td class="ps-3"><input type="text" name="pkg[3][name]" class="form-control form-control-sm" value="Learner Pack" required=""></td>
                <td><input type="number" step="0.01" min="0" name="pkg[3][amount]" class="form-control form-control-sm" style="max-width:150px;" value="100.00" required=""></td>
                <td><input type="number" step="0.0001" min="0" max="100" name="pkg[3][roi]" class="form-control form-control-sm" style="max-width:120px;" value="1.0000"></td>
                <td>
                  <select name="pkg[3][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
              </tr>
                          <tr>
                <td class="ps-3"><input type="text" name="pkg[4][name]" class="form-control form-control-sm" value="Trader Pack" required=""></td>
                <td><input type="number" step="0.01" min="0" name="pkg[4][amount]" class="form-control form-control-sm" style="max-width:150px;" value="250.00" required=""></td>
                <td><input type="number" step="0.0001" min="0" max="100" name="pkg[4][roi]" class="form-control form-control-sm" style="max-width:120px;" value="1.0000"></td>
                <td>
                  <select name="pkg[4][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
              </tr>
                          <tr>
                <td class="ps-3"><input type="text" name="pkg[5][name]" class="form-control form-control-sm" value="Investor Pack" required=""></td>
                <td><input type="number" step="0.01" min="0" name="pkg[5][amount]" class="form-control form-control-sm" style="max-width:150px;" value="500.00" required=""></td>
                <td><input type="number" step="0.0001" min="0" max="100" name="pkg[5][roi]" class="form-control form-control-sm" style="max-width:120px;" value="1.0000"></td>
                <td>
                  <select name="pkg[5][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
              </tr>
                          <tr>
                <td class="ps-3"><input type="text" name="pkg[6][name]" class="form-control form-control-sm" value="Pro Investor" required=""></td>
                <td><input type="number" step="0.01" min="0" name="pkg[6][amount]" class="form-control form-control-sm" style="max-width:150px;" value="1000.00" required=""></td>
                <td><input type="number" step="0.0001" min="0" max="100" name="pkg[6][roi]" class="form-control form-control-sm" style="max-width:120px;" value="1.0000"></td>
                <td>
                  <select name="pkg[6][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
              </tr>
                          <tr>
                <td class="ps-3"><input type="text" name="pkg[7][name]" class="form-control form-control-sm" value="Gold Investor" required=""></td>
                <td><input type="number" step="0.01" min="0" name="pkg[7][amount]" class="form-control form-control-sm" style="max-width:150px;" value="2500.00" required=""></td>
                <td><input type="number" step="0.0001" min="0" max="100" name="pkg[7][roi]" class="form-control form-control-sm" style="max-width:120px;" value="1.0000"></td>
                <td>
                  <select name="pkg[7][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
              </tr>
                          <tr>
                <td class="ps-3"><input type="text" name="pkg[8][name]" class="form-control form-control-sm" value="Diamond Investor" required=""></td>
                <td><input type="number" step="0.01" min="0" name="pkg[8][amount]" class="form-control form-control-sm" style="max-width:150px;" value="5000.00" required=""></td>
                <td><input type="number" step="0.0001" min="0" max="100" name="pkg[8][roi]" class="form-control form-control-sm" style="max-width:120px;" value="1.0000"></td>
                <td>
                  <select name="pkg[8][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
              </tr>
                      </tbody>
        </table>
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check me-1"></i> Save All Packages</button>
</form>

<!-- Add New Package -->
<div class="card border-themed mt-4">
  <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-plus me-2"></i>Add New Package</h6></div>
  <div class="card-body">
    <form method="POST" class="row g-3">
      <input type="hidden" name="action" value="add">
      <div class="col-md-5"><label class="form-label">Name</label><input type="text" name="new_name" class="form-control" required=""></div>
      <div class="col-md-3"><label class="form-label">Amount</label><input type="number" step="0.01" min="0" name="new_amount" class="form-control" required=""></div>
      <div class="col-md-2"><label class="form-label">ROI %</label><input type="number" step="0.0001" min="0" max="100" name="new_roi" class="form-control" value="1.0000"></div>
      <div class="col-md-2 d-flex align-items-end"><button type="submit" class="btn btn-success w-100"><i class="fa-solid fa-plus me-1"></i> Add</button></div>
    </form>
  </div>
</div>
@endsection
