<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

class AdminSettingController extends Controller
{
    public function general()
    {
        $settings = Setting::pluck('value', 'key');
        return view('admin.settings.general', compact('settings'));
    }

    public function saveGeneral(Request $request)
    {
        $request->validate([
            'site_name'       => 'required|string|max:120',
            'site_tagline'    => 'nullable|string|max:250',
            'support_email'   => 'nullable|email|max:120',
            'support_phone'   => 'nullable|string|max:40',
            'support_whatsapp'=> 'nullable|string|max:40',
            'company_address' => 'nullable|string|max:500',
            'facebook_url'    => 'nullable|url|max:255',
            'instagram_url'   => 'nullable|url|max:255',
            'telegram_url'    => 'nullable|url|max:255',
            'twitter_url'     => 'nullable|url|max:255',
            'youtube_url'     => 'nullable|url|max:255',
            'linkedin_url'    => 'nullable|url|max:255',
            'whatsapp_channel_url' => 'nullable|url|max:255',
        ]);

        $fields = [
            'site_name', 'site_tagline', 'support_email', 'support_phone',
            'support_whatsapp', 'company_address', 'facebook_url', 'instagram_url',
            'telegram_url', 'twitter_url', 'youtube_url', 'linkedin_url', 'whatsapp_channel_url',
        ];

        foreach ($fields as $field) {
            Setting::set($field, $request->input($field, ''));
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/branding'), $filename);
            Setting::set('site_logo', asset('uploads/branding/' . $filename));
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            $file = $request->file('favicon');
            $filename = 'favicon_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/branding'), $filename);
            Setting::set('site_favicon', asset('uploads/branding/' . $filename));
        }

        return back()->with('success', 'General settings saved successfully!');
    }

    public function smtp()
    {
        $settings = Setting::pluck('value', 'key');
        return view('admin.settings.smtp', compact('settings'));
    }

    public function saveSmtp(Request $request)
    {
        $request->validate([
            'smtp_host'       => 'required|string|max:120',
            'smtp_port'       => 'required|integer',
            'smtp_encryption' => 'required|in:tls,ssl,none',
            'smtp_username'   => 'nullable|string|max:200',
            'smtp_from_email' => 'required|email|max:150',
            'smtp_from_name'  => 'required|string|max:120',
        ]);

        $fields = ['smtp_host', 'smtp_port', 'smtp_encryption', 'smtp_username', 'smtp_from_email', 'smtp_from_name'];
        foreach ($fields as $f) Setting::set($f, $request->input($f, ''));

        if ($request->filled('smtp_password')) {
            Setting::set('smtp_password', encrypt($request->smtp_password));
        }

        Setting::set('smtp_enabled', $request->has('smtp_enabled') ? '1' : '0');

        return back()->with('success', 'SMTP settings saved successfully!');
    }

    public function sendTestEmail(Request $request)
    {
        $request->validate(['test_email' => 'required|email']);

        try {
            Mail::raw('This is a test email from your MLM Platform admin panel.', function ($msg) use ($request) {
                $msg->to($request->test_email)
                    ->subject('SMTP Test - ' . Setting::get('site_name', 'MLM Platform'));
            });
            return back()->with('success', 'Test email sent successfully to ' . $request->test_email);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send test email: ' . $e->getMessage());
        }
    }

    // ── MLM Plan Settings ──────────────────────────────────────
    public function plan()
    {
        $settings = Setting::pluck('value', 'key');
        return view('admin.settings.plan', compact('settings'));
    }

    public function savePlan(Request $request)
    {
        $rules = [
            'registration_fee'      => 'required|numeric|min:0',
            'max_levels'            => 'required|integer|min:1|max:10',
            'min_withdrawal'        => 'required|numeric|min:0',
            'max_withdrawal'        => 'required|numeric|min:0',
            'withdrawal_charge_pct' => 'required|numeric|min:0|max:100',
            'renewal_target'        => 'required|numeric|min:0',
        ];
        $fields = [
            'registration_fee', 'max_levels', 'min_withdrawal', 'max_withdrawal',
            'withdrawal_charge_pct', 'renewal_target', 'plan_name', 'plan_description',
        ];

        for ($i = 1; $i <= 10; $i++) {
            $rules['level_'.$i.'_pct'] = 'required|numeric|min:0|max:100';
            $fields[] = 'level_'.$i.'_pct';
        }

        $request->validate($rules);

        foreach ($fields as $f) {
            Setting::set($f, $request->input($f, ''));
        }

        return back()->with('success', 'MLM Plan settings saved successfully!');
    }

    // ── Token Settings ─────────────────────────────────────────
    public function token()
    {
        $settings = Setting::pluck('value', 'key');
        return view('admin.settings.token', compact('settings'));
    }

    public function saveToken(Request $request)
    {
        $request->validate([
            'utility_token_value'  => 'required|numeric|min:0',
            'renewal_token_value'  => 'required|numeric|min:0',
            'token_expiry_days'    => 'required|integer|min:0',
            'min_token_redeem'     => 'required|numeric|min:0',
        ]);

        $fields = [
            'utility_token_value', 'renewal_token_value',
            'token_expiry_days', 'min_token_redeem',
            'utility_token_name', 'renewal_token_name',
        ];
        foreach ($fields as $f) Setting::set($f, $request->input($f, ''));

        Setting::set('token_auto_credit',  $request->has('token_auto_credit')  ? '1' : '0');
        Setting::set('token_transferable', $request->has('token_transferable') ? '1' : '0');

        return back()->with('success', 'Token settings saved successfully!');
    }

    // ── Payment Settings ───────────────────────────────────────
    public function payment()
    {
        $settings = Setting::pluck('value', 'key');
        return view('admin.settings.payment', compact('settings'));
    }

    public function savePayment(Request $request)
    {
        $request->validate([
            'payment_currency'     => 'required|string|max:10',
            'payment_currency_sym' => 'required|string|max:5',
        ]);

        $fields = [
            'payment_currency', 'payment_currency_sym',
            'upi_id', 'upi_name', 'bank_name', 'bank_account_no',
            'bank_ifsc', 'bank_holder_name', 'crypto_wallet_address',
            'crypto_network', 'qr_code_url',
        ];
        foreach ($fields as $f) Setting::set($f, $request->input($f, ''));

        Setting::set('payment_upi_enabled',    $request->has('payment_upi_enabled')    ? '1' : '0');
        Setting::set('payment_bank_enabled',   $request->has('payment_bank_enabled')   ? '1' : '0');
        Setting::set('payment_crypto_enabled', $request->has('payment_crypto_enabled') ? '1' : '0');

        // QR Code image upload
        if ($request->hasFile('qr_image')) {
            $file = $request->file('qr_image');
            $fname = 'qr_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/branding'), $fname);
            Setting::set('qr_code_url', asset('uploads/branding/' . $fname));
        }

        return back()->with('success', 'Payment settings saved successfully!');
    }

    // ── Theme Customizer ───────────────────────────────────────
    public function saveTheme(Request $request)
    {
        $fields = [
            'theme_primary', 'theme_accent', 'theme_mode',
            'theme_radius', 'theme_body_bg', 'theme_card_bg',
            'theme_sidebar_bg', 'theme_topbar_bg',
        ];
        foreach ($fields as $f) {
            if ($request->has($f)) {
                Setting::set($f, $request->input($f));
            }
        }
        return response()->json(['status' => 'success', 'message' => 'Theme saved!']);
    }
}
