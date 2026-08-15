<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidate_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_listing_id')->nullable()->constrained('job_listings')->onDelete('cascade');
            $table->string('tracking_id')->unique(); // To generate EM-2026-XXXX
            $table->string('full_name')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('phone')->nullable();
            $table->string('target_position')->nullable();
            $table->string('destination_country')->nullable();
            $table->string('experience_level')->nullable();
            $table->string('passport_file')->nullable(); // Path to uploaded passport
            $table->string('cv_file')->nullable(); // Path to uploaded CV
            $table->string('status')->default('new'); // new, reviewed, contacted, rejected
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidate_applications');
    }
};