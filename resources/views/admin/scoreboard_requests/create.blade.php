<x-admin :title="'Add Scores'">
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
                <form action="{{ route('admin.scoreboard-requests.store', $tournament->id) }}" method="POST" >
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
                        <input
                            type="text"
                            class="form-input bg-gray-100 cursor-not-allowed"
                            value="{{ $tournament->tournament_title }}"
                            disabled
                        >
                        <input
                            type="hidden"
                            name="tournament_id"
                            value="{{ $tournament->id }}"
                        >
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Player Name</label>
                        <input
                            type="text"
                            class="form-input bg-gray-100 cursor-not-allowed"
                            value="{{ Auth::user()->name }}"
                            disabled
                        >
                        <input type="hidden" name="tournament_player_id" value="{{ $tournamentPlayer->id }}">
                    </div>
                    <div class="table-wrapper">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Hole</th>
                                    @foreach ($rounds as $round)
                                        <th>Round {{ $round }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($holeNumbers as $hole)
                                    <tr>
                                        <td> {{ $hole }}</td>
                                        @foreach ($rounds as $round)
                                            @php
                                                $existingScore = $existingScores[$round][$hole] ?? null;
                                                $existingPar = $existingScore->par ?? null;
                                                $isApproved = $existingScore && $existingScore->approved;
                                            @endphp
                                            <td>
                                                <input type="hidden" name="holes[{{ $hole }}][{{ $round }}][hole_number]" value="{{ $hole }}">
                                                <input type="hidden" name="holes[{{ $hole }}][{{ $round }}][round_number]" value="{{ $round }}">
                                                <input
                                                    type="number"
                                                    name="holes[{{ $hole }}][{{ $round }}][par]"
                                                    class="w-60 text-center border rounded py-2 {{ $isApproved ? 'bg-gray-200 cursor-not-allowed' : '' }}"
                                                    value="{{ old("holes.$hole.$round.par", $existingPar) }}"
                                                    placeholder="Leave empty if not played"
                                                    @if($isApproved) disabled @endif
                                                >
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="my-4"><button class="green-red-btn">Submit Scoreboard Request <span><i class="fa-solid fa-arrow-up fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i></span></button></div>
                </form>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputs = Array.from(document.querySelectorAll('input[type="number"]'));

        inputs.forEach((input, index) => {
            input.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();

                    // Focus next input if it exists
                    const nextInput = inputs[index + 1];
                    if (nextInput) {
                        nextInput.focus();
                    }
                }
            });
        });
    });
</script>

</x-admin>
