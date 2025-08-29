<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Church Management System') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
<link rel="alternate icon" href="{{ asset('favicon.ico') }}">
<link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">

</head>
<body class="font-sans antialiased bg-gray-100">

    <!-- Main Navbar -->
    @include('layouts.navigation')

    <!-- Page Container -->
    <div class="min-h-screen">

        <!-- Page Header -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="mb-4 rounded-lg p-4 bg-green-100 border border-green-300 text-green-700 shadow">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 rounded-lg p-4 bg-red-100 border border-red-300 text-red-700 shadow">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Slot (Page Body) -->
                <div class="bg-white shadow sm:rounded-lg p-6">
                    {{ $slot }}
                </div>

            </div>
        </main>
    </div>

</body>
</html>
