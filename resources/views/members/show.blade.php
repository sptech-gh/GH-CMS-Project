<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Member Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-200">

            <!-- Header -->
            <div class="bg-gradient-to-r from-red-600 via-yellow-400 to-green-600 p-6">
                <h2 class="text-2xl font-bold text-white">👤 Member Profile</h2>
                <p class="text-sm text-white/80">Details of {{ $member->name }}</p>
            </div>

            <!-- Content -->
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Full Name -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500">Full Name</h3>
                        <p class="text-lg font-bold text-gray-800">{{ $member->name }}</p>
                    </div>

                    <!-- Email -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500">Email</h3>
                        <p class="text-lg text-gray-800">{{ $member->email }}</p>
                    </div>

                    <!-- Phone -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500">Phone</h3>
                        <p class="text-lg text-gray-800">{{ $member->phone ?? 'N/A' }}</p>
                    </div>

                    <!-- Gender -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500">Gender</h3>
                        <p class="text-lg capitalize text-gray-800">{{ $member->gender ?? 'N/A' }}</p>
                    </div>

                    <!-- Date of Birth -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500">Date of Birth</h3>
                        <p class="text-lg text-gray-800">
                            {{ $member->date_of_birth ? \Carbon\Carbon::parse($member->date_of_birth)->format('F j, Y') : 'N/A' }}
                        </p>
                    </div>

                    <!-- Church -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500">Church</h3>
                        <p class="text-lg font-bold text-gray-800">{{ $member->church->name ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-between items-center pt-6 border-t">
                    <a href="{{ route('members.index') }}"
                        class="px-6 py-3 font-bold text-gray-600 rounded-lg shadow border hover:bg-gray-100 transition">
                        ⬅ Back to Members
                    </a>

                    <div class="flex space-x-3">
                        <a href="{{ route('members.edit', $member->id) }}"
                            class="px-6 py-3 font-bold text-white rounded-lg shadow-md bg-gradient-to-r from-yellow-400 to-green-600 hover:opacity-90 transition">
                            ✏️ Edit
                        </a>

                        <form action="{{ route('members.destroy', $member->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this member?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-6 py-3 font-bold text-white rounded-lg shadow-md bg-gradient-to-r from-red-600 to-yellow-400 hover:opacity-90 transition">
                                🗑 Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
