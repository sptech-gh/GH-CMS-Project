<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ sidebarOpen: false, sidebarCollapsed: false }" x-cloak>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Church Management System') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="flex bg-gray-100 min-h-screen">

    <!-- Sidebar -->
    <div
        x-show="sidebarOpen"
        @click.away="sidebarOpen = false"
        class="fixed inset-0 z-30 flex lg:static lg:inset-auto lg:translate-x-0"
        :class="{
            '-translate-x-full': !sidebarOpen,
            'translate-x-0': sidebarOpen
        }">

        <!-- Sidebar Component -->
        <x-sidebar :church="$church ?? null" x-bind:collapsed="sidebarCollapsed" />
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col transition-all duration-200"
         :class="{ 'lg:ml-64': !sidebarCollapsed, 'lg:ml-20': sidebarCollapsed }">

        <!-- Top Navbar -->
        <div class="flex items-center justify-between bg-white border-b px-4 py-3 shadow-sm">
            <!-- Mobile Sidebar Toggle -->
            <button @click="sidebarOpen = !sidebarOpen"
                    class="lg:hidden p-2 rounded-md text-gray-600 hover:bg-gray-100">
                ☰
            </button>

            <div class="flex items-center space-x-4">
                <!-- Collapse Toggle -->
                <button @click="sidebarCollapsed = !sidebarCollapsed"
                        class="hidden lg:inline-flex p-2 rounded-md text-gray-600 hover:bg-gray-100">
                    <span x-show="!sidebarCollapsed">⬅️</span>
                    <span x-show="sidebarCollapsed">➡️</span>
                </button>

              <!-- User Dropdown -->
<div class="relative">
    @auth
        <button class="flex items-center text-gray-700 focus:outline-none">
            <span class="mr-2">{{ Auth::user()->name }}</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M19 9l-7 7-7-7"/>
            </svg>
        </button>
    @endauth

    @guest
        <a href="{{ route('login') }}" class="text-gray-700 hover:underline">
            Login
        </a>
    @endguest
</div>

            </div>
        </div>

        <!-- Main Content Section -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>
</html>
