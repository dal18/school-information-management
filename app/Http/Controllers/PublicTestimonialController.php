<?php

namespace App\Http\Controllers;

use App\Models\StudentTestimonial;
use Illuminate\Http\Request;

class PublicTestimonialController extends Controller
{
    /**
     * Display approved testimonials
     */
    public function index()
    {
        $testimonials = StudentTestimonial::active()
            ->approved()
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('public.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for submitting a testimonial
     */
    public function create()
    {
        return view('public.testimonials.create');
    }

    /**
     * Store a newly submitted testimonial (will be pending by default)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'grade_level' => 'required|string|max:50',
            'message' => 'required|string|min:20|max:1000',
        ]);

        // Set status as Pending by default
        $validated['status'] = 'Pending';

        StudentTestimonial::create($validated);

        return redirect()
            ->route('testimonials.create')
            ->with('success', 'Thank you for your testimonial! It will be reviewed and published soon.');
    }
}
