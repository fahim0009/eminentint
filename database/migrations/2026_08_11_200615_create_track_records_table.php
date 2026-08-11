<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('track_records', function (Blueprint $table) {
            $table->id();
            $table->integer('order')->default(1);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('track_record_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('track_record_id')->constrained('track_records')->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('badge_text')->nullable(); // Confidential Partner — Riyadh
            $table->string('title');
            $table->longText('description')->nullable();
            $table->string('footer_text')->nullable(); // ✓ 500+ Workers Deployed
            $table->unique(['track_record_id', 'locale']);
        });
    }
    public function down() { Schema::dropIfExists('track_record_translations'); Schema::dropIfExists('track_records'); }
};