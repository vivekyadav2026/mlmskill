<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CommissionLedger;
use App\Models\TokenLedger;
use App\Models\Withdrawal;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function income()
    {
        $user = Auth::user();
        
        $totalEarned = CommissionLedger::where('user_id', $user->id)->sum('amount');
        $directEarned = CommissionLedger::where('user_id', $user->id)->where('commission_type', 'direct')->sum('amount');
        $teamEarned = CommissionLedger::where('user_id', $user->id)->whereIn('commission_type', ['level', 'team'])->sum('amount');
        $bonusEarned = CommissionLedger::where('user_id', $user->id)->whereIn('commission_type', ['reward_income', 'salary_bonus'])->sum('amount');
        
        $reports = CommissionLedger::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(15);
        
        return view('user.reports.income', compact('user', 'reports', 'totalEarned', 'directEarned', 'teamEarned', 'bonusEarned'));
    }

    public function token()
    {
        $user = Auth::user();
        $tokenName = Setting::get('utility_token_name', 'SKT');
        
        $totalUtility = TokenLedger::where('user_id', $user->id)->where('token_type', 'utility')->whereIn('status', ['credited', 'locked'])->sum('token_count');
        $totalRenewal = TokenLedger::where('user_id', $user->id)->where('token_type', 'renewal')->whereIn('status', ['credited', 'locked'])->sum('token_count');
        $totalNexa3 = TokenLedger::where('user_id', $user->id)->where('token_type', 'nexa_3')->whereIn('status', ['credited', 'locked'])->sum('token_count');
        
        $reports = TokenLedger::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(15);
        
        return view('user.reports.token', compact('user', 'reports', 'tokenName', 'totalUtility', 'totalRenewal', 'totalNexa3'));
    }

    public function transaction()
    {
        $user = Auth::user();
        
        $totalWithdrawn = Withdrawal::where('user_id', $user->id)->where('status', 'approved')->sum('amount');
        $pendingWithdrawn = Withdrawal::where('user_id', $user->id)->where('status', 'pending')->sum('amount');
        
        $reports = Withdrawal::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(15);
        
        return view('user.reports.transaction', compact('user', 'reports', 'totalWithdrawn', 'pendingWithdrawn'));
    }
}