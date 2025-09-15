@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">

    {{-- User Panel --}}
    <div class="flex justify-end items-center mb-6 space-x-4">
        <span class="font-semibold text-gray-700">Hello, {{ auth()->user()->name }}</span>

        <a href="{{ route('profile.edit') }}" class="bg-accent text-white px-4 py-2 rounded shadow hover:bg-accent-dark">
            Settings
        </a>

        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded shadow hover:bg-red-700">
                Logout
            </button>
        </form>
    </div>

    {{-- Quick Actions --}}
    <div class="flex flex-wrap gap-4 mb-6">
        <a href="{{ route('events.index') }}" class="bg-primary text-white px-4 py-3 rounded shadow hover:bg-primary-dark">
            View Events
        </a>

        <a href="{{ route('donations.index') }}" class="bg-secondary text-white px-4 py-3 rounded shadow hover:bg-secondary-dark">
            View Donations
        </a>

        <a href="{{ route('members.index') }}" class="bg-accent text-white px-4 py-3 rounded shadow hover:bg-accent-dark">
            View Members
        </a>
    </div>

    {{-- Church Header --}}
    <div class="bg-primary text-white p-6 rounded-lg shadow mb-6">
        <h1 class="text-3xl font-bold">{{ $church->name }} Dashboard</h1>
        <p class="text-lg">Location: {{ $church->location }}</p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-accent-light text-accent-dark p-4 rounded-lg shadow text-center">
            <h2 class="text-xl font-semibold">Total Members</h2>
            <p class="text-3xl font-bold">{{ $membersCount }}</p>
        </div>
        <div class="bg-accent-light text-accent-dark p-4 rounded-lg shadow text-center">
            <h2 class="text-xl font-semibold">Total Events</h2>
            <p class="text-3xl font-bold">{{ $eventsCount }}</p>
        </div>
        <div class="bg-accent-light text-accent-dark p-4 rounded-lg shadow text-center">
            <h2 class="text-xl font-semibold">Upcoming Events</h2>
            <p class="text-3xl font-bold">{{ $upcomingEvents->count() }}</p>
        </div>
    </div>

    {{-- Recent Members --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold mb-4">Recent Members</h2>
        <table class="w-full bg-white shadow rounded-lg">
            <thead class="bg-primary text-white">
                <tr>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentMembers as $member)
                    <tr class="border-b">
                        <td class="p-3">{{ $member->name }}</td>
                        <td class="p-3">{{ $member->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Upcoming Events --}}
    <div>
        <h2 class="text-2xl font-bold mb-4">Upcoming Events</h2>
        <table class="w-full bg-white shadow rounded-lg">
            <thead class="bg-primary text-white">
                <tr>
                    <th class="p-3 text-left">Title</th>
                    <th class="p-3 text-left">Date</th>
                    <th class="p-3 text-left">Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach($upcomingEvents as $event)
                    <tr class="border-b">
                        <td class="p-3">{{ $event->title }}</td>
                        <td class="p-3">{{ $event->date->format('d-m-Y') }}</td>
                        <td class="p-3">{{ $event->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
