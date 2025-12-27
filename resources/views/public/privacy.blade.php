@extends('layouts.public')

@section('title', 'Privacy Policy')

@section('content')
<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => 'Privacy Policy']
]" />

<!-- Hero Section -->
<section class="relative py-20 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 overflow-hidden">
    <div class="absolute inset-0 pattern-dots opacity-30"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center text-white animate-fade-in-up max-w-3xl mx-auto">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-sm font-semibold tracking-wide mb-4">
                <i class="fas fa-shield-alt mr-2"></i>Your Privacy Matters
            </span>
            <h1 class="text-5xl md:text-6xl font-bold font-display mb-4">Privacy Policy</h1>
            <p class="text-xl text-gray-200 leading-relaxed">
                Learn how Little Flower High School collects, uses, and protects your personal information.
            </p>
        </div>
    </div>
</section>

<!-- Privacy Policy Content -->
<section class="modern-section modern-section-white">
    <div class="modern-container">
        <div class="max-w-4xl mx-auto">
            <div class="modern-card p-8 space-y-8">
                <div class="text-sm text-gray-500 text-center">
                    Last Updated: {{ date('F d, Y') }}
                </div>

                <!-- Introduction -->
                <div class="space-y-4">
                    <h2 class="modern-heading-md">Introduction</h2>
                    <p class="modern-text">
                        Little Flower High School ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website and use our services.
                    </p>
                </div>

                <!-- Information We Collect -->
                <div class="space-y-4">
                    <h2 class="modern-heading-md">Information We Collect</h2>
                    <p class="modern-text">We may collect the following types of information:</p>

                    <h3 class="modern-heading-sm">Personal Information</h3>
                    <ul class="list-disc list-inside space-y-2 modern-text ml-4">
                        <li>Name and contact information (email address, phone number, mailing address)</li>
                        <li>Student information (grade level, enrollment status, academic records)</li>
                        <li>Parent/guardian information</li>
                        <li>Login credentials for our online portal</li>
                    </ul>

                    <h3 class="modern-heading-sm mt-4">Automatically Collected Information</h3>
                    <ul class="list-disc list-inside space-y-2 modern-text ml-4">
                        <li>IP address and browser type</li>
                        <li>Device information</li>
                        <li>Usage data and browsing behavior</li>
                        <li>Cookies and similar tracking technologies</li>
                    </ul>
                </div>

                <!-- How We Use Your Information -->
                <div class="space-y-4">
                    <h2 class="modern-heading-md">How We Use Your Information</h2>
                    <p class="modern-text">We use the collected information for the following purposes:</p>
                    <ul class="list-disc list-inside space-y-2 modern-text ml-4">
                        <li>To provide and maintain our educational services</li>
                        <li>To process admissions and enrollment applications</li>
                        <li>To communicate important announcements and updates</li>
                        <li>To respond to inquiries and provide customer support</li>
                        <li>To improve our website and services</li>
                        <li>To send newsletters and promotional materials (with consent)</li>
                        <li>To comply with legal obligations</li>
                    </ul>
                </div>

                <!-- Information Sharing -->
                <div class="space-y-4">
                    <h2 class="modern-heading-md">Information Sharing and Disclosure</h2>
                    <p class="modern-text">We do not sell, trade, or rent your personal information to third parties. We may share your information with:</p>
                    <ul class="list-disc list-inside space-y-2 modern-text ml-4">
                        <li>School staff and authorized personnel for educational purposes</li>
                        <li>Service providers who assist in our operations</li>
                        <li>Legal authorities when required by law</li>
                        <li>Third parties with your explicit consent</li>
                    </ul>
                </div>

                <!-- Data Security -->
                <div class="space-y-4">
                    <h2 class="modern-heading-md">Data Security</h2>
                    <p class="modern-text">
                        We implement appropriate technical and organizational security measures to protect your personal information from unauthorized access, disclosure, alteration, or destruction. However, no method of transmission over the internet is 100% secure.
                    </p>
                </div>

                <!-- Your Rights -->
                <div class="space-y-4">
                    <h2 class="modern-heading-md">Your Rights</h2>
                    <p class="modern-text">You have the right to:</p>
                    <ul class="list-disc list-inside space-y-2 modern-text ml-4">
                        <li>Access your personal information</li>
                        <li>Request correction of inaccurate data</li>
                        <li>Request deletion of your data (subject to legal requirements)</li>
                        <li>Opt-out of marketing communications</li>
                        <li>Object to certain data processing activities</li>
                    </ul>
                </div>

                <!-- Cookies -->
                <div class="space-y-4">
                    <h2 class="modern-heading-md">Cookies and Tracking Technologies</h2>
                    <p class="modern-text">
                        We use cookies and similar tracking technologies to enhance your browsing experience, analyze website traffic, and personalize content. You can control cookies through your browser settings.
                    </p>
                </div>

                <!-- Children's Privacy -->
                <div class="space-y-4">
                    <h2 class="modern-heading-md">Children's Privacy</h2>
                    <p class="modern-text">
                        Our school serves students of various ages. We are committed to protecting the privacy of minors. For students under 18, we require parental or guardian consent before collecting certain personal information.
                    </p>
                </div>

                <!-- Changes to Policy -->
                <div class="space-y-4">
                    <h2 class="modern-heading-md">Changes to This Privacy Policy</h2>
                    <p class="modern-text">
                        We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the "Last Updated" date.
                    </p>
                </div>

                <!-- Contact Information -->
                <div class="space-y-4">
                    <h2 class="modern-heading-md">Contact Us</h2>
                    <p class="modern-text">
                        If you have any questions or concerns about this Privacy Policy, please contact us:
                    </p>
                    <div class="bg-gray-50 p-6 rounded-lg space-y-2">
                        <p class="modern-text"><strong>Little Flower High School</strong></p>
                        <p class="modern-text">Poblacion, Penarrubia, Abra 2806</p>
                        <p class="modern-text">Email: <a href="mailto:lfhssystemmanagement@gmail.com" class="text-primary-600 hover:text-primary-700">lfhssystemmanagement@gmail.com</a></p>
                        <p class="modern-text">Phone: (123) 456-7890</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
