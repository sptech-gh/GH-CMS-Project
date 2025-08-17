@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-bold mb-4">{{ $church->name }}</h2>
    <p><strong>Location:</strong> {{ $church->location }}</p>
    <p><strong>Slug:</strong> {{ $church->slug }}</p>

    <div class="mt-4 flex space-x-2">
        <a href="{{ route('churches.edit', $church->slug) }}" class="bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700">Edit</a>
        <form action="{{ route('churches.destroy', $church->slug) }}" method="POST" onsubmit="return confirm('Are you sure?');">
            @csrf @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-3 py-2 rounded-lg hover:bg-red-700">Delete</button>
        </form>
    </div>
</div>
@endsection
