<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;

class AuthenticateImage
{
    public function handle($request, Closure $next)
    {
        if (!Gate::allows('image')) {
            abort(403);
        }

        return $next($request);
    }
}
