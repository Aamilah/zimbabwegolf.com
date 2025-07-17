<x-admin :title="'Scores Overview'">
<x-alert type="success" />
    <div class="link-grid">
        <div class="col-span-2">
            <div class="link-grid-item">
                <div>
                    <div class="text-sm">Review Scores</div>
                    <div class="text-2xl font-semibold">See All Your Scores</div>
                    <a href="#leaderboard-table">
                        <div class="grid-link-btn">Explore More</div>
                    </a>
                </div>
                <div class="link-grid-icon">
                    <i class="fas fa-plus-circle text-xl"></i>
                </div>
            </div>
        </div>
        <div class="col-span-2">
            <div class="link-grid-item">
                <div>
                    <div class="text-sm">See Ranking</div>
                    <div class="text-2xl font-semibold">Check Out Current Leaderboard</div>
                    <a href="#leaderboard-table">
                        <div class="grid-link-btn">Explore More</div>
                    </a>
                </div>
                <div class="link-grid-icon">
                    <i class="fas fa-eye text-xl"></i>
                </div>
            </div>
        </div>
    </div>
    <div id="leaderboard-table">
        <x-table-bg-admin>
            <div class="table-wrapper">
                <table class="admin-table searchable-table">
                    <thead>
                        <tr>
                            <th>Tournament</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Venue</th>
                            <th>Rounds</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tournamentPlayers as $tournamentPlayer)
                            <tr>
                                <td>{{ $tournamentPlayer->tournament_title }}</td>
                                <td>{{ \Carbon\Carbon::parse($tournamentPlayer->start_date)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($tournamentPlayer->end_date)->format('d M Y') }}</td>
                                <td>{{ optional($tournamentPlayer->courseDetail)->name }}</td>
                                <td>{{ $tournamentPlayer->rounds }}</td>
                                <td>
                                    @if(\Carbon\Carbon::parse($tournamentPlayer->start_date)->isFuture())
                                        <span class="inline-block bg-blue-100 text-blue-600 text-xs px-2 py-1 rounded-full">Upcoming</span>
                                    @elseif(\Carbon\Carbon::parse($tournamentPlayer->end_date)->isPast())
                                        <span class="inline-block bg-green-100 text-green-600 text-xs px-2 py-1 rounded-full">Completed</span>
                                    @else
                                        <span class="inline-block bg-red-100 text-red-600 text-xs px-2 py-1 rounded-full">Ongoing</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.leaderboard.show', $tournamentPlayer->id) }}" class="w-10 h-10 bg-[#68d362] text-white rounded-full flex items-center justify-center">
                                    <i class="text-sm fa-solid fa-medal"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">No tournaments with players found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                </div>
            </div>
        </x-table-bg-admin>

    </div>
</x-admin>