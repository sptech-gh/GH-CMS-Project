@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto">
    <div class="card">
        <h2 class="card-header text-red-600">🔒 Forgot Password</h2>
        <p class="text-sm text-gray-600 mb-4">Enter your email and we’ll send you a password reset link.</p>

        @if (session('status'))
            <div class="bg-green-100 text-green-700 p-2 rounded-md mb-3">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required class="input">
            </div>

            <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded-lg shadow-md font-semibold transition">
                📩 Send Reset Link
            </button>
        </form>
    </div>
</div>
@endsection
