<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hero_stats', function (Blueprint $table) {
            $table->id();
            $table->string('icon'); // e.g. bi-people-fill
            $table->string('icon_color')->default('text-navy'); // e.g. text-navy, text-gold
            $table->string('number'); // e.g. 10000
            $table->string('suffix')->nullable(); // e.g. +, %
            $table->integer('order')->default(1);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('hero_stat_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hero_stat_id')->constrained('hero_stats')->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('label'); // e.g. Workers Deployed
            $table->unique(['hero_stat_id', 'locale']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('hero_stat_translations');
        Schema::dropIfExists('hero_stats');
    }
};