<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class signinController extends Controller
{
    // Display the signin page.
    public function showSigninPage()
    {
        return view('auth.signin');
    }
}
