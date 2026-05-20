<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// ─── Salary Bonus: Run on 20th of every month at midnight ───────────────────
// This pays monthly salary to all eligible users (based on active direct count).
// Max 12 payments per user per tier. Output is logged to storage/logs/salary-bonus.log
$payoutDay = (int) \App\Models\Setting::get('salary_payout_day', 20);
$payoutDay = ($payoutDay >= 1 && $payoutDay <= 28) ? $payoutDay : 20;

Schedule::command('bonuses:salary')
    ->monthlyOn($payoutDay, '00:00')                         // dynamic payout day
    ->appendOutputTo(storage_path('logs/salary-bonus.log'))  // save output to log file
    ->withoutOverlapping()                           // prevent double-run if previous is still running
    ->runInBackground();                             // don't block other scheduled jobs

// ─── Daily Token Distribution ───────────────────────────────────────────────
Schedule::command('app:distribute-daily-tokens')->dailyAt('00:00');

