<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function showDashboardIndex()
    {
        if (Auth::check()) {
            return view('Dashboard.index');
        }else {
            return redirect()->route('signin');
        }
    }
}
