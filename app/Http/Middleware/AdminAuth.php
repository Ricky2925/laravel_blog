<?php

// app/Http/Middleware/AdminAuth.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    public function handle($request, Closure $next)
    {
        // Check if the user is logged in and is an admin using the 'admin' guard
        if (Auth::guard('admin')->check()) {
            $user = Auth::guard('admin')->user();
            
            if ($user->is_admin == 1) {
                // If the user is an admin, allow the request to proceed
                return $next($request);
            }
        }

        // If the user is not logged in or is not an admin, redirect to the admin login page
        return redirect()->route('admin.login');
    }
}
