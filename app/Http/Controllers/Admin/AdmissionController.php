<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdmissionController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }

    public function index(Request $request)
    {
        $query = Admission::active(); // Only show non-deleted admissions

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $admissions = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.admissions.index', compact('admissions'));
    }

    public function create()
    {
        return view('admin.admissions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:Male,Female,Other',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'grade_level' => 'required|string|max:50',
            'previous_school' => 'nullable|string|max:255',
            'guardian_name' => 'required|string|max:255',
            'guardian_relationship' => 'required|string|max:100',
            'guardian_contact' => 'required|string|max:20',
            'notes' => 'nullable|string|max:1000',
            'birth_certificate' => ['nullable', ...FileUploadService::getDocumentRules()],
            'report_card' => ['nullable', ...FileUploadService::getDocumentRules()],
            'photo' => ['nullable', ...FileUploadService::getImageRules()],
        ]);

        $admissionData = $validated;

        // Handle document uploads
        if ($request->hasFile('birth_certificate')) {
            $admissionData['birth_certificate_path'] = $this->fileUploadService->upload(
                $request->file('birth_certificate'),
                'admissions/documents'
            );
        }

        if ($request->hasFile('report_card')) {
            $admissionData['report_card_path'] = $this->fileUploadService->upload(
                $request->file('report_card'),
                'admissions/documents'
            );
        }

        if ($request->hasFile('photo')) {
            $admissionData['photo_path'] = $this->fileUploadService->upload(
                $request->file('photo'),
                'admissions/photos'
            );
        }

        // Remove file fields from admission data
        unset($admissionData['birth_certificate'], $admissionData['report_card'], $admissionData['photo']);

        // Set default status
        $admissionData['status'] = 'Pending';

        $admission = Admission::create($admissionData);

        return redirect()->route('admin.admissions.show', $admission)
            ->with('success', 'Admission created successfully.');
    }

    public function show(Admission $admission)
    {
        $admission->load('statusHistory.user');

        return view('admin.admissions.show', compact('admission'));
    }

    public function edit(Admission $admission)
    {
        return view('admin.admissions.edit', compact('admission'));
    }

    public function update(Request $request, Admission $admission)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:Male,Female,Other',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'grade_level' => 'required|string|max:50',
            'previous_school' => 'nullable|string|max:255',
            'guardian_name' => 'required|string|max:255',
            'guardian_relationship' => 'required|string|max:100',
            'guardian_contact' => 'required|string|max:20',
            'notes' => 'nullable|string|max:1000',
            'birth_certificate' => ['nullable', ...FileUploadService::getDocumentRules()],
            'report_card' => ['nullable', ...FileUploadService::getDocumentRules()],
            'photo' => ['nullable', ...FileUploadService::getImageRules()],
        ]);

        $updateData = $validated;

        // Handle document uploads
        if ($request->hasFile('birth_certificate')) {
            $updateData['birth_certificate_path'] = $this->fileUploadService->upload(
                $request->file('birth_certificate'),
                'admissions/documents',
                $admission->birth_certificate_path
            );
        }

        if ($request->hasFile('report_card')) {
            $updateData['report_card_path'] = $this->fileUploadService->upload(
                $request->file('report_card'),
                'admissions/documents',
                $admission->report_card_path
            );
        }

        if ($request->hasFile('photo')) {
            $updateData['photo_path'] = $this->fileUploadService->upload(
                $request->file('photo'),
                'admissions/photos',
                $admission->photo_path
            );
        }

        // Remove file fields from update data
        unset($updateData['birth_certificate'], $updateData['report_card'], $updateData['photo']);

        $admission->update($updateData);

        return redirect()->route('admin.admissions.show', $admission)
            ->with('success', 'Admission updated successfully.');
    }

    public function destroy(Admission $admission)
    {
        $admission->softDelete();

        return redirect()->route('admin.admissions.index')
            ->with('success', 'Admission deleted successfully.');
    }

    public function updateStatus(Request $request, Admission $admission)
    {
        $validated = $request->validate([
            'status' => 'required|in:Pending,Under Review,Approved,Rejected',
            'notes' => 'nullable|string|max:1000',
        ]);

        $admission->updateStatus(
            $validated['status'],
            $validated['notes'] ?? null,
            auth()->id()
        );

        return redirect()->back()
            ->with('success', 'Admission status updated successfully.');
    }

    public function export(Request $request)
    {
        $query = Admission::active(); // Only export non-deleted admissions

        // Apply same filters as index
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $admissions = $query->orderBy('created_at', 'desc')->get();

        $pdf = \PDF::loadView('admin.admissions.pdf', compact('admissions'));

        return $pdf->download('admissions-report-' . now()->format('Y-m-d') . '.pdf');
    }
}
