<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Churches</h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto">
        <div class="flex justify-end mb-4">
            <a href="{{ route('churches.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                + Add Church
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border-collapse bg-white shadow rounded">
            <thead>
                <tr class="bg-gray-100 border-b">
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Location</th>
                    <th class="px-4 py-2 text-left">Region</th>
                    <th class="px-4 py-2 text-left">Pastor</th>
                    <th class="px-4 py-2 text-left">Founded</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($churches as $church)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $church->name }}</td>
                        <td class="px-4 py-2">{{ $church->location }}</td>
                        <td class="px-4 py-2">{{ $church->region ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $church->pastor_name ?? '_
