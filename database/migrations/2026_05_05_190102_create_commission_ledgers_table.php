<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('commission_ledgers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('from_user_id')->nullable();
            $table->integer('level')->default(0);
            $table->decimal('amount', 15, 2);
            $table->enum('commission_type', ['direct', 'team']);
            $table->string('status')->default('credited');
            $table->timestamps();
            
            $table->foreign('from_user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commission_ledgers');
    }
};
