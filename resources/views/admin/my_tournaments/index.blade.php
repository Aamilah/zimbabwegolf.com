<x-admin>
    <x-alert type="success" />
      <div class="grid grid-cols-4 gap-4">
        <div>
            <div class="link-grid-item">
                <div>
                    <div class="text-sm">View</div>
                    <div class="text-2xl font-semibold">View Your Tee Times</div>
                    <a href="">
                        <div class="grid-link-btn">
                            Explore More
                        </div>
                    </a>
                </div>
                <div class="link-grid-icon">
                    <i class="fas fa-calendar text-xl"></i>
                </div>
            </div>
        </div>
        <div>
            <div class="link-grid-item">
                <div>
                    <div class="text-sm">Add to Database</div>
                    <div class="text-2xl font-semibold">Add Your Scores</div>
                    <a href="">
                        <div class="grid-link-btn">Explore More</div>
                    </a>
                </div>
                <div class="link-grid-icon">
                    <i class="fas fa-id-badge text-xl"></i>
                </div>
            </div>
        </div>
        <div>
            <div class="link-grid-item">
                <div>
                    <div class="text-sm">Add to Database</div>
                    <div class="text-2xl font-semibold">Review Your Scores</div>
                    <a href="">
                        <div class="grid-link-btn">Explore More</div>
                    </a>
                </div>
                <div class="link-grid-icon">
                    <i class="fas fa-newspaper text-xl"></i>
                </div>
            </div>
        </div>
        <div>
            <div class="link-grid-item">
                <div>
                    <div class="text-sm">View</div>
                    <div class="text-2xl font-semibold">See Course Information</div>
                    <a href="">
                        <div class="grid-link-btn">Explore More</div>
                    </a>
                </div>
                <div class="link-grid-icon">
                    <i class="fas fa-users text-xl"></i>
                </div>
            </div>
        </div>
        <div class="col-span-4">
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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tournamentPlayer as $player)
                                @if($player->tournament)
                                    <tr>
                                        <td>{{ $player->tournament->tournament_title }}</td>
                                        <td>{{ \Carbon\Carbon::parse($player->tournament->start_date)->format('d M Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($player->tournament->end_date)->format('d M Y') }}</td>
                                        <td>{{ optional($player->tournament->courseDetail)->name }}</td>
                                        <td>{{ $player->tournament->rounds }}</td>
                                        <td>
                                            @if(\Carbon\Carbon::parse($player->tournament->start_date)->isFuture())
                                                    <span class="inline-block bg-blue-100 text-blue-600 text-xs px-2 py-1 rounded-full">Upcoming</span>
                                            @elseif(\Carbon\Carbon::parse($player->tournament->end_date)->isPast())
                                                    <span class="inline-block bg-green-100 text-green-600 text-xs px-2 py-1 rounded-full">Completed</span>
                                            @else
                                                    <span class="inline-block bg-red-100 text-red-600 text-xs px-2 py-1 rounded-full">Ongoing</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="flex flex-col gap-1 w-full">
                                                <a href="{{ route('admin.course-details.show', optional($player->tournament->courseDetail)->id) }}"
                                                class="bg-[#68d362] text-white rounded-full flex items-center justify-center text-sm px-2 py-1 hover:bg-green-800">
                                                    Course <i class="ml-2 fa-solid fa-circle-info"></i>
                                                </a>
                                                <a href="{{ route('admin.tee-assignments.show', $player->tournament->id) }}" class="bg-[#68d362] text-white rounded-full flex items-center justify-center text-sm px-2 py-1 hover:bg-green-800">
                                                Tee Time <i class="ml-2 fa-solid fa-circle-info"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.scoreboard-requests.create', $player->tournament->id) }}" class="bg-[#68d362] text-white rounded-full flex items-center justify-center text-sm px-2 py-1 hover:bg-green-800">
                                                Add Score
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">No upcoming tournaments found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div class="mt-4">
                        {{ $tournamentPlayer->links('vendor.pagination.adminpagination') }}
                    </div>
                </div>
            </x-table-bg-admin>
        </div>
    </div>  
</x-admin>