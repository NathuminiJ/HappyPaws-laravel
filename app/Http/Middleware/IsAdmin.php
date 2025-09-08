<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Admin;

class EnsureIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Check if logged-in user is an Admin model
        if ($request->user() instanceof Admin) {
            return $next($request);
        }

        return response()->json(['error' => 'Forbidden'], 403);
    }
}
