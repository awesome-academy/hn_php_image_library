<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role_id == config('project.is_user')) {
            abort(403);
        } else {
            redirect()->route('login');
        }

        return $next($request);
    }
}
