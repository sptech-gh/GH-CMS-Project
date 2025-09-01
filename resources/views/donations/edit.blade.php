<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Edit Donation – {{ $church->name }}
        </h2>
    </x-slot>

    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST" action="{{ route('donations.update', ['church' => $church->slug, 'donation' => $donation->id]) }}">
            @csrf
            @method('PUT')

            <!-- Donor -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Donor</label>
                <select name="member_id" class="w-full border rounded p-2">
                    <option value="">Anonymous</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}" {{ $donation->member_id == $member->id ? 'selected' : '' }}>
                            {{ $member->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Amount -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Amount (₵)</label>
                <input type="number" name="amount" step="0.01"
                       value="{{ old('amount', $donation->amount) }}"
                       class="w-full border rounded p-2">
            </div>

            <!-- Method -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Method</label>
                <select name="method" class="w-full border rounded p-2">
                    <option value="cash" {{ $donation->method=='cash' ? 'selected' : '' }}>Cash</option>
                    <option value="mobile_money" {{ $donation->method=='mobile_money' ? 'selected' : '' }}>Mobile Money</option>
                    <option value="card" {{ $donation->method=='card' ? 'selected' : '' }}>Card</option>
                    <option value="bank_transfer" {{ $donation->method=='bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                </select>
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" class="w-full border rounded p-2">
                    <option value="pending" {{ $donation->status=='pending' ? 'selected' : '' }}>Pending</option>
                    <option value="successful" {{ $donation->status=='successful' ? 'selected' : '' }}>Successful</option>
                    <option value="failed" {{ $donation->status=='failed' ? 'selected' : '' }}>Failed</option>
                </select>
            </div>

            <!-- Notes -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Notes</label>
                <textarea name="notes" rows="3" class="w-full border rounded p-2">{{ old('notes', $donation->notes) }}</textarea>
            </div>

            <!-- Actions -->
            <div class="flex space-x-3">
                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Update
                </button>
                <a href="{{ route('donations.show', ['church' => $church->slug, 'donation' => $donation->id]) }}"
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
