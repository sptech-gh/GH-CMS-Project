@props(['church' => null, 'collapsed' => false])

<div {{ $attributes->merge([
    'class' => 'flex flex-col bg-white border-r shadow-md transition-all duration-200 ' . ($collapsed ? 'w-20' : 'w-64')
]) }}>
    <!-- Logo / Title -->
    <div class="flex items-center justify-center h-16 border-b">
        <span class="text-lg font-bold text-gray-700 truncate">
            {{ $collapsed ? 'CMS' : config('app.name', 'Church CMS') }}
        </span>
    </div>

    <!-- Nav Items -->
    <nav class="flex-1 px-2 py-4 space-y-2">
        <a href="{{ route('dashboard') }}"
           class="flex items-center px-3 py-2 rounded-md text-gray-700 hover:bg-gray-100">
            <span class="mr-3">🏠</span>
            <span x-show="!collapsed">Dashboard</span>
        </a>

        <a href="{{ route('members.index') }}"
           class="flex items-center px-3 py-2 rounded-md text-gray-700 hover:bg-gray-100">
            <span class="mr-3">👥</span>
            <span x-show="!collapsed">Members</span>
        </a>

        <a href="{{ route('donations.index') }}"
           class="flex items-center px-3 py-2 rounded-md text-gray-700 hover:bg-gray-100">
            <span class="mr-3">💳</span>
            <span x-show="!collapsed">Donations</span>
        </a>

        <a href="{{ route('events.index') }}"
           class="flex items-center px-3 py-2 rounded-md text-gray-700 hover:bg-gray-100">
            <span class="mr-3">📅</span>
            <span x-show="!collapsed">Events</span>
        </a>

        {{-- <a href="{{ route('settings.index') }}"
           class="flex items-center px-3 py-2 rounded-md text-gray-700 hover:bg-gray-100">
            <span class="mr-3">⚙️</span>
            <span x-show="!collapsed">Settings</span>
        </a> --}}
    </nav>
</div>
