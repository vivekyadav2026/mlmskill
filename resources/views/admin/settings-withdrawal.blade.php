@extends('layouts.admin')
@section('title', 'Withdrawal Settings — XVolty Trade')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4"><div><h3 class="fw-heading mb-1"><i class="fa-solid fa-arrow-up me-2"></i>Withdrawal Settings</h3><p class="text-muted mb-0 small">Withdrawal rules, fees and limits.</p></div></div>
<form method="POST">
  <div class="card border-themed mb-4">
    <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-arrow-up me-2"></i>Withdrawal Rules</h6></div>
    <div class="card-body">
      <div class="row g-3">
        <div class="col-md-3">
          <label class="form-label">Withdrawals</label>
          <select name="withdrawal_enabled" class="form-select">
            <option value="enabled" selected="">Enabled</option>
            <option value="disabled">Paused</option>
          </select>
        </div>
        <div class="col-md-3">
          <label class="form-label">Charge %</label>
          <input type="number" step="0.01" min="0" max="100" name="withdrawal_charge_percent" class="form-control" value="5">
        </div>
        <div class="col-md-3">
          <label class="form-label">Minimum ($)</label>
          <input type="number" step="0.01" min="0" name="minimum_withdrawal" class="form-control" value="20">
        </div>
        <div class="col-md-3">
          <label class="form-label">Maximum ($) <small class="text-muted">(0 = no limit)</small></label>
          <input type="number" step="0.01" min="0" name="maximum_withdrawal" class="form-control" value="0">
        </div>
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check me-1"></i> Save Withdrawal Settings</button>
</form>
@endsection
