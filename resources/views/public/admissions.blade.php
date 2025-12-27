@extends('layouts.public')

@section('title', 'Admissions')

@section('content')
<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => 'Academics', 'url' => '#'],
    ['label' => 'Admissions', 'icon' => 'fas fa-user-graduate']
]" />

<!-- Hero Section -->
<section class="relative py-16 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-display font-bold mb-4">
                Admissions
            </h1>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                Join Our Community of Excellence
            </p>
        </div>
    </div>
</section>

<!-- Admission Information -->
<section class="modern-section modern-section-white">
    <div class="modern-container">
        <div class="modern-grid modern-grid-3 mb-16">
            <!-- Info Card 1 -->
            <div class="modern-card hover-lift bg-gradient-to-br from-primary-50 to-white">
                <div class="modern-card-content text-center">
                    <div class="w-16 h-16 bg-primary-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-calendar-alt text-2xl text-white"></i>
                    </div>
                    <h3 class="modern-card-title mb-2">Application Deadline</h3>
                    <p class="modern-card-text">{{ config('app.admission_deadline', 'December 31, 2024') }}</p>
                </div>
            </div>

            <!-- Info Card 2 -->
            <div class="modern-card hover-lift bg-gradient-to-br from-secondary-50 to-white">
                <div class="modern-card-content text-center">
                    <div class="w-16 h-16 bg-secondary-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-file-alt text-2xl text-white"></i>
                    </div>
                    <h3 class="modern-card-title mb-2">Required Documents</h3>
                    <p class="modern-card-text">Birth Certificate, Report Cards, ID</p>
                </div>
            </div>

            <!-- Info Card 3 -->
            <div class="modern-card hover-lift bg-gradient-to-br from-primary-50 to-white">
                <div class="modern-card-content text-center">
                    <div class="w-16 h-16 bg-primary-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-2xl text-white"></i>
                    </div>
                    <h3 class="modern-card-title mb-2">Processing Time</h3>
                    <p class="modern-card-text">2-3 weeks after submission</p>
                </div>
            </div>
        </div>

        <!-- Admission Process -->
        <div class="mb-16">
            <h2 class="modern-heading-lg text-center mb-8">Admission Process</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="w-12 h-12 bg-primary-600 text-white rounded-full flex items-center justify-center mx-auto mb-3 text-xl font-bold">1</div>
                    <h4 class="modern-card-title mb-2">Submit Application</h4>
                    <p class="modern-card-text">Complete the online form below</p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-primary-600 text-white rounded-full flex items-center justify-center mx-auto mb-3 text-xl font-bold">2</div>
                    <h4 class="modern-card-title mb-2">Review Process</h4>
                    <p class="modern-card-text">Our team reviews your application</p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-primary-600 text-white rounded-full flex items-center justify-center mx-auto mb-3 text-xl font-bold">3</div>
                    <h4 class="modern-card-title mb-2">Interview</h4>
                    <p class="modern-card-text">Meet with our admissions team</p>
                </div>
                <div class="text-center">
                    <div class="w-12 h-12 bg-primary-600 text-white rounded-full flex items-center justify-center mx-auto mb-3 text-xl font-bold">4</div>
                    <h4 class="modern-card-title mb-2">Decision</h4>
                    <p class="modern-card-text">Receive admission decision</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Application Form -->
<section class="modern-section modern-section-bg">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="modern-card shadow-modern-lg">
            <div class="modern-card-content">
                <h2 class="modern-heading-lg mb-2">Application Form</h2>
                <p class="modern-text-lead mb-8">Please fill out all required fields to submit your application.</p>

            @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
            @endif

            <form action="{{ route('admissions.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Student Information -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b">Student Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">
                                First Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('first_name') border-red-500 @enderror">
                            @error('first_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="middle_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Middle Name
                            </label>
                            <input type="text" name="middle_name" id="middle_name" value="{{ old('middle_name') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Last Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required
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
                            <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" required
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
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b">Contact Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('email') border-red-500 @enderror">
                            @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Phone Number <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
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
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('address') border-red-500 @enderror">{{ old('address') }}</textarea>
                        @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Academic Information -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b">Academic Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="grade_level" class="block text-sm font-medium text-gray-700 mb-2">
                                Applying for Grade Level <span class="text-red-500">*</span>
                            </label>
                            <select name="grade_level" id="grade_level" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('grade_level') border-red-500 @enderror">
                                <option value="">Select Grade Level</option>
                                <option value="Grade 7" {{ old('grade_level') == 'Grade 7' ? 'selected' : '' }}>Grade 7</option>
                                <option value="Grade 8" {{ old('grade_level') == 'Grade 8' ? 'selected' : '' }}>Grade 8</option>
                                <option value="Grade 9" {{ old('grade_level') == 'Grade 9' ? 'selected' : '' }}>Grade 9</option>
                                <option value="Grade 10" {{ old('grade_level') == 'Grade 10' ? 'selected' : '' }}>Grade 10</option>
                                <option value="Grade 11" {{ old('grade_level') == 'Grade 11' ? 'selected' : '' }}>Grade 11</option>
                                <option value="Grade 12" {{ old('grade_level') == 'Grade 12' ? 'selected' : '' }}>Grade 12</option>
                            </select>
                            @error('grade_level')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="previous_school" class="block text-sm font-medium text-gray-700 mb-2">
                                Previous School
                            </label>
                            <input type="text" name="previous_school" id="previous_school" value="{{ old('previous_school') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                <!-- Guardian Information -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b">Guardian Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="guardian_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Guardian Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="guardian_name" id="guardian_name" value="{{ old('guardian_name') }}" required
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
                                <option value="Father" {{ old('guardian_relationship') == 'Father' ? 'selected' : '' }}>Father</option>
                                <option value="Mother" {{ old('guardian_relationship') == 'Mother' ? 'selected' : '' }}>Mother</option>
                                <option value="Legal Guardian" {{ old('guardian_relationship') == 'Legal Guardian' ? 'selected' : '' }}>Legal Guardian</option>
                                <option value="Other" {{ old('guardian_relationship') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('guardian_relationship')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="guardian_contact" class="block text-sm font-medium text-gray-700 mb-2">
                                Guardian Contact <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" name="guardian_contact" id="guardian_contact" value="{{ old('guardian_contact') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent @error('guardian_contact') border-red-500 @enderror">
                            @error('guardian_contact')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Documents -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4 pb-2 border-b">Required Documents</h3>
                    <div class="space-y-4">
                        <div>
                            <label for="documents" class="block text-sm font-medium text-gray-700 mb-2">
                                Upload Documents (Birth Certificate, Report Cards, etc.)
                            </label>
                            <input type="file" name="documents[]" id="documents" multiple accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            <p class="mt-1 text-sm text-gray-500">Accepted formats: PDF, JPG, PNG, DOC, DOCX (Max 5MB per file)</p>
                            @error('documents')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-between pt-6 border-t">
                    <p class="text-sm text-gray-600">
                        <span class="text-red-500">*</span> Required fields
                    </p>
                    <button type="submit" class="btn-modern-primary">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Submit Application
                    </button>
                </div>
            </form>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<x-faq-section :faqs="[
    [
        'question' => 'What is the admission process?',
        'answer' => 'Our admission process involves submitting an online application form, providing required documents (birth certificate, report cards, ID), and attending an interview if required. The entire process typically takes 2-3 weeks from submission to decision.'
    ],
    [
        'question' => 'When is the application deadline?',
        'answer' => 'The application deadline for the upcoming school year is typically December 31st. However, we encourage early applications as spaces are limited. Late applications may be considered on a case-by-case basis depending on availability.'
    ],
    [
        'question' => 'What documents are required for admission?',
        'answer' => 'You will need to submit: original birth certificate or copy, latest report card or academic records, two valid IDs (student and parent/guardian), passport-sized photos, and any additional documents specified in the application form.'
    ],
    [
        'question' => 'Is there an entrance exam?',
        'answer' => 'Yes, applicants may be required to take an entrance examination depending on the grade level they are applying for. The exam covers basic subjects like Math, English, and Science. Specific details will be provided after submitting your application.'
    ],
    [
        'question' => 'What are the tuition fees?',
        'answer' => 'Tuition fees vary by grade level. Please contact our admissions office for the current fee structure. We also offer payment plans and scholarship opportunities for qualified students. Financial assistance information can be requested during the application process.'
    ],
    [
        'question' => 'How will I know the status of my application?',
        'answer' => 'You will receive email updates at each stage of the application process. You can also contact our admissions office directly at (123) 456-7890 or visit the school in person for status updates. Processing typically takes 2-3 weeks.'
    ]
]" />
@endsection
