<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('gallery_categories', function (Blueprint $table) {
            $table->id();
            $table->string('icon_class')->default('bi-folder'); // e.g. bi-tools
            $table->string('slug')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('order')->default(1);
            $table->timestamps();
        });

        Schema::create('gallery_category_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_category_id')->constrained('gallery_categories')->onDelete('cascade');
            $table->string('locale')->index();
            $table->string('name'); // e.g. Trade Testing & Evaluation
            $table->unique(['gallery_category_id', 'locale']);
        });
    }
    public function down()
    {
        Schema::dropIfExists('gallery_category_translations');
        Schema::dropIfExists('gallery_categories');
    }
};