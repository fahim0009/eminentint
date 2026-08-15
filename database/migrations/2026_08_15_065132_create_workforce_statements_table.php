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
        Schema::create('workforce_statements', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(1); // changed to boolean for better practice
            $table->timestamps();
        });

        Schema::create('workforce_statement_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workforce_statement_id')->constrained()->cascadeOnDelete();
            $table->string('locale')->index();
            
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('btn1_text')->nullable();
            $table->string('btn2_text')->nullable();

            // Provided a shorter custom name 'ws_id_locale_unique' to avoid the 1059 error
            $table->unique(['workforce_statement_id', 'locale'], 'ws_id_locale_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop translations table FIRST because it has the foreign key
        Schema::dropIfExists('workforce_statement_translations');
        Schema::dropIfExists('workforce_statements');
    }
};