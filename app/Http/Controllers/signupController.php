<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\activateSignupRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;
use App\Models\signupRequestVerification;

class signupController extends Controller
{
    public function showSignupPage()
    {
        return view('auth.signup');
    }

    function generateRandomString()
    {
        $segment1 = base64_encode(Str::random(6));
        $segment2 = base64_encode(Str::random(6));
        $segment3 = base64_encode(Str::random(6));
        $segment4 = base64_encode(Str::random(6));

        return "{$segment1}-{$segment2}-{$segment3}-{$segment4}";
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
        $request_id = $this->generateRandomString();


        // Create a new user with the provided email
        $user = User::create([
            'email' => $request->input('email'),
            // Add any other user data you need to store
        ]);

        $signupRequestID = new signupRequestVerification();
        $signupRequestID->request_id = $request_id;
        $signupRequestID->email = $request->email;
        $signupRequestID->created_at = Carbon::now();
        $signupRequestID->save();

        // Set the OTP and expiration time
        $user->otp = $otpCode;
        $user->otp_expires_at = Carbon::now()->addMinutes(30); // 30 minutes from now
        $user->save();

        $activationLink = route('verification', ['request_id' => $request_id, 'email' => $request->email]);
        $time = $user->otp_expires_at;

        $mailData = [
            'activation_link' => $activationLink,
            'user' => $user,
            'time' => $time,
        ];

        // try {
        //     // Check DNS records to ensure the recipient's email domain is valid
        //     $recipientEmail = $user->email;
        //     $recipientDomain = substr(strrchr($recipientEmail, "@"), 1);

        //     if (!checkdnsrr($recipientDomain, 'MX')) {
        //         // Invalid domain, handle the error
        //         $errorMessage = 'There is an issue with the recipient\'s email domain. Please try again later.';
        //         return redirect()->back()->with('error', $errorMessage);
        //     }

        //     // If DNS check is successful, send the email
        //     Mail::to($recipientEmail)->send(new activateSignupRequest($mailData));
        // } catch (\Exception $e) {
        //     // Handle other exceptions (e.g., mail server issues)
        //     $errorMessage = 'There was an issue sending password reset confirmation email. Please try again later.';
        //     return redirect()->back()->with('error', $errorMessage);
        // }

        // Send a success message
        session()->flash('success', 'Please check ' . $user->email . ' for an OTP to verify your email address and complete registration.');

        return redirect()->route('verification', ['request_id' => $request_id, 'email' => $request->email]);
    }

    public function completeRegistrationProcess(Request $request)
    {
        $email = $request->input('email');

        // Find the user by email
        $user = User::where('email', $email)->first();

        if (!$user) {
            // The user doesn't exist with the provided email
            return redirect()->route('signup');
        }

        // Check if allow_signup is set to false
        if ($user->allow_signup === 0) {
            return redirect()->route('signup');
        }

        return view('auth.signup-complete', ['email' => $email]);
    }
    public function completeProcess(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email'
            ],
            'firstname' => [
                'required',
            ],
            'surname' => [
                'required'
            ],
            'dob' => [
                'required',
                'date',
                'before_or_equal:' . now()->subYears(18)->format('Y-m-d'), // Ensure the user is at least 18 years old.
            ],
            'username' => [
                'required',
                'unique:users,username',
                'regex:/^[a-zA-Z0-9_-]{3,16}$/',
            ],
            'password' => [
                'required',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            ],
        ]);

        $user = User::where('email', $request->input('email'))->first();

        try {
            if (!$user) {
                throw new \Exception('User not found'); // Handle the case when the user is not found.
            }

            $user->firstname = $request->input('firstname');
            $user->surname = $request->input('surname');
            $user->username = $request->input('username');
            $user->dob = $request->input('dob');
            $user->password = Hash::make($request->input('password'));
            $user->allow_signup = false;
            $user->save();
            Auth::login($user);
            return redirect(route('dashboard'))->with('success', 'Your account registration has been completed successfully');
        } catch (QueryException $e) {
            // Handle database-related errors (e.g., network issues)
            return redirect()->back()->withInput()->withErrors(['error' => 'A database error occurred while updating your information. Please try again later.']);
        }
    }
}
