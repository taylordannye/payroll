<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->registration_completed) {
                $this->clearLoginAttempts($request);
                return redirect(route('dashboard'));
            } else {
                // Log in the user temporarily
                Auth::login($user);
                // Redirect to the signup completion route
                return redirect()->route('signup-complete', ['email' => $email, 'redirect' => 'ACCOUNT_INCOMPLETE']);
            }
        } else {
            $this->incrementLoginAttempts($request);
            Session::flash('error', 'Invalid ' . config('app.name') . ' account password/email. Please retry. Too many unsuccessful attempts will result in your account being locked.');
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
