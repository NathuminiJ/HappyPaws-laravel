<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // If no user or user is not an Admin model instance => Forbidden
        if (! $user || get_class($user) !== \App\Models\Admin::class) {
            return response()->json(['message' => 'Forbidden - admin only.'], 403);
        }

        return $next($request);
    }
}
