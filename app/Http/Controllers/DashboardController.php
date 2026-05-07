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
            ->whereIn('commission_type', ['direct', 'team'])
            ->distinct('from_user_id')
            ->count();
            
        // Recent records
        $recentIncome = \App\Models\CommissionLedger::where('user_id', $user->id)->latest()->take(4)->get();
        $recentReferrals = \App\Models\User::where('sponsor_id', $user->referral_code)->latest()->take(4)->get();
        $recentWithdrawals = \App\Models\Withdrawal::where('user_id', $user->id)->latest()->take(4)->get();
        $recentTokens = \App\Models\TokenLedger::where('user_id', $user->id)->latest()->take(4)->get();
        
        // CMS Content
        $banners = \App\Models\Banner::where('status', 'active')->latest()->get();
        $announcements = \App\Models\Announcement::where('status', 'active')->latest()->get();
        
        // --- Chart Data ---
        // 1. Earnings Trend (Last 7 Days)
        $earningsTrend = [];
        $trendLabels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = \Carbon\Carbon::today()->subDays($i);
            $trendLabels[] = $date->format('M d');
            $sum = \App\Models\CommissionLedger::where('user_id', $user->id)
                ->whereDate('created_at', $date)
                ->sum('amount');
            $earningsTrend[] = round($sum, 2);
        }
        
        // 2. Income Breakdown
        $incomeBreakdown = \App\Models\CommissionLedger::where('user_id', $user->id)
            ->selectRaw('commission_type, sum(amount) as total')
            ->groupBy('commission_type')
            ->pluck('total', 'commission_type')->toArray();
            
        $breakdownLabels = array_map('ucfirst', array_keys($incomeBreakdown));
        $breakdownData = array_values($incomeBreakdown);
        // Fallback if empty
        if (empty($breakdownData)) {
            $breakdownLabels = ['No Data'];
            $breakdownData = [0];
        }
        
        return view('dashboard', compact(
            'user', 'wallet', 'totalEarned', 'directCount', 'networkCount',
            'recentIncome', 'recentReferrals', 'recentWithdrawals', 'recentTokens',
            'banners', 'announcements',
            'trendLabels', 'earningsTrend', 'breakdownLabels', 'breakdownData'
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
