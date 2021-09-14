<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{
    public function handle($request, Closure $next)
    {
        if (Auth::user()->role_id == 0) {
            abort(403);
        }

        return $next($request);
    }
}
