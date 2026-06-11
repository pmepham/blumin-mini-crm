<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController{

    public function index(Request $request){
        return view('dashboard.dashboard');
    }

}