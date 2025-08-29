<x-app-layout>
    <div class="max-w-7xl mx-auto py-12 sm:px-6 lg:px-8 space-y-6">
        <!-- Header -->
        <h2 class="text-2xl font-bold text-ghana-gradient mb-6">
            {{ __('Profile Settings') }}
        </h2>

        <!-- Update Profile Info -->
        <div class="p-6 bg-white shadow rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Update Password -->
        <div class="p-6 bg-white shadow rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Delete User -->
        <div class="p-6 bg-white shadow rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
