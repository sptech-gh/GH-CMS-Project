<?php

namespace App\Http\Controllers;

use App\Models\Church;
use App\Models\Donation;
use Illuminate\Http\Request;

class ChurchDonationController extends Controller
{
    public function index(Church $church)
    {
        $donations = $church->donations()->latest()->get();
        return view('donations.index', compact('donations', 'church'));
    }

    public function create(Church $church)
    {
        return view('donations.create', compact('church'));
    }

    public function store(Request $request, Church $church)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'donor_name' => 'nullable|string|max:255',
            'method' => 'required|string|max:50',
        ]);

        $church->donations()->create($validated);

        return redirect()->route('churches.donations.index', $church->id)
            ->with('success', 'Donation recorded successfully.');
    }

    public function show(Church $church, Donation $donation)
    {
        return view('donations.show', compact('donation', 'church'));
    }

    public function edit(Church $church, Donation $donation)
    {
        return view('donations.edit', compact('donation', 'church'));
    }

    public function update(Request $request, Church $church, Donation $donation)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'donor_name' => 'nullable|string|max:255',
            'method' => 'required|string|max:50',
        ]);

        $donation->update($validated);

        return redirect()->route('churches.donations.index', $church->id)
            ->with('success', 'Donation updated successfully.');
    }

    public function destroy(Church $church, Donation $donation)
    {
        $donation->delete();

        return redirect()->route('churches.donations.index', $church->id)
            ->with('success', 'Donation deleted successfully.');
    }
}
