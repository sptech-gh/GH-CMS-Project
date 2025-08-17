@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="card">
        <h2 class="card-header text-green-600">Welcome, {{ Auth::user()->name }} 🎉</h2>

        <div class="space-y-4">
            <p class="text-gray-700">
                You are logged in to the <span class="font-semibold text-red-600">Church Management System</span>.
                Use the navigation above to manage churches, members, and finances.
            </p>

            <div class="grid md:grid-cols-3 gap-4">
                <!-- Manage Churches -->
                <a href="{{ route('churches.index') }}"
                   class="block p-4 rounded-xl shadow-md text-center
                          bg-gradient-to-r from-green-500 to-green-700 text-white font-semibold hover:scale-105 transform transition">
                    🏛 Manage Churches
                </a>

                <!-- Manage Members -->
                <a href="#"
                   class="block p-4 rounded-xl shadow-md text-center
                          bg-gradient-to-r from-yellow-400 to-yellow-600 text-black font-semibold hover:scale-105 transform transition">
                    👥 Manage Members
                </a>

                <!-- Finances -->
                <a href="#"
                   class="block p-4 rounded-xl shadow-md text-center
                          bg-gradient-to-r from-red-500 to-red-700 text-white font-semibold hover:scale-105 transform transition">
                    💰 Track Finances
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-6 grid md:grid-cols-2 gap-4">
        <div class="card">
            <h3 class="card-header text-yellow-600">Quick Actions</h3>
            <ul class="space-y-2">
                <li><a href="{{ route('churches.create') }}" class="text-green-600 font-semibold hover:underline">➕ Register New Church</a></li>
                <li><a href="#" class="text-blue-600 font-semibold hover:underline">📋 View Reports</a></li>
                <li><a href="#" class="text-red-600 font-semibold hover:underline">⚙️ Settings</a></li>
            </ul>
        </div>

        <div class="card">
            <h3 class="card-header text-blue-600">System Updates</h3>
            <p class="text-gray-700">
                🚀 The system is now running with the new Ghana-themed design.
                All UI components are globally consistent for a rich experience.
            </p>
        </div>
    </div>
</div>
@endsection
