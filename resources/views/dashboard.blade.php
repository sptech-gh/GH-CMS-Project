<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Church;

class DashboardController extends Controller
{
    /**
     * Show the unified dashboard for Admins, Pastors, and Members.
     */
    public function index()
    {
        $user = Auth::user();
        $churchId = session('current_church_id');

        // 🚫 No church selected → redirect to selection page
        if (!$churchId) {
            return redirect()->route('select-church')
                ->with('error', '🚫 Please select a church first.');
        }

        // 🔎 Ensure the user belongs to this church
        $church = null;

        if ($user->role === 'member') {
            // Members only belong to ONE church (via church_id)
            if ($user->church_id != $churchId) {
                return redirect()->route('select-church')
                    ->with('error', '🚫 Unauthorized church access.');
            }
            $church = $user->church;
        } else {
            // Admin/Pastor/Assistant → check via pivot
            $church = $user->churches()->find($churchId);
            if (!$church) {
                return redirect()->route('select-church')
                    ->with('error', '🚫 You are not assigned to this church.');
            }
        }

        // Example: role-specific dashboard data
        $stats = [];
        if ($user->isAdminOrPastor($church)) {
            $stats = [
                'members_count' => $church->members()->count(),
                'events_count'  => $church->events()->count(),
                'donations_sum' => $church->donations()->sum('amount'),
            ];
        }

        return view('dashboard.index', [
            'user'   => $user,
            'church' => $church,
            'stats'  => $stats,
        ]);
    }
}
