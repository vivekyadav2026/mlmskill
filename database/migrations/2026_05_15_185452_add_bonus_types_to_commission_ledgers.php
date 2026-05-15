<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // MySQL ALTER TABLE to extend the ENUM with bonus types
        DB::statement("ALTER TABLE `commission_ledgers` MODIFY `commission_type` ENUM('direct', 'team', 'reward_income', 'salary_bonus') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE `commission_ledgers` MODIFY `commission_type` ENUM('direct', 'team') NOT NULL");
    }
};
