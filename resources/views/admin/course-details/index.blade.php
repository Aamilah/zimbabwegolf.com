<x-admin :title="'Players Overview'">
<x-alert type="success" />
    <div class="link-grid">
        <div class="col-span-1">
            <div class="link-grid-item">
                <div>
                    <div class="text-sm">Add to Database</div>
                    <div class="text-2xl font-semibold">Add A Course</div>
                    <a href="{{ route('admin.course-details.create') }}">
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
                    <div class="text-sm">Add to Database</div>
                    <div class="text-2xl font-semibold">View All Course Details</div>
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
                    <div class="text-sm">Add to Database</div>
                    <div class="text-2xl font-semibold">Update A Course & Hole Information</div>
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
                    <div class="text-2xl font-semibold">Delete A Course</div>
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
        <x-table-bg-admin>
            <div class="table-wrapper">
                <table class="admin-table searchable-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Description</th>
                            <th>Par</th>
                            <th>Total Yardage</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($courseDetail as $course)
                            <tr>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->location }}</td>
                                <td>{{ $course->description }}</td>
                                <td>{{ $course->par }}</td>
                                <td>{{ $course->total_yardage }}</td>
                                <td class="flex gap-2 items-center justify-center">
                                    <a href="{{ route('admin.course-details.show', $course->id) }}" class="w-10 h-10 bg-[#68d362] text-white rounded-full flex items-center justify-center">
                                        <i class="text-sm fa-solid fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.course-details.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete all the details for this course?');">
                                    @csrf
                                    @method('DELETE')
                                        <button type="submit" class="trash-btn inverted-corner-btn w-10 h-10  rounded-full flex items-center justify-center">
                                            <i class="text-sm fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">No courses found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $courseDetail->links('vendor.pagination.adminpagination') }}
            </div>
        </x-table-bg-admin>
    </div>
</x-admin>