<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Players; // Ensure you have the correct model namespace
use Illuminate\Support\Facades\Storage;

class PlayerController extends Controller
{
    public function create()
    {
        return view('admin.players.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|string|max:255',
            'handicap' => 'required|string|max:255',
            'club' => 'required|string|max:255',
            'achievements' => 'nullable|string|max:1000',
            'owar' => 'required|integer|min:0',
            'total_tournaments' => 'required|integer|min:0',
            'image_path' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = $request->file('image_path')->store('players', 'public');
        }

        Players::create($validated);

        return redirect()->route('admin.players.index')->with('success', 'Player added successfully.');
    }

    public function show(Players $player) {
      // route --> /ninjas/{id}
      return view('admin.players.show', ['player' => $player]);
    }

    public function edit(Players $player)
    {
      return view('admin.players.edit', ['player' => $player]);
    }

    public function update(Request $request, Players $player)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|string|max:255',
            'handicap' => 'required|string|max:255',
            'club' => 'required|string|max:255',
            'achievements' => 'nullable|string|max:1000',
            'owar' => 'required|integer|min:0',
            'total_tournaments' => 'required|integer|min:0',
            'image_path' => 'nullable|image|max:2048',
        ]);
        
        if ($request->hasFile('image_path')) {
            if (!empty($player->image_path) && Storage::disk('public')->exists($player->image_path)) {
                Storage::disk('public')->delete($player->image_path);
            }

            $validated['image_path'] = $request->file('image_path')->store('players', 'public');
        }
    

        $player->update($validated);

        return redirect()->route('admin.players.show', ['player' => $player])->with('success', 'Player Information updated successfully.');
    }

    public function destroy(Players $player)
    {
        if (!empty($player->image_path) && Storage::disk('public')->exists($player->image_path)) {
            Storage::disk('public')->delete($player->image_path);
        }

        $player->delete();

        return redirect()->route('admin.players.index')->with('success', 'Player has been deleted!');
    }

}
