<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonthlyClosing;
use App\Models\User;
use App\Models\CommissionLedger;
use App\Models\Withdrawal;
use App\Models\TokenLedger;
use Carbon\Carbon;

class AdminClosingController extends Controller
{
    public function history()
    {
        $closings = MonthlyClosing::orderBy('year', 'desc')->orderBy('month', 'desc')->paginate(20);
        return view('admin.closing.history', compact('closings'));
    }

    public function generate()
    {
        // Suggest current month and year
        $currentMonth = date('n');
        $currentYear = date('Y');
        
        // Calculate preview data for current month
        $startDate = Carbon::createFromDate($currentYear, $currentMonth, 1)->startOfMonth();
        $endDate = Carbon::createFromDate($currentYear, $currentMonth, 1)->endOfMonth();

        $preview = [
            'total_active_users' => User::where('status', 'active')->count(),
            'total_income_generated' => CommissionLedger::whereBetween('created_at', [$startDate, $endDate])->sum('amount'),
            'total_withdrawals' => Withdrawal::whereBetween('created_at', [$startDate, $endDate])->where('status', 'approved')->sum('amount'),
            'total_tokens_issued' => TokenLedger::whereBetween('created_at', [$startDate, $endDate])->where('status', 'credited')->sum('token_count')
        ];

        return view('admin.closing.generate', compact('currentMonth', 'currentYear', 'preview'));
    }

    public function reports()
    {
        $closings = MonthlyClosing::orderBy('year', 'desc')->orderBy('month', 'desc')->get();
        return view('admin.closing.reports', compact('closings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2000|max:2100',
        ]);

        $month = $request->month;
        $year = $request->year;

        // Check if already closed
        $exists = MonthlyClosing::where('month', $month)->where('year', $year)->first();
        if ($exists) {
            return back()->with('error', 'Closing for this month and year has already been processed.');
        }

        $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth();

        $activeUsers = User::where('status', 'active')->count();
        $income = CommissionLedger::whereBetween('created_at', [$startDate, $endDate])->sum('amount');
        $withdrawals = Withdrawal::whereBetween('created_at', [$startDate, $endDate])->where('status', 'approved')->sum('amount');
        $tokens = TokenLedger::whereBetween('created_at', [$startDate, $endDate])->where('status', 'credited')->sum('token_count');

        $reportJson = [
            'processed_at' => now()->toDateTimeString(),
            'processed_by' => auth()->user()->id,
            'notes' => $request->notes ?? 'Automated monthly closing.'
        ];

        MonthlyClosing::create([
            'month' => $month,
            'year' => $year,
            'total_active_users' => $activeUsers,
            'total_income_generated' => $income,
            'total_withdrawals' => $withdrawals,
            'total_tokens_issued' => $tokens,
            'report_json' => $reportJson
        ]);

        return redirect()->route('admin.closing.history')->with('success', 'Monthly closing processed successfully.');
    }
}
