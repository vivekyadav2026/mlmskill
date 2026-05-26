<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CommissionLedger;

class AdminCommissionController extends Controller
{
    public function direct() {
        $logs = CommissionLedger::with(['user', 'fromUser'])
                    ->where('commission_type', 'direct')
                    ->latest()
                    ->paginate(50);
        return view('admin.commissions.direct', compact('logs'));
    }

    public function level() {
        $logs = CommissionLedger::with(['user', 'fromUser'])
                    ->whereIn('commission_type', ['level', 'team'])
                    ->latest()
                    ->paginate(50);
        return view('admin.commissions.level', compact('logs'));
    }

    public function salary() {
        $query = CommissionLedger::with(['user', 'fromUser'])
                    ->where('commission_type', 'salary_bonus')
                    ->latest();

        $totalCredit = (clone $query)->where('amount', '>', 0)->sum('amount');
        $totalDebit  = (clone $query)->where('amount', '<', 0)->sum('amount');
        $logs        = $query->paginate(50);

        return view('admin.commissions.salary', compact('logs', 'totalCredit', 'totalDebit'));
    }

    // public function settings() { return view('admin.commissions.settings'); }
}