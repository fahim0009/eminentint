<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobListingTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'job_listings_translations';
    protected $guarded = [];
}