<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
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

        // Check if the IP address is localhost (127.0.0.1 or ::1) or if it's in a private IP range
        if ($ip === '127.0.0.1' || $ip === '::1' || filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            // User is on localhost or using a private IP, block access
            abort(403, 'Private IP\'s not allowed.');
        }

        // Make a request to IPinfo.io to get location information based on the IP address
        $client = new Client();
        $response = $client->get("https://ipinfo.io/{$ip}/json?token=922e19e31f996b"); // Replace YOUR_API_KEY with your actual API key
        $data = json_decode($response->getBody());

        // Check if the country is Ghana
        if (isset($data->country) && strtoupper($data->country) === 'GH') {
            // User is in Ghana, block access
            abort(403, 'Access from Ghana is not allowed.');
        }

        return $next($request);
    }
}
