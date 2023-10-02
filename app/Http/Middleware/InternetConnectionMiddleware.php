<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InternetConnectionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

         // Injection of JavaScript to monitor internet connection status
         $script = <<<SCRIPT
         <script>
             function checkInternetConnection() {
                 var img = new Image();
                 img.src = 'https://www.example.com/images/1x1.png?' + Math.random();
                 img.onload = function() {
                     // Internet connection is available
                     document.getElementById('network-status').style.display = 'none';
                 };
                 img.onerror = function() {
                     // Internet connection is lost or slow
                     document.getElementById('network-status').style.display = 'block';
                 };
             }
             checkInternetConnection();
             setInterval(checkInternetConnection, 5000); // Check every 5 seconds
         </script>
         SCRIPT;
 
         $response->setContent(str_replace('</body>', $script . '</body>', $response->getContent()));
 
         return $response;
    }
}
