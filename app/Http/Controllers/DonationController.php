<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use Illuminate\Http\Request;
use App\Models\Donation;
=======
use App\Models\Donation;
use App\Models\Church;
use Illuminate\Http\Request;
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603

class DonationController extends Controller
{
    /**
<<<<<<< HEAD
     * Display a listing of donations for the current church.
     */
    public function index()
    {
        $church = app('currentChurch');

        $donations = $church->donations()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('donations.index', compact('donations'));
=======
     * Display a listing of all donations across all churches.
     */
    public function allDonations()
    {
        $donations = Donation::with('church', 'member')
            ->latest()
            ->paginate(15);

        return view('donations.all', compact('donations'));
    }

    /**
     * Display a listing of the donations for a specific church.
     */
    public function index(Church $church)
    {
        $donations = $church->donations()->with('member')->latest()->paginate(15);

        return view('donations.index', compact('donations', 'church'));
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
    }

    /**
     * Show the form for creating a new donation.
     */
<<<<<<< HEAD
    public function create()
    {
        $this->authorizeChurchAction();
        return view('donations.create');
    }

    /**
     * Store a newly created donation in the current church.
     */
    public function store(Request $request)
    {
        $this->authorizeChurchAction();
        $church = app('currentChurch');

        $validated = $request->validate([
            'donor_name' => 'nullable|string|max:255',
            'amount'     => 'required|numeric|min:0.01',
            'note'       => 'nullable|string',
        ]);

        $validated['church_id'] = $church->id;

        Donation::create($validated);

        return redirect()
            ->route('donations.index')
            ->with('success', '✅ Donation recorded successfully.');
    }

    /**
     * Display a single donation.
     */
    public function show(Donation $donation)
    {
        $this->authorizeDonation($donation);
        return view('donations.show', compact('donation'));
    }

    /**
     * Remove the specified donation from the current church.
     */
    public function destroy(Donation $donation)
    {
        $this->authorizeDonation($donation);
        $donation->delete();

        return redirect()
            ->route('donations.index')
            ->with('success', '🗑️ Donation deleted successfully.');
    }

    /**
     * Ensure the donation belongs to the current church.
     */
    private function authorizeDonation(Donation $donation)
    {
        $church = app('currentChurch');

        if ($donation->church_id !== $church->id) {
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
        }
=======
    public function create(Church $church)
    {
        return view('donations.create', compact('church'));
    }

    /**
     * Store a newly created donation in storage.
     */
    public function store(Request $request, Church $church)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'member_id' => 'nullable|exists:members,id',
            'note' => 'nullable|string|max:255',
        ]);

        $church->donations()->create($validated);

        return redirect()->route('donations.index', $church->slug)
            ->with('success', 'Donation recorded successfully.');
    }

    /**
     * Display the specified donation.
     */
    public function show(Church $church, Donation $donation)
    {
        return view('donations.show', compact('church', 'donation'));
    }

    /**
     * Show the form for editing the specified donation.
     */
    public function edit(Church $church, Donation $donation)
    {
        return view('donations.edit', compact('church', 'donation'));
    }

    /**
     * Update the specified donation in storage.
     */
    public function update(Request $request, Church $church, Donation $donation)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'note' => 'nullable|string|max:255',
        ]);

        $donation->update($validated);

        return redirect()->route('donations.index', $church->slug)
            ->with('success', 'Donation updated successfully.');
    }

    /**
     * Remove the specified donation from storage.
     */
    public function destroy(Church $church, Donation $donation)
    {
        $donation->delete();

        return redirect()->route('donations.index', $church->slug)
            ->with('success', 'Donation deleted successfully.');
>>>>>>> 22256e915ff603451dbe247432fe9aeed33a3603
    }
}
