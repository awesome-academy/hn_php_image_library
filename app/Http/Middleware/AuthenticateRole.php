<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;

class AuthenticateRole
{
    public function handle($request, Closure $next)
    {
        if (!Gate::allows('role')) {
            abort(403);
        }

        return $next($request);
    }
}
