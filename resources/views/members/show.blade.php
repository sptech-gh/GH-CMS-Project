@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded p-6">
    <h1 class="text-2xl font-bold text-[#CE1126] mb-4">Member Details</h1>

    <p><strong>Name:</strong> {{ $member->name }}</p>
    <p><strong>Email:</strong> {{ $member->email }}</p>
    <p><strong>Phone:</strong> {{ $member->phone }}</p>

    <div class="mt-4">
        <a href="{{ route('members.index') }}" class="bg-[#006B3F] text-white px-4 py-2 rounded shadow hover:bg-black">Back</a>
    </div>
</div>
@endsection
