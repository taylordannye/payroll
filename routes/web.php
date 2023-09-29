<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\randrPasswordController;
use App\Http\Controllers\signinController;
use App\Http\Controllers\signupController;
use App\Http\Controllers\verificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [dashboardController::class, 'showDashboardIndex'])->name('dashboard');
Route::group(['prefix' => 'dashboard', 'middleware' => ['incomplete.account']], function () {
    Route::get('/state/', [signupController::class, 'completeRegistrationProcess'])->name('signup-complete');
    Route::post('/state/', [signupController::class, 'completeProcess'])->name('signup-complete.post');
    Route::get('/state/delete', [signupController::class, 'deleteUserData'])->name('delete-user-signupData');
});
Route::group(['middleware' => ['guest', 'guest']], function () {
    Route::get('/sign-up', [signupController::class, 'showSignupPage'])->name('signup');
    Route::post('/sign-up', [signupController::class, 'authorizeUserSignup'])->name('signup.post');
    Route::get('/verify', [verificationController::class, 'showVerificationPage'])->name('verification');
    Route::post('/verify', [verificationController::class, 'verifySignupOtp'])->name('verification.post');
    Route::get('/verify/resend', [verificationController::class, 'resendOtp'])->name('resend-verification');
    Route::get('sign-in', [signinController::class, 'showSigninPage'])->name('signin');
    Route::post('sign-in', [signinController::class, 'signin'])->name('signin.post');
    Route::get('/forgot-password', [randrPasswordController::class, 'showForgotPasswordPage'])->name('forgot-password');
    Route::post('/forgot-password', [randrPasswordController::class, 'sendPasswordResetInstructions'])->name('forgot-password.post');
    Route::get('/forgot-password/reset', [randrPasswordController::class, 'showResetPasswordPage'])->name('reset-password');
    Route::post('/forgot-password/reset', [randrPasswordController::class, 'resetPasswordHandler'])->name('reset-password.post');
    Route::get('/forgot-password/reset/cancel', [randrPasswordController::class, 'cancelPasswordReset'])->name('cancel-reset');
});
// SignOut User
Route::get('/signout', [signinController::class, 'signout'])->name('signout');