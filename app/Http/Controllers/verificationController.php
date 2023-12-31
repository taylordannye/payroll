<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\signupRequestVerification;

class verificationController extends Controller
{
    public function showVerificationPage(Request $request)
    {
        // Check if the state and email are valid
        $state = $request->input('state');
        $email = $request->input('email');

        $signupRequestID = signupRequestVerification::where('email', $email)->first();
        $user = User::where('email', $email)->first();

        if (!$signupRequestID || $signupRequestID->state !== $state) {
            return redirect(route('signup', ['redirect' => 'ACCESS_DENIED', 'url' => ''.config('app.url')]));
        }

        // Convert the created_at attribute to a Carbon instance
        $createdAt = \Carbon\Carbon::parse($signupRequestID->created_at);
        $now = now();

        // Check if the request_id is more than 24 Hours old
        $stateAgeInHours = $createdAt->diffInHours($now);

        if ($stateAgeInHours > 24) {
            $signupRequestID->delete();
            $user->delete();
            return redirect(route('signup', ['redirect' => 'SIGNUP_SESSION_EXPIRED', 'url' => ''.config('app.url')]));
        }

        return view('auth.verification', ['state' => $state, 'email' => $email]);
    }

    public function verifySignupOtp(Request $request)
    {
        $request->validate([
            'state' => [
                'required'
            ],
            'email' => [
                'required',
                'email',
            ],
            'otp' => [
                'required',
                'numeric'
            ],
        ]);

        // Check if the request_id and email are valid
        $state = $request->input('state');
        $email = $request->input('email');

        // Find the user by email
        $user = User::where('email', $email)->first();

        if (!$user) {
            // The user doesn't exist with the provided email
            return redirect()->route('verification',  ['state' => $state, 'email' => $email])->with('error', 'Something terrible happened, contact support for assistance is issue persists.');
        }

        // Check if the OTP has expired
        if ($user->otp_expires_at->diffInMinutes(now()) > 30) {
            // OTP has expired, you can handle this case (e.g., show an error message)
            return redirect()->route('verification', ['state' => $state, 'email' => $email])->with('error', 'That OTP code has expired. Please request for a new OTP.');
        }

        // Check if the OTP matches
        if ($request->input('otp') == $user->otp) {
            $signupRequestID = signupRequestVerification::where('email', $email)->first();
            // OTP is correct, you can proceed with account activation
            // For example, set the user's account as active in your 'users' table
            $user->email_verified_at = Carbon::now();
            $user->otp = null;
            $user->otp_expires_at = null;
            $user->allow_signup = true;
            $user->save();
            $signupRequestID->delete();
            Auth::login($user);
            // Redirect to a success page
            return redirect()->route('signup-complete', ['email' => $email]);
        } else {
            // Invalid OTP
            return redirect()->route('verification', ['state' => $state, 'email' => $email])->with('error', 'The OTP code entered is incorrect. Please provide the correct OTP.');
        }
    }

    function resendOtp(Request $request)
    {
        $email = $request->input('email');

        $user = User::where('email', $email)->first();

        if (!$user->otp_expires_at || $user->otp_expires_at->diffInMinutes(now()) > 30) {
            // OTP has expired or doesn't exist, generate a new OTP
            $otpCode = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
            $user->otp = $otpCode;
            $user->otp_expires_at = now()->addMinutes(30); // Set a new expiration time (e.g., 30 minutes from now)
        }
        // Save the user model with the new OTP and expiration time (if generated)
        $user->save();
        // Send the OTP to the user's email
        // Mail::to($user->email)->send(new OtpMail($user->otp));
        return redirect()->back()->with('success', 'A new OTP code has been sent to ' .$user->email);
    }
}
