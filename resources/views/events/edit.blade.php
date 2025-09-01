@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    <h1 class="text-2xl font-bold mb-6 bg-ghana-gradient bg-clip-text text-ghana-gradient">
        Edit Event
    </h1>

    <div class="bg-white shadow-lg rounded-lg p-8 border-t-4 border-ghana-gradient">
        <form action="{{ route('events.update', $event) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Event Title -->
            <div class="mb-4">
                <label for="title" class="block text-ghBlack font-semibold mb-2">Event Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $event->title) }}" required
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-ghana-gradient @error('title') border-red-500 @enderror">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Event Description -->
            <div class="mb-4">
                <label for="description" class="block text-ghBlack font-semibold mb-2">Description</label>
                <textarea id="description" name="description" rows="4" required
                          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-ghana-gradient @error('description') border-red-500 @enderror">{{ old('description', $event->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Event Date -->
            <div class="mb-4">
                <label for="date" class="block text-ghBlack font-semibold mb-2">Event Date</label>
                <input type="date" id="date" name="date" value="{{ old('date', $event->date->format('Y-m-d')) }}" required
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-ghana-gradient @error('date') border-red-500 @enderror">
                @error('date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('events.index') }}" class="px-6 py-2 border-2 border-ghRed text-ghRed rounded-lg hover:bg-gray-100 hover:text-ghGold transition">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2 bg-ghana-gradient text-white rounded-lg font-bold hover:opacity-90 transition">
                    Update Event
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
