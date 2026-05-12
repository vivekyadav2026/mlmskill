<?php

namespace App\Services;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Course;
use App\Models\CourseProgress;
use Illuminate\Support\Facades\DB;
use Exception;

class ActivationService
{
    protected CommissionService $commissionService;

    public function __construct(CommissionService $commissionService)
    {
        $this->commissionService = $commissionService;
    }

    public function activateUser(User $user, int $courseId = 1)
    {
        return DB::transaction(function () use ($user, $courseId) {
            if ($user->status === 'active') {
                throw new Exception("User is already active.");
            }

            // Mark as active
            $user->status = 'active';
            $user->activation_date = now();
            $user->save();

            // Give them $300 in package wallet to buy the course
            $wallet = Wallet::firstOrCreate(['user_id' => $user->id]);
            $wallet->increment('package_wallet', 300);
            
            \App\Models\ActivityLog::log('activation_bonus', 'Received $300 wallet bonus upon admin approval', $user->id);

            // Give commissions and check reward income
            $this->commissionService->distributeCommissions($user, 300);
            app(\App\Services\BonusService::class)->checkAndDistributeRewardIncome($user);

            return true;
        });
    }
}
