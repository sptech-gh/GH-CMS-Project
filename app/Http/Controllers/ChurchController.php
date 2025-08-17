<?php

namespace App\Http\Controllers;

use App\Models\Church;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChurchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $churches = Church::latest()->paginate(10);
        return view('churches.index', compact('churches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('churches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:churches,name',
            'location' => 'required|string|max:255',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        Church::create($validated);

        return redirect()->route('churches.index')->with('success', 'Church created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Church $church)
    {
        return view('churches.show', compact('church'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Church $church)
    {
        return view('churches.edit', compact('church'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Church $church)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:churches,name,' . $church->id,
            'location' => 'required|string|max:255',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $church->update($validated);

        return redirect()->route('churches.index')->with('success', 'Church updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Church $church)
    {
        $church->delete();

        return redirect()->route('churches.index')->with('success', 'Church deleted successfully.');
    }
}
