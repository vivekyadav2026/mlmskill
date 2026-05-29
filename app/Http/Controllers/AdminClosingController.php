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

    public function generate(Request $request)
    {
        $startDateInput = $request->input('start_date');
        $endDateInput = $request->input('end_date');

        if ($startDateInput && $endDateInput) {
            $startDate = Carbon::parse($startDateInput)->startOfDay();
            $endDate = Carbon::parse($endDateInput)->endOfDay();
            $currentMonth = Carbon::parse($endDateInput)->month;
            $currentYear = Carbon::parse($endDateInput)->year;
        } else {
            $currentMonth = (int) date('n');
            $currentYear = (int) date('Y');
            $startDate = Carbon::createFromDate($currentYear, $currentMonth, 1)->startOfMonth();
            $endDate = Carbon::createFromDate($currentYear, $currentMonth, 1)->endOfMonth();
            $startDateInput = $startDate->format('Y-m-d');
            $endDateInput = $endDate->format('Y-m-d');
        }

        $preview = [
            'total_active_users' => User::where('status', 'active')->count(),
            'total_income_generated' => CommissionLedger::whereBetween('created_at', [$startDate, $endDate])->sum('amount'),
            'total_withdrawals' => Withdrawal::whereBetween('created_at', [$startDate, $endDate])->where('status', 'approved')->sum('amount'),
            'total_tokens_issued' => TokenLedger::whereBetween('created_at', [$startDate, $endDate])->whereIn('status', ['credited', 'locked'])->sum('token_count')
        ];

        return view('admin.closing.generate', compact('currentMonth', 'currentYear', 'startDateInput', 'endDateInput', 'preview'));
    }

    public function reports()
    {
        $closings = MonthlyClosing::orderBy('year', 'desc')->orderBy('month', 'desc')->get();
        
        $lifetimeIncome = CommissionLedger::sum('amount');
        $lifetimeWithdrawals = Withdrawal::where('status', 'approved')->sum('amount');
        $lifetimeTokens = TokenLedger::whereIn('status', ['credited', 'locked'])->sum('token_count');

        // Prepare chart data (reverse so oldest is first, up to last 6 closings)
        $chartClosings = $closings->take(6)->reverse();
        $chartLabels = [];
        $chartIncome = [];
        $chartWithdrawals = [];
        
        foreach ($chartClosings as $c) {
            $report = $c->report_json;
            if (isset($report['start_date']) && isset($report['end_date'])) {
                $startDateFormatted = Carbon::parse($report['start_date'])->format('d/m');
                $endDateFormatted = Carbon::parse($report['end_date'])->format('d/m');
                $chartLabels[] = $startDateFormatted . '-' . $endDateFormatted;
            } else {
                $chartLabels[] = date('M Y', mktime(0, 0, 0, $c->month, 10, $c->year));
            }
            $chartIncome[] = (float) $c->total_income_generated;
            $chartWithdrawals[] = (float) $c->total_withdrawals;
        }

        return view('admin.closing.reports', compact('closings', 'chartLabels', 'chartIncome', 'chartWithdrawals', 'lifetimeIncome', 'lifetimeWithdrawals', 'lifetimeTokens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();
        
        // Automatically derive display month and year from the end date
        $month = $endDate->month;
        $year = $endDate->year;

        // Check if a closing for the exact same start_date and end_date has already been processed
        $exists = MonthlyClosing::where('month', $month)
            ->where('year', $year)
            ->get()
            ->first(function ($closing) use ($startDate, $endDate) {
                $report = $closing->report_json;
                return isset($report['start_date']) && isset($report['end_date']) &&
                       $report['start_date'] === $startDate->toDateString() &&
                       $report['end_date'] === $endDate->toDateString();
            });

        if ($exists) {
            return back()->with('error', 'Closing for this specific date range has already been processed.');
        }

        $activeUsers = User::where('status', 'active')->count();
        $income = CommissionLedger::whereBetween('created_at', [$startDate, $endDate])->sum('amount');
        $withdrawals = Withdrawal::whereBetween('created_at', [$startDate, $endDate])->where('status', 'approved')->sum('amount');
        $tokens = TokenLedger::whereBetween('created_at', [$startDate, $endDate])->whereIn('status', ['credited', 'locked'])->sum('token_count');

        $reportJson = [
            'start_date' => $startDate->toDateString(),
            'end_date' => $endDate->toDateString(),
            'processed_at' => now()->toDateTimeString(),
            'processed_by' => auth()->user()->id,
            'notes' => $request->notes ?? 'Automated custom date closing.'
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
