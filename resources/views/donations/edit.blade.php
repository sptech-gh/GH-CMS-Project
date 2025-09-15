@extends('layouts.app')

@section('content')
<<<<<<< HEAD
<div class="bg-white shadow rounded p-6">
    <h1 class="text-2xl font-bold text-[#006B3F] mb-4">Edit Donation</h1>

    <form action="{{ route('donations.update', $donation) }}" method="POST" class="space-y-4">
        @csrf @method('PUT')

        <div>
            <label class="block">Donor Name</label>
            <input type="text" name="donor_name" class="w-full border rounded p-2" value="{{ $donation->donor_name }}" required>
        </div>

        <div>
            <label class="block">Amount</label>
            <input type="number" name="amount" step="0.01" class="w-full border rounded p-2" value="{{ $donation->amount }}" required>
        </div>

        <div>
            <label class="block">Date</label>
            <input type="date" name="date" class="w-full border rounded p-2" value="{{ $donation->date }}" required>
        </div>

        <button class="bg-[#FCD116] px-4 py-2 rounded shadow hover:bg-[#CE1126] hover:text-white">Update</button>
=======
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
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
    </form>
</div>
@endsection
