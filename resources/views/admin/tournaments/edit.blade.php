<x-admin :title="'Edit Tournament'">
    <div>
        <div class="z-50 absolute right-16 flex flex-row gap-2">
            <x-home-button/>
            <x-back-button/>
        </div> 
        <div class="inverted-radius relative" id="tournamentsSection">
            <div class="inverted-radius-content">
                <div class="flex flex-wrap items-center gap-2 mb-4">
                    <div class="frame-dot green-bg"></div>
                    <div class="frame-dot gold-bg"></div>
                    <div class="frame-dot red-bg"></div>
                </div>
                <div class="frame-wrapper">
                    <form action="{{ route('admin.tournaments.update', $tournament->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block font-medium text-sm">Title</label>
                            <input type="text" name="tournament_title" value="{{ old('tournament_title', $tournament->tournament_title) }}" class="form-input">
                        </div>
                        <div>
                            <label class="block font-medium text-sm">Presenter</label>
                            <input type="text" name="presenter" value="{{ old('presenter', $tournament->presenter) }}" class="form-input">
                        </div>
                        <div>
                            <label for="course_detail_id" class="form-label">Venue</label>
                            <select name="course_detail_id" id="course_detail_id" class="form-input" required>
                            <option value="">Select Venue</option>
                            @foreach($course_details_id as $course_detail_id)
                                <option value="{{ $course_detail_id->id }}" {{ old('course_detail_id', $tournament->course_detail_id) == $course_detail_id->id ? 'selected' : '' }}>
                                {{ $course_detail_id->name }}
                                </option>
                            @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="form-label">Location Code</label>
                            <input type="text" name="location_code" value="{{ old('venue', $tournament->location_code) }}" class="form-input">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-medium text-sm">Start Date</label>
                                <input type="date" name="start_date" value="{{ old('start_date', $tournament->start_date) }}" class="w-full rounded border p-2">
                            </div>
                            <div>
                                <label class="block font-medium text-sm">End Date</label>
                                <input type="date" name="end_date" value="{{ old('end_date', $tournament->end_date) }}" class="w-full rounded border p-2">
                            </div>
                        </div>
                        <div>
                            <label class="block font-medium text-sm">Entries Close</label>
                            <input type="date" name="entries_close" value="{{ old('entries_close', $tournament->entries_close) }}" class="w-full rounded border p-2">
                        </div>
                        <div>
                            <label class="form-label">Number of Rounds</label>
                            <input type="number" name="rounds" min="1" class="form-input" placeholder="e.g. 2" value="{{ old('rounds', $tournament->rounds) }}" required>
                        </div>
                        <h4 class="my-4 text-xs">Ladies Categories</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="form_label">Championship Handicap Range</label>
                                <input type="text" name="ladies_champ_handicap" value="{{ old('ladies_champ_handicap', $tournament->ladies_champ_handicap) }}" class="form-input">
                            </div>
                            <div>
                                <label class="form_label">Championship Fee</label>
                                <input type="number" name="ladies_champ_fee" value="{{ old('ladies_champ_fee', $tournament->ladies_champ_fee) }}" class="form-input">
                            </div>
                            <div>
                                <label class="form_label">Net Handicap Range</label>
                                <input type="text" name="ladies_net_handicap" value="{{ old('ladies_net_handicap', $tournament->ladies_net_handicap) }}" class="form-input">
                            </div>
                            <div>
                                <label class="form_label">Net Fee</label>
                                <input type="number" name="ladies_net_fee" value="{{ old('ladies_net_fee', $tournament->ladies_net_fee) }}" class="form-input">
                            </div>
                        </div>
                        <h4 class="my-4 text-xs">Mens Categories</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="form_label">Championship Handicap Range</label>
                                <input type="text" name="mens_champ_handicap" value="{{ old('men_champ_handicap', $tournament->men_champ_handicap) }}" class="form-input">
                            </div>
                            <div>
                                <label class="form_label">Championship Fee</label>
                                <input type="number" name="men_champ_fee" value="{{ old('men_champ_fee', $tournament->men_champ_fee) }}" class="form-input">
                            </div>
                            <div>
                                <label class="form_label">Net Handicap Range</label>
                                <input type="text" name="men_net_handicap" value="{{ old('men_net_handicap', $tournament->men_net_handicap) }}" class="form-input">
                            </div>
                            <div>
                                <label class="form_label">Net Fee</label>
                                <input type="number" name="men_net_fee" value="{{ old('men_net_fee', $tournament->men_net_fee) }}" class="form-input">
                            </div>
                        </div>
        
                        <div class="my-4"><button class="green-red-btn">Update Tournament <span><i class="fa-solid fa-arrow-up fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i></span></button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin>
