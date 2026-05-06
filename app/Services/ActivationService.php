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

            // Ensure wallet exists
            Wallet::firstOrCreate(['user_id' => $user->id]);

            // Give access to course
            CourseProgress::firstOrCreate([
                'user_id' => $user->id,
                'course_id' => $courseId,
            ]);

            // Distribute commissions up the tree
            $this->commissionService->distributeCommissions($user);

            return true;
        });
    }
}
