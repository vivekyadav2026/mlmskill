<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// ─── Salary Bonus: Run weekly on the specified day ───────────────────
// This pays weekly salary to all eligible users based on achieved ranks.
// Max 12 payments per user per rank. Output is logged to storage/logs/salary-bonus.log
try {
    $payoutDayOfWeek = (int) \App\Models\Setting::get('salary_payout_day_of_week', 1); // 0=Sun, 1=Mon, ..., 6=Sat
} catch (\Exception $e) {
    $payoutDayOfWeek = 1; // Fallback during migrations/setup
}
$payoutDayOfWeek = ($payoutDayOfWeek >= 0 && $payoutDayOfWeek <= 6) ? $payoutDayOfWeek : 1;

Schedule::command('bonuses:salary')
    ->weeklyOn($payoutDayOfWeek, '00:00')                    // dynamic payout day of the week
    ->appendOutputTo(storage_path('logs/salary-bonus.log'))  // save output to log file
    ->withoutOverlapping()                           // prevent double-run if previous is still running
    ->runInBackground();                             // don't block other scheduled jobs

// ─── Daily Token Distribution ───────────────────────────────────────────────
// Schedule::command('app:distribute-daily-tokens')->dailyAt('00:00');
