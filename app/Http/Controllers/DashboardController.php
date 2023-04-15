<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //return to dashboard

    public function index()
    {
        return view('dashboard.dashboard');
    }
}
