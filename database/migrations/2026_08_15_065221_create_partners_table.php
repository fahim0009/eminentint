<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('icon_class')->default('bi-building');
            $table->string('icon_color')->default('text-primary');
            $table->string('country_flag')->nullable(); // e.g. 🇸🇦
            $table->integer('order')->default(1);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('partner_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->constrained()->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('name')->nullable();
            $table->string('country')->nullable();
            $table->unique(['partner_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
        /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop translations table FIRST because of the foreign key
        Schema::dropIfExists('partner_translations');
        Schema::dropIfExists('partners');
    }
};
