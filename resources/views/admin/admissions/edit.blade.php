@extends('layouts.admin')

@section('title', 'Edit Admission')

@section('header')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Edit Admission</h1>
        <p class="text-gray-600 mt-1">Update admission application details</p>
    </div>
    <a href="{{ route('admin.admissions.show', $admission) }}"
        class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded-lg transition duration-300">
        <i class="fas fa-arrow-left mr-2"></i>Back
    </a>
</div>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-md p-8">
    <form action="{{ route('admin.admissions.update', $admission) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Student Information -->
        <div class="mb-8">
            <h3 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b">Student Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">
                        First Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $admission->first_name) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('first_name') border-red-500 @enderror">
                    @error('first_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="middle_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Middle Name
                    </label>
                    <input type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', $admission->middle_name) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>

                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Last Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $admission->last_name) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('last_name') border-red-500 @enderror">
                    @error('last_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <div>
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-2">
                        Date of Birth <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $admission->date_of_birth->format('Y-m-d')) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('date_of_birth') border-red-500 @enderror">
                    @error('date_of_birth')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">
                        Gender <span class="text-red-500">*</span>
                    </label>
                    <select name="gender" id="gender" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('gender') border-red-500 @enderror">
                        <option value="">Select Gender</option>
                        <option value="Male" {{ old('gender', $admission->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender', $admission->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender', $admission->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('gender')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="mb-8">
            <h3 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b">Contact Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email', $admission->email) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('email') border-red-500 @enderror">
                    @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                        Phone Number <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone', $admission->phone) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('phone') border-red-500 @enderror">
                    @error('phone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                    Complete Address <span class="text-red-500">*</span>
                </label>
                <textarea name="address" id="address" rows="3" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('address') border-red-500 @enderror">{{ old('address', $admission->address) }}</textarea>
                @error('address')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Academic Information -->
        <div class="mb-8">
            <h3 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b">Academic Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="grade_level" class="block text-sm font-medium text-gray-700 mb-2">
                        Applying for Grade Level <span class="text-red-500">*</span>
                    </label>
                    <select name="grade_level" id="grade_level" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('grade_level') border-red-500 @enderror">
                        <option value="">Select Grade Level</option>
                        <option value="Grade 7" {{ old('grade_level', $admission->grade_level) == 'Grade 7' ? 'selected' : '' }}>Grade 7</option>
                        <option value="Grade 8" {{ old('grade_level', $admission->grade_level) == 'Grade 8' ? 'selected' : '' }}>Grade 8</option>
                        <option value="Grade 9" {{ old('grade_level', $admission->grade_level) == 'Grade 9' ? 'selected' : '' }}>Grade 9</option>
                        <option value="Grade 10" {{ old('grade_level', $admission->grade_level) == 'Grade 10' ? 'selected' : '' }}>Grade 10</option>
                        <option value="Grade 11" {{ old('grade_level', $admission->grade_level) == 'Grade 11' ? 'selected' : '' }}>Grade 11</option>
                        <option value="Grade 12" {{ old('grade_level', $admission->grade_level) == 'Grade 12' ? 'selected' : '' }}>Grade 12</option>
                    </select>
                    @error('grade_level')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="previous_school" class="block text-sm font-medium text-gray-700 mb-2">
                        Previous School
                    </label>
                    <input type="text" name="previous_school" id="previous_school" value="{{ old('previous_school', $admission->previous_school) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
            </div>
        </div>

        <!-- Guardian Information -->
        <div class="mb-8">
            <h3 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b">Guardian Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="guardian_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Guardian Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="guardian_name" id="guardian_name" value="{{ old('guardian_name', $admission->guardian_name) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('guardian_name') border-red-500 @enderror">
                    @error('guardian_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="guardian_relationship" class="block text-sm font-medium text-gray-700 mb-2">
                        Relationship <span class="text-red-500">*</span>
                    </label>
                    <select name="guardian_relationship" id="guardian_relationship" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('guardian_relationship') border-red-500 @enderror">
                        <option value="">Select Relationship</option>
                        <option value="Father" {{ old('guardian_relationship', $admission->guardian_relationship) == 'Father' ? 'selected' : '' }}>Father</option>
                        <option value="Mother" {{ old('guardian_relationship', $admission->guardian_relationship) == 'Mother' ? 'selected' : '' }}>Mother</option>
                        <option value="Legal Guardian" {{ old('guardian_relationship', $admission->guardian_relationship) == 'Legal Guardian' ? 'selected' : '' }}>Legal Guardian</option>
                        <option value="Other" {{ old('guardian_relationship', $admission->guardian_relationship) == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('guardian_relationship')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="guardian_contact" class="block text-sm font-medium text-gray-700 mb-2">
                        Guardian Contact <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" name="guardian_contact" id="guardian_contact" value="{{ old('guardian_contact', $admission->guardian_contact) }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('guardian_contact') border-red-500 @enderror">
                    @error('guardian_contact')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Document Uploads -->
        <div class="mb-8">
            <h3 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b">Documents</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="birth_certificate" class="block text-sm font-medium text-gray-700 mb-2">
                        Birth Certificate
                    </label>
                    @if($admission->birth_certificate_path)
                        <div class="mb-2">
                            <a href="{{ asset('storage/' . $admission->birth_certificate_path) }}" target="_blank" class="text-sm text-primary-600 hover:underline">
                                <i class="fas fa-file-pdf mr-1"></i>View Current
                            </a>
                        </div>
                    @endif
                    <input type="file" name="birth_certificate" id="birth_certificate" accept=".pdf,.jpg,.jpeg,.png"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <p class="mt-1 text-xs text-gray-500">PDF, JPG, PNG (Max 5MB)</p>
                    @error('birth_certificate')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="report_card" class="block text-sm font-medium text-gray-700 mb-2">
                        Report Card
                    </label>
                    @if($admission->report_card_path)
                        <div class="mb-2">
                            <a href="{{ asset('storage/' . $admission->report_card_path) }}" target="_blank" class="text-sm text-primary-600 hover:underline">
                                <i class="fas fa-file-pdf mr-1"></i>View Current
                            </a>
                        </div>
                    @endif
                    <input type="file" name="report_card" id="report_card" accept=".pdf,.jpg,.jpeg,.png"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <p class="mt-1 text-xs text-gray-500">PDF, JPG, PNG (Max 5MB)</p>
                    @error('report_card')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">
                        Student Photo
                    </label>
                    @if($admission->photo_path)
                        <div class="mb-2">
                            <a href="{{ asset('storage/' . $admission->photo_path) }}" target="_blank" class="text-sm text-primary-600 hover:underline">
                                <i class="fas fa-image mr-1"></i>View Current
                            </a>
                        </div>
                    @endif
                    <input type="file" name="photo" id="photo" accept=".jpg,.jpeg,.png"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <p class="mt-1 text-xs text-gray-500">JPG, PNG (Max 2MB)</p>
                    @error('photo')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Notes -->
        <div class="mb-8">
            <h3 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b">Admin Notes</h3>
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                    Notes (Optional)
                </label>
                <textarea name="notes" id="notes" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                    placeholder="Add any additional notes or comments...">{{ old('notes', $admission->notes) }}</textarea>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex items-center justify-end space-x-4 pt-6 border-t">
            <a href="{{ route('admin.admissions.show', $admission) }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-8 py-3 rounded-lg transition duration-300">
                Cancel
            </a>
            <button type="submit"
                class="bg-primary-600 hover:bg-primary-700 text-white font-semibold px-8 py-3 rounded-lg transition duration-300">
                <i class="fas fa-save mr-2"></i>Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
