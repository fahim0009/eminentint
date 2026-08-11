<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employer_advantages', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->default('bi bi-shield-check');
            $table->string('icon_color')->default('text-navy');
            $table->integer('order')->default(1);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('employer_advantage_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_advantage_id')->constrained('employer_advantages')->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('title');
            $table->longText('description')->nullable();
            
            // FIX: Added a custom short name for the unique index
            $table->unique(['employer_advantage_id', 'locale'], 'empl_adv_trans_id_locale_unique');
        });
    }
    public function down() { Schema::dropIfExists('employer_advantage_translations'); Schema::dropIfExists('employer_advantages'); }
};