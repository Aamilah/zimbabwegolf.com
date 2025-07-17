<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournaments; 
use App\Models\TournamentPlayer;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Auth;

class PlayerTournamentController extends Controller
{
    public function index(){
        $today = Carbon::today()->toDateString();

        $tournaments = Tournaments::where('entries_close', '>', $today)
            ->with('courseDetail')
            ->orderBy('entries_close', 'asc')
            ->paginate(10);

        $signedUpTournamentIds = TournamentPlayer::where('name', Auth::user()->name)
            ->pluck('tournament_id')
            ->toArray();

        return view('admin.player_tournament.index', compact('tournaments', 'signedUpTournamentIds'));
    }

    public function create(Tournaments $tournament)
    {
        return view('admin.player_tournament.create', compact('tournament'));
    }


    public function store(Request $request) {

        $validated = $request->validate([
            'country' => 'nullable|string|max:255',
            'player_type' => 'required|in:professional,amateur',
            'gender' => 'required|in:male,female',
            'tournament_id' => 'required|exists:tournaments,id',
        ]);

        $validated['name'] = Auth::user()->name;

        $exists = TournamentPlayer::where('tournament_id', $validated['tournament_id'])
            ->where('name', $validated['name'])
            ->exists();

        if ($exists) {
            return back()
                ->withErrors(['name' => 'You have already signed up for this tournament.'])
                ->withInput();
        }

        TournamentPlayer::create($validated);

        return redirect()->route('admin.player-tournaments.index')
                        ->with('success', 'You have successfully signed up for the tournament.');
    }

}
