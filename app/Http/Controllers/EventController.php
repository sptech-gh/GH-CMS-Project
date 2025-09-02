<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('church_id', Auth::user()->church_id)->get();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    { $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'date' => 'required|date',
    ]);

    // Attach church_id automatically from logged-in user
    $event = new \App\Models\Event();
    $event->title = $request->title;
    $event->description = $request->description;
    $event->date = $request->date;
    $event->church_id = auth()->user()->church_id; // ✅ Fix
    $event->save();

    return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        $this->authorizeEvent($event);
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $this->authorizeEvent($event);
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $this->authorizeEvent($event);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
        ]);

        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        $this->authorizeEvent($event);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }

    private function authorizeEvent(Event $event)
    {
        if ($event->church_id !== Auth::user()->church_id) {
            abort(403, 'Unauthorized action.');
        }
    }
}
