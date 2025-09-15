<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ __('Church Events') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- 🔍 Filters --}}
        <div class="mb-6 bg-white p-4 rounded-lg shadow">
            <form method="GET" action="{{ route('events.index') }}" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                {{-- Search --}}
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Search events..."
                       class="px-3 py-2 border rounded-md shadow-sm focus:ring focus:ring-indigo-200">

                {{-- Start Date --}}
                <input type="date" name="start_date" value="{{ request('start_date') }}"
                       class="px-3 py-2 border rounded-md shadow-sm focus:ring focus:ring-indigo-200">

                {{-- End Date --}}
                <input type="date" name="end_date" value="{{ request('end_date') }}"
                       class="px-3 py-2 border rounded-md shadow-sm focus:ring focus:ring-indigo-200">

                {{-- Submit --}}
                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Apply Filters
                </button>
            </form>
        </div>

        @php
            $today = \Carbon\Carbon::today();
            $upcomingEvents = $events->filter(fn($e) => \Carbon\Carbon::parse($e->event_date)->isFuture() || \Carbon\Carbon::parse($e->event_date)->isToday());
            $pastEvents = $events->filter(fn($e) => \Carbon\Carbon::parse($e->event_date)->isPast() && !\Carbon\Carbon::parse($e->event_date)->isToday());
        @endphp

        {{-- 🎉 Upcoming Events --}}
        <div class="mb-10">
            <h3 class="text-lg font-semibold text-green-700 mb-4">🎉 Upcoming Events</h3>
            @if($upcomingEvents->count())
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($upcomingEvents as $event)
                        <div class="bg-white shadow rounded-lg p-5 flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">{{ $event->title }}</h3>
                                <span class="inline-block mt-2 px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-600">
                                    Upcoming
                                </span>
                            </div>

                            <div class="mt-3 text-sm text-gray-600">
                                <p><strong>📅 Date:</strong>
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }}
                                </p>
                                @if($event->description)
                                    <p class="mt-2 line-clamp-3">{{ $event->description }}</p>
                                @endif
                            </div>

                            <div class="mt-4 flex justify-between items-center">
                                <a href="{{ route('events.show', $event) }}" class="text-sm text-indigo-600 font-medium hover:underline">
                                    🔎 View
                                </a>
                                <div class="flex gap-2">
                                    <a href="{{ route('events.edit', $event) }}"
                                       class="px-3 py-1 text-xs bg-blue-500 text-white rounded hover:bg-blue-600">✏ Edit</a>
                                    <form method="POST" action="{{ route('events.destroy', $event) }}"
                                          onsubmit="return confirm('Are you sure you want to delete this event?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-1 text-xs bg-red-500 text-white rounded hover:bg-red-600">
                                            🗑 Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">No upcoming events.</p>
            @endif
        </div>

        {{-- ⏳ Past Events --}}
        <div>
            <h3 class="text-lg font-semibold text-red-700 mb-4">⏳ Past Events</h3>
            @if($pastEvents->count())
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($pastEvents as $event)
                        <div class="bg-white shadow rounded-lg p-5 flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">{{ $event->title }}</h3>
                                <span class="inline-block mt-2 px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-600">
                                    Past
                                </span>
                            </div>

                            <div class="mt-3 text-sm text-gray-600">
                                <p><strong>📅 Date:</strong>
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }}
                                </p>
                                @if($event->description)
                                    <p class="mt-2 line-clamp-3">{{ $event->description }}</p>
                                @endif
                            </div>

                            <div class="mt-4 flex justify-between items-center">
                                <a href="{{ route('events.show', $event) }}" class="text-sm text-indigo-600 font-medium hover:underline">
                                    🔎 View
                                </a>
                                <div class="flex gap-2">
                                    <a href="{{ route('events.edit', $event) }}"
                                       class="px-3 py-1 text-xs bg-blue-500 text-white rounded hover:bg-blue-600">✏ Edit</a>
                                    <form method="POST" action="{{ route('events.destroy', $event) }}"
                                          onsubmit="return confirm('Are you sure you want to delete this event?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-1 text-xs bg-red-500 text-white rounded hover:bg-red-600">
                                            🗑 Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">No past events.</p>
            @endif
        </div>

        {{-- 📌 Pagination --}}
        <div class="mt-8">
            {{ $events->appends(request()->query())->links() }}
        </div>
    </div>
</x-app-layout>
