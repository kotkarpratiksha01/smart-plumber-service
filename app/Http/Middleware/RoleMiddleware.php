<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = $request->attributes->get('auth_user');
        if (!$user) {
            return redirect()->route('login');
        }
        $roles = explode('|', $role);
        if (!in_array($user->role, $roles)) {
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}
