<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommissionLedger;
use App\Models\TokenLedger;
use App\Models\User;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CommissionsExport;
use App\Exports\WithdrawalsExport;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminReportController extends Controller
{
    public function income()
    {
        $commissions     = CommissionLedger::with(['user', 'fromUser'])->latest()->paginate(25);
        $totalIncome     = CommissionLedger::sum('amount');
        $directTotal     = CommissionLedger::where('commission_type', 'direct')->sum('amount');
        $levelTotal      = CommissionLedger::whereIn('commission_type', ['level', 'team'])->sum('amount');
        $bonusTotal      = CommissionLedger::whereIn('commission_type', ['reward_income', 'salary_bonus'])->sum('amount');
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
            'commissions', 'totalIncome', 'directTotal', 'levelTotal', 'bonusTotal',
            'totalEntries', 'uniqueEarners', 'monthlyLabels', 'monthlyData'
        ));
    }

    public function token()
    {
        $tokens        = TokenLedger::with('user')->latest()->paginate(25);
        $totalUtility  = TokenLedger::where('token_type', 'utility')->whereIn('status', ['credited', 'locked'])->sum('token_count');
        $totalRenewal  = TokenLedger::where('token_type', 'renewal')->whereIn('status', ['credited', 'locked'])->sum('token_count');
        $totalNexa3    = TokenLedger::where('token_type', 'nexa_3')->whereIn('status', ['credited', 'locked'])->sum('token_count');
        $totalEntries  = TokenLedger::count();
        $uniqueHolders = TokenLedger::distinct('user_id')->count('user_id');
        $totalCredited = TokenLedger::whereIn('status', ['credited', 'locked'])->count();
        $totalUsed     = TokenLedger::where('status', 'used')->count();

        // Monthly token distribution (last 6 months)
        $monthlyLabels   = [];
        $utilityMonthly  = [];
        $renewalMonthly  = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthlyLabels[]  = $month->format('M Y');
            $utilityMonthly[] = (float) TokenLedger::where('token_type', 'utility')
                                    ->whereIn('status', ['credited', 'locked'])
                                    ->whereYear('created_at', $month->year)
                                    ->whereMonth('created_at', $month->month)
                                    ->sum('token_count');
            $renewalMonthly[] = (float) TokenLedger::where('token_type', 'renewal')
                                    ->whereIn('status', ['credited', 'locked'])
                                    ->whereYear('created_at', $month->year)
                                    ->whereMonth('created_at', $month->month)
                                    ->sum('token_count');
        }

        return view('admin.reports.token', compact(
            'tokens', 'totalUtility', 'totalRenewal', 'totalNexa3', 'totalEntries',
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

    public function exportIncomeExcel()
    {
        return Excel::download(new CommissionsExport, 'income_report_' . date('Y-m-d') . '.xlsx');
    }

    public function exportFinancialExcel()
    {
        return Excel::download(new WithdrawalsExport, 'withdrawal_report_' . date('Y-m-d') . '.xlsx');
    }

    public function exportIncomePDF()
    {
        try {
            $commissions = CommissionLedger::with(['user', 'fromUser'])->get();
            $pdf = Pdf::loadView('admin.exports.income', compact('commissions'))->setPaper('a4', 'landscape');
            return $pdf->download('income_report_' . date('Y-m-d') . '.pdf');
        } catch (\Exception $e) {
            \Log::error('Income PDF Export failed: ' . $e->getMessage());
            return back()->with('error', 'Income PDF Export failed: ' . $e->getMessage());
        }
    }

    public function exportFinancialPDF()
    {
        try {
            $withdrawals = Withdrawal::with('user')->get();
            $pdf = Pdf::loadView('admin.exports.withdrawals', compact('withdrawals'))->setPaper('a4', 'landscape');
            return $pdf->download('withdrawal_report_' . date('Y-m-d') . '.pdf');
        } catch (\Exception $e) {
            \Log::error('Financial PDF Export failed: ' . $e->getMessage());
            return back()->with('error', 'Financial PDF Export failed: ' . $e->getMessage());
        }
    }
}
