<?php

namespace App\Http\Middleware;

use App\Models\Church;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetCurrentChurch
{
    /**
     * Handle an incoming request.
     *
     * Ensures the user has access to the requested church
     * and sets it as the "current" church in the session.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (! $user) {
            abort(403, '🚫 Unauthorized.');
        }

        $churchId = $request->route('church'); // assumes {church} route model binding or ID
        $church   = is_numeric($churchId)
            ? Church::find($churchId)
            : ($churchId instanceof Church ? $churchId : null);

        if (! $church) {
            abort(404, '⛪ Church not found.');
        }

        // ✅ Explicit pivot role check (same as controllers)
        $role = $user->churches()
            ->where('church_user.church_id', $church->id)
            ->pluck('church_user.role')
            ->first();

        if (! in_array($role, ['pastor', 'admin', 'assistant', 'member'])) {
            abort(403, '🚫 You do not belong to this church.');
        }

        // Store current church in session
        session(['current_church_id' => $church->id]);

        return $next($request);
    }
}
