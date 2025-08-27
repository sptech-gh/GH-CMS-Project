@extends('layouts.app')

@section('content')
<div class="bg-white shadow-xl rounded-xl p-8 max-w-2xl mx-auto">
    <div class="text-center mb-6">
        <h2 class="text-3xl font-bold text-ghana-gradient">{{ $member->name }}</h2>
        <p class="text-gray-500">Member Profile</p>
    </div>

    <div class="space-y-4">
        <div class="flex justify-between border-b pb-2">
            <span class="font-semibold">Email:</span>
            <span>{{ $member->email }}</span>
        </div>
        <div class="flex justify-between border-b pb-2">
            <span class="font-semibold">Phone:</span>
            <span>{{ $member->phone }}</span>
        </div>
        <div class="flex justify-between border-b pb-2">
            <span class="font-semibold">Created At:</span>
            <span>{{ $member->created_at->format('d M Y') }}</span>
        </div>
        <div class="flex justify-between">
            <span class="font-semibold">Updated At:</span>
            <span>{{ $member->updated_at->format('d M Y') }}</span>
        </div>
    </div>

    <div class="mt-6 flex justify-end space-x-3">
        <a href="{{ route('members.index') }}"
           class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition">Back</a>
        <a href="{{ route('members.edit', $member) }}"
           class="px-4 py-2 bg-ghana-gradient text-white rounded-lg shadow hover:opacity-90 transition">Edit</a>
    </div>
</div>
@endsection
