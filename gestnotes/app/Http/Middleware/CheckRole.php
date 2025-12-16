<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Usage in routes: ->middleware('role:Administrateur,Super Admin')
     */
    public function handle(Request $request, Closure $next, string $roles = null)
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        if (empty($roles)) {
            return $next($request);
        }

        $allowed = array_map('trim', explode(',', $roles));
        $userRole = $request->user()->role->name ?? null;

        if (! $userRole || ! in_array($userRole, $allowed, true)) {
            abort(403, 'Accès refusé');
        }

        return $next($request);
    }
}