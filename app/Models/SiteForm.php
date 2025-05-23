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

    protected $fillable = [
        'user_id', 'customer_name', 'customer_mobile', 'site_address',
        'ups_make', 'ups_model', 'ups_rating', 'no_of_ups',
        'battery_bank', 'battery_ah', 'battery_volt', 'battery_type',
        'no_of_bank', 'no_of_battery', 'control_cable_in_meters',
        'pg_gland', 'thumbal', 'nut_bolts', 'images'
    ];

    protected $casts = [
        'images' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
