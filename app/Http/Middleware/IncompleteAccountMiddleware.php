<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IncompleteAccountMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is signed in and has an incomplete account.
        if (Auth::check() && Auth::user()->registration_completed === false) {
            return redirect(route('signup-complete'))->with(['info' => 'Please complete your signup process first']);
        }
        
        return $next($request);
    }
}
