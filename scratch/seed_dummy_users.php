<?php

use App\Models\User;
use App\Models\Wallet;
use App\Services\ActivationService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$sponsorCode = 'USER456';
$sponsor = User::where('referral_code', $sponsorCode)->first();

if (!$sponsor) {
    echo "Sponsor $sponsorCode not found!\n";
    exit;
}

echo "Found sponsor: {$sponsor->name}. Creating 50 dummy users...\n";

$activationService = app(ActivationService::class);

for ($i = 1; $i <= 50; $i++) {
    $name = "Dummy User " . Str::random(5);
    $email = "dummy_" . Str::random(8) . "@example.com";
    
    $user = User::create([
        'name' => $name,
        'email' => $email,
        'password' => Hash::make('password123'),
        'sponsor_id' => $sponsorCode,
        'referral_code' => 'DUMMY' . Str::upper(Str::random(5)),
        'status' => 'inactive',
        'role' => 'user',
    ]);

    // Activate the user to trigger rank/commission logic
    $activationService->activateUser($user);
    
    echo "[$i] Created and activated: $name ($email)\n";
}

echo "\nDone! 50 users added and activated under $sponsorCode.\n";
