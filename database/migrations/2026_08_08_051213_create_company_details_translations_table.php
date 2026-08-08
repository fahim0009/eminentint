<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. Main Table (Non-translatable fields)
        Schema::create('company_details', function (Blueprint $table) {
            $table->id();
            $table->string('email1')->nullable();
            $table->string('email2')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('phone3')->nullable();
            $table->string('phone4')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('website')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->string('tawkto')->nullable();
            $table->string('vat_percent')->nullable();
            $table->string('google_appstore_link')->nullable();
            $table->string('google_play_link')->nullable();
            $table->string('currency')->nullable();
            $table->text('google_map')->nullable();
            $table->string('company_reg_number')->nullable();
            $table->string('vat_number')->nullable();
            $table->string('opening_time')->nullable();
            $table->string('account_number')->nullable();
            $table->string('sort_code')->nullable();
            $table->string('bank')->nullable();
            $table->string('fav_icon')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('footer_logo')->nullable();
            $table->string('google_site_verification')->nullable();
            $table->string('meta_image')->nullable();
            $table->timestamps();
        });

        // 2. Translations Table (Translatable fields)
        Schema::create('company_details_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_details_id')->constrained('company_details')->onDelete('cascade');
            $table->string('locale')->index();
            
            // Translatable fields
            $table->string('company_name')->nullable();
            $table->string('business_name')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->longText('footer_content')->nullable();
            $table->longText('home_footer')->nullable();
            $table->longText('privacy_policy')->nullable();
            $table->longText('terms_and_conditions')->nullable();
            $table->longText('mail_body')->nullable();
            $table->string('copyright')->nullable();
            $table->string('footer_link')->nullable();
            $table->longText('header_content')->nullable();
            $table->longText('about_us')->nullable();
            $table->longText('bank_info')->nullable();
            $table->longText('email_bank_info')->nullable();
            $table->string('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();

            $table->unique(['company_details_id', 'locale']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_details_translations');
        Schema::dropIfExists('company_details');
    }
};