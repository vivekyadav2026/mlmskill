<?php

namespace App\Services;

use App\Models\User;
use App\Models\CommissionLedger;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;

class CommissionService
{
    /**
     * Generation Income amounts per level (as per the MLM plan).
     */
    private array $levelCommissionAmounts = [
        1  => 20.00, // $20  — No direct condition
        2  => 10.00, // $10  — No direct condition
        3  =>  5.00, // $5   — Requires >= 2 active directs
        4  =>  3.00, // $3   — Requires >= 4 active directs
        5  =>  2.00, // $2   — Requires >= 6 active directs
        6  =>  1.00, // $1   — Requires >= 10 active directs
        7  =>  0.50, // $0.50 — Requires >= 10 active directs
        8  =>  0.50, // $0.50 — Requires >= 10 active directs
        9  =>  0.25, // $0.25 — Requires >= 10 active directs
        10 =>  0.25, // $0.25 — Requires >= 10 active directs
    ];

    /**
     * Minimum active direct referrals needed to unlock each level.
     * Levels not listed here have no direct condition.
     */
    private array $levelDirectRequirements = [
        3  => 2,
        4  => 4,
        5  => 6,
        6  => 10,
        7  => 10,
        8  => 10,
        9  => 10,
        10 => 10,
    ];

    /**
     * Distribute referral commissions when a user activates / buys a course.
     */
    public function distributeCommissions(User $activatedUser, float $amountSpent = 300.00)
    {
        DB::transaction(function () use ($activatedUser, $amountSpent) {
            $currentUser = $activatedUser;

            $maxLevels = (int) \App\Models\Setting::get('max_levels', 10);

            for ($level = 1; $level <= $maxLevels; $level++) {
                if (!$currentUser->sponsor_id) {
                    break; // No more uplines
                }

                $sponsor = User::where('referral_code', $currentUser->sponsor_id)->first();
                if (!$sponsor) {
                    break;
                }

                // Only active users earn commission
                if ($sponsor->status === 'active') {

                    // ── Direct ID Unlock Condition ──
                    // Some levels require the sponsor to have a minimum number
                    // of active direct referrals before they can earn from that level.
                    $requiredDirects = $this->levelDirectRequirements[$level] ?? 0;
                    if ($requiredDirects > 0) {
                        $sponsorDirectCount = User::where('sponsor_id', $sponsor->referral_code)
                            ->where('status', 'active')
                            ->count();
                        if ($sponsorDirectCount < $requiredDirects) {
                            // Condition not met — skip this level, continue up the tree
                            $currentUser = $sponsor;
                            continue;
                        }
                    }

                    // Use admin-configurable amount or fall back to plan defaults
                    $defaultAmounts = $this->levelCommissionAmounts;
                    $amount = (float) \App\Models\Setting::get('level_' . $level . '_amt', $defaultAmounts[$level] ?? 0);

                    if ($amount > 0) {
                        $type = $level === 1 ? 'direct' : 'team';

                        // Log commission
                        CommissionLedger::create([
                            'user_id'         => $sponsor->id,
                            'from_user_id'    => $activatedUser->id,
                            'level'           => $level,
                            'amount'          => $amount,
                            'commission_type' => $type,
                            'status'          => 'credited',
                        ]);

                        // Credit wallet
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
