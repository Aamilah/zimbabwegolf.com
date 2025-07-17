<x-admin :title="'Player Details'">
<x-alert type="success" />
<div>
    <div class="z-50 absolute right-16 flex flex-row gap-2">
        <a href="{{ route('admin.course-details.edit', $courseDetail->id) }}">
            <button class="inverted-corner-btn w-10 h-10 items-center justify-center">
                <i class="fa-solid fa-clipboard"></i>
            </button>
        </a>
        <form action="{{ route('admin.course-details.destroy', $courseDetail->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete all the details for this course?');">
        @csrf
        @method('DELETE')
            <button type="submit" class="trash-btn inverted-corner-btn w-10 h-10  rounded-full flex items-center justify-center">
                <i class="text-sm fa-solid fa-trash"></i>
            </button>
        </form>
        <x-home-button/>
        <x-back-button/>
    </div> 
    <div class="inverted-radius my-5 relative">
        <div class="inverted-radius-content">
            <div class="flex flex-wrap items-center gap-2 mb-4">
                <div class="filter-tab">Golf Course Details</div>
            </div>
            <div class="table-wrapper">
                <table class="admin-table searchable-table">
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{ $courseDetail->name }}</td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td>{{ $courseDetail->location }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $courseDetail->description }}</td>
                        </tr>
                        <tr>
                            <th>Par</th>
                            <td>{{ $courseDetail->par }}</td>
                        </tr>
                        <tr>
                            <th>Total Yardage</th>
                            <td>{{ $courseDetail->total_yardage }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div>
    <div class="z-50 absolute right-16 flex flex-row gap-2">
        <a href="{{ route('admin.course-holes.edit', $courseDetail->id) }}">
            <button class="inverted-corner-btn w-10 h-10 items-center justify-center">
                <i class="fa-solid fa-clipboard"></i>
            </button>
        </a>
        <form action="{{ route('admin.course-holes.destroy', $courseDetail->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete these hole details?');">
        @csrf
        @method('DELETE')
            <button type="submit" class="trash-btn inverted-corner-btn w-10 h-10  rounded-full flex items-center justify-center">
                <i class="text-sm fa-solid fa-trash"></i>
            </button>
        </form>
        <x-home-button/>
        <x-back-button/>
    </div> 
    <div class="inverted-radius my-5 relative">
        <div class="inverted-radius-content">
            <div class="flex flex-wrap items-center gap-2 mb-4">
                <div class="filter-tab">Hole Details</div>
            </div>
            @php
                $holes = $courseDetail->holes()->orderBy('hole_number')->get();

                $inPar = $holes->where('hole_number', '<=', 9)->sum('par');
                $outPar = $holes->where('hole_number', '>', 9)->sum('par');
                $totalPar = $holes->sum('par');

                $inYardage = $holes->where('hole_number', '<=', 9)->sum('yardage');
                $outYardage = $holes->where('hole_number', '>', 9)->sum('yardage');
                $totalYardage = $holes->sum('yardage');
            @endphp

            <div class="table-wrapper overflow-x-auto">
                <table class="admin-table searchable-table text-center">
                    <thead>
                        <tr>
                            <th>Hole</th>
                            @foreach ($holes as $hole)
                                @if ($hole->hole_number == 9)
                                    <th>{{ $hole->hole_number }}</th>
                                    <th>In</th> <!-- After Hole 9 -->
                                @elseif ($hole->hole_number == 18)
                                    <th>{{ $hole->hole_number }}</th>
                                    <th>Out</th> <!-- After Hole 18 -->
                                    <th>Total</th> <!-- Final total -->
                                @else
                                    <th>{{ $hole->hole_number }}</th>
                                @endif
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Par</td>
                            @forelse ($holes as $hole)
                                @if ($hole->hole_number == 9)
                                    <th>{{  $hole->par  }}</th>
                                    <td>{{ $inPar }}</td>
                                @elseif ($hole->hole_number == 18)
                                    <th>{{  $hole->par }}</th>
                                    <td>{{ $outPar }}</td>
                                    <td>{{ $totalPar }}</td>
                                @else
                                    <th>{{  $hole->par }}</th>
                                @endif
                            @empty
                                <td colspan="99">No hole details available for this course.</td>
                            @endforelse
                        </tr>
                        <tr>
                            <td>Yardage</td>
                            @forelse ($holes as $hole)
                                @if ($hole->hole_number == 9)
                                    <th>{{  $hole->yardage }}</th>
                                    <td>{{ $inYardage }}</td>
                                @elseif ($hole->hole_number == 18)
                                    <th>{{  $hole->yardage }}</th>
                                    <td>{{ $outYardage }}</td>
                                    <td>{{ $totalYardage }}</td>
                                @else
                                    <th>{{ $hole->yardage }}</th>
                                @endif
                            @empty

                            @endforelse
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</x-admin>
