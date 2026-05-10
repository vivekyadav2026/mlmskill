<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = \App\Models\User::where('status', 'active')->get();
        foreach ($users as $user) {
            $wallet = \App\Models\Wallet::firstOrCreate(['user_id' => $user->id]);
            
            // Give 1 Utility Token
            $wallet->increment('utility_token_wallet', 1);
            \App\Models\TokenLedger::create([
                'user_id' => $user->id,
                'token_type' => 'utility',
                'token_count' => 1,
                'source' => 'daily_reward',
                'status' => 'credited',
                'credited_date' => now()
            ]);
            
            // Give 1 Renewal Token
            $wallet->increment('renewal_token_wallet', 1);
            \App\Models\TokenLedger::create([
                'user_id' => $user->id,
                'token_type' => 'renewal',
                'token_count' => 1,
                'source' => 'daily_reward',
                'status' => 'credited',
                'credited_date' => now()
            ]);
        }
        $this->info('Daily tokens distributed successfully.');
    }
}
