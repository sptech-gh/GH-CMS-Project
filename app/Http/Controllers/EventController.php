<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
<<<<<<< HEAD

class EventController extends Controller
{
    /**
     * Display a listing of events for the current church with search & filters.
     */
    public function index(Request $request)
    {
        $church = app('currentChurch');

        $query = $church->events()->orderBy('event_date', 'asc');

        // ✅ Search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // ✅ Filter by Start Date
        if ($request->filled('start_date')) {
            $query->whereDate('event_date', '>=', $request->start_date);
        }

        // ✅ Filter by End Date
        if ($request->filled('end_date')) {
            $query->whereDate('event_date', '<=', $request->end_date);
        }

        $events = $query->paginate(10);

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        $this->authorizeChurchAction();
        return view('events.create');
    }

    /**
     * Store a newly created event in the current church.
     */
    public function store(Request $request)
    {
        $this->authorizeChurchAction();
        $church = app('currentChurch');

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'event_date'  => 'required|date',
            'description' => 'nullable|string',
        ]);

        $validated['church_id'] = $church->id;

        Event::create($validated);

        return redirect()
            ->route('events.index')
            ->with('success', '✅ Event created successfully.');
    }

    /**
     * Display the specified event details.
     */
=======
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

>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
    public function show(Event $event)
    {
        $this->authorizeEvent($event);
        return view('events.show', compact('event'));
    }

<<<<<<< HEAD
    /**
     * Show the form for editing the specified event.
     */
=======
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
    public function edit(Event $event)
    {
        $this->authorizeEvent($event);
        return view('events.edit', compact('event'));
    }

<<<<<<< HEAD
    /**
     * Update the specified event in the current church.
     */
=======
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
    public function update(Request $request, Event $event)
    {
        $this->authorizeEvent($event);

        $validated = $request->validate([
<<<<<<< HEAD
            'title'       => 'required|string|max:255',
            'event_date'  => 'required|date',
            'description' => 'nullable|string',
=======
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
        ]);

        $event->update($validated);

<<<<<<< HEAD
        return redirect()
            ->route('events.index')
            ->with('success', '✏️ Event updated successfully.');
    }

    /**
     * Remove the specified event from the current church.
     */
=======
        return redirect()->route('events.index')->with('success', 'Event updated successfully!');
    }

>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
    public function destroy(Event $event)
    {
        $this->authorizeEvent($event);
        $event->delete();

<<<<<<< HEAD
        return redirect()
            ->route('events.index')
            ->with('success', '🗑️ Event deleted successfully.');
    }

    /**
     * Ensure the event belongs to the current church.
     */
    private function authorizeEvent(Event $event)
    {
        $church = app('currentChurch');

        if ($event->church_id !== $church->id) {
            abort(403, '🚫 Unauthorized action.');
        }

        $this->authorizeChurchAction();
    }

    /**
     * Ensure current user has rights (Pastor/Admin only).
     */
    private function authorizeChurchAction()
    {
        $user   = auth()->user();
        $church = app('currentChurch');

        // ✅ safer: directly query pivot role with explicit prefix
        $role = $user->churches()
            ->where('church_user.church_id', $church->id)
            ->pluck('church_user.role')
            ->first();

        if (! in_array($role, ['pastor', 'admin'])) {
            abort(403, '🚫 Only Pastor or Admin can perform this action.');
=======
        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }

    private function authorizeEvent(Event $event)
    {
        if ($event->church_id !== Auth::user()->church_id) {
            abort(403, 'Unauthorized action.');
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
        }
    }
}
