<form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
    @csrf
    @method('PATCH')

    <!-- Name -->
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input id="name" name="name" type="text" value="{{ old('name', auth()->user()->name) }}"
               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-ghana-gradient focus:ring-ghana-gradient">
        @error('name')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Email -->
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email', auth()->user()->email) }}"
               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-ghana-gradient focus:ring-ghana-gradient">
        @error('email')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Save Button -->
    <div>
        <button type="submit"
                class="px-6 py-2 bg-ghana-gradient text-white rounded-lg shadow hover:opacity-90">
            Save Changes
        </button>
    </div>
</form>
