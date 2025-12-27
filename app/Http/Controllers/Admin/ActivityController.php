<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Services\FileUploadService;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = Activity::active()
            ->orderBy('date_uploaded', 'desc')
            ->paginate(15);

        return view('admin.activities.index', compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.activities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'caption' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'post_type' => 'required|in:regular,youtube,facebook',
            'date_uploaded' => 'nullable|date',
            'youtube_url' => 'nullable|url|max:500',
            'facebook_url' => 'nullable|string',
            'image' => ['nullable', ...FileUploadService::getImageRules(5120)],
        ]);

        $activityData = [
            'caption' => $validated['caption'],
            'category' => $validated['category'] ?? '',
            'post_type' => $validated['post_type'],
            'date_uploaded' => $validated['date_uploaded'] ?? now(),
            'youtube_url' => $validated['youtube_url'] ?? null,
            'facebook_url' => $validated['facebook_url'] ?? null,
            'uploaded_by' => auth()->id(),
        ];

        // Handle image upload with optimization
        if ($request->hasFile('image')) {
            $activityData['link_image'] = $this->fileUploadService->upload(
                $request->file('image'),
                'activities'
            );
        }

        $activity = Activity::create($activityData);

        // Send notification to all students
        NotificationService::notifyNewActivity($activity);

        return redirect()->route('admin.activities.index')
            ->with('success', 'Activity created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        return view('admin.activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        return view('admin.activities.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'caption' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'post_type' => 'required|in:regular,youtube,facebook',
            'date_uploaded' => 'nullable|date',
            'youtube_url' => 'nullable|url|max:500',
            'facebook_url' => 'nullable|string',
            'image' => ['nullable', ...FileUploadService::getImageRules(5120)],
        ]);

        $updateData = [
            'caption' => $validated['caption'],
            'category' => $validated['category'] ?? '',
            'post_type' => $validated['post_type'],
            'date_uploaded' => $validated['date_uploaded'] ?? $activity->date_uploaded,
            'youtube_url' => $validated['youtube_url'] ?? null,
            'facebook_url' => $validated['facebook_url'] ?? null,
        ];

        // Handle image upload with optimization and old file deletion
        if ($request->hasFile('image')) {
            $updateData['link_image'] = $this->fileUploadService->upload(
                $request->file('image'),
                'activities',
                $activity->link_image // Pass old image for deletion
            );
        }

        $activity->update($updateData);

        return redirect()->route('admin.activities.index')
            ->with('success', 'Activity updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        // Delete image if exists
        if ($activity->link_image) {
            $this->fileUploadService->delete($activity->link_image);
        }

        // Soft delete
        $activity->softDelete();

        return redirect()->route('admin.activities.index')
            ->with('success', 'Activity deleted successfully.');
    }
}
