<!-- Church Name -->
<div>
    <input type="text"
           name="name"
           placeholder="Church Name"
           value="{{ old('name', $church->name ?? '') }}"
           class="w-full p-2 border rounded @error('name') border-red-500 @enderror">
    @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Location -->
<div>
    <input type="text"
           name="location"
           placeholder="Location"
           value="{{ old('location', $church->location ?? '') }}"
           class="w-full p-2 border rounded">
</div>

<!-- Pastor Name -->
<div>
    <input type="text"
           name="pastor_name"
           placeholder="Pastor Name"
           value="{{ old('pastor_name', $church->pastor_name ?? '') }}"
           class="w-full p-2 border rounded">
</div>

<!-- Founded At -->
<div>
    <input type="date"
           name="founded_at"
           value="{{ old('founded_at', $church->founded_at ?? '') }}"
           class="w-full p-2 border rounded">
</div>

<!-- Description -->
<div>
    <textarea name="description"
              placeholder="Brief description of the church"
              rows="4"
              class="w-full p-2 border rounded">{{ old('description', $church->description ?? '') }}</textarea>
</div>
