<?php

namespace App\Services;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\DB;
use Exception;

class WalletService
{
    public function convertUtilityTokensToPackage(User $user, int $tokenAmount)
    {
        return DB::transaction(function () use ($user, $tokenAmount) {
            $wallet = $user->wallet;
            
            if (!$wallet || $wallet->utility_token_wallet < $tokenAmount) {
                throw new Exception("Insufficient NEXA 1.0.");
            }


            // Calculate value
            $tokenValue = 0.125;
            if ($user->activation_date && $user->activation_date->diffInDays(now()) >= 365) {
                $tokenValue = 0.25;
            }
            $conversionValue = $tokenAmount * $tokenValue;

            // Update wallet
            $wallet->decrement('utility_token_wallet', $tokenAmount);
            $wallet->increment('package_wallet', $conversionValue);

            // Log ledger update if necessary...

            return true;
        });
    }

    public function requestWithdrawal(User $user, float $amount)
    {
        return DB::transaction(function () use ($user, $amount) {
            $wallet = $user->wallet;
            if (!$wallet || $wallet->income_wallet < $amount) {
                throw new Exception("Insufficient income wallet balance.");
            }

            // ── Calculate charge ──────────────────────────────────
            $chargePct    = (float) \App\Models\Setting::get('withdrawal_charge_pct', 10);
            $chargeAmount = round($amount * $chargePct / 100, 2);
            $netAmount    = round($amount - $chargeAmount, 2);

            // Deduct full requested amount from wallet
            $wallet->decrement('income_wallet', $amount);

            // Create withdrawal record with charge breakdown
            $withdrawal = Withdrawal::create([
                'user_id'       => $user->id,
                'amount'        => $amount,         // requested amount
                'charge_amount' => $chargeAmount,   // charge deducted
                'net_amount'    => $netAmount,       // user will receive this
                'wallet_type'   => 'income_wallet',
                'status'        => 'pending',
            ]);

            return $withdrawal;
        });
    }
}
