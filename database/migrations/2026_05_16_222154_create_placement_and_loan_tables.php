<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Jobs & Placements
        Schema::create('job_postings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('company_name');
            $table->text('description');
            $table->string('location')->nullable();
            $table->string('salary_range')->nullable();
            $table->enum('job_type', ['full_time', 'part_time', 'internship', 'contract'])->default('full_time');
            $table->enum('category', ['job', 'company_placement'])->default('job');
            $table->enum('status', ['active', 'closed'])->default('active');
            $table->timestamps();
        });

        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_posting_id')->constrained()->onDelete('cascade');
            $table->string('resume_path')->nullable();
            $table->text('cover_letter')->nullable();
            $table->enum('status', ['pending', 'shortlisted', 'rejected', 'hired'])->default('pending');
            $table->text('admin_remarks')->nullable();
            $table->timestamps();
        });

        // Loan Facility
        Schema::create('loan_schemes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('min_amount', 15, 2);
            $table->decimal('max_amount', 15, 2);
            $table->decimal('interest_rate', 5, 2);
            $table->integer('max_tenure_months');
            $table->text('description')->nullable();
            $table->string('required_rank')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        Schema::create('loan_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('loan_scheme_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->integer('tenure_months');
            $table->decimal('monthly_emi', 15, 2);
            $table->enum('status', ['pending', 'approved', 'rejected', 'disbursed', 'active', 'closed'])->default('pending');
            $table->text('admin_remarks')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('disbursed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loan_requests');
        Schema::dropIfExists('loan_schemes');
        Schema::dropIfExists('job_applications');
        Schema::dropIfExists('job_postings');
    }
};
