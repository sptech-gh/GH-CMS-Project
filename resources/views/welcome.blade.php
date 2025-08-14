<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Church SaaS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-blue-600">Church SaaS is Ready!</h1>
        <button
            x-data="{ count: 0 }"
            @click="count++"
            class="mt-4 px-4 py-2 bg-green-500 text-white rounded">
            Clicked <span x-text="count"></span> times
        </button>
    </div>
</body> 
</html>

