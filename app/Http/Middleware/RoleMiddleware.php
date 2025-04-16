<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user || !$user->role || $user->role->name !== 'admin') {
            return redirect('/dashboard'); // Redirecciona al home
        }

        return $next($request);
    }
}
