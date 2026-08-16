<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CandidateApplication extends Model
{
    protected $fillable = [
        'full_name', 'passport_number', 'phone', 'target_position', 
        'job_listing_id', 'destination_country', 'experience_level', 
        'passport_file', 'cv_file', 'tracking_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Generate Tracking ID like EM-2026-9921
            $model->tracking_id = 'EM-' . date('Y') . '-' . strtoupper(Str::random(6));
        });
    }
}