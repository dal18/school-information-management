<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdmissionFormController extends Controller
{
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
            'documents.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120', // 5MB max per file
        ]);

        try {
            $documentPaths = [];

            // Handle document uploads
            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $document) {
                    $fileName = time() . '_' . uniqid() . '.' . $document->getClientOriginalExtension();
                    $path = $document->storeAs('admissions/documents', $fileName, 'public');
                    $documentPaths[] = [
                        'original_name' => $document->getClientOriginalName(),
                        'stored_name' => $fileName,
                        'path' => $path,
                        'size' => $document->getSize(),
                        'mime_type' => $document->getMimeType(),
                    ];
                }
            }

            Admission::create([
                'first_name' => $validated['first_name'],
                'middle_name' => $validated['middle_name'],
                'last_name' => $validated['last_name'],
                'date_of_birth' => $validated['date_of_birth'],
                'gender' => $validated['gender'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'grade_level' => $validated['grade_level'],
                'previous_school' => $validated['previous_school'],
                'guardian_name' => $validated['guardian_name'],
                'guardian_relationship' => $validated['guardian_relationship'],
                'guardian_contact' => $validated['guardian_contact'],
                'status' => 'Pending',
                'documents' => !empty($documentPaths) ? $documentPaths : null,
            ]);

            return redirect()->back()->with('success', 'Your admission application has been submitted successfully! You will receive a confirmation email shortly.');
        } catch (\Exception $e) {
            // Clean up uploaded files if database insertion fails
            if (!empty($documentPaths)) {
                foreach ($documentPaths as $doc) {
                    Storage::disk('public')->delete($doc['path']);
                }
            }

            return redirect()->back()->with('error', 'Sorry, something went wrong. Please try again later.')
                ->withInput();
        }
    }
}
