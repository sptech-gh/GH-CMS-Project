<?php

namespace App\Services;

use App\Models\Church;
use App\Models\Member;
use App\Models\Donation;
use App\Models\Event;

class DashboardService
{
    protected $churchId;

    public function __construct($churchId = null)
    {
        $this->churchId = $churchId;
    }

    /**
     * Fetch all dashboard stats for the given church (or global if null).
     */
    public function getStats()
    {
        // Scope queries to a church if churchId is provided
        $churchQuery   = $this->churchId ? Church::where('id', $this->churchId) : Church::query();
        $memberQuery   = $this->churchId ? Member::where('church_id', $this->churchId) : Member::query();
        $donationQuery = $this->churchId ? Donation::where('church_id', $this->churchId) : Donation::query();
        $eventQuery    = $this->churchId ? Event::where('church_id', $this->churchId) : Event::query();

        // Counts
        $churchesCount      = $churchQuery->count();
        $membersCount       = $memberQuery->count();
        $totalDonations     = $donationQuery->sum('amount');
        $successfulDonations = $donationQuery->where('status', 'successful')->sum('amount');
        $pendingDonations   = $donationQuery->where('status', 'pending')->count();

        // Events
        $upcomingEvents = $eventQuery->where('start_datetime', '>=', now())->count();
        $pastEvents     = $eventQuery->where('end_datetime', '<', now())->count();

        // Recent records
        $recentEvents = $eventQuery->orderBy('start_datetime', 'desc')
                                   ->take(5)
                                   ->get();

        $recentDonations = $donationQuery->latest()->take(5)->get();

        return [
            'churchesCount'      => $churchesCount,
            'membersCount'       => $membersCount,
            'totalDonations'     => $totalDonations,
            'successfulDonations'=> $successfulDonations,
            'pendingDonations'   => $pendingDonations,
            'upcomingEvents'     => $upcomingEvents,
            'pastEvents'         => $pastEvents,
            'recentEvents'       => $recentEvents,
            'recentDonations'    => $recentDonations,
        ];
    }
}
