<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class verificationController extends Controller
{
    public function showVerificationPage()
    {
        
        return view('auth.verification');
    }
}
