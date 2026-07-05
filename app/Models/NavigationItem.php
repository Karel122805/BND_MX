<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavigationItem extends Model
{
    protected $fillable = [
        'label',
        'route_name',
        'url',
        'sort_order',
        'opens_new_tab',
        'is_active',
    ];
}