<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Anidaso Church Management System</title>
    @vite('resources/css/app.css')
</head>
<body class="antialiased bg-gray-50 text-gray-900">

    <!-- Navbar -->
    <nav class="flex justify-between items-center px-8 py-4 shadow bg-ghana-gradient text-white">
        <h1 class="text-xl font-bold">Anidaso Church Management System</h1>
        <div class="space-x-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded bg-white text-ghana-gradient font-semibold">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded bg-white text-ghana-gradient font-semibold">
                        Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-4 py-2 rounded bg-white text-ghana-gradient font-semibold">
                            Register
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="flex flex-col items-center justify-center text-center min-h-[80vh] px-6">
        <h2 class="text-4xl sm:text-6xl font-extrabold mb-6 bg-ghana-gradient bg-clip-text text-ghana-gradient">
            Anidaso Church Management System
        </h2>
        <p class="max-w-xl text-lg text-gray-700 mb-8">
            Manage churches, members, and payments with ease — built for Ghana’s unique needs.
        </p>

        <div class="space-x-4">
            <a href="{{ route('register') }}"
               class="px-6 py-3 bg-ghana-gradient text-white rounded-lg shadow-lg hover:opacity-90 transition">
                Get Started
            </a>
            <a href="{{ route('login') }}"
               class="px-6 py-3 border-2 border-ghRed text-ghana-gradient rounded-lg hover:bg-gray-100 transition">
                Login
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-4 bg-gray-100 border-t mt-10">
        <p class="text-sm text-gray-600">&copy; {{ date('Y') }} Anidaso CMS-SPtech. All rights reserved.</p>
    </footer>

</body>
</html>
