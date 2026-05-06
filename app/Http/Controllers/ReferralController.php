<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ReferralController extends Controller
{
    public function link()
    {
        $user = Auth::user();
        $referralLink = url('register?ref=' . $user->referral_code);
        return view('user.referral.link', compact('user', 'referralLink'));
    }

    public function invite()
    {
        $user = Auth::user();
        $referralLink = url('register?ref=' . $user->referral_code);
        return view('user.referral.invite', compact('user', 'referralLink'));
    }

    public function history()
    {
        $user = Auth::user();
        $referrals = User::where('sponsor_id', $user->referral_code)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('user.referral.history', compact('user', 'referrals'));
    }
}
