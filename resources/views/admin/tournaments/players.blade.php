<x-admin :title="'Players in tournament Overview'">
<x-alert type="success" />
    <div>
        <div class="z-50 absolute right-16 flex flex-row gap-2">
            <x-home-button/>
            <x-back-button/>
        </div>
      <div class="inverted-radius my-5 relative" id="tournamentsSection">
        <div class="inverted-radius-content">
          <!-- Filter + Table Section -->
          <div class="flex flex-wrap items-center gap-2 mb-2">
            <div class="bg-green-600 rounded-[100px] px-4 py-2 mt-2 text-white">
                <h5>Tournament: {{ $tournament->tournament_title }}</h5>
            </div>
            <div class="search-tab">
              <input type="text" placeholder="Search" class="search-input table-search" />
              <span class="search-icon"><i class="fas fa-search"></i></span>
            </div>
          </div>
          @php
              $user = Auth::user();
          @endphp

          @if ($user && $user->department === 'tournament_official')
              <div class="flex flex-wrap items-center gap-2 mb-2">
                  <a href="{{ route('admin.tee-assignments.create', $tournament->id) }}"> 
                      <div class="green-bg rounded-[100px] px-4 py-1 mt-2 text-white hover:bg-green-600">
                          Assign Tee Times
                      </div>
                  </a>
              </div>
          @endif

          <!-- Table -->
          <div class="table-wrapper">
        @if($players->count())
          <table class="admin-table  searchable-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Country</th>
                <th>Player Type</th>
                <th>Gender</th>
                <th>Signed Up At</th>
              </tr>
            </thead>
            <tbody>
            @foreach($players as $index => $player)
              <tr>
                <td>{{ $players->firstItem() + $index }}</td>
                <td>{{ $player->name }}</td>
                <td>{{ $player->country ?? '-' }}</td>
                <td>{{ $player->player_type }}</td>
                <td>{{ $player->gender }}</td>
                <td>{{ \Carbon\Carbon::parse($player->created_at)->format('d M, Y') }}</td>
              </tr>
            @endforeach
        @else
              <tr>
                <td colspan="7">No players have signed up for this tournament yet.</td>
              </tr>
        @endif
            </tbody>
          </table>
          </div>
          <div class="mt-4">
              {{ $players->links('vendor.pagination.adminpagination') }}
          </div>
        </div>
      </div>
    </div>


</x-admin>