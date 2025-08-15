@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Church</h1>
    <form action="{{ route('churches.update', $church) }}" method="POST">
        @csrf
        @method('PUT')
        @include('churches.form')
    </form>
</div>
@endsection
