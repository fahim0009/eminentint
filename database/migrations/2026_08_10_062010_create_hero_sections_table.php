<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            // Non-translatable fields (Images & Icons)
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->string('badge1_icon')->default('bi bi-patch-check-fill');
            $table->string('badge2_icon')->default('bi bi-shield-lock-fill');
            $table->timestamps();
        });

        Schema::create('hero_section_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hero_section_id')->constrained('hero_sections')->onDelete('cascade');
            $table->string('locale')->index();
            
            // Translatable fields
            $table->string('title')->nullable();
            $table->longText('subtitle')->nullable();
            $table->string('badge1_text')->nullable();
            $table->string('badge2_text')->nullable();
            $table->string('btn1_text')->nullable();
            $table->string('btn2_text')->nullable();
            $table->string('btn3_text')->nullable();

            $table->unique(['hero_section_id', 'locale']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('hero_section_translations');
        Schema::dropIfExists('hero_sections');
    }
};