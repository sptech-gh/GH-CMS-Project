@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    <h1 class="text-2xl font-bold mb-6 bg-ghana-gradient bg-clip-text text-ghana-gradient">
        @if(isset($church))
            {{ $church->name }} Donations
        @else
            All Donations
        @endif
    </h1>

    <div class="mb-4">
        <a href="{{ isset($church) ? route('churches.donations.create', $church) : route('donations.create') }}"
           class="px-4 py-2 bg-ghana-gradient text-white rounded-lg shadow hover:opacity-90 transition">
            Add New Donation
        </a>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-6 border-t-4 border-ghana-gradient">
        @if($donations->isEmpty())
            <p class="text-gray-500">No donations found.</p>
        @else
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-ghana-gradient bg-opacity-20 text-ghBlack">
                        <th class="p-3 border">Donor</th>
                        <th class="p-3 border">Amount</th>
                        <th class="p-3 border">Date</th>
                        <th class="p-3 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($donations as $donation)
                        <tr class="hover:bg-ghana-gradient hover:bg-opacity-10">
                            <td class="p-3 border">{{ $donation->donor_name ?? 'Anonymous' }}</td>
                            <td class="p-3 border">₵{{ number_format($donation->amount, 2) }}</td>
                            <td class="p-3 border">{{ $donation->created_at->format('M d, Y') }}</td>
                            <td class="p-3 border flex gap-2">
                                <a href="{{ route('donations.edit', $donation) }}" class="px-3 py-1 bg-ghGold text-white rounded hover:opacity-90 transition">
                                    Edit
                                </a>
                                <form action="{{ route('donations.destroy', $donation) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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
    </div>

</div>
@endsection
