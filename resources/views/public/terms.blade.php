@extends('layouts.public')

@section('title', 'Terms of Service')

@section('content')
<!-- Breadcrumb -->
<x-breadcrumb :items="[
    ['label' => 'Terms of Service']
]" />

<!-- Hero Section -->
<section class="relative py-20 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 overflow-hidden">
    <div class="absolute inset-0 pattern-dots opacity-30"></div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center text-white animate-fade-in-up max-w-3xl mx-auto">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-sm font-semibold tracking-wide mb-4">
                <i class="fas fa-file-contract mr-2"></i>Legal Agreement
            </span>
            <h1 class="text-5xl md:text-6xl font-bold font-display mb-4">Terms of Service</h1>
            <p class="text-xl text-gray-200 leading-relaxed">
                Please read these terms carefully before using our website and services.
            </p>
        </div>
    </div>
</section>

<!-- Terms of Service Content -->
<section class="modern-section modern-section-white">
    <div class="modern-container">
        <div class="max-w-4xl mx-auto">
            <div class="modern-card p-8 space-y-8">
                <div class="text-sm text-gray-500 text-center">
                    Last Updated: {{ date('F d, Y') }}
                </div>

                <!-- Introduction -->
                <div class="space-y-4">
                    <h2 class="modern-heading-md">Agreement to Terms</h2>
                    <p class="modern-text">
                        By accessing and using the Little Flower High School website and services, you agree to be bound by these Terms of Service and all applicable laws and regulations. If you do not agree with any of these terms, you are prohibited from using or accessing this site.
                    </p>
                </div>

                <!-- Use License -->
                <div class="space-y-4">
                    <h2 class="modern-heading-md">Use License</h2>
                    <p class="modern-text">
                        Permission is granted to temporarily access the materials (information or software) on Little Flower High School's website for personal, non-commercial use only. This is the grant of a license, not a transfer of title, and under this license you may not:
                    </p>
                    <ul class="list-disc list-inside space-y-2 modern-text ml-4">
                        <li>Modify or copy the materials</li>
                        <li>Use the materials for any commercial purpose or public display</li>
                        <li>Attempt to decompile or reverse engineer any software on the website</li>
                        <li>Remove any copyright or proprietary notations from the materials</li>
                        <li>Transfer the materials to another person or "mirror" the materials on any other server</li>
                    </ul>
                    <p class="modern-text mt-4">
                        This license shall automatically terminate if you violate any of these restrictions and may be terminated by Little Flower High School at any time.
                    </p>
                </div>

                <!-- User Accounts -->
                <div class="space-y-4">
                    <h2 class="modern-heading-md">User Accounts</h2>
                    <p class="modern-text">When you create an account with us, you must provide accurate and complete information. You are responsible for:</p>
                    <ul class="list-disc list-inside space-y-2 modern-text ml-4">
                        <li>Maintaining the confidentiality of your account and password</li>
                        <li>All activities that occur under your account</li>
                        <li>Notifying us immediately of any unauthorized use of your account</li>
                        <li>Ensuring your account information remains up-to-date</li>
                    </ul>
                    <p class="modern-text mt-4">
                        We reserve the right to suspend or terminate accounts that violate these terms or engage in inappropriate behavior.
                    </p>
                </div>

                <!-- Acceptable Use -->
                <div class="space-y-4">
                    <h2 class="modern-heading-md">Acceptable Use</h2>
                    <p class="modern-text">You agree not to use our website or services to:</p>
                    <ul class="list-disc list-inside space-y-2 modern-text ml-4">
                        <li>Violate any laws or regulations</li>
                        <li>Infringe on intellectual property rights</li>
                        <li>Transmit harmful, offensive, or inappropriate content</li>
                        <li>Harass, threaten, or intimidate others</li>
                        <li>Upload viruses or malicious code</li>
                        <li>Attempt to gain unauthorized access to our systems</li>
                        <li>Impersonate any person or entity</li>
                        <li>Engage in any fraudulent activity</li>
                    </ul>
                </div>

                <!-- Content Submissions -->
                <div class="space-y-4">
                    <h2 class="modern-heading-md">Content Submissions</h2>
                    <p class="modern-text">
                        When you submit content to our website (comments, feedback, testimonials, etc.), you grant Little Flower High School a non-exclusive, royalty-free, perpetual, and worldwide license to use, reproduce, modify, and display such content for educational and promotional purposes.
                    </p>
                    <p class="modern-text">
                        You represent and warrant that you own or have the necessary rights to submit such content and that it does not violate any third-party rights.
                    </p>
                </div>

                <!-- Intellectual Property -->
                <div class="space-y-4">
                    <h2 class="modern-heading-md">Intellectual Property</h2>
                    <p class="modern-text">
                        The materials on Little Flower High School's website, including but not limited to text, graphics, logos, images, and software, are owned by or licensed to Little Flower High School and are protected by copyright and trademark laws.
                    </p>
                </div>

                <!-- Disclaimer -->
                <div class="space-y-4">
                    <h2 class="modern-heading-md">Disclaimer</h2>
                    <p class="modern-text">
                        The materials on Little Flower High School's website are provided on an 'as is' basis. Little Flower High School makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.
                    </p>
                    <p class="modern-text">
                        Further, Little Flower High School does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on its website or otherwise relating to such materials or on any sites linked to this site.
                    </p>
                </div>

                <!-- Limitations -->
                <div class="space-y-4">
                    <h2 class="modern-heading-md">Limitations of Liability</h2>
                    <p class="modern-text">
                        In no event shall Little Flower High School or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on Little Flower High School's website, even if Little Flower High School or an authorized representative has been notified orally or in writing of the possibility of such damage.
                    </p>
                </div>

                <!-- Accuracy of Materials -->
                <div class="space-y-4">
                    <h2 class="modern-heading-md">Accuracy of Materials</h2>
                    <p class="modern-text">
                        The materials appearing on Little Flower High School's website could include technical, typographical, or photographic errors. Little Flower High School does not warrant that any of the materials on its website are accurate, complete, or current. Little Flower High School may make changes to the materials contained on its website at any time without notice.
                    </p>
                </div>

                <!-- Links to Third-Party Sites -->
                <div class="space-y-4">
                    <h2 class="modern-heading-md">Links to Third-Party Websites</h2>
                    <p class="modern-text">
                        Little Flower High School has not reviewed all of the sites linked to its website and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by Little Flower High School of the site. Use of any such linked website is at the user's own risk.
                    </p>
                </div>

                <!-- Modifications -->
                <div class="space-y-4">
                    <h2 class="modern-heading-md">Modifications to Terms</h2>
                    <p class="modern-text">
                        Little Flower High School may revise these Terms of Service at any time without notice. By using this website, you are agreeing to be bound by the then current version of these Terms of Service.
                    </p>
                </div>

                <!-- Governing Law -->
                <div class="space-y-4">
                    <h2 class="modern-heading-md">Governing Law</h2>
                    <p class="modern-text">
                        These terms and conditions are governed by and construed in accordance with the laws of the Philippines, and you irrevocably submit to the exclusive jurisdiction of the courts in that location.
                    </p>
                </div>

                <!-- Contact Information -->
                <div class="space-y-4">
                    <h2 class="modern-heading-md">Contact Us</h2>
                    <p class="modern-text">
                        If you have any questions about these Terms of Service, please contact us:
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
