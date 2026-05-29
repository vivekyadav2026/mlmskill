<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CommissionLedger;

class EarningController extends Controller
{
    public function direct()
    {
        $user = Auth::user();
        $earnings = CommissionLedger::where('user_id', $user->id)
            ->where('commission_type', 'direct')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        $totalDirect = $earnings->sum('amount');
        return view('user.earnings.direct', compact('earnings', 'totalDirect'));
    }

    public function team()
    {
        $user = Auth::user();
        $earnings = CommissionLedger::where('user_id', $user->id)
            ->where('commission_type', 'team')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        $totalTeam = $earnings->sum('amount');
        return view('user.earnings.team', compact('earnings', 'totalTeam'));
    }

    public function total()
    {
        $user = Auth::user();
        $earnings = CommissionLedger::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        $totalEarned = CommissionLedger::where('user_id', $user->id)->sum('amount');
        $directEarned = CommissionLedger::where('user_id', $user->id)->where('commission_type', 'direct')->sum('amount');
        $levelEarned = CommissionLedger::where('user_id', $user->id)->whereIn('commission_type', ['team', 'level'])->sum('amount');
        $bonusEarned = CommissionLedger::where('user_id', $user->id)->whereIn('commission_type', ['reward_income', 'salary_bonus'])->sum('amount');
        
        return view('user.earnings.total', compact('earnings', 'totalEarned', 'directEarned', 'levelEarned', 'bonusEarned'));
    }
}
