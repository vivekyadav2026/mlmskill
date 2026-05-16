<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\LoanScheme;
use App\Models\LoanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoanController extends Controller
{
    public function index()
    {
        $schemes = LoanScheme::where('status', 'active')->get();
        return view('user.loans.index', compact('schemes'));
    }

    public function apply(Request $request, $id)
    {
        $scheme = LoanScheme::findOrFail($id);
        
        $request->validate([
            'amount' => 'required|numeric|min:'.$scheme->min_amount.'|max:'.$scheme->max_amount,
            'tenure_months' => 'required|integer|min:1|max:'.$scheme->max_tenure_months,
        ]);

        // Simple EMI calculation (Principal + (Principal * Rate * Years / 100)) / Total Months
        $principal = $request->amount;
        $rate = $scheme->interest_rate;
        $years = $request->tenure_months / 12;
        $totalInterest = ($principal * $rate * $years) / 100;
        $monthlyEmi = ($principal + $totalInterest) / $request->tenure_months;

        LoanRequest::create([
            'user_id' => Auth::id(),
            'loan_scheme_id' => $id,
            'amount' => $request->amount,
            'tenure_months' => $request->tenure_months,
            'monthly_emi' => $monthlyEmi,
            'status' => 'pending'
        ]);

        return redirect()->route('user.loans.history')->with('success', 'Loan request submitted successfully!');
    }

    public function history()
    {
        $loans = LoanRequest::with('scheme')->where('user_id', Auth::id())->latest()->get();
        return view('user.loans.history', compact('loans'));
    }
}
