<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\signupRequestVerification;

class verificationController extends Controller
{
    public function showVerificationPage(Request $request)
    {
        // Check if the request_id and email are valid
        $request_id = $request->input('request_id');
        $email = $request->input('email');

        $signupRequestID = signupRequestVerification::where('email', $email)->first();
        $user = User::where('email', $email)->first();

        if (!$signupRequestID || $signupRequestID->request_id !== $request_id) {
            return redirect(route('signup'))->with('error', 'Oops, it seems there\'s an issue with the URL you\'re using. Contact technical support if the issue persists.');
        }

        // Convert the created_at attribute to a Carbon instance
        $createdAt = \Carbon\Carbon::parse($signupRequestID->created_at);
        $now = now();

        // Check if the request_id is more than 24 Hours old
        $request_idAgeInHours = $createdAt->diffInHours($now);

        if ($request_idAgeInHours > 24) {
            $signupRequestID->delete();
            $user->delete();
            return redirect(route('signup'))->with('error', 'Unfortunately, your signup process was not completed within 24 hours. As a result, all records associated with your account have been permanently deleted.');
        }

        return view('auth.verification', ['request_id' => $request_id, 'email' => $email]);
    }

    public function verifySignupOtp(Request $request)
    {
        $request->validate([
            'request_id' => [
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
        $request_id = $request->input('request_id');
        $email = $request->input('email');

        // Find the user by email
        $user = User::where('email', $email)->first();

        if (!$user) {
            // The user doesn't exist with the provided email
            return redirect()->route('verification',  ['request_id' => $request_id, 'email' => $email])->with('error', 'Invalid email. Please try again.');
        }

        // Check if the OTP has expired
        if ($user->otp_expires_at->diffInMinutes(now()) > 30) {
            // OTP has expired, you can handle this case (e.g., show an error message)
            return redirect()->route('verification', ['request_id' => $request_id, 'email' => $email])->with('error', 'That OTP code has expired. Please request for a new OTP.');
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
            // Redirect to a success page
            return redirect()->route('signup-complete', ['email' => $email])->with('success', 'Your email has been verified successfully, please complete your registration process here.');
        } else {
            // Invalid OTP
            return redirect()->route('verification', ['request_id' => $request_id, 'email' => $email])->with('error', 'The OTP code entered is incorrect. Please provide the correct OTP.');
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
