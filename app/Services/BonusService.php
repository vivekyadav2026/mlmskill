<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserBonus;
use App\Models\Wallet;
use App\Models\CommissionLedger;
use Illuminate\Support\Facades\DB;

class BonusService
{
    private array $rewardIncomeMilestones = [
        // Type => [MilestoneCount => Amount]
        'direct' => [
            5 => 25.00,
            10 => 50.00,
        ],
        'team' => [
            50 => 100.00,
            100 => 250.00,
            500 => 1250.00,
            1000 => 2500.00,
            2000 => 5000.00,
            5000 => 10000.00,
            10000 => 20000.00,
            25000 => 50000.00,
            50000 => 100000.00,
        ]
    ];

    private array $salaryBonusMilestones = [
        // Directs => MonthlyAmount
        500 => 100.00,
        200 => 50.00,
        100 => 25.00,
        50 => 15.00,
        20 => 5.00,
    ];

    /**
     * Called when a new user activates in the network.
     * This checks the sponsor and upline to see if they hit any Reward Income milestones.
     */
    public function checkAndDistributeRewardIncome(User $activatedUser)
    {
        // Go up the tree and check milestones
        $currentUser = clone $activatedUser;
        $maxLevels = 10; // We'll traverse up to 10 levels or until no sponsor

        for ($level = 1; $level <= $maxLevels; $level++) {
            if (!$currentUser->sponsor_id) {
                break;
            }

            $sponsor = User::where('referral_code', $currentUser->sponsor_id)->first();
            if (!$sponsor) {
                break;
            }

            if ($sponsor->status === 'active') {
                $this->evaluateUserRewardIncome($sponsor);
            }

            $currentUser = $sponsor;
        }
    }

    private function evaluateUserRewardIncome(User $user)
    {
        $directCount = User::where('sponsor_id', $user->referral_code)->where('status', 'active')->count();
        $teamSize = $this->calculateTotalTeamSize($user);

        DB::transaction(function () use ($user, $directCount, $teamSize) {
            // Check Directs Milestones
            foreach ($this->rewardIncomeMilestones['direct'] as $milestone => $amount) {
                if ($directCount >= $milestone) {
                    $milestoneKey = 'direct_' . $milestone;
                    $this->payoutRewardIncome($user, $milestoneKey, $amount);
                }
            }

            // Check Team Milestones
            foreach ($this->rewardIncomeMilestones['team'] as $milestone => $amount) {
                if ($teamSize >= $milestone) {
                    $milestoneKey = 'team_' . $milestone;
                    $this->payoutRewardIncome($user, $milestoneKey, $amount);
                }
            }
        });
    }

    private function payoutRewardIncome(User $user, string $milestoneKey, float $amount)
    {
        // Check if already paid
        $exists = UserBonus::where('user_id', $user->id)
            ->where('bonus_type', 'reward_income')
            ->where('milestone', $milestoneKey)
            ->exists();

        if (!$exists) {
            // Record the bonus
            UserBonus::create([
                'user_id' => $user->id,
                'bonus_type' => 'reward_income',
                'milestone' => $milestoneKey,
                'amount' => $amount,
                'month_count' => 1,
            ]);

            // Add to Wallet
            $wallet = Wallet::firstOrCreate(['user_id' => $user->id]);
            $wallet->increment('income_wallet', $amount);

            // Log Commission
            CommissionLedger::create([
                'user_id' => $user->id,
                'from_user_id' => $user->id, // Self generated bonus
                'level' => 0,
                'amount' => $amount,
                'commission_type' => 'reward_income',
                'status' => 'credited',
            ]);
        }
    }

    /**
     * Recursively calculate team size (up to 10 levels).
     */
    public function calculateTotalTeamSize(User $user): int
    {
        $totalTeam = 0;
        $currentLevelSponsorCodes = [$user->referral_code];

        for ($level = 1; $level <= 10; $level++) {
            if (empty($currentLevelSponsorCodes)) {
                break;
            }

            $nextLevelUsers = User::whereIn('sponsor_id', $currentLevelSponsorCodes)
                ->where('status', 'active')
                ->get();

            $totalTeam += $nextLevelUsers->count();
            $currentLevelSponsorCodes = $nextLevelUsers->pluck('referral_code')->filter()->toArray();
        }

        return $totalTeam;
    }

    /**
     * Distribute the monthly salary bonus. To be called from a scheduled command.
     */
    public function distributeMonthlySalaryBonus()
    {
        $activeUsers = User::where('status', 'active')->get();

        foreach ($activeUsers as $user) {
            $directCount = User::where('sponsor_id', $user->referral_code)
                ->where('status', 'active')
                ->count();

            // Find highest eligible tier
            $eligibleAmount = 0;
            $eligibleTier = 0;

            foreach ($this->salaryBonusMilestones as $directsNeeded => $amount) {
                if ($directCount >= $directsNeeded) {
                    $eligibleTier = $directsNeeded;
                    $eligibleAmount = $amount;
                    break; // Because array is sorted desc
                }
            }

            if ($eligibleAmount > 0) {
                DB::transaction(function () use ($user, $eligibleTier, $eligibleAmount) {
                    $milestoneKey = 'salary_' . $eligibleTier;

                    // Check how many times this tier has been paid
                    $bonusRecord = UserBonus::where('user_id', $user->id)
                        ->where('bonus_type', 'salary_bonus')
                        ->where('milestone', $milestoneKey)
                        ->first();

                    if (!$bonusRecord) {
                        // First time paying this tier
                        UserBonus::create([
                            'user_id' => $user->id,
                            'bonus_type' => 'salary_bonus',
                            'milestone' => $milestoneKey,
                            'amount' => $eligibleAmount,
                            'month_count' => 1,
                        ]);
                        $this->payoutSalary($user, $eligibleAmount);
                    } elseif ($bonusRecord->month_count < 12) {
                        // Increment month and pay
                        $bonusRecord->increment('month_count');
                        $this->payoutSalary($user, $eligibleAmount);
                    }
                });
            }
        }
    }

    private function payoutSalary(User $user, float $amount)
    {
        $wallet = Wallet::firstOrCreate(['user_id' => $user->id]);
        $wallet->increment('income_wallet', $amount);

        CommissionLedger::create([
            'user_id' => $user->id,
            'from_user_id' => $user->id,
            'level' => 0,
            'amount' => $amount,
            'commission_type' => 'salary_bonus',
            'status' => 'credited',
        ]);
    }

    public function getNextRewardMilestone(User $user)
    {
        $teamSize = $this->calculateTotalTeamSize($user);
        
        foreach ($this->rewardIncomeMilestones['team'] as $milestone => $amount) {
            $exists = UserBonus::where('user_id', $user->id)
                ->where('bonus_type', 'reward_income')
                ->where('milestone', 'team_' . $milestone)
                ->exists();
                
            if (!$exists) {
                return [
                    'current' => $teamSize,
                    'target' => $milestone,
                    'reward' => $amount,
                    'percent' => min(100, ($teamSize / $milestone) * 100)
                ];
            }
        }
        return null;
    }

    public function getCurrentSalaryTier(User $user)
    {
        $directCount = User::where('sponsor_id', $user->referral_code)->where('status', 'active')->count();
        $eligibleAmount = 0;
        $eligibleTier = 0;

        foreach ($this->salaryBonusMilestones as $directsNeeded => $amount) {
            if ($directCount >= $directsNeeded) {
                $eligibleTier = $directsNeeded;
                $eligibleAmount = $amount;
                break;
            }
        }
        
        $nextTier = 0;
        $nextAmount = 0;
        $reversedMilestones = array_reverse($this->salaryBonusMilestones, true);
        foreach ($reversedMilestones as $directsNeeded => $amount) {
            if ($directCount < $directsNeeded) {
                $nextTier = $directsNeeded;
                $nextAmount = $amount;
                break;
            }
        }

        return [
            'current_directs' => $directCount,
            'active_amount' => $eligibleAmount,
            'active_tier' => $eligibleTier,
            'next_tier' => $nextTier,
            'next_amount' => $nextAmount,
        ];
    }
}
