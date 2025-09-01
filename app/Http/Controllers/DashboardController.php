<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Import models used for counts
use App\Models\Donation;
use App\Models\Member;
use App\Models\Event;
use App\Models\Church;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // counts (guard if models/table missing)
        $donationsCount = 0;
        $membersCount = 0;
        $eventsCount = 0;
        $recentDonations = collect();

        if (class_exists(Donation::class)) {
            $donationsCount = Donation::count();
            $recentDonations = Donation::orderBy('created_at', 'desc')->limit(6)->get();
        }

        if (class_exists(Member::class)) {
            $membersCount = Member::count();
        }

        if (class_exists(Event::class)) {
            $eventsCount = Event::count();
        }

        // fetch churches for the logged-in user (adjust relation name if different)
        $churches = collect();
        if (method_exists($user, 'churches')) {
            $churches = $user->churches()->latest()->get();
        } else {
            // fallback: all churches if relation not set (remove if undesired)
            if (class_exists(Church::class)) {
                $churches = Church::latest()->limit(10)->get();
            }
        }

        // optional: set $church context if you support selecting a specific church
        $church = null;
        if ($request->has('church')) {
            $church = Church::find($request->query('church'));
        }

        return view('dashboard', compact(
            'donationsCount',
            'membersCount',
            'eventsCount',
            'recentDonations',
            'church',
            'churches'
        ));
    }
}
