@csrf

<div class="mb-4">
    <label class="block font-bold">Name</label>
    <input type="text" name="name" value="{{ old('name', $church->name ?? '') }}" class="border p-2 w-full" required>
</div>

<div class="mb-4">
    <label class="block font-bold">Slug</label>
    <input type="text" name="slug" value="{{ old('slug', $church->slug ?? '') }}" class="border p-2 w-full" required>
</div>

<div class="mb-4">
    <label class="block font-bold">Address</label>
    <input type="text" name="address" value="{{ old('address', $church->address ?? '') }}" class="border p-2 w-full">
</div>

<div class="mb-4">
    <label class="block font-bold">Phone</label>
    <input type="text" name="phone" value="{{ old('phone', $church->phone ?? '') }}" class="border p-2 w-full">
</div>

<div class="mb-4">
    <label class="block font-bold">Email</label>
    <input type="email" name="email" value="{{ old('email', $church->email ?? '') }}" class="border p-2 w-full">
</div>

<div class="mb-4">
    <label class="block font-bold">Website</label>
    <input type="url" name="website" value="{{ old('website', $church->website ?? '') }}" class="border p-2 w-full">
</div>

<div class="mb-4">
    <label class="block font-bold">Description</label>
    <textarea name="description" class="border p-2 w-full">{{ old('description', $church->description ?? '') }}</textarea>
</div>

<div class="mb-4">
    <label class="block font-bold">Founded Year</label>
    <input type="number" name="founded_year" value="{{ old('founded_year', $church->founded_year ?? '') }}" class="border p-2 w-full">
</div>

<button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
