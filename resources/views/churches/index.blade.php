<x-app-layout>
    <h1 class="text-2xl font-bold text-ghana-gradient mb-6">Churches</h1>

    <!-- Add New Church Button -->
    <div class="mb-4">
        <a href="{{ route('churches.create') }}"
           class="px-4 py-2 bg-ghana-gradient text-white rounded shadow hover:opacity-90 transition">
            + Add New Church
        </a>
    </div>

    @if($churches->isEmpty())
        <p class="text-gray-600">No churches have been added yet.</p>
    @else
        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-3 border">Name</th>
                        <th class="p-3 border">Location</th>
                        <th class="p-3 border">Pastor</th>
                        <th class="p-3 border">Founded</th>
                        <th class="p-3 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($churches as $church)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border">{{ $church->name }}</td>
                            <td class="p-3 border">{{ $church->location }}</td>
                            <td class="p-3 border">{{ $church->pastor_name }}</td>
                            <td class="p-3 border">
                                {{ \Carbon\Carbon::parse($church->founded_at)->format('M d, Y') }}
                            </td>
                            <td class="p-3 border space-x-2">
                                <a href="{{ route('churches.show', $church->slug) }}" class="text-blue-600 hover:underline">View</a>
                                <a href="{{ route('churches.edit', $church->slug) }}" class="text-green-600 hover:underline">Edit</a>
                                <form method="POST" action="{{ route('churches.destroy', $church->slug) }}" class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this church?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-app-layout>
