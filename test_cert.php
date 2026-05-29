<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $user = App\Models\User::where('status', 'active')->first();
    $course = App\Models\Course::first();
    if(!$user || !$course) { echo 'Need user and course.'; exit; }
    
    $cert = App\Models\Certificate::create([
        'user_id' => $user->id,
        'course_id' => $course->id,
        'certificate_number' => 'CERT-TEST-123',
        'status' => 'pending'
    ]);
    echo "Created pending cert ID: {$cert->id}\n";
    
    // Now approve it
    $cert->update(['status' => 'issued', 'issue_date' => now()]);
    $nexa3RewardAmount = (float) App\Models\Setting::get('nexa_3_course_reward', 300);
    if ($nexa3RewardAmount > 0) {
        $wallet = App\Models\Wallet::firstOrCreate(['user_id' => $user->id]);
        $wallet->nexa_3_wallet += $nexa3RewardAmount;
        $wallet->save();
        
        App\Models\TokenLedger::create([
            'user_id' => $user->id,
            'token_type' => 'nexa_3',
            'token_count' => $nexa3RewardAmount,
            'token_value' => App\Models\Setting::get('nexa_3_token_value', 1),
            'source' => 'Course Completion',
            'status' => 'credited',
            'credited_date' => now()
        ]);
    }
    
    App\Models\ActivityLog::log('certificate_approved', 'Approved certificate');
    echo 'Success';
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage() . " at " . $e->getFile() . ":" . $e->getLine();
}
