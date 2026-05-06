@extends('layouts.admin')
@section('title', 'Engine Controls — XVolty Trade')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4"><div><h3 class="fw-heading mb-1"><i class="fa-solid fa-power-off me-2"></i>Engine Controls</h3><p class="text-muted mb-0 small">Master pause/resume switches for each income engine.</p></div></div>
<form method="POST">
  <div class="card border-themed mb-4">
    <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-power-off me-2"></i>Income Engine Master Switches</h6></div>
    <div class="card-body">
      <p class="text-muted small mb-4">Use these switches to globally pause any income engine. Disabled engines will <strong>not process any payouts</strong> until re-enabled.</p>
      <div class="row g-3">
                <div class="col-md-4 col-sm-6">
          <div class="card border-themed h-100">
            <div class="card-body text-center py-4">
              <i class="fa-solid fa-chart-line fa-3x mb-3 text-success"></i>
              <div class="fw-semibold">ROI Engine</div>
              <div class="small text-muted mb-3">Daily ROI distribution</div>
              <select name="roi_engine_enabled" class="form-select form-select-sm engine-select" data-engine="roi_engine_enabled">
                <option value="enabled" selected="">✓ Enabled</option>
                <option value="disabled">✗ Disabled</option>
              </select>
            </div>
          </div>
        </div>
                <div class="col-md-4 col-sm-6">
          <div class="card border-themed h-100">
            <div class="card-body text-center py-4">
              <i class="fa-solid fa-handshake fa-3x mb-3 text-success"></i>
              <div class="fw-semibold">Direct Income Engine</div>
              <div class="small text-muted mb-3">Sponsor bonus on activation</div>
              <select name="direct_income_enabled" class="form-select form-select-sm engine-select" data-engine="direct_income_enabled">
                <option value="enabled" selected="">✓ Enabled</option>
                <option value="disabled">✗ Disabled</option>
              </select>
            </div>
          </div>
        </div>
                <div class="col-md-4 col-sm-6">
          <div class="card border-themed h-100">
            <div class="card-body text-center py-4">
              <i class="fa-solid fa-layer-group fa-3x mb-3 text-success"></i>
              <div class="fw-semibold">Level Income Engine</div>
              <div class="small text-muted mb-3">8-level sponsor chain</div>
              <select name="level_income_enabled" class="form-select form-select-sm engine-select" data-engine="level_income_enabled">
                <option value="enabled" selected="">✓ Enabled</option>
                <option value="disabled">✗ Disabled</option>
              </select>
            </div>
          </div>
        </div>
                <div class="col-md-4 col-sm-6">
          <div class="card border-themed h-100">
            <div class="card-body text-center py-4">
              <i class="fa-solid fa-money-bill fa-3x mb-3 text-success"></i>
              <div class="fw-semibold">Weekly Salary Engine</div>
              <div class="small text-muted mb-3">Rank-based salary</div>
              <select name="salary_engine_enabled" class="form-select form-select-sm engine-select" data-engine="salary_engine_enabled">
                <option value="enabled" selected="">✓ Enabled</option>
                <option value="disabled">✗ Disabled</option>
              </select>
            </div>
          </div>
        </div>
                <div class="col-md-4 col-sm-6">
          <div class="card border-themed h-100">
            <div class="card-body text-center py-4">
              <i class="fa-solid fa-trophy fa-3x mb-3 text-success"></i>
              <div class="fw-semibold">Rank Reward Engine</div>
              <div class="small text-muted mb-3">One-time rank rewards</div>
              <select name="rank_reward_enabled" class="form-select form-select-sm engine-select" data-engine="rank_reward_enabled">
                <option value="enabled" selected="">✓ Enabled</option>
                <option value="disabled">✗ Disabled</option>
              </select>
            </div>
          </div>
        </div>
              </div>
    </div>
  </div>

  <div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check me-1"></i> Save Engine Controls</button>
    <button type="button" class="btn btn-outline-warning" onclick="pauseAll()"><i class="fa-solid fa-pause me-1"></i> Pause All</button>
    <button type="button" class="btn btn-outline-success" onclick="resumeAll()"><i class="fa-solid fa-play me-1"></i> Resume All</button>
  </div>
</form>

<script>
function pauseAll() {
  document.querySelectorAll('select.engine-select').forEach(s => s.value = 'disabled');
}
function resumeAll() {
  document.querySelectorAll('select.engine-select').forEach(s => s.value = 'enabled');
}
</script>
@endsection
