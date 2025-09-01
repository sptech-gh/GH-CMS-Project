<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Record Donation – {{ $church->name }}
        </h2>
    </x-slot>

    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST" action="{{ route('donations.store', $church->slug) }}" class="space-y-6">
            @csrf

            <!-- Donor -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Donor (optional)</label>
                <select name="member_id" class="mt-1 block w-full rounded-lg border-gray-300">
                    <option value="">Anonymous</option>
                    @foreach($church->members as $member)
                        <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                            {{ $member->name }}
                        </option>
                    @endforeach
                </select>
                @error('member_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Amount -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Amount (₵)</label>
                <input type="number" step="0.01" name="amount" value="{{ old('amount') }}" required
                       class="mt-1 block w-full rounded-lg border-gray-300"/>
                @error('amount')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Method -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Payment Method</label>
                <select name="method" class="mt-1 block w-full rounded-lg border-gray-300">
                    <option value="cash" {{ old('method')=='cash' ? 'selected' : '' }}>Cash</option>
                    <option value="mobile_money" {{ old('method')=='mobile_money' ? 'selected' : '' }}>Mobile Money</option>
                    <option value="card" {{ old('method')=='card' ? 'selected' : '' }}>Card</option>
                    <option value="bank_transfer" {{ old('method')=='bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                </select>
                @error('method')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Notes -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Notes</label>
                <textarea name="notes" rows="3"
                          class="mt-1 block w-full rounded-lg border-gray-300">{{ old('notes') }}</textarea>
                @error('notes')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex justify-end">
                <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    Save Donation
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
