<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CommissionLedger;

class AdminCommissionController extends Controller
{
    public function direct(Request $request) {
        $query = CommissionLedger::with(['user', 'fromUser'])
                    ->where('commission_type', 'direct')
                    ->latest();
                    
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }
        
        $logs = $query->paginate(50)->appends($request->all());
        
        return view('admin.commissions.direct', compact('logs'));
    }

    public function level(Request $request) {
        $query = CommissionLedger::with(['user', 'fromUser'])
                    ->whereIn('commission_type', ['level', 'team'])
                    ->latest();
                    
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }
        
        $logs = $query->paginate(50)->appends($request->all());
        
        return view('admin.commissions.level', compact('logs'));
    }

    public function salary(Request $request) {
        $query = CommissionLedger::with(['user', 'fromUser'])
                    ->where('commission_type', 'salary_bonus')
                    ->latest();

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $totalCredit = (clone $query)->where('amount', '>', 0)->sum('amount');
        $totalDebit  = (clone $query)->where('amount', '<', 0)->sum('amount');
        
        $logs = $query->paginate(50)->appends($request->all());

        return view('admin.commissions.salary', compact('logs', 'totalCredit', 'totalDebit'));
    }
}