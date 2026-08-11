<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('recruitment_steps', function (Blueprint $table) {
            $table->id();
            $table->string('badge_color')->default('bg-navy'); // e.g. bg-navy, bg-gold, bg-success
            $table->string('border_color')->default('border-navy'); // e.g. border-navy, border-gold
            $table->integer('order')->default(1);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('recruitment_step_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recruitment_step_id')->constrained('recruitment_steps')->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('badge_text'); // e.g. Step 1
            $table->string('title');
            $table->longText('description')->nullable();
            $table->unique(['recruitment_step_id', 'locale']);
        });
    }
    public function down() { Schema::dropIfExists('recruitment_step_translations'); Schema::dropIfExists('recruitment_steps'); }
};