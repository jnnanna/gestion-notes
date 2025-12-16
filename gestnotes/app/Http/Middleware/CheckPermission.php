<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Usage: ->middleware('permission:validate_grades')
     */
    public function handle(Request $request, Closure $next, string $permission)
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $user = $request->user();

        if (! method_exists($user, 'hasPermission') || ! $user->hasPermission($permission)) {
            abort(403, 'Permission requise');
        }

        return $next($request);
    }
}