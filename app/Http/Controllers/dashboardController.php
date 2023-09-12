<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function showDashboardIndex()
    {
        return view('Dashboard.index');
    }
}
