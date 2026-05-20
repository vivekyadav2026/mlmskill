<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\ActivityLog;
use App\Mail\WelcomeEmail;
use App\Mail\ResetPasswordMail;
use App\Notifications\NewUserNotification;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            ActivityLog::log('login', 'User logged in successfully');
            
            if (Auth::user()->role === 'admin') {
                // Force admins to admin dashboard, ignoring previous 'intended' user URLs
                return redirect('/admin/dashboard');
            }
            
            // Force regular users to user dashboard
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|max:8|confirmed',
            'sponsor_id' => 'required|string|exists:users,referral_code',
        ], [
            'sponsor_id.required' => 'A Referral Code is required to join the platform.',
            'sponsor_id.exists' => 'The provided Referral Code is invalid. Please check and try again.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'sponsor_id' => $request->sponsor_id,
            'referral_code' => 'SD' . str_pad((User::max('id') + 1), 6, '0', STR_PAD_LEFT),
        ]);

        // Create wallet with 0 balance
        $wallet = \App\Models\Wallet::firstOrCreate(['user_id' => $user->id]);

        // Send welcome email to user
        try {
            Mail::to($user->email)->send(new WelcomeEmail($user));
        } catch (\Exception $e) {
            \Log::error("Failed to send welcome email: " . $e->getMessage());
        }

        // Notify admins
        $admins = User::where('role', 'admin')->get();
        if ($admins->count() > 0) {
            Notification::send($admins, new NewUserNotification($user));
        }

        ActivityLog::log('register', 'User registered an account: ' . $user->email, $user->id);

        // Auto-login the user
        Auth::login($user);
        ActivityLog::log('login', 'User logged in successfully automatically after registration');

        return redirect()->route('dashboard')->with('success', 'Registration successful!');
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            ActivityLog::log('logout', 'User logged out');
        }
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function showForgot()
    {
        return view('auth.forgot-password');
    }

    public function processForgot(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'We could not find a user with that email address.');
        }

        // Generate a secure random token
        $token = Str::random(64);

        // Save token to database
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        // Send email
        try {
            Mail::to($request->email)->send(new ResetPasswordMail($token, $request->email, $user));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send reset link. Please check your email configuration.');
        }

        ActivityLog::log('password_reset_request', 'User requested a password reset link', $user->id);

        return back()->with('success', 'We have emailed your password reset link! Please check your inbox (and spam folder).');
    }

    public function showResetForm(Request $request, $token)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    public function processReset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6|max:8|confirmed',
        ]);

        $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$resetRecord) {
            return back()->with('error', 'Invalid or expired password reset token.');
        }

        // Check if token is expired (e.g. 60 minutes)
        if (Carbon::parse($resetRecord->created_at)->addMinutes(60)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->with('error', 'Your password reset link has expired. Please request a new one.');
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->with('error', 'We could not find a user with that email address.');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the token so it can't be reused
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        ActivityLog::log('password_reset', 'User recovered and reset their password securely via email', $user->id);

        return redirect()->route('login')->with('success', 'Your password has been successfully reset! You can now sign in.');
    }
}
