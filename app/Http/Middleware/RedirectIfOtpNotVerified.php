<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Ramsey\Uuid\Rfc4122\UuidV6;
use Illuminate\Support\Facades\Auth;
use App\Models\signupRequestVerification;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfOtpNotVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Check if the authenticated user's otp and otp_expires_at are not null
        if ($user && $user->otp !== null && $user->otp_expires_at !== null) {
            // Generate a unique state using UuidV6
            $state = Str::ucfirst(Str::uuid());
    
            // Create a new signupRequestVerification record
            $signupRequestID = new signupRequestVerification();
            $signupRequestID->state = $state;
            $signupRequestID->email = $request->email; // You may want to validate the email here
            $signupRequestID->created_at = Carbon::now();
            $signupRequestID->save();
    
            // Redirect to the verification route with state and email parameters
            return redirect()->route('verification', ['state' => $state, 'email' => Auth::user()->email, 'redirect' => 'VERIFICATION_REQUIRED']);
        }
    
        return $next($request);
    }
}
