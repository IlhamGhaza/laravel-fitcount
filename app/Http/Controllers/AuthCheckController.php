<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthCheckController extends Controller
{
    public function checkAuth()
    {
        if (Auth::check()) {
            return redirect()->route('account')->with('success', 'Welcome back!');
        }
        return redirect()->route('login')->with('error', 'Please login to continue.');
    }
}
