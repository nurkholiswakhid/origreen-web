<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
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
