<form method="POST" action="{{ route('profile.destroy') }}" class="space-y-6">
    @csrf
    @method('DELETE')

    <p class="text-sm text-gray-600">
        Once your account is deleted, all of its resources and data will be permanently removed.
        Please enter your password to confirm you want to delete your account.
    </p>

    <!-- Password Confirmation -->
    <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input id="password" name="password" type="password"
               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-ghana-gradient focus:ring-ghana-gradient">
        @error('password')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Delete Button -->
    <div>
        <button type="submit"
                class="px-6 py-2 bg-red-600 text-white rounded-lg shadow hover:bg-red-700">
            Delete Account
        </button>
    </div>
</form>
