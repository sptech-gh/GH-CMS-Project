@extends('layouts.app')

@section('content')
    <!-- Header -->
    <div class="bg-ghana-gradient text-white shadow rounded-2xl p-6 mb-8">
        <h1 class="text-3xl font-bold">Members</h1>
        <p class="mt-2 text-sm opacity-90">
            Manage church members and their details.
        </p>
    </div>

    <!-- Members Table -->
    <div class="bg-white shadow rounded-2xl p-6">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-3 text-left">#</th>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Phone</th>
                    <th class="p-3 text-left">Church</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $member)
                    <tr class="border-b">
                        <td class="p-3">{{ $loop->iteration }}</td>
                        <td class="p-3">{{ $member->name }}</td>
                        <td class="p-3">{{ $member->email }}</td>
                        <td class="p-3">{{ $member->phone }}</td>
                        <td class="p-3">{{ $member->church->name ?? 'N/A' }}</td>
                        <td class="p-3">
                            <a href="{{ route('members.edit', $member) }}"
                               class="px-3 py-1 bg-ghana-gradient text-white rounded-lg shadow hover:opacity-90">
                                Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-3 text-center text-gray-500">
                            No members found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
