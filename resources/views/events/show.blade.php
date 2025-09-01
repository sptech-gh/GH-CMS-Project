@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            {{ $event->title }}
        </h1>

        <!-- Back Button -->
        <a href="{{ isset($church) && $church ? route('churches.events.index', $church) : route('events.index') }}"
           class="px-4 py-2 bg-gray-600 text-white rounded-lg shadow hover:bg-gray-700">
            ← Back to Events
        </a>
    </div>

    <!-- Event Details -->
    <div class="bg-white shadow-lg rounded-lg p-6 space-y-4">
        <!-- Description -->
        <div>
            <h2 class="text-lg font-semibold text-gray-700">Description</h2>
            <p class="text-gray-600 mt-1">
                {{ $event->description ?? 'No description provided.' }}
            </p>
        </div>

        <!-- Dates -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Start</h2>
                <p class="text-gray-600">
                    {{ $event->start_datetime->format('l, F j, Y g:i A') }}
                </p>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-700">End</h2>
                <p class="text-gray-600">
                    {{ $event->end_datetime->format('l, F j, Y g:i A') }}
                </p>
            </div>
        </div>

        <!-- Church Context -->
        @if($event->church)
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Church</h2>
                <p class="text-gray-600">
                    <a href="{{ route('churches.events.index', $event->church) }}" class="text-blue-600 hover:underline">
                        {{ $event->church->name }}
                    </a>
                </p>
            </div>
        @else
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Scope</h2>
                <p class="text-gray-600">🌍 Global Event</p>
            </div>
        @endif

        <!-- Actions -->
        <div class="flex space-x-2 pt-4">
            <a href="{{ isset($church) && $church ? route('churches.events.edit', [$church, $event]) : route('events.edit', $event) }}"
               class="px-4 py-2 bg-yellow-500 text-white rounded-lg shadow hover:bg-yellow-600">
                ✏️ Edit
            </a>

            <form method="POST"
                  action="{{ isset($church) && $church ? route('churches.events.destroy', [$church, $event]) : route('events.destroy', $event) }}"
                  onsubmit="return confirm('Are you sure you want to delete this event?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg shadow hover:bg-red-700">
                    🗑️ Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
