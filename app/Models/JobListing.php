<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class JobListing extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'job_listings';
    protected $guarded = [];

    public $translatedAttributes = [
        'title', 'company_name', 'salary', 'benefits', 'requirements'
    ];
}