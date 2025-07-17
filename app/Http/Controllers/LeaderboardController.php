<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournaments;
use App\Models\TournamentPlayer;
use App\Models\ScoreboardRequest;
use Illuminate\Pagination\LengthAwarePaginator;

class LeaderboardController extends Controller
{

    public function index()
    {
       $tournamentPlayers = Tournaments::whereHas('tournamentPlayers.scoreboardRequests')
            ->with(['tournamentPlayers' => function($query) {
                $query->whereHas('scoreboardRequests')
                    ->with('scoreboardRequests');
            }])
            ->orderBy('start_date', 'asc')
            ->get();


        return view('admin.leaderboard.index', compact('tournamentPlayers'));
    }

    public function show(Request $request, $tournamentId)
    {
        $search = $request->input('search');

        // Load tournament with course detail and holes
        $tournament = Tournaments::with('courseDetail')->findOrFail($tournamentId);
        $courseHoles = $tournament->courseDetail->holes()->orderBy('hole_number')->get();
        $rounds = range(1, $tournament->rounds);
        $holes = range(1, 18);

        // Filter players by tournament and optional search
        $playerQuery = TournamentPlayer::where('tournament_id', $tournamentId);

        if ($search) {
            $playerQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('country', 'like', "%{$search}%");
            });
        }

        // Get all filtered players (no pagination yet)
        $playersCollection = $playerQuery->get();

        // Get all approved scores for tournament grouped by player and round
        $playerScores = ScoreboardRequest::where('tournament_id', $tournamentId)
            ->where('approved', true)
            ->get()
            ->groupBy(['tournament_player_id', 'round_number']);

        // Calculate totals per player per round
        $totals = [];
        foreach ($playersCollection as $player) {
            foreach ($rounds as $round) {
                $totals[$player->id][$round] = isset($playerScores[$player->id][$round])
                    ? $playerScores[$player->id][$round]->sum('par')
                    : 0;
            }
        }

        // Calculate latest progress per player
        $latestProgress = [];
        foreach ($playersCollection as $player) {
            if (isset($playerScores[$player->id])) {
                $latestRound = collect(array_keys($playerScores[$player->id]->toArray()))->max();
                $latestHole = isset($playerScores[$player->id][$latestRound])
                    ? $playerScores[$player->id][$latestRound]->max('hole_number')
                    : null;
            } else {
                $latestRound = null;
                $latestHole = null;
            }
            $latestProgress[$player->id] = [
                'round' => $latestRound,
                'hole' => $latestHole,
            ];
        }

        // Sort players by latest round DESC, latest hole DESC, lowest total par ASC
        $playersCollection = $playersCollection->sort(function ($a, $b) use ($latestProgress, $totals) {
            $roundA = $latestProgress[$a->id]['round'] ?? 0;
            $roundB = $latestProgress[$b->id]['round'] ?? 0;
            if ($roundA !== $roundB) {
                return $roundB <=> $roundA;  // descending
            }

            $holeA = $latestProgress[$a->id]['hole'] ?? 0;
            $holeB = $latestProgress[$b->id]['hole'] ?? 0;
            if ($holeA !== $holeB) {
                return $holeB <=> $holeA; // descending
            }

            $totalA = collect($totals[$a->id] ?? [])->sum() ?: PHP_INT_MAX;
            $totalB = collect($totals[$b->id] ?? [])->sum() ?: PHP_INT_MAX;
            return $totalA <=> $totalB; // ascending
        })->values();

        // Manual pagination
        $page = $request->get('page', 1);
        $perPage = 10;
        $totalCount = $playersCollection->count();
        $paginatedPlayers = $playersCollection->slice(($page - 1) * $perPage, $perPage)->values();

        $tournamentPlayers = new LengthAwarePaginator(
            $paginatedPlayers,
            $totalCount,
            $perPage,
            $page,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        // Get approved scores grouped by player, round, hole for the table
        $scores = ScoreboardRequest::where('tournament_id', $tournamentId)
            ->where('approved', true)
            ->get()
            ->groupBy(['tournament_player_id', 'round_number', 'hole_number']);

        // Pass everything to view
        return view('admin.leaderboard.show', compact(
            'tournament',
            'tournamentPlayers',
            'scores',
            'rounds',
            'holes',
            'totals',
            'latestProgress',
            'courseHoles',
            'search'
        ));
    }
}
