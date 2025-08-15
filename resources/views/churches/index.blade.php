@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Churches</h1>
    <a href="{{ route('churches.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">Add New Church</a>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mt-4">{{ session('success') }}</div>
    @endif

    <table class="table-auto w-full mt-4 border-collapse border border-gray-300">
        <thead>
            <tr>
                <th class="border p-2">Name</th>
                <th class="border p-2">Slug</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($churches as $church)
                <tr>
                    <td class="border p-2">{{ $church->name }}</td>
                    <td class="border p-2">{{ $church->slug }}</td>
                    <td class="border p-2">
                        <a href="{{ route('churches.show', $church) }}" class="text-blue-500">View</a> |
                        <a href="{{ route('churches.edit', $church) }}" class="text-yellow-500">Edit</a> |
                        <form action="{{ route('churches.destroy', $church) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this church?')" class="text-red-500">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="border p-2 text-center">No churches found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
