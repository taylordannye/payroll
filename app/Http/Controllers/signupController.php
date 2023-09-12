<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\activateSignupRequest;
use Illuminate\Support\Facades\Mail;

class signupController extends Controller
{
    public function showSignupPage()
    {
        return view('auth.signup');
    }

    public function authorizeUserSignup(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                'unique:users,email'
            ],
        ]);

        // Generate a random OTP (e.g., 6 digits)
        $otpCode = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);

        // Create a new user with the provided email
        $user = User::create([
            'email' => $request->input('email'),
            // Add any other user data you need to store
        ]);

        // Set the OTP and expiration time
        $user->otp = $otpCode;
        $user->otp_expires_at = Carbon::now()->addMinutes(30); // 30 minutes from now
        $user->save();

        $activationLink = route('verification', ['otp' => $otpCode, 'email' => $request->email]);
        $time = $user->otp_expires_at;

        $mailData = [
            'action_link' => $activationLink,
            'user' => $user,
            'time' => $time,
        ];

        try {
            // Check DNS records to ensure the recipient's email domain is valid
            $recipientEmail = $user->email;
            $recipientDomain = substr(strrchr($recipientEmail, "@"), 1);

            if (!checkdnsrr($recipientDomain, 'MX')) {
                // Invalid domain, handle the error
                $errorMessage = 'There is an issue with the recipient\'s email domain. Please try again later.';
                return redirect()->back()->with('error', $errorMessage);
            }

            // If DNS check is successful, send the email
            Mail::to($recipientEmail)->send(new activateSignupRequest($mailData));
        } catch (\Exception $e) {
            // Handle other exceptions (e.g., mail server issues)
            $errorMessage = 'There was an issue sending password reset confirmation email. Please try again later.';
            return redirect()->back()->with('error', $errorMessage);
        }

        // Send a success message
        session()->flash('success', 'Your account has been created. Please check your email for an OTP to complete the registration.');

        return redirect()->route('verification');
    }
}
