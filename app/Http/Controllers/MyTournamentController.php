<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TournamentPlayer;

class MyTournamentController extends Controller
{
    public function index(Request $request)
    {
        $userName = $request->user()->name; 

        $today = now()->toDateString();

        $tournamentPlayer = TournamentPlayer::where('name', $userName)
            ->with(['tournament.courseDetail']) // add nested eager loading
            ->join('tournaments', 'tournaments.id', '=', 'tournament_players.tournament_id')
            ->orderByRaw("
                CASE
                    WHEN tournaments.start_date <= ? AND tournaments.end_date >= ? THEN 0
                    WHEN tournaments.start_date > ? THEN 1
                    ELSE 2
                END,
                tournaments.start_date ASC
            ", [$today, $today, $today])
            ->select('tournament_players.*')
            ->paginate(10);



        return view('admin.my_tournaments.index', compact('tournamentPlayer'));
    }
}
