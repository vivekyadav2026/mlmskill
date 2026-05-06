@extends('layouts.admin')
@section('title', 'Network Tree — Admin — XVolty Trade')

@section('content')
<!-- ===== Network Tree Content ===== -->
<div class="mb-4">
  <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
    <div>
      <h3 class="fw-heading mb-1"><i class="fa-solid fa-sitemap me-2"></i>Network Tree</h3>
      <p class="text-muted mb-0 small">Sponsor-based 8-level network viewer</p>
    </div>
    <!-- Global user search -->
    <form class="d-flex gap-2" method="GET" style="max-width:380px;width:100%;">
      <input type="text" name="user_id" class="form-control form-control-sm text-uppercase" placeholder="Enter User ID (e.g. XV123456)" value="">
      <button class="btn btn-sm btn-primary" type="submit"><i class="fa-solid fa-search"></i></button>
    </form>
  </div>

  
      <!-- Empty state: no user selected -->
    <div class="card border-themed">
      <div class="card-body text-center py-5 text-muted">
        <i class="fa-solid fa-search fa-3x mb-3 d-block"></i>
        <h5>Enter a User ID above to view their 8-level network.</h5>
      </div>
    </div>
  </div>
@endsection
