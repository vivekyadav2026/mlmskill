@extends('layouts.admin')
@section('title', 'Rank Rewards Settings — XVolty Trade')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4"><div><h3 class="fw-heading mb-1"><i class="fa-solid fa-trophy me-2"></i>Rank Rewards Settings</h3><p class="text-muted mb-0 small">One-time rewards tied to package/team targets. Document presets: Starter → Diamond Investor.</p></div></div>
<form method="POST">
  <input type="hidden" name="action" value="save_all">

  <div class="card border-themed mb-4">
    <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-gauge me-2"></i>Engine &amp; Cron Status</h6></div>
    <div class="card-body">
      <div class="row g-3">
        <div class="col-md-4"><label class="form-label">Reward Engine</label>
          <select name="rank_reward_enabled" class="form-select">
            <option value="enabled" selected="">Enabled</option>
            <option value="disabled">Disabled</option>
          </select>
        </div>
        <div class="col-md-4"><label class="form-label">Reward Cron</label>
          <select name="cron_rank_reward" class="form-select">
            <option value="enabled" selected="">Enabled</option>
            <option value="disabled">Disabled</option>
          </select>
        </div>
      </div>
    </div>
  </div>

  <div class="card border-themed mb-4">
    <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-trophy me-2"></i>Reward Ranks</h6></div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th class="ps-3">Rank</th>
              <th>Min Pkg ($)</th>
              <th>Req Team Biz ($)</th>
              <th>Req Team Size</th>
              <th>Reward ($)</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
                          <tr>
                <td class="ps-3 fw-semibold">Starter</td>
                <td><input type="number" step="0.01" min="0" name="rank[6][min_pkg]" class="form-control form-control-sm" style="max-width:120px;" value="25.00"></td>
                <td><input type="number" step="0.01" min="0" name="rank[6][team_biz]" class="form-control form-control-sm" style="max-width:130px;" value="0.00"></td>
                <td><input type="number" min="0" name="rank[6][team]" class="form-control form-control-sm" style="max-width:100px;" value="0"></td>
                <td><input type="number" step="0.01" min="0" name="rank[6][reward]" class="form-control form-control-sm" style="max-width:120px;" value="25.00"></td>
                <td>
                  <select name="rank[6][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
              </tr>
                          <tr>
                <td class="ps-3 fw-semibold">Beginner</td>
                <td><input type="number" step="0.01" min="0" name="rank[7][min_pkg]" class="form-control form-control-sm" style="max-width:120px;" value="50.00"></td>
                <td><input type="number" step="0.01" min="0" name="rank[7][team_biz]" class="form-control form-control-sm" style="max-width:130px;" value="0.00"></td>
                <td><input type="number" min="0" name="rank[7][team]" class="form-control form-control-sm" style="max-width:100px;" value="0"></td>
                <td><input type="number" step="0.01" min="0" name="rank[7][reward]" class="form-control form-control-sm" style="max-width:120px;" value="50.00"></td>
                <td>
                  <select name="rank[7][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
              </tr>
                          <tr>
                <td class="ps-3 fw-semibold">Learner</td>
                <td><input type="number" step="0.01" min="0" name="rank[8][min_pkg]" class="form-control form-control-sm" style="max-width:120px;" value="100.00"></td>
                <td><input type="number" step="0.01" min="0" name="rank[8][team_biz]" class="form-control form-control-sm" style="max-width:130px;" value="0.00"></td>
                <td><input type="number" min="0" name="rank[8][team]" class="form-control form-control-sm" style="max-width:100px;" value="0"></td>
                <td><input type="number" step="0.01" min="0" name="rank[8][reward]" class="form-control form-control-sm" style="max-width:120px;" value="100.00"></td>
                <td>
                  <select name="rank[8][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
              </tr>
                          <tr>
                <td class="ps-3 fw-semibold">Trader</td>
                <td><input type="number" step="0.01" min="0" name="rank[9][min_pkg]" class="form-control form-control-sm" style="max-width:120px;" value="250.00"></td>
                <td><input type="number" step="0.01" min="0" name="rank[9][team_biz]" class="form-control form-control-sm" style="max-width:130px;" value="0.00"></td>
                <td><input type="number" min="0" name="rank[9][team]" class="form-control form-control-sm" style="max-width:100px;" value="0"></td>
                <td><input type="number" step="0.01" min="0" name="rank[9][reward]" class="form-control form-control-sm" style="max-width:120px;" value="200.00"></td>
                <td>
                  <select name="rank[9][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
              </tr>
                          <tr>
                <td class="ps-3 fw-semibold">Investor</td>
                <td><input type="number" step="0.01" min="0" name="rank[10][min_pkg]" class="form-control form-control-sm" style="max-width:120px;" value="500.00"></td>
                <td><input type="number" step="0.01" min="0" name="rank[10][team_biz]" class="form-control form-control-sm" style="max-width:130px;" value="0.00"></td>
                <td><input type="number" min="0" name="rank[10][team]" class="form-control form-control-sm" style="max-width:100px;" value="0"></td>
                <td><input type="number" step="0.01" min="0" name="rank[10][reward]" class="form-control form-control-sm" style="max-width:120px;" value="500.00"></td>
                <td>
                  <select name="rank[10][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
              </tr>
                          <tr>
                <td class="ps-3 fw-semibold">Pro Investor</td>
                <td><input type="number" step="0.01" min="0" name="rank[11][min_pkg]" class="form-control form-control-sm" style="max-width:120px;" value="1000.00"></td>
                <td><input type="number" step="0.01" min="0" name="rank[11][team_biz]" class="form-control form-control-sm" style="max-width:130px;" value="0.00"></td>
                <td><input type="number" min="0" name="rank[11][team]" class="form-control form-control-sm" style="max-width:100px;" value="0"></td>
                <td><input type="number" step="0.01" min="0" name="rank[11][reward]" class="form-control form-control-sm" style="max-width:120px;" value="1000.00"></td>
                <td>
                  <select name="rank[11][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
              </tr>
                          <tr>
                <td class="ps-3 fw-semibold">Gold Investor</td>
                <td><input type="number" step="0.01" min="0" name="rank[12][min_pkg]" class="form-control form-control-sm" style="max-width:120px;" value="2500.00"></td>
                <td><input type="number" step="0.01" min="0" name="rank[12][team_biz]" class="form-control form-control-sm" style="max-width:130px;" value="0.00"></td>
                <td><input type="number" min="0" name="rank[12][team]" class="form-control form-control-sm" style="max-width:100px;" value="0"></td>
                <td><input type="number" step="0.01" min="0" name="rank[12][reward]" class="form-control form-control-sm" style="max-width:120px;" value="2500.00"></td>
                <td>
                  <select name="rank[12][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
              </tr>
                          <tr>
                <td class="ps-3 fw-semibold">Diamond Investor</td>
                <td><input type="number" step="0.01" min="0" name="rank[13][min_pkg]" class="form-control form-control-sm" style="max-width:120px;" value="5000.00"></td>
                <td><input type="number" step="0.01" min="0" name="rank[13][team_biz]" class="form-control form-control-sm" style="max-width:130px;" value="0.00"></td>
                <td><input type="number" min="0" name="rank[13][team]" class="form-control form-control-sm" style="max-width:100px;" value="0"></td>
                <td><input type="number" step="0.01" min="0" name="rank[13][reward]" class="form-control form-control-sm" style="max-width:120px;" value="5000.00"></td>
                <td>
                  <select name="rank[13][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
              </tr>
                      </tbody>
        </table>
      </div>
      <div class="p-3 small text-muted border-top">
        <i class="fa-solid fa-info-circle me-1"></i> Document presets — Starter($25→$25), Beginner($50→$50), Learner($100→$100), Trader($250→$200), Investor($500→$500), Pro Investor($1000→$1000), Gold($2500→$2500), Diamond($5000→$5000).
        <br>To <strong>rename</strong>, use <a href="{{ url('admin/settings-ranks') }}">Rank Management</a>.
      </div>
    </div>
  </div>

  <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check me-1"></i> Save Reward Settings</button>
</form>

<!-- Add New Reward Rank -->
<div class="card border-themed mt-4">
  <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-plus me-2"></i>Add New Reward Rank</h6></div>
  <div class="card-body">
    <form method="POST" class="row g-3">
      <input type="hidden" name="action" value="add">
      <div class="col-md-5"><label class="form-label">Rank Name</label><input type="text" name="new_name" class="form-control" required=""></div>
      <div class="col-md-3"><label class="form-label">Min Package ($)</label><input type="number" step="0.01" min="0" name="new_pkg" class="form-control"></div>
      <div class="col-md-2"><label class="form-label">Reward ($)</label><input type="number" step="0.01" min="0" name="new_reward" class="form-control" required=""></div>
      <div class="col-md-2 d-flex align-items-end"><button type="submit" class="btn btn-success w-100"><i class="fa-solid fa-plus me-1"></i> Add</button></div>
    </form>
  </div>
</div>
@endsection
