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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->integer('stars')->default(5);
            $table->string('avatar_bg_color')->default('bg-navy');
            $table->integer('order')->default(1);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('testimonial_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('testimonial_id')->constrained()->cascadeOnDelete();
            $table->string('locale')->index();
            $table->text('review_text')->nullable();
            $table->string('reviewer_name')->nullable();
            $table->string('reviewer_role')->nullable();
            $table->unique(['testimonial_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
        /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop translations table FIRST because of the foreign key
        Schema::dropIfExists('testimonial_translations');
        Schema::dropIfExists('testimonials');
    }
};
