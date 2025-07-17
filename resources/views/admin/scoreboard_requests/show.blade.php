<x-admin :title="'Scores Overview for '">
    <x-alert type="success" />
    <div>
        <div class="z-50 absolute right-16 flex flex-row gap-2">
            <a href="{{ route('admin.leaderboard.show', $tournament->id) }}"
                    class="w-10 h-10 bg-[#68d362] text-white rounded-full flex items-center justify-center">
                <i class="text-sm fa-solid fa-medal"></i>
            </a>
            <x-home-button/>
            <x-back-button/>
            
        </div>
        <x-table-bg-admin>
            <div class="table-wrapper">
                <table class="admin-table searchable-table">
                    <thead class="text-[0.8rem]">
                        <tr>
                            <th>Name</th>
                            <th>Round</th>
                            @foreach($holes as $hole)
                                <th>{{ $hole }}</th>
                            @endforeach
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-[0.8rem]">
                        @forelse($tournamentPlayers as $player)
                            @foreach($rounds as $round)
                                <tr>
                                    @if ($loop->first)
                                        <td rowspan="{{ count($rounds) }}" class="align-top font-semibold">{{ $player->name }}</td>
                                    @endif
                                    <td>{{ $round }}</td>
                                    @foreach($holes as $hole)
                                        <td class="text-center
                                            @if(isset($scores[$player->id][$round][$hole]) && $scores[$player->id][$round][$hole]->first()->approved)
                                                bg-green-100
                                            @endif">
                                            @if(isset($scores[$player->id][$round][$hole]))
                                                {{ $scores[$player->id][$round][$hole]->first()->par }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    @endforeach

                                    <td class="flex flex-wrap gap-1">
                                        <form action="{{ route('admin.scoreboard-requests.approve', [$tournament->id, $player->id, $round]) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="w-10 h-10 bg-[#68d362] text-white rounded-full flex items-center justify-center"
                                                onclick="return confirm('Are you sure you want to approve this round and send to leaderboard?')">
                                                <i class="text-sm fa-solid fa-check"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="{{ 2 + count($holes) }}" class="text-center py-4">No players with scores found for this tournament.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-table-bg-admin>
    </div>
</x-admin>
