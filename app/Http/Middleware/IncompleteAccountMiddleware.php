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
        if (Auth::check()) {
        } else {
            // User is not authenticated, redirect to the signin page
            return redirect()->route('signin', ['redirect' => 'AUTH_REQUIRED', 'url' => ''.config('app.url')]);
        }
        return $next($request);
    }
}
