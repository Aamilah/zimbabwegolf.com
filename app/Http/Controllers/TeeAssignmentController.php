<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournaments;
use App\Models\TournamentPlayer;
use App\Models\TeeAssignment;

class TeeAssignmentController extends Controller
{
    public function index(Request $request)
    {
        // Optional: filter by tournament if needed
        $tournaments = Tournaments::whereHas('tournamentPlayers')
            ->with('courseDetail') // if you want course info
            ->orderBy('start_date', 'asc')
            ->get();

        return view('admin.tee_assignments.index', compact('tournaments'));
    }
    public function create(Tournaments $tournament)
    {
        $players = TournamentPlayer::where('tournament_id', $tournament->id)->paginate(10);
        return view('admin.tee_assignments.create', compact('tournament', 'players'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'tournament_id' => 'required|exists:tournaments,id',
            'round_number' => 'required|integer|min:1',
            'tee_assignments' => 'required|array',
        ]);

        foreach ($request->tee_assignments as $assignment) {
            if (!empty($assignment['match_number']) && !empty($assignment['tee_number']) && !empty($assignment['tee_time'])) {
                TeeAssignment::create([
                    'tournament_id' => $request->tournament_id,
                    'round_number' => $request->round_number,
                    'tournament_player_id' => $assignment['tournament_player_id'],
                    'match_number' => $assignment['match_number'],
                    'tee_number' => $assignment['tee_number'],
                    'tee_time' => $assignment['tee_time'],
                ]);
            }
        }

        // ✅ Redirect to show after creation
        return redirect()->route('admin.tee_assignments.show', $request->tournament_id)
            ->with('success', 'Tee times successfully assigned.');
    }

    public function show(Tournaments $tournament, Request $request)
    {
        $selectedRound = $request->input('round') ??
            TeeAssignment::where('tournament_id', $tournament->id)->max('round_number');

        $teeAssignments = TeeAssignment::where('tournament_id', $tournament->id)
            ->where('round_number', $selectedRound)
            ->with('tournamentPlayer')
            ->orderBy('round_number')
            ->orderBy('match_number')
            ->orderBy('tee_time')
            ->orderBy('tee_number')
            ->get()
            ->groupBy(function($item) {
                return $item->round_number . '-' . $item->match_number . '-' . $item->tee_number . '-' . $item->tee_time;
            });

        $rounds = TeeAssignment::where('tournament_id', $tournament->id)
            ->distinct()
            ->orderBy('round_number')
            ->pluck('round_number');

        return view('admin.tee_assignments.show', compact(
            'tournament',
            'teeAssignments',
            'rounds',
            'selectedRound'
        ));
    }

    public function edit(Tournaments $tournament, Request $request)
    {
        $selectedRound = $request->input('round') ??
            TeeAssignment::where('tournament_id', $tournament->id)->max('round_number');

        $teeAssignments = TeeAssignment::where('tournament_id', $tournament->id)
            ->where('round_number', $selectedRound)
            ->with(['tournamentPlayer'])
            ->orderBy('match_number')
            ->orderBy('tee_time')
            ->orderBy('tee_number')
            ->get()
            ->groupBy(function($item) {
                return $item->round_number . '-' . $item->match_number . '-' . $item->tee_number . '-' . $item->tee_time;
            });

        $rounds = TeeAssignment::where('tournament_id', $tournament->id)
            ->distinct()
            ->orderBy('round_number')
            ->pluck('round_number');

        return view('admin.tee_assignments.edit', compact(
            'tournament',
            'teeAssignments',
            'rounds',
            'selectedRound'
        ));
    }

    public function update(Request $request, Tournaments $tournament)
    {
        $request->validate([
            'tee_assignments' => 'required|array',
            'tee_assignments.*.match_number' => 'required|integer|min:1',
            'tee_assignments.*.tee_number' => 'required|integer|min:1',
            'tee_assignments.*.tee_time' => 'required|date_format:H:i',
        ]);

        foreach ($request->tee_assignments as $id => $data) {
            $teeAssignment = TeeAssignment::findOrFail($id);
            $teeAssignment->update([
                'match_number' => $data['match_number'],
                'tee_number' => $data['tee_number'],
                'tee_time' => $data['tee_time'],
            ]);
        }

            if ($request->has('delete_tee_assignments')) {
        $idsToDelete = array_keys($request->delete_tee_assignments);
        TeeAssignment::whereIn('id', $idsToDelete)->delete();
    }

        return redirect()->route('admin.tee-assignments.show', [
            'tournament' => $tournament->id,
            'round' => $request->round_number
        ])
        ->with('success', 'Tee assignments updated successfully.');
    }




}
