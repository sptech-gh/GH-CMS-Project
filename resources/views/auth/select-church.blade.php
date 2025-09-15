@extends('layouts.app')

@section('title', 'Select a Church')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 p-4">
    <div class="bg-white shadow-xl rounded-2xl p-8 max-w-md w-full">

        {{-- Page Header --}}
        <h1 class="text-3xl font-bold mb-6 text-center text-[#CE1126]">
            Select a Church
        </h1>

        {{-- Navigation: Profile & Logout --}}
        <div class="flex justify-end mb-4 space-x-3">
            <a href="{{ route('profile.edit') }}"
               class="bg-[#006B3F] hover:bg-[#004d2b] text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                Profile
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="bg-[#CE1126] hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                    Logout
                </button>
            </form>
        </div>

        {{-- Display message if no churches assigned --}}
        @if(isset($message) && $message)
            <div class="text-[#CE1126] bg-red-100 p-4 rounded-lg text-center mb-4">
                {{ $message }}
            </div>
        @else
            {{-- Church selection form --}}
            <form action="{{ route('select-church.post') }}" method="POST" class="space-y-4">
                @csrf

                <select name="church_id" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#FCD116]">
                    <option value="">-- Choose a church --</option>
                    @foreach($churches as $church)
                        <option value="{{ $church->id }}"
                            @if(session('current_church_id') == $church->id) selected @endif>
                            {{ $church->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit"
                        class="w-full bg-[#FCD116] hover:bg-yellow-500 text-black font-semibold p-3 rounded-lg transition">
                    Select Church
                </button>
            </form>
        @endif
    </div>
</div>
@endsection
