<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard for the selected church.
     */
    public function index(Request $request)
    {
        // ✅ Get the current church from middleware
        $church = app('currentChurch');

        // 🚦 Redirect to church selection if none found
        if (! $church) {
            return redirect()
                ->route('select-church')
                ->with('error', '⚠️ Please select a church first.');
        }

        $user = auth()->user();

        // 📊 Stats
        $membersCount   = $church->members()->count();
        $eventsCount    = $church->events()->count();
        $donationsCount = $church->donations()->count();
        $donationsTotal = $church->donations()->sum('amount');

        // 🧑‍🤝‍🧑 Latest 5 members
        $recentMembers  = $church->members()
            ->latest()
            ->limit(5)
            ->get();

        // 📅 Next 5 upcoming events
        $upcomingEvents = $church->events()
            ->whereDate('event_date', '>=', now())
            ->orderBy('event_date')
            ->limit(5)
            ->get();

        // 💰 Last 5 donations
        $recentDonations = $church->donations()
            ->latest()
            ->limit(5)
            ->get();

        // 🔒 Role-based view: Members see limited info
        $isAdminOrPastor = $church->users()
            ->where('user_id', $user->id)
            ->whereIn('role', ['pastor', 'admin'])
            ->exists();

        return view('dashboard.index', [
            'church'          => $church,
            'membersCount'    => $membersCount,
            'eventsCount'     => $eventsCount,
            'donationsCount'  => $donationsCount,
            'donationsTotal'  => $donationsTotal,
            'recentMembers'   => $recentMembers,
            'upcomingEvents'  => $upcomingEvents,
            'recentDonations' => $recentDonations,
            'isAdminOrPastor' => $isAdminOrPastor,
        ]);
    }
}
