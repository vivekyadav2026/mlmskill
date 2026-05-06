@extends('layouts.admin')
@section('title', 'Site Settings - Admin')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
  <div>
    <h3 class="fw-heading mb-1">Site Settings</h3>
    <p class="text-muted mb-0 small">Company information and branding. Changes reflect site-wide instantly.</p>
  </div>
  <a href="{{ url('admin/settings-overview') }}" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-arrow-left me-1"></i>Back</a>
</div>


<form method="POST" action="../admin/site-settings.html" enctype="multipart/form-data" novalidate="">
  <input type="hidden" name="csrf" value="4f2f9962ee4035ac000a344da610320b06d141b812ff41c0782a7abd464f8738">

  <!-- Company Information -->
  <div class="card border-themed mb-4">
    <div class="card-header bg-transparent border-themed">
      <h6 class="mb-0"><i class="fa-solid fa-building me-2"></i>Company Information</h6>
    </div>
    <div class="card-body">
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label small">Company Name <span class="text-danger">*</span></label>
          <input type="text" name="company_name" class="form-control" maxlength="120" required="" value="X VOLTY TRADE">
        </div>
        <div class="col-md-6">
          <label class="form-label small">Tagline</label>
          <input type="text" name="company_tagline" class="form-control" maxlength="200" value="Secure Crypto Trading &amp; Investment">
        </div>
        <div class="col-md-6">
          <label class="form-label small">Support Email</label>
          <input type="email" name="company_email" class="form-control" maxlength="120" value="support@xvoltytrade.com">
        </div>
        <div class="col-md-6">
          <label class="form-label small">Contact Phone</label>
          <input type="text" name="company_phone" class="form-control" maxlength="40" value="+1 (555) 987-6543">
        </div>
        <div class="col-md-6">
          <label class="form-label small">WhatsApp Number</label>
          <input type="text" name="company_whatsapp" class="form-control" maxlength="40" value="">
        </div>
        <div class="col-12">
          <label class="form-label small">Company Address</label>
          <textarea name="company_address" class="form-control" rows="3" maxlength="500">45 Finance Tower, New York, NY</textarea>
        </div>
      </div>
    </div>
  </div>

  <!-- Branding -->
  <div class="card border-themed mb-4">
    <div class="card-header bg-transparent border-themed">
      <h6 class="mb-0"><i class="fa-solid fa-palette me-2"></i>Branding</h6>
    </div>
    <div class="card-body">
      <div class="row g-4">
        <div class="col-md-6">
          <label class="form-label small">Company Logo <small class="text-muted">(PNG, JPG, WebP, SVG, max 2 MB)</small></label>
          <div class="d-flex align-items-center gap-3 mb-2">
            <div style="width:120px;height:60px;display:flex;align-items:center;justify-content:center;background:var(--bs-body-bg);border:1px solid var(--bs-border-color);border-radius:6px;overflow:hidden;">
                              <span class="text-muted small">No logo</span>
                          </div>
                      </div>
          <input type="file" name="company_logo" class="form-control" accept=".png,.jpg,.jpeg,.webp,.svg,image/png,image/jpeg,image/webp,image/svg+xml">
        </div>
        <div class="col-md-6">
          <label class="form-label small">Site Favicon <small class="text-muted">(ICO, PNG, max 512 KB)</small></label>
          <div class="d-flex align-items-center gap-3 mb-2">
            <div style="width:48px;height:48px;display:flex;align-items:center;justify-content:center;background:var(--bs-body-bg);border:1px solid var(--bs-border-color);border-radius:6px;overflow:hidden;">
                              <span class="text-muted" style="font-size:.7rem;">None</span>
                          </div>
                      </div>
          <input type="file" name="site_favicon" class="form-control" accept=".ico,.png,image/x-icon,image/vnd.microsoft.icon,image/png">
        </div>
      </div>
    </div>
  </div>

  <!-- SMTP (Email) Settings -->
  <div class="card border-themed mb-4">
    <div class="card-header bg-transparent border-themed d-flex align-items-center justify-content-between">
      <div>
        <h6 class="mb-0"><i class="fa-solid fa-envelope me-2"></i>SMTP / Email Settings</h6>
        <small class="text-muted">Used for welcome emails, password resets and notifications.</small>
      </div>
      <div class="form-check form-switch m-0">
        <input class="form-check-input" type="checkbox" role="switch" id="smtp_enabled" name="smtp_enabled" value="1">
        <label class="form-check-label small" for="smtp_enabled">Enable SMTP</label>
      </div>
    </div>
    <div class="card-body">
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label small">SMTP Host</label>
          <input type="text" name="smtp_host" class="form-control" placeholder="smtp.gmail.com" maxlength="120" value="smtp.freesmtpservers.com">
        </div>
        <div class="col-md-3">
          <label class="form-label small">Port</label>
          <input type="number" name="smtp_port" class="form-control" min="1" max="65535" value="25">
        </div>
        <div class="col-md-3">
          <label class="form-label small">Encryption</label>
                    <select name="smtp_encryption" class="form-select">
            <option value="tls">TLS (587)</option>
            <option value="ssl">SSL (465)</option>
            <option value="none" selected="">None (25)</option>
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label small">Username</label>
          <input type="text" name="smtp_username" class="form-control" autocomplete="off" maxlength="200" value="smtp.freesmtpservers.com">
        </div>
        <div class="col-md-6">
          <label class="form-label small">Password <span class="text-muted">(leave blank to keep existing)</span></label>
          <input type="password" name="smtp_password" class="form-control" autocomplete="new-password" placeholder="••••••••">
        </div>
        <div class="col-md-6">
          <label class="form-label small">From Email</label>
          <input type="email" name="smtp_from_email" class="form-control" maxlength="150" value="no-reply@xvoltytrade.com">
        </div>
        <div class="col-md-6">
          <label class="form-label small">From Name</label>
          <input type="text" name="smtp_from_name" class="form-control" maxlength="120" value="XVolty Trade">
        </div>
      </div>
      <div class="alert alert-info small mt-3 mb-0 py-2">
        <i class="fa-solid fa-circle-info me-1"></i>
        <strong>Demo values preloaded:</strong> host <code>smtp.gmail.com</code>, port <code>587</code>, encryption <code>TLS</code>.
        Replace username/password with real credentials (e.g. a Gmail <em>app password</em>) and enable the switch above, then save.
      </div>
    </div>
  </div>

  <!-- Social Media Links -->
  <div class="card border-themed mb-4">
    <div class="card-header bg-transparent border-themed">
      <h6 class="mb-0"><i class="fa-solid fa-share-nodes me-2"></i>Social Media Links</h6>
      <small class="text-muted">Only enabled links with a valid URL are shown on the site.</small>
    </div>
    <div class="card-body">
      <div class="row g-3">
                  <div class="col-md-6">
            <label class="form-label small"><i class="fa-brands fa-facebook-f me-2"></i>Facebook</label>
            <div class="input-group input-group-sm">
              <div class="input-group-text">
                <div class="form-check form-switch m-0">
                  <input class="form-check-input" type="checkbox" role="switch" id="en_facebook" name="facebook_enabled" value="1" checked="">
                  <label class="form-check-label small ms-1" for="en_facebook">On</label>
                </div>
              </div>
              <input type="url" name="facebook_url" class="form-control" placeholder="https://..." maxlength="255" value="http://localhost/Xvoltytrade/admin/site-settings.php">
            </div>
          </div>
                  <div class="col-md-6">
            <label class="form-label small"><i class="fa-brands fa-instagram me-2"></i>Instagram</label>
            <div class="input-group input-group-sm">
              <div class="input-group-text">
                <div class="form-check form-switch m-0">
                  <input class="form-check-input" type="checkbox" role="switch" id="en_instagram" name="instagram_enabled" value="1">
                  <label class="form-check-label small ms-1" for="en_instagram">On</label>
                </div>
              </div>
              <input type="url" name="instagram_url" class="form-control" placeholder="https://..." maxlength="255" value="">
            </div>
          </div>
                  <div class="col-md-6">
            <label class="form-label small"><i class="fa-brands fa-telegram me-2"></i>Telegram</label>
            <div class="input-group input-group-sm">
              <div class="input-group-text">
                <div class="form-check form-switch m-0">
                  <input class="form-check-input" type="checkbox" role="switch" id="en_telegram" name="telegram_enabled" value="1" checked="">
                  <label class="form-check-label small ms-1" for="en_telegram">On</label>
                </div>
              </div>
              <input type="url" name="telegram_url" class="form-control" placeholder="https://..." maxlength="255" value="http://localhost/Xvoltytrade/admin/site-settings.php">
            </div>
          </div>
                  <div class="col-md-6">
            <label class="form-label small"><i class="fa-brands fa-x-twitter me-2"></i>X / Twitter</label>
            <div class="input-group input-group-sm">
              <div class="input-group-text">
                <div class="form-check form-switch m-0">
                  <input class="form-check-input" type="checkbox" role="switch" id="en_twitter" name="twitter_enabled" value="1">
                  <label class="form-check-label small ms-1" for="en_twitter">On</label>
                </div>
              </div>
              <input type="url" name="twitter_url" class="form-control" placeholder="https://..." maxlength="255" value="">
            </div>
          </div>
                  <div class="col-md-6">
            <label class="form-label small"><i class="fa-brands fa-youtube me-2"></i>YouTube</label>
            <div class="input-group input-group-sm">
              <div class="input-group-text">
                <div class="form-check form-switch m-0">
                  <input class="form-check-input" type="checkbox" role="switch" id="en_youtube" name="youtube_enabled" value="1" checked="">
                  <label class="form-check-label small ms-1" for="en_youtube">On</label>
                </div>
              </div>
              <input type="url" name="youtube_url" class="form-control" placeholder="https://..." maxlength="255" value="http://localhost/Xvoltytrade/admin/site-settings.php">
            </div>
          </div>
                  <div class="col-md-6">
            <label class="form-label small"><i class="fa-brands fa-linkedin-in me-2"></i>LinkedIn</label>
            <div class="input-group input-group-sm">
              <div class="input-group-text">
                <div class="form-check form-switch m-0">
                  <input class="form-check-input" type="checkbox" role="switch" id="en_linkedin" name="linkedin_enabled" value="1">
                  <label class="form-check-label small ms-1" for="en_linkedin">On</label>
                </div>
              </div>
              <input type="url" name="linkedin_url" class="form-control" placeholder="https://..." maxlength="255" value="">
            </div>
          </div>
                  <div class="col-md-6">
            <label class="form-label small"><i class="fa-brands fa-whatsapp me-2"></i>WhatsApp Channel</label>
            <div class="input-group input-group-sm">
              <div class="input-group-text">
                <div class="form-check form-switch m-0">
                  <input class="form-check-input" type="checkbox" role="switch" id="en_whatsapp_channel" name="whatsapp_channel_enabled" value="1">
                  <label class="form-check-label small ms-1" for="en_whatsapp_channel">On</label>
                </div>
              </div>
              <input type="url" name="whatsapp_channel_url" class="form-control" placeholder="https://..." maxlength="255" value="">
            </div>
          </div>
              </div>
    </div>
  </div>

  <div class="d-flex justify-content-end gap-2 mb-5">
    <a href="{{ url('admin/settings-overview') }}" class="btn btn-outline-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk me-1"></i>Save Changes</button>
  </div>
</form>

<!-- SMTP Test Send (separate form) -->
<div class="card border-themed mb-5">
  <div class="card-header bg-transparent border-themed">
    <h6 class="mb-0"><i class="fa-solid fa-paper-plane me-2"></i>Send Test Email</h6>
    <small class="text-muted">Save SMTP settings first, then use this to verify delivery.</small>
  </div>
  <div class="card-body">
    <form method="POST" action="../admin/site-settings.html" class="row g-2 align-items-end">
      <input type="hidden" name="csrf" value="4f2f9962ee4035ac000a344da610320b06d141b812ff41c0782a7abd464f8738">
      <input type="hidden" name="action" value="test_smtp">
      <div class="col-md-6">
        <label class="form-label small">Recipient Email</label>
        <input type="email" name="test_email" class="form-control" placeholder="you@example.com" required="">
      </div>
      <div class="col-md-3">
        <button type="submit" class="btn btn-outline-primary w-100"><i class="fa-solid fa-paper-plane me-1"></i>Send Test</button>
      </div>
    </form>
  </div>
</div>
@endsection
