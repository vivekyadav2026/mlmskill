<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CommissionLedger;
use App\Models\TokenLedger;

class ReportController extends Controller
{
    public function income()
    {
        $user = Auth::user();
        $reports = CommissionLedger::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(15);
        return view('user.reports.income', compact('reports'));
    }

    public function token()
    {
        $user = Auth::user();
        $reports = TokenLedger::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(15);
        return view('user.reports.token', compact('reports'));
    }

    public function transaction()
    {
        return view('user.reports.transaction');
    }
}