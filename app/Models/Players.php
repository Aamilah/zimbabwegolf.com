<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    /** @use HasFactory<\Database\Factories\PlayersFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'date_of_birth',
        'place_of_birth',
        'handicap',
        'club',
        'achievements',
        'owar',
        'total_tournaments',
        'image_path',
    ];
}
