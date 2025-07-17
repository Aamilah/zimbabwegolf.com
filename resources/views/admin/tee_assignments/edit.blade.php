<x-admin :title="'Edit Tee Assignments for ' . $tournament->tournament_title">
    <x-alert type="success" />
    <div>
        <div class="z-50 absolute right-16 flex flex-row gap-2">
            <x-home-button/>
            <x-back-button/>
        </div> 

        <div class="inverted-radius my-5 relative">
            <div class="inverted-radius-content">
                <div class="flex flex-wrap items-center gap-2 mb-4">
                    <div class="search-tab">
                        <input type="text" placeholder="Search" class="search-input table-search" />
                        <span class="search-icon"><i class="fas fa-search"></i></span>
                    </div>
                    @foreach ($rounds as $round)
                        <a href="{{ route('admin.tee-assignments.edit', [$tournament, 'round' => $round]) }}">
                            <button class="filter-tab {{ $round == $selectedRound ? 'active' : '' }}">
                                Round {{ $round }}
                            </button>
                        </a>
                    @endforeach
                </div>

                <form method="POST" action="{{ route('admin.tee-assignments.update', $tournament->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="round_number" value="{{ $selectedRound }}">
                    <input type="hidden" name="tournament_id" value="{{ $tournament->id }}">

                    <div class="table-wrapper">
                        <table class="admin-table searchable-table">
                            <thead>
                                <tr>
                                    <th>Round</th>
                                    <th>Match</th>
                                    <th>Tee</th>
                                    <th>Tee Time</th>
                                    <th>Player</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($teeAssignments as $groupKey => $assignments)
                                    @php
                                        [$round, $match, $tee, $time] = explode('-', $groupKey);
                                    @endphp
                                    @foreach ($assignments as $assignment)
                                        <tr>
                                            <td>{{ $round }}</td>
                                            <td>
                                                <input type="number" name="tee_assignments[{{ $assignment->id }}][match_number]" value="{{ $assignment->match_number }}" class="input-field w-16">
                                            </td>
                                            <td>
                                                <input type="number" name="tee_assignments[{{ $assignment->id }}][tee_number]" value="{{ $assignment->tee_number }}" class="input-field w-16">
                                            </td>
                                            <td>
                                                <input type="time" name="tee_assignments[{{ $assignment->id }}][tee_time]" value="{{ \Carbon\Carbon::parse($assignment->tee_time)->format('H:i') }}" class="input-field">
                                            </td>
                                            <td>
                                                {{ $assignment->tournamentPlayer->name }}
                                                @if (ucfirst($assignment->tournamentPlayer->player_type) === 'Amateur')
                                                    <span class="text-black">(a)</span>
                                                @endif
                                            </td>
                                            <td class="flex flex-wrap gap-2">
                                                <button type="submit" class="bg-[#68d362] text-white rounded-full flex items-center justify-center text-sm px-2 py-1 hover:bg-green-800">
                                                    Save
                                                </button>
                                                <div class="red-bg text-white rounded-full flex items-center justify-center text-sm px-2 py-1 hover:bg-green-800">
                                                    <label class="flex items-center gap-1 text-xs">
                                                        <input type="checkbox" name="delete_tee_assignments[{{ $assignment->id }}]" class="accent-red-500">
                                                        Delete
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No tee assignments for this tournament and round yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin>
