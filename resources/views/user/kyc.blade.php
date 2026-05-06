@extends('layouts.user')
@section('title', 'KYC Management — XVolty Trade')

@section('content')
<h3 class="fw-heading mb-1"><i class="fa-solid fa-id-card me-2"></i>KYC Management
      <span class="badge bg-success ms-2">KYC Status: Approved</span>
  </h3>
<p class="text-muted small mb-4">Submit your identity documents for verification.</p>


  <div class="alert alert-success d-flex align-items-center gap-3">
    <i class="fa-solid fa-circle-check fa-2x"></i>
    <div><h6 class="mb-1 fw-bold">KYC Approved</h6><div class="small mb-0">Your identity documents have been verified successfully.</div></div>
  </div>

  <div class="card border-themed mb-3">
    <div class="card-header bg-transparent border-themed">
      <h6 class="mb-0"><i class="fa-solid fa-images me-2"></i>Uploaded Documents</h6>
    </div>
    <div class="card-body">
      <div class="row g-3 mb-3">
        <div class="col-md-6">
          <div class="small text-muted">PAN Number</div>
          <div class="fw-semibold">ABCDE1234F</div>
        </div>
        <div class="col-md-6">
          <div class="small text-muted">Aadhaar Number</div>
          <div class="fw-semibold">123456789012</div>
        </div>
      </div>
      <div class="row g-3">
                  <div class="col-md-4">
            <div class="small text-muted mb-1">PAN Card</div>
            <a href="{{ asset('assets/KYC Management — XVolty Trade_files/pan_a431ffb5c44cb03743e21b3f2a689eaf.jpg" target="_blank" class="d-block border rounded overflow-hidden" style="max-height:220px;">
              <img src="{{ asset('assets/KYC Management — XVolty Trade_files/pan_a431ffb5c44cb03743e21b3f2a689eaf.jpg" alt="PAN Card" class="img-fluid w-100" style="object-fit:cover;max-height:220px;">
            </a>
          </div>
                  <div class="col-md-4">
            <div class="small text-muted mb-1">Aadhaar Front</div>
            <a href="{{ asset('assets/KYC Management — XVolty Trade_files/aadhaar_front_d4668b422ff475ff7a28ee3a0d6a77d2.jpg" target="_blank" class="d-block border rounded overflow-hidden" style="max-height:220px;">
              <img src="{{ asset('assets/KYC Management — XVolty Trade_files/aadhaar_front_d4668b422ff475ff7a28ee3a0d6a77d2.jpg" alt="Aadhaar Front" class="img-fluid w-100" style="object-fit:cover;max-height:220px;">
            </a>
          </div>
                  <div class="col-md-4">
            <div class="small text-muted mb-1">Aadhaar Back</div>
            <a href="{{ asset('assets/KYC Management — XVolty Trade_files/aadhaar_back_7b9c14f4f7448dfe6790a8cc9144f0e6.jpg" target="_blank" class="d-block border rounded overflow-hidden" style="max-height:220px;">
              <img src="{{ asset('assets/KYC Management — XVolty Trade_files/aadhaar_back_7b9c14f4f7448dfe6790a8cc9144f0e6.jpg" alt="Aadhaar Back" class="img-fluid w-100" style="object-fit:cover;max-height:220px;">
            </a>
          </div>
              </div>
    </div>
  </div>
@endsection
