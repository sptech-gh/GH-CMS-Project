<form method="POST" action="{{ route('password.update') }}" class="space-y-6">
    @csrf
    @method('PUT')

    <!-- Current Password -->
    <div>
        <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
        <input id="current_password" name="current_password" type="password"
               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-ghana-gradient focus:ring-ghana-gradient">
        @error('current_password')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- New Password -->
    <div>
        <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
        <input id="password" name="password" type="password"
               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-ghana-gradient focus:ring-ghana-gradient">
        @error('password')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Confirm New Password -->
    <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
        <input id="password_confirmation" name="password_confirmation" type="password"
               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-ghana-gradient focus:ring-ghana-gradient">
    </div>

    <!-- Update Button -->
    <div>
        <button type="submit"
                class="px-6 py-2 bg-ghana-gradient text-white rounded-lg shadow hover:opacity-90">
            Update Password
        </button>
    </div>
</form>
