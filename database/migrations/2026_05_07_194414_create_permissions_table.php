<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();   // e.g. manage_users
            $table->string('display_name');     // e.g. "Manage Users"
            $table->string('group')->default('general'); // e.g. users, finance, settings
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('permissions'); }
};
