<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class SimpleAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        $userId = session('user_id');
        if (!$userId) {
            return redirect()->route('login');
        }
        $user = User::find($userId);
        if (!$user) {
            $request->session()->forget('user_id');
            return redirect()->route('login');
        }
        // attach user to request
        $request->attributes->set('auth_user', $user);
        return $next($request);
    }
}

