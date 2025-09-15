<aside class="w-64 bg-white shadow-md h-screen flex flex-col"
       :class="{ 'hidden': sidebarCollapsed }">
    <nav class="p-4 space-y-2" role="navigation">

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
           class="block px-4 py-2 rounded font-medium
                  {{ request()->routeIs('dashboard') ? 'bg-gray-200 text-blue-600' : 'hover:bg-gray-100' }}"
           aria-current="{{ request()->routeIs('dashboard') ? 'page' : 'false' }}">
            🏠 Dashboard
        </a>

        {{-- 🔹 Global Section --}}
        <h3 class="text-xs uppercase text-gray-500 mt-4 mb-2">Global</h3>

        <a href="{{ route('events.index') }}"
           class="block px-4 py-2 rounded
                  {{ request()->routeIs('events.*') ? 'bg-gray-200 text-blue-600' : 'hover:bg-gray-100' }}">
            🌍 All Events
        </a>

        <a href="{{ route('members.index') }}"
           class="block px-4 py-2 rounded
                  {{ request()->routeIs('members.*') ? 'bg-gray-200 text-blue-600' : 'hover:bg-gray-100' }}">
            👥 All Members
        </a>

        <a href="{{ route('donations.all') }}"
           class="block px-4 py-2 rounded
                  {{ request()->routeIs('donations.*') ? 'bg-gray-200 text-blue-600' : 'hover:bg-gray-100' }}">
            💰 All Donations
        </a>

        {{-- 🔹 Church-specific Section --}}
        @isset($church)
            <h3 class="text-xs uppercase text-gray-500 mt-4 mb-2">
                {{ $church->name }}
            </h3>

            <a href="{{ route('churches.events.index', $church->id) }}"
               class="block px-4 py-2 rounded
                      {{ request()->routeIs('churches.events.*') ? 'bg-gray-200 text-blue-600' : 'hover:bg-gray-100' }}">
                📅 Church Events
            </a>

            <a href="{{ route('churches.members.index', $church->id) }}"
               class="block px-4 py-2 rounded
                      {{ request()->routeIs('churches.members.*') ? 'bg-gray-200 text-blue-600' : 'hover:bg-gray-100' }}">
                🙌 Church Members
            </a>

            <a href="{{ route('churches.donations.index', $church->id) }}"
               class="block px-4 py-2 rounded
                      {{ request()->routeIs('churches.donations.*') ? 'bg-gray-200 text-blue-600' : 'hover:bg-gray-100' }}">
                💒 Church Donations
            </a>
        @endisset
    </nav>
</aside>
