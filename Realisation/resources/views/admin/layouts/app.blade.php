<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Preline CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <!-- ========== HEADER ========== -->
    <header class="sticky top-0 inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-50 w-full bg-white border-b border-gray-200 text-sm py-3 md:py-0">
        <nav class="relative max-w-7xl w-full mx-auto px-4 md:px-6 lg:px-8" aria-label="Global">
            <div class="flex items-center justify-between">
                <a class="flex-none text-xl font-semibold" href="#" aria-label="Brand">Admin Panel</a>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.articles.index') }}" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50">
                        Articles
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <!-- ========== END HEADER ========== -->

    <!-- ========== MAIN CONTENT ========== -->
    <main class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-sm text-green-600 rounded-lg p-4" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-4 w-4 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                    </div>
                    <div class="ms-2">
                        <div class="text-sm font-medium">
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{ $slot }}
    </main>
    <!-- ========== END MAIN CONTENT ========== -->

    <!-- Preline JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Preline UI components
            if (window.HSOverlay) {
                window.HSOverlay.autoInit();
            }
            
            // Initialize tooltips
            if (window.HSTooltip) {
                document.querySelectorAll('[data-hs-tooltip]').forEach(function (el) {
                    new HSTooltip(el);
                });
            }
        });
    </script>
</body>
</html>
