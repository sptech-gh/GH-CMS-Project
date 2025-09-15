@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4 text-ghana-red">
        {{ isset($church) ? $church->name . ' - Add Event' : 'Add Event' }}
    </h1>

    {{-- Event Form --}}
    <form method="POST" action="{{ isset($church)
                                    ? route('churches.events.store', $church->id)
                                    : route('events.store') }}">
        @csrf

        {{-- Title --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title') }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        {{-- Description --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">Description</label>
            <textarea name="description" class="w-full border rounded px-3 py-2" required>{{ old('description') }}</textarea>
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
            Save Event
        </button>
    </form>
</div>
@endsection
