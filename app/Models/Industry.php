<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Industry extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'industries';
    protected $guarded = [];

    public $translatedAttributes = [
        'title', 'description', 'button_text'
    ];
}