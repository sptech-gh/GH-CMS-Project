@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-bold mb-4">Edit Church</h2>

    <form action="{{ route('churches.update', $church->slug) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Church Name</label>
            <input type="text" name="name" id="name" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" value="{{ old('name', $church->name) }}" required>
            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="location" class="block text-gray-700 font-medium mb-2">Location</label>
            <input type="text" name="location" id="location" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" value="{{ old('location', $church->location) }}" required>
            @error('location') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700">Update</button>
    </form>
</div>
@endsection
