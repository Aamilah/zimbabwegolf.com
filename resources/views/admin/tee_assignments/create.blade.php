<x-admin :title="'Assign Tee Times to ' . $tournament->name">
    <div>
        <div class="z-50 absolute right-16 flex flex-row gap-2">
            <x-home-button/>
            <x-back-button/>
        </div>
        <div class="inverted-radius my-5 relative">
            <div class="inverted-radius-content">
                <div class="flex flex-wrap items-center gap-2 mb-4">
                    <div class="frame-dot green-bg"></div>
                    <div class="frame-dot gold-bg"></div>
                    <div class="frame-dot red-bg"></div>
                </div>
            <div class="frame-wrapper">
                <form action="{{ route('admin.tee-assignments.store', $tournament->id) }}" method="POST" >
                    @csrf
                    @if ($errors->any())
                        <ul class="px-4 py-2 bg-red-100">
                            @foreach ($errors->all() as $error)
                            <li class="my-2 text-red-500">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
        
                    <div class="mb-4">
                        <label class="form-label">Tournament</label>
                        {{-- Visible, disabled input showing the tournament name --}}
                        <input
                            type="text"
                            class="form-input bg-gray-100 cursor-not-allowed"
                            value="{{ $tournament->tournament_title }}"
                            disabled
                        >
                        {{-- Hidden input containing the actual ID to be submitted --}}
                        <input
                            type="hidden"
                            name="tournament_id"
                            value="{{ $tournament->id }}"
                        >
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Round Number</label>
                        <input type="number" name="round_number" required class="form-input">
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Player Name</th>
                                <th>Player Type</th>
                                <th>Match Number</th>
                                <th>Tee Number</th>
                                <th>Tee Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($players as $player)
                                <tr>
                                    <td>{{ $player->name }}</td>
                                    <td>{{ ucfirst($player->player_type) }}</td>
                                    <td>
                                        <input type="hidden" name="tee_assignments[{{ $player->id }}][tournament_player_id]" value="{{ $player->id }}" required>
                                        <input type="number" name="tee_assignments[{{ $player->id }}][match_number]" class="form-input" required>
                                    </td>
                                    <td>
                                        <input type="number" name="tee_assignments[{{ $player->id }}][tee_number]" class="form-input" required>
                                    </td>
                                    <td>
                                        <input type="time" name="tee_assignments[{{ $player->id }}][tee_time]" class="form-input" required>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No players registered for this tournament.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $players->links('vendor.pagination.adminpagination') }}
                    </div>
                    <div class="my-4"><button class="green-red-btn">Assign Tee Times for {{ $tournament->tournament_title }} <span><i class="fa-solid fa-arrow-up fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i></span></button></div>
                </form>
            </div>
        </div>
    </div>
</x-admin>
