{{-- resources/views/donations/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="p-6">
    {{-- Page Title --}}
    <h1 class="text-2xl font-bold mb-4 text-ghana-red">
        {{ isset($church) ? $church->name . ' Donations' : 'All Donations' }}
    </h1>

    {{-- Add Donation Button --}}
    <a href="{{ isset($church)
                ? route('churches.donations.create', $church->id)
                : route('donations.create') }}"
       class="bg-ghana-green text-white px-4 py-2 rounded shadow hover:bg-ghana-yellow hover:text-black">
        ➕ Add Donation
    </a>

    {{-- Donations Table --}}
    <table class="w-full mt-6 border-collapse border border-gray-200">
        <thead class="bg-ghana-yellow text-black">
            <tr>
                <th class="p-2 border">Donor</th>
                <th class="p-2 border">Amount</th>
                <th class="p-2 border">Date</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($donations as $donation)
                <tr>
                    <td class="p-2 border">{{ $donation->donor_name }}</td>
                    <td class="p-2 border">{{ $donation->amount }}</td>
                    <td class="p-2 border">{{ $donation->date }}</td>
                    <td class="p-2 border">
                        {{-- Edit --}}
                        <a href="{{ isset($church)
                                    ? route('churches.donations.edit', [$church->id, $donation->id])
                                    : route('donations.edit', $donation->id) }}"
                           class="text-ghana-blue font-medium hover:underline">✏️ Edit</a>

                        {{-- Delete --}}
                        <form action="{{ isset($church)
                                        ? route('churches.donations.destroy', [$church->id, $donation->id])
                                        : route('donations.destroy', $donation->id) }}"
                              method="POST" class="inline-block ml-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-ghana-red font-medium hover:underline"
                                    onclick="return confirm('Are you sure?')">🗑 Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">No donations found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
