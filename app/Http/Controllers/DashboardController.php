<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function dashboard(){
      
        return Inertia::render('dashboard');
    }

    public function userData(){
        return response()->json(['user' => Auth::user()]);
    }

}
