@extends('layouts.app')

@section('content')
<h2 class="text-3xl font-bold text-ghana-gradient mb-6">Edit Member</h2>

<form action="{{ route('members.update', $member) }}" method="POST" class="bg-white shadow-lg rounded-lg p-6 space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label class="block font-medium mb-1">Name</label>
        <input type="text" name="name" value="{{ old('name', $member->name) }}"
               class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
    </div>

    <div>
        <label class="block font-medium mb-1">Email</label>
        <input type="email" name="email" value="{{ old('email', $member->email) }}"
               class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
    </div>

    <div>
        <label class="block font-medium mb-1">Phone</label>
        <input type="text" name="phone" value="{{ old('phone', $member->phone) }}"
               class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
    </div>

    <div class="flex justify-end space-x-2">
        <a href="{{ route('members.index') }}"
           class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition">Cancel</a>
        <button type="submit"
                class="px-4 py-2 bg-ghana-gradient text-white rounded-lg shadow hover:opacity-90 transition">
            Update Member
        </button>
    </div>
</form>
@endsection
