@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    <h1 class="text-2xl font-bold mb-6 bg-ghana-gradient bg-clip-text text-ghana-gradient">
        All Services
    </h1>

    <div class="mb-4">
        <a href="{{ route('services.create') }}"
           class="px-4 py-2 bg-ghana-gradient text-white rounded-lg shadow hover:opacity-90 transition">
            Create New Service
        </a>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-6 border-t-4 border-ghana-gradient">
        @if($services->isEmpty())
            <p class="text-gray-500">No services found.</p>
        @else
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-ghana-gradient bg-opacity-20 text-ghBlack">
                        <th class="p-3 border">Name</th>
                        <th class="p-3 border">Description</th>
                        <th class="p-3 border">Date</th>
                        <th class="p-3 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                        <tr class="hover:bg-ghana-gradient hover:bg-opacity-10">
                            <td class="p-3 border">{{ $service->name }}</td>
                            <td class="p-3 border">{{ Str::limit($service->description, 50) }}</td>
                            <td class="p-3 border">{{ $service->date->format('M d, Y') }}</td>
                            <td class="p-3 border flex gap-2">
                                <a href="{{ route('services.edit', $service) }}" class="px-3 py-1 bg-ghGold text-white rounded hover:opacity-90 transition">
                                    Edit
                                </a>
                                <form action="{{ route('services.destroy', $service) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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
