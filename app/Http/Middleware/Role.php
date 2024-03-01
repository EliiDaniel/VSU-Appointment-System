<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        switch ($user->role) {
            case 'admin':
            case 'registrar':
                return redirect()->route('registrar.dashboard');
            case 'cashier':
                return redirect()->route('cashier.dashboard');
            case 'requester':
                return redirect()->route('requester.dashboard');
            default:
                return redirect()->route('waiting-for-confirmation');
        }
    }
}