<x-app-layout>
    <h1 class="text-2xl font-bold text-ghana-gradient mb-4">Add New Church</h1>

    <form method="POST" action="{{ route('churches.store') }}" class="space-y-4">
        @csrf
        <input type="text" name="name" placeholder="Church Name" class="w-full p-2 border rounded">
        <input type="text" name="location" placeholder="Location" class="w-full p-2 border rounded">
        <input type="text" name="pastor_name" placeholder="Pastor Name" class="w-full p-2 border rounded">
        <input type="date" name="founded_at" class="w-full p-2 border rounded">

        <button type="submit" class="px-4 py-2 bg-ghana-gradient text-white rounded">
            Save
        </button>
    </form>
</x-app-layout>
