<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectMemberToChurch
{
    /**
     * Redirect members automatically to their church dashboard.
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->role === 'member') {
            if ($user->church_id) {
                // ✅ Better: redirect to a church-specific dashboard route
                return redirect()->route('churches.show', $user->church_id);
            } else {
                // Member has no church assigned
                return redirect()->route('select-church')
                    ->with('error', '🚫 You are not assigned to any church.');
            }
        }

        return $next($request);
    }
}
