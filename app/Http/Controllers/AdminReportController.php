<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommissionLedger;
use App\Models\TokenLedger;
use App\Models\User;
use App\Models\Withdrawal;
use Carbon\Carbon;

class AdminReportController extends Controller
{
    public function income()
    {
        $commissions     = CommissionLedger::with(['user', 'fromUser'])->latest()->paginate(25);
        $totalIncome     = CommissionLedger::sum('amount');
        $directTotal     = CommissionLedger::where('commission_type', 'direct')->sum('amount');
        $levelTotal      = CommissionLedger::where('commission_type', 'level')->sum('amount');
        $totalEntries    = CommissionLedger::count();
        $uniqueEarners   = CommissionLedger::distinct('user_id')->count('user_id');

        // Monthly breakdown (last 6 months)
        $monthlyLabels = [];
        $monthlyData   = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthlyLabels[] = $month->format('M Y');
            $monthlyData[]   = (float) CommissionLedger::whereYear('created_at', $month->year)
                                    ->whereMonth('created_at', $month->month)
                                    ->sum('amount');
        }

        return view('admin.reports.income', compact(
            'commissions', 'totalIncome', 'directTotal', 'levelTotal',
            'totalEntries', 'uniqueEarners', 'monthlyLabels', 'monthlyData'
        ));
    }

    public function token()
    {
        $tokens        = TokenLedger::with('user')->latest()->paginate(25);
        $totalUtility  = TokenLedger::where('token_type', 'utility')->sum('token_count');
        $totalRenewal  = TokenLedger::where('token_type', 'renewal')->sum('token_count');
        $totalEntries  = TokenLedger::count();
        $uniqueHolders = TokenLedger::distinct('user_id')->count('user_id');
        $totalCredited = TokenLedger::where('status', 'credited')->count();
        $totalUsed     = TokenLedger::where('status', 'used')->count();

        // Monthly token distribution (last 6 months)
        $monthlyLabels   = [];
        $utilityMonthly  = [];
        $renewalMonthly  = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthlyLabels[]  = $month->format('M Y');
            $utilityMonthly[] = (float) TokenLedger::where('token_type', 'utility')
                                    ->whereYear('created_at', $month->year)
                                    ->whereMonth('created_at', $month->month)
                                    ->sum('token_count');
            $renewalMonthly[] = (float) TokenLedger::where('token_type', 'renewal')
                                    ->whereYear('created_at', $month->year)
                                    ->whereMonth('created_at', $month->month)
                                    ->sum('token_count');
        }

        return view('admin.reports.token', compact(
            'tokens', 'totalUtility', 'totalRenewal', 'totalEntries',
            'uniqueHolders', 'totalCredited', 'totalUsed',
            'monthlyLabels', 'utilityMonthly', 'renewalMonthly'
        ));
    }

    public function user()
    {
        $users         = User::with('wallet')->latest()->paginate(25);
        $totalActive   = User::where('status', 'active')->count();
        $totalInactive = User::where('status', 'inactive')->count();
        return view('admin.reports.user', compact('users', 'totalActive', 'totalInactive'));
    }

    public function financial()
    {
        $withdrawals    = Withdrawal::with(['user', 'approver'])->latest()->paginate(25);
        $totalPaid      = Withdrawal::where('status', 'approved')->sum('amount');
        $totalPending   = Withdrawal::where('status', 'pending')->sum('amount');
        $totalRejected  = Withdrawal::where('status', 'rejected')->sum('amount');
        $countPending   = Withdrawal::where('status', 'pending')->count();
        $countApproved  = Withdrawal::where('status', 'approved')->count();
        $countRejected  = Withdrawal::where('status', 'rejected')->count();

        // Monthly withdrawal trend (last 6 months)
        $monthlyLabels = [];
        $monthlyPaid   = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthlyLabels[] = $month->format('M Y');
            $monthlyPaid[]   = (float) Withdrawal::where('status', 'approved')
                                    ->whereYear('created_at', $month->year)
                                    ->whereMonth('created_at', $month->month)
                                    ->sum('amount');
        }

        return view('admin.reports.financial', compact(
            'withdrawals', 'totalPaid', 'totalPending', 'totalRejected',
            'countPending', 'countApproved', 'countRejected',
            'monthlyLabels', 'monthlyPaid'
        ));
    }
}
