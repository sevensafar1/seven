<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Check if the user is authenticated
         if (!Auth::check()) {
            // Redirect to login with an error message if not authenticated
            return redirect('login')->with('error', 'You must be logged in to access the dashboard.');
        }

        // Continue with the request if authenticated
        return $next($request);
    }
}
