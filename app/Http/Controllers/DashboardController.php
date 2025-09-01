<?php

namespace App\Http\Controllers;

use App\Models\Church;
use App\Models\Donation;
use App\Models\Event;
use App\Models\Member;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the dashboard (global or church-specific).
     */
    public function index(Request $request, Church $church = null)
    {
        $user = auth()->user();

        // If a specific church is in the route
        if ($request->route('church')) {
            $church = Church::findOrFail($request->route('church'));

            // Church-specific stats
            $churchCount   = 1; // only this church
            $memberCount   = $church->members()->count();
            $donationSum   = $church->donations()->sum('amount');

            // Recent donations
            $recentDonations = $church->donations()->latest()->take(5)->get();

            $userChurches = [$church]; // only this church
        } else {
            // 🔹 Global stats
            $churchCount   = Church::count();
            $memberCount   = Member::count();
            $donationSum   = Donation::sum('amount');

            $recentDonations = Donation::latest()->take(5)->get();

            // Churches associated with logged-in user
            $userChurches = $user->churches()->get();
        }

        return view('dashboard', compact(
            'churchCount',
            'memberCount',
            'donationSum',
            'userChurches',
            'recentDonations',
            'church'
        ));
    }
}
