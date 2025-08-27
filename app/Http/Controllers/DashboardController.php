<?php

namespace App\Http\Controllers;

use App\Models\Church;
use App\Models\Member;

class DashboardController extends Controller
{
    public function index()
    {
        // Example stats for dashboard
        $totalChurches = Church::count();
        $totalMembers = Member::count();

        return view('dashboard', compact('totalChurches', 'totalMembers'));
    }
}
