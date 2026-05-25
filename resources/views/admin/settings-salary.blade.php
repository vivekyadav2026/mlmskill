@extends('layouts.admin')
@section('title', 'Weekly Salary Settings')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
  <div>
    <h3 class="fw-heading mb-1"><i class="fa-solid fa-money-bill me-2"></i>Weekly Salary Settings</h3>
    <p class="text-muted mb-0 small">Rank-based weekly salary. Paid for up to 12 weeks per rank. Changes apply immediately on the next run.</p>
  </div>
</div>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
  <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<form method="POST" action="{{ route('admin.settings.salary') }}">
  @csrf

  <div class="card border-themed mb-4">
    <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-calendar-day me-2"></i>Payout Schedule</h6></div>
    <div class="card-body">
      <div class="row align-items-center">
        <div class="col-md-6">
          <label class="form-label fw-semibold">Distribution Day (Day of the week)</label>
          <div class="input-group">
            <select name="salary_payout_day_of_week" class="form-select">
              <option value="0" {{ ($payout_day_of_week ?? 1) == 0 ? 'selected' : '' }}>Sunday</option>
              <option value="1" {{ ($payout_day_of_week ?? 1) == 1 ? 'selected' : '' }}>Monday</option>
              <option value="2" {{ ($payout_day_of_week ?? 1) == 2 ? 'selected' : '' }}>Tuesday</option>
              <option value="3" {{ ($payout_day_of_week ?? 1) == 3 ? 'selected' : '' }}>Wednesday</option>
              <option value="4" {{ ($payout_day_of_week ?? 1) == 4 ? 'selected' : '' }}>Thursday</option>
              <option value="5" {{ ($payout_day_of_week ?? 1) == 5 ? 'selected' : '' }}>Friday</option>
              <option value="6" {{ ($payout_day_of_week ?? 1) == 6 ? 'selected' : '' }}>Saturday</option>
            </select>
            <span class="input-group-text">of every week</span>
          </div>
          <div class="form-text">Choose the day of the week when the automated script will pay out weekly salaries.</div>
        </div>
      </div>
    </div>
  </div>

  <div class="card border-themed mb-4">
    <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-list-ol me-2"></i>Rank Salary Amounts</h6></div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th class="ps-3">Rank</th>
              <th>Weekly Salary ($)</th>
              <th class="text-muted small">Notes</th>
            </tr>
          </thead>
          <tbody>
            @foreach($ranks as $rankName => $amount)
            <tr>
              <td class="ps-3 fw-semibold">{{ $rankName }}</td>
              <td>
                <input type="number" step="0.01" min="0" name="ranks[{{ $rankName }}]"
                       class="form-control form-control-sm" style="max-width:150px;"
                       value="{{ old('ranks.'.$rankName, $amount) }}">
              </td>
              <td class="text-muted small">
                 Paid weekly for 12 weeks upon reaching {{ $rankName }}.
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="p-3 small text-muted border-top">
        <i class="fa-solid fa-info-circle me-1"></i>
        The <strong>highest</strong> qualifying rank's salary is paid each week. Max 12 payments per rank.
      </div>
    </div>
  </div>

  <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check me-1"></i> Save Salary Settings</button>
</form>
@endsection
