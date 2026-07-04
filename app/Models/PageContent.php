<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    protected $fillable = [
        'page_key',
        'section_key',
        'title',
        'subtitle',
        'content',
        'image',
        'sort_order',
        'is_active',
    ];
}