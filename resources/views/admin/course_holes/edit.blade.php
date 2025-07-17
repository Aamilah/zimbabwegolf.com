<x-admin :title="'Edit Hole Details for ' . $courseDetail->name">
    <div class="p-4">
        <x-file-section-bg>
            <form action="{{ route('admin.course-holes.update', [$courseDetail->id]) }}" method="POST">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <ul class="px-4 py-2 bg-red-100 rounded mb-4">
                        @foreach ($errors->all() as $error)
                            <li class="my-2 text-red-500">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="overflow-x-auto">
                    <table class="admin-table">
                        <thead class="bg-green-200">
                            <tr>
                                <th class="px-4 py-2 border">Hole Number</th>
                                <th class="px-4 py-2 border">Par</th>
                                <th class="px-4 py-2 border">Yardage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($holes as $hole)
                                <tr>
                                    <td class="px-4 py-2 border text-center">
                                        {{ $hole->hole_number }}
                                        <input type="hidden" name="hole_ids[]" value="{{ $hole->id }}">
                                    </td>
                                    <td class="px-4 py-2 border">
                                        <input type="number" name="par[]" class="form-input w-full" placeholder="Par" min="3" max="6" required value="{{ old('par.' . $loop->index, $hole->par) }}">
                                    </td>
                                    <td class="px-4 py-2 border">
                                        <input type="number" name="yardage[]" class="form-input w-full" placeholder="Yardage" min="50" max="700" required value="{{ old('yardage.' . $loop->index, $hole->yardage) }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="my-4 text-right">
                    <button class="green-red-btn">
                        Update Hole Details <span><i class="fa-solid fa-check"></i></span>
                    </button>
                </div>

            </form>
        </x-file-section-bg>
    </div>
</x-admin>