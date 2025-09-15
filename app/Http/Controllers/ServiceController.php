<?php

namespace App\Http\Controllers;

use App\Models\Church;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Church $church)
    {
        $services = $church->services()->latest()->paginate(10);

        return view('services.index', compact('church', 'services'));
    }

    public function create(Church $church)
    {
        return view('services.create', compact('church'));
    }

    public function store(Request $request, Church $church)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'time' => 'required'
        ]);

        $church->services()->create($request->all());

        return redirect()
            ->route('services.index', $church->slug)
            ->with('success', 'Service created successfully.');
    }

    public function edit(Church $church, Service $service)
    {
        $this->authorizeAccess($church, $service);

        return view('services.edit', compact('church', 'service'));
    }

    public function update(Request $request, Church $church, Service $service)
    {
        $this->authorizeAccess($church, $service);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'time' => 'required'
        ]);

        $service->update($request->all());

        return redirect()
            ->route('services.index', $church->slug)
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Church $church, Service $service)
    {
        $this->authorizeAccess($church, $service);

        $service->delete();

        return redirect()
            ->route('services.index', $church->slug)
            ->with('success', 'Service deleted successfully.');
    }

    private function authorizeAccess(Church $church, Service $service)
    {
        if ($service->church_id !== $church->id) {
            abort(403, 'Unauthorized action.');
        }
    }
}
