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
        $renewalBalance = $user->wallet->renewal_token_wallet ?? 0;
        $activationDate = $user->activation_date ? \Carbon\Carbon::parse($user->activation_date) : null;
        $daysSinceActivation = $activationDate ? (int) $activationDate->diffInDays(now()) : 0;
        
        $utilityValue = (float) \App\Models\Setting::get('utility_token_value', 0.10); // Default 10 cents
        $renewalValue = (float) \App\Models\Setting::get('renewal_token_value', 0.50);

        return view('user.token.conversion', compact('user', 'balance', 'renewalBalance', 'daysSinceActivation', 'utilityValue', 'renewalValue'));
    }

    public function processConversion(Request $request)
    {
        $request->validate([
            'token_type' => 'required|in:utility,renewal',
            'amount' => 'required|integer|min:1'
        ]);

        $user = Auth::user();
        $wallet = $user->wallet;
        $amount = (int) $request->amount;

        if ($request->token_type === 'utility') {
            if (!$wallet || $wallet->utility_token_wallet < $amount) {
                return back()->with('error', 'Insufficient NEXA 1.0s.');
            }
            if ($amount < 50) {
                return back()->with('error', 'Minimum conversion for NEXA 1.0 is 50.');
            }

            $tokenValue = (float) \App\Models\Setting::get('utility_token_value', 0.10);
            $creditAmount = $amount * $tokenValue;

            \Illuminate\Support\Facades\DB::transaction(function () use ($wallet, $user, $amount, $creditAmount, $tokenValue) {
                $wallet->utility_token_wallet -= $amount;
                $wallet->package_wallet += $creditAmount;
                $wallet->save();

                \App\Models\TokenLedger::create([
                    'user_id' => $user->id,
                    'token_type' => 'utility',
                    'token_count' => -$amount,
                    'token_value' => $tokenValue,
                    'source' => 'conversion',
                    'status' => 'used',
                    'used_date' => now()
                ]);
            });

            return back()->with('success', "Successfully converted {$amount} NEXA 1.0s to $" . number_format($creditAmount, 2) . " in Package Wallet.");
        }

        if ($request->token_type === 'renewal') {
            $activationDate = $user->activation_date ? \Carbon\Carbon::parse($user->activation_date) : null;
            $daysSinceActivation = $activationDate ? (int) $activationDate->diffInDays(now()) : 0;

            if ($daysSinceActivation < 300) {
                return back()->with('error', 'NEXA 2.0s can only be converted after 300 days of activation.');
            }
            if (!$wallet || $wallet->renewal_token_wallet < $amount) {
                return back()->with('error', 'Insufficient NEXA 2.0s.');
            }

            $tokenValue = (float) \App\Models\Setting::get('renewal_token_value', 0.50);
            $creditAmount = $amount * $tokenValue;

            \Illuminate\Support\Facades\DB::transaction(function () use ($wallet, $user, $amount, $creditAmount, $tokenValue) {
                $wallet->renewal_token_wallet -= $amount;
                $wallet->package_wallet += $creditAmount;
                $wallet->save();

                \App\Models\TokenLedger::create([
                    'user_id' => $user->id,
                    'token_type' => 'renewal',
                    'token_count' => -$amount,
                    'token_value' => $tokenValue,
                    'source' => 'conversion',
                    'status' => 'used',
                    'used_date' => now()
                ]);
            });

            return back()->with('success', "Successfully converted {$amount} NEXA 2.0s to $" . number_format($creditAmount, 2) . " in Package Wallet.");
        }

        return back()->with('error', 'Invalid token type.');
    }
}
