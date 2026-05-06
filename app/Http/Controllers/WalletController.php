<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    public function income()
    {
        $user = Auth::user();
        $balance = $user->wallet->income_wallet ?? 0;
        
        // Fetch commission history for this wallet
        $history = DB::table('commission_ledgers')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('user.wallets.income', compact('balance', 'history'));
    }

    public function package()
    {
        $user = Auth::user();
        $balance = $user->wallet->package_wallet ?? 0;
        
        return view('user.wallets.package', compact('balance'));
    }

    public function utility()
    {
        $user = Auth::user();
        $balance = $user->wallet->utility_token_wallet ?? 0;
        
        $history = DB::table('token_ledgers')
            ->where('user_id', $user->id)
            ->where('token_type', 'utility')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('user.wallets.utility', compact('balance', 'history'));
    }

    public function renewal()
    {
        $user = Auth::user();
        $balance = $user->wallet->renewal_token_wallet ?? 0;
        
        $history = DB::table('token_ledgers')
            ->where('user_id', $user->id)
            ->where('token_type', 'renewal')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('user.wallets.renewal', compact('balance', 'history'));
    }

    public function history()
    {
        $user = Auth::user();
        
        // Combine all wallet transactions into one view
        // In a real scenario, this might query a consolidated transactions table.
        // For now, we fetch from tokens, commissions, withdrawals
        
        return view('user.wallets.history', compact('user'));
    }
}
