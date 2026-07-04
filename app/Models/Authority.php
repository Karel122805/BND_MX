<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Authority extends Model
{
    protected $fillable = [
        'name',
        'position',
        'institution',
        'photo',
        'description',
        'sort_order',
        'is_active',
    ];
}