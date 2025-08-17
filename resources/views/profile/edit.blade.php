<x-app-layout>
    <div class="max-w-2xl mx-auto p-6 bg-white shadow rounded-lg">
        <h2 class="text-2xl font-bold mb-6">Edit Profile</h2>

        <!-- Success Message -->
        @if (session('status') === 'profile-updated')
            <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                Profile updated successfully.
            </div>
        @endif

        <!-- Update Profile Form -->
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('name')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('email')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Save Changes
            </button>
        </form>

        <!-- Delete Profile -->
        <div class="mt-8 border-t pt-6">
            <h3 class="text-lg font-bold mb-2 text-red-600">Delete Account</h3>
            <p class="mb-4 text-gray-600">Once deleted, all your data will be permanently removed.</p>

            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')
                <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded"
                        onclick="return confirm('Are you sure you want to delete your account?')">
                    Delete Account
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
