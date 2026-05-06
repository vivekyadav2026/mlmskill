@extends('layouts.user')
@section('title', 'Change Password — XVolty Trade')

@section('content')
<h3 class="fw-heading mb-1"><i class="fa-solid fa-user me-2"></i>Change Password</h3>
<p class="text-muted small mb-4">Update your personal information.</p>


<div class="card border-themed">
  <div class="card-body p-4">
    <form method="POST" novalidate="">
      <input type="hidden" name="update_profile" value="1">
      <div class="row g-3">
        <div class="col-md-6">
          <label for="profileName" class="form-label">Full Name</label>
          <input type="text" id="profileName" name="name" class="form-control" value="XVoltyTrade" placeholder="John Doe">
        </div>
        <div class="col-md-6">
          <label for="profileEmail" class="form-label">Email Address</label>
          <input type="email" id="profileEmail" name="email" class="form-control" value="user@xvoltytrade.com" placeholder="you@example.com">
        </div>
        <div class="col-md-6">
          <label for="profileMobile" class="form-label">Mobile Number</label>
          <input type="tel" id="profileMobile" name="mobile" class="form-control" value="9876543211" placeholder="+91 98765 43210">
        </div>
        <div class="col-md-6">
          <label for="profileSponsor" class="form-label">Referred By (Sponsor ID)</label>
          <input type="text" id="profileSponsor" class="form-control" value="None" readonly="" disabled="">
        </div>
        <div class="col-12">
          <label for="profileAddress" class="form-label">Complete Address</label>
          <textarea id="profileAddress" name="address" rows="3" class="form-control" placeholder="Enter your full address">Village Baraha Post Sarui Tahsil Teonthar Jila Rewa
Baraha</textarea>
        </div>
      </div>
      <div class="mt-4 text-end">
        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save me-1"></i>Update Profile</button>
      </div>
    </form>
  </div>
</div>
@endsection
