<aside class="w-64 bg-white shadow-md">
    <nav class="p-4 space-y-2" role="navigation">
        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
           class="block px-4 py-2 rounded hover:bg-gray-100 font-medium">
            🏠 Dashboard
        </a>

        {{-- 🔹 Global Section --}}
        <h3 class="text-xs uppercase text-gray-500 mt-4 mb-2">Global</h3>

        @if(Route::has('events.index'))
            <a href="{{ route('events.index') }}"
               class="block px-4 py-2 rounded hover:bg-gray-100">
                🌍 All Events
            </a>
        @endif

        @if(Route::has('members.index'))
            <a href="{{ route('members.index') }}"
               class="block px-4 py-2 rounded hover:bg-gray-100">
                👥 All Members
            </a>
        @endif

        @if(Route::has('donations.all'))
            <a href="{{ route('donations.all') }}"
               class="block px-4 py-2 rounded hover:bg-gray-100">
                💰 All Donations
            </a>
        @else
            {{-- Disabled menu item if route not ready --}}
            <span class="block px-4 py-2 rounded text-gray-400 cursor-not-allowed">
                💰 All Donations
            </span>
        @endif

        {{-- 🔹 Church-specific Section (only if church is selected) --}}
        @isset($church)
            <h3 class="text-xs uppercase text-gray-500 mt-4 mb-2">
                {{ $church->name }}
            </h3>

            @if(Route::has('churches.events.index'))
                <a href="{{ route('churches.events.index', $church->id) }}"
                   class="block px-4 py-2 rounded hover:bg-gray-100">
                    📅 Church Events
                </a>
            @endif

            @if(Route::has('churches.members.index'))
                <a href="{{ route('churches.members.index', $church->id) }}"
                   class="block px-4 py-2 rounded hover:bg-gray-100">
                    🙌 Church Members
                </a>
            @endif

            @if(Route::has('churches.donations.index'))
                <a href="{{ route('churches.donations.index', $church->id) }}"
                   class="block px-4 py-2 rounded hover:bg-gray-100">
                    💒 Church Donations
                </a>
            @else
                <span class="block px-4 py-2 rounded text-gray-400 cursor-not-allowed">
                    💒 Church Donations
                </span>
            @endif
        @endisset
    </nav>
</aside>
