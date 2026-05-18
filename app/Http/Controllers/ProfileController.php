<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('user.profile.edit', compact('user'));
    }

    public function password()
    {
        $user = Auth::user();
        return view('user.profile.password', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => [
                'nullable',
                'string',
                'regex:/^[6-9]\d{9}$/',
                'unique:users,phone,' . $user->id,
            ],
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip' => 'nullable|string|max:20',
        ], [
            'phone.regex' => 'The mobile number must be a valid 10-digit Indian mobile number starting with 6, 7, 8, or 9.',
        ]);

        if ($request->hasFile('profile_image')) {
            $imageName = time().'.'.$request->profile_image->extension();  
            $request->profile_image->move(public_path('images/profiles'), $imageName);
            $user->profile_image = 'images/profiles/'.$imageName;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->zip = $request->zip;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => ['required', 'confirmed', 'min:6', 'max:8'],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully!');
    }

    public function show()
    {
        $user = Auth::user()->load('wallet', 'referrals', 'commissions', 'withdrawals', 'certificates');

        // Wallet data
        $wallet = $user->wallet;

        // Earnings
        $totalEarned       = \App\Models\CommissionLedger::where('user_id', $user->id)->sum('amount');
        $directEarned      = \App\Models\CommissionLedger::where('user_id', $user->id)->where('commission_type', 'direct')->sum('amount');
        $teamEarned        = \App\Models\CommissionLedger::where('user_id', $user->id)->where('commission_type', 'team')->sum('amount');

        // Network
        $directCount       = \App\Models\User::where('sponsor_id', $user->referral_code)->count();
        $activeDirectCount = \App\Models\User::where('sponsor_id', $user->referral_code)->where('status', 'active')->count();

        // Tokens
        $totalTokens  = \App\Models\TokenLedger::where('user_id', $user->id)->sum('token_count');
        $tokenName    = \App\Models\Setting::get('utility_token_name', 'SKT');
        $tokenPrice   = \App\Models\Setting::get('utility_token_value', 0.42);

        // Withdrawals
        $totalWithdrawn    = \App\Models\Withdrawal::where('user_id', $user->id)->where('status', 'approved')->sum('amount');
        $pendingWithdrawal = \App\Models\Withdrawal::where('user_id', $user->id)->where('status', 'pending')->sum('amount');

        // Recent activity
        $recentCommissions = \App\Models\CommissionLedger::where('user_id', $user->id)->latest()->take(5)->get();
        $recentReferrals   = \App\Models\User::where('sponsor_id', $user->referral_code)->latest()->take(5)->get();
        $recentWithdrawals = \App\Models\Withdrawal::where('user_id', $user->id)->latest()->take(5)->get();
        $recentTokens      = \App\Models\TokenLedger::where('user_id', $user->id)->latest()->take(5)->get();

        // Sponsor info
        $sponsor = $user->sponsor_id
            ? \App\Models\User::where('referral_code', $user->sponsor_id)->first()
            : null;

        // Course progress
        $courseProgress = \App\Models\CourseProgress::where('user_id', $user->id)->latest()->first();

        return view('user.profile.index', compact(
            'user', 'wallet',
            'totalEarned', 'directEarned', 'teamEarned',
            'directCount', 'activeDirectCount',
            'totalTokens', 'tokenName', 'tokenPrice',
            'totalWithdrawn', 'pendingWithdrawal',
            'recentCommissions', 'recentReferrals', 'recentWithdrawals', 'recentTokens',
            'sponsor', 'courseProgress'
        ));
    }

    public function idCard()
    {
        $user = Auth::user();
        if ($user->status !== 'active') {
            return redirect()->route('dashboard')->with('error', 'You must activate your account to generate an ID card.');
        }
        return view('user.id-card', compact('user'));
    }
}
