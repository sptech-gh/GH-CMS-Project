@extends('layouts.app')

@section('content')
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
    </form>
</div>
@endsection
