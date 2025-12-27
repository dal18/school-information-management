<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 - Server Error</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-lg w-full text-center">
            <div class="mb-8">
                <i class="fas fa-exclamation-triangle text-yellow-500 text-8xl mb-4"></i>
                <h1 class="text-6xl font-bold text-gray-800 mb-4">500</h1>
                <h2 class="text-3xl font-semibold text-gray-700 mb-4">Server Error</h2>
                <p class="text-gray-600 text-lg mb-8">
                    Oops! Something went wrong on our end. We're working to fix it.
                </p>
            </div>

            <div class="space-y-4">
                <a href="{{ route('home') }}"
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg transition duration-300">
                    <i class="fas fa-home mr-2"></i>Go to Homepage
                </a>
                <br>
                <a href="javascript:history.back()"
                   class="inline-block text-blue-600 hover:text-blue-800 font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Go Back
                </a>
                <br>
                <a href="mailto:support@school.edu"
                   class="inline-block text-gray-600 hover:text-gray-800 font-medium text-sm mt-4">
                    <i class="fas fa-envelope mr-2"></i>Contact Support
                </a>
            </div>
        </div>
    </div>
</body>
</html>
