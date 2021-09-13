<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;

class AuthenticateSubcategory
{
    public function handle($request, Closure $next)
    {
        if (!Gate::allows('subcategory')) {
            abort(403);
        }

        return $next($request);
    }
}
