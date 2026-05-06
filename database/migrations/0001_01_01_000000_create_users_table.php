<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('password');
            $table->string('sponsor_id')->nullable();
            $table->string('referral_code')->unique()->nullable();
            $table->enum('status', ['inactive', 'active'])->default('inactive');
            $table->timestamp('activation_date')->nullable();
            $table->timestamp('course_completed_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('role')->default('user'); // admin or user
            
            $table->rememberToken();
            $table->timestamps();
            
            // Note: sponsor_id typically references the referral_code of another user, 
            // or we can make it foreign key to id.
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
