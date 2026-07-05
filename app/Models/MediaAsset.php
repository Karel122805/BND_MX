<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaAsset extends Model
{
    protected $fillable = [
        'name',
        'key',
        'file',
        'alt',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}