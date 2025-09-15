<<<<<<< HEAD
<x-guest-layout>
    <div class="mb-6 text-sm text-gray-700">
        {{ __('Register a new account as a church member') }}
    </div>

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <!-- Name -->
        <div>
            <label for="name" class="block font-medium text-gray-700">{{ __('Full Name') }}</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-[#CE1126]" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <label for="email" class="block font-medium text-gray-700">{{ __('Email Address') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-[#CE1126]" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block font-medium text-gray-700">{{ __('Password') }}</label>
            <input id="password" type="password" name="password" required
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-[#CE1126]" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" class="block font-medium text-gray-700">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-[#CE1126]" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-gray-600 hover:text-[#CE1126]" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
            <button type="submit" class="ml-4 bg-[#CE1126] hover:bg-[#FCD116] text-white px-4 py-2 rounded-md">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</x-guest-layout>
=======
@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-[80vh] px-4">
    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8 border-t-4 border-ghana-gradient">
        <h2 class="text-2xl font-bold mb-6 text-center bg-ghana-gradient bg-clip-text text-ghana-gradient">
            Create Your Anidaso CMS Account
        </h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-ghBlack font-semibold mb-2">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-ghana-gradient @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-ghBlack font-semibold mb-2">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
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

            <!-- Confirm Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-ghBlack font-semibold mb-2">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-ghana-gradient">
            </div>

            <button type="submit"
                    class="w-full px-6 py-2 bg-ghana-gradient text-white rounded-lg font-bold hover:opacity-90 transition">
                Register
            </button>

            <p class="mt-6 text-center text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="text-ghRed hover:text-ghGold font-semibold">Login</a>
            </p>
        </form>
    </div>
</div>
@endsection
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
