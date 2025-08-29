<x-app-layout>
    <!-- Header -->
    <div class="bg-ghana-gradient text-white shadow rounded-2xl p-6 mb-8">
        <h1 class="text-3xl font-bold">Welcome, {{ Auth::user()->name }} 👋</h1>
        <p class="mt-2 text-sm opacity-90">
            Here’s a quick overview of your church management system.
        </p>
    </div>

    <!-- Stats Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Churches -->
        <div class="bg-white shadow rounded-2xl p-6 flex flex-col items-center">
            <div class="text-4xl font-bold text-ghana-gradient">{{ $totalChurches }}</div>
            <p class="mt-2 text-gray-600">Total Churches</p>
        </div>

        <!-- Members -->
        <div class="bg-white shadow rounded-2xl p-6 flex flex-col items-center">
            <div class="text-4xl font-bold text-ghana-gradient">{{ $totalMembers }}</div>
            <p class="mt-2 text-gray-600">Total Members</p>
        </div>

        <!-- Placeholder for Growth / Future Stats -->
        <div class="bg-white shadow rounded-2xl p-6 flex flex-col items-center">
            <div class="text-4xl font-bold text-ghana-gradient">🚀</div>
            <p class="mt-2 text-gray-600">More analytics coming soon</p>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="mt-10">
        <h2 class="text-xl font-bold mb-4 text-ghana-gradient">Quick Actions</h2>
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('churches.index') }}"
               class="px-6 py-3 bg-ghana-gradient text-white rounded-xl shadow hover:opacity-90">
                Manage Churches
            </a>
            <a href="{{ route('members.index') }}"
               class="px-6 py-3 bg-ghana-gradient text-white rounded-xl shadow hover:opacity-90">
                Manage Members
            </a>
        </div>
    </div>
</x-app-layout>
