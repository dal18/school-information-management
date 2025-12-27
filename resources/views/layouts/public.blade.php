<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'LFHS') - Little Flower High School</title>

    <meta name="description" content="@yield('description', 'Little Flower High School - Excellence in Education')">
    <meta name="author" content="LFHS">
    <meta name="theme-color" content="#1e3a8a">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700;800&family=Source+Sans+Pro:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional Styles -->
    @stack('styles')
</head>
<body class="font-sans antialiased" style="background-color: #e7debe;">
    <!-- Page Loader -->
    <x-page-loader />

    <!-- Navigation -->
    @include('layouts.public-navigation')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('layouts.public-footer')

    <!-- Search Modal -->
    <x-search-modal />

    <!-- Sticky CTA -->
    <x-sticky-cta />

    <!-- Chatbot Widget -->
    <x-chatbot />

    <!-- Image Modal -->
    <div id="imageModal" class="image-modal" onclick="closeImageModal(event)">
        <span class="modal-close" onclick="closeImageModal(event)">
            <i class="fas fa-times"></i>
        </span>
        <div class="modal-content-wrapper" onclick="event.stopPropagation()">
            <img id="modalImage" class="modal-image" src="" alt="">
            <div id="modalCaption" class="modal-caption"></div>
        </div>
    </div>

    <style>
        /* Image Modal Styles */
        .image-modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.95);
            animation: fadeIn 0.3s ease;
        }

        .image-modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content-wrapper {
            position: relative;
            max-width: 90%;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .modal-image {
            max-width: 100%;
            max-height: 85vh;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .modal-caption {
            color: white;
            font-size: 1.25rem;
            margin-top: 1rem;
            text-align: center;
            font-weight: 500;
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 35px;
            color: #fff;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            z-index: 10000;
            transition: all 0.3s ease;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .modal-close:hover,
        .modal-close:focus {
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(90deg);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes zoomIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .modal-content-wrapper {
            animation: zoomIn 0.3s ease;
        }
    </style>

    <script>
        function openImageModal(imageSrc, caption) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            const modalCaption = document.getElementById('modalCaption');

            modal.classList.add('active');
            modalImg.src = imageSrc;
            modalCaption.textContent = caption || '';

            // Prevent body scroll when modal is open
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal(event) {
            const modal = document.getElementById('imageModal');

            // Only close if clicking on the modal background or close button
            if (event.target === modal || event.target.closest('.modal-close')) {
                modal.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const modal = document.getElementById('imageModal');
                if (modal.classList.contains('active')) {
                    modal.classList.remove('active');
                    document.body.style.overflow = 'auto';
                }
            }
        });
    </script>

    <!-- Additional Scripts -->
    @stack('scripts')
</body>
</html>
