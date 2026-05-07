<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommissionLedger;
use App\Models\TokenLedger;
use App\Models\User;
use App\Models\Withdrawal;

class AdminReportController extends Controller
{
    public function income() {
        $commissions = CommissionLedger::with(['user', 'fromUser'])->latest()->paginate(20);
        $totalIncome = CommissionLedger::sum('amount');
        return view('admin.reports.income', compact('commissions', 'totalIncome'));
    }

    public function token() {
        $tokens = TokenLedger::with('user')->latest()->paginate(20);
        $totalUtility = TokenLedger::where('token_type', 'utility')->sum('token_count');
        $totalRenewal = TokenLedger::where('token_type', 'renewal')->sum('token_count');
        return view('admin.reports.token', compact('tokens', 'totalUtility', 'totalRenewal'));
    }

    public function user() {
        $users = User::with('wallet')->latest()->paginate(20);
        $totalActive = User::where('status', 'active')->count();
        $totalInactive = User::where('status', 'inactive')->count();
        return view('admin.reports.user', compact('users', 'totalActive', 'totalInactive'));
    }

    public function financial() {
        $withdrawals = Withdrawal::with('user')->latest()->paginate(20);
        $totalPaid = Withdrawal::where('status', 'approved')->sum('amount');
        $totalPending = Withdrawal::where('status', 'pending')->sum('amount');
        return view('admin.reports.financial', compact('withdrawals', 'totalPaid', 'totalPending'));
    }
}
