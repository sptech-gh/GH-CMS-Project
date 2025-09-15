<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donation;

class DonationController extends Controller
{
    /**
     * Display a listing of donations for the current church.
     */
    public function index()
    {
        $church = app('currentChurch');

        $donations = $church->donations()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('donations.index', compact('donations'));
    }

    /**
     * Show the form for creating a new donation.
     */
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
    }
}
