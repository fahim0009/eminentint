<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Country extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'countries';
    protected $guarded = [];

    public $translatedAttributes = [
        'name', 'short_name', 'description', 'current_demand', 'visa_process', 'job_link'
    ];
}