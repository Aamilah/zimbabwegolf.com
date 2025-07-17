<x-admin>
    <x-alert type="success" />
    <div class="grid grid-cols-4 gap-4">
        <div>
            <div class="link-grid-item">
                <div>
                    <div class="text-sm">Add to Database</div>
                    <div class="text-2xl font-semibold">Add To Tournament Calender</div>
                    <a href="{{ route('admin.tournaments.create') }}">
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
                    <div class="text-2xl font-semibold">Add a Player Profile</div>
                    <a href="{{ route('admin.players.create') }}">
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
                    <div class="text-2xl font-semibold">Add An Article Post</div>
                    <a href="{{ route('admin.blog.create') }}">
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
                    <div class="text-sm">Add to Database</div>
                    <div class="text-2xl font-semibold">Register a User</div>
                    <a href="{{route('register')}}">
                        <div class="grid-link-btn">Explore More</div>
                    </a>
                </div>
                <div class="link-grid-icon">
                    <i class="fas fa-users text-xl"></i>
                </div>
            </div>
        </div>
        <div class="col-span-3 row-span-2">
            <div>
                <div class="z-50 absolute right-[350px] flex flex-row gap-2">
                    <a href="{{ route('admin.blog.index') }}">
                        <button class="inverted-corner-btn"> Blog Posts
                        <i class="ml-10 fa-solid fa-newspaper"></i>
                        </button>
                    </a>
                </div>
                <div class="inverted-radius">
                    <div class="inverted-radius-content">
                        <div class="flex flex-wrap items-center gap-2 mb-4">
                            <div class="frame-dot green-bg"></div>
                            <div class="frame-dot gold-bg"></div>
                            <div class="frame-dot red-bg"></div>
                        </div>
                        <div class="table-wrapper">
                            <table class="dashboard-table">
                                <thead>
                                    <tr>
                                        <th>Headline</th>
                                        <th>Category</th>
                                        <th>Author</th>
                                        <th>Thumbnail</th>
                                        <th>Created On</th>
                                        <th>Updated On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentArticles as $blogs)
                                        @php
                                            $created = \Carbon\Carbon::parse($blogs->created_at);
                                            $updated = \Carbon\Carbon::parse($blogs->updated_at);
                                        @endphp
                                        <tr>
                                            <td>{{ $blogs->headline }}</td>
                                            <td>{{ $blogs->category }}</td>
                                            <td>{{ $blogs->author }}</td>
                                            <td>
                                                <img src="{{ asset('storage/' . $blogs->thumbnail) }}"
                                                    alt="Blog Image"
                                                    class="w-10 h-10 rounded-full object-cover" />
                                            </td>
                                            <td>{{ $created->format('d M, Y') }}</td>
                                            <td>{{ $updated->format('d M, Y') }}</td>
                                            <td class="flex gap-1 items-center justify-center">
                                                <a href="{{ route('admin.blog.show', $blogs->id) }}" class="w-7 h-7 bg-[#68d362] text-white rounded-full flex items-center justify-center">
                                                    <i class="text-[0.6rem] fa-solid fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.blog.edit', $blogs->id) }}" class="w-7 h-7 bg-[#68d362] text-white rounded-full flex items-center justify-center">
                                                    <i class="text-[0.6rem] fa-solid fa-clipboard"></i>
                                                </a>
                                                <form action="{{ route('admin.blog.destroy', $blogs->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="w-7 h-7 trash-btn rounded-full flex items-center justify-center">
                                                        <i class="text-[0.6rem] fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">No articles found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="link-grid-item-2">
                <div class="content">
                    <div class="text-sm">Database Statistic</div>
                    <div class="text-2xl font-semibold">Total Number of Articles</div>
                    <a href="{{ route('admin.blog.index') }}">
                        <div class="grid-link-btn">
                            Explore More
                        </div>
                    </a>
                </div>
                <div class="link-grid-number">
                    <p>{{$articleCount}}</p>
                </div>
            </div>
        </div>
        <div>
            <div class="link-grid-item-2">
                <div class="content">
                    <div class="text-sm">Database Statistic</div>
                    <div class="text-2xl font-semibold">Total Number of Tournaments</div>
                    <a href="{{ route('admin.blog.index') }}">
                        <div class="grid-link-btn">
                            Explore More
                        </div>
                    </a>
                </div>
                <div class="link-grid-number">
                    <p>{{$tournamentCount}}</p>
                </div>
            </div>
        </div>
        <div class="col-span-2">
            <div class="mx-5 px-5">
                @if($currentTournament)
                    <x-tournament-card :tournament="$currentTournament" />
                @else
                    <p class="text-center text-gray-500">No tournaments available.</p>
                @endif
            </div>
        </div>
        <div class="col-span-2">
            <div>
                <div class="z-50 absolute right-16 flex flex-row gap-2">
                    <a href="{{ route('admin.tournaments.index') }}">
                        <button class="inverted-corner-btn"> Tournament Calendar
                        <i class="ml-10 fa-solid fa-calendar"></i>
                        </button>
                    </a>
                </div>
                <div class="inverted-radius">
                    <div class="inverted-radius-content">
                        <div class="flex flex-wrap items-center gap-2 mb-4">
                            <div class="frame-dot green-bg"></div>
                            <div class="frame-dot gold-bg"></div>
                            <div class="frame-dot red-bg"></div>
                        </div>
                        <div class="table-wrapper">
                            <table class="dashboard-table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Venue</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($upcomingTournaments as $tournament)
                                        @php
                                            $today = \Carbon\Carbon::today();
                                            $start = \Carbon\Carbon::parse($tournament->start_date);
                                            $end = \Carbon\Carbon::parse($tournament->end_date);
                                            $status = $today->lt($start)
                                                ? 'Upcoming'
                                                : ($today->between($start, $end) ? 'Current' : 'Past');
                                        @endphp
                                        <tr data-status="{{ $status }}">
                                            <td>{{ $tournament->tournament_title }}</td>
                                            <td>{{ $tournament->venue }}</td>
                                            <td>{{ \Carbon\Carbon::parse($tournament->start_date)->format('d M, Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($tournament->end_date)->format('d M, Y') }}</td>
                                            <td>
                                                @if ($status === 'Upcoming')
                                                    <span class="inline-block bg-blue-100 text-blue-600 text-xs px-2 py-1 rounded-full">Upcoming</span>
                                                @elseif ($status === 'Current')
                                                    <span class="inline-block bg-yellow-100 text-yellow-600 text-xs px-2 py-1 rounded-full">Current</span>
                                                @else
                                                    <span class="inline-block bg-gray-200 text-gray-700 text-xs px-2 py-1 rounded-full">Past</span>
                                                @endif
                                            </td>
                                            <td class="flex gap-2 items-center justify-center">
                                                <a href="{{ route('admin.tournaments.show', $tournament->id) }}" class="w-7 h-7 bg-[#68d362] text-white rounded-full flex items-center justify-center">
                                                    <i class="text-[0.6rem] fa-solid fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.tournaments.edit', $tournament->id) }}" class="w-7 h-7 bg-[#68d362] text-white rounded-full flex items-center justify-center">
                                                    <i class="text-[0.6rem] fa-solid fa-clipboard"></i>
                                                </a>
                                                <form action="{{ route('admin.tournaments.destroy', $tournament->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tournament?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="w-7 h-7 trash-btn rounded-full flex items-center justify-center">
                                                        <i class="text-[0.6rem] fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">No tournaments found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-2 row-span-2">
            <div>
                <div class="z-50 absolute right-[650px] flex flex-row gap-2">
                    <a href="{{ route('admin.players.index') }}">
                        <button class="inverted-corner-btn"> Player List
                        <i class="ml-10 fa-solid fa-calendar"></i>
                        </button>
                    </a>
                </div>
                <div class="inverted-radius">
                    <div class="inverted-radius-content">
                        <div class="flex flex-wrap items-center gap-2 mb-4">
                            <div class="frame-dot green-bg"></div>
                            <div class="frame-dot gold-bg"></div>
                            <div class="frame-dot red-bg"></div>
                        </div>
                        <div class="table-wrapper">
                            <table class="dashboard-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th></th>
                                        <th>Date Of Birth</th>
                                        <th>Handicap</th>
                                        <th>OWAR</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @forelse ($playersList as $player)
                                    @php
                                        $start = \Carbon\Carbon::parse($player->date_of_birth);
                                    @endphp
                                    <tr>
                                        <td>{{ $player->name }}</td>
                                        <td>
                                            <img src="{{ asset('storage/' . $player->image_path) }}" 
                                                alt="Tournament Image" 
                                                class="w-10 h-10 rounded-full object-cover" />
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($player->date_of_birth)->format('d M, Y') }}</td>
                                        <td>{{ $player->handicap }}</td>
                                        <td>{{ $player->owar }}</td>
                                        <td class="flex gap-2 items-center justify-center">
                                            <a href="{{ route('admin.players.show', $player->id) }}" class="w-7 h-7 bg-[#68d362] text-white rounded-full flex items-center justify-center">
                                                <i class="text-[0.7rem] fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.players.edit', $player->id) }}" class="w-7 h-7 bg-[#68d362] text-white rounded-full flex items-center justify-center">
                                                <i class="text-[0.7rem] fa-solid fa-clipboard"></i>
                                            </a>
                                            <form action="{{ route('admin.players.destroy', $player->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this player?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-7 h-7 trash-btn rounded-full flex items-center justify-center">
                                                <i class="text-[0.7rem] fa-solid fa-trash"></i>
                                                </button>
                                            </form> 
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">No players found.</td>
                                    </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-2 row-span-1">
            <div class="link-grid-item-2">
                <div class="content">
                    <div class="text-sm">Database Statistic</div>
                    <div class="text-2xl font-semibold">Total Number of Player</div>
                    <a href="{{ route('admin.players.index') }}">
                        <div class="grid-link-btn">
                            Explore More
                        </div>
                    </a>
                </div>
                <div class="link-grid-number">
                    <p>{{$playerCount}}</p>
                </div>
            </div>
        </div>
    </div>
</x-admin>