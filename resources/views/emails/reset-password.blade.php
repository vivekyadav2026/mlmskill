<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reset Your Password</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f4; padding: 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                    <tr>
                        <td style="background-color: #1e293b; padding: 25px 20px; text-align: center; border-bottom: 3px solid #4f46e5;">
                            @php
                                $logoUrl = \App\Models\Setting::get('site_logo');
                                $logoPath = null;
                                if ($logoUrl) {
                                    $filename = basename(parse_url($logoUrl, PHP_URL_PATH));
                                    $potentialPath = public_path('uploads/branding/' . $filename);
                                    if (file_exists($potentialPath)) {
                                        $logoPath = $potentialPath;
                                    }
                                }
                                if (!$logoPath) {
                                    $potentialPath = public_path('logo.png');
                                    if (file_exists($potentialPath)) {
                                        $logoPath = $potentialPath;
                                    }
                                }
                            @endphp
                            @if($logoPath && isset($message))
                                <img src="{{ $message->embed($logoPath) }}" alt="{{ \App\Models\Setting::get('site_name', 'Samarth Digital') }}" style="max-height: 60px; margin-bottom: 12px; border-radius: 4px; display: inline-block;">
                            @else
                                <img src="{{ $logoUrl ?: asset('logo.png') }}" alt="{{ \App\Models\Setting::get('site_name', 'Samarth Digital') }}" style="max-height: 60px; margin-bottom: 12px; border-radius: 4px; display: inline-block;">
                            @endif
                            <h2 style="color: #ffffff; margin: 0; font-family: Arial, sans-serif; font-size: 22px;">Password Reset Request</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 30px; color: #333333; line-height: 1.6;">
                            <p>Hello <strong>{{ $user->name }}</strong>,</p>
                            <p>You are receiving this email because we received a password reset request for your account.</p>
                            <div style="text-align: center; margin: 30px 0;">
                                <a href="{{ url('reset-password/' . $token . '?email=' . urlencode($email)) }}" style="background-color: #4f46e5; color: #ffffff; text-decoration: none; padding: 12px 25px; border-radius: 5px; font-weight: bold; display: inline-block;">Reset Password</a>
                            </div>
                            <p>If you did not request a password reset, no further action is required.</p>
                            <p>Best regards,<br>The Team</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color: #f9fafb; padding: 15px; text-align: center; font-size: 12px; color: #6b7280;">
                            <p style="margin: 0;">If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:</p>
                            <p style="margin: 5px 0 0; word-break: break-all;"><a href="{{ url('reset-password/' . $token . '?email=' . urlencode($email)) }}" style="color: #4f46e5;">{{ url('reset-password/' . $token . '?email=' . urlencode($email)) }}</a></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
