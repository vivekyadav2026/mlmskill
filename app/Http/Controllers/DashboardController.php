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
        $directCount = \App\Models\User::where('sponsor_id', $user->referral_code)->where('status', 'active')->count();
        
        // Calculate real downline network count (up to 10 levels deep)
        $levelCounts = [];
        $currentLevelSponsorCodes = [$user->referral_code];
        for ($level = 1; $level <= 10; $level++) {
            if (empty($currentLevelSponsorCodes)) {
                $levelCounts[$level] = 0;
                continue;
            }
            $nextLevelUsers = \App\Models\User::whereIn('sponsor_id', $currentLevelSponsorCodes)->get();
            $nextLevelSponsorCodes = $nextLevelUsers->pluck('referral_code')
                ->filter()
                ->toArray();
            $levelCounts[$level] = $nextLevelUsers->where('status', 'active')->count();
            $currentLevelSponsorCodes = $nextLevelSponsorCodes;
        }
        $networkCount = array_sum($levelCounts);
            
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
        $earningsTrend = array_fill(0, 7, 0);
        $tokenTrend = array_fill(0, 7, 0);
        $trendLabels = [];
        
        $startDate = \Carbon\Carbon::today()->subDays(6);
        
        for ($i = 6; $i >= 0; $i--) {
            $trendLabels[] = \Carbon\Carbon::today()->subDays($i)->format('M d');
        }

        $commissions = \App\Models\CommissionLedger::where('user_id', $user->id)
            ->where('created_at', '>=', $startDate)
            ->selectRaw('DATE(created_at) as date, sum(amount) as total')
            ->groupBy('date')
            ->pluck('total', 'date')->toArray();

        $tokens = \App\Models\TokenLedger::where('user_id', $user->id)
            ->whereIn('status', ['credited', 'locked'])
            ->where('created_at', '>=', $startDate)
            ->selectRaw('DATE(created_at) as date, sum(token_count) as total')
            ->groupBy('date')
            ->pluck('total', 'date')->toArray();

        foreach ($trendLabels as $index => $label) {
            $dateStr = \Carbon\Carbon::today()->subDays(6 - $index)->format('Y-m-d');
            $earningsTrend[$index] = round($commissions[$dateStr] ?? 0, 2);
            $tokenTrend[$index] = round($tokens[$dateStr] ?? 0, 2);
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
        
        // Fetch Bonus Progress
        $bonusService = app(\App\Services\BonusService::class);
        $rewardProgress = $bonusService->getNextRewardMilestone($user);
        $salaryStatus   = $bonusService->getCurrentSalaryTier($user);
        $currentRank    = $bonusService->getCurrentRank($user);
        // Dynamic Token Settings
        $tokenPrice = \App\Models\Setting::get('utility_token_value', 0.42);
        $tokenName = \App\Models\Setting::get('utility_token_name', 'SKT');
        $renewalTarget = \App\Models\Setting::get('renewal_limit', 300); // Assuming 300 is the default renewal limit
        
        return view('dashboard', compact(
            'user', 'wallet', 'totalEarned', 'directCount', 'networkCount',
            'recentIncome', 'recentReferrals', 'recentWithdrawals', 'recentTokens',
            'banners', 'announcements',
            'trendLabels', 'earningsTrend', 'tokenTrend', 'breakdownLabels', 'breakdownData',
            'rewardProgress', 'salaryStatus', 'currentRank',
            'tokenPrice', 'tokenName', 'renewalTarget'
        ));
    }

    public function userView($section, $subsection = null)
    {
        if ($section === 'index' && !$subsection) {
            return redirect()->route('dashboard');
        }

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
