<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function showDashboardIndex()
    {
        if (Auth::check()) {
            $user = Auth::user();
    
            // Check if the user is authenticated and has completed the signup process
            if ($user->registration_completed) {
                return view('Dashboard.index');
            } else {
                // Redirect to the signup completion route
                return redirect()->route('signup.complete');
            }
        } else {
            // User is not authenticated, redirect to the signin page
            return redirect()->route('signin');
        }
    }
}
