<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class About extends Model implements TranslatableContract
{
    use Translatable;
    protected $guarded = [];
    
    public $translatedAttributes = [
        'hero_title', 'hero_desc', 'company_tag', 'company_title', 'company_content1', 
        'company_content2', 'stat1_label', 'stat2_label', 'mvv_tag', 'mvv_title', 
        'vision_title', 'vision_content', 'mission_title', 'mission_content', 
        'why_title', 'why_content', 'chairman_tag', 'chairman_title', 'chairman_quote',
        'ceo_tag', 'ceo_title', 'ceo_quote', 'timeline_tag', 'timeline_title'
    ];
}