<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class HeroSection extends Model implements TranslatableContract
{
    use Translatable;
    protected $guarded = [];
    
    public $translatedAttributes = [
        'title', 'subtitle', 'badge1_text', 'badge2_text', 
        'btn1_text', 'btn2_text', 'btn3_text'
    ];
}