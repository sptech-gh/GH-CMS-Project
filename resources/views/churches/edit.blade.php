<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Church</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        <form action="{{ route('churches.update', $church->slug) }}" method="POST" class="bg-white p-6 rounded-lg shadow">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name', $church->name) }}"
                       class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Location</label>
                <input type="text" name="location" value="{{ old('location', $church->location) }}"
                       class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Region</label>
                <input type="text" name="region" value="{{ old('region', $church->region) }}"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Pastor Name</label>
                <input type="text" name="pastor_name" value="{{ old('pastor_name', $church->pastor_name) }}"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Year Founded</label>
                <input type="date" name="founded_at" value="{{ old('founded_at', $church->founded_at) }}"
                       class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block font-medium text-gray-700">Description</label>
                <textarea name="description" rows="4"
                          class="w-full border rounded p-2">{{ old('description', $church->description) }}</textarea>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('churches.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 mr-2">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
