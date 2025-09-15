<x-app-layout>
    <div class="max-w-2xl mx-auto text-center py-16">
        <h1 class="text-2xl font-bold text-[#CE1126] mb-4">
            🚫 No Church Assigned
        </h1>
        <p class="text-gray-600 mb-6">
            Your account has been created successfully, but you have not yet been assigned
            to a church. Please contact your church administrator to be added.
        </p>
        <a href="{{ route('logout') }}"
           class="inline-block bg-[#CE1126] text-white px-4 py-2 rounded-lg hover:bg-[#FCD116]">
            Logout
        </a>
    </div>
</x-app-layout>
