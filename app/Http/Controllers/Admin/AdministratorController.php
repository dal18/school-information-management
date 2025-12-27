<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administrator;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdministratorController extends Controller
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
        $administrators = Administrator::active()
            ->ordered()
            ->paginate(15);

        return view('admin.administrators.index', compact('administrators'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.administrators.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'category' => 'required|in:Directors,Principals,Administrative Staff',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'bio' => 'nullable|string',
            'image' => ['nullable', ...FileUploadService::getImageRules(5120)],
            'display_order' => 'nullable|integer|min:0',
        ]);

        // Handle image upload with optimization
        if ($request->hasFile('image')) {
            $validated['image'] = $this->fileUploadService->upload(
                $request->file('image'),
                'administrators'
            );
        }

        // Set default display_order if not provided
        if (!isset($validated['display_order'])) {
            $maxOrder = Administrator::active()->max('display_order') ?? 0;
            $validated['display_order'] = $maxOrder + 1;
        }

        Administrator::create($validated);

        return redirect()->route('admin.administrators.index')
            ->with('success', 'Administrator added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Administrator $administrator)
    {
        return view('admin.administrators.show', compact('administrator'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Administrator $administrator)
    {
        return view('admin.administrators.edit', compact('administrator'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Administrator $administrator)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'category' => 'required|in:Directors,Principals,Administrative Staff',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'bio' => 'nullable|string',
            'image' => ['nullable', ...FileUploadService::getImageRules(5120)],
            'display_order' => 'nullable|integer|min:0',
        ]);

        // Handle image upload with optimization and old file deletion
        if ($request->hasFile('image')) {
            $validated['image'] = $this->fileUploadService->upload(
                $request->file('image'),
                'administrators',
                $administrator->image // Pass old image for deletion
            );
        }

        $administrator->update($validated);

        return redirect()->route('admin.administrators.index')
            ->with('success', 'Administrator updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administrator $administrator)
    {
        // Delete image file
        if ($administrator->image) {
            $this->fileUploadService->delete($administrator->image);
        }

        // Soft delete
        $administrator->softDelete();

        return redirect()->route('admin.administrators.index')
            ->with('success', 'Administrator deleted successfully.');
    }
}
