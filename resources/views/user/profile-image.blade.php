@extends('layouts.user')
@section('title', 'Profile Image — XVolty Trade')

@section('content')
<h3 class="fw-heading mb-1"><i class="fa-solid fa-camera me-2"></i>Profile Image</h3>
<p class="text-muted small mb-4">Upload or change your profile picture.</p>

<div class="row"><div class="col-lg-6">
    
  <div class="card border-themed">
    <div class="card-body p-4 text-center">
      <div class="mb-3">
                  <img src="{{ asset('assets/Profile Image — XVolty Trade_files/3448ce1363001e09fd873ae7a8b81485.png" alt="Profile" class="rounded-circle" style="width:140px;height:140px;object-fit:cover;border:3px solid var(--xvt-primary);">
              </div>
      <p class="small text-muted mb-4">JPG, JPEG or PNG. Max 2 MB.</p>

      <form method="POST" enctype="multipart/form-data" class="d-inline">
        <input type="hidden" name="upload_image" value="1">
        <input type="file" name="profile_image" id="profileImageInput" accept=".jpg,.jpeg,.png" class="d-none" onchange="this.form.submit()">
        <button type="button" class="btn btn-primary" onclick="document.getElementById(&#39;profileImageInput&#39;).click()">
          <i class="fa-solid fa-upload me-1"></i>Upload New Image
        </button>
      </form>

              <form method="POST" class="d-inline ms-2" onsubmit="return confirm(&#39;Remove your profile image?&#39;)">
          <input type="hidden" name="remove_image" value="1">
          <button type="submit" class="btn btn-outline-danger"><i class="fa-solid fa-trash me-1"></i>Remove Image</button>
        </form>
          </div>
  </div>
</div></div>
@endsection
