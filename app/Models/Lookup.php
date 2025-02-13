<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lookup extends Model
{
    use HasFactory, SoftDeletes;

    // Specify the table name (optional, Laravel will infer it as 'lookups' by default)
    protected $table = 'lookups';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'lookup_type',
        'lookup_code',
        'lookup_value',
        'sequence',
        'is_deleted'
    ];

    // If you're using soft deletes, define the `deleted_at` column
    protected $dates = ['deleted_at'];
}
