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

            $wallet = Wallet::firstOrCreate(['user_id' => $user->id]);

            // Grant access to all courses in the active module automatically
            $modules = \App\Models\CourseModule::with('courses')->where('status', 'active')->get();
            foreach ($modules as $module) {
                foreach ($module->courses as $course) {
                    if ($course->status == 'active') {
                        \App\Models\CourseProgress::firstOrCreate([
                            'user_id' => $user->id,
                            'course_id' => $course->id,
                        ]);
                    }
                }
            }

            // Give 300 free utility tokens upon activation
            $tokenValue = (float) \App\Models\Setting::get('utility_token_value', 0.10);
            \App\Models\TokenLedger::create([
                'user_id' => $user->id,
                'token_type' => 'utility',
                'token_count' => 300,
                'token_value' => $tokenValue,
                'source' => 'activation_bonus',
                'status' => 'credited',
                'credited_date' => now(),
            ]);
            $wallet->utility_token_wallet += 300;
            $wallet->save();

            // Give commissions and check reward income
            $this->commissionService->distributeCommissions($user, 300);
            app(\App\Services\BonusService::class)->checkAndDistributeRewardIncome($user);

            return true;
        });
    }
}
