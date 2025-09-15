<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Create New Church</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto bg-white p-6 rounded shadow">
        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('churches.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block font-medium">Church Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded p-2" required>
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-medium">Location</label>
                <input type="text" name="location" value="{{ old('location') }}" class="w-full border rounded p-2" required>
                @error('location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block font-medium">Region</label>
                <input type="text" name="region" value="{{ old('region') }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-medium">Pastor Name</label>
                <input type="text" name="pastor_name" value="{{ old('pastor_name') }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-medium">Founded At</label>
                <input type="date" name="founded_at" value="{{ old('founded_at') }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-medium">Description</label>
                <textarea name="description" class="w-full border rounded p-2">{{ old('description') }}</textarea>
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('churches.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Create Church
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
