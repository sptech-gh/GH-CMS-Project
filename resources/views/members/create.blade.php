<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ➕ Add New Member
        </h2>
        <p class="text-sm text-gray-600">Fill in the details below to register a member.</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-2xl overflow-hidden border border-gray-200">

            <!-- Form -->
            <div class="p-6">
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <strong>Whoops!</strong> Please fix the following issues:
                        <ul class="list-disc ml-5 mt-2 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('members.store') }}" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700">Full Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="w-full mt-1 p-3 border rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500"
                            placeholder="Enter full name" required>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="w-full mt-1 p-3 border rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500"
                            placeholder="Enter email address" required>
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                            class="w-full mt-1 p-3 border rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500"
                            placeholder="e.g. 024xxxxxxx">
                    </div>

                    <!-- Gender -->
                    <div>
                        <label for="gender" class="block text-sm font-semibold text-gray-700">Gender</label>
                        <select name="gender" id="gender"
                            class="w-full mt-1 p-3 border rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="">-- Select Gender --</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <!-- Date of Birth -->
                    <div>
                        <label for="date_of_birth" class="block text-sm font-semibold text-gray-700">Date of Birth</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}"
                            class="w-full mt-1 p-3 border rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    </div>

                    <!-- Church -->
                    <div>
                        <label for="church_id" class="block text-sm font-semibold text-gray-700">Church</label>
                        <select name="church_id" id="church_id"
                            class="w-full mt-1 p-3 border rounded-lg shadow-sm focus:ring-2 focus:ring-green-500 focus:border-green-500"
                            required>
                            <option value="">-- Select Church --</option>
                            @foreach($churches as $church)
                                <option value="{{ $church->id }}" {{ old('church_id') == $church->id ? 'selected' : '' }}>
                                    {{ $church->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-3 font-bold text-white rounded-lg shadow-md bg-gradient-to-r from-red-600 via-yellow-400 to-green-600 hover:opacity-90 transition">
                            ✅ Save Member
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
