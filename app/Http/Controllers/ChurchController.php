<?php

namespace App\Http\Controllers;

use App\Models\Church;
use Illuminate\Http\Request;

class ChurchController extends Controller
{
    /**
     * Display a listing of churches.
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
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:churches',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'founded_year' => 'nullable|integer|min:1800|max:' . date('Y'),
        ]);

        Church::create($request->all());

        return redirect()->route('churches.index')->with('success', 'Church created successfully.');
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
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:churches,slug,' . $church->id,
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'founded_year' => 'nullable|integer|min:1800|max:' . date('Y'),
        ]);

        $church->update($request->all());

        return redirect()->route('churches.index')->with('success', 'Church updated successfully.');
    }

    /**
     * Remove the specified church from storage.
     */
    public function destroy(Church $church)
    {
        $church->delete();
        return redirect()->route('churches.index')->with('success', 'Church deleted successfully.');
    }
}
