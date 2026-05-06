<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('token_ledgers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('token_type', ['utility', 'renewal']);
            $table->decimal('token_count', 15, 2);
            $table->decimal('token_value', 15, 4);
            $table->string('source')->nullable();
            $table->enum('status', ['credited', 'used', 'locked']);
            $table->timestamp('credited_date')->nullable();
            $table->timestamp('used_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('token_ledgers');
    }
};
