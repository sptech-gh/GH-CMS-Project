<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Church;
use App\Models\Member;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class ChurchDashboardController extends Controller
{
    /**
     * Display the dashboard for a member's assigned church.
     */
    public function index($churchId)
    {
        $user = Auth::user();

        // Ensure members can only access their own church
        if ($user->role === 'member' && $user->church_id != $churchId) {
            abort(403, 'Unauthorized access to this church dashboard.');
        }

        // Load the church
        $church = Church::findOrFail($churchId);

        // Gather stats
        $membersCount   = $church->members()->count();
        $eventsCount    = $church->events()->count();

        // Recent members
        $recentMembers = $church->members()->latest()->limit(5)->get();

        // Upcoming events
        $upcomingEvents = $church->events()
            ->whereDate('date', '>=', now())
            ->orderBy('date')
            ->limit(5)
            ->get();

        return view('church.dashboard', [
            'church'         => $church,
            'membersCount'   => $membersCount,
            'eventsCount'    => $eventsCount,
            'recentMembers'  => $recentMembers,
            'upcomingEvents' => $upcomingEvents,
        ]);
    }
}
