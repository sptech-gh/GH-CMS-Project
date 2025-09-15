@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen p-6 bg-ghana-green-50">
    {{-- Page Header --}}
    <h1 class="text-3xl font-bold mb-6 text-center text-ghana-gold">
        Dashboard
    </h1>

    {{-- Active Church --}}
    <div class="bg-white shadow-md rounded-xl p-6 mb-6">
        <h2 class="text-xl font-semibold mb-2 text-ghana-black">Active Church:</h2>
        <p class="text-lg text-ghana-green">
            {{ $church->name ?? 'No church selected' }}
        </p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        {{-- Members Count --}}
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border-t-4 border-ghana-red">
            <h3 class="font-semibold text-lg text-ghana-black">Members</h3>
            <p class="text-3xl font-bold text-ghana-red mt-2">{{ $membersCount }}</p>
        </div>

        {{-- Events Count --}}
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border-t-4 border-ghana-yellow">
            <h3 class="font-semibold text-lg text-ghana-black">Events</h3>
            <p class="text-3xl font-bold text-ghana-yellow mt-2">{{ $eventsCount }}</p>
        </div>

        {{-- Donations Placeholder --}}
        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border-t-4 border-ghana-green">
            <h3 class="font-semibold text-lg text-ghana-black">Donations</h3>
            <p class="text-3xl font-bold text-ghana-green mt-2">₵0</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        {{-- Recent Members --}}
        <div class="bg-white shadow-md rounded-xl p-6">
            <h3 class="text-xl font-semibold mb-4 text-ghana-black">Recent Members</h3>
            @if($recentMembers->isEmpty())
                <p class="text-gray-500">No members yet.</p>
            @else
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-ghana-red text-white">
                            <th class="px-4 py-2 text-left">Name</th>
                            <th class="px-4 py-2 text-left">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentMembers as $member)
                            <tr class="border-b hover:bg-ghana-green-50">
                                <td class="px-4 py-2">{{ $member->name }}</td>
                                <td class="px-4 py-2">{{ $member->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        {{-- Upcoming Events --}}
        <div class="bg-white shadow-md rounded-xl p-6">
            <h3 class="text-xl font-semibold mb-4 text-ghana-black">Upcoming Events</h3>
            @if($upcomingEvents->isEmpty())
                <p class="text-gray-500">No upcoming events.</p>
            @else
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-ghana-yellow text-ghana-black">
                            <th class="px-4 py-2 text-left">Event</th>
                            <th class="px-4 py-2 text-left">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($upcomingEvents as $event)
                            <tr class="border-b hover:bg-ghana-green-50">
                                <td class="px-4 py-2">{{ $event->title }}</td>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    {{-- Recent Activity --}}
    <div class="bg-white shadow-md rounded-xl p-6">
        <h3 class="text-xl font-semibold mb-4 text-ghana-black">Recent Activity</h3>
        <ul class="space-y-4">
            @forelse($recentMembers as $member)
                <li class="flex items-center space-x-3">
                    <span class="w-3 h-3 rounded-full bg-ghana-green"></span>
                    <p><span class="font-semibold">{{ $member->name }}</span> joined the church.</p>
                </li>
            @empty
                <li class="text-gray-500">No recent member activity.</li>
            @endforelse

            @forelse($upcomingEvents as $event)
                <li class="flex items-center space-x-3">
                    <span class="w-3 h-3 rounded-full bg-ghana-yellow"></span>
                    <p><span class="font-semibold">{{ $event->title }}</span> scheduled for {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}.</p>
                </li>
            @empty
                <li class="text-gray-500">No upcoming event activity.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
