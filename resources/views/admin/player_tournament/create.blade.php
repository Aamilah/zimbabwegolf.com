<x-admin :title="'Sign Up For A Tournament'">
    <div class="p-4">
        <x-file-section-bg>
            <form action="{{ route('admin.player-tournaments.store', $tournament->id) }}" method="POST" enctype="multipart/form-data">                
                @csrf

                    @if ($errors->any())
                        <ul class="px-4 py-2 bg-red-100 rounded mb-4">
                            @foreach ($errors->all() as $error)
                                <li class="my-2 text-red-500">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
            <input type="hidden" name="tournament_id" value="{{ $tournament->id }}">

            <div class="mb-4">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name_display" id="name" class="form-input bg-gray-100 cursor-not-allowed" value="{{ Auth::user()->name }}" disabled>
            </div>

            <div class="mb-4">
                <label for="country" class="form-label">Country</label>
                <input type="text" name="country" id="country" class="form-input">
            </div>
            <div class="mb-4">
                <label for="player_type" class="form-label">Player Type</label>
                <select name="player_type" id="player_type" class="form-input">
                    <option value="">Select type</option>
                    <option value="professional">Pro</option>
                    <option value="amateur">Amateur</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="gender" class="form-label">Gender</label>
                <select name="gender" id="gender" class="form-input">
                    <option value="">Select gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

                    <div class="my-4">
                        <button class="green-red-btn">
                            Sign Up <span><i class="fa-solid fa-plus"></i></span>
                        </button>
                    </div>

                </form>
        </x-file-section-bg>
    </div>
</x-admin>