<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    public function index()
    {
        $facilities = Facility::active()
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('admin.facilities.index', compact('facilities'));
    }

    public function create()
    {
        return view('admin.facilities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'caption' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'image' => ['nullable', ...FileUploadService::getImageRules(5120)], // 5MB
        ]);

        $facilityData = [
            'caption' => $validated['caption'],
            'detail' => $validated['detail'],
        ];

        // Handle image upload with optimization
        if ($request->hasFile('image')) {
            try {
                $facilityData['image_path'] = $this->fileUploadService->upload(
                    $request->file('image'),
                    'facilities'
                );
            } catch (\Exception $e) {
                \Log::error('Facility image upload failed', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);

                return back()
                    ->withInput()
                    ->withErrors(['image' => 'Failed to upload image: ' . $e->getMessage()]);
            }
        }

        Facility::create($facilityData);

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Facility created successfully.');
    }

    public function show(Facility $facility)
    {
        return view('admin.facilities.show', compact('facility'));
    }

    public function edit(Facility $facility)
    {
        return view('admin.facilities.edit', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        // Debug logging
        \Log::info('Facility update attempt', [
            'facility_id' => $facility->id,
            'has_file' => $request->hasFile('image'),
            'file_valid' => $request->hasFile('image') ? $request->file('image')->isValid() : null,
            'file_size' => $request->hasFile('image') ? $request->file('image')->getSize() : null,
            'file_mime' => $request->hasFile('image') ? $request->file('image')->getMimeType() : null,
        ]);

        $validated = $request->validate([
            'caption' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'image' => ['nullable', ...FileUploadService::getImageRules(5120)], // 5MB
        ]);

        $updateData = [
            'caption' => $validated['caption'],
            'detail' => $validated['detail'],
        ];

        // Handle image upload with optimization and old file deletion
        if ($request->hasFile('image')) {
            try {
                $updateData['image_path'] = $this->fileUploadService->upload(
                    $request->file('image'),
                    'facilities',
                    $facility->image_path // Pass old image for deletion
                );
            } catch (\Exception $e) {
                \Log::error('Facility image upload failed', [
                    'facility_id' => $facility->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);

                return back()
                    ->withInput()
                    ->withErrors(['image' => 'Failed to upload image: ' . $e->getMessage()]);
            }
        }

        $facility->update($updateData);

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Facility updated successfully.');
    }

    public function updateWithFile(Request $request, Facility $facility)
    {
        // Debug logging
        \Log::info('Facility update with file attempt (POST)', [
            'facility_id' => $facility->id,
            'has_file' => $request->hasFile('image'),
            'file_valid' => $request->hasFile('image') ? $request->file('image')->isValid() : null,
            'file_size' => $request->hasFile('image') ? $request->file('image')->getSize() : null,
            'file_mime' => $request->hasFile('image') ? $request->file('image')->getMimeType() : null,
        ]);

        $validated = $request->validate([
            'caption' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'image' => ['nullable', ...FileUploadService::getImageRules(5120)], // 5MB
        ]);

        $updateData = [
            'caption' => $validated['caption'],
            'detail' => $validated['detail'],
        ];

        // Handle image upload with optimization and old file deletion
        if ($request->hasFile('image')) {
            try {
                $updateData['image_path'] = $this->fileUploadService->upload(
                    $request->file('image'),
                    'facilities',
                    $facility->image_path // Pass old image for deletion
                );
            } catch (\Exception $e) {
                \Log::error('Facility image upload failed', [
                    'facility_id' => $facility->id,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);

                return back()
                    ->withInput()
                    ->withErrors(['image' => 'Failed to upload image: ' . $e->getMessage()]);
            }
        }

        $facility->update($updateData);

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Facility updated successfully.');
    }

    public function destroy(Facility $facility)
    {
        // Delete image if exists
        if ($facility->image_path) {
            $this->fileUploadService->delete($facility->image_path);
        }

        $facility->softDelete();

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Facility deleted successfully.');
    }
}
