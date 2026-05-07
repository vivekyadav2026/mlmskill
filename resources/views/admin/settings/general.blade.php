@extends('layouts.admin')

@section('content')
<style>
  .section-card { background: #1a222d; border: 1px solid #334155; border-radius: 0.75rem; margin-bottom: 1.5rem; overflow: hidden; }
  .section-header { background: #0f172a; padding: 1rem 1.5rem; border-bottom: 1px solid #334155; display: flex; align-items: center; gap: 0.5rem; }
  .section-header h3 { color: #e2e8f0; font-weight: 600; margin: 0; font-size: 0.95rem; }
  .section-body { padding: 1.5rem; }
  .form-label { color: #94a3b8; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.4rem; display: block; }
  .form-control { background: #0f172a; border: 1px solid #334155; color: #e2e8f0; border-radius: 0.5rem; padding: 0.6rem 1rem; width: 100%; transition: border-color 0.2s; }
  .form-control:focus { outline: none; border-color: #6366f1; }
  .form-control::placeholder { color: #475569; }
  .input-group { display: flex; align-items: stretch; }
  .input-group .input-prefix { background: #1e293b; border: 1px solid #334155; border-right: none; padding: 0.6rem 0.75rem; color: #64748b; font-size: 0.9rem; border-radius: 0.5rem 0 0 0.5rem; display: flex; align-items: center; }
  .input-group .form-control { border-radius: 0 0.5rem 0.5rem 0; }
  .btn-save { background: linear-gradient(135deg, #6366f1, #4f46e5); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 0.5rem; font-weight: 600; cursor: pointer; transition: all 0.2s; }
  .btn-save:hover { opacity: 0.9; transform: translateY(-1px); }
  .preview-img { width: 100px; height: 50px; object-fit: contain; border: 1px solid #334155; border-radius: 0.5rem; background: #0b1220; padding: 4px; }
  .tab-nav { display: flex; gap: 0.5rem; margin-bottom: 1.5rem; border-bottom: 1px solid #334155; padding-bottom: 0.5rem; }
  .tab-btn { padding: 0.5rem 1rem; border-radius: 0.5rem 0.5rem 0 0; color: #94a3b8; font-size: 0.875rem; font-weight: 500; cursor: pointer; border: none; background: transparent; transition: all 0.2s; }
  .tab-btn.active { background: #6366f1; color: white; }
  .tab-btn:hover:not(.active) { background: #1e293b; color: #e2e8f0; }
  .tab-content { display: none; }
  .tab-content.active { display: block; }
  .social-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
  @media(max-width:768px) { .social-row { grid-template-columns: 1fr; } }
</style>

<div class="tailwind-scope mt-4 max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-100">General Settings</h2>
            <p class="text-gray-400 text-sm">Manage site identity, branding, contact info, SMTP and social links</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-900/50 border border-green-500/50 text-green-300 px-4 py-3 rounded-lg mb-4 flex items-center gap-2">
            <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-900/50 border border-red-500/50 text-red-300 px-4 py-3 rounded-lg mb-4 flex items-center gap-2">
            <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
        </div>
    @endif
    @if($errors->any())
        <div class="bg-red-900/50 border border-red-500/50 text-red-300 px-4 py-3 rounded-lg mb-4">
            <ul class="list-disc ml-4 space-y-1 text-sm">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <!-- Tab Nav -->
    <div class="tab-nav">
        <button class="tab-btn active" onclick="switchTab('general', this)"><i class="fa-solid fa-building mr-1"></i> Company Info</button>
        <button class="tab-btn" onclick="switchTab('branding', this)"><i class="fa-solid fa-palette mr-1"></i> Branding</button>
        <button class="tab-btn" onclick="switchTab('social', this)"><i class="fa-solid fa-share-nodes mr-1"></i> Social Media</button>
        <button class="tab-btn" onclick="switchTab('smtp', this)"><i class="fa-solid fa-envelope mr-1"></i> SMTP / Email</button>
    </div>

    <form action="{{ url('admin/settings/general') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- TAB: Company Info -->
        <div id="tab-general" class="tab-content active">
            <div class="section-card">
                <div class="section-header"><i class="fa-solid fa-building text-indigo-400"></i><h3>Company Information</h3></div>
                <div class="section-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="form-label">Site / Company Name <span class="text-red-400">*</span></label>
                            <input type="text" name="site_name" class="form-control" required maxlength="120" value="{{ $settings['site_name'] ?? config('app.name') }}">
                        </div>
                        <div>
                            <label class="form-label">Tagline</label>
                            <input type="text" name="site_tagline" class="form-control" maxlength="250" value="{{ $settings['site_tagline'] ?? '' }}" placeholder="e.g. Empowering Your Network">
                        </div>
                        <div>
                            <label class="form-label">Support Email</label>
                            <input type="email" name="support_email" class="form-control" maxlength="120" value="{{ $settings['support_email'] ?? '' }}" placeholder="support@yoursite.com">
                        </div>
                        <div>
                            <label class="form-label">Contact Phone</label>
                            <input type="text" name="support_phone" class="form-control" maxlength="40" value="{{ $settings['support_phone'] ?? '' }}" placeholder="+91 98765 43210">
                        </div>
                        <div>
                            <label class="form-label">WhatsApp Number</label>
                            <div class="input-group">
                                <span class="input-prefix"><i class="fa-brands fa-whatsapp text-green-400"></i></span>
                                <input type="text" name="support_whatsapp" class="form-control" maxlength="40" value="{{ $settings['support_whatsapp'] ?? '' }}" placeholder="+91 9876543210">
                            </div>
                        </div>
                        <div>
                            <label class="form-label">Company Address</label>
                            <textarea name="company_address" class="form-control" rows="2" maxlength="500" placeholder="Full company address...">{{ $settings['company_address'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB: Branding -->
        <div id="tab-branding" class="tab-content">
            <div class="section-card">
                <div class="section-header"><i class="fa-solid fa-image text-purple-400"></i><h3>Logo & Favicon</h3></div>
                <div class="section-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="form-label">Company Logo <small class="text-gray-500 normal-case">(PNG, JPG, WebP, SVG · Max 2MB)</small></label>
                            @if(!empty($settings['site_logo']))
                                <div class="mb-3">
                                    <p class="text-gray-500 text-xs mb-1">Current Logo:</p>
                                    <img src="{{ $settings['site_logo'] }}" alt="Logo" class="preview-img">
                                </div>
                            @endif
                            <input type="file" name="logo" class="form-control" accept=".png,.jpg,.jpeg,.webp,.svg">
                        </div>
                        <div>
                            <label class="form-label">Favicon <small class="text-gray-500 normal-case">(ICO, PNG · Max 512KB)</small></label>
                            @if(!empty($settings['site_favicon']))
                                <div class="mb-3">
                                    <p class="text-gray-500 text-xs mb-1">Current Favicon:</p>
                                    <img src="{{ $settings['site_favicon'] }}" alt="Favicon" style="width:32px;height:32px;object-fit:contain;" class="border border-gray-700 rounded p-1 bg-gray-900">
                                </div>
                            @endif
                            <input type="file" name="favicon" class="form-control" accept=".ico,.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB: Social Media -->
        <div id="tab-social" class="tab-content">
            <div class="section-card">
                <div class="section-header"><i class="fa-solid fa-share-nodes text-blue-400"></i><h3>Social Media Links</h3></div>
                <div class="section-body">
                    <div class="social-row">
                        @php
                            $socials = [
                                ['key' => 'facebook_url',          'label' => 'Facebook',         'icon' => 'fa-brands fa-facebook-f',    'color' => 'text-blue-500'],
                                ['key' => 'instagram_url',         'label' => 'Instagram',        'icon' => 'fa-brands fa-instagram',      'color' => 'text-pink-500'],
                                ['key' => 'telegram_url',          'label' => 'Telegram',         'icon' => 'fa-brands fa-telegram',       'color' => 'text-sky-400'],
                                ['key' => 'twitter_url',           'label' => 'X / Twitter',      'icon' => 'fa-brands fa-x-twitter',     'color' => 'text-gray-300'],
                                ['key' => 'youtube_url',           'label' => 'YouTube',          'icon' => 'fa-brands fa-youtube',        'color' => 'text-red-500'],
                                ['key' => 'linkedin_url',          'label' => 'LinkedIn',         'icon' => 'fa-brands fa-linkedin-in',    'color' => 'text-blue-400'],
                                ['key' => 'whatsapp_channel_url',  'label' => 'WhatsApp Channel', 'icon' => 'fa-brands fa-whatsapp',      'color' => 'text-green-400'],
                            ];
                        @endphp
                        @foreach($socials as $s)
                        <div>
                            <label class="form-label"><i class="{{ $s['icon'] }} {{ $s['color'] }} mr-1"></i>{{ $s['label'] }}</label>
                            <input type="url" name="{{ $s['key'] }}" class="form-control" placeholder="https://..." maxlength="255" value="{{ $settings[$s['key']] ?? '' }}">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB: SMTP -->
        <div id="tab-smtp" class="tab-content">
            <div class="section-card">
                <div class="section-header">
                    <i class="fa-solid fa-envelope text-indigo-400"></i>
                    <h3>SMTP / Email Settings</h3>
                    <label class="ml-auto flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="smtp_enabled" value="1" class="w-4 h-4 rounded" {{ ($settings['smtp_enabled'] ?? '0') == '1' ? 'checked' : '' }}>
                        <span class="text-gray-400 text-sm font-normal">Enable SMTP</span>
                    </label>
                </div>
                <div class="section-body">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-1">
                            <label class="form-label">SMTP Host</label>
                            <input type="text" name="smtp_host" class="form-control" placeholder="smtp.gmail.com" value="{{ $settings['smtp_host'] ?? '' }}">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="form-label">Port</label>
                                <input type="number" name="smtp_port" class="form-control" value="{{ $settings['smtp_port'] ?? '587' }}">
                            </div>
                            <div>
                                <label class="form-label">Encryption</label>
                                <select name="smtp_encryption" class="form-control">
                                    <option value="tls" {{ ($settings['smtp_encryption'] ?? 'tls') == 'tls' ? 'selected' : '' }}>TLS (587)</option>
                                    <option value="ssl" {{ ($settings['smtp_encryption'] ?? '') == 'ssl' ? 'selected' : '' }}>SSL (465)</option>
                                    <option value="none" {{ ($settings['smtp_encryption'] ?? '') == 'none' ? 'selected' : '' }}>None (25)</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="form-label">Username</label>
                            <input type="text" name="smtp_username" class="form-control" autocomplete="off" value="{{ $settings['smtp_username'] ?? '' }}">
                        </div>
                        <div>
                            <label class="form-label">Password <small class="text-gray-500 normal-case">(leave blank to keep existing)</small></label>
                            <input type="password" name="smtp_password" class="form-control" autocomplete="new-password" placeholder="••••••••">
                        </div>
                        <div>
                            <label class="form-label">From Email</label>
                            <input type="email" name="smtp_from_email" class="form-control" value="{{ $settings['smtp_from_email'] ?? '' }}" placeholder="no-reply@yoursite.com">
                        </div>
                        <div>
                            <label class="form-label">From Name</label>
                            <input type="text" name="smtp_from_name" class="form-control" value="{{ $settings['smtp_from_name'] ?? config('app.name') }}">
                        </div>
                    </div>
                    <div class="mt-4 p-3 bg-blue-900/20 border border-blue-500/30 rounded-lg text-blue-300 text-sm flex gap-2 items-start">
                        <i class="fa-solid fa-circle-info mt-0.5"></i>
                        <p>For Gmail, enable 2FA and create an <strong>App Password</strong> instead of your regular password. Use <code>smtp.gmail.com</code>, port <code>587</code>, encryption <code>TLS</code>.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 mt-2">
            <button type="submit" class="btn-save">
                <i class="fa-solid fa-floppy-disk mr-2"></i> Save Settings
            </button>
        </div>
    </form>

    <!-- Test Email Section -->
    <div class="section-card mt-6">
        <div class="section-header"><i class="fa-solid fa-paper-plane text-green-400"></i><h3>Send Test Email</h3></div>
        <div class="section-body">
            <p class="text-gray-400 text-sm mb-4">Save SMTP settings first, then use this to verify email delivery is working correctly.</p>
            <form action="{{ url('admin/settings/test-email') }}" method="POST" class="flex gap-3 items-end">
                @csrf
                <div class="flex-grow">
                    <label class="form-label">Recipient Email</label>
                    <input type="email" name="test_email" class="form-control" placeholder="you@example.com" required>
                </div>
                <button type="submit" class="px-4 py-2.5 bg-green-700 hover:bg-green-600 text-white rounded-lg transition font-medium whitespace-nowrap">
                    <i class="fa-solid fa-paper-plane mr-1"></i> Send Test
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function switchTab(tab, btn) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
    document.getElementById('tab-' + tab).classList.add('active');
    btn.classList.add('active');
}
</script>
@endsection