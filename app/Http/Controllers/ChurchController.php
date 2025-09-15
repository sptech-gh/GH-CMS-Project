<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Church;
use Illuminate\Support\Facades\Auth;

class ChurchController extends Controller
{
    /**
     * Display all churches for Admin/Pastor/Assistant selection or Member selection.
     */
    public function select()
    {
        $user = Auth::user();

        // Members = single church via church_id, others = multiple via pivot
        $churches = $user->memberChurch()
            ? collect([$user->memberChurch()])
            : $user->churches;

        // If only one church, auto-select
        if ($churches->count() === 1) {
            session(['current_church_id' => $churches->first()->id]);
            return redirect()->route('dashboard');
        }

        return view('churches.select', compact('churches'));
    }

    /**
     * Set the active church in session for the user.
     */
    public function setActive(Request $request)
    {
        $request->validate([
            'church_id' => 'required|exists:churches,id',
        ]);

        $user = Auth::user();

        if ($user->memberChurch()) {
            // ✅ member: must match their assigned church_id
            $church = $user->memberChurch();
            if (! $church || $church->id != $request->church_id) {
                abort(403, '🚫 Unauthorized church selection.');
            }
        } else {
            // ✅ Admin/Pastor/Assistant: must exist in pivot
            $church = $user->churches()->findOrFail($request->church_id);
        }

        session(['current_church_id' => $church->id]);

        return redirect()->route('dashboard');
    }

    /**
     * Show the form for creating a new church (Admin/Pastor only).
     */
    public function create()
    {
        $this->authorizeChurchCreator();
        return view('churches.create');
    }

    /**
     * Store a newly created church and assign the creator as Admin.
     */
    public function storeNew(Request $request)
    {
        $this->authorizeChurchCreator();

        $request->validate([
            'name'        => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'region'      => 'nullable|string|max:255',
            'pastor_name' => 'nullable|string|max:255',
            'founded_at'  => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $church = Church::create([
            'name'        => $request->name,
            'location'    => $request->location,
            'region'      => $request->region,
            'pastor_name' => $request->pastor_name,
            'founded_at'  => $request->founded_at,
            'description' => $request->description,
        ]);

        // Attach church to current user as admin (pivot table)
        Auth::user()->churches()->attach($church->id, ['role' => 'admin']);

        return redirect()
            ->route('churches.index')
            ->with('success', '✅ Church created and assigned successfully!');
    }

    /**
     * Display all churches managed by the Admin/Pastor/Assistant.
     */
    public function index()
    {
        $churches = Auth::user()->churches; // from pivot
        return view('churches.index', compact('churches'));
    }

    /**
     * Show a single church (via slug binding).
     */
    public function show(Church $church)
    {
        $this->authorizeChurchAccess($church);
        return view('churches.show', compact('church'));
    }

    /**
     * Generate a church-specific registration invite link.
     */
    public function inviteLink(Church $church)
    {
        $user = Auth::user();

        if (! $user->hasChurchRole($church, ['admin', 'pastor', 'assistant'])) {
            abort(403, '🚫 You are not authorized to invite for this church.');
        }

        $inviteUrl = route('register.church', $church->slug);

        return view('churches.invite', compact('church', 'inviteUrl'));
    }

    /**
     * Ensure only Admins/Pastors can create new churches.
     */
    private function authorizeChurchCreator()
    {
        if (! Auth::user()->isAdminOrPastor()) {
            abort(403, '🚫 Only Admin or Pastor can create a church.');
        }
    }

    /**
     * Ensure the user has access to a given church.
     */
    private function authorizeChurchAccess(Church $church)
    {
        $user = Auth::user();

        if (! $user->memberChurch() && ! $user->churches->contains($church->id)) {
            abort(403, '🚫 You are not authorized to access this church.');
        }
    }
}
