@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">{{ $church->name }}</h1>
    <p><strong>Slug:</strong> {{ $church->slug }}</p>
    <p><strong>Address:</strong> {{ $church->address }}</p>
    <p><strong>Phone:</strong> {{ $church->phone }}</p>
    <p><strong>Email:</strong> {{ $church->email }}</p>
    <p><strong>Website:</strong> {{ $church->website }}</p>
    <p><strong>Description:</strong> {{ $church->description }}</p>
    <p><strong>Founded Year:</strong> {{ $church->founded_year }}</p>

    <a href="{{ route('churches.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mt-4 inline-block">Back</a>
</div>
@endsection
