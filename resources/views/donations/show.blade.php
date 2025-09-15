@extends('layouts.app')

@section('title', 'Donation Details')

@section('content')
<h1 class="text-3xl font-bold mb-6 text-blue-700">💵 Donation Details</h1>

<div class="bg-white p-6 rounded shadow max-w-md">
    <p><strong>ID:</strong> {{ $donation->id }}</p>
    <p><strong>Donor:</strong> {{ $donation->donor_name ?? 'Anonymous' }}</p>
    <p><strong>Amount:</strong> GHS {{ number_format($donation->amount, 2) }}</p>
    <p><strong>Date:</strong> {{ $donation->created_at->format('d M, Y H:i') }}</p>

    <a href="{{ route('donations.index') }}" class="mt-4 inline-block px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600">Back to Donations</a>
</div>
@endsection
