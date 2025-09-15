<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $church->name }} - Service Details
        </h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto">
        <div class="bg-white shadow sm:rounded-lg p-6">
            <h3 class="text-lg font-bold">{{ $service->title }}</h3>
            <p class="mt-2 text-gray-600">{{ $service->description }}</p>
            <p class="mt-4"><strong>Date:</strong> {{ $service->date }}</p>
            <p><strong>Time:</strong> {{ $service->time }}</p>
        </div>
    </div>
</x-app-layout>
