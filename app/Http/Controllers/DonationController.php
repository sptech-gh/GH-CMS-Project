<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Church;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
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
    }

    /**
     * Show the form for creating a new donation.
     */
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
    }
}
