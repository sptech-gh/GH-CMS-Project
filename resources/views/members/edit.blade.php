<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('✏️ Edit Member - ') }} {{ currentChurch()->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <form method="POST" action="{{ route('members.update', $member) }}">
                    @csrf
                    @method('PUT')

                    <!-- Hidden Church ID -->
                    <input type="hidden" name="church_id" value="{{ currentChurch()->id }}">

                    <!-- Name -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Full Name</label>
                        <input type="text" name="name" class="w-full border rounded p-2"
                               value="{{ old('name', $member->name) }}" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Email</label>
                        <input type="email" name="email" class="w-full border rounded p-2"
                               value="{{ old('email', $member->email) }}" required>
                    </div>

                    <!-- Phone -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Phone</label>
                        <input type="text" name="phone" class="w-full border rounded p-2"
                               value="{{ old('phone', $member->phone) }}">
                    </div>

                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Update Member
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
