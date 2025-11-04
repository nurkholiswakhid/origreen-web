<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'title',
        'image_url',
        'subtitle',
        'description',
        'stats_visitor',
        'stats_rating',
    ];

    protected $casts = [
        'stats_visitor' => 'json',
        'stats_rating' => 'json',
    ];
}
