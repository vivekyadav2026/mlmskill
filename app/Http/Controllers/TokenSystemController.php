<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TokenLedger;

class TokenSystemController extends Controller
{
    public function history()
    {
        $user = Auth::user();
        $history = TokenLedger::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
            
        return view('user.token.history', compact('history'));
    }

    public function utility()
    {
        // Handled by WalletController, redirect or show dedicated page
        return app(WalletController::class)->utility();
    }

    public function renewal()
    {
        return app(WalletController::class)->renewal();
    }

    public function conversion()
    {
        $user = Auth::user();
        $balance = $user->wallet->utility_token_wallet ?? 0;
        return view('user.token.conversion', compact('user', 'balance'));
    }
}
