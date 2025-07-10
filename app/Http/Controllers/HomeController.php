<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    
    public function home()
    {
        
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('home'); 
    }

   
    public function dashboard()
    {
        
        if (!Auth::check()) {
            return redirect()->route('home');
        }

        return view('dashboard');
    }
}

