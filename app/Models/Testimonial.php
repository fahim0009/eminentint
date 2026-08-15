<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Testimonial extends Model implements TranslatableContract
{
    use Translatable;

    protected $guarded = [];

    public $translatedAttributes = [
        'review_text', 'reviewer_name', 'reviewer_role'
    ];
}