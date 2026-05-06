@extends('layouts.admin')
@section('title', 'Level Income Settings — XVolty Trade')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4"><div><h3 class="fw-heading mb-1"><i class="fa-solid fa-layer-group me-2"></i>Level Income Settings</h3><p class="text-muted mb-0 small">8-level sponsor chain. Document presets: L1=5%, L2=4%, L3=4%, L4=3%, L5=2%, L6=2%, L7=1%, L8=1%.</p></div></div>
<form method="POST">
  <div class="card border-themed mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h6 class="mb-0"><i class="fa-solid fa-layer-group me-2"></i>8-Level Sponsor Chain</h6>
      <select name="level_income_enabled" class="form-select form-select-sm" style="width:auto;">
        <option value="enabled" selected="">Engine Enabled</option>
        <option value="disabled">Engine Disabled</option>
      </select>
    </div>
    <div class="card-body">
      <div class="row g-3">
                <div class="col-md-3 col-6">
          <label class="form-label fw-semibold">Level 1 <small class="text-muted">(preset 5%)</small></label>
          <div class="input-group">
            <input type="number" step="0.01" min="0" max="100" name="level_1_percent" class="form-control" value="5">
            <span class="input-group-text">%</span>
          </div>
          <div class="form-text small">
            <span class="text-success"><i class="fa-solid fa-check"></i> Active</span>          </div>
        </div>
                <div class="col-md-3 col-6">
          <label class="form-label fw-semibold">Level 2 <small class="text-muted">(preset 4%)</small></label>
          <div class="input-group">
            <input type="number" step="0.01" min="0" max="100" name="level_2_percent" class="form-control" value="4">
            <span class="input-group-text">%</span>
          </div>
          <div class="form-text small">
            <span class="text-success"><i class="fa-solid fa-check"></i> Active</span>          </div>
        </div>
                <div class="col-md-3 col-6">
          <label class="form-label fw-semibold">Level 3 <small class="text-muted">(preset 4%)</small></label>
          <div class="input-group">
            <input type="number" step="0.01" min="0" max="100" name="level_3_percent" class="form-control" value="4">
            <span class="input-group-text">%</span>
          </div>
          <div class="form-text small">
            <span class="text-success"><i class="fa-solid fa-check"></i> Active</span>          </div>
        </div>
                <div class="col-md-3 col-6">
          <label class="form-label fw-semibold">Level 4 <small class="text-muted">(preset 3%)</small></label>
          <div class="input-group">
            <input type="number" step="0.01" min="0" max="100" name="level_4_percent" class="form-control" value="3">
            <span class="input-group-text">%</span>
          </div>
          <div class="form-text small">
            <span class="text-success"><i class="fa-solid fa-check"></i> Active</span>          </div>
        </div>
                <div class="col-md-3 col-6">
          <label class="form-label fw-semibold">Level 5 <small class="text-muted">(preset 2%)</small></label>
          <div class="input-group">
            <input type="number" step="0.01" min="0" max="100" name="level_5_percent" class="form-control" value="2">
            <span class="input-group-text">%</span>
          </div>
          <div class="form-text small">
            <span class="text-success"><i class="fa-solid fa-check"></i> Active</span>          </div>
        </div>
                <div class="col-md-3 col-6">
          <label class="form-label fw-semibold">Level 6 <small class="text-muted">(preset 2%)</small></label>
          <div class="input-group">
            <input type="number" step="0.01" min="0" max="100" name="level_6_percent" class="form-control" value="2">
            <span class="input-group-text">%</span>
          </div>
          <div class="form-text small">
            <span class="text-success"><i class="fa-solid fa-check"></i> Active</span>          </div>
        </div>
                <div class="col-md-3 col-6">
          <label class="form-label fw-semibold">Level 7 <small class="text-muted">(preset 1%)</small></label>
          <div class="input-group">
            <input type="number" step="0.01" min="0" max="100" name="level_7_percent" class="form-control" value="1">
            <span class="input-group-text">%</span>
          </div>
          <div class="form-text small">
            <span class="text-success"><i class="fa-solid fa-check"></i> Active</span>          </div>
        </div>
                <div class="col-md-3 col-6">
          <label class="form-label fw-semibold">Level 8 <small class="text-muted">(preset 1%)</small></label>
          <div class="input-group">
            <input type="number" step="0.01" min="0" max="100" name="level_8_percent" class="form-control" value="1">
            <span class="input-group-text">%</span>
          </div>
          <div class="form-text small">
            <span class="text-success"><i class="fa-solid fa-check"></i> Active</span>          </div>
        </div>
              </div>
      <div class="mt-4 p-3 rounded" style="background: var(--xvt-card-bg); border: 1px solid var(--xvt-border);">
        <div class="d-flex align-items-center justify-content-between">
          <strong>Total Level Payout:</strong>
          <span class="badge bg-success fs-6">22.00%</span>
        </div>
                <div class="small text-muted mt-1">Document preset total: <strong>22.00%</strong> (5+4+4+3+2+2+1+1)</div>
      </div>
      <div class="mt-3">
        <label class="form-label">Admin Notes (optional)</label>
        <textarea name="level_notes" class="form-control" rows="2"></textarea>
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check me-1"></i> Save Level Income Settings</button>
</form>
@endsection
