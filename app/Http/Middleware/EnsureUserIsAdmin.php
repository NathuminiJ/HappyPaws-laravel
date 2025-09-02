<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Adjust this if you have a separate admins table
        if (! $user || ! $user->is_admin) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
