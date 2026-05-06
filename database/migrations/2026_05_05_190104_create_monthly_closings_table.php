<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('monthly_closings', function (Blueprint $table) {
            $table->id();
            $table->integer('month');
            $table->integer('year');
            $table->integer('total_active_users')->default(0);
            $table->decimal('total_income_generated', 15, 2)->default(0.00);
            $table->decimal('total_withdrawals', 15, 2)->default(0.00);
            $table->decimal('total_tokens_issued', 15, 2)->default(0.00);
            $table->json('report_json')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monthly_closings');
    }
};
