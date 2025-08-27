<x-app-layout>
    <h1 class="text-2xl font-bold text-ghana-gradient mb-4">Edit Church</h1>

    <form method="POST" action="{{ route('churches.update', $church) }}" class="space-y-4">
        @csrf @method('PUT')
        <input type="text" name="name" value="{{ $church->name }}" class="w-full p-2 border rounded">
        <input type="text" name="location" value="{{ $church->location }}" class="w-full p-2 border rounded">
        <input type="text" name="pastor_name" value="{{ $church->pastor_name }}" class="w-full p-2 border rounded">
        <input type="date" name="founded_at" value="{{ $church->founded_at }}" class="w-full p-2 border rounded">

        <button type="submit" class="px-4 py-2 bg-ghana-gradient text-white rounded">
            Update
        </button>
    </form>
</x-app-layout>
