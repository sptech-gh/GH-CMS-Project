@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h2 class="text-xl font-bold mb-4">Churches</h2>

    <a href="{{ route('churches.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700 mb-4 inline-block">+ Register Church</a>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border-collapse border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2 text-left">Name</th>
                <th class="border p-2 text-left">Location</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($churches as $church)
                <tr>
                    <td class="border p-2">{{ $church->name }}</td>
                    <td class="border p-2">{{ $church->location }}</td>
                    <td class="border p-2 flex space-x-2">
                        <a href="{{ route('churches.show', $church->slug) }}" class="text-blue-600 hover:underline">View</a>
                        <a href="{{ route('churches.edit', $church->slug) }}" class="text-yellow-600 hover:underline">Edit</a>
                        <form action="{{ route('churches.destroy', $church->slug) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center p-4">No churches found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $churches->links() }}
    </div>
</div>
@endsection
