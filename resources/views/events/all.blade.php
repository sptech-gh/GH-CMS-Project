@extends('layouts.app')

@section('title', 'All Events')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">All Events</h1>

    @if($events->count())
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full border border-gray-200">
                <thead>
                    <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                        <th class="px-4 py-2 border-b">#</th>
                        <th class="px-4 py-2 border-b">Church</th>
                        <th class="px-4 py-2 border-b">Title</th>
                        <th class="px-4 py-2 border-b">Date</th>
                        <th class="px-4 py-2 border-b">Location</th>
                        <th class="px-4 py-2 border-b">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b">{{ $event->id }}</td>
                            <td class="px-4 py-2 border-b">
                                <a href="{{ route('events.index', $event->church->slug) }}"
                                   class="text-blue-600 hover:underline">
                                    {{ $event->church->name }}
                                </a>
                            </td>
                            <td class="px-4 py-2 border-b">
                                <a href="{{ route('events.show', [$event->church->slug, $event->id]) }}"
                                   class="text-indigo-600 hover:underline">
                                    {{ $event->title }}
                                </a>
                            </td>
                            <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($event->date)->format('M d, Y') }}</td>
                            <td class="px-4 py-2 border-b">{{ $event->location ?? '-' }}</td>
                            <td class="px-4 py-2 border-b">{{ Str::limit($event->description, 50, '...') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $events->links() }}
        </div>
    @else
        <p class="text-gray-600">No events have been created yet.</p>
    @endif
</div>
@endsection
