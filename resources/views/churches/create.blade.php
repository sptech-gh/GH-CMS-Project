@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-bold mb-4">Register a New Church</h2>

    <form action="{{ route('churches.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Church Name</label>
            <input type="text" name="name" id="name" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" value="{{ old('name') }}" required>
            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="location" class="block text-gray-700 font-medium mb-2">Location</label>
            <input type="text" name="location" id="location" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500" value="{{ old('location') }}" required>
            @error('location') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700">Register</button>
    </form>
</div>
@endsection
