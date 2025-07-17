<div class="w-[320px] h-[400px] mx-2 my-10 relative" x-data="{ flipped: false }">
  <!-- Front Card -->
  <div
    class="absolute inset-0 transition-all duration-700 ease-in-out"
    :class="flipped 
      ? 'translate-y-[-60px] translate-x-[-30px] scale-[0.95] z-0 opacity-70' 
      : 'translate-y-0 scale-100 z-20 opacity-100'"
  >
    <div class="bg-red-500 rounded-xl overflow-hidden shadow-lg w-full h-full relative">
      <img src="{{ asset('storage/' . $player->image_path) }}" alt="{{ $player->name }}"
        class="w-full h-full object-cover" />
      <div class="absolute bottom-0 left-0 w-full px-4 pb-4 z-10">
        <button @click="flipped = true"
          class="green-red-btn">
          {{ $player->name }}
          <span><i class="fa-solid fa-arrow-up fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i></span>
        </button>
      </div>
    </div>
  </div>

  <!-- Back Card -->
  <div
    class="absolute inset-0 transition-all duration-700 ease-in-out"
    :class="flipped 
      ? 'translate-y-0 scale-100 z-20 opacity-100' 
      : 'translate-y-[60px] scale-[0.95] z-0 opacity-0'"
  >
    <div class="bg-white rounded-xl overflow-hidden shadow-lg w-full h-full p-4 flex flex-col justify-between">
      <div class="flex flex-row justify-between">
        <h3>{{ $player->name }}</h3>
        <div class="w-10 h-10 bg-[#68d362] text-white rounded-full flex items-center justify-center hover:bg-[color:var(--red)]">
          <button @click="flipped = false">
            <i class="fa-solid fa-arrow-right"></i>
          </button>
        </div>
      </div>
      <div>
        <table class="player-table">
          <tbody>
              <tr>
                <th>Date of Birth</th>
                <td>{{ $player->date_of_birth }}</td>
              </tr>
              <tr>
                <th>Place of Birth</th>
                <td>{{ $player->place_of_birth }}</td>
              </tr>
              <tr>
                <th>Handicap</th>
                <td>{{ $player->handicap }}</td>
              </tr>
              <tr>
                <th>Club</th>
                <td>{{ $player->club }}</td>
              </tr>
              <tr>
                <th>Achievements</th>
                <td class="text-xs">{!! $player->achievements !!}</td>
              </tr>
              <tr>
                <th>OWAR</th>
                <td>{{ $player->owar }}</td>
              </tr>
              <tr>
                <th>Total Tournaments</th>
                <td>{{ $player->total_tournaments }}</td>
              </tr>
            </tbody>
          </table>
      </div>
    </div>
  </div>
</div>
