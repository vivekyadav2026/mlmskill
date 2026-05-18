<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TokenService;

class DistributeDailyTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:distribute-daily-tokens';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Distribute 1 Utility + 1 NEXA 2.0 daily to all active users';

    /**
     * Execute the console command.
     */
    public function handle(TokenService $tokenService): void
    {
        $this->info('Starting daily token distribution...');

        $tokenService->distributeDailyTokens();

        $this->info('Daily tokens distributed successfully.');
    }
}

