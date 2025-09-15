<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('➕ Add Member - ') }} {{ currentChurch()->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <form method="POST" action="{{ route('members.store') }}">
                    @csrf
                    
                    <!-- Hidden Church ID -->
                    <input type="hidden" name="church_id" value="{{ currentChurch()->id }}">

                    <!-- Name -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Full Name</label>
                        <input type="text" name="name" class="w-full border rounded p-2" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Email</label>
                        <input type="email" name="email" class="w-full border rounded p-2" required>
                    </div>

                    <!-- Phone -->
                    <div class="mb-4">
                        <label class="block text-gray-700">Phone</label>
                        <input type="text" name="phone" class="w-full border rounded p-2">
                    </div>

                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Save Member
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
