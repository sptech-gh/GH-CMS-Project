@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto">
    <div class="card">
        <h2 class="card-header text-green-600">🔑 Login</h2>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="input">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" required class="input">
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-yellow-600 hover:underline text-sm">
                        Forgot password?
                    </a>
                @endif
            </div>

            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow-md font-semibold transition">
                ✅ Login
            </button>
        </form>

        <p class="mt-4 text-sm text-gray-600 text-center">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register here</a>
        </p>
    </div>
</div>
@endsection
