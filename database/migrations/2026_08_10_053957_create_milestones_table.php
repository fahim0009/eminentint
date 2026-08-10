<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('milestones', function (Blueprint $table) {
            $table->id();
            $table->string('year'); // e.g. 2026
            $table->string('badge_color')->default('bg-navy'); // e.g. bg-maroon, bg-gold
            $table->integer('order')->default(1);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('milestone_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('milestone_id')->constrained('milestones')->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->unique(['milestone_id', 'locale']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('milestone_translations');
        Schema::dropIfExists('milestones');
    }
};