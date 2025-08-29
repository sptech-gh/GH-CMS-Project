<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 leading-tight flex items-center gap-2">
            👥 Members
            <span class="text-sm font-medium text-gray-500">Manage and view all registered members</span>
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-200">

        <!-- Header Actions -->
        <div class="bg-gradient-to-r from-red-600 via-yellow-400 to-green-600 p-6 flex flex-col sm:flex-row sm:justify-between sm:items-center">
            <div class="mb-4 sm:mb-0">
                <h3 class="text-xl font-semibold text-white">Members Directory</h3>
            </div>
            <a href="{{ route('members.create') }}"
               class="inline-block px-5 py-3 font-bold text-white rounded-xl shadow-md bg-gradient-to-r from-yellow-400 to-green-600 hover:opacity-90 transition">
                ➕ Add New Member
            </a>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 text-sm font-semibold border-b border-green-200">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table -->
        <div class="p-6 overflow-x-auto">
            <table class="w-full border-collapse rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="py-3 px-4 font-semibold text-gray-700">#</th>
                        <th class="py-3 px-4 font-semibold text-gray-700">Name</th>
                        <th class="py-3 px-4 font-semibold text-gray-700">Email</th>
                        <th class="py-3 px-4 font-semibold text-gray-700">Phone</th>
                        <th class="py-3 px-4 font-semibold text-gray-700">Church</th>
                        <th class="py-3 px-4 font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $member)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="py-3 px-4">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4 font-bold text-gray-800">{{ $member->name }}</td>
                            <td class="py-3 px-4 text-gray-700">{{ $member->email }}</td>
                            <td class="py-3 px-4 text-gray-700">{{ $member->phone ?? 'N/A' }}</td>
                            <td class="py-3 px-4 text-gray-700">{{ $member->church->name ?? 'N/A' }}</td>
                            <td class="py-3 px-4 flex flex-wrap gap-2">
                                <a href="{{ route('members.show', $member->id) }}"
                                   class="px-3 py-2 text-sm font-semibold text-white rounded-lg bg-gradient-to-r from-green-600 to-yellow-400 hover:opacity-90 transition">
                                    👁 View
                                </a>
                                <a href="{{ route('members.edit', $member->id) }}"
                                   class="px-3 py-2 text-sm font-semibold text-white rounded-lg bg-gradient-to-r from-yellow-400 to-green-600 hover:opacity-90 transition">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('members.destroy', $member->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this member?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-3 py-2 text-sm font-semibold text-white rounded-lg bg-gradient-to-r from-red-600 to-yellow-400 hover:opacity-90 transition">
                                        🗑 Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-6 text-center text-gray-500">No members found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-6 border-t">
            {{ $members->links() }}
        </div>
    </div>
</x-app-layout>
