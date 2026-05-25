<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('wallets', function (Blueprint $table) {
            $table->decimal('nexa_3_wallet', 15, 2)->default(0.00)->after('renewal_token_wallet');
        });

        // Add nexa_3 to token_type enum in token_ledgers
        DB::statement("ALTER TABLE token_ledgers MODIFY COLUMN token_type ENUM('utility', 'renewal', 'nexa_3') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wallets', function (Blueprint $table) {
            $table->dropColumn('nexa_3_wallet');
        });
        
        DB::statement("ALTER TABLE token_ledgers MODIFY COLUMN token_type ENUM('utility', 'renewal') NOT NULL");
    }
};
