<x-admin>
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
                        <a href="{{ route('admin.tee-assignments.show', [$tournament, 'round' => $round]) }}">
                            <button class="filter-tab {{ $round == $selectedRound ? 'active' : '' }}">
                                Round {{ $round }}
                            </button>
                        </a>
                    @endforeach
                </div>
                <div class="table-wrapper">
                    <table class="admin-table searchable-table">
                        <thead>
                            <tr>
                                <th>Round</th>
                                <th>Match</th>
                                <th>Tee</th>
                                <th>Tee Time</th>
                                <th>Players</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($teeAssignments as $groupKey => $assignments)
                                @php
                                    // Extract round, match, tee, time from the key
                                    [$round, $match, $tee, $time] = explode('-', $groupKey);
                                @endphp
                                <tr class="table-row round-{{ $round }}">
                                    <td>{{ $round }}</td>
                                    <td>{{ $match }}</td>
                                    <td>{{ $tee }}</td>
                                    <td>{{ \Carbon\Carbon::parse($time)->format('H:i') }}</td>
                                    <td class="flex flex-col">
                                        @foreach ($assignments as $assignment)
                                            <div>
                                                {{ $assignment->tournamentPlayer->name }}
                                                @if (ucfirst($assignment->tournamentPlayer->player_type) === 'Amateur')
                                                    <span class="text-black">(a)</span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No tee assignments for this tournament yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterButtons = document.querySelectorAll('.filter-tab');
        const rows = document.querySelectorAll('.table-row');

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                const filter = button.getAttribute('data-filter');

                // Highlight active filter
                filterButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                rows.forEach(row => {
                    if (filter === 'all' || row.classList.contains(filter)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    });
</script>

</x-admin>
