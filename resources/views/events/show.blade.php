<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ $event->title }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6">
            {{-- Status Badge --}}
            @php
                $isUpcoming = \Carbon\Carbon::parse($event->event_date)->isFuture() || \Carbon\Carbon::parse($event->event_date)->isToday();
            @endphp

            <div class="flex justify-between items-start">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $event->title }}</h3>
                    <span class="inline-block mt-2 px-3 py-1 text-sm font-semibold rounded-full
                        {{ $isUpcoming ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $isUpcoming ? 'Upcoming' : 'Past' }}
                    </span>
                </div>

                <a href="{{ route('events.index') }}"
                   class="text-sm text-indigo-600 hover:underline">
                    ← Back to Events
                </a>
            </div>

            {{-- Date --}}
            <div class="mt-4 text-gray-600">
                <p class="flex items-center gap-2">
                    📅 <span class="font-medium">Date:</span>
                    {{ \Carbon\Carbon::parse($event->event_date)->format('F j, Y') }}
                </p>
            </div>

            {{-- Description --}}
            <div class="mt-6">
                <h4 class="text-lg font-semibold text-gray-800">Description</h4>
                <p class="mt-2 text-gray-700 whitespace-pre-line">
                    {{ $event->description ?? 'No description provided.' }}
                </p>
            </div>

            {{-- Actions (Admin/Pastor only) --}}
            @php
                $user = auth()->user();
                $church = app('currentChurch');
                $role = $church->users()
                    ->where('user_id', $user->id)
                    ->pluck('role')
                    ->first();
            @endphp

            @if(in_array($role, ['admin', 'pastor']))
                <div class="mt-8 flex gap-3">
                    <a href="{{ route('events.edit', $event) }}"
                       class="px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-600">
                        ✏ Edit
                    </a>
                    <form method="POST" action="{{ route('events.destroy', $event) }}"
                          onsubmit="return confirm('Are you sure you want to delete this event?')">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="px-4 py-2 bg-red-500 text-white rounded shadow hover:bg-red-600">
                            🗑 Delete
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
