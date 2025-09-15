<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureChurchIsSelected
{
    public function handle(Request $request, Closure $next): Response
    {
        // If no church is selected in the session, block access
        if (! $request->session()->has('selected_church_id')) {
            return redirect()->route('select.church')
                ->with('error', 'Please select a church before continuing.');
        }

        return $next($request);
    }
}
