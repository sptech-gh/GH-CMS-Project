@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto">
    <div class="card">
        <h2 class="card-header text-yellow-600">📝 Register</h2>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required class="input">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required class="input">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" required class="input">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required class="input">
            </div>

            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow-md font-semibold transition">
                🎉 Create Account
            </button>
        </form>

        <p class="mt-4 text-sm text-gray-600 text-center">
            Already registered?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
        </p>
    </div>
</div>
@endsection
