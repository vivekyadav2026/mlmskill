<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $wallet = $user->wallet;
        
        $totalEarned = \App\Models\CommissionLedger::where('user_id', $user->id)->sum('amount');
        $directCount = \App\Models\User::where('sponsor_id', $user->referral_code)->count();
        $networkCount = \Illuminate\Support\Facades\DB::table('commission_ledgers')
            ->where('user_id', $user->id)
            ->where('commission_type', 'level')
            ->distinct('from_user_id')
            ->count();
            
        // Recent records
        $recentIncome = \App\Models\CommissionLedger::where('user_id', $user->id)->latest()->take(4)->get();
        $recentReferrals = \App\Models\User::where('sponsor_id', $user->referral_code)->latest()->take(4)->get();
        $recentWithdrawals = \App\Models\Withdrawal::where('user_id', $user->id)->latest()->take(4)->get();
        $recentTokens = \App\Models\TokenLedger::where('user_id', $user->id)->latest()->take(4)->get();
        
        return view('dashboard', compact(
            'user', 'wallet', 'totalEarned', 'directCount', 'networkCount',
            'recentIncome', 'recentReferrals', 'recentWithdrawals', 'recentTokens'
        ));
    }

    public function userView($section, $subsection = null)
    {
        $title = ucfirst($section) . ($subsection ? ' - ' . ucfirst($subsection) : '');
        $path = $subsection ? "{$section} / {$subsection}" : $section;
        $user = Auth::user();
        
        $viewPath = $subsection ? "user.{$section}.{$subsection}" : "user.{$section}";
        if (view()->exists($viewPath)) {
            return view($viewPath, compact('title', 'path', 'user'));
        }
        
        return view('user.placeholder', compact('title', 'path', 'user'));
    }
}
