<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentPlayer extends Model
{
    /** @use HasFactory<\Database\Factories\TournamentPlayerFactory> */
    use HasFactory;
    protected $fillable = [
        'tournament_id',
        'name',
        'country',
        'player_type',
        'gender',
    ];

    
    public function tournament()
    {
        return $this->belongsTo(Tournaments::class, 'tournament_id');
    }

    public function scoreboardRequests()
    {
        return $this->hasMany(ScoreboardRequest::class, 'tournament_player_id');
    }
}
