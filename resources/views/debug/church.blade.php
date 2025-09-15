<!DOCTYPE html>
<html>
<head>
    <title>Debug - Selected Church</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-lg">
        <h1 class="text-2xl font-bold mb-4 text-blue-600">Debug: Selected Church</h1>

        @if($church)
            <div class="space-y-3">
                <p><strong>Selected Church ID:</strong> {{ $churchId }}</p>
                <p><strong>Name:</strong> {{ $church->name }}</p>
                <p><strong>Location:</strong> {{ $church->location }}</p>
                <p><strong>Region:</strong> {{ $church->region }}</p>
                <p><strong>Denomination:</strong> {{ $church->denomination }}</p>
            </div>
        @else
            <p class="text-red-600">⚠️ No church found with ID <strong>{{ $churchId }}</strong>.</p>
        @endif

        <div class="mt-6">
            <a href="{{ route('select.church') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Change Church
            </a>
        </div>
    </div>

</body>
</html>
