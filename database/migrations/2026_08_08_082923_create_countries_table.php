<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            
            // Non-translatable fields
            $table->string('flag')->nullable(); // e.g. 🇸🇦
            $table->string('salary_range')->nullable(); // e.g. 1,500 - 4,500 SAR
            $table->string('deployment_time')->nullable(); // e.g. 30 - 40 Days
            $table->string('image')->nullable(); // For featured country image
            $table->boolean('is_featured')->default(0); // To show large block like Saudi Arabia
            $table->integer('order')->default(1);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('country_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
            $table->string('locale')->index();
            
            // Translatable fields
            $table->string('name'); // e.g. Saudi Arabia
            $table->string('short_name')->nullable(); // e.g. KSA
            $table->longText('description')->nullable();
            $table->string('current_demand')->nullable(); // e.g. 500+ Openings (Featured only)
            $table->string('visa_process')->nullable(); // e.g. MOFA / Enjaz Direct (Featured only)
            $table->string('job_link')->nullable(); // e.g. jobs.html?country=saudi

            $table->unique(['country_id', 'locale']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('country_translations');
        Schema::dropIfExists('countries');
    }
};