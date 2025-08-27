<?php

namespace App\Http\Controllers;

use App\Models\Church;
use Illuminate\Http\Request;

class ChurchController extends Controller
{
    public function index()
    {
        $churches = Church::all();
        return view('churches.index', compact('churches'));
    }

    public function create()
    {
        return view('churches.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Church::create($request->all());

        return redirect()->route('churches.index')->with('success', 'Church created successfully.');
    }

    public function edit(Church $church)
    {
        return view('churches.edit', compact('church'));
    }

    public function update(Request $request, Church $church)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $church->update($request->all());

        return redirect()->route('churches.index')->with('success', 'Church updated successfully.');
    }

    public function destroy(Church $church)
    {
        $church->delete();

        return redirect()->route('churches.index')->with('success', 'Church deleted successfully.');
    }
}
