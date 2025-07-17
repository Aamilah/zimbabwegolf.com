<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournaments extends Model
{
    /** @use HasFactory<\Database\Factories\TournamentsFactory> */
    use HasFactory;

    protected $fillable = [
        'tournament_title',
        'presenter',
        'course_detail_id',
        'location_code',
        'start_date',
        'end_date',
        'entries_close',
        'rounds',
        'ladies_champ_handicap',
        'ladies_champ_fee',
        'ladies_net_handicap',
        'ladies_net_fee',
        'men_champ_handicap',
        'men_champ_fee',
        'men_net_handicap',
        'men_net_fee',
    ];

    public function courseDetail()
    {
        return $this->belongsTo(CourseDetail::class);
    }
    public function tournamentPlayers()
    {
        return $this->hasMany(TournamentPlayer::class, 'tournament_id');
    }

}
