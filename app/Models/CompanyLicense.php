<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class CompanyLicense extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'company_licenses';
    protected $guarded = [];

    public $translatedAttributes = [
        'status_badge', 'prefix_badge', 'title', 'description', 'reg_detail'
    ];
}