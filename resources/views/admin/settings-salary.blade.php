@extends('layouts.admin')
@section('title', 'Monthly Salary Settings')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
  <div>
    <h3 class="fw-heading mb-1"><i class="fa-solid fa-money-bill me-2"></i>Monthly Salary Settings</h3>
    <p class="text-muted mb-0 small">Direct-referral–based monthly salary. Paid for up to 12 months per tier. Changes apply immediately on the next run.</p>
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
          <label class="form-label fw-semibold">Distribution Date (Day of the month)</label>
          <div class="input-group">
            <input type="number" name="salary_payout_day" class="form-control" min="1" max="28" value="{{ old('salary_payout_day', $payout_day ?? 20) }}">
            <span class="input-group-text">of every month</span>
          </div>
          <div class="form-text">Choose a day between 1 and 28 when the automated script will pay out monthly salaries.</div>
        </div>
      </div>
    </div>
  </div>

  <div class="card border-themed mb-4">
    <div class="card-header"><h6 class="mb-0"><i class="fa-solid fa-list-ol me-2"></i>Salary Tiers (T1 = lowest, T5 = highest)</h6></div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th class="ps-3">Tier</th>
              <th>Min. Active Directs Required</th>
              <th>Monthly Salary ($)</th>
              <th class="text-muted small">Notes</th>
            </tr>
          </thead>
          <tbody>
            @php
              $tierNames = ['T1 — Bronze', 'T2 — Silver', 'T3 — Gold', 'T4 — Platinum', 'T5 — Diamond'];
            @endphp
            @foreach($tiers as $n => $tier)
            <tr>
              <td class="ps-3 fw-semibold">{{ $tierNames[$n - 1] }}</td>
              <td>
                <input type="number" min="0" name="tier[{{ $n }}][directs]"
                       class="form-control form-control-sm" style="max-width:110px;"
                       value="{{ old("tier.{$n}.directs", $tier['directs']) }}">
              </td>
              <td>
                <input type="number" step="0.01" min="0" name="tier[{{ $n }}][amount]"
                       class="form-control form-control-sm" style="max-width:130px;"
                       value="{{ old("tier.{$n}.amount", $tier['amount']) }}">
              </td>
              <td class="text-muted small">
                @if($n === 1) Base tier (no prerequisite)
                @else Requires meeting a lower tier first
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="p-3 small text-muted border-top">
        <i class="fa-solid fa-info-circle me-1"></i>
        The <strong>highest</strong> qualifying tier is paid each month. A user with 5 active directs gets T1; with 8+ directs they get T2 (if T2 requires ≤ 8). Max 12 payments per tier.
      </div>
    </div>
  </div>

  <button type="submit" class="btn btn-primary"><i class="fa-solid fa-check me-1"></i> Save Salary Settings</button>
</form>
@endsection
