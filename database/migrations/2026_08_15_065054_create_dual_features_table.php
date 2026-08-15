<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('dual_features', function (Blueprint $table) {
            $table->id();
            $table->string('employer_image')->nullable();
            $table->string('jobseeker_image')->nullable();
            $table->timestamps();
        });

        Schema::create('dual_feature_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dual_feature_id')->constrained()->cascadeOnDelete();
            $table->string('locale')->index();
            
            $table->string('employer_tag')->nullable();
            $table->string('employer_title')->nullable();
            $table->text('employer_desc')->nullable();
            $table->text('employer_list')->nullable(); // HTML <ul><li> list
            $table->string('employer_btn_text')->nullable();
            
            $table->string('jobseeker_tag')->nullable();
            $table->string('jobseeker_title')->nullable();
            $table->text('jobseeker_desc')->nullable();
            $table->text('jobseeker_list')->nullable(); // HTML <ul><li> list
            $table->string('jobseeker_btn_text')->nullable();

            $table->unique(['dual_feature_id', 'locale']);
        });
    }
    public function down()
    {
        Schema::dropIfExists('dual_feature_translations');
        Schema::dropIfExists('dual_features');
    }
};