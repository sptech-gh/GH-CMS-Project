@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    <h1 class="text-2xl font-bold mb-6 bg-ghana-gradient bg-clip-text text-ghana-gradient">
        @if(isset($church))
            {{ $church->name }} Events
        @else
            All Events
        @endif
    </h1>

    <div class="mb-4">
        <a href="{{ isset($church) ? route('churches.events.create', $church) : route('events.create') }}"
           class="px-4 py-2 bg-ghana-gradient text-white rounded-lg shadow hover:opacity-90 transition">
            Create New Event
        </a>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-6 border-t-4 border-ghana-gradient">
        @if($events->isEmpty())
            <p class="text-gray-500">No events found.</p>
        @else
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-ghana-gradient bg-opacity-20 text-ghBlack">
                        <th class="p-3 border">Title</th>
                        <th class="p-3 border">Description</th>
                        <th class="p-3 border">Date</th>
                        <th class="p-3 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr class="hover:bg-ghana-gradient hover:bg-opacity-10">
                            <td class="p-3 border">{{ $event->title }}</td>
                            <td class="p-3 border">{{ Str::limit($event->description, 50) }}</td>
                            <td class="p-3 border">{{ $event->date->format('M d, Y') }}</td>
                            <td class="p-3 border flex gap-2">
                                <a href="{{ route('events.edit', $event) }}" class="px-3 py-1 bg-ghGold text-white rounded hover:opacity-90 transition">
                                    Edit
                                </a>
                                <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-ghRed text-white rounded hover:opacity-90 transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</div>
@endsection
