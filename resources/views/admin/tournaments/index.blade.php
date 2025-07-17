<x-admin :title="'Tournaments Overview'">
<x-alert type="success" />

    <div class="link-grid">
        <div class="col-span-1">
            <div class="link-grid-item">
                <div>
                    <div class="text-sm">Add to Website</div>
                    <div class="text-2xl font-semibold">Create A Tournament</div>
                    <a href="{{ route('admin.tournaments.create') }}">
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
                    <div class="text-sm">Add to Website</div>
                    <div class="text-2xl font-semibold">View All Tournaments</div>
                    <a href="#tournamentsSection">
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
                    <div class="text-sm">Add to Website</div>
                    <div class="text-2xl font-semibold">Upcoming Tournament</div>
                    <a href="">
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
                    <div class="text-2xl font-semibold">Past 10 Tournaments</div>
                    <a href="">
                        <div class="grid-link-btn">Explore More</div>
                    </a>
                </div>
                <div class="link-grid-icon">
                    <i class="fas fa-history text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div>
    {{-- <button class="inverted-corner-btn filter-tab absolute right-20">
<i class="fa-solid fa-download"></i>    
</button> --}}
      <div class="inverted-radius my-5 relative" id="tournamentsSection">
        <div class="inverted-radius-content">
          <!-- Filter + Table Section -->
          <div class="flex flex-wrap items-center gap-2 mb-4">
            <form method="GET" action="{{ route('admin.tournaments.index') }}" class="search-tab">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search tournaments..." 
                    class="search-input"
                />
                <button type="submit" class="search-icon">
                    <i class="fas fa-search"></i>
                </button>
            </form>

            <button class="filter-tab" data-filter="Current">Current</button>
            <button class="filter-tab" data-filter="Upcoming">Upcoming</button>
            <button class="filter-tab" data-filter="Past">Past</button>
            <button class="filter-tab" data-filter=" ">All</button>
          </div>
          @if(request('search'))
              <div class="text-sm text-gray-600 flex flex-wrap items-center gap-2 mb-4">
                  Showing results for "<strong>{{ request('search') }}</strong>"
                  <a href="{{ route('admin.tournaments.index') }}" class="gold-bg ml-2 p-2 px-3 rounded-[20px] text-white text-center items-center justify-center hover:bg-red-400">Clear</a>
              </div>
          @endif
          <!-- Table -->
          <div class="table-wrapper">

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
                <th>Details</th>
                <th>Action</th>
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
                <td>
                  <div class="flex flex-col gap-1">
                    <a href="{{ route('admin.tournaments.players', $tournament->id) }}" class="bg-[#68d362] text-white rounded-full flex items-center justify-center text-sm px-2 py-1 hover:bg-green-800">
                      Players<i class="ml-2 fa-solid fa-circle-info"></i>
                    </a>
                    <a href="{{ route('admin.tee-assignments.show', $tournament->id) }}" class="bg-[#68d362] text-white rounded-full flex items-center justify-center text-sm px-2 py-1 hover:bg-green-800">
                      Tee Time <i class="ml-2 fa-solid fa-circle-info"></i>
                    </a>
                  </div>
                </td>
                <td>
                  <div class="flex gap-1">
                    <a href="{{ route('admin.tournaments.show', $tournament->id) }}" class="w-10 h-10 bg-[#68d362] text-white rounded-full flex items-center justify-center">
                      <i class="text-sm fa-solid fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.tournaments.edit', $tournament->id) }}" class="w-10 h-10 bg-[#68d362] text-white rounded-full flex items-center justify-center">
                      <i class="text-sm fa-solid fa-clipboard"></i>
                    </a>
                    <form action="{{ route('admin.tournaments.destroy', $tournament->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tournament?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="w-10 h-10 trash-btn rounded-full flex items-center justify-center">
                        <i class="text-sm fa-solid fa-trash"></i>
                      </button>
                    </form>
                  </div>
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