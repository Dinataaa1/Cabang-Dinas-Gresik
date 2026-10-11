<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'location',
        'activity_date', 'category', 'images', 'cover_image',
        'is_published', 'views',
    ];

    protected $casts = [
        'images'        => 'array',
        'activity_date' => 'date',
        'is_published'  => 'boolean',
    ];
}
