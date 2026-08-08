<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            
            // Non-translatable fields
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('industry')->nullable();
            $table->integer('vacancy_count')->default(1);
            $table->integer('order')->default(1);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('job_listings_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_listing_id')->constrained('job_listings')->onDelete('cascade');
            $table->string('locale')->index();
            
            // Translatable fields
            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->string('company_name')->nullable();
            $table->string('salary')->nullable();
            $table->text('benefits')->nullable();
            $table->text('requirements')->nullable();

            $table->unique(['job_listing_id', 'locale']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_listings_translations');
        Schema::dropIfExists('job_listings');
    }
};
