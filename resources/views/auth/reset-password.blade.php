@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto">
    <div class="card">
        <h2 class="card-header text-blue-600">🔑 Reset Password</h2>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required class="input">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">New Password</label>
                <input id="password" type="password" name="password" required class="input">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required class="input">
            </div>

            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow-md font-semibold transition">
                🔄 Reset Password
            </button>
        </form>
    </div>
</div>
@endsection
