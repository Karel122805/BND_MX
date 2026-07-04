<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResearchLine extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'sort_order',
        'is_active',
    ];
}