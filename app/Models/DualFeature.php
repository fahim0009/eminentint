<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class DualFeature extends Model implements TranslatableContract
{
    use Translatable;

    protected $guarded = [];

    public $translatedAttributes = [
        'employer_tag', 'employer_title', 'employer_desc', 'employer_list', 'employer_btn_text',
        'jobseeker_tag', 'jobseeker_title', 'jobseeker_desc', 'jobseeker_list', 'jobseeker_btn_text'
    ];
}