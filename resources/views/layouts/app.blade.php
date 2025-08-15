<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Church Management') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-lg font-bold">Church Management</a>
            <div class="space-x-4">
                <a href="{{ route('churches.index') }}" class="hover:underline">Churches</a>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center p-4 mt-10">
        &copy; {{ date('Y') }} Church Management System. All rights reserved.
    </footer>

</body>
</html>
