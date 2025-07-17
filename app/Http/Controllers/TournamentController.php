<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournaments; 
use App\Models\CourseDetail;
use App\Models\TournamentPlayer;
class TournamentController extends Controller
{
    public function create()
    {
        $course_details_id = CourseDetail::orderBy('name')->get();
        return view('admin.tournaments.create', compact('course_details_id'));
    }

    public function store(Request $request) {
      // --> /tournaments/ (POST)
      $validated = $request->validate([
        'tournament_title' => 'required|string|max:255',
        'presenter' => 'required|string|max:255',
        'course_detail_id' => 'required|exists:course_details,id',
        'location_code' => 'nullable|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',        
        'entries_close' => 'required|date',
        'rounds' => 'required|integer|min:1|max:10',
        'ladies_champ_handicap' => 'nullable|string|max:255',
        'ladies_champ_fee' => 'nullable|numeric|min:0|max:1000',
        'ladies_net_handicap' => 'nullable|string|max:255',
        'ladies_net_fee' => 'nullable|numeric|min:0|max:1000',
        'men_champ_handicap' => 'nullable|string|max:255',
        'men_champ_fee' => 'nullable|numeric|min:0|max:1000',
        'men_net_handicap' => 'nullable|string|max:255',
        'men_net_fee' => 'nullable|numeric|min:0|max:1000',
      ]);

      Tournaments::create($validated);

      return redirect()->route('admin.tournaments.index')->with('success', 'Tournament Created!');
    }

    public function show(Tournaments $tournament) {
      // route --> /ninjas/{id}
      return view('admin.tournaments.show', ['tournament' => $tournament]);
    }

    public function edit(Tournaments $tournament)
    {
      $course_details_id = CourseDetail::all(); 
      return view('admin.tournaments.edit', compact('tournament','course_details_id'));
    }

    public function update(Request $request, Tournaments $tournament)
    {
        $validated = $request->validate([
          'tournament_title' => 'required|string|max:255',
          'presenter' => 'required|string|max:255',
          'course_detail_id' => 'required|exists:course_details,id',
          'location_code' => 'nullable|string|max:255',
          'start_date' => 'required|date',
          'end_date' => 'required|date|after_or_equal:start_date',        
          'entries_close' => 'required|date',
          'rounds' => 'required|integer|min:1|max:10',
          'ladies_champ_handicap' => 'nullable|string|max:255',
          'ladies_champ_fee' => 'nullable|numeric|min:0|max:1000',
          'ladies_net_handicap' => 'nullable|string|max:255',
          'ladies_net_fee' => 'nullable|numeric|min:0|max:1000',
          'men_champ_handicap' => 'nullable|string|max:255',
          'men_champ_fee' => 'nullable|numeric|min:0|max:1000',
          'men_net_handicap' => 'nullable|string|max:255',
          'men_net_fee' => 'nullable|numeric|min:0|max:1000',
        ]);

        $tournament->update($validated);

        return redirect()->route('admin.tournaments.show', ['tournament' => $tournament])->with('success', 'Tournament updated successfully.');
    }

    public function destroy(Tournaments $tournament) {
      $tournament->delete();

      return redirect()->route('admin.tournaments.index')->with('success', 'Tournament is Deleted!');
    }

    public function showPlayers(Tournaments $tournament)
    {
        $players = TournamentPlayer::where('tournament_id', $tournament->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.tournaments.players', compact('tournament', 'players'));
    }

}
