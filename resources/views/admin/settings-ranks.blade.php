@extends('layouts.admin')
@section('title', 'Rank Management — XVolty Trade')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4"><div><h3 class="fw-heading mb-1"><i class="fa-solid fa-ranking-star me-2"></i>Rank Management</h3><p class="text-muted mb-0 small">Rename, reorder, or create ranks. Salary amounts and rewards are edited in their respective pages.</p></div></div>
<div class="alert alert-info">
  <i class="fa-solid fa-circle-info me-1"></i> <strong>Tip:</strong> This page controls rank <strong>names, types, and order</strong>. To edit salary amounts use <a href="{{ url('admin/settings-salary') }}">Weekly Salary</a>. To edit rewards use <a href="{{ url('admin/settings-rewards') }}">Rank Rewards</a>.
</div>

<form method="POST">
  <input type="hidden" name="action" value="rename_reorder">
  <div class="card border-themed mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
      <h6 class="mb-0"><i class="fa-solid fa-list me-2"></i>All Ranks</h6>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th class="ps-3">Rank Name</th>
              <th>Type</th>
              <th>Sort Order</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
                          <tr>
                <td class="ps-3"><input type="text" name="rank[1][name]" class="form-control form-control-sm" value="S1 — Bronze" required=""></td>
                <td>
                  <select name="rank[1][type]" class="form-select form-select-sm" style="max-width:140px;">
                    <option value="salary" selected="">Salary</option>
                    <option value="reward">Reward</option>
                    <option value="generic">Generic</option>
                  </select>
                </td>
                <td><input type="number" min="0" name="rank[1][sort]" class="form-control form-control-sm" style="max-width:90px;" value="10"></td>
                <td>
                  <select name="rank[1][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
                <td class="text-end pe-3">
                  <button type="button" class="btn btn-sm btn-outline-danger" onclick="if(confirm(&#39;Delete rank S1 — Bronze?&#39;)){document.getElementById(&#39;del1&#39;).submit();}"><i class="fa-solid fa-trash"></i></button>
                </td>
              </tr>
                          <tr>
                <td class="ps-3"><input type="text" name="rank[2][name]" class="form-control form-control-sm" value="S2 — Silver" required=""></td>
                <td>
                  <select name="rank[2][type]" class="form-select form-select-sm" style="max-width:140px;">
                    <option value="salary" selected="">Salary</option>
                    <option value="reward">Reward</option>
                    <option value="generic">Generic</option>
                  </select>
                </td>
                <td><input type="number" min="0" name="rank[2][sort]" class="form-control form-control-sm" style="max-width:90px;" value="20"></td>
                <td>
                  <select name="rank[2][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
                <td class="text-end pe-3">
                  <button type="button" class="btn btn-sm btn-outline-danger" onclick="if(confirm(&#39;Delete rank S2 — Silver?&#39;)){document.getElementById(&#39;del2&#39;).submit();}"><i class="fa-solid fa-trash"></i></button>
                </td>
              </tr>
                          <tr>
                <td class="ps-3"><input type="text" name="rank[3][name]" class="form-control form-control-sm" value="S3 — Gold" required=""></td>
                <td>
                  <select name="rank[3][type]" class="form-select form-select-sm" style="max-width:140px;">
                    <option value="salary" selected="">Salary</option>
                    <option value="reward">Reward</option>
                    <option value="generic">Generic</option>
                  </select>
                </td>
                <td><input type="number" min="0" name="rank[3][sort]" class="form-control form-control-sm" style="max-width:90px;" value="30"></td>
                <td>
                  <select name="rank[3][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
                <td class="text-end pe-3">
                  <button type="button" class="btn btn-sm btn-outline-danger" onclick="if(confirm(&#39;Delete rank S3 — Gold?&#39;)){document.getElementById(&#39;del3&#39;).submit();}"><i class="fa-solid fa-trash"></i></button>
                </td>
              </tr>
                          <tr>
                <td class="ps-3"><input type="text" name="rank[4][name]" class="form-control form-control-sm" value="S4 — Platinum" required=""></td>
                <td>
                  <select name="rank[4][type]" class="form-select form-select-sm" style="max-width:140px;">
                    <option value="salary" selected="">Salary</option>
                    <option value="reward">Reward</option>
                    <option value="generic">Generic</option>
                  </select>
                </td>
                <td><input type="number" min="0" name="rank[4][sort]" class="form-control form-control-sm" style="max-width:90px;" value="40"></td>
                <td>
                  <select name="rank[4][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
                <td class="text-end pe-3">
                  <button type="button" class="btn btn-sm btn-outline-danger" onclick="if(confirm(&#39;Delete rank S4 — Platinum?&#39;)){document.getElementById(&#39;del4&#39;).submit();}"><i class="fa-solid fa-trash"></i></button>
                </td>
              </tr>
                          <tr>
                <td class="ps-3"><input type="text" name="rank[5][name]" class="form-control form-control-sm" value="S5 — Diamond" required=""></td>
                <td>
                  <select name="rank[5][type]" class="form-select form-select-sm" style="max-width:140px;">
                    <option value="salary" selected="">Salary</option>
                    <option value="reward">Reward</option>
                    <option value="generic">Generic</option>
                  </select>
                </td>
                <td><input type="number" min="0" name="rank[5][sort]" class="form-control form-control-sm" style="max-width:90px;" value="50"></td>
                <td>
                  <select name="rank[5][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
                <td class="text-end pe-3">
                  <button type="button" class="btn btn-sm btn-outline-danger" onclick="if(confirm(&#39;Delete rank S5 — Diamond?&#39;)){document.getElementById(&#39;del5&#39;).submit();}"><i class="fa-solid fa-trash"></i></button>
                </td>
              </tr>
                          <tr>
                <td class="ps-3"><input type="text" name="rank[6][name]" class="form-control form-control-sm" value="Starter" required=""></td>
                <td>
                  <select name="rank[6][type]" class="form-select form-select-sm" style="max-width:140px;">
                    <option value="salary">Salary</option>
                    <option value="reward" selected="">Reward</option>
                    <option value="generic">Generic</option>
                  </select>
                </td>
                <td><input type="number" min="0" name="rank[6][sort]" class="form-control form-control-sm" style="max-width:90px;" value="100"></td>
                <td>
                  <select name="rank[6][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
                <td class="text-end pe-3">
                  <button type="button" class="btn btn-sm btn-outline-danger" onclick="if(confirm(&#39;Delete rank Starter?&#39;)){document.getElementById(&#39;del6&#39;).submit();}"><i class="fa-solid fa-trash"></i></button>
                </td>
              </tr>
                          <tr>
                <td class="ps-3"><input type="text" name="rank[7][name]" class="form-control form-control-sm" value="Beginner" required=""></td>
                <td>
                  <select name="rank[7][type]" class="form-select form-select-sm" style="max-width:140px;">
                    <option value="salary">Salary</option>
                    <option value="reward" selected="">Reward</option>
                    <option value="generic">Generic</option>
                  </select>
                </td>
                <td><input type="number" min="0" name="rank[7][sort]" class="form-control form-control-sm" style="max-width:90px;" value="110"></td>
                <td>
                  <select name="rank[7][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
                <td class="text-end pe-3">
                  <button type="button" class="btn btn-sm btn-outline-danger" onclick="if(confirm(&#39;Delete rank Beginner?&#39;)){document.getElementById(&#39;del7&#39;).submit();}"><i class="fa-solid fa-trash"></i></button>
                </td>
              </tr>
                          <tr>
                <td class="ps-3"><input type="text" name="rank[8][name]" class="form-control form-control-sm" value="Learner" required=""></td>
                <td>
                  <select name="rank[8][type]" class="form-select form-select-sm" style="max-width:140px;">
                    <option value="salary">Salary</option>
                    <option value="reward" selected="">Reward</option>
                    <option value="generic">Generic</option>
                  </select>
                </td>
                <td><input type="number" min="0" name="rank[8][sort]" class="form-control form-control-sm" style="max-width:90px;" value="120"></td>
                <td>
                  <select name="rank[8][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
                <td class="text-end pe-3">
                  <button type="button" class="btn btn-sm btn-outline-danger" onclick="if(confirm(&#39;Delete rank Learner?&#39;)){document.getElementById(&#39;del8&#39;).submit();}"><i class="fa-solid fa-trash"></i></button>
                </td>
              </tr>
                          <tr>
                <td class="ps-3"><input type="text" name="rank[9][name]" class="form-control form-control-sm" value="Trader" required=""></td>
                <td>
                  <select name="rank[9][type]" class="form-select form-select-sm" style="max-width:140px;">
                    <option value="salary">Salary</option>
                    <option value="reward" selected="">Reward</option>
                    <option value="generic">Generic</option>
                  </select>
                </td>
                <td><input type="number" min="0" name="rank[9][sort]" class="form-control form-control-sm" style="max-width:90px;" value="130"></td>
                <td>
                  <select name="rank[9][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
                <td class="text-end pe-3">
                  <button type="button" class="btn btn-sm btn-outline-danger" onclick="if(confirm(&#39;Delete rank Trader?&#39;)){document.getElementById(&#39;del9&#39;).submit();}"><i class="fa-solid fa-trash"></i></button>
                </td>
              </tr>
                          <tr>
                <td class="ps-3"><input type="text" name="rank[10][name]" class="form-control form-control-sm" value="Investor" required=""></td>
                <td>
                  <select name="rank[10][type]" class="form-select form-select-sm" style="max-width:140px;">
                    <option value="salary">Salary</option>
                    <option value="reward" selected="">Reward</option>
                    <option value="generic">Generic</option>
                  </select>
                </td>
                <td><input type="number" min="0" name="rank[10][sort]" class="form-control form-control-sm" style="max-width:90px;" value="140"></td>
                <td>
                  <select name="rank[10][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
                <td class="text-end pe-3">
                  <button type="button" class="btn btn-sm btn-outline-danger" onclick="if(confirm(&#39;Delete rank Investor?&#39;)){document.getElementById(&#39;del10&#39;).submit();}"><i class="fa-solid fa-trash"></i></button>
                </td>
              </tr>
                          <tr>
                <td class="ps-3"><input type="text" name="rank[11][name]" class="form-control form-control-sm" value="Pro Investor" required=""></td>
                <td>
                  <select name="rank[11][type]" class="form-select form-select-sm" style="max-width:140px;">
                    <option value="salary">Salary</option>
                    <option value="reward" selected="">Reward</option>
                    <option value="generic">Generic</option>
                  </select>
                </td>
                <td><input type="number" min="0" name="rank[11][sort]" class="form-control form-control-sm" style="max-width:90px;" value="150"></td>
                <td>
                  <select name="rank[11][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
                <td class="text-end pe-3">
                  <button type="button" class="btn btn-sm btn-outline-danger" onclick="if(confirm(&#39;Delete rank Pro Investor?&#39;)){document.getElementById(&#39;del11&#39;).submit();}"><i class="fa-solid fa-trash"></i></button>
                </td>
              </tr>
                          <tr>
                <td class="ps-3"><input type="text" name="rank[12][name]" class="form-control form-control-sm" value="Gold Investor" required=""></td>
                <td>
                  <select name="rank[12][type]" class="form-select form-select-sm" style="max-width:140px;">
                    <option value="salary">Salary</option>
                    <option value="reward" selected="">Reward</option>
                    <option value="generic">Generic</option>
                  </select>
                </td>
                <td><input type="number" min="0" name="rank[12][sort]" class="form-control form-control-sm" style="max-width:90px;" value="160"></td>
                <td>
                  <select name="rank[12][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
                <td class="text-end pe-3">
                  <button type="button" class="btn btn-sm btn-outline-danger" onclick="if(confirm(&#39;Delete rank Gold Investor?&#39;)){document.getElementById(&#39;del12&#39;).submit();}"><i class="fa-solid fa-trash"></i></button>
                </td>
              </tr>
                          <tr>
                <td class="ps-3"><input type="text" name="rank[13][name]" class="form-control form-control-sm" value="Diamond Investor" required=""></td>
                <td>
                  <select name="rank[13][type]" class="form-select form-select-sm" style="max-width:140px;">
                    <option value="salary">Salary</option>
                    <option value="reward" selected="">Reward</option>
                    <option value="generic">Generic</option>
                  </select>
                </td>
                <td><input type="number" min="0" name="rank[13][sort]" class="form-control form-control-sm" style="max-width:90px;" value="170"></td>
                <td>
                  <select name="rank[13][status]" class="form-select form-select-sm" style="max-width:120px;">
                    <option value="active" selected="">Active</option>
                    <option value="inactive">Inactive</option>
                  </select>
                </td>
                <td class="text-end pe-3">
                  <button type="button" class="btn btn-sm btn-outline-danger" onclick="if(confirm(&#39;Delete rank Diamond Investor?&#39;)){document.getElementById(&#39;del13&#39;).submit();}"><i class="fa-solid fa-trash"></i></button>
                </td>
              </tr>
                      </tbody>
        </table>
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check me-1"></i> Save Rank Changes</button>
</form>

<!-- Hidden delete forms -->
<form method="POST" id="del1" style="display:none;">
  <input type="hidden" name="action" value="delete">
  <input type="hidden" name="delete_id" value="1">
</form>
<form method="POST" id="del2" style="display:none;">
  <input type="hidden" name="action" value="delete">
  <input type="hidden" name="delete_id" value="2">
</form>
<form method="POST" id="del3" style="display:none;">
  <input type="hidden" name="action" value="delete">
  <input type="hidden" name="delete_id" value="3">
</form>
<form method="POST" id="del4" style="display:none;">
  <input type="hidden" name="action" value="delete">
  <input type="hidden" name="delete_id" value="4">
</form>
<form method="POST" id="del5" style="display:none;">
  <input type="hidden" name="action" value="delete">
  <input type="hidden" name="delete_id" value="5">
</form>
<form method="POST" id="del6" style="display:none;">
  <input type="hidden" name="action" value="delete">
  <input type="hidden" name="delete_id" value="6">
</form>
<form method="POST" id="del7" style="display:none;">
  <input type="hidden" name="action" value="delete">
  <input type="hidden" name="delete_id" value="7">
</form>
<form method="POST" id="del8" style="display:none;">
  <input type="hidden" name="action" value="delete">
  <input type="hidden" name="delete_id" value="8">
</form>
<form method="POST" id="del9" style="display:none;">
  <input type="hidden" name="action" value="delete">
  <input type="hidden" name="delete_id" value="9">
</form>
<form method="POST" id="del10" style="display:none;">
  <input type="hidden" name="action" value="delete">
  <input type="hidden" name="delete_id" value="10">
</form>
<form method="POST" id="del11" style="display:none;">
  <input type="hidden" name="action" value="delete">
  <input type="hidden" name="delete_id" value="11">
</form>
<form method="POST" id="del12" style="display:none;">
  <input type="hidden" name="action" value="delete">
  <input type="hidden" name="delete_id" value="12">
</form>
<form method="POST" id="del13" style="display:none;">
  <input type="hidden" name="action" value="delete">
  <input type="hidden" name="delete_id" value="13">
</form>

<!-- Create New Rank -->
<div class="card border-themed mt-4">
  <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-plus me-2"></i>Create New Rank</h6></div>
  <div class="card-body">
    <form method="POST" class="row g-3">
      <input type="hidden" name="action" value="create">
      <div class="col-md-6"><label class="form-label">Rank Name</label><input type="text" name="new_name" class="form-control" placeholder="e.g. Silver Leader" required=""></div>
      <div class="col-md-3"><label class="form-label">Type</label>
        <select name="new_type" class="form-select">
          <option value="salary">Salary Rank</option>
          <option value="reward">Reward Rank</option>
          <option value="generic">Generic</option>
        </select>
      </div>
      <div class="col-md-3 d-flex align-items-end"><button type="submit" class="btn btn-success w-100"><i class="fa-solid fa-plus me-1"></i> Create</button></div>
    </form>
  </div>
</div>
@endsection
