<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            
            // Non-translatable fields (Images, Names, Numbers)
            $table->string('company_image')->nullable();
            $table->string('stat1_number')->nullable(); // e.g. 10,000+
            $table->string('stat2_number')->nullable(); // e.g. 500+
            $table->string('chairman_image')->nullable();
            $table->string('chairman_name')->nullable();
            $table->string('chairman_designation')->nullable();
            $table->string('ceo_image')->nullable();
            $table->string('ceo_name')->nullable();
            $table->string('ceo_designation')->nullable();
            $table->timestamps();
        });

        Schema::create('about_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('about_id')->constrained('abouts')->onDelete('cascade');
            $table->string('locale')->index();
            
            // Translatable fields
            $table->string('hero_title')->nullable();
            $table->longText('hero_desc')->nullable();
            $table->string('company_tag')->nullable();
            $table->string('company_title')->nullable();
            $table->longText('company_content1')->nullable();
            $table->longText('company_content2')->nullable();
            $table->string('stat1_label')->nullable();
            $table->string('stat2_label')->nullable();
            $table->string('mvv_tag')->nullable();
            $table->string('mvv_title')->nullable();
            $table->string('vision_title')->nullable();
            $table->longText('vision_content')->nullable();
            $table->string('mission_title')->nullable();
            $table->longText('mission_content')->nullable();
            $table->string('why_title')->nullable();
            $table->longText('why_content')->nullable();
            $table->string('chairman_tag')->nullable();
            $table->string('chairman_title')->nullable();
            $table->longText('chairman_quote')->nullable();
            $table->string('ceo_tag')->nullable();
            $table->string('ceo_title')->nullable();
            $table->longText('ceo_quote')->nullable();
            $table->string('timeline_tag')->nullable();
            $table->string('timeline_title')->nullable();

            $table->unique(['about_id', 'locale']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('about_translations');
        Schema::dropIfExists('abouts');
    }
};