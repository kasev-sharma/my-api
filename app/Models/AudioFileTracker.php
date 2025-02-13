<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AudioFileTracker extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'audio_file_tracker';

    protected $fillable = [
        'file_name',
        'file_path',
        'status',
        'error_message',
    ];
}
