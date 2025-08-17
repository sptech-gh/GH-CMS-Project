
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Anidaso Church App') }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="min-h-screen flex flex-col">

        {{-- Navigation --}}
        @include('layouts.navigation')

        {{-- Main Content --}}
        <main class="flex-1 container mx-auto px-4 py-6">

            {{-- ✅ Flash Messages --}}
            @if(session('success'))
                <div class="mb-4 p-3 rounded-lg bg-green-100 border border-green-300 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-3 rounded-lg bg-red-100 border border-red-300 text-red-800">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-3 rounded-lg bg-red-100 border border-red-300 text-red-800">
                    Please correct the errors below.
                </div>
            @endif

            {{-- Page Content --}}
            @yield('content')
        </main>

    </div>

    <!-- Footer -->
    <footer class="bg-white border-t mt-10">
        <div class="max-w-6xl mx-auto px-4 py-4 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} {{ config('app.name', 'Anidaso Church CMS') }}. All rights reserved-SPtech.
        </div>
    </footer>
</body>
</html>




