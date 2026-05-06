@extends('layouts.admin')
@section('title', 'Direct Income Settings — XVolty Trade')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4"><div><h3 class="fw-heading mb-1"><i class="fa-solid fa-handshake me-2"></i>Direct Income Settings</h3><p class="text-muted mb-0 small">Direct sponsor bonus on each package activation. Document default: 10%.</p></div></div>
<form method="POST">
  <div class="card border-themed mb-4">
    <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-handshake me-2"></i>Direct Sponsor Income</h6></div>
    <div class="card-body">
      <div class="row g-3">
        <div class="col-md-4">
          <label class="form-label">Engine Status</label>
          <select name="direct_income_enabled" class="form-select">
            <option value="enabled" selected="">Enabled</option>
            <option value="disabled">Disabled</option>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label">Direct Bonus %</label>
          <input type="number" step="0.01" min="0" max="100" name="direct_bonus_percent" class="form-control" value="10">
          <small class="text-muted">Paid to sponsor upon each new package activation.</small>
        </div>
      </div>
      <div class="alert alert-info mt-4 mb-0">
        <i class="fa-solid fa-circle-info me-1"></i> <strong>Example:</strong> If a new user activates a $500 package and direct bonus is 10%, the sponsor receives $50 (subject to cap).
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check me-1"></i> Save Direct Income Settings</button>
</form>
@endsection
