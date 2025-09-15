<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    /**
     * Display a listing of the members for the current church.
     */
    public function index()
    {
        $church = app('currentChurch');

        $members = $church->members()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new member.
     */
    public function create()
    {
        $this->authorizeChurchAction();
        return view('members.create');
    }

    /**
     * Store a newly created member in the current church.
     */
    public function store(Request $request)
    {
        $this->authorizeChurchAction();
        $church = app('currentChurch');

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|email|unique:members,email',
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $validated['church_id'] = $church->id;

        Member::create($validated);

        return redirect()
            ->route('members.index')
            ->with('success', '✅ Member added successfully.');
    }

    /**
     * Display a single member.
     */
    public function show(Member $member)
    {
        $this->authorizeMember($member);
        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing a member.
     */
    public function edit(Member $member)
    {
        $this->authorizeMember($member);
        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified member in the current church.
     */
    public function update(Request $request, Member $member)
    {
        $this->authorizeMember($member);

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|email|unique:members,email,' . $member->id,
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $member->update($validated);

        return redirect()
            ->route('members.index')
            ->with('success', '✏️ Member updated successfully.');
    }

    /**
     * Remove the specified member.
     */
    public function destroy(Member $member)
    {
        $this->authorizeMember($member);
        $member->delete();

        return redirect()
            ->route('members.index')
            ->with('success', '🗑️ Member deleted successfully.');
    }

    /**
     * Ensure the member belongs to the current church.
     */
    private function authorizeMember(Member $member)
    {
        $church = app('currentChurch');

        if ($member->church_id !== $church->id) {
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

        // ✅ Explicitly pull from pivot table to avoid ambiguous "role" column
        $role = $user->churches()
            ->where('church_user.church_id', $church->id)
            ->pluck('church_user.role')
            ->first();

        if (! in_array($role, ['pastor', 'admin'])) {
            abort(403, '🚫 Only Pastor or Admin can perform this action.');
        }
    }
}
