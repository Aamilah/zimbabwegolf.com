<x-admin :title="'Add Hole Details for ' . $courseDetail->name">
    <div class="p-4">
        <x-file-section-bg>
            <form action="{{ route('admin.course-holes.store', $courseDetail->id) }}" method="POST">
                @csrf

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
                            @foreach ($holeNumbers as $hole)
                                <tr>
                                    <td class="px-4 py-2 border text-center">{{ $hole }}</td>
                                    <td class="px-4 py-2 border">
                                        <input type="number" name="par[]" class="form-input w-full" placeholder="Par" min="3" max="6" required>
                                    </td>
                                    <td class="px-4 py-2 border">
                                        <input type="number" name="yardage[]" class="form-input w-full" placeholder="Yardage" min="50" max="700" required>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="my-4 text-right">
                    <button class="green-red-btn">
                        Save Hole Details <span><i class="fa-solid fa-check"></i></span>
                    </button>
                </div>

            </form>
        </x-file-section-bg>
    </div>
</x-admin>
