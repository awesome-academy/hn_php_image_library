<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;

class AuthenticateUser
{
    public function handle($request, Closure $next)
    {
        if (!Gate::allows('user')) {
            abort(403);
        }

        return $next($request);
    }
}
