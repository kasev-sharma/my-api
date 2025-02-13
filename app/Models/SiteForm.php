<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiteForm extends Model
{
    use HasFactory, SoftDeletes;

    // Define the table name (optional, Laravel will infer it by default)
    protected $table = 'site_forms';

    // Define the fillable attributes
    protected $fillable = [
        'site_name',
        'ups_rating',
        'battery_bank',
        'battery_capacity',
        'pg_gland',
        'thumbal',
        'nut_bolts',
        'farsher_quality',
        'battery_to_braker_cable',
        'braker_to_ups',
        'control_cable',
        'ups_to_pannel_cable',
        'images'
    ];

    // If you're using soft deletes, define the `deleted_at` column
    protected $dates = ['deleted_at'];
}
