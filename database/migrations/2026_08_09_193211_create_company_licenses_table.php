<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('company_licenses', function (Blueprint $table) {
            $table->id();
            
            // Non-translatable fields
            $table->string('reg_no')->nullable(); // e.g. RL-1842
            $table->string('badge_color')->default('bg-success'); // e.g. bg-success, bg-navy
            $table->string('prefix_badge_color')->default('bg-navy'); // e.g. bg-navy, bg-success
            $table->string('border_class')->nullable(); // e.g. border-start border-4 border-success
            $table->string('icon_class')->nullable(); // e.g. bi-file-earmark-pdf-fill
            $table->string('icon_color')->nullable(); // e.g. text-maroon, text-gold
            $table->string('pdf_file')->nullable(); // Uploaded PDF path
            $table->integer('order')->default(1);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('company_license_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_license_id')->constrained('company_licenses')->onDelete('cascade');
            $table->string('locale')->index();
            
            // Translatable fields
            $table->string('status_badge')->nullable(); // e.g. Active, Saudi Verified
            $table->string('prefix_badge')->nullable(); // e.g. Bangladesh Govt Approved
            $table->string('title'); // e.g. Recruiting License (RL-1842)
            $table->longText('description')->nullable();
            $table->string('reg_detail')->nullable(); // e.g. Issued for International Staff Deployment

            $table->unique(['company_license_id', 'locale']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_license_translations');
        Schema::dropIfExists('company_licenses');
    }
};