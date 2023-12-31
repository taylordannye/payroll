<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\passwordResetToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\passwordResetSuccessful;
use App\Mail\resetPasswordInstructions;

class randrPasswordController extends Controller
{
    public $email;

    public function showForgotPasswordPage()
    {
        return view('auth.forgot-password');
    }

    public function sendPasswordResetInstructions(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                'exists:users,email',
            ],
        ]);

        $user = User::where('email', $request->email)->first();

        // Check if the user has completed the signup
        if ($user->registration_completed) {
            $existingToken = PasswordResetToken::where('email', $request->email)->first();

            // Check if an existing token is more than 4 hours old and delete it
            if ($existingToken) {
                $tokenCreatedAt = Carbon::parse($existingToken->created_at);
                $fourHoursAgo = now()->subHours(4);

                if ($tokenCreatedAt->lte($fourHoursAgo)) {
                    $existingToken->delete();
                } else {
                    return redirect(route('forgot-password'))->with('error', "There's a current operation in session, please use the previous link to reset your password or wait for 4 hours from the requested time to request it again.");
                }
            }

            $token = Str::ucfirst(Str::uuid());

            $passwordResetToken = new PasswordResetToken();
            $passwordResetToken->email = $request->email;
            $passwordResetToken->token = $token;
            $passwordResetToken->created_at = Carbon::now();
            $passwordResetToken->save();

            $actionLink = route('reset-password', ['token' => $token, 'email' => $request->email]);
            $time = Carbon::now();

            $mailData = [
                'action_link' => $actionLink,
                'user' => $user,
                'time' => $time,
            ];

            // Send the password reset instructions via email (uncomment this code when you are ready to send emails)
            try {
                Mail::to($request->email)->send(new resetPasswordInstructions($mailData));
            } catch (\Exception $e) {
                $errorMessage = 'There was an issue sending the password reset instructions. Please try again later. Or try checking your network connection and try again.';
                return redirect()->back()->with('error', $errorMessage);
            }

            return back()->with('success', "An email with the password reset instructions has successfully been sent to $user->email.");
            // echo($actionLink);
        } else {
            // User has not completed the signup
            return back()->with('error', 'You cannot reset your password because your registration is not complete.');
        }
    }

    public function showResetPasswordPage(Request $request)
    {
        // Check if the token and email are valid
        $token = $request->input('token');
        $email = $request->input('email');

        $passwordResetToken = PasswordResetToken::where('email', $email)->first();

        if (!$passwordResetToken || $passwordResetToken->token !== $token) {
            return redirect(route('forgot-password', ['redirect' => 'ACCESS_FORBIDDEN', 'url' => ''.config('app.url')]));
        }

        // Convert the created_at attribute to a Carbon instance
        $createdAt = \Carbon\Carbon::parse($passwordResetToken->created_at);
        $now = now();

        // Check if the token is more than 4 hours old
        $tokenAgeInHours = $createdAt->diffInHours($now);

        if ($tokenAgeInHours > 4) {
            return redirect(route('forgot-password'))->with('error', 'The password reset link has expired. Please request a new one.');
        }

        return view('auth.reset-password', ['email' => $email, 'token' => $token]);
    }



    public function resetPasswordHandler(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => [
                'required',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
                function ($attribute, $value, $fail) {
                    $commonPasswords = ['password', 'passcode', 'admin', 'administrator'];
                    if (preg_match('/\b(' . implode('|', $commonPasswords) . ')\b/i', $value)) {
                        $fail('Your password contains a common or insecure word. Please choose a stronger password.');
                    }
                },
            ],
        ]);
        $user = User::where('email', $request->input('email'))->first();
        if (!$user) {
            return redirect(route('forgot-password'))->with('error', 'User not found.');
        }
        $passwordResetToken = PasswordResetToken::where('email', $user->email)->first();

        if (!$passwordResetToken || $passwordResetToken->token !== $request->input('token')) {
            return redirect(route('forgot-password'))->with('error', 'Couldn\'t update your password at this time. Please try again later.');
        }
        // Convert the created_at attribute to a Carbon instance
        $createdAt = \Carbon\Carbon::parse($passwordResetToken->created_at);
        $now = now();
        // Check if the token is more than 4 hours old
        $tokenAgeInHours = $createdAt->diffInHours($now);

        if ($tokenAgeInHours > 4) {
            return redirect(route('forgot-password'))->with('error', 'The password reset link has expired. Please request a new one.');
        }
        $user->password = Hash::make($request->input('password'));
        $user->save();
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
        //     Mail::to($recipientEmail)->send(new PasswordResetSuccessful($user));
        //     $user->save();
        // } catch (\Exception $e) {
        //     // Handle other exceptions (e.g., mail server issues)
        //     $errorMessage = 'There was an issue sending password reset confirmation email. Please try again later.';
        //     return redirect()->back()->with('error', $errorMessage);
        // }
        // Delete the used password reset token
        $passwordResetToken->delete();
        return redirect(route('signin'))->with('success', 'Password reset successful. You can now sign in with your new password.');
    }


    public function cancelPasswordReset(Request $request)
    {
        // Check if the token is valid
        $token = $request->input('token');
        $email = $request->input('email');
        $passwordResetToken = PasswordResetToken::where('email', $email)->first();
        if ($passwordResetToken && $passwordResetToken->token === $token) {
            // Token is valid, delete it
            $passwordResetToken->delete();
            return redirect(route('signin'))->with('success', 'Password reset request has been canceled. Feel free to reset your password anytime.');
        }
        return redirect(route('forgot-password'))->with('error', 'Invalid or expired cancel link.');
    }
}
