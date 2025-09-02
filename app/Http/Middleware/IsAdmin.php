<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If using separate Admins table:
        if ($request->user() && $request->user() instanceof \App\Models\Admin) {
            return $next($request);
        }

        // If using is_admin column in users table (alternative):
        // if (auth()->user() && auth()->user()->is_admin) {
        //     return $next($request);
        // }

        abort(403, 'Unauthorized');
    }
}
