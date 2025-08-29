<?php

namespace App\Http\Controllers;

use App\Models\Church;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChurchController extends Controller
{
    /**
     * Display a listing of the churches.
     */
    public function index()
    {
        $churches = Church::all();
        return view('churches.index', compact('churches'));
    }

    /**
     * Show the form for creating a new church.
     */
    public function create()
    {
        return view('churches.create');
    }

    /**
     * Store a newly created church in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'pastor_name' => 'nullable|string|max:255',
            'founded_at'  => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        Church::create($validated);

        return redirect()->route('churches.index')
            ->with('success', 'Church created successfully.');
    }

    /**
     * Display the specified church.
     */
    public function show(Church $church)
    {
        return view('churches.show', compact('church'));
    }

    /**
     * Show the form for editing the specified church.
     */
    public function edit(Church $church)
    {
        return view('churches.edit', compact('church'));
    }

    /**
     * Update the specified church in storage.
     */
    public function update(Request $request, Church $church)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'pastor_name' => 'nullable|string|max:255',
            'founded_at'  => 'nullable|date',
        ]);

        // If the name changes, regenerate the slug
        if ($validated['name'] !== $church->name) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $church->update($validated);

        return redirect()->route('churches.index')
            ->with('success', 'Church updated successfully.');
    }

    /**
     * Remove the specified church from storage.
     */
    public function destroy(Church $church)
    {
        $church->delete();

        return redirect()->route('churches.index')
            ->with('success', 'Church deleted successfully.');
    }
}
