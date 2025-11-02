<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_url',
        'button1_text',
        'button1_url',
        'button2_text',
        'button2_url',
    ];
}
