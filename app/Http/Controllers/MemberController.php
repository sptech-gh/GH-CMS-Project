<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Church;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of members.
     */
    public function index()
    {
        // Load members with their related church
        $members = Member::with('church')->latest()->paginate(10);

        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new member.
     */
    public function create()
    {
        // Get churches for dropdown (each member must belong to a church)
        $churches = Church::orderBy('name')->get();

        return view('members.create', compact('churches'));
    }

    /**
     * Store a newly created member in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:members,email',
            'phone'         => 'nullable|string|max:20',
            'gender'        => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'church_id'     => 'required|exists:churches,id',
        ]);

        // Create member
        Member::create($validated);

        return redirect()->route('members.index')
                         ->with('success', '✅ Member created successfully.');
    }

    /**
     * Display the specified member.
     */
    public function show(Member $member)
    {
        // Load church relation in case it's needed in the view
        $member->load('church');

        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified member.
     */
    public function edit(Member $member)
    {
        $churches = Church::orderBy('name')->get();

        return view('members.edit', compact('member', 'churches'));
    }

    /**
     * Update the specified member in storage.
     */
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:members,email,' . $member->id,
            'phone'         => 'nullable|string|max:20',
            'gender'        => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'church_id'     => 'required|exists:churches,id',
        ]);

        $member->update($validated);

        return redirect()->route('members.show', $member)
                         ->with('success', '✅ Member updated successfully.');
    }

    /**
     * Remove the specified member from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('members.index')
                         ->with('success', '🗑️ Member deleted successfully.');
    }
}
