<?php

namespace App\Http\Controllers;

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
            return redirect(route('signup'))->with('error', 'Unfortunately, your signup process was not completed within the 24-hour timeframe provided. As a result, all records associated with your account have been permanently deleted. You are welcome to initiate a new signup process and complete your account registration at your earliest convenience.');
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
            // OTP is correct, you can proceed with account activation
            // For example, set the user's account as active in your 'users' table
            $user->update([
                'otp' => null,
                'otp_expires_at' => null,
                'allow_signup' => true, // or 1
            ]);

            // Redirect to a success page
            return redirect()->route('signup')->with('success', 'Account activated successfully.');
        } else {
            // Invalid OTP
            return redirect()->route('verification', ['request_id' => $request_id, 'email' => $email])->with('error', 'The OTP code entered is incorrect. Please provide the correct OTP.');
        }
    }
}
