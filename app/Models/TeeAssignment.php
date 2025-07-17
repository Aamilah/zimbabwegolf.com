<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeeAssignment extends Model
{
    /** @use HasFactory<\Database\Factories\TeeAssignmentFactory> */
    use HasFactory;

    protected $fillable = [
        'tournament_id',
        'match_number',
        'tee_time',
        'tee_number',
        'round_number',
        'tournament_player_id',
    ];

    /**
     * Get the tournament this tee assignment belongs to.
     */
    public function tournament()
    {
        return $this->belongsTo(Tournaments::class);
    }

    /**
     * Get the tournament player assigned to this tee.
     */
    public function tournamentPlayer()
    {
        return $this->belongsTo(TournamentPlayer::class);
    }
}
