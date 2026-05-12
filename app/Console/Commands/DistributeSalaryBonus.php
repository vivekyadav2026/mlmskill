<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\BonusService;

class DistributeSalaryBonus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bonuses:salary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Distributes the monthly Salary Bonus based on direct referrals';

    /**
     * Execute the console command.
     */
    public function handle(BonusService $bonusService)
    {
        $this->info('Starting Salary Bonus distribution...');
        $bonusService->distributeMonthlySalaryBonus();
        $this->info('Salary Bonus distribution completed.');
    }
}
