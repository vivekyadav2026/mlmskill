<?php

namespace App\Services;

use App\Models\User;
use App\Models\CommissionLedger;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

class CommissionService
{
    private array $levelCommissionPercentages = [
        1 => 15.00, // 15%
        2 => 10.00, // 10%
        3 => 6.00,  // 6%
        4 => 3.00,  // 3%
        5 => 2.00,  // 2%
        6 => 0.50,  // 0.5%
        7 => 0.50,
        8 => 0.50,
        9 => 0.50,
        10 => 0.50,
    ];

    /**
     * Distribute referral commissions when a user activates / buys a course.
     */
    public function distributeCommissions(User $activatedUser, float $amountSpent = 300.00)
    {
        DB::transaction(function () use ($activatedUser, $amountSpent) {
            $currentUser = $activatedUser;
            
            for ($level = 1; $level <= 10; $level++) {
                if (!$currentUser->sponsor_id) {
                    break; // No more uplines
                }

                $maxLevels = \App\Models\Setting::get('max_levels', 10);
                if ($level > $maxLevels) {
                    break;
                }

                $sponsor = User::where('referral_code', $currentUser->sponsor_id)->first();
                if (!$sponsor) {
                    break;
                }

                // Only active users earn commission
                if ($sponsor->status === 'active') {
                    $defaultPercentages = [
                        1 => 15.00, 2 => 10.00, 3 => 6.00, 4 => 3.00, 5 => 2.00,
                        6 => 0.50, 7 => 0.50, 8 => 0.50, 9 => 0.50, 10 => 0.50
                    ];
                    $percentage = (float)\App\Models\Setting::get('level_'.$level.'_pct', $defaultPercentages[$level] ?? 0);
                    
                    if ($percentage > 0) {
                        $amount = ($percentage / 100) * $amountSpent;
                        $type = $level === 1 ? 'direct' : 'team';

                    // Log commission
                    CommissionLedger::create([
                        'user_id' => $sponsor->id,
                        'from_user_id' => $activatedUser->id,
                        'level' => $level,
                        'amount' => $amount,
                        'commission_type' => $type,
                        'status' => 'credited',
                    ]);

                    // Add to wallet
                    $wallet = Wallet::firstOrCreate(['user_id' => $sponsor->id]);
                    $wallet->increment('income_wallet', $amount);
                    }
                }

                // Move up the tree
                $currentUser = $sponsor;
            }
        });
    }
}
