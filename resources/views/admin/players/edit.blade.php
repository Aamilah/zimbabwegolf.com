<x-admin :title="'Edit A Player'">
    <div>
        <a href="{{ route('admin.players.index') }}">
            <button class="inverted-corner-btn z-50 absolute right-15"> Back
            <i class="ml-10 fa-solid fa-arrow-left"></i>
            </button>
        </a>
        <a href="{{ route('admin.admin-dashboard') }}">
            <button class="inverted-corner-btn w-10 h-10 items-center justify-center z-50 absolute right-50"><i class="fa-solid fa-home"></i>
            </button>
        </a>
        <div class="inverted-radius relative">
            <div class="inverted-radius-content">
                <div class="flex flex-wrap items-center gap-2 mb-4">
                    <div class="frame-dot green-bg"></div>
                    <div class="frame-dot gold-bg"></div>
                    <div class="frame-dot red-bg"></div>
                </div>
                <div class="frame-wrapper">
                    <form action="{{ route('admin.players.update', $player->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-input" value="{{ old('name', $player->name) }}" required>
                        </div>
                        <div class="my-4">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" name="date_of_birth" id="date_of_birth" class="form-input" value="{{ old('date_of_birth', $player->date_of_birth) }}" required>
                        </div>
                        <div class="my-4">
                            <label for="place_of_birth" class="form-label">Place of Birth</label>
                            <input type="text" name="place_of_birth" id="place_of_birth" class="form-input" value="{{ old('place_of_birth', $player->place_of_birth) }}" required>
                        </div>
                        <div class="my-4">
                            <label for="handicap" class="form-label">Handicap</label>
                            <input type="text" name="handicap" id="handicap" class="form-input" value="{{ old('handicap', $player->handicap) }}" required>
                        </div>
                        <div class="my-4">
                            <label for="club" class="form-label">Club</label>
                            <input type="text" name="club" id="club" class="form-input" value="{{ old('club', $player->club) }}" required>
                        </div>
                        <div class="my-4">
                            <label for="achievements" class="form-label">Achievements</label>
                            <textarea name="achievements" 
                                    id="achievements" 
                                    rows="5" 
                                    required
                                    class="form-input">{{ old('achievements', $player->achievements) }}</textarea>
                        </div>
                        <div class="my-4">
                            <label for="owar" class="form-label">OWAR</label>
                            <input type="number" name="owar" id="owar" class="form-input" value="{{ old('owar', $player->owar) }}" required>
                        </div>
                        <div class="my-4">
                            <label for="total_tournaments" class="form-label">Total Tournaments</label>
                            <input type="number" name="total_tournaments" id="total_tournaments" class="form-input" value="{{ old('total_tournaments', $player->total_tournaments) }}" required>
                        </div>
                        <div class="my-4">
                            <label for="image_path" class="form-label">Image</label>

                            @php
                                $image = $player->image_path 
                                    ? asset('storage/' . $player->image_path)
                                    : asset('images/default-player.jpg'); // <- path to your default image
                            @endphp

                            <div class="mb-2">
                                <img src="{{ $image }}" 
                                    alt="{{ $player->name }}" 
                                    class="w-20 h-20 rounded-full object-cover border" />
                            </div>

                            <input
                                type="file"
                                name="image_path"
                                id="image_path"
                                accept="image/*"
                                class="form-input
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-[200px] file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-green-500 file:text-white
                                    hover:file:bg-green-700
                                    focus:outline-none focus:ring focus:border-green"
                            >
                        </div>

       
                        <div class="my-4"><button class="green-red-btn">Update Player <span><i class="fa-solid fa-arrow-up fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i></span></button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin>
