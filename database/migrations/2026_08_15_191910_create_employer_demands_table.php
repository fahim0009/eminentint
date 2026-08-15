<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employer_demands', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('destination_country')->nullable();
            $table->string('occupation')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('salary')->nullable();
            $table->string('accommodation')->nullable();
            $table->string('status')->default('new'); // For admin tracking (new, contacted, closed)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employer_demands');
    }
};