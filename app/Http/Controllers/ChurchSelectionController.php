<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Church;

class ChurchSelectionController extends Controller
{
    /**
     * Show the church selection page.
     */
    public function show(Request $request)
    {
        $user = Auth::user();

        // Fetch churches based on user role
        if (in_array($user->role, ['admin', 'pastor'])) {
            // Admins and pastors can belong to multiple churches
            $churches = $user->churches()->get();
        } else {
            // Members can belong to only one church
            $churches = $user->churches()->limit(1)->get();
        }

        // If no churches assigned, show message
        if ($churches->isEmpty()) {
            return view('auth.select-church', [
                'churches' => $churches,
                'message' => '🚫 You are not assigned to any church. Please contact an administrator.',
                'current_church_id' => null
            ]);
        }

        // Auto-redirect if only one church (members or admin/pastor)
        if ($churches->count() === 1) {
            $request->session()->put('current_church_id', $churches->first()->id);
            return redirect()->route('dashboard')
                ->with('success', '✅ Church selected successfully!');
        }

        // Show selection page for multiple churches
        return view('auth.select-church', [
            'churches' => $churches,
            'message' => null,
            'current_church_id' => $request->session()->get('current_church_id')
        ]);
    }

    /**
     * Store the selected church in session.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'church_id' => 'required|exists:churches,id',
        ]);

        $user = Auth::user();

        // Ensure user is assigned to the selected church
        $church = $user->churches()->find($validated['church_id']);
        if (!$church) {
            return redirect()->back()
                ->with('error', '🚫 You are not assigned to this church.');
        }

        // Save selected church in session
        $request->session()->put('current_church_id', $validated['church_id']);

        return redirect()->route('dashboard')
            ->with('success', '✅ Church selected successfully!');
    }
}
