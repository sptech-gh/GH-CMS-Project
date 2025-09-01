@extends('layouts.app')

@section('title', 'Donation Details')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Back button -->
    <a href="{{ route('donations.all') }}"
       class="inline-block mb-4 px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition">
       ← Back to All Donations
    </a>

    <!-- Donation Card -->
    <div class="bg-white shadow-lg rounded-2xl p-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Donation #{{ $donation->id }}</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left side -->
            <div>
                <p class="text-gray-600"><strong>Amount:</strong>
                    <span class="text-green-600 font-semibold">
                        GHS {{ number_format($donation->amount, 2) }}
                    </span>
                </p>

                <p class="text-gray-600 mt-2"><strong>Status:</strong>
                    <span class="@if($donation->status === 'successful') text-green-600 @elseif($donation->status === 'pending') text-yellow-600 @else text-red-600 @endif font-semibold">
                        {{ ucfirst($donation->status) }}
                    </span>
                </p>

                <p class="text-gray-600 mt-2"><strong>Payment Method:</strong>
                    {{ $donation->payment_method ?? 'N/A' }}
                </p>
            </div>

            <!-- Right side -->
            <div>
                <p class="text-gray-600"><strong>Church:</strong>
                    {{ $donation->church->name ?? 'N/A' }}
                </p>

                <p class="text-gray-600 mt-2"><strong>Donor (Member):</strong>
                    {{ $donation->member->name ?? 'Anonymous' }}
                </p>

                <p class="text-gray-600 mt-2"><strong>Date:</strong>
                    {{ $donation->created_at->format('M d, Y h:i A') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex space-x-4 mt-6">
        <!-- Edit button -->
        <a href="{{ route('donations.edit', $donation->id) }}"
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
           Edit Donation
        </a>

        <!-- Delete button -->
        <form action="{{ route('donations.destroy', $donation->id) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this donation?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                Delete Donation
            </button>
        </form>
    </div>
</div>
@endsection
