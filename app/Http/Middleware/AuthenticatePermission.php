<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;

class AuthenticatePermission
{
    public function handle($request, Closure $next)
    {
        if (!Gate::allows('permission')) {
            abort(403);
        }

        return $next($request);
    }
}
