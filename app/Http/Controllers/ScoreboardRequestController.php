<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScoreboardRequest;
use App\Models\Tournaments;
use App\Models\TournamentPlayer;
use Illuminate\Support\Facades\Auth;

class ScoreboardRequestController extends Controller
{
    public function index(Request $request)
    {
       $tournamentPlayers = Tournaments::whereHas('tournamentPlayers.scoreboardRequests')
            ->with(['tournamentPlayers' => function($query) {
                $query->whereHas('scoreboardRequests')
                    ->with('scoreboardRequests');
            }])
            ->orderBy('start_date', 'asc')
            ->get();


        return view('admin.scoreboard_requests.index', compact('tournamentPlayers'));
    }
public function create($tournamentId, $playerId = null)
{
    $tournament = Tournaments::findOrFail($tournamentId);

    if ($playerId) {
        $tournamentPlayer = TournamentPlayer::findOrFail($playerId);
    } else {
        $tournamentPlayer = TournamentPlayer::where('tournament_id', $tournamentId)
            ->where('name', Auth::user()->name)
            ->firstOrFail();
    }

    $holeNumbers = range(1, 18);
    $rounds = range(1, $tournament->rounds);

    $existingScores = ScoreboardRequest::where('tournament_id', $tournamentId)
        ->where('tournament_player_id', $tournamentPlayer->id)
        ->get()
        ->groupBy('round_number')
        ->map(fn($roundGroup) => $roundGroup->keyBy('hole_number'));

    return view('admin.scoreboard_requests.create', compact(
        'tournament',
        'tournamentPlayer',
        'holeNumbers',
        'rounds',
        'existingScores'
    ));
}


    public function store(Request $request)
    {
        $validated = $request->validate([
            'tournament_id' => 'required|exists:tournaments,id',
            'tournament_player_id' => 'required|exists:tournament_players,id',
            'holes' => 'required|array',
            'holes.*.*.hole_number' => 'required|integer|between:1,18',
            'holes.*.*.round_number' => 'required|integer|min:1',
            'holes.*.*.par' => 'nullable|integer',
        ]);

        foreach ($validated['holes'] as $holeGroup) {
            foreach ($holeGroup as $roundData) {
                // Check if 'par' key exists and has a non-empty value
                if (!array_key_exists('par', $roundData) || $roundData['par'] === null || $roundData['par'] === '') {
                    // Skip missing/empty scores
                    continue;
                }

                // Check if this score is already approved
                $existing = ScoreboardRequest::where('tournament_id', $validated['tournament_id'])
                    ->where('tournament_player_id', $validated['tournament_player_id'])
                    ->where('round_number', $roundData['round_number'])
                    ->where('hole_number', $roundData['hole_number'])
                    ->first();

                if ($existing && $existing->approved) {
                    // Skip updating approved scores
                    continue;
                }

                // Create or update the score
                ScoreboardRequest::updateOrCreate(
                    [
                        'tournament_id' => $validated['tournament_id'],
                        'tournament_player_id' => $validated['tournament_player_id'],
                        'round_number' => $roundData['round_number'],
                        'hole_number' => $roundData['hole_number'],
                    ],
                    [
                        'par' => $roundData['par']
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Scores submitted successfully (only unapproved and filled scores were saved).');
    }

    public function show($tournamentId)
    {
        $tournament = Tournaments::with('courseDetail') // if you need course info
            ->findOrFail($tournamentId);

        // Get all players for this tournament
        $tournamentPlayers = TournamentPlayer::where('tournament_id', $tournamentId)
            ->get();

        // Fetch all scores grouped by player -> round -> hole
        $scores = ScoreboardRequest::where('tournament_id', $tournamentId)
            ->get()
            ->groupBy([
                'tournament_player_id',
                'round_number',
                'hole_number'
            ]);

        $rounds = range(1, $tournament->rounds);
        $holes = range(1, 18);

        return view('admin.scoreboard_requests.show', compact(
            'tournament',
            'tournamentPlayers',
            'scores',
            'rounds',
            'holes'
        ));
    }

public function approve(Request $request, $tournamentId, $playerId, $round)
{
    ScoreboardRequest::where('tournament_id', $tournamentId)
        ->where('tournament_player_id', $playerId)
        ->where('round_number', $round)
        ->whereNotNull('score') // or 'par', or whichever field holds the actual score
        ->update(['approved' => true]);

    return redirect()->back()->with('success', 'Available scores approved for leaderboard.');
}


}
