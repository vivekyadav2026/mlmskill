<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('withdrawals', function (Blueprint $table) {
            // charge_amount = 10% (or configured %) deducted as fee
            $table->decimal('charge_amount', 15, 2)->default(0.00)->after('amount');
            // net_amount = amount user actually receives (amount - charge_amount)
            $table->decimal('net_amount', 15, 2)->nullable()->after('charge_amount');
        });
    }

    public function down(): void
    {
        Schema::table('withdrawals', function (Blueprint $table) {
            $table->dropColumn(['charge_amount', 'net_amount']);
        });
    }
};
