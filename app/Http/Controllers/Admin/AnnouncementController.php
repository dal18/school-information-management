<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Services\FileUploadService;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    public function index()
    {
        $announcements = Announcement::with('author')
            ->active()
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('admin.announcements.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => ['nullable', ...FileUploadService::getImageRules()],
        ]);

        $announcementData = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'posted_by' => auth()->id(),
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $announcementData['image_path'] = $this->fileUploadService->upload(
                $request->file('image'),
                'announcements'
            );
        }

        $announcement = Announcement::create($announcementData);

        // Send notification to all students and teachers
        NotificationService::notifyNewAnnouncement($announcement);

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement created successfully.');
    }

    public function show(Announcement $announcement)
    {
        return view('admin.announcements.show', compact('announcement'));
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => ['nullable', ...FileUploadService::getImageRules()],
        ]);

        $updateData = [
            'title' => $validated['title'],
            'content' => $validated['content'],
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $updateData['image_path'] = $this->fileUploadService->upload(
                $request->file('image'),
                'announcements',
                $announcement->image_path // Pass old image for deletion
            );
        }

        $announcement->update($updateData);

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement updated successfully.');
    }

    public function destroy(Announcement $announcement)
    {
        // Delete image if exists
        if ($announcement->image_path) {
            $this->fileUploadService->delete($announcement->image_path);
        }

        $announcement->softDelete();

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement deleted successfully.');
    }
}
