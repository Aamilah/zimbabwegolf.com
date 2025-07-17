<x-admin :title="'Add A Course Hole Details'">
    <div class="p-4">
        <x-file-section-bg>
            <form action="{{ route('admin.course-details.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                    @if ($errors->any())
                        <ul class="px-4 py-2 bg-red-100 rounded mb-4">
                            @foreach ($errors->all() as $error)
                                <li class="my-2 text-red-500">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="mb-4">
                        <label for="name" class="form-label">Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required class="form-input w-full" />
                    </div>

                    <div class="mb-4">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}" class="form-input w-full" />
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" rows="3" class="form-input w-full">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="par" class="form-label">Par</label>
                        <input type="number" name="par" id="par" value="{{ old('par') }}" class="form-input" min="1" />
                    </div>

                    <div class="mb-4">
                        <label for="total_yardage" class="form-label">Total Yardage</label>
                        <input type="number" name="total_yardage" id="total_yardage" value="{{ old('total_yardage') }}" class="form-input" min="0" />
                    </div>

                    <div class="my-4">
                        <button class="green-red-btn">
                            Add Course <span><i class="fa-solid fa-plus"></i></span>
                        </button>
                    </div>

                </form>
        </x-file-section-bg>
    </div>
</x-admin>