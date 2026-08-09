<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyLicenseTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'company_license_translations';
    protected $guarded = [];
}