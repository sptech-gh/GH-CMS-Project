@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4 text-ghana-red">
        {{ isset($church) ? $church->name . ' - Edit Donation' : 'Edit Donation' }}
    </h1>

    {{-- Donation Form --}}
    <form method="POST" action="{{ isset($church)
                                    ? route('churches.donations.update', [$church->id, $donation->id])
                                    : route('donations.update', $donation->id) }}">
        @csrf
        @method('PUT')

        {{-- Donor Name --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Donor Name</label>
            <input type="text" name="donor_name" value="{{ old('donor_name', $donation->donor_name) }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        {{-- Amount --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Amount</label>
            <input type="number" name="amount" value="{{ old('amount', $donation->amount) }}" step="0.01"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        {{-- Date --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Date</label>
            <input type="date" name="date" value="{{ old('date', $donation->date) }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        {{-- Submit --}}
        <button type="submit"
                class="bg-ghana-green text-white px-4 py-2 rounded shadow hover:bg-ghana-yellow hover:text-black">
            Update Donation
        </button>
    </form>
</div>
@endsection
