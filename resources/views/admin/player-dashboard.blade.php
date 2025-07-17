<x-admin>
    <x-alert type="success" />
    <div class="grid grid-cols-4 gap-4">
        <div>
            <div class="link-grid-item">
                <div>
                    <div class="text-sm">Tee Times</div>
                    <div class="text-2xl font-semibold">View Tee Times</div>
                    <a href="{{route('admin.my-tournaments.index')}}">
                        <div class="grid-link-btn">
                            Explore More
                        </div>
                    </a>
                </div>
                <div class="link-grid-icon">
                    <i class="fas fa-clock text-xl"></i>
                </div>
            </div>
        </div>
        <div>
            <div class="link-grid-item">
                <div>
                    <div class="text-sm">Manage Scores</div>
                    <div class="text-2xl font-semibold">Send Tournaments Scores</div>
                    <a href="{{route('admin.my-tournaments.index')}}">
                        <div class="grid-link-btn">Explore More</div>
                    </a>
                </div>
                <div class="link-grid-icon">
                    <i class="fas fa-check text-xl"></i>
                </div>
            </div>
        </div>
        <div>
            <div class="link-grid-item">
                <div>
                    <div class="text-sm">View Tournaments</div>
                    <div class="text-2xl font-semibold">Track Upcoming Tournaments</div>
                    <a href="{{route('admin.tournaments.index')}}">
                        <div class="grid-link-btn">Explore More</div>
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
                    <div class="text-sm">View</div>
                    <div class="text-2xl font-semibold">View Leaderboard</div>
                    <a href="{{route('admin.leaderboard.index')}}">
                        <div class="grid-link-btn">Explore More</div>
                    </a>
                </div>
                <div class="link-grid-icon">
                    <i class="fas fa-flag text-xl"></i>
                </div>
            </div>
        </div>
        <div class="col-span-3 row-span-2">
            <div>
                <div class="z-50 absolute right-[350px] flex flex-row gap-2">
                    <a href="{{ route('admin.leaderboard.show', $tournament->id) }}">
                        <button class="inverted-corner-btn"> Leaderboard
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
                                        <th>Country</th>
                                        <th>Name</th>
                                        <th>Hole</th>
                                        @foreach ($rounds as $round)
                                            <th>R{{ $round }}</th>
                                        @endforeach
                                        <th>Par</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($tournamentPlayers as $player)
                                        @php
                                            $playerId = $player->id;
                                            $roundPar = $courseHoles->sum('par');
                                            $finalTotal = collect($totals[$playerId] ?? [])->sum();
                                            $expectedTotal = $roundPar * count($rounds);
                                            $finalVsPar = $finalTotal - $expectedTotal;
                                        @endphp
                                        <tr class="cursor-pointer transition hover:bg-gray-100"
                                            onclick="toggleDetails({{ $playerId }})"
                                            style="user-select:none;">
                                            <td>{{ $player->country }}</td>
                                            <td>{{ $player->name }}</td>
                                            @if(isset($latestProgress[$player->id]) && $latestProgress[$player->id]['round'])
                                                <td>{{ $latestProgress[$player->id]['hole'] }}</td>
                                            @else
                                                <td>-</td>
                                            @endif
                                            @foreach($rounds as $round)
                                                @php
                                                    $score = $totals[$playerId][$round] ?? null;
                                                    $roundVsPar = $score !== null ? $score - $roundPar : null;
                                                @endphp
                                                <td>
                                                    {{ $score ?? '-' }}
                                                    <div class="text-xs font-semibold
                                                        {{ $roundVsPar < 0 ? 'text-green-600' : ($roundVsPar > 0 ? 'text-red-600' : 'text-gray-700') }}">
                                                        @if ($roundVsPar === null)
                                                            &nbsp;
                                                        @elseif ($roundVsPar == 0)
                                                            E
                                                        @elseif ($roundVsPar > 0)
                                                            +{{ $roundVsPar }}
                                                        @else
                                                            {{ $roundVsPar }}
                                                        @endif
                                                    </div>
                                                </td>
                                            @endforeach
                                            @php
                                                $currentPar = ($latestProgress[$player->id]['round'] && $latestProgress[$player->id]['round'] < count($rounds))
                                                    ? $roundPar * $latestProgress[$player->id]['round']
                                                    : $roundPar * count($rounds);
                                                $scoreSoFar = collect($totals[$playerId] ?? [])->take($latestProgress[$player->id]['round'])->sum();
                                                $parDiff = $scoreSoFar - $currentPar;
                                            @endphp
                                            <td class="{{ $parDiff < 0 ? 'text-green-600' : ($parDiff > 0 ? 'text-red-600' : 'text-gray-700') }}">
                                                    @if ($parDiff == 0)
                                                        E
                                                    @elseif ($parDiff > 0)
                                                        +{{ $parDiff }}
                                                    @else
                                                        {{ $parDiff }}
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="font-bold">
                                                {{ $finalTotal ?: '-' }}
                                                <div class="text-xs font-semibold
                                                    {{ $finalVsPar < 0 ? 'text-green-600' : ($finalVsPar > 0 ? 'text-red-600' : 'text-gray-700') }}">
                                                    @if ($finalVsPar == 0)
                                                        E
                                                    @elseif ($finalVsPar > 0)
                                                        +{{ $finalVsPar }}
                                                    @else
                                                        {{ $finalVsPar }}
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="details-{{ $playerId }}" class="hidden bg-white">
                                            <td colspan="{{ 4 + count($rounds) + 2 }}">
                                                <div class="overflow-x-auto">
                                                    <table class="admin-table w-full text-center">
                                                        <thead>
                                                            <tr class="bg-gray-100 text-xs font-bold">
                                                                <th>Hole</th>
                                                                @foreach ($holes as $hole)
                                                                    <th>{{ $hole }}</th>
                                                                    @if ($hole == 9)
                                                                        <th>In</th>
                                                                    @elseif ($hole == 18)
                                                                        <th>Out</th>
                                                                        <th>Total</th>
                                                                    @endif
                                                                @endforeach
                                                            </tr>
                                                            <tr class="bg-gray-100 text-xs font-bold">
                                                                <td>Par</td>
                                                                @php
                                                                    $inPar = 0;
                                                                    $outPar = 0;
                                                                @endphp
                                                                @foreach ($holes as $hole)
                                                                    @php
                                                                        $holePar = $courseHoles->firstWhere('hole_number', $hole)?->par ?? 0;
                                                                        if ($hole <= 9) $inPar += $holePar;
                                                                        else $outPar += $holePar;
                                                                    @endphp
                                                                    <td>{{ $holePar }}</td>
                                                                    @if ($hole == 9)
                                                                        <td class="font-bold">{{ $inPar }}</td>
                                                                    @elseif ($hole == 18)
                                                                        <td class="font-bold">{{ $outPar }}</td>
                                                                        <td class="font-bold">{{ $inPar + $outPar }}</td>
                                                                    @endif
                                                                @endforeach
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-sm">
                                                            @foreach($rounds as $round)
                                                                @php
                                                                    $inTotal = 0;
                                                                    $outTotal = 0;
                                                                @endphp
                                                                <tr>
                                                                    <td>R{{ $round }}</td>
                                                                    @foreach($holes as $hole)
                                                                        @php
                                                                        $playerId = $player->id;
                                                                        $par = $courseHoles->firstWhere('hole_number', $hole)?->par ?? null;
                                                                        $score = isset($scores[$playerId][$round][$hole])
                                                                            ? $scores[$playerId][$round][$hole]->first()->par
                                                                            : null;
                                                                            if ($hole <= 9) $inTotal += $score;
                                                                            else $outTotal += $score;
                                                                        $scoreClass = 'round_score_bg';
                                                                        if ($score !== null && $par !== null) {
                                                                            $scoreClass .= $score == 1 ? ' hole-in-one' :
                                                                                ($score == $par - 2 ? ' eagle' :
                                                                                ($score == $par - 1 ? ' birdie' :
                                                                                ($score == $par     ? ' par' :
                                                                                ($score == $par + 1 ? ' bogey' :
                                                                                ($score == $par + 2 ? ' double_bogey' : '')))));
                                                                        }
                                                                    @endphp
                                                                    <td >
                                                                        <div class="{{ $scoreClass }}">{{ $score ?? '-' }}</div>
                                                                    </td>
                                                                        @if ($hole == 9)
                                                                            <td class="font-bold bg-gray-100">{{ $inTotal }}</td>
                                                                        @elseif ($hole == 18)
                                                                            <td class="font-bold bg-gray-100">{{ $outTotal }}</td>
                                                                        @endif
                                                                    @endforeach
                                                                    <td class="font-bold bg-gray-100">{{ $totals[$playerId][$round] ?? '-' }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="{{ 4 + count($rounds) + 2 }}" class="text-center py-4">
                                                No approved scores found for this tournament.
                                            </td>
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
                    <div class="text-2xl font-semibold">Total Number of Players</div>
                    <a href="{{ route('admin.blog.index') }}">
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
                    <a href="{{ route('admin.player-tournaments.index') }}">
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
    </div>
</x-admin>