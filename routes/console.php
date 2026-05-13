<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Run salary bonus on the 1st of every month at midnight
Schedule::command('bonuses:salary')->monthly();

// Distribute daily tokens to all active users at midnight every day
Schedule::command('app:distribute-daily-tokens')->dailyAt('00:00');
