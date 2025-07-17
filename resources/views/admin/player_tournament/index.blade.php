<x-admin :title="'Tournaments Overview'">
<x-alert type="success" />

    <div>
      <div class="inverted-radius my-5 relative" id="tournamentsSection">
        <div class="inverted-radius-content">
          <!-- Filter + Table Section -->
          <div class="flex flex-wrap items-center gap-2 mb-4">
            <div class="search-tab">
              <input type="text" id="searchInput" placeholder="Search" class="search-input" />
              <span class="search-icon"><i class="fas fa-search"></i></span>
            </div>
          </div>
          <!-- Table -->
          <div class="table-wrapper">
          <!-- (Insert same table HTML from previous step here) -->
          <table class="admin-table">
            <thead>
              <tr>
                <th>Title</th>
                <th>Presenter</th>
                <th>Venue</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Entries Close</th>
                <th>Status</th>
                <th>Sign Up</th>
              </tr>
            </thead>
            <tbody>
            @forelse ($tournaments as $tournament)
              @php
                $today = \Carbon\Carbon::today();
                $start = \Carbon\Carbon::parse($tournament->start_date);
                $end = \Carbon\Carbon::parse($tournament->end_date);
                $status = $today->lt($start)
                  ? 'Upcoming'
                  : ($today->between($start, $end)
                      ? 'Current'
                      : 'Past');
              @endphp
              <tr data-status="{{ $status }}">
                <td>{{ $tournament->tournament_title }}</td>
                <td>{{ $tournament->presenter }}</td>
                <td>{{ $tournament->courseDetail->name }}</td>
                <td>{{ \Carbon\Carbon::parse($tournament->start_date)->format('d M, Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($tournament->end_date)->format('d M, Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($tournament->entries_close)->format('d M, Y') }}</td>
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
                    @if(in_array($tournament->id, $signedUpTournamentIds))
                        <div class="w-10 h-10 bg-[#68d362] text-white rounded-full flex items-center justify-center">
                            <i class="text-sm fa-solid fa-check"></i>
                        </div>
                    @else
                        <a href="{{ route('admin.player-tournaments.create', $tournament->id) }}" class="w-10 h-10 bg-[#68d362] text-white rounded-full flex items-center justify-center hover:bg-[color:var(--gold)]">
                            <i class="text-sm fa-solid fa-user-plus"></i>
                        </a>
                    @endif
                </td>

              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-center py-4">No tournaments found.</td>
              </tr>
            @endforelse
            </tbody>
          </table>
          </div>
          <div class="mt-4">
              {{ $tournaments->links('vendor.pagination.adminpagination') }}
          </div>
        </div>
      </div>
    </div>


</x-admin>