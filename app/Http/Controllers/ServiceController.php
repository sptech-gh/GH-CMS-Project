<?php

namespace App\Http\Controllers;

use App\Models\Church;
use App\Models\Service;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Display a listing of the services for the selected church.
     */
    public function index(Request $request, Church $church)
    {
        $this->authorizeChurch($church);

=======

class ServiceController extends Controller
{
    public function index(Church $church)
    {
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
        $services = $church->services()->latest()->paginate(10);

        return view('services.index', compact('church', 'services'));
    }

<<<<<<< HEAD
    /**
     * Show the form for creating a new service.
     */
    public function create(Church $church)
    {
        $this->authorizeChurch($church);

        return view('services.create', compact('church'));
    }

    /**
     * Store a newly created service in storage.
     */
    public function store(Request $request, Church $church)
    {
        $this->authorizeChurch($church);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
        ]);

        $church->services()->create($validated);

        return redirect()
            ->route('churches.services.index', $church)
            ->with('success', 'Service created successfully.');
    }

    /**
     * Show the form for editing the specified service.
     */
    public function edit(Church $church, Service $service)
    {
        $this->authorizeChurch($church);
=======
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
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603

        return view('services.edit', compact('church', 'service'));
    }

<<<<<<< HEAD
    /**
     * Update the specified service.
     */
    public function update(Request $request, Church $church, Service $service)
    {
        $this->authorizeChurch($church);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
        ]);

        $service->update($validated);

        return redirect()
            ->route('churches.services.index', $church)
            ->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified service.
     */
    public function destroy(Church $church, Service $service)
    {
        $this->authorizeChurch($church);
=======
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
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603

        $service->delete();

        return redirect()
<<<<<<< HEAD
            ->route('churches.services.index', $church)
            ->with('success', 'Service deleted successfully.');
    }

    /**
     * Ensure the user has access to the given church.
     */
    protected function authorizeChurch(Church $church)
    {
        if (!Auth::user()->churches->contains($church->id)) {
=======
            ->route('services.index', $church->slug)
            ->with('success', 'Service deleted successfully.');
    }

    private function authorizeAccess(Church $church, Service $service)
    {
        if ($service->church_id !== $church->id) {
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
            abort(403, 'Unauthorized action.');
        }
    }
}
