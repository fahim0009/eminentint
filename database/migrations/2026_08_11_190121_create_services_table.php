<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            
            // Non-translatable fields
            $table->string('icon')->default('bi bi-folder'); // e.g. bi-person-fill-check
            $table->string('icon_color')->default('text-navy'); // e.g. text-gold, text-maroon
            $table->string('anchor_id')->nullable(); // e.g. permanent, bulk, trade
            $table->integer('order')->default(1);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::create('service_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->string('locale')->index();
            
            // Translatable fields
            $table->string('title');
            $table->longText('description')->nullable();
            $table->longText('features')->nullable(); // HTML list <ul><li>...</li></ul>

            $table->unique(['service_id', 'locale']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_translations');
        Schema::dropIfExists('services');
    }
};