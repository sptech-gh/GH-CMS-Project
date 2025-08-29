<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ $church->name }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <div class="bg-white shadow rounded-lg p-6">
            <p><strong>Location:</strong> {{ $church->location }}</p>
            <p><strong>Region:</strong> {{ $church->region }}</p>
            <p><strong>Pastor:</strong> {{ $church->pastor_name }}</p>
            <p><strong>Year Founded:</strong> {{ $church->founded_at ? \Carbon\Carbon::parse($church->founded_at)->format('M d, Y') : 'N/A' }}</p>
            <p class="mt-4"><strong>Description:</strong></p>
            <p>{{ $church->description }}</p>

            <div class="mt-6 flex justify-end">
                <a href="{{ route('churches.edit', $church->slug) }}"
                   class="px-4 py-2 bg-yellow-400 text-white rounded hover:bg-yellow-500 mr-2">
                    Edit
                </a>
                <a href="{{ route('churches.index') }}"
                   class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                    Back
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
