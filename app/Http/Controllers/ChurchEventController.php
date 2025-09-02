<?php

namespace App\Http\Controllers;

use App\Models\Church;
use App\Models\Event;
use Illuminate\Http\Request;

class ChurchEventController extends Controller
{
    public function index(Church $church)
    {
        $events = $church->events()->latest()->get();
        return view('events.index', compact('events', 'church'));
    }

    public function create(Church $church)
    {
        return view('events.create', compact('church'));
    }

    public function store(Request $request, Church $church)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
        ]);

        $church->events()->create($validated);

        return redirect()->route('churches.events.index', $church->id)
            ->with('success', 'Event created successfully.');
    }

    public function show(Church $church, Event $event)
    {
        return view('events.show', compact('event', 'church'));
    }

    public function edit(Church $church, Event $event)
    {
        return view('events.edit', compact('event', 'church'));
    }

    public function update(Request $request, Church $church, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
        ]);

        $event->update($validated);

        return redirect()->route('churches.events.index', $church->id)
            ->with('success', 'Event updated successfully.');
    }

    public function destroy(Church $church, Event $event)
    {
        $event->delete();

        return redirect()->route('churches.events.index', $church->id)
            ->with('success', 'Event deleted successfully.');
    }
}
