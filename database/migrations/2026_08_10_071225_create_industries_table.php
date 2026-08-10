<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('industries', function (Blueprint $table) {
            $table->id();
            
            // Non-translatable fields
            $table->string('icon')->default('bi bi-folder'); // e.g. bi-building
            $table->string('icon_color')->default('text-navy'); // e.g. text-gold, text-maroon
            $table->integer('order')->default(1);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('industry_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('industry_id')->constrained('industries')->onDelete('cascade');
            $table->string('locale')->index();
            
            // Translatable fields
            $table->string('title'); // e.g. Construction & Engineering
            $table->longText('description')->nullable(); // e.g. Electricians, Plumbers...
            $table->string('button_text')->nullable(); // e.g. Request Construction Staff

            $table->unique(['industry_id', 'locale']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('industry_translations');
        Schema::dropIfExists('industries');
    }
};