<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserBonus;
use App\Models\Wallet;
use App\Models\CommissionLedger;
use Illuminate\Support\Facades\DB;

class BonusService
{
    /**
     * Rank & Reward milestones (as per the MLM plan).
     *
     * 'direct' milestones: keyed by number of active directs → reward amount
     * 'team'   milestones: keyed by total active team size  → reward amount
     *
     * Some team ranks also require a minimum number of direct referrals.
     * Those are enforced in evaluateUserRewardIncome().
     */
    private array $rewardIncomeMilestones = [
        'direct' => [],
        'team' => [
            //  team   => reward
              5 =>    25.00,  // Active Associate
             10 =>    50.00,  // Star
             50 =>   100.00,  // Manager       (also needs >= 5 directs)
            100 =>   150.00,  // Sr. Manager   (also needs >= 10 directs)
            500 =>  1000.00,  // Director
           1000 =>  2500.00,  // Sr. Director
           2000 =>  5000.00,  // Crown
           5000 => 10000.00,  // Silver Crown
          10000 => 20000.00,  // Gold Crown
          25000 => 50000.00,  // Platinum Crown
          50000 => 100000.00, // Diamond Crown
        ],
    ];

    /**
     * Minimum active directs required to unlock certain team-size ranks.
     * If a rank is not listed here, no direct condition applies.
     */
    private array $rankDirectRequirements = [
        50  => 5,  // Manager needs >= 5 directs
        100 => 10, // Sr. Manager needs >= 10 directs
    ];

    /**
     * Build salary bonus milestones based on Rank.
     * Keys: salary_amount_{RankName}
     */
    private function getSalaryBonusMilestones(): array
    {
        $defaults = [
            'Diamond Crown'  => 25000,
            'Platinum Crown' => 10000,
            'Gold Crown'     => 5000,
            'Silver Crown'   => 1000,
            'Crown'          => 500,
            'Sr. Director'   => 200,
            'Director'       => 100,
            'Sr. Manager'    => 50,
            'Manager'        => 20,
        ];

        $milestones = [];
        foreach ($defaults as $rank => $defaultAmount) {
            // Keep the key database friendly
            $settingKey = 'salary_amount_' . str_replace([' ', '.'], '_', $rank);
            $amount  = (float) \App\Models\Setting::get($settingKey, $defaultAmount);
            if ($amount > 0) {
                $milestones[$rank] = $amount;
            }
        }

        return $milestones; // Order is implicitly highest rank to lowest based on $defaults array
    }

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
        $teamSize    = $this->calculateTotalTeamSize($user);

        DB::transaction(function () use ($user, $directCount, $teamSize) {

            // ── Check Direct-Count Rank Milestones (Active Associate, Star) ──
            foreach ($this->rewardIncomeMilestones['direct'] as $milestone => $amount) {
                if ($directCount >= $milestone) {
                    $milestoneKey = 'direct_' . $milestone;
                    $this->payoutRewardIncome($user, $milestoneKey, $amount);
                }
            }

            // ── Check Team-Size Rank Milestones ──
            foreach ($this->rewardIncomeMilestones['team'] as $milestone => $amount) {
                if ($teamSize >= $milestone) {

                    // Some ranks also require a minimum number of direct referrals
                    $requiredDirects = $this->rankDirectRequirements[$milestone] ?? 0;
                    if ($requiredDirects > 0 && $directCount < $requiredDirects) {
                        // Direct condition not yet met — skip this rank
                        continue;
                    }

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
     * Distribute the weekly salary bonus based on Rank. To be called from a scheduled command.
     */
    public function distributeWeeklySalaryBonus()
    {
        $activeUsers = User::where('status', 'active')->get();

        foreach ($activeUsers as $user) {
            $rankData = $this->getCurrentRank($user);
            $currentRankName = $rankData['current_rank'];
            
            $rankLadder = [
                'Diamond Crown'  => 11,
                'Platinum Crown' => 10,
                'Gold Crown'     => 9,
                'Silver Crown'   => 8,
                'Crown'          => 7,
                'Sr. Director'   => 6,
                'Director'       => 5,
                'Sr. Manager'    => 4,
                'Manager'        => 3,
                'Star'           => 2,
                'Active Associate'=> 1,
                'Unranked'       => 0
            ];
            
            $userRankLevel = $rankLadder[$currentRankName] ?? 0;

            $eligibleAmount = 0;
            $eligibleRank = '';

            foreach ($this->getSalaryBonusMilestones() as $rank => $amount) {
                $loopRankLevel = $rankLadder[$rank] ?? 0;
                if ($userRankLevel >= $loopRankLevel && $loopRankLevel > 0) {
                    $eligibleRank = $rank;
                    $eligibleAmount = $amount;
                    break;
                }
            }

            if ($eligibleAmount > 0 && $eligibleRank) {
                DB::transaction(function () use ($user, $eligibleRank, $eligibleAmount) {
                    $milestoneKey = 'salary_' . str_replace([' ', '.'], '_', $eligibleRank);

                    // Check how many times this tier has been paid
                    // We reuse 'month_count' as the week counter to avoid db migration
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
                            'month_count' => 1, // acts as week_count
                        ]);
                        $this->payoutSalary($user, $eligibleAmount);
                    } elseif ($bonusRecord->month_count < 12) {
                        // Increment week and pay
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

    /**
     * Compute the user's current rank (and next rank) from their live team/direct counts.
     * Returns an array with: current_rank, current_rank_color, next_rank, next_team, next_direct, progress_pct
     */
    public function getCurrentRank(User $user): array
    {
        $directCount = User::where('sponsor_id', $user->referral_code)->where('status', 'active')->count();
        $teamSize    = $this->calculateTotalTeamSize($user);

        // Full rank ladder — ordered highest to lowest for "current rank" detection
        $rankLadder = [
            ['name' => 'Diamond Crown',  'color' => '#00cfff', 'team' => 50000, 'directs' => 0],
            ['name' => 'Platinum Crown', 'color' => '#e5c100', 'team' => 25000, 'directs' => 0],
            ['name' => 'Gold Crown',     'color' => '#ffd700', 'team' => 10000, 'directs' => 0],
            ['name' => 'Silver Crown',   'color' => '#c0c0c0', 'team' => 5000,  'directs' => 0],
            ['name' => 'Crown',          'color' => '#a855f7', 'team' => 2000,  'directs' => 0],
            ['name' => 'Sr. Director',   'color' => '#6366f1', 'team' => 1000,  'directs' => 0],
            ['name' => 'Director',       'color' => '#3b82f6', 'team' => 500,   'directs' => 0],
            ['name' => 'Sr. Manager',    'color' => '#10b981', 'team' => 100,   'directs' => 10],
            ['name' => 'Manager',        'color' => '#22c55e', 'team' => 50,    'directs' => 5],
            ['name' => 'Star',           'color' => '#f59e0b', 'team' => 0,     'directs' => 10],
            ['name' => 'Active Associate','color' => '#f97316','team' => 0,     'directs' => 5],
        ];

        $currentRank  = null;
        $currentIndex = count($rankLadder); // "Unranked" is beyond the end

        foreach ($rankLadder as $i => $rank) {
            $teamOk    = $teamSize    >= $rank['team'];
            $directOk  = $directCount >= $rank['directs'];
            if ($teamOk && $directOk) {
                $currentRank  = $rank;
                $currentIndex = $i;
                break;
            }
        }

        // Next rank = the one above current in the ladder (lower index)
        $nextRank = $currentIndex > 0 ? $rankLadder[$currentIndex - 1] : null;

        // Progress toward next rank (team-based if team required, else directs)
        $progressPct = 0;
        if ($nextRank) {
            $teamProgress = 100;
            if ($nextRank['team'] > 0) {
                $fromTeam = $currentRank ? $currentRank['team'] : 0;
                $teamProgress = $fromTeam < $nextRank['team']
                    ? min(100, round((($teamSize - $fromTeam) / ($nextRank['team'] - $fromTeam)) * 100, 1))
                    : 100;
            }

            $dirProgress = 100;
            if ($nextRank['directs'] > 0) {
                $fromDir = $currentRank ? $currentRank['directs'] : 0;
                $dirProgress = $fromDir < $nextRank['directs']
                    ? min(100, round((($directCount - $fromDir) / ($nextRank['directs'] - $fromDir)) * 100, 1))
                    : 100;
            }

            $progressPct = min($teamProgress, $dirProgress);
        }

        return [
            'current_rank'   => $currentRank ? $currentRank['name']  : 'Unranked',
            'current_color'  => $currentRank ? $currentRank['color'] : '#6b7280',
            'next_rank'      => $nextRank     ? $nextRank['name']     : null,
            'next_team'      => $nextRank     ? $nextRank['team']     : null,
            'next_directs'   => $nextRank     ? $nextRank['directs']  : null,
            'team_size'      => $teamSize,
            'direct_count'   => $directCount,
            'progress_pct'   => $progressPct,
        ];
    }

    public function getCurrentSalaryTier(User $user)
    {
        $rankData = $this->getCurrentRank($user);
        $currentRankName = $rankData['current_rank'];
        
        $rankLadder = [
            'Diamond Crown'  => 11,
            'Platinum Crown' => 10,
            'Gold Crown'     => 9,
            'Silver Crown'   => 8,
            'Crown'          => 7,
            'Sr. Director'   => 6,
            'Director'       => 5,
            'Sr. Manager'    => 4,
            'Manager'        => 3,
            'Star'           => 2,
            'Active Associate'=> 1,
            'Unranked'       => 0
        ];
        
        $userRankLevel = $rankLadder[$currentRankName] ?? 0;
        
        $eligibleAmount = 0;
        $eligibleRank = 'None';
        
        foreach ($this->getSalaryBonusMilestones() as $rank => $amount) {
            $loopRankLevel = $rankLadder[$rank] ?? 0;
            if ($userRankLevel >= $loopRankLevel && $loopRankLevel > 0) {
                $eligibleRank = $rank;
                $eligibleAmount = $amount;
                break;
            }
        }

        $nextRank = 'None';
        $nextAmount = 0;
        $reversedMilestones = array_reverse($this->getSalaryBonusMilestones(), true);
        foreach ($reversedMilestones as $rank => $amount) {
            $loopRankLevel = $rankLadder[$rank] ?? 0;
            if ($userRankLevel < $loopRankLevel) {
                $nextRank = $rank;
                $nextAmount = $amount;
                break;
            }
        }

        return [
            'current_rank' => $currentRankName,
            'active_amount' => $eligibleAmount,
            'active_tier' => $eligibleRank,
            'next_tier' => $nextRank,
            'next_amount' => $nextAmount,
            'progress_pct' => $rankData['progress_pct']
        ];
    }
}
