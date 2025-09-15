@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 p-4">
    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-700">
            Register a New Church & Become Admin
        </h2>

        {{-- Display Validation Errors --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.register.store') }}" class="space-y-4">
            @csrf

            <!-- Church Name -->
            <div>
                <label for="church_name" class="block font-medium text-gray-700">Church Name</label>
                <input id="church_name" type="text" name="church_name" value="{{ old('church_name') }}"
                    class="w-full border rounded p-2" required autofocus>
            </div>

            <!-- Location -->
            <div>
                <label for="location" class="block font-medium text-gray-700">Location</label>
                <input id="location" type="text" name="location" value="{{ old('location') }}"
                    class="w-full border rounded p-2" required>
            </div>

            <!-- Region -->
            <div>
                <label for="region" class="block font-medium text-gray-700">Region</label>
                <input id="region" type="text" name="region" value="{{ old('region') }}"
                    class="w-full border rounded p-2" required>
            </div>

            <!-- Admin Name -->
            <div>
                <label for="name" class="block font-medium text-gray-700">Your Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}"
                    class="w-full border rounded p-2" required>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                    class="w-full border rounded p-2" required>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password"
                    class="w-full border rounded p-2" required>
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block font-medium text-gray-700">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                    class="w-full border rounded p-2" required>
            </div>

            <!-- Submit -->
            <div class="flex items-center justify-between mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    Already registered?
                </a>

                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-yellow-400">
                    Register Admin & Church
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
