<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;


/**
 * @method static \App\Models\CompanyDetails first()
 * @method static \Illuminate\Database\Eloquent\Builder where(string $column, string $operator, mixed $value)
 * @method static \Illuminate\Database\Eloquent\Collection get()
 * @method static \App\Models\CompanyDetails find(int $id)
 * @method static \App\Models\CompanyDetails create(array $attributes)
 */

class CompanyDetails extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'company_details';
    protected $guarded = [];

 
    public $translatedAttributes = [
        'company_name', 'business_name', 'address1', 'address2', 
        'footer_content', 'home_footer', 'privacy_policy', 
        'terms_and_conditions', 'mail_body', 'copyright', 
        'footer_link', 'header_content', 'about_us', 
        'bank_info', 'email_bank_info', 'meta_title', 
        'meta_description', 'meta_keywords'
    ];
}
