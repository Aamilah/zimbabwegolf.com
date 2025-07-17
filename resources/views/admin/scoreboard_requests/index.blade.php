<x-admin :title="'Scores Overview'">
<x-alert type="success" />
    <div class="link-grid">
        <div class="col-span-1">
            <div class="link-grid-item">
                <div>
                    <div class="text-sm">Manage Tee Times</div>
                    <div class="text-2xl font-semibold">Assign Tee Times</div>
                    <a href="{{ route('admin.tournaments.index') }}">
                        <div class="grid-link-btn">Explore More</div>
                    </a>
                </div>
                <div class="link-grid-icon">
                    <i class="fas fa-plus-circle text-xl"></i>
                </div>
            </div>
        </div>
        <div class="col-span-1">
            <div class="link-grid-item">
                <div>
                    <div class="text-sm">Manage Tee Times</div>
                    <div class="text-2xl font-semibold">View Assigned Times</div>
                    <a href="#teeTable">
                        <div class="grid-link-btn">Explore More</div>
                    </a>
                </div>
                <div class="link-grid-icon">
                    <i class="fas fa-eye text-xl"></i>
                </div>
            </div>
        </div>
        <div class="col-span-1">
            <div class="link-grid-item">
                <div>
                    <div class="text-sm">Add to Database</div>
                    <div class="text-2xl font-semibold">Update Assigned Times</div>
                    <a href="#teeTable">
                        <div class="grid-link-btn">Explore More</div>
                    </a>
                </div>
                <div class="link-grid-icon">
                    <i class="fas fa-calendar-alt text-xl"></i>
                </div>
            </div>
        </div>
        <div class="col-span-1">
            <div class="link-grid-item">
                <div>
                    <div class="text-sm">Add to Website</div>
                    <div class="text-2xl font-semibold">Delete A Tournament</div>
                    <a href="#teeTable">
                        <div class="grid-link-btn">Explore More</div>
                    </a>
                </div>
                <div class="link-grid-icon">
                    <i class="fas fa-history text-xl"></i>
                </div>
            </div>
        </div>
    </div>
    <div id="teeTable">
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
                                    <a href="{{ route('admin.scoreboard-requests.show', $tournamentPlayer->id) }}" class="w-10 h-10 bg-[#68d362] text-white rounded-full flex items-center justify-center">
                                    <i class="text-sm fa-solid fa-eye"></i>
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