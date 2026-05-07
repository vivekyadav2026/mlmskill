<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class NetworkController extends Controller
{
    public function direct()
    {
        $user = Auth::user();
        // Get all users who have this user as a sponsor
        $referrals = User::where('sponsor_id', $user->referral_code)->get();
        
        return view('user.network.direct', compact('user', 'referrals'));
    }

    public function tree()
    {
        $user = Auth::user();
        
        // We will pass the user to the view, and the view will recursively load the tree or use a recursive function.
        // For demonstration, we load the first 3 levels eagerly
        $user->load('referrals.referrals.referrals');
        
        return view('user.network.tree', compact('user'));
    }
    
    public function sponsor()
    {
        $user = Auth::user();
        $sponsor = User::where('referral_code', $user->sponsor_id)->first();
        
        return view('user.network.sponsor', compact('user', 'sponsor'));
    }

    public function level()
    {
        $user = Auth::user();
        
        // Use query builder to calculate total, monthly, and list history
        // Assuming we have a 'commission_ledgers' table with 'from_user_id', 'level', 'amount', etc.
        $totalLevelIncome = \Illuminate\Support\Facades\DB::table('commission_ledgers')
            ->where('user_id', $user->id)
            ->where('commission_type', 'team')
            ->sum('amount');
            
        $monthlyLevelIncome = \Illuminate\Support\Facades\DB::table('commission_ledgers')
            ->where('user_id', $user->id)
            ->where('commission_type', 'team')
            ->whereMonth('created_at', now()->month)
            ->sum('amount');
            
        $networkCount = \Illuminate\Support\Facades\DB::table('commission_ledgers')
            ->where('user_id', $user->id)
            ->whereIn('commission_type', ['direct', 'team'])
            ->distinct('from_user_id')
            ->count();
        
        // In reality, fromUser relation requires Eloquent. Since we just need the list:
        $history = \App\Models\User::find($user->id)->commissions()
            ->where('commission_type', 'team')
            ->with('fromUser')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('user.network.level', compact('totalLevelIncome', 'monthlyLevelIncome', 'networkCount', 'history'));
    }
}
