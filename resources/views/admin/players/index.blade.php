<x-admin :title="'Players Overview'">
<x-alert type="success" />

    <div class="link-grid">
        <div class="col-span-1">
            <div class="link-grid-item">
                <div>
                    <div class="text-sm">Add to Website</div>
                    <div class="text-2xl font-semibold">Add A New Player</div>
                    <a href="{{ route('admin.players.create') }}">
                        <div class="grid-link-btn">
                            Explore More
                        </div>
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
                    <div class="text-2xl font-semibold">View Each Players</div>
                    <a href="#playerSection">
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
                    <div class="text-2xl font-semibold">Update A Player</div>
                    <a href="#playerSection">
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
                    <div class="text-2xl font-semibold">Delete A Player</div>
                    <a href="#playerSection">
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
      <div class="inverted-radius my-5 relative" id="playerSection">
        <div class="inverted-radius-content">
          <!-- Filter + Table Section -->
          <div class="flex flex-wrap items-center gap-2 mb-4">
            <div class="search-tab">
              <input type="text" placeholder="Search" class="search-input table-search" />
              <span class="search-icon"><i class="fas fa-search"></i></span>
            </div>
            <button class="filter-tab">Download <i class="fa-solid fa-download ml-2"></i></button>
          </div>
      
          <!-- Table -->
          <div class="table-wrapper">
          <!-- (Insert same table HTML from previous step here) -->
          <table class="admin-table searchable-table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Date Of Birth</th>
                <th>Place Of Birth</th>
                <th>Handicap</th>
                <th>Club</th>
                <th>Achievements</th>
                <th>OWAR</th>
                <th>Total Tournaments</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @forelse ($players as $player)
              @php
                $start = \Carbon\Carbon::parse($player->date_of_birth);
              @endphp
              <tr>
                <td>{{ $player->name }}</td>
                <td>{{ \Carbon\Carbon::parse($player->date_of_birth)->format('d M, Y') }}</td>
                <td>{{ $player->place_of_birth }}</td>
                <td>{{ $player->handicap }}</td>
                <td>{{ $player->club }}</td>
                <td>{!! $player->achievements !!}</td>
                <td>{{ $player->owar }}</td>
                <td>
                <img src="{{ asset('storage/' . $player->image_path) }}" 
                    alt="Tournament Image" 
                    class="w-10 h-10 rounded-full object-cover" />
                </td>
                <td class="flex gap-2 items-center justify-center">
                  <a href="{{ route('admin.players.show', $player->id) }}" class="w-10 h-10 bg-[#68d362] text-white rounded-full flex items-center justify-center">
                    <i class="text-sm fa-solid fa-eye"></i>
                  </a>
                  <a href="{{ route('admin.players.edit', $player->id) }}" class="w-10 h-10 bg-[#68d362] text-white rounded-full flex items-center justify-center">
                    <i class="text-sm fa-solid fa-clipboard"></i>
                  </a>
                  <form action="{{ route('admin.players.destroy', $player->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this player?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-10 h-10 trash-btn rounded-full flex items-center justify-center">
                      <i class="text-sm fa-solid fa-trash"></i>
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
          </div>
          <div class="mt-4">
              {{ $players->links('vendor.pagination.adminpagination') }}
          </div>
        </div>
      </div>
    </div>

</x-admin>