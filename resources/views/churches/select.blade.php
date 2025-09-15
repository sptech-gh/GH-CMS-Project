<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Select Active Church</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto bg-white p-6 rounded shadow">
        @if(session('error'))
            <div class="mb-4 p-3 rounded bg-red-100 text-red-700">{{ session('error') }}</div>
        @endif

        <p class="mb-4">Please select a church to continue:</p>

        <form action="{{ route('select-church.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block font-medium">Church</label>
                <select name="church_id" class="w-full border rounded p-2" required>
                    <option value="">-- Select a Church --</option>
                    @foreach($churches as $church)
                        <option value="{{ $church->id }}">{{ $church->name }}</option>
                    @endforeach
                </select>
                @error('church_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end space-x-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Set Active Church
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
