<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Services\FileUploadService;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Display a listing of stories
     */
    public function index(Request $request)
    {
        $query = Story::active();

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('student_name', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $stories = $query->recent()->paginate(15);

        return view('admin.stories.index', compact('stories'));
    }

    /**
     * Show the form for creating a new story
     */
    public function create()
    {
        return view('admin.stories.create');
    }

    /**
     * Store a newly created story
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:50',
            'grade_level' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $this->fileUploadService->upload(
                $request->file('image'),
                'stories'
            );
        }

        Story::create($validated);

        return redirect()
            ->route('admin.stories.index')
            ->with('success', 'Story created successfully!');
    }

    /**
     * Display the specified story
     */
    public function show(Story $story)
    {
        return view('admin.stories.show', compact('story'));
    }

    /**
     * Show the form for editing the specified story
     */
    public function edit(Story $story)
    {
        return view('admin.stories.edit', compact('story'));
    }

    /**
     * Update the specified story
     */
    public function update(Request $request, Story $story)
    {
        $validated = $request->validate([
            'student_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'required|string|min:50',
            'grade_level' => 'required|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $this->fileUploadService->upload(
                $request->file('image'),
                'stories',
                $story->image
            );
        }

        $story->update($validated);

        return redirect()
            ->route('admin.stories.index')
            ->with('success', 'Story updated successfully!');
    }

    /**
     * Remove the specified story
     */
    public function destroy(Story $story)
    {
        $story->softDelete();

        return redirect()
            ->route('admin.stories.index')
            ->with('success', 'Story deleted successfully!');
    }

    /**
     * Bulk delete stories
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:stories,id',
        ]);

        try {
            $deletedCount = 0;

            foreach ($request->ids as $id) {
                $story = Story::find($id);
                if ($story) {
                    $story->softDelete();
                    $deletedCount++;
                }
            }

            return redirect()
                ->route('admin.stories.index')
                ->with('success', $deletedCount . ' story(ies) deleted successfully!');

        } catch (\Exception $e) {
            \Log::error('Bulk delete stories failed: ' . $e->getMessage());

            return redirect()
                ->route('admin.stories.index')
                ->with('error', 'An error occurred while deleting stories. Please try again.');
        }
    }
}
