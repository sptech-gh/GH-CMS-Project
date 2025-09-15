<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏ Edit Event – {{ currentChurch()->name }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6">
            <form method="POST" action="{{ route('events.update', $event) }}">
                @csrf
                @method('PUT')

                {{-- Title --}}
                <div class="mb-4">
                    <label for="title" class="block font-medium text-gray-700">Event Title</label>
                    <input type="text" name="title" id="title"
                           value="{{ old('title', $event->title) }}"
                           class="w-full border rounded p-2 focus:ring-2 focus:ring-[{{ config('ghana.primary') }}] @error('title') border-red-500 @enderror"
                           required>
                    @error('title')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Date --}}
                <div class="mb-4">
                    <label for="event_date" class="block font-medium text-gray-700">Event Date</label>
                    <input type="date" name="event_date" id="event_date"
                           value="{{ old('event_date', \Carbon\Carbon::parse($event->event_date)->toDateString()) }}"
                           class="w-full border rounded p-2 focus:ring-2 focus:ring-[{{ config('ghana.primary') }}] @error('event_date') border-red-500 @enderror"
                           required>
                    @error('event_date')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-4">
                    <label for="description" class="block font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="4"
                              class="w-full border rounded p-2 focus:ring-2 focus:ring-[{{ config('ghana.primary') }}] @error('description') border-red-500 @enderror">{{ old('description', $event->description) }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="flex items-center gap-3 mt-6">
                    <button type="submit"
                            class="px-4 py-2 rounded shadow text-white bg-[{{ config('ghana.primary') }}] hover:bg-[{{ config('ghana.primary_dark') }}] transition">
                        💾 Update Event
                    </button>
                    <a href="{{ route('events.index') }}"
                       class="px-4 py-2 rounded border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
                        ✖ Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
