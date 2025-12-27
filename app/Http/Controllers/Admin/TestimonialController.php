<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentTestimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    /**
     * Display a listing of testimonials
     */
    public function index(Request $request)
    {
        $query = StudentTestimonial::active();

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('student_name', 'like', "%{$search}%")
                  ->orWhere('grade_level', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $testimonials = $query->orderBy('created_at', 'desc')->paginate(15);

        // Count by status
        $counts = [
            'all' => StudentTestimonial::active()->count(),
            'pending' => StudentTestimonial::active()->where('status', 'Pending')->count(),
            'approved' => StudentTestimonial::active()->where('status', 'Approved')->count(),
            'rejected' => StudentTestimonial::active()->where('status', 'Rejected')->count(),
        ];

        return view('admin.testimonials.index', compact('testimonials', 'counts'));
    }

    /**
     * Show the form for creating a new testimonial
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created testimonial
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'grade_level' => 'required|string|max:50',
            'message' => 'required|string|min:20',
            'status' => 'required|in:Pending,Approved,Rejected',
        ]);

        StudentTestimonial::create($validated);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimonial created successfully!');
    }

    /**
     * Display the specified testimonial
     */
    public function show(StudentTestimonial $testimonial)
    {
        return view('admin.testimonials.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified testimonial
     */
    public function edit(StudentTestimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified testimonial
     */
    public function update(Request $request, StudentTestimonial $testimonial)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'grade_level' => 'required|string|max:50',
            'message' => 'required|string|min:20',
            'status' => 'required|in:Pending,Approved,Rejected',
        ]);

        $testimonial->update($validated);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully!');
    }

    /**
     * Update testimonial status (approve/reject)
     */
    public function updateStatus(Request $request, StudentTestimonial $testimonial)
    {
        $request->validate([
            'status' => 'required|in:Approved,Rejected',
        ]);

        $testimonial->update(['status' => $request->status]);

        return redirect()
            ->back()
            ->with('success', "Testimonial {$request->status} successfully!");
    }

    /**
     * Remove the specified testimonial
     */
    public function destroy(StudentTestimonial $testimonial)
    {
        $testimonial->softDelete();

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted successfully!');
    }

    /**
     * Bulk delete testimonials
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:student_testimonials,id',
        ]);

        try {
            $deletedCount = 0;

            foreach ($request->ids as $id) {
                $testimonial = StudentTestimonial::find($id);
                if ($testimonial) {
                    $testimonial->softDelete();
                    $deletedCount++;
                }
            }

            return redirect()
                ->route('admin.testimonials.index')
                ->with('success', $deletedCount . ' testimonial(s) deleted successfully!');

        } catch (\Exception $e) {
            \Log::error('Bulk delete testimonials failed: ' . $e->getMessage());

            return redirect()
                ->route('admin.testimonials.index')
                ->with('error', 'An error occurred while deleting testimonials. Please try again.');
        }
    }
}
