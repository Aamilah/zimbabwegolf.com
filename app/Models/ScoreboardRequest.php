<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreboardRequest extends Model
{
    /** @use HasFactory<\Database\Factories\ScoreboardRequestFactory> */
    use HasFactory;
    protected $fillable = [
        'tournament_id',
        'tournament_player_id',
        'round_number',
        'hole_number',
        'par',
    ];

    public function tournament()
    {
        return $this->belongsTo(Tournaments::class, 'tournament_id');
    }
}
