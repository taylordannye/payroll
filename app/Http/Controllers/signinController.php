<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Rfc4122\UuidV6;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\signupRequestVerification;

class signinController extends Controller
{
    // Display the signin page.
    public function showSigninPage()
    {
        return view('auth.signin');
    }

    public function signin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $throttles = $this->hasTooManyLoginAttempts($request);

        if ($throttles) {
            $this->fireLockoutEvent($request);
            $seconds = $this->limiter()->availableIn($this->throttleKey($request));
            $minutes = ceil($seconds / 60);
            $message = "Too many unsuccessful login attempts. Your account has been locked. Please try again after $minutes minutes";
            Session::flash('error', $message);
            return redirect()->back();
        }

        $credentials = $request->only('email', 'password');
        $email = $request->input('email');

        // Check if the user's otp and otp_expires_at are null
        $user = User::where('email', $email)->first();

        if ($user && $user->otp === null && $user->otp_expires_at === null) {
            // Check if the user's registration is completed
            if ($user->registration_completed) {
                if (Auth::attempt($credentials)) {
                    $this->clearLoginAttempts($request);
                    return redirect(route('dashboard'));
                }
            } else {
                // Redirect to the signup completion route
                Auth::login($user); // Log in the user temporarily
                return redirect()->route('signup-complete', ['email' => $email, 'redirect' => 'ACCOUNT_INCOMPLETE']);
            }
        } else {
            // If the email/password is incorrect, show the error message
            Session::flash('error', 'Invalid ' . config('app.name') . ' account password/email. Please retry. Too many unsuccessful attempts will result in your account being locked.');
            $this->incrementLoginAttempts($request);
            return redirect()->back();
        }
    }



    protected function hasTooManyLoginAttempts(Request $request)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request),
            $this->maxAttempts(),
            $this->lockoutTime()
        );
    }

    protected function incrementLoginAttempts(Request $request)
    {
        $this->limiter()->hit(
            $this->throttleKey($request),
            $this->lockoutTime()
        );
    }

    protected function clearLoginAttempts(Request $request)
    {
        $this->limiter()->clear($this->throttleKey($request));
    }

    protected function maxAttempts()
    {
        return 5;
    }

    protected function lockoutTime()
    {
        return 3600;
    }

    protected function throttleKey(Request $request)
    {
        return strtolower($request->input('email')) . '|' . $request->ip();
    }

    protected function limiter()
    {
        return app(\Illuminate\Cache\RateLimiter::class);
    }

    protected function fireLockoutEvent(Request $request)
    {
        event(new Lockout($request));
    }

    public function signout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect()->route('signin', ['redirect' => 'COMMAND_EXECUTED_SUCCESSFULLY']);
        } else {
            return redirect()->route('signin', ['redirect' => 'COMMAND_ALREADY_EXECUTED']);
        }
    }
}
