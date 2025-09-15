{{-- resources/views/events/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="p-6">
    {{-- Page Title --}}
    <h1 class="text-2xl font-bold mb-4 text-ghana-red">
        {{ isset($church) ? $church->name . ' Events' : 'All Events' }}
    </h1>

    {{-- Add Event Button --}}
    <a href="{{ isset($church)
                ? route('churches.events.create', $church->id)
                : route('events.create') }}"
       class="bg-ghana-green text-white px-4 py-2 rounded shadow hover:bg-ghana-yellow hover:text-black">
        ➕ Add Event
    </a>

    {{-- Events Table --}}
    <table class="w-full mt-6 border-collapse border border-gray-200">
        <thead class="bg-ghana-yellow text-black">
            <tr>
                <th class="p-2 border">Title</th>
                <th class="p-2 border">Description</th>
                <th class="p-2 border">Date</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($events as $event)
                <tr>
                    <td class="p-2 border">{{ $event->title }}</td>
                    <td class="p-2 border">{{ $event->description }}</td>
                    <td class="p-2 border">{{ $event->date }}</td>
                    <td class="p-2 border">
                        {{-- Edit --}}
                        <a href="{{ isset($church)
                                    ? route('churches.events.edit', [$church->id, $event->id])
                                    : route('events.edit', $event->id) }}"
                           class="text-ghana-blue font-medium hover:underline">✏️ Edit</a>

                        {{-- Delete --}}
                        <form action="{{ isset($church)
                                        ? route('churches.events.destroy', [$church->id, $event->id])
                                        : route('events.destroy', $event->id) }}"
                              method="POST" class="inline-block ml-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-ghana-red font-medium hover:underline"
                                    onclick="return confirm('Are you sure?')">🗑 Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">No events found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
