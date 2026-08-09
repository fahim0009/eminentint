<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_category_id')->constrained('gallery_categories')->onDelete('cascade');
            $table->enum('media_type', ['image', 'video', 'youtube'])->default('image');
            $table->string('media_url')->nullable(); // Stores file path or YouTube URL/ID
            $table->string('location')->nullable();
            $table->date('media_date')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('order')->default(1);
            $table->timestamps();
        });

        Schema::create('gallery_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_id')->constrained('galleries')->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unique(['gallery_id', 'locale']);
        });
    }
    public function down()
    {
        Schema::dropIfExists('gallery_translations');
        Schema::dropIfExists('galleries');
    }
};