<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ sidebarOpen: false, sidebarCollapsed: false, userMenuOpen: false }" x-cloak>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Church Management System') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex bg-gray-100 min-h-screen">

    <!-- Sidebar -->
    <div
        x-show="sidebarOpen"
        @click.away="sidebarOpen = false"
        class="fixed inset-0 z-30 flex lg:static lg:inset-auto lg:translate-x-0 transition-transform duration-300"
        :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">

        <!-- Sidebar Component -->
        <x-sidebar :church="$church ?? null" :collapsed="sidebarCollapsed" />
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col transition-all duration-200"
         :class="{ 'lg:ml-64': !sidebarCollapsed, 'lg:ml-20': sidebarCollapsed }">

        <!-- Top Navbar -->
        <div class="flex items-center justify-between
                    bg-ghana-gradient text-white
                    px-4 py-3 shadow-md">

            <!-- Mobile Sidebar Toggle -->
            <button @click="sidebarOpen = !sidebarOpen"
                    class="lg:hidden p-2 rounded-md hover:bg-black/10">
                ☰
            </button>

            <!-- Right Section -->
            <div class="flex items-center space-x-6">

                <!-- Collapse Toggle (desktop) -->
                <button @click="sidebarCollapsed = !sidebarCollapsed"
                        class="hidden lg:inline-flex p-2 rounded-md hover:bg-black/10">
                    <span x-show="!sidebarCollapsed">⬅️</span>
                    <span x-show="sidebarCollapsed">➡️</span>
                </button>

                <!-- User Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    @auth
                        <button @click="open = !open"
                                class="flex items-center focus:outline-none hover:bg-black/10 px-3 py-2 rounded-md">
                            <span class="mr-2">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false"
                             class="absolute right-0 mt-2 w-56 bg-white text-gray-700 rounded-lg shadow-md overflow-hidden z-40">

                            <!-- Churches List -->
                            @if(Auth::user()->churches && Auth::user()->churches->count())
                                <div class="px-4 py-2 text-xs text-gray-500 font-semibold">
                                    Your Churches
                                </div>
                                @foreach(Auth::user()->churches as $church)
                                    <a href="{{ route('church.show', $church) }}"
                                       class="block px-4 py-2 hover:bg-gray-100">
                                        {{ $church->name }}
                                    </a>
                                @endforeach
                                <hr class="border-gray-200">
                            @endif

                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full text-left px-4 py-2 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}"
                           class="px-3 py-2 rounded-md bg-yellow-500 hover:bg-yellow-600 text-white">
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
