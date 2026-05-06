@extends('layouts.admin')
@section('title', 'Cron Manager — Admin — XVolty Trade')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
  <div>
    <h3 class="fw-heading mb-1"><i class="fa-solid fa-clock-rotate-left me-2"></i>Cron Job Manager</h3>
    <p class="text-muted mb-0 small">Configure, schedule, and manually run automated tasks.</p>
  </div>
  <form method="POST" class="d-inline">
    <input type="hidden" name="action" value="run_all">
    <button type="submit" class="btn btn-primary" onclick="return confirm(&#39;Run ALL enabled cron tasks now?&#39;)">
      <i class="fa-solid fa-play me-1"></i> Run All Now
    </button>
  </form>
</div>

<!-- Auto-Cron Status -->
<div class="card border-themed mb-4">
  <div class="card-body">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
      <div>
        <h6 class="fw-heading mb-1"><i class="fa-solid fa-robot me-2 text-info"></i>Auto-Cron Engine</h6>
        <p class="text-muted small mb-0">
          When tasks are set to <strong>Auto</strong> mode, they run automatically via a background beacon. 
          The engine checks every 60 seconds when admin/user pages are active.
        </p>
      </div>
      <div>
        <span class="badge bg-success"><i class="fa-solid fa-circle-check me-1"></i>Active</span>
      </div>
    </div>
  </div>
</div>

<!-- Task Cards -->
<div class="row g-3 mb-4">
      <div class="col-12">
      <div class="card border-themed">
        <div class="card-body">
          <div class="row align-items-center g-3">
            <!-- Task Info -->
            <div class="col-lg-4">
              <div class="d-flex align-items-center gap-3">
                <span class="xvt-avatar lg" style="background:#10b98122;color:#10b981;">
                  <i class="fa-solid fa-chart-line"></i>
                </span>
                <div>
                  <h6 class="fw-heading mb-0">Daily ROI Distribution</h6>
                  <p class="text-muted small mb-1">Credits daily ROI to all users with active package activations.</p>
                  <div class="d-flex gap-2 flex-wrap">
                    <span class="badge bg-success">
                      Enabled                    </span>
                    <span class="badge bg-info">
                      <i class="fa-solid fa-robot me-1"></i>Auto                    </span>
                    <span class="badge bg-secondary">
                      <i class="fa-regular fa-clock me-1"></i>Daily @ 00:01                    </span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Schedule Config -->
            <div class="col-lg-5">
              <form method="POST" class="row g-2 align-items-end">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="task" value="daily_roi">
                
                <div class="col-auto">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="enabled" id="en_daily_roi" checked="">
                    <label class="form-check-label small" for="en_daily_roi">On</label>
                  </div>
                </div>

                <div class="col">
                  <label class="form-label small text-muted mb-0">Mode</label>
                  <select name="mode" class="form-select form-select-sm" onchange="toggleDayField(this, &#39;daily_roi&#39;)">
                    <option value="manual">Manual</option>
                    <option value="auto" selected="">Auto</option>
                  </select>
                </div>

                <div class="col">
                  <label class="form-label small text-muted mb-0">Frequency</label>
                  <select name="frequency" class="form-select form-select-sm" onchange="toggleDayField(this, &#39;daily_roi&#39;)">
                    <option value="daily" selected="">Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                  </select>
                </div>

                <div class="col-auto">
                  <label class="form-label small text-muted mb-0">Time</label>
                  <input type="time" name="time" class="form-control form-control-sm" value="00:01" style="width:110px;">
                </div>

                <div class="col-auto" id="dayCol_daily_roi" style="display:none;">
                  <label class="form-label small text-muted mb-0">Day</label>
                  <input type="number" name="day" class="form-control form-control-sm" value="1" min="1" max="28" style="width:70px;">
                </div>

                <div class="col-auto">
                  <button type="submit" class="btn btn-sm btn-outline-primary" title="Save">
                    <i class="fa-solid fa-save"></i>
                  </button>
                </div>
              </form>
            </div>

            <!-- Actions -->
            <div class="col-lg-3 text-lg-end">
              <div class="d-flex gap-2 justify-content-lg-end flex-wrap align-items-center">
                                  <div class="small text-muted">
                    <i class="fa-regular fa-clock me-1"></i>Last: 01 May, 10:31                  </div>
                                <form method="POST" class="d-inline">
                  <input type="hidden" name="action" value="run">
                  <input type="hidden" name="task" value="daily_roi">
                  <button type="submit" class="btn btn-sm btn-success" onclick="return confirm(&#39;Run Daily ROI Distribution now?&#39;)">
                    <i class="fa-solid fa-play me-1"></i> Run Now
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      <div class="col-12">
      <div class="card border-themed">
        <div class="card-body">
          <div class="row align-items-center g-3">
            <!-- Task Info -->
            <div class="col-lg-4">
              <div class="d-flex align-items-center gap-3">
                <span class="xvt-avatar lg" style="background:#f59e0b22;color:#f59e0b;">
                  <i class="fa-solid fa-money-bill-wave"></i>
                </span>
                <div>
                  <h6 class="fw-heading mb-0">Weekly Salary Payout</h6>
                  <p class="text-muted small mb-1">Pays weekly salary to ranked users based on their achieved rank.</p>
                  <div class="d-flex gap-2 flex-wrap">
                    <span class="badge bg-success">
                      Enabled                    </span>
                    <span class="badge bg-info">
                      <i class="fa-solid fa-robot me-1"></i>Auto                    </span>
                    <span class="badge bg-secondary">
                      <i class="fa-regular fa-clock me-1"></i>Weekly @ 00:01                    </span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Schedule Config -->
            <div class="col-lg-5">
              <form method="POST" class="row g-2 align-items-end">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="task" value="weekly_salary">
                
                <div class="col-auto">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="enabled" id="en_weekly_salary" checked="">
                    <label class="form-check-label small" for="en_weekly_salary">On</label>
                  </div>
                </div>

                <div class="col">
                  <label class="form-label small text-muted mb-0">Mode</label>
                  <select name="mode" class="form-select form-select-sm" onchange="toggleDayField(this, &#39;weekly_salary&#39;)">
                    <option value="manual">Manual</option>
                    <option value="auto" selected="">Auto</option>
                  </select>
                </div>

                <div class="col">
                  <label class="form-label small text-muted mb-0">Frequency</label>
                  <select name="frequency" class="form-select form-select-sm" onchange="toggleDayField(this, &#39;weekly_salary&#39;)">
                    <option value="daily">Daily</option>
                    <option value="weekly" selected="">Weekly</option>
                    <option value="monthly">Monthly</option>
                  </select>
                </div>

                <div class="col-auto">
                  <label class="form-label small text-muted mb-0">Time</label>
                  <input type="time" name="time" class="form-control form-control-sm" value="00:01" style="width:110px;">
                </div>

                <div class="col-auto" id="dayCol_weekly_salary" style="">
                  <label class="form-label small text-muted mb-0">Day</label>
                  <input type="number" name="day" class="form-control form-control-sm" value="1" min="1" max="28" style="width:70px;">
                </div>

                <div class="col-auto">
                  <button type="submit" class="btn btn-sm btn-outline-primary" title="Save">
                    <i class="fa-solid fa-save"></i>
                  </button>
                </div>
              </form>
            </div>

            <!-- Actions -->
            <div class="col-lg-3 text-lg-end">
              <div class="d-flex gap-2 justify-content-lg-end flex-wrap align-items-center">
                                  <div class="small text-muted">
                    <i class="fa-regular fa-clock me-1"></i>Last: 25 Apr, 10:35                  </div>
                                <form method="POST" class="d-inline">
                  <input type="hidden" name="action" value="run">
                  <input type="hidden" name="task" value="weekly_salary">
                  <button type="submit" class="btn btn-sm btn-success" onclick="return confirm(&#39;Run Weekly Salary Payout now?&#39;)">
                    <i class="fa-solid fa-play me-1"></i> Run Now
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      <div class="col-12">
      <div class="card border-themed">
        <div class="card-body">
          <div class="row align-items-center g-3">
            <!-- Task Info -->
            <div class="col-lg-4">
              <div class="d-flex align-items-center gap-3">
                <span class="xvt-avatar lg" style="background:#8b5cf622;color:#8b5cf6;">
                  <i class="fa-solid fa-trophy"></i>
                </span>
                <div>
                  <h6 class="fw-heading mb-0">Rank Evaluation &amp; Rewards</h6>
                  <p class="text-muted small mb-1">Evaluates all users for rank upgrades and credits one-time rewards.</p>
                  <div class="d-flex gap-2 flex-wrap">
                    <span class="badge bg-success">
                      Enabled                    </span>
                    <span class="badge bg-info">
                      <i class="fa-solid fa-robot me-1"></i>Auto                    </span>
                    <span class="badge bg-secondary">
                      <i class="fa-regular fa-clock me-1"></i>Daily @ 00:05                    </span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Schedule Config -->
            <div class="col-lg-5">
              <form method="POST" class="row g-2 align-items-end">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="task" value="rank_reward">
                
                <div class="col-auto">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="enabled" id="en_rank_reward" checked="">
                    <label class="form-check-label small" for="en_rank_reward">On</label>
                  </div>
                </div>

                <div class="col">
                  <label class="form-label small text-muted mb-0">Mode</label>
                  <select name="mode" class="form-select form-select-sm" onchange="toggleDayField(this, &#39;rank_reward&#39;)">
                    <option value="manual">Manual</option>
                    <option value="auto" selected="">Auto</option>
                  </select>
                </div>

                <div class="col">
                  <label class="form-label small text-muted mb-0">Frequency</label>
                  <select name="frequency" class="form-select form-select-sm" onchange="toggleDayField(this, &#39;rank_reward&#39;)">
                    <option value="daily" selected="">Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                  </select>
                </div>

                <div class="col-auto">
                  <label class="form-label small text-muted mb-0">Time</label>
                  <input type="time" name="time" class="form-control form-control-sm" value="00:05" style="width:110px;">
                </div>

                <div class="col-auto" id="dayCol_rank_reward" style="display:none;">
                  <label class="form-label small text-muted mb-0">Day</label>
                  <input type="number" name="day" class="form-control form-control-sm" value="1" min="1" max="28" style="width:70px;">
                </div>

                <div class="col-auto">
                  <button type="submit" class="btn btn-sm btn-outline-primary" title="Save">
                    <i class="fa-solid fa-save"></i>
                  </button>
                </div>
              </form>
            </div>

            <!-- Actions -->
            <div class="col-lg-3 text-lg-end">
              <div class="d-flex gap-2 justify-content-lg-end flex-wrap align-items-center">
                                  <div class="small text-muted">
                    <i class="fa-regular fa-clock me-1"></i>Last: 25 Apr, 10:35                  </div>
                                <form method="POST" class="d-inline">
                  <input type="hidden" name="action" value="run">
                  <input type="hidden" name="task" value="rank_reward">
                  <button type="submit" class="btn btn-sm btn-success" onclick="return confirm(&#39;Run Rank Evaluation &amp; Rewards now?&#39;)">
                    <i class="fa-solid fa-play me-1"></i> Run Now
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Execution Logs -->
<div class="card border-themed">
  <div class="card-header bg-transparent border-themed d-flex justify-content-between align-items-center">
    <h6 class="mb-0"><i class="fa-solid fa-list-check me-2"></i>Recent Execution Logs</h6>
    <span class="badge bg-secondary">16 entries</span>
  </div>
  <div class="table-responsive">
    <table class="table table-hover mb-0 align-middle">
      <thead class="small text-uppercase text-muted">
        <tr>
          <th class="ps-3">#</th>
          <th>Task</th>
          <th>Status</th>
          <th>Records</th>
          <th>Started</th>
          <th>Finished</th>
          <th class="pe-3">Error</th>
        </tr>
      </thead>
      <tbody>
                  <tr>
            <td class="ps-3 small text-muted">1</td>
            <td>
              <span class="fw-semibold">Rank Evaluation</span>
              <div class="text-muted small">rank_reward</div>
            </td>
            <td><span class="badge bg-danger">Failed</span></td>
            <td class="small">0</td>
            <td class="small text-muted">2026-05-01 10:42:40</td>
            <td class="small text-muted">2026-05-01 10:42:40</td>
            <td class="pe-3 small text-danger">
                              <span title="SQLSTATE[42S22]: Column not found: 1054 Unknown column &#39;u.user_id&#39; in &#39;WHERE&#39;" data-bs-toggle="tooltip">
                  SQLSTATE[42S22]: Column not found: 1054 Unknown column 'u.us…                </span>
                          </td>
          </tr>
                  <tr>
            <td class="ps-3 small text-muted">2</td>
            <td>
              <span class="fw-semibold">Rank Evaluation</span>
              <div class="text-muted small">rank_reward</div>
            </td>
            <td><span class="badge bg-danger">Failed</span></td>
            <td class="small">0</td>
            <td class="small text-muted">2026-05-01 10:41:36</td>
            <td class="small text-muted">2026-05-01 10:41:36</td>
            <td class="pe-3 small text-danger">
                              <span title="SQLSTATE[42S22]: Column not found: 1054 Unknown column &#39;u.user_id&#39; in &#39;WHERE&#39;" data-bs-toggle="tooltip">
                  SQLSTATE[42S22]: Column not found: 1054 Unknown column 'u.us…                </span>
                          </td>
          </tr>
                  <tr>
            <td class="ps-3 small text-muted">3</td>
            <td>
              <span class="fw-semibold">Rank Evaluation</span>
              <div class="text-muted small">rank_reward</div>
            </td>
            <td><span class="badge bg-danger">Failed</span></td>
            <td class="small">0</td>
            <td class="small text-muted">2026-05-01 10:40:18</td>
            <td class="small text-muted">2026-05-01 10:40:18</td>
            <td class="pe-3 small text-danger">
                              <span title="SQLSTATE[42S22]: Column not found: 1054 Unknown column &#39;u.user_id&#39; in &#39;WHERE&#39;" data-bs-toggle="tooltip">
                  SQLSTATE[42S22]: Column not found: 1054 Unknown column 'u.us…                </span>
                          </td>
          </tr>
                  <tr>
            <td class="ps-3 small text-muted">4</td>
            <td>
              <span class="fw-semibold">Rank Evaluation</span>
              <div class="text-muted small">rank_reward</div>
            </td>
            <td><span class="badge bg-danger">Failed</span></td>
            <td class="small">0</td>
            <td class="small text-muted">2026-05-01 10:35:54</td>
            <td class="small text-muted">2026-05-01 10:35:54</td>
            <td class="pe-3 small text-danger">
                              <span title="SQLSTATE[42S22]: Column not found: 1054 Unknown column &#39;u.user_id&#39; in &#39;WHERE&#39;" data-bs-toggle="tooltip">
                  SQLSTATE[42S22]: Column not found: 1054 Unknown column 'u.us…                </span>
                          </td>
          </tr>
                  <tr>
            <td class="ps-3 small text-muted">5</td>
            <td>
              <span class="fw-semibold">Rank Evaluation</span>
              <div class="text-muted small">rank_reward</div>
            </td>
            <td><span class="badge bg-danger">Failed</span></td>
            <td class="small">0</td>
            <td class="small text-muted">2026-05-01 10:34:49</td>
            <td class="small text-muted">2026-05-01 10:34:49</td>
            <td class="pe-3 small text-danger">
                              <span title="SQLSTATE[42S22]: Column not found: 1054 Unknown column &#39;u.user_id&#39; in &#39;WHERE&#39;" data-bs-toggle="tooltip">
                  SQLSTATE[42S22]: Column not found: 1054 Unknown column 'u.us…                </span>
                          </td>
          </tr>
                  <tr>
            <td class="ps-3 small text-muted">6</td>
            <td>
              <span class="fw-semibold">Rank Evaluation</span>
              <div class="text-muted small">rank_reward</div>
            </td>
            <td><span class="badge bg-danger">Failed</span></td>
            <td class="small">0</td>
            <td class="small text-muted">2026-05-01 10:33:48</td>
            <td class="small text-muted">2026-05-01 10:33:48</td>
            <td class="pe-3 small text-danger">
                              <span title="SQLSTATE[42S22]: Column not found: 1054 Unknown column &#39;u.user_id&#39; in &#39;WHERE&#39;" data-bs-toggle="tooltip">
                  SQLSTATE[42S22]: Column not found: 1054 Unknown column 'u.us…                </span>
                          </td>
          </tr>
                  <tr>
            <td class="ps-3 small text-muted">7</td>
            <td>
              <span class="fw-semibold">Rank Evaluation</span>
              <div class="text-muted small">rank_reward</div>
            </td>
            <td><span class="badge bg-danger">Failed</span></td>
            <td class="small">0</td>
            <td class="small text-muted">2026-05-01 10:32:20</td>
            <td class="small text-muted">2026-05-01 10:32:20</td>
            <td class="pe-3 small text-danger">
                              <span title="SQLSTATE[42S22]: Column not found: 1054 Unknown column &#39;u.user_id&#39; in &#39;WHERE&#39;" data-bs-toggle="tooltip">
                  SQLSTATE[42S22]: Column not found: 1054 Unknown column 'u.us…                </span>
                          </td>
          </tr>
                  <tr>
            <td class="ps-3 small text-muted">8</td>
            <td>
              <span class="fw-semibold">Rank Evaluation</span>
              <div class="text-muted small">rank_reward</div>
            </td>
            <td><span class="badge bg-danger">Failed</span></td>
            <td class="small">0</td>
            <td class="small text-muted">2026-05-01 10:31:21</td>
            <td class="small text-muted">2026-05-01 10:31:21</td>
            <td class="pe-3 small text-danger">
                              <span title="SQLSTATE[42S22]: Column not found: 1054 Unknown column &#39;u.user_id&#39; in &#39;WHERE&#39;" data-bs-toggle="tooltip">
                  SQLSTATE[42S22]: Column not found: 1054 Unknown column 'u.us…                </span>
                          </td>
          </tr>
                  <tr>
            <td class="ps-3 small text-muted">9</td>
            <td>
              <span class="fw-semibold">Daily ROI</span>
              <div class="text-muted small">daily_roi</div>
            </td>
            <td><span class="badge bg-success">Success</span></td>
            <td class="small">6</td>
            <td class="small text-muted">2026-05-01 10:31:20</td>
            <td class="small text-muted">2026-05-01 10:31:21</td>
            <td class="pe-3 small text-danger">
                              —
                          </td>
          </tr>
                  <tr>
            <td class="ps-3 small text-muted">10</td>
            <td>
              <span class="fw-semibold">Daily ROI</span>
              <div class="text-muted small">daily_roi</div>
            </td>
            <td><span class="badge bg-success">Success</span></td>
            <td class="small">6</td>
            <td class="small text-muted">2026-04-29 11:00:54</td>
            <td class="small text-muted">2026-04-29 11:00:54</td>
            <td class="pe-3 small text-danger">
                              —
                          </td>
          </tr>
                  <tr>
            <td class="ps-3 small text-muted">11</td>
            <td>
              <span class="fw-semibold">Rank Evaluation</span>
              <div class="text-muted small">rank_reward</div>
            </td>
            <td><span class="badge bg-danger">Failed</span></td>
            <td class="small">0</td>
            <td class="small text-muted">2026-04-29 11:00:54</td>
            <td class="small text-muted">2026-04-29 11:00:54</td>
            <td class="pe-3 small text-danger">
                              <span title="SQLSTATE[42S22]: Column not found: 1054 Unknown column &#39;u.user_id&#39; in &#39;WHERE&#39;" data-bs-toggle="tooltip">
                  SQLSTATE[42S22]: Column not found: 1054 Unknown column 'u.us…                </span>
                          </td>
          </tr>
                  <tr>
            <td class="ps-3 small text-muted">12</td>
            <td>
              <span class="fw-semibold">Daily ROI</span>
              <div class="text-muted small">daily_roi</div>
            </td>
            <td><span class="badge bg-success">Success</span></td>
            <td class="small">0</td>
            <td class="small text-muted">2026-04-26 01:24:45</td>
            <td class="small text-muted">2026-04-26 01:24:45</td>
            <td class="pe-3 small text-danger">
                              —
                          </td>
          </tr>
                  <tr>
            <td class="ps-3 small text-muted">13</td>
            <td>
              <span class="fw-semibold">Rank Evaluation</span>
              <div class="text-muted small">rank_reward</div>
            </td>
            <td><span class="badge bg-danger">Failed</span></td>
            <td class="small">0</td>
            <td class="small text-muted">2026-04-26 01:24:45</td>
            <td class="small text-muted">2026-04-26 01:24:45</td>
            <td class="pe-3 small text-danger">
                              <span title="SQLSTATE[42S22]: Column not found: 1054 Unknown column &#39;u.user_id&#39; in &#39;WHERE&#39;" data-bs-toggle="tooltip">
                  SQLSTATE[42S22]: Column not found: 1054 Unknown column 'u.us…                </span>
                          </td>
          </tr>
                  <tr>
            <td class="ps-3 small text-muted">14</td>
            <td>
              <span class="fw-semibold">Daily ROI</span>
              <div class="text-muted small">daily_roi</div>
            </td>
            <td><span class="badge bg-success">Success</span></td>
            <td class="small">6</td>
            <td class="small text-muted">2026-04-25 10:35:57</td>
            <td class="small text-muted">2026-04-25 10:35:57</td>
            <td class="pe-3 small text-danger">
                              —
                          </td>
          </tr>
                  <tr>
            <td class="ps-3 small text-muted">15</td>
            <td>
              <span class="fw-semibold">Weekly Salary</span>
              <div class="text-muted small">weekly_salary</div>
            </td>
            <td><span class="badge bg-success">Success</span></td>
            <td class="small">0</td>
            <td class="small text-muted">2026-04-25 10:35:57</td>
            <td class="small text-muted">2026-04-25 10:35:57</td>
            <td class="pe-3 small text-danger">
                              —
                          </td>
          </tr>
                  <tr>
            <td class="ps-3 small text-muted">16</td>
            <td>
              <span class="fw-semibold">Rank Evaluation</span>
              <div class="text-muted small">rank_reward</div>
            </td>
            <td><span class="badge bg-success">Success</span></td>
            <td class="small">0</td>
            <td class="small text-muted">2026-04-25 10:35:57</td>
            <td class="small text-muted">2026-04-25 10:35:57</td>
            <td class="pe-3 small text-danger">
                              —
                          </td>
          </tr>
              </tbody>
    </table>
  </div>
</div>

<script>
function toggleDayField(el, key) {
  const row = el.closest('form');
  const freqSelect = row.querySelector('select[name="frequency"]');
  const dayCol = document.getElementById('dayCol_' + key);
  if (dayCol) {
    dayCol.style.display = (freqSelect && freqSelect.value !== 'daily') ? '' : 'none';
  }
}
// Init tooltips
document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => new bootstrap.Tooltip(el));
</script>
@endsection
