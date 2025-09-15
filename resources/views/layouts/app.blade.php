<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ sidebarOpen: false, sidebarCollapsed: false, userMenuOpen: false }" x-cloak>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<<<<<<< HEAD
<<<<<<< HEAD
    <title>{{ config('app.name', 'Anidaso CMS') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans leading-normal tracking-tight" x-data="{ openMobile: false }">

    <!-- ✅ Custom Navbar -->
    <nav class="bg-[#CE1126] text-white p-4 shadow-md flex justify-between items-center">
        <!-- Logo / Brand -->
        <a href="{{ url('/') }}" class="text-xl font-bold">Anidaso Church Management System</a>

        <!-- Links -->
        <div class="hidden md:flex space-x-4 items-center">
            @auth
                <a href="{{ route('dashboard') }}" class="hover:text-[#FCD116] transition">Dashboard</a>
                <a href="{{ route('events.index') }}" class="hover:text-[#FCD116] transition">Events</a>
                <a href="{{ route('members.index') }}" class="hover:text-[#FCD116] transition">Members</a>
                <a href="{{ route('donations.index') }}" class="hover:text-[#FCD116] transition">Donations</a>

                <!-- Profile Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = ! open" class="flex items-center space-x-2 hover:text-[#FCD116] focus:outline-none">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" @click.away="open = false"
                         class="absolute right-0 mt-2 w-48 bg-white text-gray-700 rounded-md shadow-lg z-50">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="hover:text-[#FCD116] transition">Login</a>
                <a href="{{ route('register') }}" class="hover:text-[#FCD116] transition">Register</a>
            @endauth
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
            <button @click="openMobile = ! openMobile" class="focus:outline-none">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': openMobile, 'inline-flex': !openMobile }" class="inline-flex"
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                    <path :class="{ 'hidden': !openMobile, 'inline-flex': openMobile }" class="hidden"
                          stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </nav>

    <!-- ✅ Mobile Dropdown -->
    <div x-show="openMobile" class="md:hidden bg-[#CE1126] text-white p-4 space-y-2">
        @auth
            <a href="{{ route('dashboard') }}" class="block hover:text-[#FCD116]">Dashboard</a>
            <a href="{{ route('events.index') }}" class="block hover:text-[#FCD116]">Events</a>
            <a href="{{ route('members.index') }}" class="block hover:text-[#FCD116]">Members</a>
            <a href="{{ route('donations.index') }}" class="block hover:text-[#FCD116]">Donations</a>
            <a href="{{ route('profile.edit') }}" class="block hover:text-[#FCD116]">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left hover:text-[#FCD116]">Log Out</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="block hover:text-[#FCD116]">Login</a>
            <a href="{{ route('register') }}" class="block hover:text-[#FCD116]">Register</a>
        @endauth
    </div>

    <!-- ✅ Flash Messages -->
    <main class="p-6 min-h-[calc(100vh-120px)]">
        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-[#006B3F] text-white shadow">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-3 rounded bg-red-100 text-red-700 shadow">
                {{ session('error') }}
            </div>
        @endif

        <!-- Page Content -->
        @yield('content')
    </main>

    <!-- ✅ Footer -->
    <footer class="bg-black text-white text-center py-3 mt-10">
        &copy; {{ date('Y') }} Anidaso CMS
    </footer>
=======
=======
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
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
<<<<<<< HEAD
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
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603

=======
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

>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
