<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'phone',
        'email',
        'operation_hours',
        'google_maps_url',
    ];
}
