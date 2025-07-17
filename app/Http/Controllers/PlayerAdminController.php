<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournaments;
use App\Models\TournamentPlayer;
use App\Models\ScoreboardRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
use App\Models\User;
class PlayerAdminController extends Controller
{
    public function index(Request $request)
    {
        $tournament = Tournaments::where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->latest('start_date')
            ->first();

        if (!$tournament) {
            return view('admin.tournament-official-dashboard', [
                'message' => 'No ongoing tournament currently available.',
            ]);
        }

        $courseHoles = $tournament->courseDetail->holes()->orderBy('hole_number')->get();
        $rounds = range(1, $tournament->rounds);
        $holes = range(1, 18);

        $playersCollection = TournamentPlayer::where('tournament_id', $tournament->id)->get();

        $playerScores = ScoreboardRequest::where('tournament_id', $tournament->id)
            ->where('approved', true)
            ->get()
            ->groupBy(['tournament_player_id', 'round_number']);

        $totals = [];
        foreach ($playersCollection as $player) {
            foreach ($rounds as $round) {
                $totals[$player->id][$round] = isset($playerScores[$player->id][$round])
                    ? $playerScores[$player->id][$round]->sum('par')
                    : 0;
            }
        }

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

        // ✅ Show **only top 5** players
        $topPlayers = $playersCollection->take(5);

        $tournamentPlayers = new LengthAwarePaginator(
            $topPlayers,
            $topPlayers->count(),
            $topPlayers->count(), // no pagination
            1,
            [
                'path' => $request->url(),
                'query' => $request->query(),
            ]
        );

        $scores = ScoreboardRequest::where('tournament_id', $tournament->id)
            ->where('approved', true)
            ->get()
            ->groupBy(['tournament_player_id', 'round_number', 'hole_number']);

        $playerCount = User::where('department', 'player')->count();
                $tournamentCount = Tournaments::count();
        $today = Carbon::today();

        // Current tournament if any
        $currentTournament = Tournaments::whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->first();

        // Next 3 upcoming tournaments
        $upcomingTournaments = Tournaments::whereDate('start_date', '>=', $today)
            ->orderBy('start_date', 'asc')
            ->take(5)
            ->get();

        return view('admin.player-dashboard', compact(
            'tournament',
            'tournamentPlayers',
            'scores',
            'rounds',
            'holes',
            'totals',
            'latestProgress',
            'courseHoles',
            'playerCount',
            'tournamentCount',
            'currentTournament',
            'upcomingTournaments'
        ));
    }
}
