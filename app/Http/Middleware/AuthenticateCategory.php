<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;

class AuthenticateCategory
{
    public function handle($request, Closure $next)
    {
        if (!Gate::allows('category')) {
            abort(403);
        }

        return $next($request);
    }
}
