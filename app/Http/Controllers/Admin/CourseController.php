<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('grade_level')
            ->orderBy('subject_name')
            ->paginate(15);

        return view('admin.courses.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'grade_level' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('courses', $fileName, 'public');
        }

        Subject::create([
            'subject_name' => $validated['subject_name'],
            'description' => $validated['description'],
            'grade_level' => $validated['grade_level'],
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course created successfully.');
    }

    public function show(Subject $course)
    {
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Subject $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Subject $course)
    {
        $validated = $request->validate([
            'subject_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'grade_level' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
        ]);

        $imagePath = $course->image_path;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($course->image_path) {
                Storage::disk('public')->delete($course->image_path);
            }

            $image = $request->file('image');
            $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('courses', $fileName, 'public');
        }

        $course->update([
            'subject_name' => $validated['subject_name'],
            'description' => $validated['description'],
            'grade_level' => $validated['grade_level'],
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function destroy(Subject $course)
    {
        // Delete image if exists
        if ($course->image_path) {
            Storage::disk('public')->delete($course->image_path);
        }

        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', 'Course deleted successfully.');
    }
}
