@extends('layouts.app')

@section('content')
<<<<<<< HEAD
<div class="py-6 max-w-md mx-auto">
    <h2 class="text-2xl font-semibold mb-6">Login</h2>

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="bg-white p-6 rounded-lg shadow">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded p-2" required autofocus>
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Password</label>
            <input type="password" name="password" class="w-full border rounded p-2" required>
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Remember Me -->
        <div class="mb-4 flex items-center">
            <input type="checkbox" name="remember" id="remember" class="mr-2">
            <label for="remember" class="text-gray-700">Remember Me</label>
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Login
            </button>
        </div>

        <!-- Register Link -->
        <p class="mt-4 text-gray-700 text-sm">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register here</a>.
        </p>
    </form>
=======
<div class="flex justify-center items-center min-h-[80vh] px-4">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8 border-t-4 border-ghana-gradient">
        <h2 class="text-2xl font-bold mb-6 text-center bg-ghana-gradient bg-clip-text text-ghana-gradient">
            Login to Anidaso CMS
        </h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-ghBlack font-semibold mb-2">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-ghana-gradient @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-ghBlack font-semibold mb-2">Password</label>
                <input id="password" type="password" name="password" required
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-ghana-gradient @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mb-4">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember" class="text-ghBlack text-sm">Remember Me</label>
            </div>

            <div class="flex justify-between items-center">
                <button type="submit"
                        class="px-6 py-2 bg-ghana-gradient text-white rounded-lg font-bold hover:opacity-90 transition">
                    Login
                </button>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-ghRed hover:text-ghGold text-sm">
                        Forgot password?
                    </a>
                @endif
            </div>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-ghRed hover:text-ghGold font-semibold">Register</a>
        </p>
    </div>
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
</div>
@endsection
