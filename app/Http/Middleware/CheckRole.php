<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        if ($user) {
            if ($role == 'admin' && $user->role_id == 1) {
                return $next($request);
            } elseif ($role == 'user' && $user->role_id == 2) {
                return $next($request);
            }
        }

        return response()->json(['message' => 'Forbidden'], 403);
    }
}
