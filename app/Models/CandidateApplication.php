<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CandidateApplication extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Generate Tracking ID like EM-2026-9921
            $model->tracking_id = 'EM-' . date('Y') . '-' . strtoupper(Str::random(6));
        });
    }
}