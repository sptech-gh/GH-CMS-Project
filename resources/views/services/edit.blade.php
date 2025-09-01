@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">

    <h1 class="text-2xl font-bold mb-6 bg-ghana-gradient bg-clip-text text-ghana-gradient">
        Edit Service
    </h1>

    <div class="bg-white shadow-lg rounded-lg p-8 border-t-4 border-ghana-gradient">
        <form action="{{ route('services.update', $service) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Service Name -->
            <div class="mb-4">
                <label for="name" class="block text-ghBlack font-semibold mb-2">Service Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $service->name) }}" required
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-ghana-gradient @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-ghBlack font-semibold mb-2">Description</label>
                <textarea id="description" name="description" rows="4" required
                          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-ghana-gradient @error('description') border-red-500 @enderror">{{ old('description', $service->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date / Time -->
            <div class="mb-4">
                <label for="date" class="block text-ghBlack font-semibold mb-2">Service Date</label>
                <input type="date" id="date" name="date" value="{{ old('date', $service->date->format('Y-m-d')) }}" required
                       class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-ghana-gradient @error('date') border-red-500 @enderror">
                @error('date')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('services.in
