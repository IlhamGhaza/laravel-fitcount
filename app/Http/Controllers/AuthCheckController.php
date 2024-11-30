<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthCheckController extends Controller
{
    public function checkAuth()
    {
        return Auth::check()
            ? redirect()->route('account')
            : redirect()->route('login');
    }
}
