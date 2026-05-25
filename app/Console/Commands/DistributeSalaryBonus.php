<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\BonusService;
use App\Models\User;
use App\Models\CommissionLedger;
use App\Models\ActivityLog;
use Carbon\Carbon;

class DistributeSalaryBonus extends Command
{
    protected $signature   = 'bonuses:salary {--dry-run : Preview without paying}';
    protected $description = 'Distributes the weekly Salary Bonus based on achieved ranks';

    public function handle(BonusService $bonusService): int
    {
        $isDryRun = $this->option('dry-run');
        $weekDate = Carbon::now()->format('d M Y');

        $this->info("═══════════════════════════════════════");
        $this->info("  Salary Bonus Distribution — {$weekDate}");
        $this->info("═══════════════════════════════════════");

        if ($isDryRun) {
            $this->warn('  [DRY RUN] No payments will be made.');
        }

        // Snapshot wallet totals before run
        $totalBefore = CommissionLedger::where('commission_type', 'salary_bonus')->sum('amount');

        if (!$isDryRun) {
            $bonusService->distributeWeeklySalaryBonus();
        }

        // Calculate how much was paid this run
        $totalAfter = CommissionLedger::where('commission_type', 'salary_bonus')->sum('amount');
        $paidThisRun = round($totalAfter - $totalBefore, 2);

        // Count recipients this run (ledger entries created just now)
        $recipientCount = CommissionLedger::where('commission_type', 'salary_bonus')
            ->where('created_at', '>=', Carbon::now()->subMinutes(5))
            ->count();

        $this->info("  ✅ Distribution complete!");
        $this->info("  Recipients this run : {$recipientCount} users");
        $this->info("  Amount paid         : \${$paidThisRun}");
        $this->info("═══════════════════════════════════════");

        // Log to ActivityLog so admin can see it in the dashboard
        if (!$isDryRun) {
            ActivityLog::log(
                'salary_bonus_distributed',
                "Weekly salary bonus distributed for {$weekDate}: {$recipientCount} users paid, total \${$paidThisRun}"
            );
        }

        return Command::SUCCESS;
    }
}

