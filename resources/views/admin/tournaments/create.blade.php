<x-admin :title="'Create Tournament'">
    <div class="inverted-radius my-5 relative">
        <div class="inverted-radius-content">
            <div class="flex flex-wrap items-center gap-2 mb-4">
                <div class="frame-dot green-bg"></div>
                <div class="frame-dot gold-bg"></div>
                <div class="frame-dot red-bg"></div>
            </div>
        <div class="frame-wrapper">
            <form action="{{ route('admin.tournaments.store') }}" method="POST" >
                @csrf
                @if ($errors->any())
                    <ul class="px-4 py-2 bg-red-100">
                        @foreach ($errors->all() as $error)
                        <li class="my-2 text-red-500">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <!-- General Event Info -->
                <div>
                    <label class="form-label">Tournament Title</label>
                    <input type="text" name="tournament_title"  class="form-input" placeholder="FBC Zimbabwe Open" value="{{old('tournament_title')}}" required>
                </div>
                    
                <div>
                    <label class="form-label">Presented By</label>
                    <input type="text" name="presenter" placeholder="Zimbabwe Golf Association Presents" class="form-input" required value="{{ old('presenter') }}">
                </div>
                    
                <div class="mb-4">
                    <label class="form-label">Select Venue</label>
                    <select name="course_detail_id" id="course_detail_id" class="form-input" required>
                        <option value="">-- Choose Venue --</option>
                        @foreach($course_details_id as $course_detail_id)
                            <option value="{{ $course_detail_id->id }}">{{ $course_detail_id->name }}</option>
                        @endforeach
                    </select>
                </div>
                    
                <div>
                    <label class="form-label">Location Code</label>
                    <input type="text" name="location_code" placeholder="WRPG+M3 Masvingo" class="form-input" value="{{old('location_code')}}">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="start_date" class="form-label block mb-1 text-white">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-input w-full rounded p-2" required value="{{ old('start_date') }}">
                    </div>
                    
                    <div>
                        <label for="end_date" class="form-label block mb-1 text-white">End Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-input w-full rounded p-2" required value="{{old('end_date')}}">
                    </div>
                </div>
                    
                <div>
                    <label class="form-label">Entries Close Date</label>
                    <input type="date" name="entries_close" class="form-input" required value="{{old('entries_close')}}">
                </div>

                <!-- Rounds Section -->
                <div>
                    <label class="form-label">Number of Rounds</label>
                    <input type="number" name="rounds" min="1" class="form-input" placeholder="e.g. 2" value="{{ old('rounds') }}" required>
                </div>
                    
                <!-- Ladies Section -->
                <h4 class="my-4 text-xs">Ladies Categories</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Championship Handicap Range</label>
                        <input type="text" name="ladies_champ_handicap" placeholder="To 15.5" class="form-input" value="{{ old('ladies_champ_handicap') }}">
                    </div>
                    <div>
                        <label class="form-label">Championship Fee</label>
                        <input type="number" name="ladies_champ_fee" placeholder="$30" class="form-input" value="{{ old('ladies_champ_fee') }}">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Net Handicap Range</label>
                        <input type="text" name="ladies_net_handicap" placeholder="To 31.5" class="form-input" value="{{ old('ladies_net_handicap') }}">
                    </div>
                    <div>
                        <label class="form-label">Net Fee</label>
                        <input type="number" name="ladies_net_fee" placeholder="$20" class="form-input" value="{{ old('ladies_net_fee') }}">
                    </div>
                </div>
                    
                <!-- Men Section -->
                <h4 class="my-4 text-sm">Men Categories</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Championship Handicap Range</label>
                        <input type="text" name="men_champ_handicap" placeholder="To 16.1" class="form-input" value="{{ old('men_champ_handicap') }}">
                    </div>
                    <div>
                        <label class="form-label">Championship Fee</label>
                        <input type="number" name="men_champ_fee" placeholder="$30" class="form-input" value="{{ old('men_champ_fee') }}">
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Net Handicap Range</label>
                        <input type="text" name="men_net_handicap" placeholder="To 20.7" class="form-input" value="{{ old('men_net_handicap') }}">
                    </div>
                    <div>
                        <label class="form-label">Net Fee</label>
                        <input type="number" name="men_net_fee" placeholder="$20" class="form-input" value="{{ old('men_net_fee') }}">
                    </div>
                </div>
                <div class="my-4"><button class="green-red-btn">Create Tournament <span><i class="fa-solid fa-arrow-up fa-rotate-by" style="--fa-rotate-angle: 45deg;"></i></span></button></div>
            </form>
        </div>
    </div>
</x-admin>
