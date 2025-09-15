@extends('layouts.app')

<<<<<<< HEAD
@section('title', 'Add Donation')

@section('content')
<h1 class="text-3xl font-bold mb-6 text-green-700">➕ Add Donation</h1>

<form action="{{ route('donations.store') }}" method="POST" class="max-w-lg bg-white p-6 rounded shadow">
    @csrf

    <div class="mb-4">
        <label for="donor_name" class="block mb-1 font-semibold">Donor Name</label>
        <input type="text" name="donor_name" id="donor_name" class="w-full border rounded p-2" placeholder="Optional">
        @error('donor_name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="amount" class="block mb-1 font-semibold">Amount (GHS)</label>
        <input type="number" name="amount" id="amount" step="0.01" class="w-full border rounded p-2" required>
        @error('amount')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="px-4 py-2 bg-yellow-600 text-black font-bold rounded hover:bg-yellow-500">Save Donation</button>
    <a href="{{ route('donations.index') }}" class="ml-4 text-gray-700 hover:underline">Cancel</a>
</form>
=======
@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4 text-ghana-red">
        {{ isset($church) ? $church->name . ' - Add Donation' : 'Add Donation' }}
    </h1>

    {{-- Donation Form --}}
    <form method="POST" action="{{ isset($church)
                                    ? route('churches.donations.store', $church->id)
                                    : route('donations.store') }}">
        @csrf

        {{-- Donor Name --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Donor Name</label>
            <input type="text" name="donor_name" value="{{ old('donor_name') }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        {{-- Amount --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Amount</label>
            <input type="number" name="amount" value="{{ old('amount') }}" step="0.01"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        {{-- Date --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Date</label>
            <input type="date" name="date" value="{{ old('date') }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        {{-- Submit --}}
        <button type="submit"
                class="bg-ghana-green text-white px-4 py-2 rounded shadow hover:bg-ghana-yellow hover:text-black">
            Save Donation
        </button>
    </form>
</div>
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
@endsection
