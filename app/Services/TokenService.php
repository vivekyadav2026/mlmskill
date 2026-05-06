<?php

namespace App\Services;

use App\Models\User;
use App\Models\TokenLedger;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TokenService
{
    public function distributeDailyTokens()
    {
        $activeUsers = User::where('status', 'active')->get();

        foreach ($activeUsers as $user) {
            DB::transaction(function () use ($user) {
                // Calculate token value
                $tokenValue = 0.125;
                if ($user->activation_date && $user->activation_date->diffInDays(now()) >= 365) {
                    $tokenValue = 0.25;
                }

                // Credit Utility Token
                TokenLedger::create([
                    'user_id' => $user->id,
                    'token_type' => 'utility',
                    'token_count' => 1,
                    'token_value' => $tokenValue,
                    'source' => 'daily_reward',
                    'status' => 'credited',
                    'credited_date' => now(),
                ]);

                // Credit Renewal Token
                TokenLedger::create([
                    'user_id' => $user->id,
                    'token_type' => 'renewal',
                    'token_count' => 1,
                    'token_value' => 0, // Renewal token value context based
                    'source' => 'daily_reward',
                    'status' => 'locked',
                    'credited_date' => now(),
                ]);

                // Update Wallets
                $wallet = Wallet::firstOrCreate(['user_id' => $user->id]);
                $wallet->increment('utility_token_wallet', 1);
                $wallet->increment('renewal_token_wallet', 1);
            });
        }
    }
}
