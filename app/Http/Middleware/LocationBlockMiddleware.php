<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Torann\GeoIP\Facades\GeoIP;
use Symfony\Component\HttpFoundation\Response;

class LocationBlockMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip(); // Get the user's IP address
        $location = GeoIP::getLocation($ip); // Get the user's location

        // Check if the user's location is Ghana (adjust as needed)
        if ($location && $location['country'] === 'Ghana') {
            return abort(403, 'Access from Ghana is not allowed.'); // Block access with a 403 Forbidden status
        }

        return $next($request);
    }
}
