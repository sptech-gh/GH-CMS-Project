<<<<<<< HEAD
<<<<<<< HEAD
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('👥 Members - ') }} {{ currentChurchName() }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Quick Actions + Search --}}
            <div class="flex flex-wrap justify-between items-center mb-4 space-y-2 sm:space-y-0">
                <a href="{{ route('members.create') }}" class="px-4 py-2 bg-primary text-white rounded hover:bg-primary-dark">
                    ➕ Add Member
                </a>

                <form method="GET" action="{{ route('members.index') }}" class="flex space-x-2">
                    <input type="text" name="search" placeholder="Search by name or email..."
                           value="{{ request('search') }}"
                           class="px-3 py-2 border rounded w-full sm:w-64 focus:outline-none focus:ring-2 focus:ring-primary">
                    <button type="submit" class="px-4 py-2 bg-accent text-white rounded hover:bg-accent-dark">
                        Search
                    </button>
                </form>
            </div>

            {{-- Members Table --}}
            <div class="bg-white shadow rounded-lg p-4 overflow-x-auto">
                @if($members->isEmpty())
                    <p class="text-gray-600 mt-4">No members found.</p>
                @else
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th class="p-2 border">ID</th>
                                <th class="p-2 border">Name</th>
                                <th class="p-2 border">Email</th>
                                <th class="p-2 border">Role</th>
                                <th class="p-2 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($members as $member)
                                <tr class="bg-white even:bg-gray-100 hover:bg-gray-50">
                                    <td class="p-2 border">{{ $member->id }}</td>
                                    <td class="p-2 border">{{ $member->name }}</td>
                                    <td class="p-2 border">{{ $member->email }}</td>
                                    <td class="p-2 border capitalize">{{ $member->role }}</td>
                                    <td class="p-2 border flex flex-wrap space-x-2">
                                        <a href="{{ route('members.edit', $member->id) }}" class="px-2 py-1 bg-blue-600 text-white rounded hover:bg-blue-500">
                                            Edit
                                        </a>
                                        <form action="{{ route('members.destroy', $member->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded hover:bg-red-500"
                                                    onclick="return confirm('Delete this member?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $members->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
=======
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

=======
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
    <h1 class="text-2xl font-bold mb-6 bg-ghana-gradient bg-clip-text text-ghana-gradient">
        @if(isset($church))
            {{ $church->name }} Members
        @else
            All Members
        @endif
    </h1>

    <div class="mb-4">
        <a href="{{ isset($church) ? route('churches.members.create', $church) : route('members.create') }}"
           class="px-4 py-2 bg-ghana-gradient text-white rounded-lg shadow hover:opacity-90 transition">
            Add New Member
        </a>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-6 border-t-4 border-ghana-gradient">
        @if($members->isEmpty())
            <p class="text-gray-500">No members found.</p>
        @else
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-ghana-gradient bg-opacity-20 text-ghBlack">
                        <th class="p-3 border">Name</th>
                        <th class="p-3 border">Email</th>
                        <th class="p-3 border">Phone</th>
                        <th class="p-3 border">Joined</th>
                        <th class="p-3 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($members as $member)
                        <tr class="hover:bg-ghana-gradient hover:bg-opacity-10">
                            <td class="p-3 border">{{ $member->name }}</td>
                            <td class="p-3 border">{{ $member->email }}</td>
                            <td class="p-3 border">{{ $member->phone ?? 'N/A' }}</td>
                            <td class="p-3 border">{{ $member->created_at->format('M d, Y') }}</td>
                            <td class="p-3 border flex gap-2">
                                <a href="{{ route('members.edit', $member) }}" class="px-3 py-1 bg-ghGold text-white rounded hover:opacity-90 transition">
                                    Edit
                                </a>
                                <form action="{{ route('members.destroy', $member) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-ghRed text-white rounded hover:opacity-90 transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
<<<<<<< HEAD
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
=======
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
    </div>

</div>
@endsection
