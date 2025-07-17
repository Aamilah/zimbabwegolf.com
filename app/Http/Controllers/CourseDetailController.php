<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseDetail;

class CourseDetailController extends Controller
{
    public function index(){
        $courseDetail = CourseDetail::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.course-details.index', compact('courseDetail'));
    }
    public function create()
    {
        return view('admin.course-details.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'par' => 'nullable|integer',
            'total_yardage' => 'nullable|integer',
        ]);

        $course = CourseDetail::create([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'par' => $request->par,
            'total_yardage' => $request->total_yardage,
        ]);


        return redirect()->route('admin.course-holes.create', $course->id)
            ->with('success', 'Course created successfully. Now add hole details.');
    }

    
    public function show(CourseDetail $courseDetail) {
        $courseDetail->load(['holes' => function ($query) {
            $query->orderBy('hole_number');
        }]);

        return view('admin.course-details.show', compact('courseDetail'));
    }

    public function edit(CourseDetail $courseDetail)
    {
        return view('admin.course-details.edit', compact('courseDetail'));
    }

    public function update(Request $request, CourseDetail $courseDetail)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'par' => 'nullable|integer',
            'total_yardage' => 'nullable|integer',
        ]);

        $courseDetail->update([
            'name' => $request->name,
            'location' => $request->location,
            'description' => $request->description,
            'par' => $request->par,
            'total_yardage' => $request->total_yardage,
        ]);

        return redirect()->route('admin.course-details.show', $courseDetail->id)
            ->with('success', 'Course details updated successfully.');
    }

    public function destroy(CourseDetail $courseDetail)
    {
        // Delete related holes first to maintain integrity
        $courseDetail->holes()->delete();

        // Delete the course
        $courseDetail->delete();

        return redirect()->route('admin.course-details.index')
            ->with('success', 'Course and all related holes deleted successfully.');
    }

}
