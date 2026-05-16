<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        // Delete certificates with no course (NULL course_id violates the FK back to NOT NULL)
        DB::table('certificates')->whereNull('course_id')->delete();

        // Disable FK checks temporarily so we can change the column constraint
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Schema::table('certificates', function (Blueprint $table) {
            $table->unsignedBigInteger('course_id')->nullable(false)->change();
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
};

