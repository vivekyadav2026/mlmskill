@extends('layouts.admin')
@section('title', 'ROI Settings — XVolty Trade')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4"><div><h3 class="fw-heading mb-1"><i class="fa-solid fa-chart-line me-2"></i>ROI Settings</h3><p class="text-muted mb-0 small">Daily ROI engine configuration. Document default: 1% flat.</p></div></div>
<form method="POST">
  <div class="card border-themed mb-4">
    <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-sliders me-2"></i>ROI Configuration</h6></div>
    <div class="card-body">
      <div class="row g-3">
        <div class="col-md-3"><label class="form-label">ROI Engine</label>
          <select name="roi_engine_enabled" class="form-select">
            <option value="enabled" selected="">Enabled</option>
            <option value="disabled">Disabled</option>
          </select>
        </div>
        <div class="col-md-3"><label class="form-label">Daily Cron</label>
          <select name="cron_daily_roi" class="form-select">
            <option value="enabled" selected="">Enabled</option>
            <option value="disabled">Disabled</option>
          </select>
        </div>
        <div class="col-md-3"><label class="form-label">Sunday ROI</label>
          <select name="sunday_roi_enabled" class="form-select">
            <option value="no" selected="">Skip Sunday</option>
            <option value="yes">Pay Sunday</option>
          </select>
        </div>
        <div class="col-md-3"><label class="form-label">ROI Days/Week</label>
          <input type="number" min="1" max="7" name="roi_days_per_week" class="form-control" value="6">
        </div>
        <div class="col-md-4"><label class="form-label">Calculation Mode</label>
          <select name="roi_calculation_mode" class="form-select">
            <option value="package" selected="">Per Package (variable)</option>
            <option value="flat">Flat Rate (fixed)</option>
          </select>
        </div>
        <div class="col-md-4"><label class="form-label">Flat ROI % <small class="text-muted">(if flat mode)</small></label>
          <input type="number" step="0.01" min="0" max="100" name="flat_roi_percent" class="form-control" value="1">
        </div>
      </div>
    </div>
  </div>

  <div class="card border-themed mb-4">
    <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-box me-2"></i>Package-wise ROI Rates (Per-Package Mode)</h6></div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light"><tr><th class="ps-3">Package</th><th>Amount</th><th>Daily ROI %</th></tr></thead>
          <tbody>
                          <tr>
                <td class="ps-3 fw-semibold">Starter Pack</td>
                <td>$21.00</td>
                <td><span class="badge bg-primary">1.0000%</span></td>
              </tr>
                          <tr>
                <td class="ps-3 fw-semibold">Beginner Pack</td>
                <td>$50.00</td>
                <td><span class="badge bg-primary">1.0000%</span></td>
              </tr>
                          <tr>
                <td class="ps-3 fw-semibold">Learner Pack</td>
                <td>$100.00</td>
                <td><span class="badge bg-primary">1.0000%</span></td>
              </tr>
                          <tr>
                <td class="ps-3 fw-semibold">Trader Pack</td>
                <td>$250.00</td>
                <td><span class="badge bg-primary">1.0000%</span></td>
              </tr>
                          <tr>
                <td class="ps-3 fw-semibold">Investor Pack</td>
                <td>$500.00</td>
                <td><span class="badge bg-primary">1.0000%</span></td>
              </tr>
                          <tr>
                <td class="ps-3 fw-semibold">Pro Investor</td>
                <td>$1,000.00</td>
                <td><span class="badge bg-primary">1.0000%</span></td>
              </tr>
                          <tr>
                <td class="ps-3 fw-semibold">Gold Investor</td>
                <td>$2,500.00</td>
                <td><span class="badge bg-primary">1.0000%</span></td>
              </tr>
                          <tr>
                <td class="ps-3 fw-semibold">Diamond Investor</td>
                <td>$5,000.00</td>
                <td><span class="badge bg-primary">1.0000%</span></td>
              </tr>
                      </tbody>
        </table>
      </div>
      <div class="px-3 py-2 small text-muted"><i class="fa-solid fa-info-circle me-1"></i> Edit individual package ROI from <a href="{{ url('admin/settings-packages') }}">Package Settings</a>.</div>
    </div>
  </div>

  <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check me-1"></i> Save ROI Settings</button>
</form>
@endsection
