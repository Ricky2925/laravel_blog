<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is logged in
        if (auth()->check()) {
            // If the user is logged in, redirect to the welcome page
            return redirect()->route('welcome');  // You can change 'welcome' to any route you wish
        }

         // If the user is not logged in, continue with the request
        return $next($request);
    }
}
