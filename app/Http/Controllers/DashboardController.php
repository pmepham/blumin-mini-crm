<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class DashboardController{

    public function index(Request $request){
        $totals = Contact::totals();
        return view('dashboard.dashboard', compact('totals'));
    }

}