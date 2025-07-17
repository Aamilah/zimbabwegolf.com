<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseDetail;

class CourseHoleController extends Controller
{
    public function create(CourseDetail $courseDetail)
    {
        $holeNumbers = range(1, 18); // 18 holes
        return view('admin.course_holes.create', compact('courseDetail', 'holeNumbers'));
    }

    public function store(Request $request, CourseDetail $courseDetail)
    {
        $request->validate([
            'par.*' => 'required|integer|min:3|max:6',
            'yardage.*' => 'required|integer|min:50|max:700',
        ]);

        foreach ($request->input('par') as $index => $par) {
            $yardage = $request->input('yardage')[$index];

            $courseDetail->holes()->create([
                'hole_number' => $index + 1,
                'par' => $par,
                'yardage' => $yardage,
            ]);
        }

        return redirect()->route('admin.course-details.show', $courseDetail->id)
            ->with('success', 'Hole details saved successfully.');
    }
    
    public function edit(CourseDetail $courseDetail)
    {
        $holeNumbers = range(1, 18);
        $holes = $courseDetail->holes()->orderBy('hole_number')->get();

        return view('admin.course_holes.edit', compact('courseDetail', 'holeNumbers', 'holes'));
    }

    public function update(Request $request, CourseDetail $courseDetail)
    {
        $request->validate([
            'par.*' => 'required|integer|min:3|max:6',
            'yardage.*' => 'required|integer|min:50|max:700',
        ]);

        foreach ($request->input('par') as $index => $par) {
            $yardage = $request->input('yardage')[$index];
            $holeNumber = $index + 1;

            $hole = $courseDetail->holes()->where('hole_number', $holeNumber)->first();

            if ($hole) {
                $hole->update([
                    'par' => $par,
                    'yardage' => $yardage,
                ]);
            } else {
                $courseDetail->holes()->create([
                    'hole_number' => $holeNumber,
                    'par' => $par,
                    'yardage' => $yardage,
                ]);
            }
        }

        return redirect()->route('admin.course-details.show', $courseDetail->id)
            ->with('success', 'Hole details updated successfully.');
    }

    public function destroy(CourseDetail $courseDetail)
    {
        $courseDetail->holes()->delete();

        return redirect()->route('admin.course-details.show', $courseDetail->id)
            ->with('success', 'All hole details deleted successfully.');
    }

}
